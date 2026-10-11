<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="Cerillo Dental Clinic Front Desk workspace" name="description"/>
<title>
   Front Desk · Cerillo Dental Clinic
  </title>
<link href="<?php echo e(asset('assets/images/cerillo-logo.png')); ?>" rel="icon"/>
<link href="<?php echo e(asset('assets/css/app.css')); ?>" rel="stylesheet"/>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"><link rel="stylesheet" href="<?php echo e(asset('assets/css/clinic-fixes.css')); ?>">
<style>
body[data-workspace-role="front_desk"] .front-appointment-dental-chart {
  display: none !important;
}
</style>
<link rel="stylesheet" href="/assets/css/cerillo-responsive.css">
<script src="/assets/js/cerillo-format.js"></script>
</head>
<body class="workspace-body" data-workspace-role="front_desk">
<aside class="workspace-sidebar">
<a class="workspace-brand" href="<?php echo e(route('booking')); ?>">
<img alt="Cerillo Dental Clinic logo" src="<?php echo e(asset('assets/images/cerillo-logo.png')); ?>"/>
<span>
     Cerillo
     <small>
      Dental Clinic
     </small>
</span>
</a>
<div class="role-label">
    Front Desk Workspace
   </div>
<nav aria-label="Front Desk navigation" class="side-nav">
<a class="side-link" href="#dashboard">
<span>
      Dashboard
     </span>
</a>
<a class="side-link" href="#appointments">
<span>
      Appointments
     </span>
</a>
<a class="side-link" href="#queue">
<span>
      Patient Queue
     </span>
</a>
<a class="side-link" href="#patients">
<span>
      Patients
     </span>
</a>
<a class="side-link" href="#payments">
<span>
      Payments
     </span>
</a>

<a class="side-link" href="#settings">
<span>
      Settings
     </span>
</a>
</nav>
<div class="sidebar-profile">
<div class="avatar">
     F
    </div>
<div>
<strong>
      Front Desk
     </strong>
<small>
      Front Desk
     </small>
</div>
<button aria-label="Sign out" class="sidebar-logout" onclick="document.getElementById('logoutConfirmModal').showModal()" type="button">
     ↪
    </button>
</div>
</aside>
<main class="workspace-main">
<header class="workspace-topbar">
<div>
<p class="eyebrow">
      Cerillo Dental Clinic
     </p>
<h1>
      Front Desk Workspace
     </h1>
</div>
<div aria-label="Current date and time" class="topbar-clock">
<span data-live-date="">
      October 5, 2026
     </span>
<strong data-live-time="">
      --:-- --
     </strong>
</div>
</header>
<section class="workspace-section active-section" id="dashboard">
<div class="section-heading">
<div>
<p class="eyebrow">
       Reception workspace
      </p>
<h2>
       Front Desk Dashboard
      </h2>
<p>
       Monitor today's appointments, arrivals, completed visits and collections.
      </p>
</div>
</div>
<div class="stats-grid">
<article class="stat-card" data-dashboard-metric="scheduled_arrivals_today">
<p>
       Appointments Today
      </p>
<strong><?php echo e($metrics['arrived_scheduled_today']); ?></strong>
<span>Scheduled patients who arrived today</span>
</article>
<article class="stat-card" data-dashboard-metric="walk_ins_today">
<p>Walk-ins Today</p>
<strong><?php echo e($metrics['walk_ins_today']); ?></strong>
<span>Walk-in appointments logged today</span>
</article>
<article class="stat-card" data-dashboard-metric="completed_today">
<p>
       Completed
      </p>
<strong><?php echo e($metrics['completed_today']); ?></strong>
<span>Completed appointments today</span>
</article>
<article class="stat-card" data-dashboard-metric="patients_today">
<p>Total Patients Today</p>
<strong><?php echo e($metrics['total_patients_today']); ?></strong>
<span>Unique patients and guest visits today</span>
</article>
</div>
<div class="panel table-panel">
<div class="table-wrap">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="front-desk-table-1" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="front-desk-table-1">
<option value="">
         Sort: Default
        </option>
<option value="asc">
         A–Z / Oldest first
        </option>
<option value="desc">
         Z–A / Newest first
        </option>
</select>
<details class="filter-popover" data-filter-for="front-desk-table-1">
<summary aria-label="Open table filters" class="filter-icon-trigger" title="Filter table">
<svg aria-hidden="true" viewbox="0 0 24 24">
<path d="M4 6h16M7 12h10M10 18h4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.8">
</path>
</svg>
</summary>
<div class="filter-popover-panel">
<div class="filter-popover-heading">
<strong>
           Filter &amp; refine
          </strong>
<small>
           Narrow the records in this table.
          </small>
</div>
<label>
          Search rows
          <input data-filter-query="" placeholder="Type patient, dentist, status..." type="search"/>
</label>
<label>
          Quick status
          <select data-filter-status="">
<option value="">
            All statuses
           </option>
<option>
            Completed
           </option>
<option>
            Checked In
           </option>
<option>
            Pending
           </option>
</select>
</label>
<div class="filter-popover-actions">
<button class="btn secondary sm" data-filter-reset="" type="button">
           Reset
          </button>
<button class="btn sm" data-filter-apply="" type="button">
           Apply
          </button>
</div>
</div>
</details>
</div>
<table id="front-desk-table-1">
<thead>
<tr>
<th>
          Time
         </th>
<th>
          Patient
         </th>
<th>
          Service
         </th>
<th>
          Dentist
         </th>
<th>
          Status
         </th>
</tr>
</thead>
<tbody>
<tr>
<td>
          8:30 AM
         </td>
<td>
          Maria Santos
         </td>
<td>
          Oral Prophylaxis
         </td>
<td>
          Dr. Ana Cerillo
         </td>
<td>
<span class="status success">
           Completed
          </span>
</td>
</tr>
<tr>
<td>
          9:30 AM
         </td>
<td>
          Joshua Lim
         </td>
<td>
          Composite Restoration
         </td>
<td>
          Dr. Ana Cerillo
         </td>
<td>
<span class="status info">
           Checked In
          </span>
</td>
</tr>
<tr>
<td>
          10:30 AM
         </td>
<td>
          Andrea Cruz
         </td>
<td>
          Root Canal Therapy
         </td>
<td>
          Dr. Paolo Reyes
         </td>
<td>
<span class="status warning">
           Pending
          </span>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</section>
<section class="workspace-section" id="appointments">
<div class="section-heading">
<div>
<p class="eyebrow">
       Registration &amp; Scheduling
      </p>
<h2>
       Appointments
      </h2>
<p>
       Register the patient and complete their appointment request in one continuous workflow.
      </p>
</div>
<button class="btn" onclick="document.getElementById('registerAppointmentModal').showModal()" type="button">
      + Register &amp; Book Appointment
     </button>
</div><div class="panel front-public-request-panel" id="publicAppointmentRequestsPanel"><div class="panel-heading"><div><p class="eyebrow">Online requests</p><h3>Appointment Requests</h3><p>Requests submitted from the public website require Front Desk review before they become appointments.</p></div><span class="badge warning" id="publicRequestCount">0 pending</span></div><div class="request-list" id="publicRequestList"></div></div>
<div class="stats-grid">
<article class="stat-card" data-dashboard-metric="appointments_today"><p>Appointments Today</p><strong>0</strong><span>All scheduled and walk-in visits</span></article>
<article class="stat-card" data-dashboard-metric="upcoming_appointments"><p>Upcoming</p><strong>0</strong><span>Next 7 days</span></article>
<article class="stat-card" data-dashboard-metric="completed_today"><p>Completed</p><strong>0</strong><span>Completed visits today</span></article>
<article class="stat-card" data-dashboard-metric="cancelled_today"><p>Cancelled / No-show</p><strong>0</strong><span>Today's exceptions</span></article>
</div>
<div class="weekly-calendar-scroll">
<div class="mini-week-strip">
<article>
<strong>
        Mon 5
       </strong>
<span>
        18 bookings
       </span>
</article>
<article>
<strong>
        Tue 6
       </strong>
<span>
        16 bookings
       </span>
</article>
<article>
<strong>
        Wed 7
       </strong>
<span>
        14 bookings
       </span>
</article>
<article>
<strong>
        Thu 8
       </strong>
<span>
        Dr. Ana unavailable PM
       </span>
</article>
<article>
<strong>
        Fri 9
       </strong>
<span>
        20 bookings
       </span>
</article>
<article>
<strong>
        Sat 10
       </strong>
<span>
        8 bookings
       </span>
</article>
</div>
</div>
<div class="panel table-panel">
<div class="table-wrap">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="front-appointment-register" placeholder="Search records..." type="search"/>
<select aria-label="Filter appointments by status" class="table-sort-control" id="frontAppointmentFilterStatus" data-table-status-filter="front-appointment-register">
<option value="">
         All Statuses
        </option>
<option value="Checked In">
         Checked In
        </option>
<option value="Pending">
         Pending
        </option>
<option value="Completed">
         Completed
        </option>
</select>
<input aria-label="Filter appointments by date" class="table-search table-search-inline" id="frontAppointmentFilterDate" data-table-date-filter="front-appointment-register" type="date" title="Filter by date" style="max-width:160px;padding:7px 10px;"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="front-appointment-register">
<option value="">
         Sort: Default
        </option>
<option value="asc">
         A–Z / Oldest first
        </option>
<option value="desc">
         Z–A / Newest first
        </option>
</select>
<details class="filter-popover" data-filter-for="front-appointment-register">
<summary aria-label="Open table filters" class="filter-icon-trigger" title="Filter table">
<svg aria-hidden="true" viewbox="0 0 24 24">
<path d="M4 6h16M7 12h10M10 18h4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.8">
</path>
</svg>
</summary>
<div class="filter-popover-panel">
<div class="filter-popover-heading">
<strong>
           Filter &amp; refine
          </strong>
<small>
           Narrow the records in this table.
          </small>
</div>
<label>
          Search rows
          <input data-filter-query="" placeholder="Patient, dentist, service..." type="search"/>
</label>
<label>
          Quick status
          <select data-filter-status="">
<option value="">
            All statuses
           </option>
<option value="Checked In">
            Checked In
           </option>
<option value="Pending">
            Pending
           </option>
<option value="Completed">
            Completed
           </option>
</select>
</label>
<label>
          Date
          <input data-filter-date="" type="date"/>
</label>
<div class="filter-popover-actions">
<button class="btn secondary sm" data-filter-reset="" type="button">
           Reset
          </button>
<button class="btn sm" data-filter-apply="" type="button">
           Apply
          </button>
</div>
</div>
</details>
</div>
<table id="front-appointment-register">
<thead>
<tr>
<th>
          Patient
         </th>
<th>
          Dentist
         </th>
<th>
          Service
         </th>
<th>
          Date
         </th>
<th>
          Time
         </th>
<th>
          Status
         </th>
<th>
          Action
         </th>
</tr>
</thead>
<tbody>
@forelse($appointments as $appt)
@php
  $patientName = $appt->patient?->name ?? $appt->guest_name;
  $patientCode = $appt->patient?->formatted_patient_code ?? 'Pending registration';
  $dentistName = $appt->dentist?->name ?? 'Unassigned';
  $serviceName = $appt->service?->name ?? 'Dental Examination';
  $dateFormatted = $appt->starts_at->format('d M Y');
  $timeFormatted = $appt->starts_at->format('g:i A');
  $isoDate = $appt->starts_at->format('Y-m-d');
  $arrivalFormatted = $appt->checked_in_at ? \Illuminate\Support\Carbon::parse($appt->checked_in_at)->format('g:i A') : '—';
  $statusClass = match($appt->status) {
    'Checked In' => 'info',
    'Completed' => 'success',
    'In Progress' => 'primary',
    'Cancelled' => 'danger',
    default => 'warning',
  };
@endphp
<tr data-filter-tags="{{ $appt->status }}" data-status="{{ $appt->status }}" data-date="{{ $isoDate }}" data-appointment-id="{{ $appt->id }}">
<td>
<strong>
{{ $patientName }}
</strong>
<small class="table-subtext">
{{ $patientCode }}
</small>
</td>
<td data-clinician-id="{{ $appt->dentist_id ?? '' }}">{{ $dentistName }}</td>
<td>
{{ $serviceName }}
</td>
<td>
{{ $dateFormatted }}
</td>
<td>
{{ $timeFormatted }}
</td>
<td>
@if($appt->status === 'Checked In' && $appt->checked_in_at)
<span class="arrival-state arrived">
{{ $arrivalFormatted }}
</span>
@else
<span class="status {{ $statusClass }}">
{{ $appt->status }}
</span>
@endif
</td>
<td>
<button class="table-action appointment-view" data-appointment-id="{{ $appt->id }}" data-patient-id="{{ $appt->patient_id ?? '' }}" data-arrival="{{ $arrivalFormatted }}" data-datetime="{{ $dateFormatted }} · {{ $timeFormatted }}" data-dentist="{{ $dentistName }}" data-patient="{{ $patientName }}" data-service="{{ $serviceName }}" data-status="{{ $appt->status }}" type="button">
View
</button>
</td>
</tr>
@empty
<tr>
<td colspan="7" class="muted" style="text-align:center;padding:24px;">No appointments found.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
</section>
<section class="workspace-section" id="queue">
<div class="section-heading">
<div>
<p class="eyebrow">
       Patient flow
      </p>
<h2>
       Patient Queue
      </h2>
<p>
       Track arrivals from check-in through consultation and completion.
      </p>
</div>
</div>
<div class="panel table-panel">
<div class="table-wrap">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="front-desk-table-3" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="front-desk-table-3">
<option value="">
         Sort: Default
        </option>
<option value="asc">
         A–Z / Oldest first
        </option>
<option value="desc">
         Z–A / Newest first
        </option>
</select>
<details class="filter-popover" data-filter-for="front-desk-table-3">
<summary aria-label="Open table filters" class="filter-icon-trigger" title="Filter table">
<svg aria-hidden="true" viewbox="0 0 24 24">
<path d="M4 6h16M7 12h10M10 18h4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.8">
</path>
</svg>
</summary>
<div class="filter-popover-panel">
<div class="filter-popover-heading">
<strong>
           Filter &amp; refine
          </strong>
<small>
           Narrow the records in this table.
          </small>
</div>
<label>
          Search rows
          <input data-filter-query="" placeholder="Type patient, dentist, status..." type="search"/>
</label>
<div class="filter-popover-actions">
<button class="btn secondary sm" data-filter-reset="" type="button">
           Reset
          </button>
<button class="btn sm" data-filter-apply="" type="button">
           Apply
          </button>
</div>
</div>
</details>
</div>
<table id="front-desk-table-3">
<thead>
<tr>
<th>
          Queue
         </th>
<th>
          Patient
         </th>
<th>
          Appointment
         </th>
<th>
          Dentist
         </th>
<th>
          Waiting
         </th>
<th>
          Status
         </th>
</tr>
</thead>
<tbody id="frontQueueTableBody">
@forelse($queueAppointments as $index => $qAppt)
@php
  $qNum = 'Q-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
  $pName = $qAppt->patient?->name ?? $qAppt->guest_name;
  $time = $qAppt->starts_at->format('g:i A');
  $dentist = $qAppt->dentist?->name ?? 'Unassigned';
  $status = $qAppt->status;
  $waiting = '—';
  if ($status === 'Checked In' && $qAppt->checked_in_at) {
    $mins = max(0, (int) now()->diffInMinutes(\Illuminate\Support\Carbon::parse($qAppt->checked_in_at)));
    $waiting = $mins . ' min';
  } elseif ($status === 'In Progress') {
    $waiting = 'In Chair';
  } elseif ($status === 'Completed') {
    $waiting = 'Done';
  }
  $badgeClass = match($status) {
    'Checked In' => 'info',
    'In Progress' => 'primary',
    'Completed' => 'success',
    default => 'warning'
  };
@endphp
<tr data-appointment-id="{{ $qAppt->id }}" data-queue-num="{{ $qNum }}" data-status="{{ $status }}" data-filter-tags="{{ $status }}">
<td><strong>{{ $qNum }}</strong></td>
<td>
<strong>{{ $pName }}</strong>
@if($qAppt->patient?->patient_code)
<small class="table-subtext">{{ $qAppt->patient->formatted_patient_code }}</small>
@endif
</td>
<td>{{ $time }}</td>
<td>{{ $dentist }}</td>
<td class="queue-waiting-cell" data-checked-in-at="{{ $qAppt->checked_in_at ? \Illuminate\Support\Carbon::parse($qAppt->checked_in_at)->toIso8601String() : '' }}">{{ $waiting }}</td>
<td><span class="status {{ $badgeClass }}">{{ $status }}</span></td>
</tr>
@empty
<tr>
<td colspan="6" class="muted" style="text-align:center;padding:24px;">No patients currently in queue today.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
</section>
<section class="workspace-section" id="patients">
<div class="section-heading">
<div>
<p class="eyebrow">
       Patient registry
      </p>
<h2>
       Patients
      </h2>
<p>
       Maintain contact details and patient-reported health information used during care.
      </p>
</div>
<button class="btn secondary" data-export-current-patient-pdf="" type="button">Export patient record PDF</button></div>
<div class="patient-summary-grid front-patient-summary">
<div class="patient-summary-card">
<small>
       Registered patients
      </small>
<strong data-kpi="registered_patients">
       {{ $metrics['total_registered_patients'] ?? 0 }}
      </strong>
<span class="trend" data-kpi="trend_registered">
       ↑ {{ $metrics['new_registrations_month'] ?? 0 }} this month
      </span>
</div>
<div class="patient-summary-card">
<small>
       New registrations
      </small>
<strong data-kpi="new_registrations">
       {{ $metrics['new_registrations_month'] ?? 0 }}
      </strong>
<span data-kpi="month_name">
       {{ $metrics['month_name'] ?? 'October 2026' }}
      </span>
</div>
<div class="patient-summary-card">
<small>
       Recall contacts due
      </small>
<strong data-kpi="recall_due">
       {{ $metrics['recall_contacts_due'] ?? 0 }}
      </strong>
<span>
       Due for checkup
      </span>
</div>
<div class="patient-summary-card">
<small>
       Profiles needing update
      </small>
<strong data-kpi="profiles_needing_update">
       {{ $metrics['profiles_needing_update'] ?? 0 }}
      </strong>
<span>
       Incomplete contact details
      </span>
</div>
</div>
<div class="panel table-panel">
<div class="table-toolbar">
<h3>
       Patient Registry
      </h3>
<div class="table-toolbar-actions">
</div>
</div>
<div class="table-wrap">
<div class="table-filter-dock"><select aria-label="Patient segment" class="patient-segment-control" data-patient-segment-for="front-patient-table"><option value="">All segments</option><option value="Orthodontics">Orthodontics</option><option value="Preventive">Preventive</option><option value="Restorative">Restorative</option><option value="Endodontics">Endodontics</option><option value="Oral Surgery">Oral Surgery</option><option value="General">General</option></select><select aria-label="Procedure filter" class="patient-procedure-control" data-patient-procedure-for="front-patient-table"><option value="">All procedures</option><option value="Oral Prophylaxis">Oral Prophylaxis</option><option value="Composite Restoration">Composite Restoration</option><option value="Root Canal Therapy">Root Canal Therapy</option><option value="Orthodontic Braces">Orthodontic Braces</option><option value="Dental Checkup">Dental Checkup</option></select>
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="front-patient-table" placeholder="Search patient, phone, allergy..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="front-patient-table">
<option value="">
         Sort: Default
        </option>
<option value="asc">
         A–Z / Oldest first
        </option>
<option value="desc">
         Z–A / Newest first
        </option>
</select>
<details class="filter-popover" data-filter-for="front-patient-table">
<summary aria-label="Open table filters" class="filter-icon-trigger" title="Filter table">
<svg aria-hidden="true" viewbox="0 0 24 24">
<path d="M4 6h16M7 12h10M10 18h4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.8">
</path>
</svg>
</summary>
<div class="filter-popover-panel">
<div class="filter-popover-heading">
<strong>
           Filter &amp; refine
          </strong>
<small>
           Narrow the records in this table.
          </small>
</div>
<label>
          Search rows
          <input data-filter-query="" placeholder="Type patient, dentist, status..." type="search"/>
</label>
<div class="filter-popover-actions">
<button class="btn secondary sm" data-filter-reset="" type="button">
           Reset
          </button>
<button class="btn sm" data-filter-apply="" type="button">
           Apply
          </button>
</div>
</div>
</details>
</div>
<table id="front-patient-table">
<thead>
<tr>
<th>
          Patient
         </th>
<th>
          Age
         </th>
<th>
          Contact
         </th>
<th>
          Allergies
         </th>
<th>
          Last Visit
         </th>
<th>
          Action
         </th>
</tr>
</thead>
<tbody>
@forelse($patients as $patient)
@php
  $lastAppt = $patient->appointments->first();
  $age = $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->age : '—';
  $intake = $lastAppt?->intake_details ?? [];
  $rawAllergy = trim((string) ($intake['allergies'] ?? ''));
  $alert = ($rawAllergy === '' || preg_match('/^(none|none reported|no allergies|no known allergies|n\/?a)$/i', $rawAllergy)) ? 'None' : $rawAllergy;
  $lastVisit = $lastAppt?->starts_at ? $lastAppt->starts_at->format('M d') : 'New';
  $procedure = $lastAppt?->service?->name ?? 'General';
@endphp
<tr data-patient-id="{{ $patient->id }}" data-procedure="{{ $procedure }}">
<td>
<strong>{{ $patient->name }}</strong>
<small class="table-subtext">{{ $patient->formatted_patient_code }}</small>
</td>
<td>{{ $age }}</td>
<td>{{ $patient->formatted_phone }}</td>
<td>{{ $alert }}</td>
<td>{{ $lastVisit }}</td>
<td>
<button class="action-btn patient-view-btn" data-live-patient-id="{{ $patient->id }}" data-patient-id="{{ $patient->id }}" type="button">View</button>
</td>
</tr>
@empty
<tr>
<td colspan="6" class="muted" style="text-align:center;padding:24px;">No patients found in directory.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
</section>
<section class="workspace-section" id="payments">
<div class="section-heading">
<div>
<p class="eyebrow">
       Billing desk
      </p>
<h2>
       Payments
      </h2>
<p>
       Record patient payments and monitor outstanding balances.
      </p>
</div>
</div>
<div class="stats-grid">
<article class="stat-card" data-payment-kpi="collected">
<p>
       Collected today
      </p>
<strong>
       ₱18,450
      </strong>
<span>
       9 posted payments
      </span>
</article>
<article class="stat-card" data-payment-kpi="outstanding">
<p>
       Outstanding
      </p>
<strong>
       ₱7,200
      </strong>
<span>
       4 open balances
      </span>
</article>
<article class="stat-card" data-payment-kpi="cash">
<p>
       Cash
      </p>
<strong>
       ₱6,500
      </strong>
<span>
       Today
      </span>
</article>
<article class="stat-card" data-payment-kpi="digital">
<p>
       GCash / Card
      </p>
<strong>
       ₱11,950
      </strong>
<span>
       Today
      </span>
</article>
</div>
<div class="panel table-panel">
<div class="table-wrap">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="front-desk-table-5" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="front-desk-table-5">
<option value="">
         Sort: Default
        </option>
<option value="asc">
         A–Z / Oldest first
        </option>
<option value="desc">
         Z–A / Newest first
        </option>
</select>
<details class="filter-popover" data-filter-for="front-desk-table-5">
<summary aria-label="Open table filters" class="filter-icon-trigger" title="Filter table">
<svg aria-hidden="true" viewbox="0 0 24 24">
<path d="M4 6h16M7 12h10M10 18h4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.8">
</path>
</svg>
</summary>
<div class="filter-popover-panel">
<div class="filter-popover-heading">
<strong>
           Filter &amp; refine
          </strong>
<small>
           Narrow the records in this table.
          </small>
</div>
<label>
          Search rows
          <input data-filter-query="" placeholder="Type patient, dentist, status..." type="search"/>
</label>
<div class="filter-popover-actions">
<button class="btn secondary sm" data-filter-reset="" type="button">
           Reset
          </button>
<button class="btn sm" data-filter-apply="" type="button">
           Apply
          </button>
</div>
</div>
</details>
</div>
<table id="front-desk-table-5">
<thead>
<tr>
<th>
          Receipt
         </th>
<th>
          Patient
         </th>
<th>
          Service
         </th>
<th>
          Amount
         </th>
<th>
          Method
         </th>
<th>
          Status
         </th>
<th>
          Action
         </th>
</tr>
</thead>
<tbody>
<tr><td colspan="7" class="muted" style="text-align:center;padding:24px;">Loading payment records...</td></tr>
</tbody>
</table>
</div>
</div>
</section>
<section class="workspace-section" id="settings">
<div class="section-heading">
<div>
<p class="eyebrow">
       Accessibility
      </p>
<h2>
       Settings
      </h2>
<p>
       Personalize readability, contrast, motion and keyboard visibility for this workspace.
      </p>
</div>
</div>
<article class="panel accessibility-settings-panel">
<div class="panel-heading">
<div>
<h3>
        Accessibility preferences
       </h3>
<p>
        These preferences are saved on this browser and apply across Cerillo workspaces.
       </p>
</div>
</div>
<div class="access-grid access-grid-vertical">
<label class="access-option">
<span>
<strong>
         Dark mode
        </strong>
<small>
         Use a darker interface theme with reduced screen brightness.
        </small>
</span>
<input id="darkModeToggle" type="checkbox"/>
</label>
<label class="access-option">
<span>
<strong>
         Large text
        </strong>
<small>
         Increase interface text size while preserving responsive layout.
        </small>
</span>
<input id="largeText" type="checkbox"/>
</label>
<label class="access-option">
<span>
<strong>
         High contrast
        </strong>
<small>
         Increase foreground and background contrast.
        </small>
</span>
<input id="highContrast" type="checkbox"/>
</label>
<label class="access-option">
<span>
<strong>
         Reduced motion
        </strong>
<small>
         Limit non-essential animation and movement.
        </small>
</span>
<input id="reducedMotion" type="checkbox"/>
</label>
<label class="access-option">
<span>
<strong>
         Enhanced focus
        </strong>
<small>
         Show stronger keyboard focus indicators.
        </small>
</span>
<input checked="" id="enhancedFocus" type="checkbox"/>
</label>
</div>
</article>
</section>
</main>
<dialog aria-label="Logout confirmation" class="modal modal-sm logout-modal" id="logoutConfirmModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">
       Account session
      </p>
<h3>
       Sign out?
      </h3>
<p>
       You will need to sign in again to access your workspace.
      </p>
</div>
<button aria-label="Close logout confirmation" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</div>
<div class="logout-dialog-body">
<div class="logout-icon">
      ↪
     </div>
