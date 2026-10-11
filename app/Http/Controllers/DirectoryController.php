<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ClinicalSession;
use App\Models\DentalChartEntry;
use App\Models\PatientRecord;
use App\Models\PatientToothRecord;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use App\Support\SimpleReceiptPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class DirectoryController extends Controller
{
    public function accounts(Request $r)
    {
        abort_unless($r->user()?->role === 'admin', 403);

        return User::query()->whereIn('role', ['admin', 'dentist', 'front_desk'])->orderBy('name')->get(['id', 'name', 'email', 'phone', 'role', 'status', 'created_at']);
    }

    public function updateAccount(Request $r, User $user)
    {
        abort_unless($r->user()?->role === 'admin', 403);
        $v = $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'status' => 'required|string|in:Active,Inactive',
            'role' => 'nullable|string|in:admin,dentist,front_desk',
            'password' => 'nullable|string|min:8',
        ]);

        $user->name = $v['name'];
        $user->email = $v['email'];
        $user->status = $v['status'];
        if (! empty($v['role'])) {
            $user->role = $v['role'];
        }
        if (! empty($v['password'])) {
            $user->password = bcrypt($v['password']);
        }
        $user->save();

        return response()->json($user);
    }

    public function createAccount(Request $r)
    {
        abort_unless($r->user()?->role === 'admin', 403);
        $v = $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|string|in:admin,dentist,front_desk',
            'phone' => ['nullable', 'regex:/^9[0-9]{9}$/'],
            'password' => 'required|string|min:8',
            'status' => 'nullable|string|in:Active,Inactive',
        ]);

        $user = User::create([
            'name' => $v['name'],
            'email' => $v['email'],
            'role' => $v['role'],
            'phone' => $v['phone'] ?? null,
            'password' => bcrypt($v['password']),
            'status' => $v['status'] ?? 'Active',
        ]);

        return response()->json($user, 201);
    }

    public function patients(Request $r)
    {
        $user = $r->user();
        $isDentistScoped = ($user && $user->role === 'dentist') || ($user && $user->role === 'admin' && $r->query('view') === 'dentist');
        $dentistId = $user ? $user->id : null;
        $q = PatientRecord::query()
            ->whereHas('appointments', function ($a) use ($isDentistScoped, $dentistId) {
                $a->where('status', 'Completed');
                if ($isDentistScoped && $dentistId) {
                    $a->where('dentist_id', $dentistId);
                }
            })
            ->with(['appointments' => function ($a) use ($isDentistScoped, $dentistId) {
                $a->where('status', 'Completed');
                if ($isDentistScoped && $dentistId) {
                    $a->where('dentist_id', $dentistId);
                }
                $a->with(['service', 'dentist'])->latest('starts_at');
            }]);

        if ($r->filled('search')) {
            $q->where(fn ($s) => $s->where('name', 'like', '%'.$r->search.'%')
                ->orWhere('phone', 'like', '%'.$r->search.'%')
                ->orWhere('email', 'like', '%'.$r->search.'%'));
        }

        return $q->paginate($r->integer('per_page', 25));
    }

    public function show(Request $r, PatientRecord $patient)
    {
        $user = $r->user();
        if ($user) {
            abort_unless(in_array($user->role, ['admin', 'dentist', 'front_desk'], true), 403);
        }
        $isDentistScoped = $user && ($user->role === 'dentist' || ($user->role === 'admin' && $r->query('view') === 'dentist'));
        $isFrontDesk = $user && $user->role === 'front_desk';
        $dentistId = $user ? $user->id : null;

        $patient->load([
            'appointments' => function ($q) use ($isDentistScoped, $dentistId) {
                if ($isDentistScoped && $dentistId) {
                    $q->where('dentist_id', $dentistId);
                }
                $q->with(['dentist', 'service', 'clinicalSession.prescriptionRecords'])->latest('starts_at');
            },
        ]);

        $teethRecords = $isFrontDesk ? collect() : PatientToothRecord::where('patient_id', $patient->id)
            ->join('teeth', 'teeth.id', '=', 'patient_tooth_records.tooth_id')
            ->select('patient_tooth_records.*', 'teeth.fdi_number', 'teeth.label as tooth_name')
            ->get();

        $chartEntries = $isFrontDesk ? collect() : DentalChartEntry::where('patient_id', $patient->id)
            ->with(['clinicalSession.appointment.dentist'])
            ->latest()
            ->get();

        $transactions = Transaction::where('patient_id', $patient->id)
            ->with(['appointment.service', 'appointment.dentist', 'service'])
            ->latest()
            ->get();

        $latestIntake = [];
        $latestConcern = null;
        $latestAnxiety = null;
        $latestAllergies = null;
        $latestMedications = null;
        $latestMedicalHistory = null;
        $latestLastVisit = null;
        $latestAddress = null;
        $preferredDentist = null;
        $lastVisitDate = null;
        $nextApptDate = null;

        foreach ($patient->appointments as $appt) {
            if ($appt->status === 'Completed' && ! $lastVisitDate) {
                $lastVisitDate = $appt->starts_at?->format('d M Y');
            }
            if (in_array($appt->status, ['Scheduled', 'Pending', 'Pending Verification', 'Checked In']) && $appt->starts_at?->isFuture() && ! $nextApptDate) {
                $nextApptDate = $appt->starts_at?->format('d M Y · g:i A');
            }
            if ($appt->dentist && ! $preferredDentist) {
                $preferredDentist = $appt->dentist->name;
            }
            if (! empty($appt->intake_details) && is_array($appt->intake_details)) {
                $intake = $appt->intake_details;
                if (empty($latestIntake)) {
                    $latestIntake = $intake;
                }
                $latestConcern = $latestConcern ?? ($intake['concern'] ?? $intake['medical_concern'] ?? $intake['reason_for_visit'] ?? null);
                $latestAnxiety = $latestAnxiety ?? ($intake['anxiety'] ?? null);
                $latestAllergies = $latestAllergies ?? ($intake['allergies'] ?? null);
                $latestMedications = $latestMedications ?? ($intake['medications'] ?? null);
                $latestMedicalHistory = $latestMedicalHistory ?? ($intake['medical_history'] ?? null);
                $latestLastVisit = $latestLastVisit ?? ($intake['last_visit'] ?? null);
                $latestAddress = $latestAddress ?? ($intake['address'] ?? null);
            }
        }

        $totalPayments = (float) $transactions->where('status', 'completed')->sum('amount');
        $billableAppts = $patient->appointments->whereIn('status', ['Completed', 'In Progress', 'Checked In']);
        $totalCharges = (float) $billableAppts->sum(fn ($a) => (float) ($a->service?->price ?? 0));
        if ($totalCharges <= 0 && $patient->appointments->isNotEmpty()) {
            $totalCharges = (float) $patient->appointments->whereNotIn('status', ['Cancelled', 'No-Show'])->sum(fn ($a) => (float) ($a->service?->price ?? 0));
        }
        $balance = max(0, $totalCharges - $totalPayments);

        // Build appointment-level balances for Front Desk checkout. This keeps the
        // selected treatment and payable amount tied to the actual database visit
        // instead of guessing from a generic service dropdown.
        $billingItems = $patient->appointments
            ->filter(fn ($appt) => in_array($appt->status, ['Completed', 'In Progress', 'Checked In'], true) && $appt->service)
            ->map(function ($appt) use ($transactions) {
                $charge = (float) ($appt->service?->price ?? 0);
                $paid = (float) $transactions
                    ->where('status', 'completed')
                    ->where('appointment_id', $appt->id)
                    ->sum('amount');
                $remaining = max(0, $charge - $paid);
                $serviceName = (string) ($appt->service?->name ?? 'Dental Procedure');
                $installmentEligible = (bool) preg_match('/ortho|brace/i', $serviceName);

                return [
                    'appointment_id' => $appt->id,
                    'service_id' => $appt->service_id,
                    'service_name' => $serviceName,
                    'service_price' => $charge,
                    'paid' => $paid,
                    'balance' => $remaining,
                    'installment_eligible' => $installmentEligible,
                    'status' => $appt->status,
                    'starts_at' => $appt->starts_at?->toIso8601String(),
                ];
            })
            ->filter(fn ($item) => $item['balance'] > 0)
            ->values();

        $allXrays = [];
        if (! $isFrontDesk) {
            foreach ($patient->appointments as $appt) {
                $session = $appt->clinicalSession;
                if ($session && ! empty($session->xrays)) {
                    $sessionXrays = is_array($session->xrays) ? $session->xrays : json_decode($session->xrays, true);
                    if (is_array($sessionXrays)) {
                        foreach ($sessionXrays as $xr) {
                            if (is_array($xr)) {
                                $allXrays[] = [
                                    'id' => $xr['id'] ?? null,
                                    'title' => $xr['title'] ?? ($xr['type'] ?? 'Radiograph'),
                                    'type' => $xr['type'] ?? 'Radiograph',
                                    'date' => $xr['date'] ?? $appt->starts_at?->format('d M Y'),
                                    'description' => $xr['description'] ?? ($xr['notes'] ?? ''),
                                    'dentist' => $xr['dentist'] ?? ($appt->dentist?->name ?? 'Attending Dentist'),
                                    'image_url' => $xr['image_url'] ?? ($xr['url'] ?? '/assets/images/xray-panoramic.png'),
                                ];
                            }
                        }
                    }
                }
            }
        }

        return response()->json([
            'patient' => [
                'id' => $patient->id,
                'patient_code' => $patient->patient_code,
                'formatted_patient_code' => $patient->formatted_patient_code,
                'name' => $patient->name,
                'date_of_birth' => $patient->date_of_birth?->format('Y-m-d'),
                'gender' => $patient->gender,
                'phone' => $patient->phone,
                'formatted_phone' => $patient->formatted_phone,
                'email' => $patient->email,
                'address' => $latestAddress ?? 'Not provided',
                'insurance' => $latestIntake['insurance'] ?? $latestIntake['hmo'] ?? 'None / Self-pay',
                'preferred_contact' => $latestIntake['contact_preference'] ?? 'SMS',
                'preferred_dentist' => $preferredDentist ?? 'Dr. Angela Cerillo',
                'last_visit' => $lastVisitDate ?? $latestLastVisit ?? 'First visit',
                'next_appointment' => $nextApptDate ?? 'None scheduled',
                'concern' => $latestConcern ?? 'General dental checkup',
                'anxiety' => $latestAnxiety ?? 'Low',
                'allergies' => $latestAllergies ?? 'None reported',
                'medications' => $latestMedications ?? 'None',
                'medical_history' => $latestMedicalHistory ?? 'No known systemic conditions',
            ],
            'intake' => $latestIntake,
            'teeth' => $teethRecords,
            'chart_entries' => $chartEntries,
            'xrays' => $allXrays,
            'visits' => $patient->appointments->where('status', 'Completed')->values()->map(function ($a) {
                $session = $a->clinicalSession;
                $findings = $session?->clinical_findings;
                if (is_array($findings)) {
                    $findings = implode("\n", array_filter($findings));
                }

                $prescriptionText = $session?->prescriptions;
                if (($prescriptionText === null || trim((string) $prescriptionText) === '') && $session) {
                    $prescriptionText = $session->prescriptionRecords
                        ->map(function ($rx) {
                            $lines = array_filter([
                                $rx->medication ? 'Medication: '.$rx->medication : null,
                                $rx->dosage ? 'Dosage: '.$rx->dosage : null,
                                $rx->frequency ? 'Frequency: '.$rx->frequency : null,
                                $rx->instructions ? 'Instructions: '.$rx->instructions : null,
                            ]);

                            return implode("\n", $lines);
                        })
                        ->filter()
                        ->implode("\n\n");
                }

                return [
                    'id' => $a->id,
                    'starts_at' => $a->starts_at?->toIso8601String(),
                    'ends_at' => $a->ends_at?->toIso8601String(),
                    'status' => $a->status,
                    'service' => $a->service?->name ?? 'Dental Procedure',
                    'service_price' => (float) ($a->service?->price ?? 0),
                    'dentist' => $a->dentist?->name ?? 'Attending Dentist',
                    'dentist_id' => $a->dentist_id,
                    'clinical_findings' => $findings ?: 'No clinical findings recorded.',
                    'diagnosis' => $session?->diagnosis ?: 'No diagnosis recorded.',
                    'treatment_recommendations' => $session?->treatment_recommendations ?: 'Routine oral care and recall.',
                    'dentist_notes' => $session?->dentist_notes ?: ($a->treatment_notes ?: 'No dentist notes recorded.'),
                    'treatment_notes' => $session?->treatment_notes ?: ($a->treatment_notes ?: null),
                    'prescriptions' => $prescriptionText ?: null,
                    'xrays' => $session?->xrays ?? [],
                    'finalized_at' => $session?->finalized_at?->toIso8601String(),
                ];
            }),
            'transactions' => $transactions->map(fn ($t) => [
                'id' => $t->id,
                'created_at' => $t->created_at?->toIso8601String(),
                'reference' => 'INV-'.str_pad($t->id, 4, '0', STR_PAD_LEFT),
                'description' => $t->service?->name ?? $t->appointment?->service?->name ?? 'Dental Treatment',
                'amount' => (float) $t->amount,
                'payment_method' => $t->payment_method,
                'status' => $t->status,
            ]),
            'billing_items' => $billingItems,
            'active_appointment' => ($activeItem = $billingItems->first()) ? [
                'id' => $activeItem['appointment_id'],
                'service_id' => $activeItem['service_id'],
                'service_name' => $activeItem['service_name'],
                'service_price' => $activeItem['service_price'],
                'balance' => $activeItem['balance'],
                'installment_eligible' => $activeItem['installment_eligible'],
                'status' => $activeItem['status'],
                'starts_at' => $activeItem['starts_at'],
            ] : null,
            'summary' => [
                'total_charges' => $totalCharges,
                'total_payments' => $totalPayments,
                'balance' => $balance,
            ],
        ]);
    }

    public function payments(Request $r)
    {
        return Transaction::query()->with(['appointment.service', 'appointment.dentist', 'patient', 'service', 'recordedBy'])->when($r->filled('patient_id'), fn ($q) => $q->where('patient_id', $r->patient_id))->latest()->paginate($r->integer('per_page', 25));
    }

    public function paymentPdf(Request $r, Transaction $transaction)
    {
        $transaction->load(['appointment.service', 'appointment.dentist', 'patient', 'service', 'recordedBy']);
        $pdf = SimpleReceiptPdf::make($transaction);
        $filename = 'Cerillo-Receipt-TXN-'.str_pad((string) $transaction->id, 5, '0', STR_PAD_LEFT).'.pdf';

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Cache-Control' => 'private, no-store, max-age=0',
        ]);
    }

    public function emailPaymentReceipt(Request $r, Transaction $transaction)
    {
        $transaction->load(['appointment.service', 'appointment.dentist', 'patient', 'service', 'recordedBy']);
        $email = $transaction->patient?->email ?: $transaction->appointment?->guest_email;
        abort_unless($email, 422, 'This patient does not have an email address on file.');

        $patientName = $transaction->patient?->name ?: $transaction->appointment?->guest_name ?: 'Patient';
        $serviceName = $transaction->service?->name ?: $transaction->appointment?->service?->name ?: 'Dental Treatment';
        $receipt = 'TXN-'.str_pad((string) $transaction->id, 5, '0', STR_PAD_LEFT);
        $amount = number_format((float) $transaction->amount, 2);
        $pdf = SimpleReceiptPdf::make($transaction);

        Mail::raw(
            "Dear {$patientName},\n\nAttached is your Cerillo Dental Clinic payment receipt {$receipt}.\n"
            ."Service: {$serviceName}\nAmount paid: PHP {$amount}\nPayment method: {$transaction->payment_method}\n\n"
            ."Thank you,\nCerillo Dental Clinic",
            function ($message) use ($email, $receipt, $pdf): void {
                $message->to($email)
                    ->subject('Cerillo Dental Clinic Payment Receipt '.$receipt)
                    ->attachData($pdf, $receipt.'.pdf', ['mime' => 'application/pdf']);
            }
        );

        return response()->json(['message' => 'Receipt sent to '.$email.'.', 'email' => $email]);
    }

    public function dashboard(Request $r)
    {
        $today = Carbon::today();
        $user = $r->user();
        $scope = function ($query) use ($r, $user) {
            if ($user && ($user->role === 'dentist' || ($user->role === 'admin' && $r->query('view') === 'dentist'))) {
                $query->where('dentist_id', $user->id);
            }

            return $query;
        };
        $todayRows = $scope(Appointment::query()->whereDate('starts_at', $today))->with(['service', 'dentist', 'patient'])->get();
        $queueQuery = Appointment::with(['patient', 'service', 'dentist'])
            ->whereDate('starts_at', $today);
        if ($user?->role === 'front_desk') {
            // Front Desk queue is an arrival queue, not the full appointment register.
            $queueQuery->where('status', 'Checked In')
                ->orderByRaw('COALESCE(checked_in_at, starts_at) asc');
        } else {
            $queueQuery->whereIn('status', ['In Progress', 'Checked In', 'Scheduled', 'Pending', 'Completed'])
                ->orderByRaw("CASE WHEN status = 'In Progress' THEN 1 WHEN status = 'Checked In' THEN 2 WHEN status = 'Scheduled' THEN 3 WHEN status = 'Pending' THEN 4 WHEN status = 'Completed' THEN 5 ELSE 6 END")
                ->orderBy('starts_at');
        }
        $queueAppointments = $queueQuery->get();
        $weekStart = now()->startOfWeek();
        $weekRows = $scope(Appointment::query()->whereBetween('starts_at', [$weekStart->copy()->startOfDay(), $weekStart->copy()->addDays(6)->endOfDay()]))->get(['id', 'starts_at', 'status', 'dentist_id']);
        $statusCounts = $todayRows->groupBy('status')->map->count();
        $payments = Transaction::query()->where('status', 'completed')->whereDate('created_at', $today)
            ->when($user && ($user->role === 'dentist' || ($user->role === 'admin' && $r->query('view') === 'dentist')), fn ($q) => $q->whereHas('appointment', fn ($a) => $a->where('dentist_id', $user->id)))
            ->get(['amount', 'payment_method']);
        $dailyTotals = collect(range(0, 6))->mapWithKeys(function ($offset) use ($weekStart, $weekRows) {
            $date = $weekStart->copy()->addDays($offset);

            return [$date->toDateString() => $weekRows->filter(fn ($row) => $row->starts_at->isSameDay($date))->count()];
        });

        // Patient balances calculation
        $patientsWithAppointments = PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed'))
            ->with(['appointments.service', 'transactions'])
            ->get();
        $outstandingTotal = 0;
        $outstandingCount = 0;
        $partialCount = 0;
        $partialTotal = 0;
        foreach ($patientsWithAppointments as $pat) {
            $charges = (float) $pat->appointments->whereIn('status', ['Completed', 'In Progress', 'Checked In'])->sum(fn ($a) => (float) ($a->service?->price ?? 0));
            $paid = (float) $pat->transactions->where('status', 'completed')->sum('amount');
            $bal = max(0, $charges - $paid);
            if ($bal > 0) {
                $outstandingTotal += $bal;
                $outstandingCount++;
                if ($paid > 0) {
                    $partialCount++;
                    $partialTotal += $bal;
                }
            }
        }

        // Recent activity
        $recentTransactions = Transaction::with(['patient', 'appointment.service', 'recordedBy'])
            ->latest('created_at')
            ->limit(10)
            ->get()
            ->map(function ($t) {
                $pName = $t->patient?->name ?? $t->appointment?->guest_name ?? 'Guest patient';

                return [
                    'date' => $t->created_at?->format('M d, Y · g:i A'),
                    'time_ago' => $t->created_at?->diffForHumans(),
                    'timestamp' => $t->created_at?->timestamp ?? 0,
                    'user' => $t->recordedBy?->name ?? 'Front Desk',
                    'module' => 'Payments',
                    'title' => 'Payment recorded',
                    'description' => '₱'.number_format($t->amount, 2).' received from '.$pName.' ('.$t->payment_method.').',
                ];
            });

        $recentAppointments = Appointment::with(['patient', 'service', 'dentist'])
            ->latest('updated_at')
            ->limit(10)
            ->get()
            ->map(function ($a) {
                $pName = $a->patient?->name ?? $a->guest_name ?? 'Guest patient';
                $sName = $a->service?->name ?? 'Appointment';
                $dName = $a->dentist?->name ?? 'Clinic Staff';
                $title = match ($a->status) {
                    'Checked In' => 'Appointment checked in',
                    'In Progress' => 'Assessment started',
                    'Completed' => 'Visit completed',
                    'Cancelled' => 'Appointment cancelled',
                    default => 'Appointment scheduled',
                };

                return [
                    'date' => $a->updated_at?->format('M d, Y · g:i A'),
                    'time_ago' => $a->updated_at?->diffForHumans(),
                    'timestamp' => $a->updated_at?->timestamp ?? 0,
                    'user' => $dName,
                    'module' => 'Appointments',
                    'title' => $title,
                    'description' => $pName.' — '.$sName.' ('.$a->status.').',
                ];
            });

        $recentPatients = PatientRecord::latest('created_at')
            ->limit(5)
            ->get()
            ->map(function ($p) {
                return [
                    'date' => $p->created_at?->format('M d, Y · g:i A'),
                    'time_ago' => $p->created_at?->diffForHumans(),
                    'timestamp' => $p->created_at?->timestamp ?? 0,
                    'user' => 'Clinic Staff',
                    'module' => 'Patients',
                    'title' => 'Patient record created',
                    'description' => 'Medical file opened for '.$p->name.' ('.$p->patient_code.').',
                ];
            });

        $recentActivityLimit = $user && $user->role === 'admin' && $r->query('view') !== 'dentist' ? 10 : 8;
        $recentActivity = $recentTransactions->concat($recentAppointments)->concat($recentPatients)
            ->sortByDesc('timestamp')
            ->values()
            ->take($recentActivityLimit);

        // Patient visits trend across week Mon-Sun
        $visitsTrend = collect(range(0, 6))->map(function ($offset) use ($weekStart, $weekRows) {
            $date = $weekStart->copy()->addDays($offset);

            return [
                'day' => $date->format('D'),
                'date' => $date->toDateString(),
                'count' => $weekRows->filter(fn ($row) => $row->starts_at->isSameDay($date))->count(),
            ];
        });
        $trendTotalVisits = $visitsTrend->sum('count');

        // Clinic capacity
        $dentistsOnDuty = User::whereIn('role', ['dentist', 'admin'])->count();
        $operatoriesActive = Appointment::whereDate('starts_at', $today)->whereIn('status', ['Checked In', 'In Progress'])->count();
        $followUpsDue = PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed'))
            ->whereDoesntHave('appointments', fn ($q) => $q->where('starts_at', '>=', now()->subMonths(6)))
            ->count();
        $radiographsAdded = ClinicalSession::whereDate('created_at', $today)->count() + DentalChartEntry::whereDate('created_at', $today)->count();

        // Collections by method with all standard methods represented
        $methodOrder = ['GCash', 'Cash', 'Card', 'Maya', 'Bank Transfer'];
        $collectionsByMethod = [];
        foreach ($methodOrder as $method) {
            $collectionsByMethod[$method] = (float) $payments->where('payment_method', $method)->sum('amount');
        }
        foreach ($payments as $p) {
            if (! isset($collectionsByMethod[$p->payment_method])) {
                $collectionsByMethod[$p->payment_method] = (float) $payments->where('payment_method', $p->payment_method)->sum('amount');
            }
        }

        // Ortho braces installment metrics
        $orthoService = Service::where('name', 'like', '%Ortho%')->orWhere('name', 'like', '%Braces%')->first();
        $orthoServiceId = $orthoService?->id;
        $orthoActivePlans = $orthoServiceId
            ? Appointment::where('service_id', $orthoServiceId)->whereIn('status', ['Scheduled', 'Checked In', 'In Progress', 'Completed'])->count()
            : 0;
        $orthoCollectedMonth = $orthoServiceId
            ? (float) Transaction::where('service_id', $orthoServiceId)->where('status', 'completed')->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('amount')
            : 0;
        $orthoNextDue = $orthoActivePlans > 0 ? 3500 : 0;

        return [
            'date' => $today->toDateString(),
            'patients_today' => $todayRows->pluck('patient_id')->filter()->unique()->count() + $todayRows->whereNull('patient_id')->count(),
            'appointments_today' => $todayRows->count(),
            'upcoming_appointments' => $scope(Appointment::query()->where('starts_at', '>', now())->where('starts_at', '<=', now()->addDays(7))->whereNotIn('status', ['Cancelled', 'No-Show']))->count(),
            'walk_ins_today' => $todayRows->where('source', 'walk_in')->count(),
            'scheduled_arrivals_today' => $todayRows->where('source', '!=', 'walk_in')->whereIn('status', ['Checked In', 'In Progress', 'Completed'])->count(),
            'completed_today' => $todayRows->where('status', 'Completed')->count(),
            'scheduled_today' => $todayRows->whereIn('status', ['Pending', 'Scheduled', 'Checked In', 'In Progress'])->count(),
            'cancelled_today' => $todayRows->whereIn('status', ['Cancelled', 'No-Show'])->count(),
            'checked_in_today' => $todayRows->where('status', 'Checked In')->count(),
            'in_progress_today' => $todayRows->where('status', 'In Progress')->count(),
            'pending_verifications' => $scope(Appointment::query()->where('status', 'Pending Verification')->where('starts_at', '>=', now())->where('starts_at', '<=', now()->addHours(48)))->count(),
            'total_patients' => $scope(Appointment::query()->where('status', 'Completed'))->pluck('patient_id')->filter()->unique()->count(),
            'collections_today' => (float) $payments->sum('amount'),
            'payments_today' => $payments->count(),
            'status_counts' => $statusCounts,
            'daily_appointments' => $dailyTotals,
            'collections_by_method' => $collectionsByMethod,
            'appointments' => $todayRows,
            'queue_appointments' => $queueAppointments,
            'recent_appointments' => $scope(Appointment::query()->with(['service', 'dentist', 'patient'])->latest('starts_at'))->limit(8)->get(),
            'recent_activity' => $recentActivity,
            'patient_visits_trend' => [
                'days' => $visitsTrend,
                'total' => $trendTotalVisits,
            ],
            'clinic_capacity' => [
                'dentists_on_duty' => $dentistsOnDuty,
                'operatories_active' => $operatoriesActive,
                'follow_ups_due' => $followUpsDue,
                'radiographs_added' => $radiographsAdded,
            ],
            'ortho_installments' => [
                'active_plans' => $orthoActivePlans,
                'next_due' => $orthoNextDue,
                'collected_this_month' => $orthoCollectedMonth,
            ],
            'billing_kpis' => [
                'collected_today' => (float) $payments->sum('amount'),
                'payments_today' => $payments->count(),
                'outstanding_total' => $outstandingTotal,
                'outstanding_patients_count' => $outstandingCount,
                'partial_total' => $partialTotal,
                'partial_count' => $partialCount,
                'adjustments_month' => (float) Transaction::where('status', 'voided')->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year)->sum('amount'),
            ],
            'patient_kpis' => [
                'total_registered_patients' => PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed'))->count(),
                'new_registrations_month' => PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed'))->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
                'month_name' => now()->format('F Y'),
                'recall_contacts_due' => $followUpsDue,
                'profiles_needing_update' => PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed'))->where(fn ($q) => $q->whereNull('phone')->orWhere('phone', '')->orWhereNull('email')->orWhere('email', '')->orWhereNull('date_of_birth'))->count(),
                'accounts_with_balance' => $outstandingCount,
                'outstanding_balance' => $outstandingTotal,
            ],
        ];
    }

    public function reports(Request $r)
    {
        abort_unless($r->user()?->role === 'admin', 403);

        $filter = $r->input('period', 'this_month');
        $now = now();

        switch ($filter) {
            case 'past_3_months':
                $start = $now->copy()->subMonths(3)->startOfDay();
                $end = $now->copy()->endOfDay();
                $periodLabel = 'Past 3 Months';
                break;
            case 'past_6_months':
                $start = $now->copy()->subMonths(6)->startOfDay();
                $end = $now->copy()->endOfDay();
                $periodLabel = 'Past 6 Months';
                break;
            case 'this_year':
                $start = $now->copy()->startOfYear();
                $end = $now->copy()->endOfDay();
                $periodLabel = 'This Year ('.$now->year.')';
                break;
            case 'custom':
                $start = $r->filled('from') ? Carbon::parse($r->from)->startOfDay() : $now->copy()->startOfMonth();
                $end = $r->filled('to') ? Carbon::parse($r->to)->endOfDay() : $now->copy()->endOfDay();
                $periodLabel = $start->format('M d, Y').' – '.$end->format('M d, Y');
                break;
            case 'this_month':
            default:
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                $periodLabel = $now->format('F Y');
                break;
        }

        $appts = Appointment::whereBetween('starts_at', [$start, $end])->with(['service', 'patient', 'dentist'])->get();
        $completedCount = $appts->where('status', 'Completed')->count();
        $cancelledCount = $appts->where('status', 'Cancelled')->count();
        $noShowCount = $appts->where('status', 'No-Show')->count();
        $totalNonPending = $appts->whereNotIn('status', ['Pending', 'Pending Verification'])->count();
        $completionRate = $totalNonPending > 0 ? round(($completedCount / $totalNonPending) * 100, 1) : 100;
        $cancellationRate = $appts->count() > 0 ? round((($cancelledCount + $noShowCount) / $appts->count()) * 100, 1) : 0;

        $patientsServed = PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed')->whereBetween('starts_at', [$start, $end]))->count();
        $newPatients = PatientRecord::whereBetween('created_at', [$start, $end])->count();

        $transactions = Transaction::where('status', 'completed')->whereBetween('created_at', [$start, $end])->get();
        $totalRevenue = (float) $transactions->sum('amount');

        // Monthly visits chart (last 6 months)
        $monthCount = 6;
        $monthlyVisits = [];
        $maxVisits = 1;
        for ($i = $monthCount - 1; $i >= 0; $i--) {
            $mStart = $now->copy()->subMonths($i)->startOfMonth();
            $mEnd = $now->copy()->subMonths($i)->endOfMonth();
            $count = Appointment::where('status', 'Completed')->whereBetween('starts_at', [$mStart, $mEnd])->count();
            if ($count > $maxVisits) {
                $maxVisits = $count;
            }
            $monthlyVisits[] = [
                'month' => $mStart->format('M'),
                'count' => $count,
                'year' => $mStart->format('Y'),
            ];
        }
        foreach ($monthlyVisits as &$mv) {
            $mv['height_percent'] = max(6, round(($mv['count'] / $maxVisits) * 100));
        }
        unset($mv);

        // Service utilization
        $services = Service::where('active', true)->get()->map(function ($svc) use ($appts) {
            $count = $appts->where('service_id', $svc->id)->count();

            return [
                'name' => $svc->name,
                'cases' => $count,
                'price' => (float) $svc->price,
            ];
        })->sortByDesc('cases')->values();
        $totalCases = $services->sum('cases');
        $services = $services->map(function ($s) use ($totalCases) {
            $s['share'] = $totalCases > 0 ? round(($s['cases'] / $totalCases) * 100) : 0;

            return $s;
        });

        $recallDue = PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed'))
            ->whereDoesntHave('appointments', fn ($q) => $q->where('starts_at', '>=', now()->subMonths(6)))
            ->count();
        $activeTreatmentPlans = Appointment::whereIn('status', ['Scheduled', 'Checked In', 'In Progress'])->count();

        return response()->json([
            'period' => $filter,
            'period_label' => $periodLabel,
            'from' => $start->toDateString(),
            'to' => $end->toDateString(),
            'patients_served' => $patientsServed,
            'completed_visits' => $completedCount,
            'completion_rate' => $completionRate,
            'cancelled_visits' => $cancelledCount,
            'no_show_visits' => $noShowCount,
            'cancellation_rate' => $cancellationRate,
            'total_revenue' => $totalRevenue,
            'new_patients' => $newPatients,
            'monthly_visits' => $monthlyVisits,
            'services' => $services,
            'recall_due' => $recallDue,
            'active_treatment_plans' => $activeTreatmentPlans,
            'appointment_details' => $appts->sortByDesc('starts_at')->values()->map(fn ($appt) => [
                'id' => $appt->id,
                'date' => $appt->starts_at?->format('M d, Y'),
                'time' => $appt->starts_at?->format('g:i A'),
                'patient' => $appt->patient?->name ?? $appt->guest_name ?? 'Guest',
                'dentist' => $appt->dentist?->name ?? 'Unassigned',
                'service' => $appt->service?->name ?? 'Service not specified',
                'status' => $appt->status,
            ])->all(),
            'total_appointments' => $appts->count(),
        ]);
    }

    public function activity(Request $r)
    {
        abort_unless(in_array($r->user()?->role, ['admin', 'dentist', 'front_desk'], true), 403);

        $filter = $r->input('date_filter', 'all');
        $search = strtolower(trim((string) $r->input('search', '')));
        $now = now();

        $txQuery = Transaction::with(['patient', 'appointment.service', 'recordedBy'])->latest('created_at');
        $apptQuery = Appointment::with(['patient', 'service', 'dentist'])->latest('updated_at');
        $patQuery = PatientRecord::latest('created_at');

        if ($filter === 'today') {
            $txQuery->whereDate('created_at', $now->toDateString());
            $apptQuery->whereDate('updated_at', $now->toDateString());
            $patQuery->whereDate('created_at', $now->toDateString());
        } elseif ($filter === 'this_week') {
            $wStart = $now->copy()->startOfWeek();
            $wEnd = $now->copy()->endOfWeek();
            $txQuery->whereBetween('created_at', [$wStart, $wEnd]);
            $apptQuery->whereBetween('updated_at', [$wStart, $wEnd]);
            $patQuery->whereBetween('created_at', [$wStart, $wEnd]);
        } elseif ($filter === 'this_month') {
            $mStart = $now->copy()->startOfMonth();
            $mEnd = $now->copy()->endOfMonth();
            $txQuery->whereBetween('created_at', [$mStart, $mEnd]);
            $apptQuery->whereBetween('updated_at', [$mStart, $mEnd]);
            $patQuery->whereBetween('created_at', [$mStart, $mEnd]);
        } elseif ($filter === 'custom' && ($r->filled('from') || $r->filled('to'))) {
            $from = $r->filled('from') ? Carbon::parse($r->from)->startOfDay() : $now->copy()->subMonths(1);
            $to = $r->filled('to') ? Carbon::parse($r->to)->endOfDay() : $now->copy()->endOfDay();
            $txQuery->whereBetween('created_at', [$from, $to]);
            $apptQuery->whereBetween('updated_at', [$from, $to]);
            $patQuery->whereBetween('created_at', [$from, $to]);
        }

        $events = collect();

        foreach ($txQuery->limit(50)->get() as $t) {
            $pName = $t->patient?->name ?? $t->appointment?->guest_name ?? 'Guest patient';
            $userName = $t->recordedBy?->name ?? 'Front Desk';
            $desc = 'Recorded payment of ₱'.number_format($t->amount, 2).' for '.$pName.' ('.$t->payment_method.').';
            $events->push([
                'id' => 'tx-'.$t->id,
                'raw_date' => $t->created_at?->toDateString(),
                'date' => $t->created_at?->format('M d, Y · g:i A'),
                'timestamp' => $t->created_at?->timestamp ?? 0,
                'user' => $userName,
                'module' => 'Payments',
                'activity' => $desc,
            ]);
        }

        foreach ($apptQuery->limit(50)->get() as $a) {
            $pName = $a->patient?->name ?? $a->guest_name ?? 'Guest patient';
            $userName = $a->dentist?->name ?? 'Front Desk';
            $sName = $a->service?->name ?? 'Dental Procedure';
            $desc = $a->status.' appointment for '.$pName.' ('.$sName.').';
            $events->push([
                'id' => 'appt-'.$a->id,
                'raw_date' => $a->updated_at?->toDateString(),
                'date' => $a->updated_at?->format('M d, Y · g:i A'),
                'timestamp' => $a->updated_at?->timestamp ?? 0,
                'user' => $userName,
                'module' => 'Appointments',
                'activity' => $desc,
            ]);
        }

        foreach ($patQuery->limit(25)->get() as $p) {
            $events->push([
                'id' => 'pat-'.$p->id,
                'raw_date' => $p->created_at?->toDateString(),
                'date' => $p->created_at?->format('M d, Y · g:i A'),
                'timestamp' => $p->created_at?->timestamp ?? 0,
                'user' => 'Clinic Staff',
                'module' => 'Patients',
                'activity' => 'Created patient record for '.$p->name.' ('.$p->patient_code.').',
            ]);
        }

        if ($search !== '') {
            $events = $events->filter(function ($e) use ($search) {
                return str_contains(strtolower($e['activity']), $search)
                    || str_contains(strtolower($e['user']), $search)
                    || str_contains(strtolower($e['module']), $search);
            });
        }

        $sorted = $events->sortByDesc('timestamp')->values()->take(100);

        return response()->json($sorted);
    }
}
