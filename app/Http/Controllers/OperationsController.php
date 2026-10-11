<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DentistBlock;
use App\Models\PatientRecord;
use App\Models\Service;
use App\Models\Tooth;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->user()->role;
        abort_unless(in_array($role, ['dentist', 'front_desk'], true), 403);
        $appointments = Appointment::with(['service', 'dentist', 'patient'])
            ->when($role === 'dentist', fn ($q) => $q->where('dentist_id', $request->user()->id))
            ->orderByDesc('starts_at')->limit(150)->get();
        $patients = PatientRecord::query()
            ->whereHas('appointments', function ($a) use ($role, $request) {
                $a->where('status', 'Completed');
                if ($role === 'dentist') {
                    $a->where('dentist_id', $request->user()->id);
                }
            })
            ->orderBy('name')->limit(150)->get();
        $dentists = $role === 'dentist' ? User::whereKey($request->user()->id)->get() : User::whereIn('role', ['dentist', 'admin'])->orderBy('name')->get();
        $blocks = DentistBlock::with('dentist')->when($role === 'dentist', fn ($q) => $q->where('dentist_id', $request->user()->id))->orderByDesc('starts_at')->limit(100)->get();
        $transactions = $role === 'dentist' ? collect() : Transaction::with('appointment.service')->latest()->limit(100)->get();
        $today = $appointments->filter(fn ($a) => $a->starts_at->isToday());

        return view('operations.index', compact('role', 'appointments', 'patients', 'dentists', 'transactions', 'today'))
            ->with('blocks', $blocks)->with('services', Service::orderBy('name')->get())
            ->with('teeth', Tooth::orderBy('fdi_number')->get());
    }
}