<div>
<strong>
       Are you sure you want to sign out?
      </strong>
<p>
       Any unsaved form changes on this page will be discarded.
      </p>
</div>
</div>
<div class="dialog-footer">
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">
      Stay signed in
     </button>
<form action="<?php echo e(route('logout')); ?>" method="POST">
<?php echo csrf_field(); ?>
<button class="btn danger" type="submit">
      Sign out
     </button>
</form>
</div>
</div>
</dialog>
<dialog aria-label="Appointment Details" class="modal modal-xl clinical-record-modal front-appointment-detail-modal" data-patient-id="" data-patient-name="" id="frontAppointmentModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">
       Front Desk · Appointment
      </p>
<h3 id="frontAppointmentTitle">
       Appointment Details
      </h3>
<p id="frontAppointmentSub">
       Review the patient schedule and update reception status.
      </p>
</div>
<button aria-label="Close appointment" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</div>
<div class="modal-body appointment-dialog-grid">
<div class="appointment-main">
<div class="appointment-banner">
<div>
<h4 id="frontAppointmentTime">
         —
        </h4>
<p id="frontAppointmentProcedure">
         —
        </p>
</div>
<span class="status-pill info" id="frontAppointmentPill">
        Pending
       </span>
</div>
<div class="appointment-meta-row">
<div class="appointment-meta-card">
<small>
         Patient
        </small>
<strong id="frontAppointmentPatient">
         —
        </strong>
</div>
<div class="appointment-meta-card">
<small>
         Dentist
        </small>
<strong id="frontAppointmentDentist">
         —
        </strong>
</div>
<div class="appointment-meta-card">
<small>
         Arrival
        </small>
<strong id="frontAppointmentArrival">
         —
        </strong>
</div>
<div class="appointment-meta-card">
<small>
         Date of birth / age
        </small>
<strong id="frontAppointmentDob">
         —
        </strong>
</div>
</div>
<div class="form-section">
<div class="form-section-title">
<div>
<h4>
          Reception status
         </h4>
<p>
          Front Desk may set only Checked In, Pending, or Cancelled.
         </p>
</div>
</div>
<div class="form-grid two-col">
<label>
         Status
         <select id="frontAppointmentStatus" required="">
<option>
           Checked In
          </option>
<option>
           Pending
          </option>
<option>
           Cancelled
          </option>
</select>
</label>
<label id="arrivalField">
         Arrival time
         <input id="frontArrivalTime" type="time"/>
</label>
</div>
<div class="cancellation-panel" hidden="" id="cancellationPanel">
<label>
         Cancellation reason
         <span class="required">
          *
         </span>
<select id="cancellationReason">
<option value="">
           Select reason
          </option>
<option>
           Patient requested cancellation
          </option>
<option>
           Medical concern
          </option>
<option>
           Schedule conflict
          </option>
<option>
           Unable to attend
          </option>
<option>
           Other
          </option>
</select>
</label>
<label>
         Additional notes
         <textarea id="cancellationNotes" placeholder="Record the reason clearly for the appointment history." rows="3"></textarea>
</label>
<label class="reschedule-offer">
<input checked="" id="offerReschedule" type="checkbox"/>
<span>
<strong>
           Offer another appointment
          </strong>
<small>
           After saving the cancellation, open New Appointment with this patient preselected.
          </small>
</span>
</label>
</div>
<div class="front-reassign-card">
<div class="front-reassign-copy">
<span class="front-reassign-kicker">Appointment assignment</span>
<h5>Assigned dentist</h5>
<p>Confirm or update the dentist assigned to this appointment.</p>
</div>
<label class="front-reassign-control">
<span>Assigned dentist</span>
<select id="frontReassignDentist">
<option>Dr. Ana Cerillo</option>
<option>Dr. Paolo Reyes</option>
<option>Dr. Angela Cerillo</option>
</select>
</label>
<div class="ortho-lock-note" hidden="" id="frontOrthoAssignmentNote">Orthodontic cases cannot be reassigned by Front Desk. The orthodontic dentist remains fixed.</div>
</div>
@if(in_array(auth()->user()?->role, ['admin', 'super_admin', 'dentist']))
<section class="premium-dental-chart front-appointment-dental-chart" data-record-panel="chart">
<div class="chart-toolbar premium-chart-toolbar">
<div class="premium-chart-title">
<span class="premium-chart-kicker">Clinical odontogram</span>
<h4>
         Dental Chart
        </h4>
<p>
         Select one or more teeth to record findings, diagnoses and treatment.
        </p>
</div>
<div class="segmented dentition-toggle">
<button class="active" data-dentition="permanent" type="button">
         Permanent
        </button>
<button data-dentition="primary" type="button">
         Primary
        </button>
<button data-dentition="mixed" type="button">
         Mixed
        </button>
</div>
</div>
<div class="tooth-legend">
<span>
<i class="legend sound">
</i>
        Sound
       </span>
<span>
<i class="legend decay">
</i>
        Tooth decay
       </span>
<span>
<i class="legend finding">
</i>
        Other finding
       </span>
<span>
<i class="legend planned">
</i>
        Treatment planned
       </span>
<span>
<i class="legend completed">
</i>
        Completed/restored
       </span>
<span>
<i class="legend missing">
</i>
        Missing/extracted
       </span>
<span>
<i class="legend impacted">
</i>
        Impacted
       </span>
</div>
<div class="odontogram-workspace">
<div class="odontogram-panel">
<div class="tooth-grid" data-dentition-grid="permanent">
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="1" data-tooth-name="Maxillary Right Third Molar" style="--tooth-x:7.00%;--tooth-y:39.00%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 1 · Maxillary Right Third Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            1
           </span>
</span>
<small>
           Right Third Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="2" data-tooth-name="Maxillary Right Second Molar" style="--tooth-x:12.73%;--tooth-y:33.74%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 2 · Maxillary Right Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            2
           </span>
</span>
<small>
           Right Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-decay" data-tooth="3" data-tooth-name="Maxillary Right First Molar" style="--tooth-x:18.47%;--tooth-y:28.99%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 3 · Maxillary Right First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            3
           </span>
</span>
<small>
           Right First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="4" data-tooth-name="Maxillary Right Second Premolar" style="--tooth-x:24.20%;--tooth-y:24.76%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 4 · Maxillary Right Second Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            4
           </span>
</span>
<small>
           Right Second Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="5" data-tooth-name="Maxillary Right First Premolar" style="--tooth-x:29.93%;--tooth-y:21.11%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 5 · Maxillary Right First Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            5
           </span>
</span>
<small>
           Right First Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="6" data-tooth-name="Maxillary Right Canine" style="--tooth-x:35.67%;--tooth-y:18.08%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 6 · Maxillary Right Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            6
           </span>
</span>
<small>
           Right Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="7" data-tooth-name="Maxillary Right Lateral Incisor" style="--tooth-x:41.40%;--tooth-y:15.76%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 7 · Maxillary Right Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            7
           </span>
</span>
<small>
           Right Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-completed" data-tooth="8" data-tooth-name="Maxillary Right Central Incisor" style="--tooth-x:47.13%;--tooth-y:14.29%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 8 · Maxillary Right Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            8
           </span>
</span>
<small>
           Right Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-completed" data-tooth="9" data-tooth-name="Maxillary Left Central Incisor" style="--tooth-x:52.87%;--tooth-y:14.29%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 9 · Maxillary Left Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            9
           </span>
</span>
<small>
           Left Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="10" data-tooth-name="Maxillary Left Lateral Incisor" style="--tooth-x:58.60%;--tooth-y:15.76%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 10 · Maxillary Left Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            10
           </span>
</span>
<small>
           Left Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="11" data-tooth-name="Maxillary Left Canine" style="--tooth-x:64.33%;--tooth-y:18.08%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 11 · Maxillary Left Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            11
           </span>
</span>
<small>
           Left Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="12" data-tooth-name="Maxillary Left First Premolar" style="--tooth-x:70.07%;--tooth-y:21.11%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 12 · Maxillary Left First Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            12
           </span>
</span>
<small>
           Left First Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="13" data-tooth-name="Maxillary Left Second Premolar" style="--tooth-x:75.80%;--tooth-y:24.76%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 13 · Maxillary Left Second Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            13
           </span>
</span>
<small>
           Left Second Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-decay" data-tooth="14" data-tooth-name="Maxillary Left First Molar" style="--tooth-x:81.53%;--tooth-y:28.99%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 14 · Maxillary Left First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            14
           </span>
</span>
<small>
           Left First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="15" data-tooth-name="Maxillary Left Second Molar" style="--tooth-x:87.27%;--tooth-y:33.74%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 15 · Maxillary Left Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            15
           </span>
</span>
<small>
           Left Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="16" data-tooth-name="Maxillary Left Third Molar" style="--tooth-x:93.00%;--tooth-y:39.00%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 16 · Maxillary Left Third Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            16
           </span>
</span>
<small>
           Left Third Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-missing" data-tooth="17" data-tooth-name="Mandibular Left Third Molar" style="--tooth-x:93.00%;--tooth-y:61.00%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 17 · Mandibular Left Third Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            17
           </span>
</span>
<small>
           Left Third Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="18" data-tooth-name="Mandibular Left Second Molar" style="--tooth-x:87.27%;--tooth-y:66.26%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 18 · Mandibular Left Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            18
           </span>
</span>
<small>
           Left Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-planned" data-tooth="19" data-tooth-name="Mandibular Left First Molar" style="--tooth-x:81.53%;--tooth-y:71.01%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 19 · Mandibular Left First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            19
           </span>
</span>
<small>
           Left First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="20" data-tooth-name="Mandibular Left Second Premolar" style="--tooth-x:75.80%;--tooth-y:75.24%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 20 · Mandibular Left Second Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            20
           </span>
</span>
<small>
           Left Second Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="21" data-tooth-name="Mandibular Left First Premolar" style="--tooth-x:70.07%;--tooth-y:78.89%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 21 · Mandibular Left First Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            21
           </span>
</span>
<small>
           Left First Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="22" data-tooth-name="Mandibular Left Canine" style="--tooth-x:64.33%;--tooth-y:81.92%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 22 · Mandibular Left Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            22
           </span>
</span>
<small>
           Left Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="23" data-tooth-name="Mandibular Left Lateral Incisor" style="--tooth-x:58.60%;--tooth-y:84.24%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 23 · Mandibular Left Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            23
           </span>
</span>
<small>
           Left Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="24" data-tooth-name="Mandibular Left Central Incisor" style="--tooth-x:52.87%;--tooth-y:85.71%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 24 · Mandibular Left Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            24
           </span>
</span>
<small>
           Left Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="25" data-tooth-name="Mandibular Right Central Incisor" style="--tooth-x:47.13%;--tooth-y:85.71%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 25 · Mandibular Right Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            25
           </span>
</span>
<small>
           Right Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="26" data-tooth-name="Mandibular Right Lateral Incisor" style="--tooth-x:41.40%;--tooth-y:84.24%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 26 · Mandibular Right Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            26
           </span>
</span>
<small>
           Right Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="27" data-tooth-name="Mandibular Right Canine" style="--tooth-x:35.67%;--tooth-y:81.92%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 27 · Mandibular Right Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            27
           </span>
</span>
<small>
           Right Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="28" data-tooth-name="Mandibular Right First Premolar" style="--tooth-x:29.93%;--tooth-y:78.89%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 28 · Mandibular Right First Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            28
           </span>
</span>
<small>
           Right First Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="29" data-tooth-name="Mandibular Right Second Premolar" style="--tooth-x:24.20%;--tooth-y:75.24%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 29 · Mandibular Right Second Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            29
           </span>
</span>
<small>
           Right Second Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-decay" data-tooth="30" data-tooth-name="Mandibular Right First Molar" style="--tooth-x:18.47%;--tooth-y:71.01%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 30 · Mandibular Right First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            30
           </span>
</span>
<small>
           Right First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-completed" data-tooth="31" data-tooth-name="Mandibular Right Second Molar" style="--tooth-x:12.73%;--tooth-y:66.26%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 31 · Mandibular Right Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            31
           </span>
</span>
<small>
           Right Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="32" data-tooth-name="Mandibular Right Third Molar" style="--tooth-x:7.00%;--tooth-y:61.00%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 32 · Mandibular Right Third Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            32
           </span>
</span>
<small>
           Right Third Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
</div>
<div class="tooth-grid hidden" data-dentition-grid="primary">
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="A" data-tooth-name="Primary Maxillary Right Second Molar" title="Tooth A · Primary Maxillary Right Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            A
           </span>
</span>
<small>
           Right Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="B" data-tooth-name="Primary Maxillary Right First Molar" title="Tooth B · Primary Maxillary Right First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            B
           </span>
</span>
<small>
           Right First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="C" data-tooth-name="Primary Maxillary Right Canine" title="Tooth C · Primary Maxillary Right Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            C
           </span>
</span>
<small>
           Right Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="D" data-tooth-name="Primary Maxillary Right Lateral Incisor" title="Tooth D · Primary Maxillary Right Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            D
           </span>
</span>
<small>
           Right Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="E" data-tooth-name="Primary Maxillary Right Central Incisor" title="Tooth E · Primary Maxillary Right Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            E
           </span>
</span>
<small>
           Right Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="F" data-tooth-name="Primary Maxillary Left Central Incisor" title="Tooth F · Primary Maxillary Left Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            F
           </span>
</span>
<small>
           Left Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="G" data-tooth-name="Primary Maxillary Left Lateral Incisor" title="Tooth G · Primary Maxillary Left Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            G
           </span>
</span>
<small>
           Left Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="H" data-tooth-name="Primary Maxillary Left Canine" title="Tooth H · Primary Maxillary Left Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            H
           </span>
</span>
<small>
           Left Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="I" data-tooth-name="Primary Maxillary Left First Molar" title="Tooth I · Primary Maxillary Left First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            I
           </span>
</span>
<small>
           Left First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="J" data-tooth-name="Primary Maxillary Left Second Molar" title="Tooth J · Primary Maxillary Left Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            J
           </span>
</span>
<small>
           Left Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="K" data-tooth-name="Primary Mandibular Left Second Molar" title="Tooth K · Primary Mandibular Left Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            K
           </span>
</span>
<small>
           Left Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="L" data-tooth-name="Primary Mandibular Left First Molar" title="Tooth L · Primary Mandibular Left First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            L
           </span>
</span>
<small>
           Left First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="M" data-tooth-name="Primary Mandibular Left Canine" title="Tooth M · Primary Mandibular Left Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            M
           </span>
</span>
<small>
           Left Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="N" data-tooth-name="Primary Mandibular Left Lateral Incisor" title="Tooth N · Primary Mandibular Left Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            N
           </span>
</span>
<small>
           Left Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="O" data-tooth-name="Primary Mandibular Left Central Incisor" title="Tooth O · Primary Mandibular Left Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            O
           </span>
</span>
<small>
           Left Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="P" data-tooth-name="Primary Mandibular Right Central Incisor" title="Tooth P · Primary Mandibular Right Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            P
           </span>
</span>
<small>
           Right Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="Q" data-tooth-name="Primary Mandibular Right Lateral Incisor" title="Tooth Q · Primary Mandibular Right Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            Q
           </span>
</span>
<small>
           Right Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="R" data-tooth-name="Primary Mandibular Right Canine" title="Tooth R · Primary Mandibular Right Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            R
           </span>
</span>
<small>
           Right Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="S" data-tooth-name="Primary Mandibular Right First Molar" title="Tooth S · Primary Mandibular Right First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            S
           </span>
</span>
<small>
           Right First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="T" data-tooth-name="Primary Mandibular Right Second Molar" title="Tooth T · Primary Mandibular Right Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            T
           </span>
</span>
<small>
           Right Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
</div>
<div class="tooth-grid hidden" data-dentition-grid="mixed">
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="1" data-tooth-name="Maxillary Right Third Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 1 · Maxillary Right Third Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            1
           </span>
</span>
<small>
           Right Third Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="2" data-tooth-name="Maxillary Right Second Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 2 · Maxillary Right Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            2
           </span>
</span>
<small>
           Right Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-decay" data-tooth="3" data-tooth-name="Maxillary Right First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 3 · Maxillary Right First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            3
           </span>
</span>
<small>
           Right First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="4" data-tooth-name="Maxillary Right Second Premolar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 4 · Maxillary Right Second Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            4
           </span>
</span>
<small>
           Right Second Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="5" data-tooth-name="Maxillary Right First Premolar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 5 · Maxillary Right First Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            5
           </span>
</span>
<small>
           Right First Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="6" data-tooth-name="Maxillary Right Canine" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 6 · Maxillary Right Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            6
           </span>
</span>
<small>
           Right Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="7" data-tooth-name="Maxillary Right Lateral Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 7 · Maxillary Right Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            7
           </span>
</span>
<small>
           Right Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-completed" data-tooth="8" data-tooth-name="Maxillary Right Central Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 8 · Maxillary Right Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            8
           </span>
</span>
<small>
           Right Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-completed" data-tooth="9" data-tooth-name="Maxillary Left Central Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 9 · Maxillary Left Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            9
           </span>
</span>
<small>
           Left Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="10" data-tooth-name="Maxillary Left Lateral Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 10 · Maxillary Left Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            10
           </span>
</span>
<small>
           Left Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="11" data-tooth-name="Maxillary Left Canine" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 11 · Maxillary Left Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            11
           </span>
</span>
<small>
           Left Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="12" data-tooth-name="Maxillary Left First Premolar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 12 · Maxillary Left First Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            12
           </span>
</span>
<small>
           Left First Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="13" data-tooth-name="Maxillary Left Second Premolar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 13 · Maxillary Left Second Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            13
           </span>
</span>
<small>
           Left Second Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-decay" data-tooth="14" data-tooth-name="Maxillary Left First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 14 · Maxillary Left First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            14
           </span>
</span>
<small>
           Left First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="15" data-tooth-name="Maxillary Left Second Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 15 · Maxillary Left Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            15
           </span>
</span>
<small>
           Left Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="16" data-tooth-name="Maxillary Left Third Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 16 · Maxillary Left Third Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            16
           </span>
</span>
<small>
           Left Third Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-missing" data-tooth="17" data-tooth-name="Mandibular Left Third Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 17 · Mandibular Left Third Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            17
           </span>
</span>
<small>
           Left Third Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="18" data-tooth-name="Mandibular Left Second Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 18 · Mandibular Left Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            18
           </span>
</span>
<small>
           Left Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-planned" data-tooth="19" data-tooth-name="Mandibular Left First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 19 · Mandibular Left First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            19
           </span>
</span>
<small>
           Left First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="20" data-tooth-name="Mandibular Left Second Premolar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 20 · Mandibular Left Second Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            20
           </span>
</span>
<small>
           Left Second Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="21" data-tooth-name="Mandibular Left First Premolar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 21 · Mandibular Left First Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            21
           </span>
</span>
<small>
           Left First Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="22" data-tooth-name="Mandibular Left Canine" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 22 · Mandibular Left Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            22
           </span>
</span>
<small>
           Left Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="23" data-tooth-name="Mandibular Left Lateral Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 23 · Mandibular Left Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            23
           </span>
</span>
<small>
           Left Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="24" data-tooth-name="Mandibular Left Central Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 24 · Mandibular Left Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            24
           </span>
</span>
<small>
           Left Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="25" data-tooth-name="Mandibular Right Central Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 25 · Mandibular Right Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            25
           </span>
</span>
<small>
           Right Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="26" data-tooth-name="Mandibular Right Lateral Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 26 · Mandibular Right Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            26
           </span>
</span>
<small>
           Right Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="27" data-tooth-name="Mandibular Right Canine" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 27 · Mandibular Right Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            27
           </span>
</span>
<small>
           Right Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="28" data-tooth-name="Mandibular Right First Premolar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 28 · Mandibular Right First Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            28
           </span>
</span>
<small>
           Right First Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="29" data-tooth-name="Mandibular Right Second Premolar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 29 · Mandibular Right Second Premolar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            29
           </span>
</span>
<small>
           Right Second Premolar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-decay" data-tooth="30" data-tooth-name="Mandibular Right First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 30 · Mandibular Right First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            30
           </span>
</span>
<small>
           Right First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-completed" data-tooth="31" data-tooth-name="Mandibular Right Second Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 31 · Mandibular Right Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            31
           </span>
</span>
<small>
           Right Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="32" data-tooth-name="Mandibular Right Third Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 32 · Mandibular Right Third Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            32
           </span>
</span>
<small>
           Right Third Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="A" data-tooth-name="Primary Maxillary Right Second Molar" title="Tooth A · Primary Maxillary Right Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            A
           </span>
</span>
<small>
           Right Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="B" data-tooth-name="Primary Maxillary Right First Molar" title="Tooth B · Primary Maxillary Right First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            B
           </span>
</span>
<small>
           Right First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="C" data-tooth-name="Primary Maxillary Right Canine" title="Tooth C · Primary Maxillary Right Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            C
           </span>
</span>
<small>
           Right Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="D" data-tooth-name="Primary Maxillary Right Lateral Incisor" title="Tooth D · Primary Maxillary Right Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            D
           </span>
</span>
<small>
           Right Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="E" data-tooth-name="Primary Maxillary Right Central Incisor" title="Tooth E · Primary Maxillary Right Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            E
           </span>
</span>
<small>
           Right Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="F" data-tooth-name="Primary Maxillary Left Central Incisor" title="Tooth F · Primary Maxillary Left Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            F
           </span>
</span>
<small>
           Left Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="G" data-tooth-name="Primary Maxillary Left Lateral Incisor" title="Tooth G · Primary Maxillary Left Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            G
           </span>
</span>
<small>
           Left Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="H" data-tooth-name="Primary Maxillary Left Canine" title="Tooth H · Primary Maxillary Left Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            H
           </span>
</span>
<small>
           Left Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="I" data-tooth-name="Primary Maxillary Left First Molar" title="Tooth I · Primary Maxillary Left First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            I
           </span>
</span>
<small>
           Left First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="J" data-tooth-name="Primary Maxillary Left Second Molar" title="Tooth J · Primary Maxillary Left Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            J
           </span>
</span>
<small>
           Left Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="K" data-tooth-name="Primary Mandibular Left Second Molar" title="Tooth K · Primary Mandibular Left Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            K
           </span>
</span>
<small>
           Left Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="L" data-tooth-name="Primary Mandibular Left First Molar" title="Tooth L · Primary Mandibular Left First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            L
           </span>
</span>
<small>
           Left First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="M" data-tooth-name="Primary Mandibular Left Canine" title="Tooth M · Primary Mandibular Left Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            M
           </span>
</span>
<small>
           Left Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="N" data-tooth-name="Primary Mandibular Left Lateral Incisor" title="Tooth N · Primary Mandibular Left Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            N
           </span>
</span>
<small>
           Left Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="O" data-tooth-name="Primary Mandibular Left Central Incisor" title="Tooth O · Primary Mandibular Left Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            O
           </span>
</span>
<small>
           Left Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="P" data-tooth-name="Primary Mandibular Right Central Incisor" title="Tooth P · Primary Mandibular Right Central Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            P
           </span>
</span>
<small>
           Right Central Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="Q" data-tooth-name="Primary Mandibular Right Lateral Incisor" title="Tooth Q · Primary Mandibular Right Lateral Incisor" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            Q
           </span>
</span>
<small>
           Right Lateral Incisor
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="R" data-tooth-name="Primary Mandibular Right Canine" title="Tooth R · Primary Mandibular Right Canine" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            R
           </span>
</span>
<small>
           Right Canine
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="S" data-tooth-name="Primary Mandibular Right First Molar" title="Tooth S · Primary Mandibular Right First Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            S
           </span>
</span>
<small>
           Right First Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="T" data-tooth-name="Primary Mandibular Right Second Molar" title="Tooth T · Primary Mandibular Right Second Molar" type="button">
<span aria-hidden="true" class="tooth-silhouette">
<span class="tooth-number">
            T
           </span>
</span>
<small>
           Right Second Molar
          </small>
<i aria-hidden="true" class="tooth-status-dot">
</i>
</button>
</div>
</div>
<aside class="tooth-detail-panel">
<div aria-label="Tooth status legend" class="chart-status-card">
<div class="chart-status-heading">
<span class="chart-status-icon">◇</span>
<div>
<h5>Tooth Status</h5>
<p>Visual condition guide</p>
</div>
</div>
<div class="chart-status-grid">
<span><i class="legend sound"></i>Sound / Healthy</span>
<span><i class="legend decay"></i>Decay / Caries</span>
<span><i class="legend planned"></i>Treatment Planned</span>
<span><i class="legend completed"></i>Restored / Completed</span>
<span><i class="legend missing"></i>Missing / Extracted</span>
<span><i class="legend impacted"></i>Impacted</span>
<span><i class="legend finding"></i>Other Finding</span>
<span><i class="legend selected"></i>Selected</span>
</div>
</div>
<p class="eyebrow">
         Selected teeth
        </p>
<h4 id="selectedToothTitle">
         Select one or more teeth
        </h4>
<span class="selected-teeth-count" data-selected-tooth-count="">
         No teeth selected
        </span>
<label>
         Clinical status
         <select id="toothClinicalStatus">
<option>
           Sound / Healthy
          </option>
<option>
           Finding Documented
          </option>
<option>
           Treatment Planned
          </option>
<option>
           Completed / Restored
          </option>
<option>
           Missing / Extracted
          </option>
<option>
           Impacted
          </option>
</select>
</label>
<label>
         Tooth presence
         <select id="toothPresence">
<option>
           Present
          </option>
<option>
           Missing
          </option>
<option>
           Previously Extracted
          </option>
<option>
           Unerupted
          </option>
<option>
           Partially Erupted
          </option>
<option>
           Impacted
          </option>
<option>
           Retained Primary Tooth
          </option>
<option>
           Supernumerary Tooth
          </option>
</select>
</label>
<fieldset class="surface-fieldset">
<legend>
          Tooth surfaces
         </legend>
<label>
<input type="checkbox" value="M"/>
          M · Mesial
         </label>
<label>
<input type="checkbox" value="O"/>
          O/I · Occlusal/Incisal
         </label>
<label>
<input type="checkbox" value="D"/>
          D · Distal
         </label>
<label>
<input type="checkbox" value="B"/>
          B/F · Buccal/Facial
         </label>
<label>
<input type="checkbox" value="L"/>
          L/P · Lingual/Palatal
         </label>
</fieldset>
<label>
         Finding / Condition
         <select id="toothCondition">
<option value="Sound / Healthy">/</option>
<option value="Missing / Extracted">M</option>
<option value="Unerupted">Un</option>
<option value="Present">P</option>
<option value="Root Fragment">RF</option>
<option value="Amalgam Restoration">Am</option>
<option value="Composite Restoration">Co</option>
<option value="Extraction Indicated">X</option>
<option value="Observation">O</option>
<option value="Temporary Filling">TF</option>
<option value="Dentinal Caries">C</option>
<option value="Root Canal Treated">RCT</option>
<option value="Impacted">Im</option>
<option value="Jacket Crown">Jc</option>
<option value="Glass Ionomer">GI</option>
<option value="Sealant">S</option>
<option value="Erupted">ER</option>
<option value="3/Q">3/Q</option>
<option value="Metal Crown">MC</option>
<option value="Partially Erupted">PE</option>
<option value="Treatment Planned">TP</option>
<option value="QC">QC</option>
</select>
</label>
<label>
         Pulpal diagnosis
         <select id="toothPulpalDiagnosis">
<option>
           Normal pulp
          </option>
<option>
           Reversible pulpitis
          </option>
<option>
           Symptomatic irreversible pulpitis
          </option>
<option>
           Asymptomatic irreversible pulpitis
          </option>
<option>
           Pulp necrosis
          </option>
<option>
           Previously treated
          </option>
<option>
           Previously initiated therapy
          </option>
</select>
</label>
<label>
         Apical diagnosis
         <select id="toothApicalDiagnosis">
<option>
           Normal apical tissues
          </option>
<option>
           Symptomatic apical periodontitis
          </option>
<option>
           Asymptomatic apical periodontitis
          </option>
<option>
           Acute apical abscess
          </option>
<option>
           Chronic apical abscess
          </option>
<option>
           Condensing osteitis
          </option>
</select>
</label>
<label>
         Treatment
         <select id="toothTreatment">
<option>
           None
          </option>
<option>
           COMP · Composite Filling
          </option>
<option>
           AMAL · Amalgam Filling
          </option>
<option>
           RCT · Root Canal Therapy
          </option>
<option>
           EXT · Planned Extraction
          </option>
<option>
           Crown
          </option>
<option>
           Inlay / Onlay
          </option>
<option>
           Sealant
          </option>
<option>
           Implant-supported crown
          </option>
</select>
</label>
<label>
         CDT / Procedure code
         <input id="toothProcedureCode" value="D2391"/>
</label>
<label>
         Clinical notes
         <textarea id="toothClinicalNotes" placeholder="Add clinical observations, material details or follow-up notes." rows="3"></textarea>
</label>
<label>
         Auto-generated progress note
         <textarea id="autoProgressNote" rows="4">Select one or more teeth to draft the clinical progress note.</textarea>
</label>
<div class="tooth-form-actions">
<span data-tooth-form-message="">
          Choose one or more teeth, then apply the chart data.
         </span>
<button class="btn" data-apply-to-selected="" type="button">
          Apply to selected teeth
         </button>
</div>
</aside>
</div>
<details class="clinical-details" open="">
<summary>
<span class="clinical-details-title">Periodontal layer</span>
<span class="clinical-details-subtitle">Record periodontal findings for the selected tooth.</span>
<span class="clinical-details-tooth">Tooth #30</span>
</summary>
<div class="perio-grid">
<label>
         MB probing
         <input max="12" min="1" type="number" value="3"/>
</label>
<label>
         B probing
         <input max="12" min="1" type="number" value="2"/>
</label>
<label>
         DB probing
         <input max="12" min="1" type="number" value="3"/>
</label>
<label>
         ML probing
         <input max="12" min="1" type="number" value="3"/>
</label>
<label>
         L probing
         <input max="12" min="1" type="number" value="2"/>
</label>
<label>
         DL probing
         <input max="12" min="1" type="number" value="3"/>
</label>
<label>
         Recession (mm)
         <input max="12" min="0" type="number" value="0"/>
</label>
<label>
         Mobility
         <select>
<option>
           0
          </option>
<option>
           Grade I
          </option>
<option>
           Grade II
          </option>
<option>
           Grade III
          </option>
</select>
</label>
<label>
<input type="checkbox"/>
         Bleeding on probing
        </label>
<label>
<input type="checkbox"/>
         Suppuration
        </label>
<label>
<input type="checkbox"/>
         Plaque
        </label>
<label>
<input type="checkbox"/>
         Calculus
        </label>
</div>
</details>
<div class="chart-history">
<div class="chart-history-heading">
<div>
<h4>Cross-referenced history · Tooth #30</h4>
<p>Previous findings, treatments and linked clinical records for this tooth.</p>
</div>
<span class="history-count">2 records</span>
</div>
<div class="history-card">
<strong>
         12 Aug 2026 · Composite restoration
        </strong>
<span>
         Material: Nanohybrid composite · Dr. Paolo Reyes
        </span>
</div>
<div class="history-card">
<strong>
         03 Oct 2026 · Recurrent caries finding
        </strong>
<span>
         Radiograph linked · Treatment plan created
        </span>
</div>
</div>
<div class="tooth-quick-popover" data-tooth-quick-popover="" popover="manual">
<div class="tooth-quick-head"><div><small>Selected tooth</small><strong data-tq-tooth="">Tooth</strong></div><button aria-label="Close" class="icon-btn tq-close" type="button">×</button></div>
<label>Finding / condition<select data-tq-finding=""><option value="">Select finding...</option><option value="Sound / Healthy">/</option><option value="Missing / Extracted">M</option><option value="Unerupted">Un</option><option value="Present">P</option><option value="Root Fragment">RF</option><option value="Amalgam Restoration">Am</option><option value="Composite Restoration">Co</option><option value="Extraction Indicated">X</option><option value="Observation">O</option><option value="Temporary Filling">TF</option><option value="Dentinal Caries">C</option><option value="Root Canal Treated">RCT</option><option value="Impacted">Im</option><option value="Jacket Crown">Jc</option><option value="Glass Ionomer">GI</option><option value="Sealant">S</option><option value="Erupted">ER</option><option value="3/Q">3/Q</option><option value="Metal Crown">MC</option><option value="Partially Erupted">PE</option><option value="Treatment Planned">TP</option><option value="QC">QC</option></select></label>
<small class="tooth-billing-note">Choose the clinical finding for this tooth. Billable findings continue to treatment and pricing.</small>
</div>
<div class="tooth-charge-popover" data-tooth-charge-popover="" popover="manual">
<div class="tooth-quick-head"><div><small>Treatment charge</small><strong data-tqc-tooth="">Tooth</strong></div><button aria-label="Close" class="icon-btn tqc-close" type="button">×</button></div>
<div class="tooth-charge-summary"><span>Finding</span><strong data-tqc-finding="">—</strong></div>
<label>Treatment / procedure<select data-tqc-procedure=""><option>Composite Restoration</option><option>Root Canal Treatment</option><option>Dental Crown</option><option>Tooth Extraction</option><option>Surgical Extraction</option><option>Restorative Treatment</option><option>Observation / Review</option><option>Other Dental Procedure</option></select></label>
<label>Price for this tooth (₱)<input data-tqc-price="" min="0" placeholder="0.00" required="" step="0.01" type="number"/></label>
<label>Clinical / billing note <span class="optional-label">Optional</span><textarea data-tqc-notes="" placeholder="Add a short note for this tooth charge..." rows="3"></textarea></label>
<div class="tooth-charge-message" data-tqc-message="" aria-live="polite"></div>
<small class="tooth-billing-note">Confirming creates a charge in this patient's Billing Ledger and Billing &amp; Payments records.</small>
<div class="tooth-charge-actions"><button class="btn secondary" data-tqc-cancel="" type="button">Cancel</button><button class="btn" data-tqc-save="" type="button">Add charge to patient</button></div>
</div></section>
@endif
</div>
</div>
<aside class="appointment-side">
<div class="appointment-side-card">
<h4>
        Patient snapshot
       </h4>
<div class="info-field">
<small>
         Mobile
        </small>
<strong>
         +63 917 555 0142
        </strong>
</div>
<div class="info-field">
<small>
         Email
        </small>
<strong>
         patient@samplemail.com
        </strong>
</div>
</div>
<div class="appointment-side-card">
<h4>
        Cancellation policy
       </h4>
<p>
        A cancellation must include a recorded reason. Front Desk should offer an alternative appointment when appropriate.
       </p>
</div>
</aside>
</div>
<div class="dialog-footer">
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">
      Close
     </button>
<button class="btn" id="saveFrontAppointmentStatus" type="button">
      Save status
     </button>
</div>
</div>
</dialog>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      const navigationLinks = document.querySelectorAll(".side-nav .side-link");
      const workspaceSections = document.querySelectorAll(".workspace-main > .workspace-section");

      function showSection(sectionId, updateHash = true) {
        const targetSection = document.getElementById(sectionId);

        if (!targetSection || !targetSection.classList.contains("workspace-section")) {
          return;
        }

        workspaceSections.forEach(function (section) {
          section.classList.remove("active-section");
        });

        navigationLinks.forEach(function (link) {
          link.classList.remove("active");
          link.removeAttribute("aria-current");
        });

        targetSection.classList.add("active-section");

        const activeLink = document.querySelector(
          '.side-nav .side-link[href="#' + sectionId + '"]'
        );

        if (activeLink) {
          activeLink.classList.add("active");
          activeLink.setAttribute("aria-current", "page");
        }

        if (updateHash) {
          history.replaceState(null, "", "#" + sectionId);
        }

        window.scrollTo({
          top: 0,
          behavior: "auto"
        });
      }

      navigationLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
          const sectionId = link.getAttribute("href").substring(1);
          const targetSection = document.getElementById(sectionId);

          if (targetSection && targetSection.classList.contains("workspace-section")) {
            event.preventDefault();
            showSection(sectionId);
          }
        });
      });

      const requestedSection = window.location.hash.substring(1);
      const requestedElement = document.getElementById(requestedSection);

      if (requestedElement && requestedElement.classList.contains("workspace-section")) {
        showSection(requestedSection, false);
      } else {
        const defaultSection = document.querySelector(
          ".workspace-main > .workspace-section.active-section"
        ) || workspaceSections[0];

        if (defaultSection) {
          showSection(defaultSection.id, false);
        }
      }
    });
  </script>
<dialog aria-label="Register New Patient" class="modal modal-xl" id="addPatientModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">
       New patient intake
      </p>
<h3>
       Register New Patient
      </h3>
<p>
       Capture identity, contact, medical, and dental information before the first visit.
      </p>
</div>
<button aria-label="Close patient registration" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</div>
<div class="modal-scroll">
<form id="addPatientForm">
<div class="modal-form-layout">
<aside class="modal-form-aside">
<h4>
         Patient intake
        </h4>
<p>
         Required fields help the clinical team provide safe and coordinated care.
        </p>
<div class="modal-step">
<i>
          1
         </i>
<span>
          Identity and contact information
         </span>
</div>
<div class="modal-step">
<i>
          2
         </i>
<span>
          Medical and allergy history
         </span>
</div>
<div class="modal-step">
<i>
          3
         </i>
<span>
          Dental concern and care preferences
         </span>
</div>
<div class="clinical-alert" style="margin-top:16px">
<div>
          !
         </div>
<div>
<strong>
           Philippine mobile format
          </strong>
<span>
           Enter 10 digits beginning with 9 after the +63 prefix.
          </span>
</div>
</div>
</aside>
<div class="modal-form-main">
<div class="form-section">
<div class="form-section-title">
<div>
<h4>
            Patient identity
           </h4>
<p>
            Basic demographic and responsible-party information.
           </p>
</div>
<span class="status-pill info">
           Required
          </span>
</div>
<div class="form-grid">
<label>
           First Name
           <input minlength="2" name="firstName" required=""/>
</label>
<label>
           Last Name
           <input minlength="2" name="lastName" required=""/>
</label>
<label>
           Date of Birth
           <input required="" type="date"/>
</label>
<label>
           Sex
           <select required="">
<option value="">
             Select
            </option>
<option>
             Female
            </option>
<option>
             Male
            </option>
<option>
             Prefer not to say
            </option>
</select>
</label>
<label class="span-2">
           Home Address
           <textarea placeholder="House/Unit, Street, Barangay, City, Province" required="" rows="2"></textarea>
</label>
<label>
           Guardian / Responsible Party
           <input placeholder="If applicable"/>
</label>
<label>
           Preferred Contact
           <select required="">
<option>
             SMS
            </option>
<option>
             Phone call
            </option>
<option>
             Email
            </option>
</select>
</label>
</div>
</div>
<div class="form-section">
<div class="form-section-title">
<div>
<h4>
            Contact information
           </h4>
<p>
            Used for confirmations, recalls, and care coordination.
           </p>
</div>
</div>
<div class="form-grid">
<label>
           Email
           <input placeholder="patient@example.com" required="" type="email"/>
</label>
<label>
           Mobile Number
           <div class="phone-prefix">
<span>
             +63
            </span>
<input inputmode="numeric" maxlength="10" pattern="9[0-9]{9}" placeholder="9175550142" required="" title="Enter 10 digits beginning with 9" type="tel"/>
</div>
</label>
<label>
           Alternative Phone (optional)
           <div class="phone-prefix">
<span>
             +63
            </span>
<input inputmode="numeric" maxlength="10" pattern="9[0-9]{9}" placeholder="9185550142" type="tel"/>
</div>
</label>
<label>
           How did you hear about us?
           <select required="">
<option>
             Referral
            </option>
<option>
             Social media
            </option>
<option>
             Search engine
            </option>
<option>
             Walk-in
            </option>
<option>
             Other
            </option>
</select>
</label>
</div>
</div>
<div class="form-section">
<div class="form-section-title">
<div>
<h4>
            Medical &amp; dental history
           </h4>
<p>
            Record safety alerts and the reason for seeking dental care.
           </p>
</div>
</div>
<div class="form-grid">
<label class="span-2">
           Chief Concern
           <textarea placeholder="Reason for seeking dental care" required="" rows="2"></textarea>
</label>
<label class="span-2">
           Allergies
           <textarea placeholder="Medication, food, latex, anesthetic allergy — or No known allergies" required="" rows="2"></textarea>
</label>
<label class="span-2">
           Medical / Surgical History
           <textarea placeholder="Conditions, hospitalizations, surgeries, pregnancy, or other relevant history" required="" rows="3"></textarea>
</label>
<label class="span-2">
           Current Medications &amp; Supplements
           <textarea placeholder="Enter medications, dose if known, or None" required="" rows="2"></textarea>
</label>
<label>
           Last Dental Visit
           <input type="date"/>
</label>
<label>
           Dental Insurance
           <select required="">
<option>
             No
            </option>
<option>
             Yes
            </option>
</select>
</label>
</div>
</div>
<label class="flex" style="align-items:flex-start; color:#667085; font-size:11px; margin:10px 0 0">
<input required="" style="width:auto; margin-top:3px" type="checkbox"/>
         I confirm the information provided is complete and accurate to the best of my knowledge.
        </label>
</div>
</div>
<div class="form-actions">
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">
        Cancel
       </button>
<button class="btn" type="submit">
        Save patient
       </button>
</div>
</form>
</div>
</div>
</dialog>
<dialog aria-label="Patient Record — Maria Santos" class="modal modal-xl clinical-record-modal" data-patient-id="PT-2026-0018" data-patient-name="Maria Santos" id="frontPatientModal">
<div class="modal-shell patient-file-shell">
<header class="modal-header patient-file-header">
<div class="patient-identity-row">
<div class="avatar avatar-lg" data-pr-avatar>
       MS
      </div>
<div>
<p class="eyebrow">
        Patient Record
       </p>
<h3 data-pr-name>
        Maria Santos
       </h3>
<div class="patient-inline-data">
<span data-pr-code>
         ID: PT-2026-0018
        </span>
</div>
</div>
</div>
<div class="modal-header-actions"><button class="btn secondary compact" data-export-patient-pdf="" type="button">Export PDF</button>
<button aria-label="Close" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
       ×
      </button>
</div>
</header>
<div class="record-tabs" data-record-tabs="">
<button class="record-tab active" data-record-tab="summary" type="button">
      Overview
     </button>
<button class="record-tab" data-record-tab="visits" type="button">
      Visit History
     </button>
<button class="record-tab" data-record-tab="ledger" type="button">
      Billing Ledger
     </button>
</div>
<div class="modal-body patient-file-body">
<section class="record-tab-panel active" data-record-panel="summary">
<div class="patient-overview-grid">
<article class="info-card patient-profile-card">
<div class="record-card-heading">
<div>
<span class="record-card-icon">
           01
          </span>
<div>
<h4>
            Personal &amp; Contact Details
           </h4>
<p>
            Core identity and communication information.
           </p>
</div>
</div>
<span class="record-meta" data-pr-meta>
          Verified 05 Oct 2026
         </span>
</div>
<dl class="patient-detail-grid">
<div>
<dt>
           Date of birth
          </dt>
<dd data-pr-dob>
           14 March 1992
          </dd>
</div>
<div>
<dt>
           Age
          </dt>
<dd data-pr-age>
           34 years
          </dd>
</div>
<div>
<dt>
           Sex
          </dt>
<dd data-pr-gender>
           Female
          </dd>
</div>
<div>
<dt>
           Mobile
          </dt>
<dd data-pr-phone>
           +63 917 842 1180
          </dd>
</div>
<div>
<dt>
           Email
          </dt>
<dd data-pr-email>
           maria.santos@gmail.com
          </dd>
</div>
<div class="wide">
<dt>
           Address
          </dt>
<dd data-pr-address>
           J.P. Laurel Ave., Davao City
          </dd>
</div>
<div>
<dt>
           Insurance / HMO
          </dt>
<dd data-pr-insurance>
           Maxicare Dental
          </dd>
</div>
<div>
<dt>
           Preferred contact
          </dt>
<dd data-pr-contact>
           SMS
          </dd>
</div>
</dl>
</article>
<article class="info-card patient-care-card">
<div class="record-card-heading">
<div>
<span class="record-card-icon blue">
           02
          </span>
<div>
<h4>
            Dental Care Snapshot
           </h4>
<p>
            Useful context before opening the clinical tabs.
           </p>
</div>
</div>
</div>
<dl class="patient-detail-grid compact">
<div class="wide">
<dt>
           Chief concern
          </dt>
<dd data-pr-concern>
           Sensitivity on lower-right posterior teeth
          </dd>
</div>
<div>
<dt>
           Preferred dentist
          </dt>
<dd data-pr-dentist>
           Dr. Ana Cerillo
          </dd>
</div>
<div>
<dt>
           Last visit
          </dt>
<dd data-pr-last-visit>
           03 Oct 2026
          </dd>
</div>
<div>
<dt>
           Next appointment
          </dt>
<dd data-pr-next-appt>
           18 Oct 2026 · 10:00 AM
          </dd>
</div>
<div>
<dt>
           Last radiograph
          </dt>
<dd data-pr-last-xray>
           04 Oct 2026
          </dd>
</div>
<div>
<dt>
           Recall interval
          </dt>
<dd data-pr-recall>
           6 months
          </dd>
</div>
<div>
<dt>
           Dental anxiety
          </dt>
<dd data-pr-anxiety>
           Low
          </dd>
</div>
</dl>
</article>
</div>
<div class="clinical-alert-strip">
<div>
<span class="alert-indicator red">
</span>
<span>
<small>
          Drug allergy
         </small>
<strong data-pr-alert-allergy>
          Penicillin
         </strong>
</span>
</div>
<div>
<span class="alert-indicator amber">
</span>
<span>
<small>
          Current medication
         </small>
<strong data-pr-alert-medication>
          Losartan 50 mg daily
         </strong>
</span>
</div>
<div>
<span class="alert-indicator blue">
</span>
<span>
<small>
          Medical history
         </small>
<strong data-pr-alert-med-history>
          Controlled hypertension
         </strong>
</span>
</div>
<div>
<span class="alert-indicator green">
</span>
<span>
<small>
          Health history review
         </small>
<strong data-pr-alert-review>
          05 Oct 2026
         </strong>
</span>
</div>
</div>
</section>
<section class="record-tab-panel" data-record-panel="visits">
<div class="panel-header">
<div>
<h4>
         Completed Visit History
        </h4>
<p>
         Clinical encounters are retained as an audit trail.
        </p>
</div>
</div>
<div class="visit-timeline" data-pr-visit-timeline="">
<button aria-label="Open completed visit details" class="visit-history-row" onclick="document.getElementById('visitHistoryModal').showModal()" type="button">
<span class="timeline-dot complete">
</span>
<strong>
         Dr. Ana Cerillo
        </strong>
<span>
         03 Oct 2026 · 10:15 AM
        </span>
<span class="status success">
         Completed
        </span>
<span aria-hidden="true" class="visit-chevron">
         ›
        </span>
</button>
<button aria-label="Open completed visit details" class="visit-history-row" onclick="document.getElementById('visitHistoryModal').showModal()" type="button">
<span class="timeline-dot complete">
</span>
<strong>
         Dr. Paolo Reyes
        </strong>
<span>
         12 Aug 2026 · 2:30 PM
        </span>
<span class="status success">
         Completed
        </span>
<span aria-hidden="true" class="visit-chevron">
         ›
        </span>
</button>
<button aria-label="Open completed visit details" class="visit-history-row" onclick="document.getElementById('visitHistoryModal').showModal()" type="button">
<span class="timeline-dot complete">
</span>
<strong>
         Dr. Ana Cerillo
        </strong>
<span>
         10 Feb 2026 · 9:00 AM
        </span>
<span class="status success">
         Completed
        </span>
<span aria-hidden="true" class="visit-chevron">
         ›
        </span>
</button>
</div>
</section>



<section class="record-tab-panel" data-record-panel="ledger">
<div class="panel-header">
<div>
<h4>
         Billing Ledger
        </h4>
<p>
         Read-only financial history for this patient.
        </p>
</div>
<button class="btn btn-success" id="frontPatientProceedCheckoutBtn" type="button" hidden>
        Proceed to Checkout
       </button>
</div>
<div class="ledger-summary">
<article>
<span>
         Total charges
        </span>
<strong data-pr-ledger-charges="">
         ₱0.00
        </strong>
</article>
<article>
<span>
         Payments
        </span>
<strong data-pr-ledger-payments="">
         ₱0.00
        </strong>
</article>
<article>
<span>
         Adjustments
        </span>
<strong data-pr-ledger-adjustments="">
         -₱0.00
        </strong>
</article>
<article>
<span>
         Outstanding
        </span>
<strong data-pr-ledger-balance="">
         ₱0.00
        </strong>
</article>
</div>
<div class="table-wrap">
<table data-patient-ledger="">
<thead>
<tr>
<th>
           Date
          </th>
<th>
           Reference
          </th>
<th>
           Description
          </th>
<th>
           Charge
          </th>
<th>
           Payment / Adjustment
          </th>
<th>
           Balance
          </th>
</tr>
</thead>
<tbody data-pr-ledger-tbody="">
<tr>
<td class="muted" colspan="6">
           No billing transactions recorded.
          </td>
</tr>
</tbody>
</table>
</div>
</section>
</div>
<footer class="modal-footer">
<span data-pr-footer-updated="">
      Last updated —
     </span>
<button class="btn btn-secondary" onclick="this.closest('dialog').close()" type="button">
      Close record
     </button>
</footer>
</div>
</dialog>
<script>
   document.querySelectorAll("dialog.modal").forEach((dialog) => {
    dialog.addEventListener("click", (event) => {
     if (event.target === dialog) {
      dialog.close();
     }
    });

    dialog.addEventListener("close", () => {
     const openerId = dialog.dataset.openerId;
     if (openerId) {
      document.getElementById(openerId)?.focus();
     }
    });
   });
  </script>
<script id="cerilloRecordTabs">
   document.querySelectorAll("[data-record-tabs]").forEach((tabs) => {
    tabs.addEventListener("click", (event) => {
     const button = event.target.closest("[data-record-tab]");
     if (!button) return;

     const dialog = button.closest("dialog");
     const target = button.dataset.recordTab;

     dialog.querySelectorAll("[data-record-tab]").forEach((item) => {
      item.classList.toggle("active", item === button);
     });

     dialog.querySelectorAll("[data-record-panel]").forEach((panel) => {
      panel.classList.toggle("active", panel.dataset.recordPanel === target);
     });
    });
   });
  </script>
<script id="cerilloTableSearch">
   document.querySelectorAll("[data-table-search]").forEach((input) => {
    input.addEventListener("input", () => {
     const table = document.getElementById(input.dataset.tableSearch);
     if (!table) return;
     const query = input.value.trim().toLowerCase();
     table.querySelectorAll("tbody tr").forEach((row) => {
      row.hidden = query && !row.textContent.toLowerCase().includes(query);
     });
    });
   });
  </script>
<script id="cerilloThemeBootstrap">
   (function(){
  const saved = localStorage.getItem('cerilloDarkMode') === 'true';
  document.body.classList.toggle('dark-mode', saved);
  const toggle = document.getElementById('darkModeToggle');
  if (toggle) {
    toggle.checked = saved;
    toggle.addEventListener('change', function(){
      document.body.classList.toggle('dark-mode', this.checked);
      localStorage.setItem('cerilloDarkMode', String(this.checked));
    });
  }
})();
  </script>
<script id="frontDeskAppointmentWorkflow">
   let activeFrontAppointmentRow = null;

function cerilloBlocks() {
  try {
    return JSON.parse(localStorage.getItem('cerilloDentistBlocks') || '[]');
  } catch (error) {
    return [];
  }
}

function renderSharedAvailability() {
  const holder = document.getElementById('frontAvailabilityChips');
  if (!holder) return;

  const blocks = cerilloBlocks();
  holder.innerHTML = blocks.length
    ? blocks.map((block) => `
        <span class="availability-chip">
          <strong>${block.dentist || 'Dentist'}</strong>
          ${block.label || block.date} · ${block.time || 'All day'} · ${block.reason}
        </span>
      `).join('')
    : '<span class="availability-empty">No additional blocked schedules.</span>';
}

async function openFrontAppointment(button) {
  activeFrontAppointmentRow = button.closest('tr');
  let data = button.dataset;
  if (!data.appointmentId) {
    alert('This appointment is not linked to a database record. Refresh the appointments list and try again.');
    return;
  }
  if (data.appointmentId) {
    try {
      const response = await fetch('/api/appointments/' + encodeURIComponent(data.appointmentId), { headers: { Accept: 'application/json' } });
      if (!response.ok) throw new Error('Appointment details could not be loaded.');
      const appointment = await response.json();
      const starts = new Date(appointment.starts_at);
      const eventTime = appointment.status === 'Checked In'
        ? appointment.checked_in_at
        : appointment.status === 'Cancelled' ? appointment.cancelled_at : null;

      const timeFormatted = (function(raw) {
        if (!raw) return '—';
        const m = String(raw).match(/[ T](\d{2}):(\d{2})/);
        if (m) {
          const h = Number(m[1]), min = m[2];
          return `${h % 12 || 12}:${min} ${h >= 12 ? 'PM' : 'AM'}`;
        }
        const p = new Date(raw);
        return isNaN(p.getTime()) ? '—' : p.toLocaleTimeString('en-US', {hour:'numeric',minute:'2-digit',hour12:true});
      })(appointment.starts_at);

      const arrivalFormatted = (function(raw) {
        if (!raw) return '—';
        const m = String(raw).match(/[ T](\d{2}):(\d{2})/);
        if (m) {
          const h = Number(m[1]), min = m[2];
          return `${h % 12 || 12}:${min} ${h >= 12 ? 'PM' : 'AM'}`;
        }
        const p = new Date(raw);
        return isNaN(p.getTime()) ? '—' : p.toLocaleTimeString('en-US', {hour:'numeric',minute:'2-digit',hour12:true});
      })(eventTime);

      const rawDob = appointment.patient?.date_of_birth || appointment.intake_details?.date_of_birth;
      let dobAgeStr = '—';
      if (rawDob) {
        const dobVal = String(rawDob).slice(0, 10);
        const ageVal = Math.floor((Date.now() - new Date(dobVal).getTime()) / 31557600000);
        dobAgeStr = `${dobVal} || ${ageVal >= 0 ? ageVal : '—'}`;
      }

      data = {
        appointmentId: String(appointment.id),
        patientId: String(appointment.patient?.formatted_patient_code || window.CerilloFormat?.patientCode(appointment.patient?.patient_code, appointment.patient?.id) || ''),
        patient: appointment.patient?.name || appointment.guest_name || 'Visitor',
        service: appointment.service?.name || 'Appointment',
        datetime: `${starts.toLocaleDateString(undefined, { day: '2-digit', month: 'short', year: 'numeric' })} · ${timeFormatted}`,
        dentist: appointment.dentist?.name || 'Unassigned',
        arrival: arrivalFormatted,
        dob: dobAgeStr,
        status: ['Pending', 'Checked In', 'Cancelled'].includes(appointment.status) ? appointment.status : 'Pending'
      };
      button.dataset.status = data.status;
      button.dataset.arrival = data.arrival;
      document.getElementById('frontAppointmentSub').textContent = `Appointment #${appointment.id} · ${appointment.source === 'walk_in' ? 'Front Desk registration' : 'Online request'}`;
    } catch (error) {
      alert(error.message);
      return;
    }
  }

  document.getElementById('frontAppointmentPatient').textContent = data.patient;
  document.getElementById('frontAppointmentTitle').textContent = `${data.patient} · ${data.service}`;
  document.getElementById('frontAppointmentTime').textContent = data.datetime;
  document.getElementById('frontAppointmentProcedure').textContent = data.service;
  document.getElementById('frontAppointmentDentist').textContent = data.dentist;
  document.getElementById('frontAppointmentArrival').textContent = data.arrival || '—';
  const frontApptDobEl = document.getElementById('frontAppointmentDob');
  if (frontApptDobEl) frontApptDobEl.textContent = data.dob || '—';
  document.getElementById('frontAppointmentStatus').value = data.status || 'Pending';
  document.getElementById('frontAppointmentPill').textContent = data.status || 'Pending';
  document.getElementById('cancellationReason').value = '';
  document.getElementById('cancellationNotes').value = '';

  toggleCancellation();
  const frontAppointmentModal = document.getElementById('frontAppointmentModal');
  frontAppointmentModal.dataset.patientName = data.patient || '';
  frontAppointmentModal.dataset.patientId = data.patientId || data.appointmentId || button.dataset.patientId || data.patient || '';
  frontAppointmentModal.showModal();
}

function toggleCancellation() {
  const statusSelect = document.getElementById('frontAppointmentStatus');
  if (!statusSelect) return;

  const cancelled = statusSelect.value === 'Cancelled';
  document.getElementById('cancellationPanel').hidden = !cancelled;
  document.getElementById('cancellationReason').required = cancelled;
  document.getElementById('arrivalField').hidden = statusSelect.value !== 'Checked In';
}

document.getElementById('frontAppointmentStatus')?.addEventListener('change', toggleCancellation);

document.getElementById('saveFrontAppointmentStatus')?.addEventListener('click', async () => {
  const status = document.getElementById('frontAppointmentStatus').value;
  const reason = document.getElementById('cancellationReason');

  if (status === 'Cancelled' && !reason.value) {
    reason.reportValidity();
    return;
  }

  const appointmentId = activeFrontAppointmentRow?.dataset.appointmentId || activeFrontAppointmentRow?.querySelector('.appointment-view')?.dataset.appointmentId;
  let savedAppointment = null;
  if (appointmentId) {
    // Online requests must be verified on the server before a status transition.
    const originalStatus = activeFrontAppointmentRow?.dataset.status;
    if (originalStatus === 'Pending Verification' && status !== 'Cancelled') {
      const verification = await fetch('/api/appointments/' + encodeURIComponent(appointmentId) + '/verify', {
        method: 'POST', headers: { Accept: 'application/json', 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
        body: JSON.stringify({})
      });
      const verified = await verification.json().catch(() => ({}));
      if (!verification.ok) { alert(verified.message || 'Unable to verify appointment'); return; }
      activeFrontAppointmentRow.dataset.status = verified.status;
    }
    const response = await fetch('/api/appointments/' + encodeURIComponent(appointmentId) + '/status', {
      method: 'PATCH',
      headers: { Accept: 'application/json', 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
      body: JSON.stringify({
        status,
        cancellation_reason: status === 'Cancelled'
          ? `${reason.value}${document.getElementById('cancellationNotes').value ? ' — ' + document.getElementById('cancellationNotes').value : ''}`
          : null
      })
    });
    const payload = await response.json().catch(() => ({}));
    if (!response.ok) {
      alert(payload.message || 'Appointment status could not be saved.');
      return;
    }
    savedAppointment = payload;
  }

  if (activeFrontAppointmentRow) {
    const cells = activeFrontAppointmentRow.querySelectorAll('td');
    const timestamp = status === 'Checked In' ? savedAppointment?.checked_in_at
      : status === 'Cancelled' ? savedAppointment?.cancelled_at : null;
    const arrival = timestamp ? new Date(timestamp).toLocaleTimeString([], {
      hour: 'numeric',
      minute: '2-digit'
    }) : '—';

    if (cells[5]) {
      cells[5].innerHTML = `<span class="status ${status === 'Cancelled' ? 'danger' : status === 'Checked In' ? 'info' : 'warning'}">${status}</span>`;
    }
    activeFrontAppointmentRow.dataset.filterTags = status;
    activeFrontAppointmentRow.dataset.status = status;
    window.dispatchEvent(new CustomEvent('cerillo-queue-refresh'));

    const viewButton = activeFrontAppointmentRow.querySelector('.appointment-view');
    viewButton.dataset.status = status;
    viewButton.dataset.arrival = arrival;

    const updates = JSON.parse(localStorage.getItem('cerilloAppointmentUpdates') || '{}');
    updates[activeFrontAppointmentRow.dataset.appointmentId || viewButton.dataset.datetime] = {
      status,
      arrival,
      cancellationReason: status === 'Cancelled' ? reason.value : '',
      cancellationNotes: status === 'Cancelled'
        ? document.getElementById('cancellationNotes').value
        : ''
    };
    // Database is authoritative. Do not persist status overrides that can contradict failed server updates.
    localStorage.removeItem('cerilloAppointmentUpdates');
  }

  const patient = document.getElementById('frontAppointmentPatient').textContent;
  const offerAnotherAppointment = status === 'Cancelled'
    && document.getElementById('offerReschedule').checked;

  document.getElementById('frontAppointmentModal').close();

  if (offerAnotherAppointment) {
    const registerModal = document.getElementById('registerAppointmentModal');
    if (registerModal) {
      const nameParts = patient.trim().split(/\s+/);
      const inputs = registerModal.querySelectorAll('input');
      if (inputs[0]) inputs[0].value = nameParts[0] || '';
      if (inputs[1]) inputs[1].value = nameParts.slice(1).join(' ');
      registerModal.showModal();
    }
  }
});

function conflictsWithBlock(dentist, date, time) {
  return cerilloBlocks().some((block) => {
    const normalizedDentist = dentist.replace('Dr. ', '');
    const normalizedBlockDentist = (block.dentist || '').replace('Dr. ', '');

    if (
      block.dentist
      && dentist
      && !normalizedDentist.includes(normalizedBlockDentist)
      && !normalizedBlockDentist.includes(normalizedDentist)
    ) {
      return false;
    }

    const withinDate = block.type === 'week'
      ? date >= block.date && date <= block.endDate
      : date === block.date;

    if (!withinDate) return false;
    if (block.type === 'date' || block.type === 'week' || !block.startTime) return true;

    return time >= block.startTime && time <= block.endTime;
  });
}

['newAppointmentDentist', 'newAppointmentDate', 'newAppointmentTime'].forEach((id) => {
  document.getElementById(id)?.addEventListener('change', () => {
    const dentist = document.getElementById('newAppointmentDentist').value;
    const date = document.getElementById('newAppointmentDate').value;
    const time = document.getElementById('newAppointmentTime').value;
    const statusBox = document.getElementById('appointmentAvailabilityCheck');

    if (!dentist || !date || !time) {
      statusBox.textContent = 'Select a dentist, date, and time to check blocked schedules.';
      statusBox.className = 'availability-check';
      return;
    }

    const unavailable = conflictsWithBlock(dentist, date, time);
    statusBox.textContent = unavailable
      ? 'This schedule conflicts with a dentist unavailable block. Choose another time.'
      : 'No dentist availability conflict found for this time.';
    statusBox.className = `availability-check ${unavailable ? 'danger' : 'success'}`;
  });
});

document.getElementById('addAppointmentForm')?.addEventListener('submit', (event) => {
  event.preventDefault();

  const dentist = document.getElementById('newAppointmentDentist').value;
  const date = document.getElementById('newAppointmentDate').value;
  const time = document.getElementById('newAppointmentTime').value;

  if (conflictsWithBlock(dentist, date, time)) {
    const statusBox = document.getElementById('appointmentAvailabilityCheck');
    statusBox.textContent = 'Cannot create appointment: dentist is unavailable at this time.';
    statusBox.className = 'availability-check danger';
    return;
  }

  const patient = document.getElementById('newAppointmentPatient').value;
  const service = document.getElementById('newAppointmentService').value;
  const tableBody = document.querySelector('#frontAppointmentTable tbody');
  const row = document.createElement('tr');

  row.dataset.appointmentId = `APT-FD-${Date.now()}`;
  row.innerHTML = `
    <td>${date} · ${time}</td>
    <td>${patient}</td>
    <td>${service}</td>
    <td>${dentist}</td>
    <td>Pending</td>
    <td>—</td>
    <td><button class="action-btn appointment-view" type="button">View</button></td>
  `;

  const viewButton = row.querySelector('button');
  Object.assign(viewButton.dataset, {
    patient,
    service,
    dentist,
    datetime: `${date} · ${time}`,
    status: 'Pending',
    arrival: '—'
  });
  viewButton.addEventListener('click', () => openFrontAppointment(viewButton));

  tableBody.prepend(row);

  event.target.reset();
  document.getElementById('addAppointmentModal').close();
});

renderSharedAvailability();
window.addEventListener('storage', renderSharedAvailability);
  </script>
<dialog class="modal modal-lg visit-history-detail-modal" id="visitHistoryModal">
<div class="modal-shell">
<header class="modal-header">
<div>
<p class="eyebrow">
       Completed Visit
      </p>
<h3 data-vh-title="">
       Composite Restoration
      </h3>
</div>
<button class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</header>
<div class="modal-body">
<div class="clinical-grid two-col">
<article class="info-card">
<h4>
        Visit details
       </h4>
<dl class="detail-list">
<div>
<dt>
          Dentist
         </dt>
<dd data-vh-dentist="">
          Dr. Ana Cerillo
         </dd>
</div>
<div>
<dt>
          Service
         </dt>
<dd data-vh-service="">
          Composite Restoration
         </dd>
</div>
<div>
<dt>
          Date &amp; Time
         </dt>
<dd data-vh-datetime="">
          03 Oct 2026 · 10:15 AM
         </dd>
</div>
<div>
<dt>
          Status
         </dt>
<dd data-vh-status="">
          <span class="status success">Completed</span>
         </dd>
</div>
</dl>
</article>
<article class="info-card">
<h4>
        Clinical findings
       </h4>
<p data-vh-findings="">
        No clinical findings recorded.
       </p>
<h4>
        Diagnosis &amp; Treatment Plan
       </h4>
<p data-vh-diagnosis="">
        Routine dental care and recall.
       </p>
<h4>
        Dentist notes
       </h4>
<p data-vh-notes="">
        No notes recorded.
       </p>
<div data-vh-prescriptions-wrap="" hidden="">
<h4>
        Prescriptions
       </h4>
<p data-vh-prescriptions="">
        None
       </p>
</div>
</article>
</div>
</div>
<footer class="modal-footer">
<button class="btn btn-secondary" onclick="this.closest('dialog').close()" type="button">
      Close
     </button>
</footer>
</div>
</dialog>
<dialog class="modal modal-lg" id="patientXrayModal">
<div class="modal-shell xray-add-shell">
<header class="modal-header">
<div>
<p class="eyebrow">
       Patient X-ray
      </p>
<h3>
       Add X-ray to Maria Santos
      </h3>
</div>
<button class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</header>
<div class="modal-body xray-add-body">
<form class="form-grid">
<label>
       Patient
       <input readonly="" value="Maria Santos · PT-2026-0018"/>
</label>
<label>
       X-ray type
       <select required="">
<option>
         Full-mouth series (FMX)
        </option>
<option>
         Panoramic
        </option>
<option>
         Bitewing series
        </option>
<option>
         Periapical series
        </option>
<option>
         CBCT
        </option>
</select>
</label>
<label>
       Date taken
       <input required="" type="date" value="2026-10-04"/>
</label>
<label>
       Clinical indication
       <select required="">
<option>
         New-patient baseline assessment
        </option>
<option>
         Routine diagnostic review
        </option>
<option>
         Pain / swelling evaluation
        </option>
<option>
         Pre-operative assessment
        </option>
<option>
         Post-operative review
        </option>
<option>
         Periodontal assessment
        </option>
<option>
         Implant / prosthetic planning
        </option>
<option>
         Orthodontic assessment
        </option>
</select>
</label>
<label class="span-2">
       Clinical findings
       <textarea required="" rows="4"></textarea>
</label>
<label class="span-2">
       Attach image(s)
       <input accept="image/*" multiple="" required="" type="file"/>
</label>
</form>
</div>
<footer class="modal-footer xray-add-footer">
<button class="btn btn-secondary" onclick="this.closest('dialog').close()" type="button">
      Cancel
     </button>
<button class="btn" type="button">
      Attach to Patient Record
     </button>
</footer>
</div>
</dialog>
<dialog class="modal modal-lg" id="checkoutModal">
<div class="modal-shell">
<header class="modal-header">
<div>
<p class="eyebrow">
       Payment
      </p>
<h3>
       Patient Checkout
      </h3>
</div>
<button class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</header>
<div class="modal-body">
<div class="clinical-grid two-col">
<article class="info-card" id="checkoutPatientCard">
<h4 id="checkoutPatientName">
        Select Patient
       </h4>
<p>
        Outstanding balance
       </p>
<strong class="amount-lg" id="checkoutOutstandingAmount">
        ₱0.00
       </strong>
<p id="checkoutTreatmentDesc">
        No active treatment selected
       </p>
<div id="checkoutPatientMeta" class="small muted" style="margin-top:6px;">
        Patient ID: <span id="checkoutPatientCode">—</span>
</div>
</article>
<form class="form-grid" id="checkoutPaymentForm">
<input type="hidden" id="checkoutPatientId" value="" />
<input type="hidden" id="checkoutAppointmentId" value="" />
<label>Patient
<select id="checkoutPatientSelect" required>
  <option value="">Choose patient...</option>
  @foreach($patients as $p)
    <option value="{{ $p->id }}" data-code="{{ $p->formatted_patient_code }}">{{ $p->name }} ({{ $p->formatted_patient_code }})</option>
  @endforeach
</select>
</label>
<label>Treatment / service<select id="checkoutService">
  @foreach($services as $s)
    <option value="{{ $s->name }}" data-price="{{ $s->price }}" data-service-id="{{ $s->id }}">{{ $s->name }} (₱{{ number_format($s->price, 2) }})</option>
  @endforeach
</select></label>
<label>
        Amount to pay (₱)
        <input id="checkoutAmountToPay" min="0.01" step="0.01" required="" type="number" placeholder="0.00" value="0.00"/>
</label>
<label>
        Payment method
        <select id="checkoutPaymentMethod" required="">
<option value="Cash">
          Cash
         </option>
<option value="GCash">
          GCash
         </option>
<option value="Card">
          Card
         </option>
<option value="Bank Transfer">
          Bank Transfer
         </option>
</select>
</label>
<label class="span-2">
        Reference / Notes
        <input id="checkoutPaymentNotes" placeholder="Optional reference / invoice note"/>
</label>
<div class="ortho-installment-fields" hidden="" id="orthoInstallmentFields"><strong>Orthodontic Braces installment plan</strong><p class="small muted">Installments are available only for braces.</p><div class="form-grid"><label>Payment arrangement<select id="orthoPaymentArrangement"><option>Full payment</option><option>Installment</option></select></label><label>Down payment (₱)<input id="orthoDownPayment" min="0" type="number" value="5000"/></label><label>Installment term<select id="orthoInstallmentTerm"><option>3 months</option><option>6 months</option><option>12 months</option><option>18 months</option></select></label><label>Monthly installment (₱)<input id="orthoMonthlyAmount" min="0" placeholder="Calculated / agreed amount" type="number"/></label></div></div><div class="form-actions span-2">
<button class="btn btn-secondary" onclick="this.closest('dialog').close()" type="button">
         Cancel
        </button>
<button class="btn btn-success" id="processCheckoutBtn" type="submit">
         Process Payment
        </button>
</div>
</form>
</div>
</div>
</div>
</dialog>
<dialog class="modal modal-lg request-review-modal" id="publicRequestReviewModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">Front Desk · Appointment Request</p>
<h3 data-request-title="">Review Appointment Request</h3>
<p data-request-reference="">Verify the request before assigning the appointment.</p>
</div>
<button aria-label="Close appointment request" class="icon-btn" onclick="this.closest('dialog').close()" type="button">×</button>
</div>
<div class="modal-body request-review-body">
<div class="appointment-banner request-review-banner">
<div><h4>Requested appointment</h4><p>Confirm patient details, schedule, and dentist assignment.</p></div>
<span class="status-pill warning">Pending Review</span>
</div>
<div class="request-review-grid" data-request-review-grid=""></div>
<section class="request-assignment-card">
<div class="form-section-title"><div><h4>Appointment assignment</h4><p>Front Desk confirms the assigned dentist and final reception status.</p></div></div>
<div class="form-grid two-col">
<label>Assign dentist<select id="publicRequestDentist"><option>Dr. Ana Cerillo</option><option>Dr. Paolo Reyes</option><option>Dr. Angela Cerillo</option></select></label>
<label>Final appointment status<select id="publicRequestFinalStatus"><option>Pending</option><option>Checked In</option></select></label>
</div>
<div class="ortho-lock-note" hidden id="publicRequestOrthoNote">Orthodontic requests are locked to the orthodontic dentist and cannot be reassigned by Front Desk.</div>
</section>
</div>
<div class="dialog-footer request-review-footer">
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">Close</button>
<button class="btn" id="acceptPublicRequest" type="button">Accept &amp; Assign Appointment</button>
</div>
</div>
</dialog><dialog class="modal modal-xl" id="registerAppointmentModal">
<div class="modal-shell registration-modal-shell">
<header class="modal-header">
<div>
<p class="eyebrow">
       Front Desk Registration
      </p>
<h3>
       Register Patient &amp; Book Appointment
      </h3>
<p>
       Complete the patient record first, then choose the requested treatment and schedule.
      </p>
</div>
<button class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</header>
<div class="modal-body long-form-modal registration-modal-body">
<form class="stacked-booking-form">
<section class="booking-step">
<div class="step-heading">
<span>
         1
        </span>
<div>
<h4>
          Patient Information
         </h4>
<p>
          Search an existing patient or register a new patient.
         </p>
</div>
</div>
<div aria-label="Patient registration type" class="registration-patient-mode" role="group">
<button class="active" data-registration-mode="new" type="button">New patient</button>
<button data-registration-mode="existing" type="button">Existing patient</button>
</div>
<div class="existing-patient-picker" hidden="" id="existingPatientPicker">
<div class="existing-patient-select-card">
<label>
<span>Existing patient</span>
<small>Choose a patient record to reuse verified contact and medical information.</small>
<select id="existingPatientSelect">
<option value="">Loading patient records from database...</option>
</select>
</label>
</div>
<div class="existing-patient-summary" id="existingPatientSummary">
<div><small>Patient ID</small><strong>—</strong></div>
<div><small>Contact</small><strong>—</strong></div>
<div><small>Email</small><strong>—</strong></div>
</div>
</div>
<div class="form-grid new-patient-fields" id="newPatientFields">
<label>
         First name
         <input id="regFirstName" required=""/>
</label>
<label>
         Last name
         <input id="regLastName" required=""/>
</label>
<label>
         Date of birth
         <input id="regDob" required="" type="date"/>
</label>
<label>
         Sex
         <select id="regSex" required="">
<option>
           Female
          </option>
<option>
           Male
          </option>
<option>
           Prefer not to say
          </option>
</select>
</label>
<label>
         Email
         <input id="regEmail" required="" type="email"/>
</label>
<label>
         Primary phone
         <div class="phone-input">
<span>
           +63
          </span>
<input id="regPhone" pattern="9[0-9]{9}" placeholder="9171234567" required=""/>
</div>
</label>
<label>
         Secondary phone (optional)
         <div class="phone-input">
<span>
           +63
          </span>
<input id="regPhone2" pattern="9[0-9]{9}" placeholder="9187654321"/>
</div>
</label>
<label>
         Last dental visit
         <input id="regLastDentalVisit" type="date"/>
</label>
<label class="span-2">
         Address
         <input id="regAddress" required=""/>
</label>
<label>
         Allergies
         <textarea id="regAllergies" placeholder="Type None if none" required="" rows="3"></textarea>
</label>
<label>
         Current medications
         <textarea id="regMeds" placeholder="Type None if none" required="" rows="3"></textarea>
</label>
<label class="span-2">
         Medical history
         <textarea id="regMedicalHistory" placeholder="Relevant medical conditions, surgeries, pregnancy, bleeding risk, etc." rows="3"></textarea>
</label>
<label>
         Dental anxiety
         <select id="regAnxiety">
<option>Low</option>
<option>Moderate</option>
<option>High</option>
</select>
</label>
<label>
         Bleeding tendency
         <select id="regBleeding">
<option>No known issue</option>
<option>Yes / under medical care</option>
<option>Unsure</option>
</select>
</label>
<label>
         Pregnancy status
         <select id="regPregnancy">
<option>Not applicable / No</option>
<option>Pregnant</option>
<option>Possibly pregnant</option>
<option>Prefer not to say</option>
</select>
</label>
</div>
</section>
<section class="booking-step">
<div class="step-heading">
<span>
         2
        </span>
<div>
<h4>
          Appointment Request
         </h4>
<p>
          Choose the service, requested dentist and an available date/time.
         </p>
</div>
</div>
<div class="form-grid">
<label>
         Service
         <select id="regService" required="">
<option>
           Dental Examination
          </option>
<option>
           Oral Prophylaxis
          </option>
<option>
           Composite Restoration
          </option>
<option>
           Root Canal Therapy
          </option>
<option>
           Tooth Extraction
          </option>
<option>
           Dental Crown
          </option>
<option>
           Teeth Whitening
          </option>
</select>
</label>
<label>
         Requested dentist
         <select id="regDentist" required="">
<option>
           Dr. Ana Cerillo
          </option>
<option>
           Dr. Paolo Reyes
          </option>
<option>
           Dr. Mia Tan
          </option>
</select>
</label>
<label>
         Date
         <input id="regDate" required="" type="date"/>
</label>
<label>
         Time
         <select id="regTime" required="">
<option value="">Select dentist and date first</option>
</select>
</label>
<label>
         Reason for visit
         <textarea id="regReason" required placeholder="Chief complaint / purpose" rows="3"></textarea>
</label>
<label>
         Preferred contact
         <select id="regContactPreference">
<option>
           SMS
          </option>
<option>
           Email
          </option>
<option>
           Phone call
          </option>
</select>
</label>
<label class="span-2">
         Appointment notes
         <textarea id="regNotes" rows="4"></textarea>
</label>
</div>
<div class="availability-note success">
<strong>
         Schedule validation
        </strong>
<span>
         Available — no dentist availability block conflicts with this requested time.
        </span>
</div>
</section>
<div class="form-actions">
<button class="btn btn-secondary" onclick="this.closest('dialog').close()" type="button">
        Cancel
       </button>
<button class="btn" id="saveRegisteredAppointment" type="button">
        Register Patient &amp; Confirm Appointment
       </button>
</div>
</form>
</div>
</div>
</dialog>
<script id="multiToothChartWorkflow">
   (function bindMultiToothChart() {
  function selectedTeeth(dialog) {
    return Array.from(dialog.querySelectorAll('.tooth-unit.tooth-picked'));
  }

  function updateSelectionSummary(dialog) {
    const selected = selectedTeeth(dialog);
    const title = dialog.querySelector('#selectedToothTitle');
    const count = dialog.querySelector('[data-selected-tooth-count]');
    if (count) count.textContent = selected.length ? `${selected.length} selected` : 'No teeth selected';
    if (title) {
      if (!selected.length) {
        title.textContent = 'Select one or more teeth';
      } else if (selected.length === 1) {
        title.textContent = `Tooth #${selected[0].dataset.tooth} — ${selected[0].dataset.toothName}`;
      } else {
        title.textContent = `${selected.length} teeth selected · ${selected.map((tooth) => '#' + tooth.dataset.tooth).join(', ')}`;
      }
    }
    draftProgressNote(dialog);
  }

  function draftProgressNote(dialog) {
    const selected = selectedTeeth(dialog);
    const note = dialog.querySelector('#autoProgressNote');
    if (!note) return;
    if (!selected.length) {
      note.value = 'Select one or more teeth to draft the clinical progress note.';
      return;
    }
    const condition = dialog.querySelector('#toothCondition')?.value || 'clinical finding';
    const clinicalStatus = dialog.querySelector('#toothClinicalStatus')?.value || 'Finding documented';
    const surfaces = Array.from(dialog.querySelectorAll('.surface-fieldset input:checked')).map((item) => item.value).join('') || 'unspecified surface';
    const treatment = dialog.querySelector('#toothTreatment')?.value || 'None';
    note.value = `${selected.map((tooth) => 'Tooth #' + tooth.dataset.tooth).join(', ')}: ${condition} on ${surfaces}. Status: ${clinicalStatus}. Treatment: ${treatment}.`;
  }

  function statusClass(status, presence, condition, treatment) {
    if (['Missing', 'Previously Extracted'].includes(presence)) return 'tooth-missing';
    if (presence === 'Impacted' || condition.includes('Impacted')) return 'tooth-impacted';
    if (status === 'Completed / Restored') return 'tooth-completed';
    if (status === 'Treatment Planned') return 'tooth-planned';
    if (condition.includes('Caries')) return 'tooth-decay';
    if (status === 'Sound / Healthy') return 'tooth-sound';
    return 'tooth-finding';
  }

  document.addEventListener('click', (event) => {
    const tooth = event.target.closest('.tooth-unit');
    if (tooth && tooth.closest('.clinical-record-modal')) {
      const dialog = tooth.closest('.clinical-record-modal');
      tooth.classList.toggle('tooth-picked');
      tooth.setAttribute('aria-pressed', tooth.classList.contains('tooth-picked') ? 'true' : 'false');
      updateSelectionSummary(dialog);
      return;
    }

    const toggle = event.target.closest('[data-dentition]');
    if (toggle) {
      const dialog = toggle.closest('dialog');
      if (!dialog) return;
      dialog.querySelectorAll('[data-dentition]').forEach((button) => button.classList.remove('active'));
      toggle.classList.add('active');
      dialog.querySelectorAll('[data-dentition-grid]').forEach((grid) => {
        grid.classList.toggle('hidden', grid.dataset.dentitionGrid !== toggle.dataset.dentition);
      });
      dialog.querySelectorAll('.tooth-unit.tooth-picked').forEach((tooth) => {
        tooth.classList.remove('tooth-picked');
        tooth.setAttribute('aria-pressed', 'false');
      });
      updateSelectionSummary(dialog);
      return;
    }

    const apply = event.target.closest('[data-apply-to-selected]');
    if (apply) {
      const dialog = apply.closest('dialog');
      const selected = selectedTeeth(dialog);
      if (!selected.length) {
        const message = dialog.querySelector('[data-tooth-form-message]');
        if (message) message.textContent = 'Select at least one tooth before applying chart data.';
        return;
      }
      const presence = dialog.querySelector('#toothPresence')?.value || 'Present';
      const condition = dialog.querySelector('#toothCondition')?.value || 'Sound / Healthy (S)';
      const treatment = dialog.querySelector('#toothTreatment')?.value || 'None';
      const status = dialog.querySelector('#toothClinicalStatus')?.value || 'Finding Documented';
      const pulpal = dialog.querySelector('#toothPulpalDiagnosis')?.value || '';
      const apical = dialog.querySelector('#toothApicalDiagnosis')?.value || '';
      const code = dialog.querySelector('#toothProcedureCode')?.value || '';
      const notes = dialog.querySelector('#toothClinicalNotes')?.value || '';
      const surfaces = Array.from(dialog.querySelectorAll('.surface-fieldset input:checked')).map((item) => item.value).join('');
      const cls = statusClass(status, presence, condition, treatment);
      const allStateClasses = ['tooth-sound','tooth-decay','tooth-finding','tooth-planned','tooth-completed','tooth-missing','tooth-impacted'];

      selected.forEach((tooth) => {
        tooth.classList.remove(...allStateClasses);
        tooth.classList.add(cls);
        tooth.dataset.presence = presence;
        tooth.dataset.condition = condition;
        tooth.dataset.treatment = treatment;
        tooth.dataset.clinicalStatus = status;
        tooth.dataset.pulpal = pulpal;
        tooth.dataset.apical = apical;
        tooth.dataset.code = code;
        tooth.dataset.notes = notes;
        tooth.dataset.surfaces = surfaces;
      });

      const message = dialog.querySelector('[data-tooth-form-message]');
      if (message) message.textContent = `Chart data applied to ${selected.length} ${selected.length === 1 ? 'tooth' : 'teeth'}.`;
      draftProgressNote(dialog);
    }
  });

  document.addEventListener('change', (event) => {
    if (!event.target.closest('.clinical-record-modal')) return;
    if (event.target.matches('#toothPresence, #toothCondition, #toothTreatment, #toothClinicalStatus, #toothPulpalDiagnosis, #toothApicalDiagnosis, #toothProcedureCode') || event.target.closest('.surface-fieldset')) {
      const dialog = event.target.closest('.clinical-record-modal');
      const presence = dialog.querySelector('#toothPresence')?.value || 'Present';
      const treatment = dialog.querySelector('#toothTreatment');
      if (treatment) treatment.disabled = ['Missing', 'Previously Extracted'].includes(presence);
      draftProgressNote(dialog);
    }
  });
})();
  </script>
<script id="frontDeskRegistrationMode">
   (function () {
    const modal = document.getElementById('registerAppointmentModal');
    if (!modal) return;
    const modeButtons = modal.querySelectorAll('[data-registration-mode]');
    const picker = document.getElementById('existingPatientPicker');
    const newFields = document.getElementById('newPatientFields');
    const select = document.getElementById('existingPatientSelect');
    const summary = document.getElementById('existingPatientSummary');
    const newRequired = ['regFirstName','regLastName','regDob','regEmail','regPhone','regAddress','regAllergies','regMeds'];

    function setMode(mode) {
     modeButtons.forEach(function (button) {
      button.classList.toggle('active', button.dataset.registrationMode === mode);
     });
     const existing = mode === 'existing';
     picker.hidden = !existing;
     newFields.hidden = existing;
     select.required = existing;
     newRequired.forEach(function (id) {
      const input = document.getElementById(id);
      if (input) input.required = !existing;
     });
     modal.dataset.patientMode = mode;
    }

    async function fillExistingPatient() {
     const option = select.selectedOptions[0];
     const cells = summary.querySelectorAll('strong');
     if (!option || !option.value) {
      if (cells[0]) cells[0].textContent = '—';
      if (cells[1]) cells[1].textContent = '—';
      if (cells[2]) cells[2].textContent = '—';
      return;
     }
     if (cells[0]) cells[0].textContent = option.dataset.code || 'Loading...';
     if (cells[1]) cells[1].textContent = window.CerilloFormat?.phone(option.dataset.phone) || option.dataset.phone || '—';
     if (cells[2]) cells[2].textContent = option.dataset.email || '—';
     try {
      const response = await fetch('/api/patients/' + encodeURIComponent(option.value), { headers: { Accept: 'application/json' }, cache: 'no-store' });
      if (!response.ok) throw new Error('Patient details could not be loaded.');
      const payload = await response.json();
      const patient = payload.patient || {};
      const fullName = String(patient.name || option.dataset.name || '').trim().split(/\s+/);
      const map = {
       regFirstName: fullName.shift() || '',
       regLastName: fullName.join(' '),
       regDob: patient.date_of_birth || '',
       regEmail: patient.email || '',
       regPhone: window.CerilloFormat?.normalizePhone(patient.phone) || patient.phone || '',
       regAddress: patient.address && patient.address !== 'Not provided' ? patient.address : '',
       regAllergies: patient.allergies && !/^none( reported)?$/i.test(patient.allergies) ? patient.allergies : 'None',
       regMeds: patient.medications && !/^none$/i.test(patient.medications) ? patient.medications : 'None'
      };
      Object.entries(map).forEach(([id, value]) => { const input = document.getElementById(id); if (input) input.value = value || ''; });
      if (cells[0]) cells[0].textContent = patient.formatted_patient_code || option.dataset.code || '—';
      if (cells[1]) cells[1].textContent = patient.formatted_phone || window.CerilloFormat?.phone(patient.phone) || '—';
      if (cells[2]) cells[2].textContent = patient.email || '—';
     } catch (error) {
      if (cells[0]) cells[0].textContent = option.dataset.code || '—';
     }
    }

    modeButtons.forEach(function (button) {
     button.addEventListener('click', function () { setMode(button.dataset.registrationMode); });
    });
    select.addEventListener('change', fillExistingPatient);
    setMode(modal.dataset.patientMode || 'new');
   })();
  </script>
<script id="frontDeskConsolidatedBooking">
   (function(){
  document.querySelectorAll('#appointments .appointment-view').forEach(function(button){
    button.addEventListener('click', function(){ openFrontAppointment(button); });
  });

  const saveButton=document.getElementById('saveRegisteredAppointment');
  if(false && saveButton){
    saveButton.addEventListener('click', function(){
      const isExisting=document.getElementById('registerAppointmentModal')?.dataset.patientMode==='existing';
      const requiredIds=(isExisting?['existingPatientSelect']:['regFirstName','regLastName','regDob','regEmail','regPhone','regAddress','regAllergies','regMeds']).concat(['regService','regDentist','regDate','regTime']);
      for(const id of requiredIds){
        const el=document.getElementById(id);
        if(el && !el.checkValidity()){ el.reportValidity(); return; }
      }
      const phone=document.getElementById('regPhone');
      if(phone && !/^9\d{9}$/.test(phone.value)){ phone.setCustomValidity('Enter exactly 10 digits after +63, beginning with 9.'); phone.reportValidity(); return; }
      if(phone) phone.setCustomValidity('');
      const dentist=document.getElementById('regDentist').value;
      const date=document.getElementById('regDate').value;
      const time=document.getElementById('regTime').value.replace(/\s?(AM|PM)$/,'');
      if(typeof conflictsWithBlock==='function' && conflictsWithBlock(dentist,date,time)){
        alert('This dentist is unavailable at the selected date/time. Please choose another schedule.'); return;
      }
      const patient=document.getElementById('regFirstName').value.trim()+' '+document.getElementById('regLastName').value.trim();
      const service=document.getElementById('regService').value;
      const tbody=document.querySelector('#appointments tbody');
      const row=document.createElement('tr');
      row.dataset.appointmentId='APT-FD-'+Date.now();
      row.innerHTML=`<td>${patient}</td><td>${service}</td><td>${date}</td><td>${document.getElementById('regTime').value}</td><td>${dentist}</td><td><span class="status warning">Pending</span></td><td>—</td><td><button class="table-action appointment-view" type="button">View</button></td>`;
      const view=row.querySelector('button');
      Object.assign(view.dataset,{patient,service,dentist,datetime:`${date} · ${document.getElementById('regTime').value}`,status:'Pending',arrival:'—'});
      view.addEventListener('click',()=>openFrontAppointment(view));
      tbody.prepend(row);
      document.getElementById('registerAppointmentModal').close();
      alert('Patient registered and appointment created successfully.');
    });
  }
})();
  </script>
<script>
   (function () {
  function updateWorkspaceClock() {
    const now = new Date();
    const dateText = now.toLocaleDateString(undefined, {
      weekday: "long",
      month: "long",
      day: "numeric",
      year: "numeric"
    });
    const timeText = now.toLocaleTimeString(undefined, {
      hour: "numeric",
      minute: "2-digit",
      second: "2-digit"
    });

    document.querySelectorAll("[data-live-date]").forEach(function (node) {
      node.textContent = dateText;
    });
    document.querySelectorAll("[data-live-time]").forEach(function (node) {
      node.textContent = timeText;
    });
  }

  function applyTableFilter(details) {
    const tableId = details.dataset.filterFor;
    const table = document.getElementById(tableId);
    if (!table) return;

    const query = (details.querySelector("[data-filter-query]")?.value || "")
      .trim()
      .toLowerCase();
    const status = (details.querySelector("[data-filter-status]")?.value || "")
      .trim()
      .toLowerCase();

    table.querySelectorAll("tbody tr").forEach(function (row) {
      const text = (row.textContent + " " + (row.dataset.filterTags || "")).toLowerCase();
      const matchesQuery = !query || text.includes(query);
      const matchesStatus = !status || text.includes(status);
      row.hidden = !(matchesQuery && matchesStatus);
    });
  }

  updateWorkspaceClock();
  window.setInterval(updateWorkspaceClock, 1000);

  document.addEventListener("click", function (event) {
    const applyButton = event.target.closest("[data-filter-apply]");
    if (applyButton) {
      const details = applyButton.closest(".filter-popover");
      if (details) {
        applyTableFilter(details);
        details.open = false;
      }
      return;
    }

    const resetButton = event.target.closest("[data-filter-reset]");
    if (resetButton) {
      const details = resetButton.closest(".filter-popover");
      if (!details) return;
      const query = details.querySelector("[data-filter-query]");
      const status = details.querySelector("[data-filter-status]");
      if (query) query.value = "";
      if (status) status.value = "";
      applyTableFilter(details);
      details.open = false;
      return;
    }

    if (!event.target.closest(".filter-popover")) {
      document.querySelectorAll(".filter-popover[open]").forEach(function (item) {
        item.open = false;
      });
    }
  });

  document.addEventListener("keydown", function (event) {
    if (event.key !== "Enter") return;
    const input = event.target.closest("[data-filter-query]");
    if (!input) return;
    event.preventDefault();
    const details = input.closest(".filter-popover");
    if (details) {
      applyTableFilter(details);
      details.open = false;
    }
  });
})();
  </script>
<script id="cerilloTableToolsV2">
   (function bindCerilloTableTools() {
  function rowsFor(tableId) {
    const table = document.getElementById(tableId);
    return table ? Array.from(table.querySelectorAll('tbody tr')) : [];
  }

  document.querySelectorAll('[data-table-search]').forEach((input) => {
    if (input.dataset.boundTableSearch === 'true') return;
    input.dataset.boundTableSearch = 'true';
    input.addEventListener('input', () => {
      const query = input.value.trim().toLowerCase();
      rowsFor(input.dataset.tableSearch).forEach((row) => {
        const matches = !query || row.textContent.toLowerCase().includes(query);
        row.dataset.searchHidden = matches ? 'false' : 'true';
        const filterHidden = row.dataset.filterHidden === 'true';
        row.hidden = !matches || filterHidden;
      });
    });
  });

  document.querySelectorAll('[data-table-sort]').forEach((select) => {
    if (select.dataset.boundTableSort === 'true') return;
    select.dataset.boundTableSort = 'true';
    select.addEventListener('change', () => {
      const table = document.getElementById(select.dataset.tableSort);
      if (!table) return;
      const body = table.querySelector('tbody');
      const rows = Array.from(body.querySelectorAll('tr'));
      const direction = select.value;
      if (!direction) {
        rows.sort((a, b) => Number(a.dataset.originalIndex) - Number(b.dataset.originalIndex));
      } else {
        rows.sort((a, b) => {
          const aa = (a.cells[0]?.textContent || '').trim();
          const bb = (b.cells[0]?.textContent || '').trim();
          const ad = Date.parse(aa);
          const bd = Date.parse(bb);
          let result;
          if (!Number.isNaN(ad) && !Number.isNaN(bd)) {
            result = ad - bd;
          } else {
            const an = Number(aa.replace(/[^0-9.-]/g, ''));
            const bn = Number(bb.replace(/[^0-9.-]/g, ''));
            result = aa && bb && Number.isFinite(an) && Number.isFinite(bn) && /\d/.test(aa) && /\d/.test(bb)
              ? an - bn
              : aa.toLowerCase().localeCompare(bb.toLowerCase());
          }
          return direction === 'asc' ? result : -result;
        });
      }
      rows.forEach((row) => body.appendChild(row));
    });
  });

  document.querySelectorAll('table tbody tr').forEach((row, index) => {
    if (!row.dataset.originalIndex) row.dataset.originalIndex = String(index);
  });

  document.querySelectorAll('.filter-popover').forEach((details) => {
    const apply = details.querySelector('[data-filter-apply]');
    const reset = details.querySelector('[data-filter-reset]');
    const status = details.querySelector('[data-filter-status]');
    const keyword = details.querySelector('[data-filter-query]');
    const tableId = details.dataset.filterFor;

    function applyAdvancedFilter() {
      const statusValue = (status?.value || '').trim().toLowerCase();
      const keywordValue = (keyword?.value || '').trim().toLowerCase();
      rowsFor(tableId).forEach((row) => {
        const text = (row.textContent + ' ' + (row.dataset.filterTags || '')).toLowerCase();
        const matches = (!statusValue || text.includes(statusValue)) && (!keywordValue || text.includes(keywordValue));
        row.dataset.filterHidden = matches ? 'false' : 'true';
        const searchHidden = row.dataset.searchHidden === 'true';
        row.hidden = !matches || searchHidden;
      });
    }

    if (apply && apply.dataset.boundFilterV2 !== 'true') {
      apply.dataset.boundFilterV2 = 'true';
      apply.addEventListener('click', () => {
        applyAdvancedFilter();
        details.removeAttribute('open');
      });
    }
    if (reset && reset.dataset.boundFilterV2 !== 'true') {
      reset.dataset.boundFilterV2 = 'true';
      reset.addEventListener('click', () => {
        if (status) status.value = '';
        if (keyword) keyword.value = '';
        rowsFor(tableId).forEach((row) => {
          row.dataset.filterHidden = 'false';
          row.hidden = row.dataset.searchHidden === 'true';
        });
        details.removeAttribute('open');
      });
    }
  });
})();
  </script>
<script id="sharedAccessibilitySettings">
   (function bindSharedAccessibilitySettings() {
  const settings = [
    { id: 'largeText', key: 'cerilloLargeText', className: 'large-text' },
    { id: 'highContrast', key: 'cerilloHighContrast', className: 'high-contrast' },
    { id: 'reducedMotion', key: 'cerilloReducedMotion', className: 'reduced-motion' },
    { id: 'enhancedFocus', key: 'cerilloEnhancedFocus', className: 'enhanced-focus' }
  ];

  settings.forEach((setting) => {
    const input = document.getElementById(setting.id);
    if (!input) return;

    const savedValue = localStorage.getItem(setting.key);
    const enabled = savedValue === null ? Boolean(input.checked) : savedValue === 'true';
    input.checked = enabled;
    document.body.classList.toggle(setting.className, enabled);

    input.addEventListener('change', () => {
      document.body.classList.toggle(setting.className, input.checked);
      localStorage.setItem(setting.key, String(input.checked));
    });
  });
})();
  </script>
<script id="archOdontogramLayout">
   (function () {
    function classifyTooth(tooth) {
     const name = (tooth.dataset.toothName || '').toLowerCase();
     const numeric = Number(tooth.dataset.tooth);
     tooth.classList.remove('tooth-upper','tooth-lower','tooth-molar','tooth-premolar','tooth-canine','tooth-incisor');
     if (!Number.isNaN(numeric)) tooth.classList.add(numeric <= 16 ? 'tooth-upper' : 'tooth-lower');
     if (name.includes('molar')) tooth.classList.add('tooth-molar');
     else if (name.includes('premolar')) tooth.classList.add('tooth-premolar');
     else if (name.includes('canine')) tooth.classList.add('tooth-canine');
     else tooth.classList.add('tooth-incisor');
     tooth.style.removeProperty('--tooth-x');
     tooth.style.removeProperty('--tooth-y');
     tooth.style.removeProperty('--tooth-rotate');
     tooth.style.removeProperty('--tooth-size');
    }

    function prepareCharts() {
     document.querySelectorAll('.premium-dental-chart .tooth-unit').forEach(classifyTooth);
    }

    document.addEventListener('DOMContentLoaded', prepareCharts);
    document.addEventListener('click', function (event) {
     if (event.target.closest('[data-record-tab="chart"], [data-dentition]')) {
      requestAnimationFrame(prepareCharts);
     }
    });
    prepareCharts();
   })();
  </script>
<script id="premiumDentalChartUX">
   (function () {
    function selected(dialog) {
     return Array.from(dialog.querySelectorAll('.tooth-unit.tooth-picked'));
    }

    function renderChips(dialog) {
     const holder = dialog.querySelector('[data-selected-tooth-count]');
     const title = dialog.querySelector('#selectedToothTitle');
     if (!holder) return;
     const teeth = selected(dialog);
     if (!teeth.length) {
      holder.textContent = 'No teeth selected';
      if (title) title.textContent = 'Select one or more teeth';
      return;
     }
     holder.innerHTML = teeth.map(function (tooth) {
      const id = tooth.dataset.tooth;
      return '<span class="selected-tooth-chip">#' + id + '<button type="button" aria-label="Remove tooth ' + id + '" data-remove-selected-tooth="' + id + '">&times;</button></span>';
     }).join('');
     if (title) {
      title.textContent = teeth.length === 1
       ? 'Tooth #' + teeth[0].dataset.tooth + ' — ' + teeth[0].dataset.toothName
       : 'Selected Teeth (' + teeth.length + ')';
     }
    }

    function refresh(dialog) {
     requestAnimationFrame(function () { renderChips(dialog); });
    }

    document.addEventListener('click', function (event) {
     const dialog = event.target.closest('.clinical-record-modal');
     if (!dialog) return;

     const remove = event.target.closest('[data-remove-selected-tooth]');
     if (remove) {
      event.preventDefault();
      event.stopPropagation();
      const tooth = dialog.querySelector('.tooth-unit[data-tooth="' + remove.dataset.removeSelectedTooth + '"]');
      if (tooth && tooth.classList.contains('tooth-picked')) tooth.click();
      refresh(dialog);
      return;
     }

     if (event.target.closest('.tooth-unit')) {
      refresh(dialog);
      return;
     }

     if (event.target.closest('[data-chart-clear]')) {
      dialog.querySelectorAll('.tooth-unit.tooth-picked').forEach(function (tooth) { tooth.click(); });
      refresh(dialog);
      return;
     }

     if (event.target.closest('[data-chart-print]')) {
      window.print();
      return;
     }

     if (event.target.closest('[data-chart-save]')) {
      const message = dialog.querySelector('[data-tooth-form-message]');
      if (message) message.textContent = 'Dental chart changes saved for this patient record.';
      return;
     }

     const ref = event.target.closest('[data-chart-reference]');
     if (ref) {
      const target = ref.dataset.chartReference;
      if (target === 'history') dialog.querySelector('[data-record-tab="visits"]')?.click();
      if (target === 'images') dialog.querySelector('[data-record-tab="pxray"]')?.click();
      if (target === 'notes') dialog.querySelector('#toothClinicalNotes')?.focus();
     }
    });

    document.addEventListener('click', function (event) {
     if (event.target.closest('[data-record-tab="chart"]')) {
      const dialog = event.target.closest('.clinical-record-modal');
      if (dialog) refresh(dialog);
     }
    });
   })();
  </script>
<dialog class="modal modal-lg patient-xray-detail-modal" id="patientXrayDetailModal">
<div class="modal-shell">
<header class="modal-header">
<div>
<p class="eyebrow">Patient Radiograph</p>
<h3 data-xray-detail-title="">Radiograph Details</h3>
<p data-xray-detail-subtitle="">Maria Santos · PT-2026-0018</p>
</div>
<button aria-label="Close X-ray details" class="icon-btn" onclick="this.closest('dialog').close()" type="button">×</button>
</header>
<div class="modal-body xray-detail-layout">
<div class="patient-xray-detail-image">
<img alt="Patient dental radiograph" data-xray-detail-image="" src="<?php echo e(asset('assets/images/xray-panoramic.png')); ?>"/>
</div>
<div class="patient-xray-detail-info">
<div class="xray-detail-summary">
<div><small>Patient</small><strong>Maria Santos</strong></div>
<div><small>Date taken</small><strong data-xray-detail-date="">03 Oct 2026</strong></div>
<div><small>Imaging type</small><strong data-xray-detail-type="">Panoramic</strong></div>
<div><small>Dentist</small><strong data-xray-detail-dentist="">Dr. Ana Cerillo</strong></div>
</div>
<article class="xray-detail-note">
<small>Clinical findings</small>
<p data-xray-detail-findings="">General survey of the dentition.</p>
</article>
<article class="xray-detail-note">
<small>Record note</small>
<p data-xray-detail-note="">This radiograph is part of the patient clinical record and should be interpreted together with the dental examination.</p>
</article>
</div>
</div>
<footer class="modal-footer">
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">Close</button>
</footer>
</div>
</dialog>
<script id="patientRecordFinalEnhancements">
   (function () {
    function classifyTooth(tooth) {
     const name = (tooth.dataset.toothName || '').toLowerCase();
     tooth.classList.remove('tooth-upper','tooth-lower','tooth-molar','tooth-premolar','tooth-canine','tooth-incisor');
     if (name.includes('maxillary')) tooth.classList.add('tooth-upper');
     if (name.includes('mandibular')) tooth.classList.add('tooth-lower');
     if (name.includes('molar')) tooth.classList.add('tooth-molar');
     else if (name.includes('premolar')) tooth.classList.add('tooth-premolar');
     else if (name.includes('canine')) tooth.classList.add('tooth-canine');
     else tooth.classList.add('tooth-incisor');
    }

    function prepareDentitions(dialog) {
     dialog.querySelectorAll('.premium-dental-chart [data-dentition-grid] .tooth-unit').forEach(classifyTooth);
    }

    function relocatePeriodontal(dialog) {
     const chart = dialog.querySelector('.premium-dental-chart');
     const left = chart?.querySelector('.odontogram-panel');
     const perio = chart?.querySelector('.clinical-details');
     if (left && perio && perio.parentElement !== left) left.appendChild(perio);
     chart?.querySelectorAll('.chart-history').forEach((node) => node.remove());
    }

    function bindXrays(dialog) {
     const detail = document.getElementById('patientXrayDetailModal');
     if (!detail) return;
     dialog.querySelectorAll('.xray-record-card').forEach((card) => {
      card.setAttribute('role','button');
      card.setAttribute('tabindex','0');
      card.setAttribute('aria-label','View X-ray record details');
      function open() {
       const strong = card.querySelector('strong')?.textContent.trim() || 'Radiograph';
       const parts = strong.split('·').map((part) => part.trim());
       const type = parts[0] || 'Radiograph';
       const date = parts[parts.length - 1] || '—';
       const dentist = card.querySelector('span')?.textContent.trim() || 'Dr. Ana Cerillo';
       const findings = card.querySelector('p')?.textContent.trim() || 'No additional findings recorded.';
       const src = card.querySelector('img')?.getAttribute('src') || '../assets/images/xray-panoramic.png';
       detail.querySelector('[data-xray-detail-title]').textContent = type + ' Radiograph';
       detail.querySelector('[data-xray-detail-date]').textContent = date;
       detail.querySelector('[data-xray-detail-type]').textContent = type;
       detail.querySelector('[data-xray-detail-dentist]').textContent = dentist;
       detail.querySelector('[data-xray-detail-findings]').textContent = findings;
       detail.querySelector('[data-xray-detail-image]').src = src;
       detail.showModal();
      }
      card.addEventListener('click', open);
      card.addEventListener('keydown', (event) => {
       if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); open(); }
      });
     });
    }

    function initialize() {
     document.querySelectorAll('.clinical-record-modal').forEach((dialog) => {
      prepareDentitions(dialog);
      relocatePeriodontal(dialog);
      bindXrays(dialog);
     });
    }

    document.addEventListener('DOMContentLoaded', initialize);
    initialize();
   })();
  </script>
<script id="dentitionPixelLayoutFinal">
   (function(){
    function apply(){
     document.querySelectorAll('.premium-dental-chart .odontogram-panel').forEach((panel)=>{
      const visible=panel.querySelector('[data-dentition-grid]:not(.hidden)');
      panel.dataset.dentitionView=visible?.dataset.dentitionGrid || 'permanent';
     });
     document.querySelectorAll('.premium-dental-chart [data-dentition-grid]').forEach((grid)=>{
      const type=grid.dataset.dentitionGrid;
      const teeth=Array.from(grid.querySelectorAll('.tooth-unit'));
      teeth.forEach((tooth,index)=>{
       const name=(tooth.dataset.toothName||'').toLowerCase();
       tooth.classList.toggle('tooth-upper',name.includes('maxillary'));
       tooth.classList.toggle('tooth-lower',name.includes('mandibular'));
       tooth.classList.remove('tooth-molar','tooth-premolar','tooth-canine','tooth-incisor');
       if(name.includes('molar')) tooth.classList.add('tooth-molar');
       else if(name.includes('premolar')) tooth.classList.add('tooth-premolar');
       else if(name.includes('canine')) tooth.classList.add('tooth-canine');
       else tooth.classList.add('tooth-incisor');
       if(type==='mixed'){
        tooth.style.gridColumn=''; tooth.style.gridRow='';
        const isUpper=name.includes('maxillary');
        if(index<32){
         tooth.style.gridRow=isUpper?'1':'4';
         tooth.style.gridColumn=String((index%16)+1);
        }else{
         const j=index-32;
         tooth.style.gridRow=isUpper?'2':'3';
         tooth.style.gridColumn=String((j%10)+4);
        }
       }
      });
     });
    }
    document.addEventListener('DOMContentLoaded',apply);
    document.addEventListener('click',(event)=>{if(event.target.closest('[data-dentition]')) requestAnimationFrame(apply);});
    apply();
   })();
  </script>
<script id="clinicalPanelHeightSyncFinal">
   (function(){
    function syncOne(workspace){
     const left=workspace.querySelector('.odontogram-panel');
     const right=workspace.querySelector('.tooth-detail-panel');
     if(!left||!right) return;
     const h=Math.ceil(left.getBoundingClientRect().height);
     if(h>0){
      workspace.style.setProperty('--clinical-panel-height',h+'px');
      right.style.height=h+'px';
      right.style.maxHeight=h+'px';
     }
    }
    function syncAll(){
     document.querySelectorAll('.premium-dental-chart .odontogram-workspace').forEach(syncOne);
    }
    document.addEventListener('DOMContentLoaded',()=>requestAnimationFrame(syncAll));
    document.addEventListener('click',(event)=>{
     if(event.target.closest('[data-dentition], [data-record-tab="chart"]')){
      requestAnimationFrame(()=>requestAnimationFrame(syncAll));
     }
    });
    window.addEventListener('resize',()=>requestAnimationFrame(syncAll));
    if('ResizeObserver' in window){
     const ro=new ResizeObserver(()=>requestAnimationFrame(syncAll));
     document.querySelectorAll('.premium-dental-chart .odontogram-panel').forEach(el=>ro.observe(el));
    }
    syncAll();
   })();
  </script>
 
<script id="patientRecordSegmentationExportAndToothBilling">
(function(){
  function money(value){
    return '₱' + Number(value || 0).toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2});
  }

  function getBilling(){
    try { return JSON.parse(localStorage.getItem('cerilloPatientToothBilling') || '[]'); }
    catch (_) { return []; }
  }

  function currentRecordDialogFromPage(){
    return document.querySelector('dialog.clinical-record-modal[open]') || document.querySelector('dialog.clinical-record-modal');
  }

  function applyPatientFilters(table){
    if(!table) return;
    const id=table.id;
    const segment=document.querySelector('[data-patient-segment-for="'+id+'"]')?.value || '';
    const procedure=document.querySelector('[data-patient-procedure-for="'+id+'"]')?.value || '';
    table.querySelectorAll('tbody tr').forEach(function(row){
      const matches=(!segment || row.dataset.segment===segment) && (!procedure || row.dataset.procedure===procedure);
      row.dataset.segmentHidden=matches ? 'false' : 'true';
      row.hidden=!matches || row.dataset.searchHidden==='true' || row.dataset.filterHidden==='true';
    });
  }

  document.addEventListener('change',function(event){
    const control=event.target.closest('[data-patient-segment-for],[data-patient-procedure-for]');
    if(!control) return;
    const id=control.dataset.patientSegmentFor || control.dataset.patientProcedureFor;
    applyPatientFilters(document.getElementById(id));
  });

  function ledgerDescription(item){
    if(item.type==='consultation-invoice'){
      const count=Array.isArray(item.items) ? item.items.length : 0;
      return 'Dental consultation · '+count+' procedure'+(count===1?'':'s');
    }
    return 'Tooth #'+(item.tooth || '—')+' · '+(item.procedure || item.finding || 'Dental procedure');
  }

  function addLedgerRow(dialog,item){
    const table=dialog.querySelector('[data-patient-ledger]');
    if(!table?.tBodies?.[0]) return;
    if(table.querySelector('[data-tooth-charge-id="'+item.id+'"]')) return;
    const tr=document.createElement('tr');
    tr.dataset.toothChargeId=item.id;
    tr.innerHTML='<td>'+new Date(item.createdAt).toLocaleDateString(undefined,{day:'2-digit',month:'short',year:'numeric'})+'</td><td>'+item.reference+'</td><td>'+ledgerDescription(item)+'</td><td>'+money(item.price)+'</td><td>—</td><td>'+money(item.price)+'</td>';
    table.tBodies[0].appendChild(tr);
  }

  function hydrateLedger(dialog){
    const patientId=dialog.dataset.patientId;
    getBilling().filter(function(item){return item.patientId===patientId;}).forEach(function(item){addLedgerRow(dialog,item);});
  }

  document.querySelectorAll('dialog.clinical-record-modal').forEach(hydrateLedger);
  window.addEventListener('cerillo-tooth-billing-updated',function(){
    document.querySelectorAll('dialog.clinical-record-modal').forEach(hydrateLedger);
  });
})();
</script>


<script id="publicRequestFrontDeskWorkflow">
(function(){
  const ORTHO_RX=/orthodont|braces|aligner|retainer/i;
  let activeRequestId=null;
  function getReqs(){try{return JSON.parse(localStorage.getItem('cerilloPublicAppointmentRequests')||'[]');}catch(_){return[];}}
  function saveReqs(list){localStorage.setItem('cerilloPublicAppointmentRequests',JSON.stringify(list));}
  function render(){
    const holder=document.getElementById('publicRequestList'), count=document.getElementById('publicRequestCount'); if(!holder)return;
    const pending=getReqs().filter(function(x){return x.status==='Pending Review';});
    if(count) count.textContent=pending.length+' pending';
    if(!pending.length){holder.innerHTML='<div class="request-empty">No pending online appointment requests.</div>';return;}
    holder.innerHTML=pending.map(function(r){
      return '<article class="request-row"><div><small>Patient</small><strong>'+r.name+'</strong><span>'+ (r.email||'') +'</span></div><div><small>Requested service</small><strong>'+r.service+'</strong><span>'+ (r.concern||'') +'</span></div><div><small>Preferred schedule</small><strong>'+r.date+' · '+r.time+'</strong><span>'+ (r.dentistPreference||'No dentist preference') +'</span></div><div><span class="request-status-pill">Pending Review</span></div><button class="table-action" type="button" data-review-request="'+r.id+'">Review</button></article>';
    }).join('');
  }
  function openRequest(id){
    const r=getReqs().find(function(x){return x.id===id;}); if(!r)return; activeRequestId=id;
    const d=document.getElementById('publicRequestReviewModal');
    d.querySelector('[data-request-title]').textContent=r.name+' · '+r.service;
    d.querySelector('[data-request-reference]').textContent=r.id+' · submitted '+new Date(r.createdAt).toLocaleString();
    d.querySelector('[data-request-review-grid]').innerHTML='<div><small>Patient</small><strong>'+r.name+'</strong><span>'+((window.CerilloFormat?.phone(r.phone)||'—')+' · '+(r.email||'—'))+'</span></div><div><small>Requested service</small><strong>'+r.service+'</strong><span>'+(r.dentistPreference||'No dentist preference')+'</span></div><div><small>Preferred schedule</small><strong>'+r.date+' · '+r.time+'</strong><span>Requested by patient</span></div><div><small>Reason for visit</small><strong>'+(r.concern||'No concern supplied')+'</strong><span>'+(r.allergies?('Allergy: '+r.allergies):'No allergy reported')+'</span></div>';
    const sel=document.getElementById('publicRequestDentist'), note=document.getElementById('publicRequestOrthoNote'), isOrtho=ORTHO_RX.test(r.service);
    if(isOrtho){sel.value='Dr. Angela Cerillo';sel.disabled=true;note.hidden=false;}else{sel.disabled=false;sel.value=r.dentistPreference||'Dr. Ana Cerillo';note.hidden=true;}
    d.showModal();
  }
  function addAppointmentRow(r,dentist,status){
    const body=document.querySelector('#front-appointment-register tbody'); if(!body)return;
    const tr=document.createElement('tr'); tr.dataset.filterTags=status;
    const dateText=new Date(r.date+'T00:00:00').toLocaleDateString(undefined,{day:'2-digit',month:'short',year:'numeric'});
    tr.innerHTML='<td><strong>'+r.name+'</strong><small class="table-subtext">'+r.id+'</small></td><td>'+dentist+'</td><td>'+r.service+'</td><td>'+dateText+'</td><td>'+r.time+'</td><td><span class="status warning">'+status+'</span></td><td><button class="table-action appointment-view" data-arrival="—" data-datetime="'+r.date+' · '+r.time+'" data-dentist="'+dentist+'" data-patient="'+r.name+'" data-service="'+r.service+'" data-status="'+status+'" type="button">View</button></td>';
    body.prepend(tr);
  }
  document.addEventListener('click',function(event){const b=event.target.closest('[data-review-request]');if(b)openRequest(b.dataset.reviewRequest);});
  document.getElementById('acceptPublicRequest')?.addEventListener('click',function(){
    const reqs=getReqs(), r=reqs.find(function(x){return x.id===activeRequestId;}); if(!r)return;
    const dentist=document.getElementById('publicRequestDentist').value, status=document.getElementById('publicRequestFinalStatus').value;
    r.status='Accepted'; r.assignedDentist=dentist; r.finalStatus=status; r.acceptedAt=new Date().toISOString(); saveReqs(reqs); addAppointmentRow(r,dentist,status); document.getElementById('publicRequestReviewModal').close(); render();
  });
  window.addEventListener('storage',function(event){if(event.key==='cerilloPublicAppointmentRequests')render();}); render();

  function getCatalog(){try{return JSON.parse(localStorage.getItem('cerilloServiceCatalogV4')||'[]');}catch(_){return[];}}
  const regService=document.getElementById('regService'),regDentist=document.getElementById('regDentist');
  if(regService){const cat=getCatalog(); if(cat.length){regService.innerHTML=cat.filter(function(x){return x.status!=='Inactive';}).map(function(x){return '<option>'+x.name+'</option>';}).join('');}}
  function lockInternalOrtho(){if(!regService||!regDentist)return;const lock=ORTHO_RX.test(regService.value);if(lock){regDentist.value='Dr. Angela Cerillo';regDentist.disabled=true;}else regDentist.disabled=false;}
  regService?.addEventListener('change',lockInternalOrtho); lockInternalOrtho();

  const serviceSel=document.getElementById('checkoutService'),inst=document.getElementById('orthoInstallmentFields');
  function toggleInstallment(){if(inst)inst.hidden=serviceSel?.value!=='Orthodontic Braces';}
  serviceSel?.addEventListener('change',toggleInstallment); toggleInstallment();
})();
</script>
<script id="frontDeskDentistReassignment">
(function(){
 const ORTHO=/orthodont|braces|aligner|retainer/i;
 const originalOpen=window.openFrontAppointment;
 if(typeof originalOpen==='function'){
   window.openFrontAppointment=function(button){
     originalOpen(button);
     const service=button.dataset.service||'', sel=document.getElementById('frontReassignDentist'), note=document.getElementById('frontOrthoAssignmentNote');
     if(sel){sel.value=button.dataset.dentist||sel.value;const locked=ORTHO.test(service);sel.disabled=locked;if(locked)sel.value='Dr. Angela Cerillo';if(note)note.hidden=!locked;}
   };
 }
 document.getElementById('saveFrontAppointmentStatus')?.addEventListener('click',function(){
   const row=window.cerilloActiveAppointmentRow;if(!row)return; const sel=document.getElementById('frontReassignDentist'); if(!sel||sel.disabled)return;
   const cells=row.querySelectorAll('td'); if(cells[1])cells[1].textContent=sel.value;
   const btn=row.querySelector('.appointment-view'); if(btn)btn.dataset.dentist=sel.value;
 });
})();
</script>


<script id="toothChargesBillingModule">
(function(){
 function getCharges(){try{return JSON.parse(localStorage.getItem('cerilloPatientToothBilling')||'[]');}catch(_){return[];}}
 function money(v){return '₱'+Number(v||0).toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2});}
 function hydrate(tableId,isAdmin){
   const table=document.getElementById(tableId); if(!table?.tBodies?.[0])return;
   getCharges().forEach(function(x){
     if(table.querySelector('[data-billing-charge-id="'+x.id+'"]'))return;
     const tr=document.createElement('tr');tr.dataset.billingChargeId=x.id;tr.dataset.filterTags='Unpaid Tooth Procedure';
     if(isAdmin) tr.innerHTML='<td>'+new Date(x.createdAt).toLocaleString()+'</td><td>'+x.patientName+'</td><td>'+money(x.price)+'</td><td><span class="status warning">Unpaid</span></td><td>Pending</td><td><button class="table-action" type="button" onclick="document.getElementById(\'adminPaymentModal\').showModal()">View</button></td>';
     else {const desc=x.type==='consultation-invoice'?'Consultation Invoice · '+(x.items?.length||0)+' procedures':'Tooth #'+x.tooth+' · '+(x.procedure||x.finding)+' — '+x.finding;tr.innerHTML='<td>'+x.reference+'</td><td>'+x.patientName+'</td><td>'+desc+'</td><td>'+money(x.price)+'</td><td>Pending</td><td><span class="status warning">Unpaid</span></td>';}
     table.tBodies[0].prepend(tr);
   });
 }
 function refresh(){hydrate('admin-table-3',true);hydrate('front-desk-table-5',false);}
 refresh(); window.addEventListener('cerillo-tooth-billing-updated',refresh); window.addEventListener('storage',function(e){if(e.key==='cerilloPatientToothBilling')refresh();});
})();
</script>


<script id="frontDeskNewUpdateCompatibility">
(function(){
 const ORTHO=/orthodont|braces|aligner|retainer/i;
 document.addEventListener('click',function(event){
   const btn=event.target.closest('#front-appointment-register .appointment-view');
   if(btn){ window.cerilloActiveAppointmentRow=btn.closest('tr'); }
 });
 const regService=document.getElementById('regService');
 if(regService && !Array.from(regService.options).some(function(o){return /braces/i.test(o.value||o.textContent);})){ const o=document.createElement('option');o.textContent='Orthodontic Braces';o.value='Orthodontic Braces';regService.appendChild(o); }
 const arrangement=document.getElementById('orthoPaymentArrangement');
 const fields=document.getElementById('orthoInstallmentFields');
 function arrangementState(){ if(!fields||fields.hidden)return; const installment=arrangement?.value==='Installment'; ['orthoDownPayment','orthoInstallmentTerm','orthoMonthlyAmount'].forEach(function(id){const el=document.getElementById(id);const label=el?.closest('label');if(label)label.style.display=installment?'grid':'none';}); }
 arrangement?.addEventListener('change',arrangementState); arrangementState();
})();
</script>




<script id="guaranteedToothFindingFlow">
(function(){
  const STATUS_CLASSES=['tooth-sound','tooth-decay','tooth-finding','tooth-planned','tooth-completed','tooth-missing','tooth-impacted'];
  const DRAFT_KEY='cerilloConsultationDrafts', BILLING_KEY='cerilloPatientToothBilling';
  let activeTooth=null, activeRecord=null, selectedFinding='';
  function money(v){return new Intl.NumberFormat('en-PH',{style:'currency',currency:'PHP',maximumFractionDigits:2}).format(Number(v||0));}
  function read(k,f){try{return JSON.parse(localStorage.getItem(k)||JSON.stringify(f));}catch(_){return f;}}
  function write(k,v){try{localStorage.setItem(k,JSON.stringify(v));}catch(_){}}
  function pkey(r){return r?.dataset.patientId||r?.dataset.patientName||'unknown';}
  function draft(r){const s=read(DRAFT_KEY,{}),k=pkey(r);return s[k]||{patientId:r?.dataset.patientId||'',patientName:r?.dataset.patientName||'',items:[]};}
  function saveDraft(r,d){const s=read(DRAFT_KEY,{});s[pkey(r)]={...d,patientId:r?.dataset.patientId||'',patientName:r?.dataset.patientName||'',updatedAt:new Date().toISOString()};write(DRAFT_KEY,s);renderCart(r);}
  function clearDraft(r){const s=read(DRAFT_KEY,{});delete s[pkey(r)];write(DRAFT_KEY,s);renderCart(r);}
  function charges(){return read(BILLING_KEY,[]);}
  function saveCharges(v){write(BILLING_KEY,v);window.dispatchEvent(new CustomEvent('cerillo-tooth-billing-updated'));}
  function cls(f){if(/sound|healthy/i.test(f))return'tooth-sound';if(/caries|decay/i.test(f))return'tooth-decay';if(/impacted/i.test(f))return'tooth-impacted';if(/missing|extracted/i.test(f))return'tooth-missing';if(/restoration|crown|root canal treated/i.test(f))return'tooth-completed';return'tooth-finding';}
  function proc(f){if(/caries|decay/i.test(f))return'Composite Restoration';if(/cracked|fractured/i.test(f))return'Restorative Treatment';if(/impacted/i.test(f))return'Surgical Extraction';if(/missing|extracted/i.test(f))return'Tooth Extraction';if(/crown/i.test(f))return'Dental Crown';if(/root canal/i.test(f))return'Root Canal Treatment';if(/restoration/i.test(f))return'Restorative Treatment';return'Other Dental Procedure';}
  function apply(tooth,f){tooth.classList.remove(...STATUS_CLASSES);tooth.classList.add(cls(f));tooth.dataset.finding=f;}
  function invoiceDesc(x){return x?.type==='consultation-invoice'?'Dental consultation · '+(x.items?.length||0)+' procedure'+((x.items?.length||0)===1?'':'s'):'Tooth #'+x.tooth+' · '+x.procedure+' — '+x.finding;}
  function addLedger(r,x){const table=r?.querySelector('[data-patient-ledger]');if(!table?.tBodies?.[0]||table.querySelector('[data-tooth-charge-id="'+x.id+'"]'))return;const tr=document.createElement('tr');tr.dataset.toothChargeId=x.id;tr.innerHTML='<td>'+new Date(x.createdAt).toLocaleDateString(undefined,{day:'2-digit',month:'short',year:'numeric'})+'</td><td>'+x.reference+'</td><td>'+invoiceDesc(x)+'</td><td>'+money(x.price)+'</td><td>—</td><td>'+money(x.price)+'</td>';table.tBodies[0].appendChild(tr);const amt=Number(x.price||0);r.querySelectorAll('.ledger-summary article').forEach(card=>{const label=(card.querySelector('span')?.textContent||'').trim().toLowerCase(),strong=card.querySelector('strong');if(!strong)return;if(label.includes('total charges')||label.includes('outstanding')){const current=Number((strong.textContent||'').replace(/[^0-9.-]/g,''))||0;strong.textContent=money(current+amt);}});}
  function ensurePopups(r){let f=r.querySelector(':scope > [data-local-tooth-finding]');if(!f){f=document.createElement('div');f.className='tooth-local-popup tooth-local-finding';f.dataset.localToothFinding='';f.hidden=true;f.innerHTML=`<div class="tooth-flow-head"><div><small>Dental chart</small><strong data-local-tooth-title>Selected tooth</strong></div><button type="button" class="icon-btn" data-local-find-close>×</button></div><div class="tooth-flow-body"><label class="tooth-flow-label">Finding / condition<select data-local-finding-select><option value="">Select finding...</option><option value="Sound / Healthy">/</option><option value="Missing / Extracted">M</option><option value="Unerupted">Un</option><option value="Present">P</option><option value="Root Fragment">RF</option><option value="Amalgam Restoration">Am</option><option value="Composite Restoration">Co</option><option value="Extraction Indicated">X</option><option value="Observation">O</option><option value="Temporary Filling">TF</option><option value="Dentinal Caries">C</option><option value="Root Canal Treated">RCT</option><option value="Impacted">Im</option><option value="Jacket Crown">Jc</option><option value="Glass Ionomer">GI</option><option value="Sealant">S</option><option value="Erupted">ER</option><option value="3/Q">3/Q</option><option value="Metal Crown">MC</option><option value="Partially Erupted">PE</option><option value="Treatment Planned">TP</option><option value="QC">QC</option></select></label><p class="tooth-flow-help">Choose the clinical finding for this tooth. Billable findings continue to treatment and pricing.</p></div>`;r.appendChild(f);}let c=r.querySelector(':scope > [data-local-tooth-charge]');if(!c){c=document.createElement('div');c.className='tooth-local-popup tooth-local-charge';c.dataset.localToothCharge='';c.hidden=true;c.innerHTML=`<div class="tooth-flow-head"><div><small>Consultation item</small><strong data-local-charge-title>Selected tooth</strong></div><button type="button" class="icon-btn" data-local-charge-close>×</button></div><div class="tooth-flow-body"><div class="tooth-flow-summary"><span>Finding</span><strong data-local-charge-finding>—</strong></div><label class="tooth-flow-label">Treatment / procedure<select data-local-charge-procedure><option>Composite Restoration</option><option>Root Canal Treatment</option><option>Dental Crown</option><option>Tooth Extraction</option><option>Surgical Extraction</option><option>Restorative Treatment</option><option>Observation / Review</option><option>Other Dental Procedure</option></select></label><label class="tooth-flow-label">Price for this tooth (₱)<input data-local-charge-price type="number" min="0" step="0.01" placeholder="0.00"></label><label class="tooth-flow-label">Clinical / billing note <span class="optional-label">Optional</span><textarea data-local-charge-note rows="3"></textarea></label><div class="tooth-flow-message" data-local-charge-message></div><small class="tooth-billing-note">Adds this tooth to the current consultation. The patient balance is updated only after Finish Consultation.</small></div><div class="tooth-flow-actions"><button type="button" class="btn secondary" data-local-charge-cancel>Cancel</button><button type="button" class="btn" data-local-charge-save>Add to consultation</button></div>`;r.appendChild(c);}return{finding:f,charge:c};}
  function hide(p){if(p){p.hidden=true;p.classList.remove('is-visible');}}
  function pos(p,tooth,r){p.hidden=false;p.classList.add('is-visible');p.style.left='0';p.style.top='0';requestAnimationFrame(()=>{const rr=r.getBoundingClientRect(),tr=tooth.getBoundingClientRect(),pr=p.getBoundingClientRect(),pad=14,g=10;let l=tr.left-rr.left+tr.width/2-pr.width/2,t=tr.bottom-rr.top+g;if(t+pr.height>rr.height-pad)t=tr.top-rr.top-pr.height-g;l=Math.max(pad,Math.min(l,rr.width-pr.width-pad));t=Math.max(pad,Math.min(t,rr.height-pr.height-pad));p.style.left=Math.round(l)+'px';p.style.top=Math.round(t)+'px';});}
  function openFinding(tooth){const r=tooth.closest('dialog.clinical-record-modal');if(!r)return;activeTooth=tooth;activeRecord=r;selectedFinding='';const p=ensurePopups(r);hide(p.charge);p.finding.querySelector('[data-local-tooth-title]').textContent='Tooth #'+tooth.dataset.tooth+' · '+(tooth.dataset.toothName||'');const s=p.finding.querySelector('[data-local-finding-select]');s.value='';pos(p.finding,tooth,r);setTimeout(()=>s.focus(),30);}
  function openCharge(f){const p=ensurePopups(activeRecord);selectedFinding=f;hide(p.finding);p.charge.querySelector('[data-local-charge-title]').textContent='Tooth #'+activeTooth.dataset.tooth+' · '+(activeTooth.dataset.toothName||'');p.charge.querySelector('[data-local-charge-finding]').textContent=f;p.charge.querySelector('[data-local-charge-procedure]').value=proc(f);p.charge.querySelector('[data-local-charge-price]').value='';p.charge.querySelector('[data-local-charge-note]').value='';p.charge.querySelector('[data-local-charge-message]').textContent='';pos(p.charge,activeTooth,activeRecord);}
  function ensureCart(r){const panel=r.querySelector('[data-record-panel="chart"]');if(!panel)return null;let c=panel.querySelector('[data-consultation-cart]');if(!c){c=document.createElement('section');c.className='consultation-cart-panel';c.dataset.consultationCart='';c.innerHTML=`<div class="consultation-cart-head"><div><span class="consultation-cart-kicker">Current consultation</span><h4>Treatment invoice draft</h4><p>Add multiple tooth procedures before posting one invoice.</p></div><div class="consultation-cart-total"><small>Running total</small><strong data-consultation-total>₱0.00</strong></div></div><div class="consultation-cart-items" data-consultation-items></div><div class="consultation-cart-footer"><span data-consultation-count>0 procedures</span><div><button class="btn secondary compact" type="button" data-consultation-clear>Clear draft</button><button class="btn compact" type="button" data-consultation-finish disabled>Finish Consultation</button></div></div>`;const w=panel.querySelector('.odontogram-workspace');w?w.insertAdjacentElement('afterend',c):panel.appendChild(c);}return c;}
  function renderCart(r){const c=ensureCart(r);if(!c)return;const d=draft(r),items=d.items||[],total=items.reduce((s,x)=>s+Number(x.price||0),0),h=c.querySelector('[data-consultation-items]');h.innerHTML=items.length?items.map((x,i)=>`<article class="consultation-cart-item"><div><strong>Tooth #${x.tooth} · ${x.procedure}</strong><span>${x.finding}${x.notes?' · '+x.notes:''}</span></div><div class="consultation-cart-item-price"><strong>${money(x.price)}</strong><button class="icon-btn" type="button" data-consultation-remove="${i}">×</button></div></article>`).join(''):'<div class="consultation-cart-empty">No billable tooth procedures added yet.</div>';c.querySelector('[data-consultation-total]').textContent=money(total);c.querySelector('[data-consultation-count]').textContent=items.length+' procedure'+(items.length===1?'':'s');c.querySelector('[data-consultation-finish]').disabled=!items.length;c.querySelector('[data-consultation-clear]').disabled=!items.length;}
  function summary(r){let o=r.querySelector(':scope > [data-consultation-summary]');if(!o){o=document.createElement('div');o.className='consultation-summary-overlay';o.dataset.consultationSummary='';o.hidden=true;o.innerHTML=`<section class="consultation-summary-card"><header><div><span class="consultation-cart-kicker">Consultation complete</span><h3>Review treatment summary</h3><p data-consultation-patient></p></div><button class="icon-btn" type="button" data-consultation-summary-close>×</button></header><div class="consultation-summary-body"><div class="consultation-summary-table-wrap"><table><thead><tr><th>Tooth</th><th>Finding</th><th>Procedure</th><th>Price</th></tr></thead><tbody data-consultation-summary-items></tbody></table></div><div class="consultation-summary-total"><span>Total consultation charges</span><strong data-consultation-summary-total>₱0.00</strong></div><p class="consultation-summary-note">Submitting creates one invoice and posts the total to the patient balance.</p></div><footer><button class="btn secondary" type="button" data-consultation-summary-back>Back to chart</button><button class="btn" type="button" data-consultation-submit>Submit to Patient Balance</button></footer></section>`;r.appendChild(o);}return o;}
  function openSummary(r){const d=draft(r);if(!d.items?.length)return;const o=summary(r);o.querySelector('[data-consultation-patient]').textContent=(r.dataset.patientName||'Patient')+' · '+(r.dataset.patientId||'');o.querySelector('[data-consultation-summary-items]').innerHTML=d.items.map(x=>`<tr><td>#${x.tooth}</td><td>${x.finding}</td><td>${x.procedure}</td><td>${money(x.price)}</td></tr>`).join('');o.querySelector('[data-consultation-summary-total]').textContent=money(d.items.reduce((s,x)=>s+Number(x.price||0),0));o.hidden=false;o.classList.add('is-visible');}
  function closeSummary(r){const o=r?.querySelector(':scope > [data-consultation-summary]');if(o){o.classList.remove('is-visible');o.hidden=true;}}
  function finish(r){const d=draft(r),items=d.items||[];if(!items.length)return;const total=items.reduce((s,x)=>s+Number(x.price||0),0),now=new Date(),ref='INV-'+now.toISOString().slice(0,10).replace(/-/g,'')+'-'+String(Date.now()).slice(-4),x={id:'CI-'+Date.now(),reference:ref,type:'consultation-invoice',patientId:r.dataset.patientId||'',patientName:r.dataset.patientName||'',tooth:'Multiple',finding:'Consultation',procedure:'Dental Consultation',price:total,notes:items.length+' dental procedures',items:items.map(i=>({...i})),createdAt:now.toISOString(),status:'Unpaid'};const list=charges();list.push(x);saveCharges(list);addLedger(r,x);clearDraft(r);closeSummary(r);}
  function addItem(r,item){const d=draft(r);d.items=d.items||[];const n=d.items.findIndex(x=>String(x.tooth)===String(item.tooth)&&x.procedure===item.procedure);n>=0?d.items[n]=item:d.items.push(item);saveDraft(r,d);}
  function removeTooth(r,tooth){const d=draft(r);d.items=(d.items||[]).filter(x=>String(x.tooth)!==String(tooth));saveDraft(r,d);}
  document.addEventListener('click',e=>{const t=e.target.closest('.clinical-record-modal .tooth-unit');if(!t)return;e.preventDefault();e.stopImmediatePropagation();openFinding(t);},true);
  document.addEventListener('click',e=>{const r=e.target.closest('dialog.clinical-record-modal')||activeRecord;if(e.target.closest('[data-local-find-close]')){hide(r?.querySelector(':scope > [data-local-tooth-finding]'));return;}if(e.target.closest('[data-local-charge-close],[data-local-charge-cancel]')){hide(r?.querySelector(':scope > [data-local-tooth-charge]'));selectedFinding='';return;}if(e.target.closest('[data-local-charge-save]')){const c=r?.querySelector(':scope > [data-local-tooth-charge]');if(!c||!activeTooth||!selectedFinding)return;const procedure=c.querySelector('[data-local-charge-procedure]').value.trim(),price=Number(c.querySelector('[data-local-charge-price]').value||0),notes=c.querySelector('[data-local-charge-note]').value.trim(),m=c.querySelector('[data-local-charge-message]');if(!procedure){m.textContent='Choose a treatment or procedure.';return;}if(!(price>0)){m.textContent='Enter a valid price greater than ₱0.00.';return;}apply(activeTooth,selectedFinding);activeTooth.dataset.procedure=procedure;activeTooth.dataset.price=price;activeTooth.dataset.notes=notes;addItem(r,{id:'CD-'+Date.now(),tooth:activeTooth.dataset.tooth,toothName:activeTooth.dataset.toothName||'',finding:selectedFinding,procedure,price,notes,createdAt:new Date().toISOString()});hide(c);selectedFinding='';return;}const rem=e.target.closest('[data-consultation-remove]');if(rem&&r){const d=draft(r);d.items.splice(Number(rem.dataset.consultationRemove),1);saveDraft(r,d);return;}if(e.target.closest('[data-consultation-clear]')&&r){if(confirm('Clear the current consultation draft?'))clearDraft(r);return;}if(e.target.closest('[data-consultation-finish]')&&r){openSummary(r);return;}if(e.target.closest('[data-consultation-summary-close],[data-consultation-summary-back]')&&r){closeSummary(r);return;}if(e.target.closest('[data-consultation-submit]')&&r){finish(r);return;}});
  document.addEventListener('change',e=>{const s=e.target.closest('[data-local-finding-select]');if(!s)return;const f=s.value;if(!f||!activeTooth||!activeRecord)return;if(/sound\s*\/\s*healthy/i.test(f)){apply(activeTooth,f);activeTooth.dataset.procedure='';activeTooth.dataset.price='0';activeTooth.dataset.notes='';removeTooth(activeRecord,activeTooth.dataset.tooth);hide(activeRecord.querySelector(':scope > [data-local-tooth-finding]'));selectedFinding='';return;}openCharge(f);});
  document.addEventListener('close',e=>{if(!e.target.matches('dialog.clinical-record-modal'))return;hide(e.target.querySelector(':scope > [data-local-tooth-finding]'));hide(e.target.querySelector(':scope > [data-local-tooth-charge]'));closeSummary(e.target);activeTooth=null;activeRecord=null;selectedFinding='';},true);
  document.querySelectorAll('dialog.clinical-record-modal').forEach(r=>renderCart(r));
})();
</script>
<script src="<?php echo e(asset('assets/js/dashboard-live.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/records-live.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/cerillo-ui-hotfix.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/dentist-clinical-refinements.js')); ?>"></script>
<script>
(function () {
  const list = document.getElementById('publicRequestList');
  const count = document.getElementById('publicRequestCount');
  const review = document.getElementById('publicRequestReviewModal');
  const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
  if (!list || !review) return;

  const escapeHtml = value => String(value ?? '').replace(/[&<>"']/g, char => ({
    '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'
  }[char]));
  async function request(url, options = {}) {
    const response = await fetch(url, {
      headers: { Accept: 'application/json', 'X-CSRF-TOKEN': csrf, ...(options.headers || {}) },
      ...options
    });
    const data = await response.json();
    if (!response.ok) throw new Error(data.message || 'Request failed.');
    return data;
  }
  function pendingAppointments(data) {
    return (data.data || data).filter(item => item.status === 'Pending Verification');
  }
  function render(items) {
    count.textContent = `${items.length} pending`;
    list.innerHTML = items.length ? items.map(item => `
      <article class="request-row">
        <div><small>Patient</small><strong>${escapeHtml(item.guest_name)}</strong><span>${escapeHtml(item.guest_email || item.formatted_guest_phone || window.CerilloFormat?.phone(item.guest_phone))}</span></div>
        <div><small>Requested service</small><strong>${escapeHtml(item.service?.name)}</strong><span>${escapeHtml(item.intake_details?.concern || 'No concern supplied')}</span></div>
        <div><small>Preferred schedule</small><strong>${escapeHtml(item.starts_at)}</strong><span>${escapeHtml(item.dentist?.name || 'No dentist assigned')}</span></div>
        <button class="table-action" type="button" data-db-review="${item.id}">Review</button>
      </article>`).join('') : '<div class="request-empty">No pending online appointment requests.</div>';
  }
  async function load() {
    try { render(pendingAppointments(await request('/api/appointments'))); }
    catch (error) { list.innerHTML = `<div class="request-empty">${escapeHtml(error.message)}</div>`; }
  }
  async function loadDentists() {
    const select = document.getElementById('publicRequestDentist');
    if (!select) return;
    try {
      const dentists = await request('/api/public/dentists');
      select.innerHTML = dentists.map(dentist => `<option value="${dentist.id}">${escapeHtml(dentist.name)}</option>`).join('');
    } catch (error) { select.innerHTML = '<option value="">Unable to load dentists</option>'; }
  }
  list.addEventListener('click', async event => {
    const button = event.target.closest('[data-db-review]');
    if (!button) return;
    event.stopImmediatePropagation();
    const id = button.dataset.dbReview;
    try {
      const [matches, appointment] = await Promise.all([
        request(`/api/appointments/${id}/matches`),
        request(`/api/appointments/${id}`)
      ]);
      review.dataset.appointmentId = id;
      review.dataset.patientId = '';
      const patientName = appointment.patient?.name || appointment.guest_name || 'Guest patient';
      const serviceName = appointment.service?.name || 'Dental appointment';
      const intake = appointment.intake_details && typeof appointment.intake_details === 'object' ? appointment.intake_details : {};
      const start = new Date(appointment.starts_at);
      const end = new Date(appointment.ends_at);
      const dateLabel = Number.isNaN(start.getTime()) ? '—' : start.toLocaleDateString(undefined, { day:'2-digit', month:'short', year:'numeric' });
      const startLabel = Number.isNaN(start.getTime()) ? '—' : start.toLocaleTimeString([], { hour:'numeric', minute:'2-digit' });
      const endLabel = Number.isNaN(end.getTime()) ? '—' : end.toLocaleTimeString([], { hour:'numeric', minute:'2-digit' });
      const contact = appointment.formatted_guest_phone || appointment.patient?.formatted_phone || window.CerilloFormat?.phone(appointment.guest_phone || appointment.patient?.phone) || appointment.guest_email || appointment.patient?.email || '—';
      const concern = intake.concern || intake.reason_for_visit || intake.medical_concern || 'No concern supplied';
      const allergy = intake.allergies || 'None reported';
      const medication = intake.medications || 'None reported';
      review.querySelector('[data-request-title]').textContent = `${patientName} · ${serviceName}`;
      review.querySelector('[data-request-reference]').textContent = `Appointment #${id} · Online request pending verification`;
      review.querySelector('[data-request-review-grid]').innerHTML = `
        <div><small>Patient</small><strong>${escapeHtml(patientName)}</strong><span>${escapeHtml(contact)}</span></div>
        <div><small>Requested service</small><strong>${escapeHtml(serviceName)}</strong><span>${escapeHtml(appointment.dentist?.name || 'Dentist not yet assigned')}</span></div>
        <div><small>Preferred schedule</small><strong>${escapeHtml(dateLabel)} · ${escapeHtml(startLabel)} – ${escapeHtml(endLabel)}</strong><span>Requested appointment slot</span></div>
        <div><small>Reason for visit</small><strong>${escapeHtml(concern)}</strong><span>Allergy: ${escapeHtml(allergy)} · Medication: ${escapeHtml(medication)}</span></div>
        <div class="request-match-card"><small>Matching patient record</small><strong>${matches.length ? matches.map(match => `<button type="button" class="table-action" data-match-patient="${match.id}">${escapeHtml(match.name)} · ${escapeHtml(match.formatted_phone || window.CerilloFormat?.phone(match.phone) || match.email || '')}</button>`).join(' ') : 'No matching patient record found.'}</strong><span>Select a match when this request belongs to an existing patient.</span></div>`;
      review.showModal();
    } catch (error) { alert(error.message); }
  }, true);
  review.addEventListener('click', event => {
    const match = event.target.closest('[data-match-patient]');
    if (match) review.dataset.patientId = match.dataset.matchPatient;
  }, true);
  document.getElementById('acceptPublicRequest')?.addEventListener('click', async event => {
    event.stopImmediatePropagation();
    const id = review.dataset.appointmentId;
    if (!id) return;
    const dentist = document.getElementById('publicRequestDentist').value;
    try {
      await request(`/api/appointments/${id}/dentist`, { method: 'PUT', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ dentist_id: dentist }) });
      await request(`/api/appointments/${id}/verify`, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ patient_id: review.dataset.patientId || null }) });
      review.close();
      await load();
    } catch (error) { alert(error.message); }
  }, true);
  loadDentists();
  load();
})();
</script>
<script>
(function () {
  const modal = document.getElementById('registerAppointmentModal');
  const save = document.getElementById('saveRegisteredAppointment');
  const patientSelect = document.getElementById('existingPatientSelect');
  const serviceSelect = document.getElementById('regService');
  const dentistSelect = document.getElementById('regDentist');
  const dateInput = document.getElementById('regDate');
  const timeSelect = document.getElementById('regTime');
  const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
  if (!modal || !save) return;

  async function json(url, options = {}) {
    const response = await fetch(url, { headers: { Accept: 'application/json', 'X-CSRF-TOKEN': csrf, ...(options.headers || {}) }, ...options });
    const data = await response.json();
    if (!response.ok) throw new Error(data.message || Object.values(data.errors || {}).flat().join(' ') || 'Request failed.');
    return data;
  }
  const safe = value => String(value ?? '').replace(/[&<>"']/g, char => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[char]));
  async function loadCatalog() {
    const [services, dentists, patients] = await Promise.all([
      json('/api/public/services'),
      json('/api/public/dentists'),
      json('/api/patients?per_page=100')
    ]);
    serviceSelect.innerHTML = '<option value="">Select service</option>' + services.map(service => `<option value="${service.id}">${safe(service.name)}</option>`).join('');
    dentistSelect.innerHTML = '<option value="">Select dentist</option>' + dentists.map(dentist => `<option value="${dentist.id}">${safe(dentist.name)}</option>`).join('');
    patientSelect.innerHTML = '<option value="">Choose a patient</option>' + (patients.data || []).map(patient => {
      const patientCode = patient.formatted_patient_code || window.CerilloFormat?.patientCode(patient.patient_code, patient.id) || `PT-${new Date().getFullYear()}-${String(patient.id).padStart(4, '0')}`;
      return `<option value="${patient.id}" data-code="${safe(patientCode)}" data-name="${safe(patient.name)}" data-email="${safe(patient.email)}" data-phone="${safe(patient.phone)}">${safe(patient.name)} · ${safe(patientCode)}</option>`;
    }).join('');
    const today = new Date();
    dateInput.min = `${today.getFullYear()}-${String(today.getMonth()+1).padStart(2,'0')}-${String(today.getDate()).padStart(2,'0')}`;
    dateInput.value = '';
  }
  ['regFirstName', 'regLastName'].forEach(id => document.getElementById(id)?.addEventListener('input', event => {
    event.target.value = event.target.value.replace(/[^a-zA-Z\s]/g, '');
  }));
  ['regPhone', 'regPhone2'].forEach(id => document.getElementById(id)?.addEventListener('input', event => {
    event.target.value = event.target.value.replace(/[^0-9]/g, '');
  }));
  async function loadSlots() {
    const previousValue = timeSelect.value;
    const availabilityText = modal.querySelector('.availability-note span');
    timeSelect.disabled = true;
    timeSelect.innerHTML = '<option value="">Loading available times...</option>';
    if (!dentistSelect.value || !dateInput.value || !serviceSelect.value) {
      timeSelect.innerHTML = '<option value="">Select service, dentist and date first</option>';
      if (availabilityText) availabilityText.textContent = 'Choose a service, dentist and date to load real-time availability.';
      return [];
    }
    const slots = await json(`/api/slots?dentist_id=${encodeURIComponent(dentistSelect.value)}&date=${encodeURIComponent(dateInput.value)}&service_id=${encodeURIComponent(serviceSelect.value)}&_=${Date.now()}`, { cache: 'no-store' });
    const now = new Date();
    const availableSlots = slots.filter(slot => {
      if (!slot.available) return false;
      const start = new Date(String(slot.starts_at).replace(' ', 'T'));
      return !Number.isNaN(start.getTime()) && start.getTime() > now.getTime();
    });
    timeSelect.innerHTML = '<option value="">Select available time</option>' + availableSlots.map(slot => {
      const parts = String(slot.starts_at).replace('T', ' ').slice(11, 16).split(':').map(Number);
      const label = `${(parts[0] % 12) || 12}:${String(parts[1]).padStart(2, '0')} ${parts[0] >= 12 ? 'PM' : 'AM'}`;
      return `<option value="${slot.starts_at}">${label}</option>`;
    }).join('');
    if (previousValue && availableSlots.some(slot => String(slot.starts_at) === previousValue)) timeSelect.value = previousValue;
    timeSelect.disabled = availableSlots.length === 0;
    if (availabilityText) availabilityText.textContent = availableSlots.length
      ? `${availableSlots.length} real-time slot${availableSlots.length === 1 ? '' : 's'} available. Times already passed or booked are hidden.`
      : 'No available times remain for this dentist and date.';
    return availableSlots;
  }
  patientSelect?.addEventListener('change', () => {
    const option = patientSelect.selectedOptions[0];
    if (!option?.value) return;
    document.getElementById('regEmail').value = option.dataset.email || '';
    document.getElementById('regPhone').value = window.CerilloFormat?.normalizePhone(option.dataset.phone) || option.dataset.phone || '';
  });
  [serviceSelect, dentistSelect, dateInput].forEach(input => input?.addEventListener('change', () => loadSlots().catch(error => alert(error.message))));
  setInterval(() => {
    if (modal.open && dentistSelect.value && dateInput.value && serviceSelect.value) {
      loadSlots().catch(() => {});
    }
  }, 10000);
  save.addEventListener('click', async event => {
    event.preventDefault();
    event.stopImmediatePropagation();
    const existingMode = modal.querySelector('[data-registration-mode="existing"].active');
    const form = modal.querySelector('form');
    if (!form.reportValidity() || !timeSelect.value) { alert('Choose an available date and time before confirming.'); return; }
    const selectedSlot = timeSelect.value;
    const freshSlots = await loadSlots();
    if (!selectedSlot || !freshSlots.some(slot => String(slot.starts_at) === selectedSlot && slot.available)) {
      alert('That time is no longer available. The schedule has been refreshed; please choose another time.');
      return;
    }
    timeSelect.value = selectedSlot;
    const first = document.getElementById('regFirstName')?.value.trim() || '';
    const last = document.getElementById('regLastName')?.value.trim() || '';
    const option = patientSelect?.selectedOptions[0];
    const data = {
      guest_name: existingMode ? (option?.dataset.name || '') : `${first} ${last}`.trim(),
      guest_phone: document.getElementById('regPhone').value,
      guest_email: document.getElementById('regEmail').value || null,
      dentist_id: dentistSelect.value,
      service_id: serviceSelect.value,
      starts_at: timeSelect.value,
      source: 'walk_in',
      patient_id: existingMode && patientSelect.value ? patientSelect.value : null,
      intake_details: {
        date_of_birth: document.getElementById('regDob')?.value || '',
        sex: document.getElementById('regSex')?.value || '',
        address: document.getElementById('regAddress')?.value || '',
        allergies: document.getElementById('regAllergies')?.value || '',
        medications: document.getElementById('regMeds')?.value || '',
        medical_history: document.getElementById('regMedicalHistory')?.value || '',
        last_visit: document.getElementById('regLastDentalVisit')?.value || '',
        anxiety: document.getElementById('regAnxiety')?.value || '',
        bleeding: document.getElementById('regBleeding')?.value || '',
        pregnancy: document.getElementById('regPregnancy')?.value || '',
        concern: document.getElementById('regReason')?.value || '',
        contact_preference: document.getElementById('regContactPreference')?.value || '',
        notes: document.getElementById('regNotes')?.value || ''
      }
    };
    save.disabled = true;
    try {
      await json('/api/appointments', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(data) });
      modal.close();
      alert('Appointment saved. The patient remains a guest until the appointment is completed.');
      window.location.reload();
    } catch (error) { alert(error.message); }
    finally { save.disabled = false; }
  }, true);
  loadCatalog().catch(() => {});
})();
</script>
<script id="frontDeskDynamicWorkflows">
(function () {
  const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
  const escapeHtml = value => String(value ?? '').replace(/[&<>"']/g, char => ({
    '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'
  }[char]));
  const money = value => `₱${Number(value || 0).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

  // =========================================================================
  // 1. APPOINTMENTS MODULE FILTERS (Status, Date, and Query)
  // =========================================================================
  const apptTable = document.getElementById('front-appointment-register');
  const statusFilterSelect = document.getElementById('frontAppointmentFilterStatus');
  const dateFilterInput = document.getElementById('frontAppointmentFilterDate');
  const searchFilterInput = document.querySelector('[data-table-search="front-appointment-register"]');
  const popover = document.querySelector('.filter-popover[data-filter-for="front-appointment-register"]');
  const popoverStatus = popover?.querySelector('[data-filter-status]');
  const popoverDate = popover?.querySelector('[data-filter-date]');
  const popoverQuery = popover?.querySelector('[data-filter-query]');

  function filterAppointmentsTable() {
    if (!apptTable) return;
    const tbody = apptTable.querySelector('tbody');
    if (!tbody) return;

    const selectedStatus = (statusFilterSelect?.value || popoverStatus?.value || '').trim().toLowerCase();
    const selectedDate = (dateFilterInput?.value || popoverDate?.value || '').trim();
    const query = (searchFilterInput?.value || popoverQuery?.value || '').trim().toLowerCase();

    const rows = Array.from(tbody.querySelectorAll('tr:not(.no-filter-match-row)'));
    let matchCount = 0;

    rows.forEach(row => {
      const rowStatus = (row.dataset.status || row.dataset.filterTags || '').trim().toLowerCase();
      const rowDate = (row.dataset.date || '').trim();
      const rowText = row.textContent.toLowerCase();

      // Status Filter: Checked In, Pending, Completed
      let statusMatch = true;
      if (selectedStatus) {
        if (selectedStatus === 'checked in') {
          statusMatch = rowStatus.includes('checked in');
        } else if (selectedStatus === 'pending') {
          statusMatch = rowStatus.includes('pending');
        } else if (selectedStatus === 'completed') {
          statusMatch = rowStatus.includes('completed');
        } else {
          statusMatch = rowStatus.includes(selectedStatus);
        }
      }

      // Date Filter: matches YYYY-MM-DD
      let dateMatch = true;
      if (selectedDate) {
        dateMatch = rowDate === selectedDate;
      }

      // Search Query
      let queryMatch = true;
      if (query) {
        queryMatch = rowText.includes(query);
      }

      const visible = statusMatch && dateMatch && queryMatch;
      row.style.display = visible ? '' : 'none';
      row.dataset.searchHidden = queryMatch ? 'false' : 'true';
      row.dataset.filterHidden = (statusMatch && dateMatch) ? 'false' : 'true';

      if (visible) matchCount++;
    });

    let emptyRow = tbody.querySelector('.no-filter-match-row');
    if (matchCount === 0) {
      if (!emptyRow) {
        emptyRow = document.createElement('tr');
        emptyRow.className = 'no-filter-match-row';
        emptyRow.innerHTML = '<td colspan="7" class="muted" style="text-align:center;padding:24px;">No appointments match the selected filters.</td>';
        tbody.appendChild(emptyRow);
      }
      emptyRow.style.display = '';
    } else if (emptyRow) {
      emptyRow.style.display = 'none';
    }
  }

  statusFilterSelect?.addEventListener('change', () => {
    if (popoverStatus) popoverStatus.value = statusFilterSelect.value;
    filterAppointmentsTable();
  });

  dateFilterInput?.addEventListener('input', () => {
    if (popoverDate) popoverDate.value = dateFilterInput.value;
    filterAppointmentsTable();
  });

  searchFilterInput?.addEventListener('input', () => {
    if (popoverQuery) popoverQuery.value = searchFilterInput.value;
    filterAppointmentsTable();
  });

  popover?.querySelector('[data-filter-apply]')?.addEventListener('click', () => {
    if (statusFilterSelect && popoverStatus) statusFilterSelect.value = popoverStatus.value;
    if (dateFilterInput && popoverDate) dateFilterInput.value = popoverDate.value;
    if (searchFilterInput && popoverQuery) searchFilterInput.value = popoverQuery.value;
    filterAppointmentsTable();
  });

  popover?.querySelector('[data-filter-reset]')?.addEventListener('click', () => {
    if (statusFilterSelect) statusFilterSelect.value = '';
    if (dateFilterInput) dateFilterInput.value = '';
    if (searchFilterInput) searchFilterInput.value = '';
    if (popoverStatus) popoverStatus.value = '';
    if (popoverDate) popoverDate.value = '';
    if (popoverQuery) popoverQuery.value = '';
    filterAppointmentsTable();
  });

  window.filterFrontAppointments = filterAppointmentsTable;

  // =========================================================================
  // 2. PATIENT QUEUE MODULE (Dynamic Arrivals, Waiting Time, Chairs)
  // =========================================================================
  function formatTime12(isoOrDateStr) {
    if (!isoOrDateStr) return '—';
    const d = new Date(isoOrDateStr);
    if (isNaN(d.getTime())) return isoOrDateStr;
    return d.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
  }

  function calculateWaitingTime(status, checkedInAt) {
    if (status === 'In Progress') return 'In Chair';
    if (status === 'Completed') return 'Done';
    if (status === 'Checked In') {
      if (!checkedInAt) return 'Just arrived';
      const checkedDate = new Date(checkedInAt);
      if (isNaN(checkedDate.getTime())) return 'Arrived';
      const diffMins = Math.max(0, Math.floor((Date.now() - checkedDate.getTime()) / 60000));
      return `${diffMins} min`;
    }
    return '—';
  }

  function renderPatientQueue(queueAppointments) {
    const tbody = document.getElementById('frontQueueTableBody');
    if (!tbody) return;
    queueAppointments = (Array.isArray(queueAppointments) ? queueAppointments : []).filter(item => item.status === 'Checked In');

    if (queueAppointments.length === 0) {
      tbody.innerHTML = '<tr><td colspan="6" class="muted" style="text-align:center;padding:24px;">No patients currently in queue today.</td></tr>';
      return;
    }

    tbody.innerHTML = queueAppointments.map((qAppt, index) => {
      const qNum = 'Q-' + String(index + 1).padStart(3, '0');
      const pName = qAppt.patient?.name || qAppt.guest_name || 'Visitor';
      const pCode = qAppt.patient?.formatted_patient_code || window.CerilloFormat?.patientCode(qAppt.patient?.patient_code, qAppt.patient?.id) || '';
      const time = formatTime12(qAppt.starts_at);
      const dentist = qAppt.dentist?.name || 'Unassigned';
      const status = qAppt.status || 'Pending';
      const checkedInAt = qAppt.checked_in_at || (status === 'Checked In' ? qAppt.starts_at : null);
      const waiting = calculateWaitingTime(status, checkedInAt);

      const badgeClass = status === 'Checked In' ? 'info'
        : status === 'In Progress' ? 'primary'
        : status === 'Completed' ? 'success'
        : status === 'Cancelled' ? 'danger'
        : 'warning';

      return `<tr data-appointment-id="${qAppt.id}" data-queue-num="${qNum}" data-status="${status}" data-filter-tags="${status}">
        <td><strong>${qNum}</strong></td>
        <td>
          <strong>${escapeHtml(pName)}</strong>
          ${pCode ? `<small class="table-subtext">${escapeHtml(pCode)}</small>` : ''}
        </td>
        <td>${escapeHtml(time)}</td>
        <td>${escapeHtml(dentist)}</td>
        <td class="queue-waiting-cell" data-status="${status}" data-checked-in-at="${checkedInAt || ''}">${escapeHtml(waiting)}</td>
        <td><span class="status ${badgeClass}">${escapeHtml(status === 'In Progress' ? 'In Chair' : status)}</span></td>
      </tr>`;
    }).join('');
  }

  function updateQueueWaitingTimesLocally() {
    const cells = document.querySelectorAll('#frontQueueTableBody .queue-waiting-cell');
    cells.forEach(cell => {
      const status = cell.dataset.status;
      const checkedInAt = cell.dataset.checkedInAt;
      if (status === 'Checked In' && checkedInAt) {
        cell.textContent = calculateWaitingTime(status, checkedInAt);
      }
    });
  }
  setInterval(updateQueueWaitingTimesLocally, 30000);

  // =========================================================================
  // 3. PATIENTS MODULE DYNAMIC KPIS
  // =========================================================================
  function updatePatientKpis(kpis) {
    if (!kpis) return;
    const setEl = (selector, val) => {
      const el = document.querySelector(selector);
      if (el) el.textContent = val;
    };
    if (kpis.total_registered_patients !== undefined) {
      setEl('[data-kpi="registered_patients"]', kpis.total_registered_patients);
    }
    if (kpis.new_registrations_month !== undefined) {
      setEl('[data-kpi="new_registrations"]', kpis.new_registrations_month);
      setEl('[data-kpi="trend_registered"]', `↑ ${kpis.new_registrations_month} this month`);
    }
    if (kpis.month_name) {
      setEl('[data-kpi="month_name"]', kpis.month_name);
    }
    if (kpis.recall_contacts_due !== undefined) {
      setEl('[data-kpi="recall_due"]', kpis.recall_contacts_due);
    }
    if (kpis.profiles_needing_update !== undefined) {
      setEl('[data-kpi="profiles_needing_update"]', kpis.profiles_needing_update);
    }
  }

  async function refreshPatientQueue() {
    try {
      const res = await fetch('/api/dashboard', { headers: { Accept: 'application/json' } });
      if (!res.ok) return;
      const data = await res.json();
      if (data.queue_appointments) {
        renderPatientQueue(data.queue_appointments);
      }
      if (data.patient_kpis) {
        updatePatientKpis(data.patient_kpis);
      }
    } catch (err) {
      console.warn('Queue refresh failed:', err);
    }
  }
  window.refreshFrontQueue = refreshPatientQueue;
  setInterval(refreshPatientQueue, 5000);
  window.addEventListener('cerillo-queue-refresh', refreshPatientQueue);

  // =========================================================================
  // 4. PATIENT CHECKOUT MODAL (Database-backed balance and treatment)
  // =========================================================================
  const checkoutModal = document.getElementById('checkoutModal');
  const checkoutPatientSelect = document.getElementById('checkoutPatientSelect');
  const checkoutPatientName = document.getElementById('checkoutPatientName');
  const checkoutPatientCode = document.getElementById('checkoutPatientCode');
  const checkoutOutstandingAmount = document.getElementById('checkoutOutstandingAmount');
  const checkoutTreatmentDesc = document.getElementById('checkoutTreatmentDesc');
  const checkoutPatientId = document.getElementById('checkoutPatientId');
  const checkoutAppointmentId = document.getElementById('checkoutAppointmentId');
  const checkoutService = document.getElementById('checkoutService');
  const checkoutAmountToPay = document.getElementById('checkoutAmountToPay');
  const checkoutPaymentForm = document.getElementById('checkoutPaymentForm');
  const processCheckoutBtn = document.getElementById('processCheckoutBtn');
  const orthoInstallmentFields = document.getElementById('orthoInstallmentFields');
  let checkoutBillingItems = [];

  function configureCheckoutItem(option) {
    if (!option || !option.value) {
      if (checkoutAppointmentId) checkoutAppointmentId.value = '';
      if (checkoutAmountToPay) {
        checkoutAmountToPay.value = '0.00';
        checkoutAmountToPay.readOnly = true;
      }
      if (orthoInstallmentFields) orthoInstallmentFields.hidden = true;
      return;
    }
    const balance = Number(option.dataset.balance || 0);
    const installmentEligible = option.dataset.installment === 'true';
    if (checkoutAppointmentId) checkoutAppointmentId.value = option.dataset.appointmentId || '';
    if (checkoutAmountToPay) {
      checkoutAmountToPay.value = balance.toFixed(2);
      checkoutAmountToPay.max = balance.toFixed(2);
      checkoutAmountToPay.readOnly = !installmentEligible;
      checkoutAmountToPay.classList.toggle('is-readonly-amount', !installmentEligible);
      checkoutAmountToPay.title = installmentEligible
        ? 'Orthodontic/braces services may accept an installment up to the remaining balance.'
        : 'The payable amount is fixed to the remaining balance for this treatment.';
    }
    if (orthoInstallmentFields) orthoInstallmentFields.hidden = !installmentEligible;
    if (checkoutTreatmentDesc) {
      checkoutTreatmentDesc.textContent = `${option.dataset.serviceName || option.textContent} · Remaining ${money(balance)}`;
    }
  }

  async function openPatientCheckout(patientId) {
    if (!checkoutModal) return;

    if (patientId) {
      if (checkoutPatientSelect) checkoutPatientSelect.value = String(patientId);
      if (checkoutPatientId) checkoutPatientId.value = String(patientId);
    }

    checkoutModal.showModal();

    if (!patientId) {
      if (checkoutPatientName) checkoutPatientName.textContent = 'Select Patient';
      if (checkoutPatientCode) checkoutPatientCode.textContent = '—';
      if (checkoutOutstandingAmount) checkoutOutstandingAmount.textContent = '₱0.00';
      if (checkoutTreatmentDesc) checkoutTreatmentDesc.textContent = 'Choose a patient from the list to view their current account.';
      if (checkoutService) checkoutService.innerHTML = '<option value="">Choose a patient first</option>';
      configureCheckoutItem(null);
      return;
    }

    try {
      if (checkoutPatientName) checkoutPatientName.textContent = 'Loading patient details...';
      if (checkoutOutstandingAmount) checkoutOutstandingAmount.textContent = 'Fetching balance...';

      const res = await fetch(`/api/patients/${encodeURIComponent(patientId)}?_=${Date.now()}`, {
        headers: { Accept: 'application/json' },
        cache: 'no-store'
      });
      if (!res.ok) throw new Error('Patient financial record could not be loaded.');
      const data = await res.json();
      const patient = data.patient || {};
      const summary = data.summary || { balance: 0, total_charges: 0, total_payments: 0 };
      checkoutBillingItems = Array.isArray(data.billing_items) ? data.billing_items : [];

      if (checkoutPatientSelect) checkoutPatientSelect.value = String(patient.id || patientId);
      if (checkoutPatientName) checkoutPatientName.textContent = patient.name || 'Patient';
      if (checkoutPatientCode) checkoutPatientCode.textContent = patient.formatted_patient_code || window.CerilloFormat?.patientCode(patient.patient_code, patient.id) || patient.patient_code || '—';
      if (checkoutPatientId) checkoutPatientId.value = patient.id;

      const realBalance = Number(summary.balance || 0);
      if (checkoutOutstandingAmount) checkoutOutstandingAmount.textContent = money(realBalance);

      if (checkoutService) {
        if (checkoutBillingItems.length) {
          checkoutService.innerHTML = checkoutBillingItems.map(item => {
            const dateLabel = item.starts_at ? new Date(item.starts_at).toLocaleDateString(undefined, { month:'short', day:'numeric', year:'numeric' }) : '';
            return `<option value="${item.appointment_id}" data-appointment-id="${item.appointment_id}" data-service-id="${item.service_id || ''}" data-service-name="${escapeHtml(item.service_name)}" data-balance="${Number(item.balance || 0)}" data-installment="${item.installment_eligible ? 'true' : 'false'}">${escapeHtml(item.service_name)}${dateLabel ? ` · ${escapeHtml(dateLabel)}` : ''} · ${money(item.balance)}</option>`;
          }).join('');
          checkoutService.disabled = checkoutBillingItems.length === 1;
          configureCheckoutItem(checkoutService.selectedOptions[0]);
        } else {
          checkoutService.innerHTML = '<option value="">No outstanding treatment balance</option>';
          checkoutService.disabled = true;
          configureCheckoutItem(null);
        }
      }

      if (checkoutTreatmentDesc && !checkoutBillingItems.length) {
        checkoutTreatmentDesc.textContent = 'This patient has no outstanding treatment balance.';
      }
      if (processCheckoutBtn) processCheckoutBtn.disabled = realBalance <= 0.009 || checkoutBillingItems.length === 0;
    } catch (err) {
      if (checkoutPatientName) checkoutPatientName.textContent = 'Error loading patient';
      if (checkoutTreatmentDesc) checkoutTreatmentDesc.textContent = err.message;
      if (processCheckoutBtn) processCheckoutBtn.disabled = true;
      console.error(err);
    }
  }

  checkoutPatientSelect?.addEventListener('change', (e) => {
    const id = e.target.value;
    if (id) openPatientCheckout(id);
  });

  checkoutService?.addEventListener('change', (e) => configureCheckoutItem(e.target.selectedOptions?.[0]));

  checkoutAmountToPay?.addEventListener('input', () => {
    if (checkoutAmountToPay.readOnly) return;
    const max = Number(checkoutAmountToPay.max || 0);
    if (max > 0 && Number(checkoutAmountToPay.value || 0) > max) checkoutAmountToPay.value = max.toFixed(2);
  });

  checkoutPaymentForm?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const pid = checkoutPatientId?.value || checkoutPatientSelect?.value;
    const apptId = checkoutAppointmentId?.value || null;
    const selectedServiceOpt = checkoutService?.selectedOptions?.[0];
    const serviceId = selectedServiceOpt?.dataset.serviceId || null;
    const amount = Number(checkoutAmountToPay?.value || 0);
    const paymentMethod = document.getElementById('checkoutPaymentMethod')?.value || 'Cash';
    const remaining = Number(selectedServiceOpt?.dataset.balance || 0);
    const installmentEligible = selectedServiceOpt?.dataset.installment === 'true';

    if (!pid || !apptId || !serviceId) {
      alert('Select a patient with an outstanding treatment before recording payment.');
      return;
    }
    if (!amount || amount <= 0) {
      alert('Enter a valid payment amount greater than ₱0.00.');
      return;
    }
    if (!installmentEligible && Math.abs(amount - remaining) > 0.009) {
      alert(`This treatment has a fixed payable amount of ${money(remaining)}.`);
      return;
    }
    if (installmentEligible && amount > remaining + 0.009) {
      alert(`Payment cannot exceed the remaining balance of ${money(remaining)}.`);
      return;
    }

    if (processCheckoutBtn) {
      processCheckoutBtn.disabled = true;
      processCheckoutBtn.textContent = 'Processing...';
    }

    try {
      const payload = {
        patient_id: pid,
        appointment_id: apptId,
        service_id: serviceId,
        amount,
        payment_method: paymentMethod
      };

      const res = await fetch('/api/transactions', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify(payload)
      });

      const data = await res.json();
      if (!res.ok) throw new Error(data.message || Object.values(data.errors || {}).flat().join(' ') || 'Payment could not be processed.');

      const pName = checkoutPatientName?.textContent || 'Patient';
      alert(`Payment of ${money(amount)} successfully processed for ${pName}.`);
      checkoutModal.close();

      refreshPatientQueue();
      if (typeof window.refreshFrontPaymentsTable === 'function') window.refreshFrontPaymentsTable();
      const frontPatientModal = document.getElementById('frontPatientModal');
      if (frontPatientModal && frontPatientModal.open && typeof window.openPatientRecord === 'function') window.openPatientRecord(pid);
    } catch (err) {
      alert(err.message);
    } finally {
      if (processCheckoutBtn) {
        processCheckoutBtn.disabled = false;
        processCheckoutBtn.textContent = 'Process Payment';
      }
    }
  });

  document.addEventListener('click', (e) => {
    const patientViewBtn = e.target.closest('.patient-view-btn');
    if (patientViewBtn) {
      const patientId = patientViewBtn.dataset.livePatientId || patientViewBtn.dataset.patientId || patientViewBtn.closest('tr')?.dataset.patientId;
      if (patientId && typeof window.openPatientRecord === 'function') window.openPatientRecord(patientId);
      return;
    }

    const proceedBtn = e.target.closest('#frontPatientProceedCheckoutBtn');
    if (proceedBtn && !proceedBtn.hidden && !proceedBtn.disabled) {
      const frontPatientModal = document.getElementById('frontPatientModal');
      const patientId = frontPatientModal?.dataset.rawPatientId || frontPatientModal?.dataset.patientId;
      if (patientId) openPatientCheckout(patientId);
    }
  });

  window.openFrontPatientCheckout = openPatientCheckout;

  // =========================================================================
  // 5. PAYMENTS LEDGER MODULE (Bottom Transactions Table)
  // =========================================================================
  const paymentsTable = document.querySelector('#front-desk-table-5 tbody');
  const kpi = name => document.querySelector(`[data-payment-kpi="${name}"]`);

  function updatePaymentKpis(payments) {
    const rows = Array.isArray(payments) ? payments : [];
    const completed = rows.filter(payment => String(payment.status || '').toLowerCase() === 'completed');
    const collected = completed.reduce((total, payment) => total + Number(payment.amount || 0), 0);
    const cash = completed
      .filter(payment => String(payment.payment_method || '').toLowerCase() === 'cash')
      .reduce((total, payment) => total + Number(payment.amount || 0), 0);
    const digital = completed
      .filter(payment => String(payment.payment_method || '').toLowerCase() !== 'cash')
      .reduce((total, payment) => total + Number(payment.amount || 0), 0);

    const collectedCard = kpi('collected');
    const outstandingCard = kpi('outstanding');
    const cashCard = kpi('cash');
    const digitalCard = kpi('digital');
    if (collectedCard) {
      collectedCard.querySelector('strong').textContent = money(collected);
      collectedCard.querySelector('span').textContent = `${completed.length} posted payments`;
    }
    if (outstandingCard) {
      outstandingCard.querySelector('strong').textContent = '₱0.00';
      outstandingCard.querySelector('span').textContent = '0 open balances';
    }
    if (cashCard) cashCard.querySelector('strong').textContent = money(cash);
    if (digitalCard) digitalCard.querySelector('strong').textContent = money(digital);
  }

  const detailModal = document.createElement('dialog');
  detailModal.className = 'modal payment-receipt-modal';
  detailModal.innerHTML = `
    <div class="modal-shell payment-receipt-shell">
      <header class="modal-header payment-receipt-header">
        <div>
          <p class="eyebrow">Billing desk · Payment</p>
          <h3>Payment Receipt</h3>
          <p data-payment-receipt-reference>Transaction details</p>
        </div>
        <button class="icon-btn" data-payment-close type="button" aria-label="Close payment details">×</button>
      </header>
      <div class="modal-body payment-receipt-body" data-payment-detail-body></div>
      <footer class="modal-footer payment-receipt-footer">
        <span class="muted" data-payment-email-note></span>
        <div class="payment-receipt-actions">
          <button class="btn secondary" data-payment-email type="button">Send to email</button>
          <button class="btn" data-payment-pdf type="button">Export to PDF</button>
          <button class="btn secondary" data-payment-close type="button">Close</button>
        </div>
      </footer>
    </div>`;
  document.body.append(detailModal);
  detailModal.querySelectorAll('[data-payment-close]').forEach(button => button.addEventListener('click', () => detailModal.close()));

  const paymentCache = new Map();
  let activePaymentId = null;

  function paymentStatusClass(status) {
    return String(status || '').toLowerCase() === 'completed' ? 'success' : 'warning';
  }

  function renderPaymentDetail(payment) {
    const body = detailModal.querySelector('[data-payment-detail-body]');
    const reference = `TXN-${String(payment.id).padStart(5, '0')}`;
    const patient = payment.patient?.name || payment.appointment?.guest_name || 'Guest patient';
    const patientCode = payment.patient?.formatted_patient_code || window.CerilloFormat?.patientCode(payment.patient?.patient_code, payment.patient?.id) || 'Guest';
    const email = payment.patient?.email || payment.appointment?.guest_email || '';
    const service = payment.service?.name || payment.appointment?.service?.name || 'Dental Treatment';
    const dentist = payment.appointment?.dentist?.name || 'Not specified';
    const recordedBy = payment.recorded_by?.name || payment.recordedBy?.name || 'Front Desk';
    const date = payment.created_at ? new Date(payment.created_at).toLocaleString(undefined, { dateStyle:'medium', timeStyle:'short' }) : '—';
    const status = payment.status || 'completed';

    detailModal.querySelector('[data-payment-receipt-reference]').textContent = `${reference} · ${date}`;
    body.innerHTML = `
      <section class="payment-receipt-hero">
        <div>
          <span>Amount paid</span>
          <strong>${money(payment.amount)}</strong>
        </div>
        <span class="status ${paymentStatusClass(status)}">${escapeHtml(status.charAt(0).toUpperCase() + status.slice(1))}</span>
      </section>
      <div class="payment-receipt-grid">
        <article><small>Patient</small><strong>${escapeHtml(patient)}</strong><span>${escapeHtml(patientCode)}</span></article>
        <article><small>Service / Treatment</small><strong>${escapeHtml(service)}</strong><span>${escapeHtml(dentist)}</span></article>
        <article><small>Payment method</small><strong>${escapeHtml(payment.payment_method || '—')}</strong><span>${escapeHtml(date)}</span></article>
        <article><small>Receipt</small><strong>${escapeHtml(reference)}</strong><span>Recorded by ${escapeHtml(recordedBy)}</span></article>
      </div>
      <section class="payment-receipt-contact">
        <div><small>Email receipt to</small><strong>${email ? escapeHtml(email) : 'No email address on file'}</strong></div>
        <div><small>Database transaction</small><strong>#${escapeHtml(payment.id)}</strong></div>
      </section>`;

    const emailBtn = detailModal.querySelector('[data-payment-email]');
    const emailNote = detailModal.querySelector('[data-payment-email-note]');
    emailBtn.disabled = !email;
    emailBtn.title = email ? `Send receipt to ${email}` : 'Patient does not have an email address on file.';
    emailNote.textContent = email ? `Receipt can be sent to ${email}.` : 'Add a patient email before sending a receipt.';
  }

  async function loadPaymentsTable() {
    if (!paymentsTable) return;
    try {
      const response = await fetch('/api/payments?per_page=100&_=' + Date.now(), { headers: { Accept: 'application/json' }, cache: 'no-store' });
      if (!response.ok) throw new Error('Payments could not be loaded.');
      const data = await response.json();
      const payments = data.data || [];
      paymentCache.clear();
      payments.forEach(payment => paymentCache.set(String(payment.id), payment));
      updatePaymentKpis(payments);
      if (!payments.length) {
        paymentsTable.innerHTML = '<tr><td colspan="7" class="muted" style="text-align:center;padding:24px;">No payment records found.</td></tr>';
        return;
      }
      paymentsTable.innerHTML = payments.map(payment => {
        const patient = payment.patient?.name || payment.appointment?.guest_name || 'Guest patient';
        const service = payment.service?.name || payment.appointment?.service?.name || '—';
        const reference = `TXN-${String(payment.id).padStart(5, '0')}`;
        const status = payment.status || 'completed';
        return `<tr>
          <td>${escapeHtml(reference)}</td>
          <td>${escapeHtml(patient)}</td>
          <td>${escapeHtml(service)}</td>
          <td>${money(payment.amount)}</td>
          <td>${escapeHtml(payment.payment_method || '—')}</td>
          <td><span class="status ${paymentStatusClass(status)}">${escapeHtml(status.charAt(0).toUpperCase() + status.slice(1))}</span></td>
          <td><button type="button" class="table-action payment-view" data-payment-id="${payment.id}">View</button></td>
        </tr>`;
      }).join('');
    } catch (error) {
      paymentsTable.innerHTML = `<tr><td colspan="7" class="muted" style="text-align:center;padding:24px;">${escapeHtml(error.message)}</td></tr>`;
    }
  }

  paymentsTable?.addEventListener('click', event => {
    const button = event.target.closest('[data-payment-id]');
    if (!button) return;
    const payment = paymentCache.get(String(button.dataset.paymentId));
    if (!payment) return;
    activePaymentId = payment.id;
    renderPaymentDetail(payment);
    detailModal.showModal();
  });

  detailModal.querySelector('[data-payment-pdf]')?.addEventListener('click', () => {
    if (!activePaymentId) return;
    const link = document.createElement('a');
    link.href = `/api/payments/${encodeURIComponent(activePaymentId)}/pdf`;
    link.download = `Cerillo-Receipt-TXN-${String(activePaymentId).padStart(5, '0')}.pdf`;
    document.body.append(link);
    link.click();
    link.remove();
  });

  detailModal.querySelector('[data-payment-email]')?.addEventListener('click', async event => {
    if (!activePaymentId) return;
    const button = event.currentTarget;
    const original = button.textContent;
    button.disabled = true;
    button.textContent = 'Sending...';
    try {
      const response = await fetch(`/api/payments/${encodeURIComponent(activePaymentId)}/email`, {
        method: 'POST',
        headers: { Accept: 'application/json', 'X-CSRF-TOKEN': csrf }
      });
      const data = await response.json();
      if (!response.ok) throw new Error(data.message || 'Receipt could not be sent.');
      alert(data.message || 'Receipt sent successfully.');
    } catch (error) {
      alert(error.message);
    } finally {
      button.disabled = false;
      button.textContent = original;
    }
  });

  window.refreshFrontPaymentsTable = loadPaymentsTable;

  // Initialize
  updatePaymentKpis([]);
  loadPaymentsTable();
  refreshPatientQueue();
  filterAppointmentsTable();
})();
</script>

<script src="/assets/js/cerillo-responsive.js"></script>
<script src="/assets/js/cerillo-table-pagination.js"></script>

<script src="{{ asset('assets/js/settings-ui.js') }}"></script>

<style id="frontDeskCheckoutPaymentRefinements">
#frontPatientProceedCheckoutBtn[hidden]{display:none!important}
#checkoutAmountToPay.is-readonly-amount{background:#f4f7fb;color:#17233f;cursor:not-allowed;font-weight:700}
.payment-receipt-shell{width:min(760px,calc(100vw - 32px));max-width:760px;overflow:hidden}
.payment-receipt-header{border-bottom:1px solid #e5eaf2;background:linear-gradient(135deg,#fff 0%,#f6f8ff 100%)}
.payment-receipt-body{display:grid;gap:18px;padding:22px}
.payment-receipt-hero{display:flex;align-items:center;justify-content:space-between;gap:20px;padding:20px 22px;border:1px solid #dfe6f3;border-radius:16px;background:#f8faff}
.payment-receipt-hero div{display:grid;gap:4px}.payment-receipt-hero span{font-size:12px;color:#68748d}.payment-receipt-hero strong{font-size:30px;line-height:1.1;color:#1c2c67}
.payment-receipt-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}
.payment-receipt-grid article,.payment-receipt-contact{border:1px solid #e1e7f0;border-radius:14px;background:#fff;padding:15px 16px}
.payment-receipt-grid article{display:grid;gap:5px}.payment-receipt-grid small,.payment-receipt-contact small{font-size:11px;text-transform:uppercase;letter-spacing:.06em;color:#7a869e}.payment-receipt-grid strong,.payment-receipt-contact strong{color:#13254a}.payment-receipt-grid article span{font-size:12px;color:#66738c}
.payment-receipt-contact{display:grid;grid-template-columns:minmax(0,1fr) auto;gap:16px}.payment-receipt-contact>div{display:grid;gap:5px}
.payment-receipt-footer{display:flex;align-items:center;justify-content:space-between;gap:16px;border-top:1px solid #e5eaf2}.payment-receipt-actions{display:flex;flex-wrap:wrap;gap:8px;justify-content:flex-end}
body.dark-mode .payment-receipt-header,body.dark-mode .payment-receipt-hero,body.dark-mode .payment-receipt-grid article,body.dark-mode .payment-receipt-contact{background:#151c2d;border-color:#2d3850;color:#e8eefc}
body.dark-mode .payment-receipt-hero strong,body.dark-mode .payment-receipt-grid strong,body.dark-mode .payment-receipt-contact strong{color:#f5f8ff}
body.dark-mode #checkoutAmountToPay.is-readonly-amount{background:#151c2d;color:#f5f8ff}
@media(max-width:640px){.payment-receipt-grid,.payment-receipt-contact{grid-template-columns:1fr}.payment-receipt-footer{align-items:stretch;flex-direction:column}.payment-receipt-actions{justify-content:stretch}.payment-receipt-actions .btn{flex:1}.payment-receipt-hero strong{font-size:25px}}
</style>
<script defer src="/assets/js/cerillo-patient-pdf.js"></script>
<script defer src="/assets/js/cerillo-frontdesk-clinicians.js"></script>
<script defer src="/assets/js/cerillo-dentist-directory.js"></script>
</body>
</html>

<style>.modal .modal-body,.modal-shell {max-height:80vh;overflow-y:auto}#addPatientModal,#addPatientForm,.new-patient-fields{display:none!important}@media(max-width:800px){.workspace-main,.workspace-content{min-width:0;max-width:100%}.table-wrap,.table-container{overflow-x:auto}}</style>
<?php /**PATH C:\Users\cgmsyl\risa\cerillo_final\cerillo_full\resources\views\workspaces\front-desk\index.blade.php ENDPATH**/ ?>