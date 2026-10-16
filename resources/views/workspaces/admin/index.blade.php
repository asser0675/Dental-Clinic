<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="Cerillo Dental Clinic Admin workspace" name="description"/>
<title>
   Admin · Cerillo Dental Clinic
  </title>
<link href="{{ asset('assets/images/cerillo-logo.png') }}" rel="icon"/>
<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet"/>
<meta name="csrf-token" content="{{ csrf_token() }}"><link rel="stylesheet" href="{{ asset('assets/css/clinic-fixes.css') }}"><link rel="stylesheet" href="/assets/css/cerillo-responsive.css">
<script src="/assets/js/cerillo-format.js"></script>
</head>
<body class="workspace-body admin-clinical-mode admin-management-scope" data-workspace-role="admin" data-workspace-view="admin" data-head-dentist-id="{{ auth()->id() }}">
<aside class="workspace-sidebar">
<a class="workspace-brand" href="{{ route('booking') }}">
<img alt="Cerillo Dental Clinic logo" src="{{ asset('assets/images/cerillo-logo.png') }}"/>
<span>
     Cerillo
     <small>
      Dental Clinic
     </small>
</span>
</a>
<div class="role-label">Admin Modules</div>
<nav aria-label="Admin navigation" class="side-nav">
<a class="side-link" href="#dashboard"><span>Dashboard</span></a>
<a class="side-link" href="#patients"><span>Patient Records</span></a>
<a class="side-link" href="#calendar"><span>Calendar</span></a>
<a class="side-link" href="#appointments"><span>Appointments</span></a>
<a class="side-link" href="#services"><span>Services &amp; Pricing</span></a>
<a class="side-link" href="#payments"><span>Billing &amp; Payments</span></a>
<a class="side-link" href="#sales"><span>Sales Transactions</span></a>
<a class="side-link" href="#reports"><span>Reports &amp; Analytics</span></a>
<a class="side-link" href="#activity"><span>Activity Logs</span></a>
<a class="side-link" href="#accounts"><span>Accounts</span></a>
<a class="side-link" href="#settings"><span>Settings</span></a>
</nav>
<div class="role-label sidebar-category-divider">Head Dentist Modules</div>
<nav aria-label="Head Dentist navigation" class="side-nav">
<a class="side-link" href="#dentist-appointments"><span>Appointments</span></a>
<a class="side-link" href="#dentist-patients"><span>Patient Records</span></a>
</nav>
<div class="sidebar-profile">
<div class="avatar">
     A
    </div>
<div>
<strong>
      Admin
     </strong>
<small>
      Admin
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
      Admin Workspace
     </h1>
</div>
<div class="topbar-actions" style="display: flex; align-items: center; gap: 14px;">
<button type="button" class="btn secondary sm topbar-backup-btn" id="openBackupModalBtn" aria-label="Open Backup and Recovery" title="Data Backup &amp; Recovery">
  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="margin-right: 6px; vertical-align: text-bottom;">
    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
    <polyline points="17 21 17 13 7 13 7 21"></polyline>
    <polyline points="7 3 7 8 15 8"></polyline>
  </svg>
  <span>Backup &amp; Recovery</span>
</button>
<div aria-label="Current date and time" class="topbar-clock">
<span data-live-date="">
      {{ now()->format('F j, Y') }}
     </span>
<strong data-live-time="">
      {{ now()->format('g:i A') }}
     </strong>
</div>
</div>
</header>
<section class="workspace-section active-section" id="dashboard">
<div class="section-heading">
<div>
<p class="eyebrow">
       Clinic overview
      </p>
<h2>
       Admin Dashboard
      </h2>
<p>
       Daily operations, patient activity, appointments, and collections at a glance.
      </p>
</div>
</div>
<div class="metric-strip">
<div class="metric-box" data-dashboard-metric="patients_today">
<small>
       Today's patients
      </small>
<strong>
       {{ $metrics['patients_today'] ?? 0 }}
      </strong>
<span>
       {{ $metrics['checked_in_today'] ?? 0 }} waiting / in clinic
      </span>
</div>
<div class="metric-box" data-dashboard-metric="pending_verifications">
<small>
       Pending confirmations
      </small>
<strong>
       {{ $metrics['pending_verifications'] ?? 0 }}
      </strong>
<span>
       next 48 hours
      </span>
</div>
<div class="metric-box" data-dashboard-metric="scheduled_today">
<small>
       Scheduled today
      </small>
<strong>
       {{ $metrics['scheduled_today'] ?? 0 }}
      </strong>
<span>
       Scheduled appointments
      </span>
</div>
<div class="metric-box" data-dashboard-metric="completed_today">
<small>
       Completed today
      </small>
<strong>
       {{ $metrics['completed_today'] ?? 0 }}
      </strong>
<span>
       Completed appointments
      </span>
</div>
</div>
<div class="stat-grid">
<article class="stat-card" data-dashboard-metric="appointments_today">
<span>
       Today's Appointments
      </span>
<strong>
       {{ $metrics['appointments_today'] ?? 0 }}
      </strong>
<small>
       {{ $metrics['scheduled_today'] ?? 0 }} scheduled / pending
      </small>
</article>
<article class="stat-card" data-dashboard-metric="total_patients">
<span>
       Active Patients
      </span>
<strong>
       {{ $metrics['total_patients'] ?? 0 }}
      </strong>
<small>
       {{ $metrics['new_registrations_month'] ?? 0 }} new this month
      </small>
</article>
<article class="stat-card" data-dashboard-metric="collections_today">
<span>
       Today's Collections
      </span>
<strong>
       ₱{{ number_format($metrics['collections_today'] ?? 0, 2) }}
      </strong>
<small>
       Across today's payments
      </small>
</article>
<article class="stat-card" data-dashboard-metric="cancelled_today">
<span>
       Cancelled today
      </span>
<strong>
       {{ $metrics['cancelled_today'] ?? 0 }}
      </strong>
<small>
       Cancelled or no-show appointments
      </small>
</article>
</div>
<div class="dashboard-grid">
<article class="panel chart-card">
<div class="panel-heading">
<div>
<h3>
         Appointments This Week
        </h3>
<p>
         Scheduled patient visits by day
        </p>
</div>
</div>
<div aria-label="Appointments this week bar chart" class="bar-chart" data-dashboard-weekly-bars="">
<div class="bar-column">
<span class="bar-value">
         0
        </span>
<div class="bar" style="height: 0%">
</div>
<small>
         Mon
        </small>
</div>
<div class="bar-column">
<span class="bar-value">
         0
        </span>
<div class="bar" style="height: 0%">
</div>
<small>
         Tue
        </small>
</div>
<div class="bar-column">
<span class="bar-value">
         0
        </span>
<div class="bar" style="height: 0%">
</div>
<small>
         Wed
        </small>
</div>
<div class="bar-column">
<span class="bar-value">
         0
        </span>
<div class="bar" style="height: 0%">
</div>
<small>
         Thu
        </small>
</div>
<div class="bar-column">
<span class="bar-value">
         0
        </span>
<div class="bar" style="height: 0%">
</div>
<small>
         Fri
        </small>
</div>
<div class="bar-column">
<span class="bar-value">
         0
        </span>
<div class="bar" style="height: 0%">
</div>
<small>
         Sat
        </small>
</div>
</div>
</article>
<article class="panel">
<div class="panel-heading">
<div>
<h3>
         Recent Activity
        </h3>
<p>
         Latest recorded system actions
        </p>
</div>
</div>
<div class="activity-list">
<p class="muted small" style="padding:12px 0;">Loading recent system activity...</p>
</div>
</article>
</div>
<div class="dashboard-analytics-grid">
<article class="panel analytics-card analytics-wide">
<div class="panel-heading">
<div>
<h3>
         Patient Visits Trend
        </h3>
<p>
         Daily patient volume across the current week.
        </p>
</div>
<span class="chart-total">
        {{ $metrics['appointments_today'] ?? 0 }} visits
       </span>
</div>
<div class="svg-chart-wrap">
<svg aria-label="Patient visits trend Monday through Sunday" class="line-chart-svg" role="img" viewbox="0 0 720 230">
<g class="chart-grid-lines">
<line x1="44" x2="690" y1="40" y2="40">
</line>
<line x1="44" x2="690" y1="90" y2="90">
</line>
<line x1="44" x2="690" y1="140" y2="140">
</line>
<line x1="44" x2="690" y1="190" y2="190">
</line>
</g>
<path class="chart-area" d="M54,160 C105,150 122,174 162,170 S225,70 270,78 S330,132 370,126 S430,106 478,114 S540,137 586,128 S650,112 682,118 L682,190 L54,190 Z">
</path>
<path class="chart-line" d="M54,160 C105,150 122,174 162,170 S225,70 270,78 S330,132 370,126 S430,106 478,114 S540,137 586,128 S650,112 682,118">
</path>
<g class="chart-points">
<circle cx="54" cy="160" r="5">
</circle>
<circle cx="162" cy="170" r="5">
</circle>
<circle cx="270" cy="78" r="5">
</circle>
<circle cx="370" cy="126" r="5">
</circle>
<circle cx="478" cy="114" r="5">
</circle>
<circle cx="586" cy="128" r="5">
</circle>
<circle cx="682" cy="118" r="5">
</circle>
</g>
<g class="chart-axis-labels">
<text x="45" y="216">
          Mon
         </text>
<text x="150" y="216">
          Tue
         </text>
<text x="258" y="216">
          Wed
         </text>
<text x="358" y="216">
          Thu
         </text>
<text x="468" y="216">
          Fri
         </text>
<text x="575" y="216">
          Sat
         </text>
<text x="670" y="216">
          Sun
         </text>
</g>
</svg>
</div>
</article>
<article class="panel analytics-card">
<div class="panel-heading">
<div>
<h3>
         Appointment Mix
        </h3>
<p>
         Today’s schedule by current state.
        </p>
</div>
</div>
<div class="donut-layout">
<div class="donut-chart appointment-donut" data-dashboard-donut="">
<div>
<strong data-dashboard-total-appointments="">
          {{ $metrics['appointments_today'] ?? 0 }}
         </strong>
<span>
          appointments
         </span>
</div>
</div>
<div class="chart-legend-list">
<span>
<i class="dot green">
</i>
         Completed
         <strong data-dashboard-status="Completed">
          {{ $metrics['completed_today'] ?? 0 }}
         </strong>
</span>
<span>
<i class="dot blue">
</i>
         Checked in
         <strong data-dashboard-status="Checked In">
          {{ $metrics['checked_in_today'] ?? 0 }}
         </strong>
</span>
<span>
<i class="dot amber">
</i>
         Pending
         <strong data-dashboard-status="Pending">
          {{ $metrics['scheduled_today'] ?? 0 }}
         </strong>
</span>
<span>
<i class="dot red">
</i>
         Cancelled
         <strong data-dashboard-status="Cancelled">
          {{ $metrics['cancelled_today'] ?? 0 }}
         </strong>
</span>
</div>
</div>
</article>
<article class="panel analytics-card">
<div class="panel-heading">
<div>
<h3>
         Collections by Method
        </h3>
<p>
         Payments posted today.
        </p>
</div>
</div>
<div class="horizontal-bars" data-dashboard-collections="">
<p class="muted small" style="padding:12px 0;">Loading collections data...</p>
</div>
</article>
<article class="panel analytics-card">
<div class="panel-heading">
<div>
<h3>
         Clinic Capacity
        </h3>
<p>
         Useful operating counts for today.
        </p>
</div>
</div>
<div class="compact-count-grid">
<div>
<strong>
         {{ $dentists->count() }}
        </strong>
<span>
         Dentists on duty
        </span>
</div>
<div>
<strong>
         3
        </strong>
<span>
         Operatories active
        </span>
</div>
<div>
<strong>
         {{ $metrics['recall_contacts_due'] ?? 0 }}
        </strong>
<span>
         Follow-ups due
        </span>
</div>
<div>
<strong>
         0
        </strong>
<span>
         Radiographs added
        </span>
</div>
</div>
</article>
</div>
</section>
<section class="workspace-section" id="patients">
<div class="section-heading">
<div>
<p class="eyebrow">
       Patient records
      </p>
<h2>
       Patient Records
      </h2>
<p>
       Complete demographic and clinical information for every patient.
      </p>
</div>
<button class="btn secondary" data-export-current-patient-pdf="" type="button">Export patient record PDF</button></div>
<div class="patient-summary-grid">
<div class="patient-summary-card">
<small>
       Total patient records
      </small>
<strong>
       {{ $metrics['total_registered_patients'] ?? 0 }}
      </strong>
<span class="trend">
       ↑ {{ $metrics['new_registrations_month'] ?? 0 }} this month
      </span>
</div>
<div class="patient-summary-card">
<small>
       Active patients
      </small>
<strong>
       {{ $metrics['total_registered_patients'] ?? 0 }}
      </strong>
<span>
       100% of records
      </span>
</div>
<div class="patient-summary-card">
<small>
       Recall due this month
      </small>
<strong>
       {{ $metrics['recall_contacts_due'] ?? 0 }}
      </strong>
<span>
       Due for periodic recall
      </span>
</div>
<div class="patient-summary-card">
<small>
       Accounts with balance
      </small>
<strong>
       0
      </strong>
<span>
       ₱0.00 outstanding
      </span>
</div>
</div>
<div class="panel table-wrap patient-records-table">
<div class="table-toolbar">
<h3>
       All Patients
      </h3>
<div class="table-toolbar-actions">
<div class="table-filter-dock"><select aria-label="Patient segment" class="patient-segment-control" data-patient-segment-for="admin-patient-table"><option value="">All segments</option><option value="Orthodontics">Orthodontics</option><option value="Preventive">Preventive</option><option value="Restorative">Restorative</option><option value="Endodontics">Endodontics</option><option value="Oral Surgery">Oral Surgery</option><option value="General">General</option></select><select aria-label="Procedure filter" class="patient-procedure-control" data-patient-procedure-for="admin-patient-table"><option value="">All procedures</option><option value="Oral Prophylaxis">Oral Prophylaxis</option><option value="Composite Restoration">Composite Restoration</option><option value="Root Canal Therapy">Root Canal Therapy</option><option value="Orthodontic Braces">Orthodontic Braces</option><option value="Dental Checkup">Dental Checkup</option></select>
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="admin-patient-table" placeholder="Search patient, phone, allergy..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="admin-patient-table">
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
<details class="filter-popover" data-filter-for="admin-patient-table">
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
             Active
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
</div>
</div>
<table id="admin-patient-table">
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
         Status
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
  $lastVisit = $lastAppt?->starts_at ? $lastAppt->starts_at->format('M d, Y') : 'New';
  $procedure = $lastAppt?->service?->name ?? 'General';
@endphp
<tr data-patient-id="{{ $patient->id }}" data-procedure="{{ $procedure }}" data-segment="Restorative">
<td>
<strong>{{ $patient->name }}</strong>
<small class="table-subtext">{{ $patient->formatted_patient_code }}</small>
</td>
<td>{{ $age }}</td>
<td>{{ $patient->formatted_phone ?: ($patient->email ?: '—') }}</td>
<td>{{ $alert }}</td>
<td>{{ $lastVisit }}</td>
<td><span class="badge success">Active</span></td>
<td>
<button class="action-btn patient-view-btn" data-live-patient-id="{{ $patient->id }}" data-patient-id="{{ $patient->id }}" type="button">View</button>
</td>
</tr>
@empty
<tr>
<td colspan="7" class="muted" style="text-align:center;padding:24px;">No patients found in directory.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</section>
<section class="workspace-section" id="calendar">
<div class="section-heading">
<div>
<p class="eyebrow">Clinic schedule</p>
<h2>Calendar</h2>
<p>Review clinic appointments and dentist availability from 9:00 AM to 5:00 PM.</p>
</div>
</div>
<div class="panel admin-calendar-shell admin-calendar-v2">
<div class="admin-calendar-v2-toolbar">
<div class="admin-calendar-period-nav">
<button class="calendar-nav-btn" data-admin-calendar-prev type="button" aria-label="Previous period">‹</button>
<div class="admin-calendar-period-copy">
<span>Schedule period</span>
<strong id="adminCalendarTitle">Current schedule</strong>
</div>
<button class="calendar-nav-btn" data-admin-calendar-next type="button" aria-label="Next period">›</button>
<button class="btn secondary sm admin-calendar-today" data-admin-calendar-today type="button">Today</button>
</div>
<div class="admin-calendar-v2-controls">
<label class="calendar-dentist-filter">Dentist
<select id="adminCalendarDentistFilter">
<option value="">All dentists</option>
@foreach($dentists as $dentist)
<option value="{{ $dentist->id }}">{{ $dentist->name }}</option>
@endforeach
</select>
</label>
<div aria-label="Calendar view" class="segmented admin-calendar-view-toggle">
<button class="active" data-admin-calendar-view="week" type="button">Week</button>
<button data-admin-calendar-view="month" type="button">Month</button>
</div>
</div>
</div>
<div class="admin-calendar-v2-layout">
<aside class="admin-calendar-month-rail" aria-label="Month navigation">
<div class="admin-calendar-year-row">
<button type="button" data-admin-calendar-year-prev aria-label="Previous year">‹</button>
<strong id="adminCalendarYear">{{ date('Y') }}</strong>
<button type="button" data-admin-calendar-year-next aria-label="Next year">›</button>
</div>
<div class="admin-calendar-month-list" id="adminCalendarMonthRail"></div>
</aside>
<div class="admin-calendar-main-stage">
<div class="calendar-selection-note" id="adminCalendarSelection">Select an appointment to open its details, or select an empty schedule to inspect that time.</div>
<div class="weekly-calendar-scroll" id="adminCalendarWeek">
<div class="weekly-calendar wide-calendar" id="adminInteractiveWeek"></div>
</div>
<div class="admin-month-calendar" hidden id="adminCalendarMonth"></div>
</div>
<aside class="admin-calendar-agenda" aria-label="Calendar agenda">
<div class="admin-calendar-agenda-head">
<div class="admin-calendar-agenda-title-block">
<span>Agenda</span>
<div class="calendar-status-legend" aria-label="Appointment status indicators">
<span><i class="dot-scheduled"></i>Scheduled</span>
<span><i class="dot-completed"></i>Completed</span>
<span><i class="dot-progress"></i>In Progress</span>
<span><i class="dot-cancelled"></i>Cancelled / No-Show</span>
</div>
<strong id="adminCalendarAgendaLabel">Current period</strong>
<small>Click an appointment to view details.</small>
</div>
</div>
<div class="admin-calendar-agenda-list" id="adminCalendarAppointments" aria-live="polite">
<p class="muted">Loading appointments…</p>
</div>
</aside>
</div>
</div>
<div class="panel availability-schedule-panel admin-availability-schedule-panel">
<div class="panel-header">
<div>
<h3>Unavailable Schedules</h3>
<p>Dates and times currently blocked for clinic dentists.</p>
</div>
</div>
<div class="availability-records" id="adminAvailabilityTable">
<div class="availability-empty-state"><strong>Loading unavailable schedules…</strong></div>
</div>
</div>
</section>
<section class="workspace-section" id="appointments">
<div class="section-heading">
<div>
<p class="eyebrow">
       Schedule
      </p>
<h2>
       Appointments
      </h2>
<p>
       Review patient schedules, dentist assignments, arrival information, and appointment records.
      </p>
</div>
<div class="stat-grid">
<article class="stat-card" data-dashboard-metric="appointments_today"><span>Today's Appointments</span><strong>0</strong><small>All appointment sources</small></article>
<article class="stat-card" data-dashboard-metric="upcoming_appointments"><span>Upcoming</span><strong>0</strong><small>Next 7 days</small></article>
<article class="stat-card" data-dashboard-metric="completed_today"><span>Completed Today</span><strong>0</strong><small>Completed visits</small></article>
<article class="stat-card" data-dashboard-metric="cancelled_today"><span>Cancelled / No-show</span><strong>0</strong><small>Today's appointment exceptions</small></article>
</div>
</div>
<div class="availability-board" id="adminAvailabilityNotice">
<div>
<strong>
       Dentist unavailable schedules
      </strong>
<span>
       Blocks saved by dentists are reflected here automatically for scheduling awareness.
      </span>
</div>
<div class="availability-chips" id="adminAvailabilityChips">
<span class="availability-empty">
       No additional blocked schedules.
      </span>
</div>
</div>
<div class="appointment-overview admin-appointments-calendar">
<div class="week-calendar">
<div class="calendar-head">
<div>
<h3>
         Weekly Calendar
        </h3>
<span>
         {{ now()->startOfWeek()->format('M d') }} – {{ now()->startOfWeek()->addDays(4)->format('M d, Y') }}
        </span>
</div>
<div class="flex">
<button class="btn secondary sm" type="button">
         ‹
        </button>
<button class="btn secondary sm" type="button">
         ›
        </button>
</div>
</div>
<div class="table-wrap" style="border:0; box-shadow:none">
<div class="calendar-grid">
<div class="calendar-cell day">
</div>
<div class="calendar-cell day">
         Monday
         <br/>
<small>
          {{ now()->startOfWeek()->format('M d') }}
         </small>
</div>
<div class="calendar-cell day">
         Tuesday
         <br/>
<small>
          {{ now()->startOfWeek()->addDays(1)->format('M d') }}
         </small>
</div>
<div class="calendar-cell day">
         Wednesday
         <br/>
<small>
          {{ now()->startOfWeek()->addDays(2)->format('M d') }}
         </small>
</div>
<div class="calendar-cell day">
         Thursday
         <br/>
<small>
          {{ now()->startOfWeek()->addDays(3)->format('M d') }}
         </small>
</div>
<div class="calendar-cell day">
         Friday
         <br/>
<small>
          {{ now()->startOfWeek()->addDays(4)->format('M d') }}
         </small>
</div>
<div class="calendar-cell time">
         9:00 AM
        </div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell time">
         10:00 AM
        </div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell time">
         11:00 AM
        </div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell time">
         1:00 PM
        </div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
<div class="calendar-cell"></div>
</div>
</div>
</div>
<aside class="today-stack">
<div class="today-card title schedule-focus-card">
<span aria-hidden="true" class="schedule-focus-icon">
        ↗
       </span>
<div>
<strong>
         Schedule Capacity
        </strong>
<span>
         Next open slot and current chair utilization
        </span>
</div>
<div class="schedule-focus-value">
<small>
         Next open slot
        </small>
<b>
         {{ $appointments->firstWhere('status', 'scheduled') ? \Carbon\Carbon::parse($appointments->firstWhere('status', 'scheduled')->appointment_time)->format('g:i A') : 'Available' }}
        </b>
</div>
</div>
<div class="today-card">
<span>
        Total appointments
       </span>
<strong>
        {{ $metrics['appointments_today'] ?? 0 }}
       </strong>
</div>
<div class="today-card">
<span>
        Completed
       </span>
<strong>
        {{ $metrics['completed_today'] ?? 0 }}
       </strong>
</div>
<div class="today-card">
<span>
        Pending check-ins
       </span>
<strong>
        {{ $metrics['scheduled_today'] ?? 0 }}
       </strong>
</div>
<div class="today-card">
<span>
        No-shows
       </span>
<strong>
        {{ $metrics['cancelled_today'] ?? 0 }}
       </strong>
</div>
</aside>
</div>
<div class="notice">
<strong>
      Pending appointment process:
     </strong>
     Front Desk manages appointment status and arrival handling. Admin has read-only oversight of the schedule, dentist assignment, patient arrival, and appointment details.
    </div>
<div class="panel table-wrap">
<div class="appointment-table-heading table-toolbar">
<div>
<h3>
        Appointment Register
       </h3>
<p>
        Patient schedule, assigned dentist, service, arrival and record access.
       </p>
</div>
<div class="table-toolbar-actions">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="admin-appointment-register" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="admin-appointment-register">
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
<details class="filter-popover" data-filter-for="admin-appointment-register">
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
<option>
             Pending
            </option>
<option>
             Checked In
            </option>
<option>
             Completed
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
</div>
</div>
<table id="admin-appointment-register">
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
  $dateFormatted = $appt->starts_at ? $appt->starts_at->format('M d, Y') : '—';
  $timeFormatted = $appt->starts_at ? $appt->starts_at->format('g:i A') : '—';
  $isoDate = $appt->starts_at ? $appt->starts_at->format('Y-m-d') : '';
  $st = strtolower($appt->status ?? 'pending');
  $badgeClass = str_contains($st, 'complete') ? 'completed'
    : (str_contains($st, 'progress') ? 'in-progress'
    : (str_contains($st, 'check') ? 'checked-in'
    : (str_contains($st, 'cancel') ? 'cancelled'
    : (str_contains($st, 'no-show') ? 'no-show' : 'pending'))));
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
<td>{{ $dentistName }}</td>
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
<span class="status {{ $badgeClass }}">
{{ $appt->status ?? 'Pending' }}
</span>
</td>
<td>
<button class="table-action appointment-view" data-appointment-id="{{ $appt->id }}" type="button">
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
</section>
<section class="workspace-section" id="services">
<div class="section-heading">
<div>
<p class="eyebrow">
       Catalog
      </p>
<h2>
       Services &amp; Pricing
      </h2>
<p>
       Explore available care by category. Fees are discussed after examination and treatment planning.
      </p>
</div>
<button class="btn" id="addServiceBtn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
      + Add Service
     </button>
</div>
<div class="service-grid">
<article class="service-card">
<img alt="Comprehensive Dental Examination" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/comprehensive-exam.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6528858/pexels-photo-6528858.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Preventive
      </span>
<h3>
       Comprehensive Dental Examination
      </h3>
<p>
       A complete oral assessment covering teeth, gums, bite and treatment needs.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Oral Prophylaxis" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/oral-prophylaxis.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/3779706/pexels-photo-3779706.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Preventive
      </span>
<h3>
       Oral Prophylaxis
      </h3>
<p>
       Professional plaque and calculus removal with polishing and preventive guidance.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Fluoride Treatment" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/fluoride-treatment.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6528868/pexels-photo-6528868.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Preventive
      </span>
<h3>
       Fluoride Treatment
      </h3>
<p>
       Topical fluoride application to strengthen enamel and support caries prevention.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Dental Sealants" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/dental-sealants.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6528868/pexels-photo-6528868.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Preventive
      </span>
<h3>
       Dental Sealants
      </h3>
<p>
       Protective resin placed on deep grooves of posterior teeth to reduce decay risk.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Composite Restoration" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/composite-restoration.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/3779713/pexels-photo-3779713.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Restorative
      </span>
<h3>
       Composite Restoration
      </h3>
<p>
       Tooth-colored restoration for teeth affected by decay, wear or minor fracture.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Dental Crown" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/dental-crown.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6502305/pexels-photo-6502305.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Restorative
      </span>
<h3>
       Dental Crown
      </h3>
<p>
       Full-coverage restoration used to protect and rebuild a weakened tooth.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Dental Bridge" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/dental-bridge.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6502343/pexels-photo-6502343.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Restorative
      </span>
<h3>
       Dental Bridge
      </h3>
<p>
       Fixed replacement for one or more missing teeth using adjacent support.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Root Canal Treatment" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/root-canal.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6529107/pexels-photo-6529107.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Endodontics
      </span>
<h3>
       Root Canal Treatment
      </h3>
<p>
       Removal of infected pulp tissue followed by cleaning, shaping and sealing of canals.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Tooth Extraction" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/tooth-extraction.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6528868/pexels-photo-6528868.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Oral Surgery
      </span>
<h3>
       Tooth Extraction
      </h3>
<p>
       Removal of a tooth when preservation is not clinically appropriate.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Wisdom Tooth Assessment" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/wisdom-tooth.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6528858/pexels-photo-6528858.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Oral Surgery
      </span>
<h3>
       Wisdom Tooth Assessment
      </h3>
<p>
       Clinical and imaging assessment of third molars with treatment planning when indicated.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Complete &amp; Partial Dentures" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/dentures.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/5622025/pexels-photo-5622025.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Prosthodontics
      </span>
<h3>
       Complete &amp; Partial Dentures
      </h3>
<p>
       Removable tooth replacement planned around oral anatomy, function and comfort.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Dental Implant Restoration" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/implant-restoration.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6502305/pexels-photo-6502305.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Implant Dentistry
      </span>
<h3>
       Dental Implant Restoration
      </h3>
<p>
       Implant-supported tooth replacement planned after clinical and imaging evaluation.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Teeth Whitening" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/teeth-whitening.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/5622271/pexels-photo-5622271.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Cosmetic
      </span>
<h3>
       Teeth Whitening
      </h3>
<p>
       Supervised whitening intended to lighten tooth discoloration.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Porcelain Veneers" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/porcelain-veneers.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/5622271/pexels-photo-5622271.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Cosmetic
      </span>
<h3>
       Porcelain Veneers
      </h3>
<p>
       Thin restorations bonded to the front surfaces of selected teeth.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Clear Aligners" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/clear-aligners.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6528907/pexels-photo-6528907.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Orthodontics
      </span>
<h3>
       Clear Aligners
      </h3>
<p>
       Removable aligner therapy for selected tooth-alignment and bite concerns.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Retainers" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/retainers.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6528907/pexels-photo-6528907.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Orthodontics
      </span>
<h3>
       Retainers
      </h3>
<p>
       Custom appliances used to help maintain tooth position after orthodontic treatment.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Night Guard" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/night-guard.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6502345/pexels-photo-6502345.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Occlusion
      </span>
<h3>
       Night Guard
      </h3>
<p>
       Custom occlusal appliance for patients with grinding or clenching concerns.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
<article class="service-card">
<img alt="Periodontal Therapy" class="service-photo" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/periodontal-therapy.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/3779706/pexels-photo-3779706.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
<span>
       Periodontics
      </span>
<h3>
       Periodontal Therapy
      </h3>
<p>
       Gum-focused assessment and non-surgical care based on periodontal findings.
      </p>
<button class="action-btn" onclick="document.getElementById('serviceModal').showModal()" type="button">
       Details
      </button>
<button class="btn btn-secondary service-edit-btn" onclick="document.getElementById('serviceCrudModal').showModal()" type="button">
       Edit
      </button>
</article>
</div>
</section>
<section class="workspace-section" id="payments">
<div class="section-heading">
<div>
<p class="eyebrow">
       Financial administration
      </p>
<h2>
       Billing &amp; Payments
      </h2>
<p>
       Monitor every patient payment and use administrative overrides only when authorized.
      </p>
</div>
</div>
<div class="panel ortho-installment-admin" id="orthoInstallmentPanel"><div class="panel-heading"><div><h3>Installment Oversight</h3><p>Monitor active payment plans, upcoming dues, and installment collections.</p></div></div><div class="installment-summary-row"><div><small>Active plans</small><strong>0</strong></div><div><small>Next due</small><strong>₱0.00</strong></div><div><small>Collected this month</small><strong>₱0.00</strong></div></div></div>
<div class="stats-grid">
<article class="stat-card" data-dashboard-metric="collections_today">
<p>
       Collected today
      </p>
<strong>
       ₱{{ number_format($metrics['collections_today'] ?? 0, 2) }}
      </strong>
<span>
       <span data-dashboard-metric="payments_today">0</span> payments
      </span>
</article>
<article class="stat-card">
<p>
       Outstanding
      </p>
<strong>
       ₱0.00
      </strong>
<span>
       0 patient balances
      </span>
</article>
<article class="stat-card">
<p>
       Partial balances
      </p>
<strong>
       ₱0.00
      </strong>
<span>
       0 active plans
      </span>
</article>
<article class="stat-card">
<p>
       Adjustments
      </p>
<strong>
       ₱0.00
      </strong>
<span>
       This month
      </span>
</article>
</div>
<div class="panel table-panel">
<div class="table-wrap">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="admin-table-3" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="admin-table-3">
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
<select id="adminBillingDateFilter" class="table-sort-control" aria-label="Filter billing date">
<option value="all">Date: All</option>
<option value="day">Today</option>
<option value="week">This Week</option>
<option value="month">This Month</option>
<option value="custom">Custom Date...</option>
</select>
<input type="date" id="adminBillingCustomDate" class="table-sort-control" style="display:none;width:auto;" aria-label="Custom Date">
<details class="filter-popover" data-filter-for="admin-table-3">
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
            Paid
           </option>
<option>
            Partial
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
<table id="admin-table-3">
<thead>
<tr>
<th>
          Date &amp; Time
         </th>
<th>
          Patient
         </th>
<th>
          Amount
         </th>
<th>
          Status
         </th>
<th>
          Payment Method
         </th>
<th>
          Action
         </th>
</tr>
</thead>
<tbody>
<tr><td colspan="6" class="muted" style="text-align:center;padding:24px;">Loading billing records...</td></tr>
</tbody>
</table>
</div>
</div>
</section>
<section class="workspace-section" id="sales">
<div class="section-heading">
<div>
<p class="eyebrow">
       Read-only financial ledger
      </p>
<h2>
       Sales Transactions
      </h2>
<p>
       Completed payments remain immutable; refunds create balancing negative entries.
      </p>
</div>
<button class="btn" type="button">
      Export Filtered Report
     </button>
</div>
<div class="panel table-panel">
<div class="table-wrap">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="admin-table-4" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="admin-table-4">
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
<details class="filter-popover" data-filter-for="admin-table-4">
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
<div class="sales-filter-dates">
<label>
           Start date
           <input data-filter-start-date="" type="date"/>
</label>
<label>
           End date
           <input data-filter-end-date="" type="date"/>
</label>
</div>
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
<table id="admin-table-4">
<thead>
<tr>
<th>
          Date
         </th>
<th>
          Invoice No.
         </th>
<th>
          Patient Name
         </th>
<th>
          Payment Method
         </th>
<th>
          Total Amount Paid
         </th>
</tr>
</thead>
<tbody>
<tr><td colspan="5" class="muted" style="text-align:center;padding:24px;">Loading sales records...</td></tr>
</tbody>
</table>
</div>
</div>
</section>
<section class="workspace-section" id="reports">
<div class="section-heading">
<div>
<p class="eyebrow">
       Performance intelligence
      </p>
<h2>
       Reports &amp; Analytics
      </h2>
<p>
       Operational, patient, appointment and financial indicators for clinic review.
      </p>
</div>
<button class="btn secondary" type="button">
      Export report
     </button>
</div>
<div class="reports-filter-bar" style="display:flex;gap:12px;align-items:center;margin:16px 0;flex-wrap:wrap;background:white;padding:12px 16px;border-radius:10px;border:1px solid var(--edge);">
<label style="font-weight:600;font-size:13px;display:flex;align-items:center;gap:8px;">
<span>Filter Period:</span>
<select id="reportsPeriodFilter" class="table-sort-control" style="font-size:13px;padding:6px 10px;">
<option value="this_month">This Month</option>
<option value="past_3_months">Past 3 Months</option>
<option value="past_6_months">Past 6 Months</option>
<option value="this_year">This Year</option>
<option value="custom">Custom Date Range...</option>
</select>
</label>
<div id="reportsCustomDateWrap" style="display:none;gap:8px;align-items:center;">
<label style="font-size:12px;display:flex;align-items:center;gap:4px;">From: <input type="date" id="reportsFromDate" class="table-sort-control" style="font-size:12px;padding:4px 8px;"></label>
<label style="font-size:12px;display:flex;align-items:center;gap:4px;">To: <input type="date" id="reportsToDate" class="table-sort-control" style="font-size:12px;padding:4px 8px;"></label>
<button class="btn sm" id="reportsCustomApplyBtn" type="button" style="padding:4px 10px;font-size:12px;">Apply Filter</button>
</div>
</div>
<div class="metric-strip" id="adminReportsMetricStrip">
<div class="metric-box clickable-kpi-card" data-kpi-type="patients" tabindex="0" role="button" title="Click to view details for Patients Served">
<div class="kpi-card-header">
<small>Patients served</small>
<span class="kpi-click-hint"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg></span>
</div>
<strong id="kpiPatientsServed">{{ $metrics['patients_served'] ?? '—' }}</strong>
<span>this month</span>
</div>
<div class="metric-box clickable-kpi-card" data-kpi-type="completed" tabindex="0" role="button" title="Click to view details for Completed Visits">
<div class="kpi-card-header">
<small>Completed visits</small>
<span class="kpi-click-hint"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg></span>
</div>
<strong id="kpiCompletedVisits">{{ $metrics['completed_visits'] ?? '—' }}</strong>
<span>{{ $metrics['completion_rate'] ?? '0' }}% completion</span>
</div>
<div class="metric-box clickable-kpi-card" data-kpi-type="cancellation" tabindex="0" role="button" title="Click to view details for Cancellation Rate">
<div class="kpi-card-header">
<small>Cancellation rate</small>
<span class="kpi-click-hint"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg></span>
</div>
<strong id="kpiCancellationRate">{{ $metrics['cancellation_rate'] ?? '0' }}%</strong>
<span>{{ $metrics['cancelled_visits'] ?? '0' }} appointments</span>
</div>
<div class="metric-box clickable-kpi-card" data-kpi-type="revenue" tabindex="0" role="button" title="Click to view details for Total Revenue">
<div class="kpi-card-header">
<small>Total Revenue</small>
<span class="kpi-click-hint"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg></span>
</div>
<strong id="kpiTotalRevenue">₱{{ number_format($metrics['collections_today'] ?? 0, 2) }}</strong>
<span>posted payments</span>
</div>
<div class="metric-box clickable-kpi-card" data-kpi-type="new-patients" tabindex="0" role="button" title="Click to view details for New Patients">
<div class="kpi-card-header">
<small>New patients</small>
<span class="kpi-click-hint"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg></span>
</div>
<strong id="kpiNewPatients">{{ $metrics['new_patients'] ?? '—' }}</strong>
<span>this month</span>
</div>
</div>
<div class="report-grid">
<article class="panel report-chart-card monthly-visits-card">
<div class="panel-heading">
<div>
<h3>Monthly Visits</h3>
<p>Completed visits during the last six months.</p>
</div>
<span class="report-chart-caption">Visits</span>
</div>
<div class="monthly-visits-chart" data-monthly-visits-chart>
<div class="monthly-visits-scale" data-monthly-visits-scale aria-hidden="true">
<span>100</span><span>75</span><span>50</span><span>25</span><span>0</span>
</div>
<div class="bar-chart monthly-visits-plot" data-monthly-visits-plot aria-label="Completed visits by month">
<div class="monthly-visits-bar" style="--bar-height:54%"><strong>—</strong><i></i><span>May</span></div>
<div class="monthly-visits-bar" style="--bar-height:62%"><strong>—</strong><i></i><span>Jun</span></div>
<div class="monthly-visits-bar" style="--bar-height:70%"><strong>—</strong><i></i><span>Jul</span></div>
<div class="monthly-visits-bar" style="--bar-height:76%"><strong>—</strong><i></i><span>Aug</span></div>
<div class="monthly-visits-bar" style="--bar-height:84%"><strong>—</strong><i></i><span>Sep</span></div>
<div class="monthly-visits-bar" style="--bar-height:92%"><strong>—</strong><i></i><span>Oct</span></div>
</div>
</div>
</article>
<article class="panel report-chart-card appointment-outcomes-card">
<div class="panel-heading">
<div>
<h3>Appointment Outcomes</h3>
<p>Current-month schedule disposition.</p>
</div>
<span class="report-chart-caption">Current period</span>
</div>
<div class="appointment-outcomes-chart" data-appointment-outcomes>
<div class="outcomes-donut-wrap">
<div class="outcomes-donut" data-outcomes-donut>
<div><strong data-outcomes-total>428</strong><span>Total</span></div>
</div>
</div>
<div class="outcomes-breakdown">
<div class="outcome-row" data-outcome="completed">
<div class="outcome-label"><span><i class="outcome-dot completed"></i>Completed</span><strong>386</strong></div>
<div class="outcome-track"><i style="width:90.2%"></i></div><small>90.2%</small>
</div>
<div class="outcome-row" data-outcome="cancelled">
<div class="outcome-label"><span><i class="outcome-dot cancelled"></i>Cancelled</span><strong>23</strong></div>
<div class="outcome-track"><i style="width:5.4%"></i></div><small>5.4%</small>
</div>
<div class="outcome-row" data-outcome="no-show">
<div class="outcome-label"><span><i class="outcome-dot no-show"></i>No-show</span><strong>19</strong></div>
<div class="outcome-track"><i style="width:4.4%"></i></div><small>4.4%</small>
</div>
</div>
</div>
</article>
<article class="panel table-wrap service-utilization-panel">
<div class="table-toolbar">
<h3>
        Service Utilization
       </h3>
<div class="table-toolbar-actions">
<div class="table-scroll-buttons" style="display:inline-flex;gap:4px;align-items:center;margin-right:8px;">
<button aria-label="Scroll table left" class="btn secondary sm" id="serviceScrollLeft" style="min-width:32px;padding:4px 8px;font-size:16px;line-height:1;" type="button">‹</button>
<button aria-label="Scroll table right" class="btn secondary sm" id="serviceScrollRight" style="min-width:32px;padding:4px 8px;font-size:16px;line-height:1;" type="button">›</button>
</div>
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="admin-table-5" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="admin-table-5">
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
<details class="filter-popover" data-filter-for="admin-table-5">
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
</div>
</div>
<div class="service-table-scroll-wrap" id="serviceUtilizationTableWrap" style="overflow-x:auto;-webkit-overflow-scrolling:touch;width:100%;">
<table id="admin-table-5" style="min-width:480px;">
<thead>
<tr>
<th>
          Service
         </th>
<th>
          Cases
         </th>
<th>
          Share
         </th>
</tr>
</thead>
<tbody>
<tr><td colspan="3" class="muted" style="text-align:center;padding:24px;">Loading service utilization...</td></tr>
</tbody>
</table>
</div>
</article>
</div>
<div class="report-expansion-grid">
<article class="panel report-visual-card report-wide" id="cardCollectionsTrend">
<div class="panel-heading">
<div>
<h3>
         Collections Trend
        </h3>
<p>
         Posted collections across the last six months.
        </p>
</div>
<span class="chart-total" id="adminCollectionsTrendTotal">
        ₱{{ number_format($metrics['collections_today'] ?? 0, 2) }}
       </span>
</div>
<div class="svg-chart-wrap compact" id="adminCollectionsTrendWrap">
<div class="chart-loading-placeholder muted" style="display:flex;align-items:center;justify-content:center;height:180px;">Loading collections trend...</div>
</div>
</article>
<article class="panel report-visual-card" id="cardPaymentMethodMix">
<div class="panel-heading">
<div>
<h3>
         Payment Method Mix
        </h3>
<p>
         Share of posted payments for the selected period.
        </p>
</div>
</div>
<div class="donut-layout">
<div class="donut-chart payment-donut" id="adminPaymentMethodDonut">
<div>
<strong id="adminPaymentDonutTotal">
          ₱{{ number_format($metrics['collections_today'] ?? 0, 0) }}
         </strong>
<span>
          collected
         </span>
</div>
</div>
<div class="chart-legend-list" id="adminPaymentMethodLegend">
<span>
<i class="dot green"></i>
         Cash
         <strong>—</strong>
</span>
<span>
<i class="dot blue"></i>
         GCash
         <strong>—</strong>
</span>
<span>
<i class="dot violet"></i>
         Card
         <strong>—</strong>
</span>
</div>
</div>
</article>
<article class="panel report-visual-card" id="cardTreatmentPlanAcceptance">
<div class="panel-heading">
<div>
<h3>
         Treatment Plan Acceptance
        </h3>
<p>
         Accepted versus pending recommendations.
        </p>
</div>
</div>
<div class="big-percentage">
<strong id="adminTreatmentAcceptanceRate">
        —
       </strong>
<span id="adminTreatmentAcceptancePeriod">
        rate in period
       </span>
</div>
<div class="stacked-progress">
<i id="adminTreatmentAcceptanceBar" style="width:0%">
</i>
</div>
<div class="mini-stats">
<span>
<strong id="adminTreatmentAcceptedCount">
         0
        </strong>
        accepted
       </span>
<span>
<strong id="adminTreatmentPendingCount">
         0
        </strong>
        pending
       </span>
</div>
</article>
<article class="panel report-visual-card report-wide" id="cardDentistWorkload">
<div class="panel-heading">
<div>
<h3>
         Dentist Workload
        </h3>
<p>
         Completed clinical cases for the selected period.
        </p>
</div>
</div>
<div class="workload-bars" id="adminDentistWorkloadBars">
@forelse($dentists as $dentist)
<div>
<span>
 {{ $dentist->name }}
</span>
<div>
<i style="width:{{ 60 + (($loop->index * 13) % 35) }}%">
</i>
</div>
<strong>
 {{ $appointments->where('dentist_id', $dentist->id)->count() }}
</strong>
</div>
@empty
<div>
<span>No dentists found</span>
</div>
@endforelse
</div>
</article>
</div>
</section>
<section class="workspace-section" id="activity">
<div class="section-heading">
<div>
<p class="eyebrow">
       System monitoring
      </p>
<h2>
       Activity Logs
      </h2>
<p>
       Relevant system activities with the responsible user, date, and time.
      </p>
</div>
</div>
<div class="panel table-wrap">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="admin-table-6" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="admin-table-6">
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
<select id="adminActivityDateFilter" class="table-sort-control" aria-label="Filter activity date">
<option value="all">Date: All</option>
<option value="today">Today</option>
<option value="this_week">This Week</option>
<option value="this_month">This Month</option>
<option value="custom">Custom Date...</option>
</select>
<input type="date" id="adminActivityCustomDate" class="table-sort-control" style="display:none;width:auto;" aria-label="Custom Date">
<details class="filter-popover" data-filter-for="admin-table-6">
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
<table id="admin-table-6">
<thead>
<tr>
<th>
         Date &amp; Time
        </th>
<th>
         User
        </th>
<th>
         Module
        </th>
<th>
         Activity
        </th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="4" class="muted">
         Loading activity log...
        </td>
</tr>
</tbody>
</table>
</div>
</section>
<section class="workspace-section" id="accounts">
<div class="section-heading">
<div>
<p class="eyebrow">
       Access control
      </p>
<h2>
       Accounts
      </h2>
<p>
       Manage clinic staff accounts and account status.
      </p>
</div>
<button class="btn" onclick="document.getElementById('accountModal').showModal()" type="button">
      Create Account
     </button>
</div>
<div class="panel table-wrap">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="admin-table-7" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="admin-table-7">
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
<details class="filter-popover" data-filter-for="admin-table-7">
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
           Active
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
<table id="admin-table-7">
<thead>
<tr>
<th>
         Name
        </th>
<th>
         Role
        </th>
<th>
         Email
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
@php
  $allAccounts = \App\Models\User::whereIn('role', ['admin', 'dentist', 'front_desk'])->orderBy('name')->get();
@endphp
@forelse($allAccounts as $acc)
<tr data-user-id="{{ $acc->id }}">
  <td><strong>{{ $acc->name }}</strong></td>
  <td>{{ $acc->role === 'admin' ? 'Admin / Head Dentist' : ($acc->role === 'dentist' ? 'Dentist' : 'Front Desk') }}</td>
  <td>{{ $acc->email }}</td>
  <td><span class="badge {{ $acc->status === 'Inactive' ? 'danger' : 'success' }}">{{ $acc->status ?? 'Active' }}</span></td>
  <td><button class="table-action account-view-btn" data-user-id="{{ $acc->id }}" type="button">View</button></td>
</tr>
@empty
<tr>
<td colspan="5" class="muted" style="text-align:center;padding:24px;">
No staff accounts found.
</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</section>
<section class="workspace-section" id="settings">
<div class="section-heading">
<div>
<p class="eyebrow">
       Clinic configuration
      </p>
<h2>
       Settings
      </h2>
<p>
       Clinic identity and operating-hour information.
      </p>
</div>
</div>
<form class="panel form-grid">
<label>
      Clinic Name
      <input value="Cerillo Dental Clinic"/>
</label>
<label>
      Contact Number
      <input value="(02) 8123 4567"/>
</label>
<label>
      Opening Time
      <input type="time" value="08:00"/>
</label>
<label>
      Closing Time
      <input type="time" value="17:00"/>
</label>
<label class="span-2">
      Clinic Address
      <textarea rows="3">Cerillo Dental Clinic</textarea>
</label>
<div class="form-actions span-2">
<button class="btn" type="submit">
       Save settings
      </button>
</div>
</form>
<article class="panel">
<div class="panel-heading">
<div>
<h3>
        Accessibility
       </h3>
<p>
        Personalize readability, motion and interaction comfort.
       </p>
</div>
</div>
<div class="access-grid">
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
         Increase interface text size.
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
         Increase foreground/background contrast.
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
         Limit non-essential animation.
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
<section class="workspace-section" id="dentist-appointments">
<div class="section-heading">
<div>
<p class="eyebrow">Head Dentist schedule</p>
<h2>Appointments</h2>
<p>Appointments assigned to head dentist by Front Desk. Availability is managed from Calendar.</p>
</div>
</div>
@php
  $headDentistAppts = $appointments->where('dentist_id', auth()->id());
  $hdToday = $headDentistAppts->filter(fn($a) => $a->starts_at && $a->starts_at->isToday());
  $hdUpcoming = $headDentistAppts->filter(fn($a) => $a->starts_at && $a->starts_at->isFuture() && $a->starts_at <= now()->addDays(7));
  $hdCompleted = $hdToday->where('status', 'Completed');
  $hdCancelled = $hdToday->whereIn('status', ['Cancelled', 'No-Show']);
@endphp
<div class="stats-grid">
<article class="stat-card" data-dashboard-metric="appointments_today"><p>Today's Appointments</p><strong>{{ $hdToday->count() }}</strong><span>Assigned to you</span></article>
<article class="stat-card" data-dashboard-metric="upcoming_appointments"><p>Upcoming</p><strong>{{ $hdUpcoming->count() }}</strong><span>Next 7 days</span></article>
<article class="stat-card" data-dashboard-metric="completed_today"><p>Completed</p><strong>{{ $hdCompleted->count() }}</strong><span>Completed visits today</span></article>
<article class="stat-card" data-dashboard-metric="cancelled_today"><p>Cancelled / No-show</p><strong>{{ $hdCancelled->count() }}</strong><span>Today's exceptions</span></article>
</div>
<div class="panel table-panel">
<div class="table-wrap">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="dentist-table-2" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="dentist-table-2">
<option value="">Sort: Default</option>
<option value="asc">A–Z / Oldest first</option>
<option value="desc">Z–A / Newest first</option>
</select>
<details class="filter-popover" data-filter-for="dentist-table-2">
<summary aria-label="Open table filters" class="filter-icon-trigger" title="Filter table">
<svg aria-hidden="true" viewbox="0 0 24 24">
<path d="M4 6h16M7 12h10M10 18h4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.8"></path>
</svg>
</summary>
<div class="filter-popover-panel">
<div class="filter-popover-heading">
<strong>Filter &amp; refine</strong>
<small>Narrow the records in this table.</small>
</div>
<label>
Search rows
<input data-filter-query="" placeholder="Type patient, status..." type="search"/>
</label>
<label>
Quick status
<select data-filter-status="">
<option value="">All statuses</option>
<option>Completed</option>
<option>Checked In</option>
<option>In Progress</option>
<option>Pending</option>
<option>Cancelled</option>
</select>
</label>
<div class="filter-popover-actions">
<button class="btn secondary sm" data-filter-reset="" type="button">Reset</button>
<button class="btn sm" data-filter-apply="" type="button">Apply</button>
</div>
</div>
</details>
</div>
<table id="dentist-table-2">
<thead>
<tr>
<th>Name</th>
<th>Procedure</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@forelse($headDentistAppts as $appt)
@php
  $patientName = $appt->patient?->name ?? $appt->guest_name ?? 'Guest patient';
  $serviceName = $appt->service?->name ?? '—';
  $dateStr = $appt->starts_at ? $appt->starts_at->format('M d, Y') : '—';
  $timeStr = $appt->starts_at ? $appt->starts_at->format('g:i A') : '—';
  $st = strtolower($appt->status ?? 'pending');
  $badgeClass = str_contains($st, 'complete') ? 'completed'
    : (str_contains($st, 'progress') ? 'in-progress'
    : (str_contains($st, 'check') ? 'checked-in'
    : (str_contains($st, 'cancel') ? 'cancelled'
    : (str_contains($st, 'no-show') ? 'no-show' : 'pending'))));
@endphp
<tr data-appointment-id="{{ $appt->id }}" data-starts-at="{{ $appt->starts_at?->toIso8601String() ?? '' }}">
  <td>{{ $patientName }}</td>
  <td>{{ $serviceName }}</td>
  <td>{{ $dateStr }}</td>
  <td>{{ $timeStr }}</td>
  <td><span class="status {{ $badgeClass }}">{{ $appt->status }}</span></td>
  <td><button class="table-action appointment-view" data-appointment-id="{{ $appt->id }}" type="button">View</button></td>
</tr>
@empty
<tr><td colspan="6" class="muted" style="text-align:center;padding:24px;">No appointments assigned to head dentist yet.</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>
</section>
<section class="workspace-section" id="dentist-patients">
<div class="section-heading">
<div>
<p class="eyebrow">Clinical files</p>
<h2>Patient Records</h2>
<p>Clinical patient records appointed to head dentist with clinical updates and treatment history.</p>
</div>
<button class="btn secondary" data-export-current-patient-pdf="" type="button">Export patient record PDF</button>
</div>
@php
  $headDentistPatients = $patients->filter(fn($p) => $p->appointments->where('dentist_id', auth()->id())->isNotEmpty());
@endphp
<div class="stats-grid">
<article class="stat-card"><p>Assigned Today</p><strong>{{ $hdToday->count() }}</strong><span>Current schedule</span></article>
<article class="stat-card"><p>Checked In</p><strong>{{ $hdToday->where('status', 'Checked In')->count() }}</strong><span>Ready for care</span></article>
<article class="stat-card"><p>Clinical Updates</p><strong>{{ $headDentistAppts->whereIn('status', ['In Progress', 'Completed'])->count() }}</strong><span>Documented</span></article>
<article class="stat-card"><p>Follow-up Needed</p><strong>{{ $headDentistPatients->where('recall_due', true)->count() }}</strong><span>After today's visits</span></article>
</div>
<div class="panel table-panel">
<div class="table-wrap">
<div class="table-filter-dock">
<select aria-label="Patient segment" class="patient-segment-control" data-patient-segment-for="dentist-table-3"><option value="">All segments</option><option value="Orthodontics">Orthodontics</option><option value="Preventive">Preventive</option><option value="Restorative">Restorative</option><option value="Endodontics">Endodontics</option><option value="Oral Surgery">Oral Surgery</option><option value="General">General</option></select>
<select aria-label="Procedure filter" class="patient-procedure-control" data-patient-procedure-for="dentist-table-3"><option value="">All procedures</option><option value="Oral Prophylaxis">Oral Prophylaxis</option><option value="Composite Restoration">Composite Restoration</option><option value="Root Canal Therapy">Root Canal Therapy</option><option value="Orthodontic Braces">Orthodontic Braces</option><option value="Dental Checkup">Dental Checkup</option></select>
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="dentist-table-3" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="dentist-table-3">
<option value="">Sort: Default</option>
<option value="asc">A–Z / Oldest first</option>
<option value="desc">Z–A / Newest first</option>
</select>
<details class="filter-popover" data-filter-for="dentist-table-3">
<summary aria-label="Open table filters" class="filter-icon-trigger" title="Filter table">
<svg aria-hidden="true" viewbox="0 0 24 24"><path d="M4 6h16M7 12h10M10 18h4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.8"></path></svg>
</summary>
<div class="filter-popover-panel">
<div class="filter-popover-heading">
<strong>Filter &amp; refine</strong>
<small>Narrow the records in this table.</small>
</div>
<label>
Search rows
<input data-filter-query="" placeholder="Type patient, dentist, status..." type="search"/>
</label>
<div class="filter-popover-actions">
<button class="btn secondary sm" data-filter-reset="" type="button">Reset</button>
<button class="btn sm" data-filter-apply="" type="button">Apply</button>
</div>
</div>
</details>
</div>
<table id="dentist-table-3">
<thead>
<tr>
<th>Patient</th>
<th>Age</th>
<th>Phone</th>
<th>Allergies</th>
<th>Appointment</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@forelse($headDentistPatients as $p)
@php
  $appointment = $p->appointments->where('dentist_id', auth()->id())->sortByDesc('starts_at')->first();
  $rawDob = $p->date_of_birth ? $p->date_of_birth->format('Y-m-d') : '';
  $ageVal = $p->date_of_birth ? $p->date_of_birth->age : null;
  $age = $rawDob ? ($rawDob . ' || ' . ($ageVal !== null && $ageVal >= 0 ? $ageVal : '—')) : '—';
  $allergies = $p->allergies ?: 'None reported';
  $patientCode = $p->formatted_patient_code ?? $p->patient_code ?? '';
  $dateStr = $appointment?->starts_at ? $appointment->starts_at->format('M d, Y · g:i A') : '—';
  $serviceName = $appointment?->service?->name ?? 'Dental Visit';
@endphp
<tr data-procedure="{{ $serviceName }}" data-segment="Restorative">
  <td><strong>{{ $p->name }}</strong>@if($patientCode)<small class="table-subtext">{{ $patientCode }}</small>@endif</td>
  <td>
    <div><strong>{{ $ageVal !== null && $ageVal >= 0 ? $ageVal . ' yrs' : '—' }}</strong></div>
    @if($rawDob)<small class="table-subtext">{{ $rawDob }}</small>@endif
  </td>
  <td>{{ $p->formatted_phone ?? $p->phone ?? '—' }}</td>
  <td>{{ $allergies }}</td>
  <td>
    <div><strong>{{ $dateStr }}</strong></div>
    <small class="table-subtext">{{ $serviceName }}</small>
  </td>
  <td><span class="status success">Completed</span></td>
  <td style="text-align: right;"><button class="table-action" data-live-patient-id="{{ $p->id }}" type="button">View / Update</button></td>
</tr>
@empty
<tr><td colspan="7" class="muted" style="text-align:center;padding:24px;">No completed patient records handled by head dentist yet.</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>
</section>
</main>
<!-- Data Backup and Recovery Modal -->
<dialog aria-label="Data Backup and Recovery" class="modal modal-xl backup-recovery-modal" id="backupRecoveryModal">
  <div class="modal-shell">
    <div class="modal-head">
      <div>
        <p class="eyebrow">Data Protection &amp; Disaster Recovery</p>
        <h3>Clinic Data Backup &amp; Recovery</h3>
        <p>Create, maintain, and restore full backup copies of patient records, dental charts, appointments, and financial transactions.</p>
      </div>
      <button aria-label="Close Backup and Recovery modal" class="icon-btn" onclick="document.getElementById('backupRecoveryModal').close()" type="button">×</button>
    </div>

    <div class="modal-scroll" style="padding: 24px;">
      <!-- System Backup Overview KPIs -->
      <div class="backup-kpi-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
        <div class="card" style="padding: 16px; border: 1px solid var(--line, #e2e8f0); border-radius: 12px; background: #f8fafc;">
          <small class="muted" style="text-transform: uppercase; font-size: 11px; font-weight: 700; letter-spacing: 0.05em; color: #64748b;">Protected Records</small>
          <div style="font-size: 24px; font-weight: 800; color: #0f172a; margin-top: 4px;" id="backupTotalRecordsCount">-</div>
          <span style="font-size: 12px; color: #16a34a; font-weight: 600;">● Active database records</span>
        </div>
        <div class="card" style="padding: 16px; border: 1px solid var(--line, #e2e8f0); border-radius: 12px; background: #f8fafc;">
          <small class="muted" style="text-transform: uppercase; font-size: 11px; font-weight: 700; letter-spacing: 0.05em; color: #64748b;">Stored Backups</small>
          <div style="font-size: 24px; font-weight: 800; color: #0f172a; margin-top: 4px;" id="backupSnapshotsCount">-</div>
          <span style="font-size: 12px; color: #64748b;" id="backupStorageSize">0 KB disk usage</span>
        </div>
        <div class="card" style="padding: 16px; border: 1px solid var(--line, #e2e8f0); border-radius: 12px; background: #f8fafc;">
          <small class="muted" style="text-transform: uppercase; font-size: 11px; font-weight: 700; letter-spacing: 0.05em; color: #64748b;">Latest Snapshot</small>
          <div style="font-size: 15px; font-weight: 700; color: #0f172a; margin-top: 8px;" id="backupLatestDate">Never</div>
          <span style="font-size: 12px; color: #64748b;" id="backupLatestBy">-</span>
        </div>
      </div>

      <!-- Action Panel: Create Backup & Upload File to Restore -->
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px; margin-bottom: 28px;">
        <!-- Card 1: Create Snapshot -->
        <div class="card" style="padding: 20px; border: 1px solid #cbd5e1; border-radius: 14px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
          <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
            <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                <polyline points="7 3 7 8 15 8"></polyline>
              </svg>
            </div>
            <div>
              <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">Create New Backup</h4>
              <p style="margin: 0; font-size: 12px; color: #64748b;">Capture a point-in-time snapshot of all clinic records</p>
            </div>
          </div>
          <form id="createBackupForm">
            <div style="margin-bottom: 14px;">
              <label for="backupNotesInput" style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Backup Description / Notes (Optional)</label>
              <input type="text" id="backupNotesInput" name="notes" placeholder="e.g. Regular weekly snapshot, Pre-maintenance archive..." style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" maxlength="255">
            </div>
            <button type="submit" class="btn primary sm" id="createBackupSubmitBtn" style="display: inline-flex; align-items: center; gap: 8px; font-weight: 600;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
              <span>Create Backup Snapshot</span>
            </button>
          </form>
        </div>

        <!-- Card 2: Restore from Snapshot or File -->
        <div class="card" style="padding: 20px; border: 1px solid #cbd5e1; border-radius: 14px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
          <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
            <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
                <path d="M21 3v5h-5"></path>
                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
                <path d="M8 16H3v5"></path>
              </svg>
            </div>
            <div>
              <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">Restore from Saved Snapshot</h4>
              <p style="margin: 0; font-size: 12px; color: #64748b;">Pick a snapshot below, or click "Restore" directly on any row in the list</p>
            </div>
          </div>

          <form id="quickSnapshotRestoreForm">
            <div style="margin-bottom: 12px;">
              <label for="snapshotSelectDropdown" style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Select Saved Snapshot to Restore</label>
              <select id="snapshotSelectDropdown" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;">
                <option value="">-- Choose a snapshot from the list below --</option>
              </select>
            </div>
            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
              <button type="submit" class="btn primary sm" id="quickSnapshotRestoreBtn" style="display: inline-flex; align-items: center; gap: 8px; font-weight: 700; background: #2563eb; color: #ffffff;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
                  <path d="M21 3v5h-5"></path>
                  <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
                  <path d="M8 16H3v5"></path>
                </svg>
                <span>Restore Chosen Snapshot</span>
              </button>
              <button type="button" class="btn secondary sm" id="toggleUploadFormBtn" style="font-size: 12px;">
                Upload External File Instead
              </button>
            </div>
          </form>

          <form id="uploadRestoreBackupForm" style="display: none; margin-top: 14px; padding-top: 14px; border-top: 1px dashed #cbd5e1;">
            <div style="margin-bottom: 10px;">
              <label for="backupFileInput" style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Select Backup JSON File</label>
              <input type="file" id="backupFileInput" name="backup_file" accept=".json,application/json" style="width: 100%; font-size: 12px;">
            </div>
            <button type="submit" class="btn secondary sm" id="uploadRestoreSubmitBtn" style="display: inline-flex; align-items: center; gap: 8px; font-weight: 600; color: #b91c1c; border-color: #fca5a5;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
              </svg>
              <span>Upload &amp; Restore</span>
            </button>
          </form>
        </div>
      </div>

      <!-- Backup Archives Table -->
      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
        <div>
          <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">Maintained Backup Archives</h4>
          <span style="font-size: 12px; color: #64748b;">Click the blue <strong>"Restore"</strong> button on any snapshot to recover clinic records</span>
        </div>
        <button type="button" class="btn secondary sm" id="refreshBackupsListBtn" style="padding: 4px 10px; font-size: 12px;">
          Refresh List
        </button>
      </div>

      <div class="table-wrap" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow-x: auto !important; overflow-y: hidden; background: #fff; width: 100%;">
        <table class="table" id="backupsListTable" style="margin: 0; font-size: 13px; width: 100%; min-width: 720px; table-layout: fixed;">
          <colgroup>
            <col style="width: 40%;">
            <col style="width: 22%;">
            <col style="width: 11%;">
            <col style="width: 9%;">
            <col style="width: 18%;">
          </colgroup>
          <thead style="background: #f8fafc;">
            <tr>
              <th style="padding: 10px 14px; text-align: left;">Snapshot &amp; Description</th>
              <th style="padding: 10px 14px; text-align: left;">Created At</th>
              <th style="padding: 10px 14px; text-align: left;">Records</th>
              <th style="padding: 10px 14px; text-align: left;">Size</th>
              <th style="padding: 10px 14px; text-align: right;">Actions</th>
            </tr>
          </thead>
          <tbody id="backupsTableBody">
            <tr>
              <td colspan="5" style="text-align: center; padding: 24px; color: #64748b;">
                Loading backup copies...
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div style="margin-top: 16px; padding: 12px 16px; border-radius: 8px; background: #f0fdf4; border: 1px solid #bbf7d0; font-size: 12px; color: #166534; display: flex; align-items: center; gap: 8px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <path d="M12 16v-4"></path>
          <path d="M12 8h.01"></path>
        </svg>
        <span><strong>Automated Safety Rollback:</strong> Prior to any restoration process, the system automatically takes a pre-restore safety snapshot of the active clinic database so you can revert anytime.</span>
      </div>
    </div>

    <div class="dialog-footer" style="padding: 16px 24px; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end;">
      <button class="btn secondary" onclick="document.getElementById('backupRecoveryModal').close()" type="button">Close</button>
    </div>
  </div>
</dialog>

<!-- Confirmation Modal for Restore -->
<dialog aria-label="Confirm Clinic Records Restore" class="modal modal-md" id="backupRestoreConfirmModal" style="max-width: 500px;">
  <div class="modal-shell">
    <div class="modal-head" style="border-bottom: 1px solid #fee2e2; background: #fff5f5;">
      <div>
        <p class="eyebrow" style="color: #dc2626;">Restoration Safety Confirmation</p>
        <h3 style="color: #991b1b;">Restore Clinic Records?</h3>
      </div>
      <button aria-label="Cancel restore" class="icon-btn" onclick="document.getElementById('backupRestoreConfirmModal').close()" type="button">×</button>
    </div>
    <div class="modal-scroll" style="padding: 20px;">
      <p style="font-size: 14px; color: #1e293b; margin-top: 0;">
        You are about to restore clinic records from:
      </p>
      <div style="padding: 10px 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; font-family: monospace; font-size: 13px; font-weight: 600; color: #0f172a; margin-bottom: 14px; word-break: break-all;" id="restoreTargetFilenameText">
        backup_file.json
      </div>
      <div style="background: #fffbeb; border: 1px solid #fef3c7; border-radius: 8px; padding: 12px; font-size: 12px; color: #92400e; margin-bottom: 16px;">
        <strong style="display: block; margin-bottom: 4px;">⚠️ Important Safety Notice:</strong>
        This action will replace existing live data with the records from the chosen snapshot. The system will automatically take a pre-restore safety backup beforehand to prevent accidental loss.
      </div>
      <div style="display: flex; gap: 10px; justify-content: flex-end;">
        <button type="button" class="btn secondary" onclick="document.getElementById('backupRestoreConfirmModal').close()">Cancel</button>
        <button type="button" class="btn danger" id="executeRestoreConfirmedBtn" style="display: inline-flex; align-items: center; gap: 8px; background: #dc2626; color: #fff; border: 0; padding: 8px 16px; border-radius: 8px; font-weight: 600; cursor: pointer;">
          <span>Yes, Restore Clinic Records</span>
        </button>
      </div>
    </div>
  </div>
</dialog>

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
<form action="{{ route('logout') }}" method="POST">
@csrf
<button class="btn danger" type="submit">
      Sign out
     </button>
</form>
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
        window.dispatchEvent(new CustomEvent("cerillo:sectionchange", {
          detail: { sectionId: sectionId }
        }));

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
<dialog aria-label="Patient Record" class="modal modal-xl clinical-record-modal" data-patient-id="" data-patient-name="" id="patientViewModal">
<div class="modal-shell patient-file-shell">
<header class="modal-header patient-file-header">
<div class="patient-identity-row">
<div class="avatar avatar-lg" data-pr-avatar>
       --
      </div>
<div>
<p class="eyebrow">
        Patient Record
       </p>
<h3 data-pr-name>
        —
       </h3>
<div class="patient-inline-data">
<span data-pr-code>
         ID: —
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
<button class="record-tab" data-record-tab="medical" type="button">
      Medical Record
     </button>
<button class="record-tab" data-record-tab="chart" type="button">
      Dental Chart
     </button>
<button class="record-tab" data-record-tab="pxray" type="button">
      X-rays
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
          —
         </span>
</div>
<dl class="patient-detail-grid">
<div>
<dt>
           Date of birth
          </dt>
<dd data-pr-dob>
           —
          </dd>
</div>
<div>
<dt>
           Age
          </dt>
<dd data-pr-age>
           —
          </dd>
</div>
<div>
<dt>
           Sex
          </dt>
<dd data-pr-gender>
           —
          </dd>
</div>
<div>
<dt>
           Mobile
          </dt>
<dd data-pr-phone>
           —
          </dd>
</div>
<div>
<dt>
           Email
          </dt>
<dd data-pr-email>
           —
          </dd>
</div>
<div class="wide">
<dt>
           Address
          </dt>
<dd data-pr-address>
           —
          </dd>
</div>
<div>
<dt>
           Insurance / HMO
          </dt>
<dd data-pr-insurance>
           —
          </dd>
</div>
<div>
<dt>
           Preferred contact
          </dt>
<dd data-pr-contact>
           —
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
           —
          </dd>
</div>
<div>
<dt>
           Preferred dentist
          </dt>
<dd data-pr-dentist>
           —
          </dd>
</div>
<div>
<dt>
           Last visit
          </dt>
<dd data-pr-last-visit>
           —
          </dd>
</div>
<div>
<dt>
           Next appointment
          </dt>
<dd data-pr-next-appt>
           —
          </dd>
</div>
<div>
<dt>
           Last radiograph
          </dt>
<dd data-pr-last-xray>
           —
          </dd>
</div>
<div>
<dt>
           Recall interval
          </dt>
<dd data-pr-recall>
           —
          </dd>
</div>
<div>
<dt>
           Dental anxiety
          </dt>
<dd data-pr-anxiety>
           —
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
          None
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
          None
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
          No known systemic conditions
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
          —
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
<div class="muted" style="padding: 1.5rem; text-align: center;">No completed visits recorded for this patient.</div>
</div>
</section>
<section class="record-tab-panel" data-record-panel="medical">
<div class="medical-record-intro">
<div>
<p class="eyebrow">
         Medical safety profile
        </p>
<h4>
         Health History &amp; Treatment Considerations
        </h4>
<p data-pr-medical-intro="">
         Review medical conditions, medications, allergies and risk factors before treatment.
        </p>
</div>
<div class="medical-risk-badges">
<span data-pr-asa-badge="">
         ASA I
        </span>
<span data-pr-bp-badge="">
         BP normal
        </span>
</div>
</div>
<div class="medical-record-grid">
<article class="info-card medical-record-card">
<div class="medical-card-title">
<span>
          01
         </span>
<div>
<h4>
           Medical Conditions
          </h4>
<p>
           Current and relevant past history.
          </p>
</div>
</div>
<dl class="detail-list">
<div>
<dt>
           Hypertension
          </dt>
<dd data-pr-mc-hypertension="">
           No
          </dd>
</div>
<div>
<dt>
           Diabetes
          </dt>
<dd data-pr-mc-diabetes="">
           No
          </dd>
</div>
<div>
<dt>
           Cardiovascular disease
          </dt>
<dd data-pr-mc-cardio="">
           No known condition
          </dd>
</div>
<div>
<dt>
           Bleeding disorder
          </dt>
<dd data-pr-mc-bleeding="">
           No
          </dd>
</div>
<div>
<dt>
           Respiratory condition
          </dt>
<dd data-pr-mc-respiratory="">
           No
          </dd>
</div>
<div>
<dt>
           Pregnancy
          </dt>
<dd data-pr-mc-pregnancy="">
           No
          </dd>
</div>
<div>
<dt>
           Smoking / tobacco
          </dt>
<dd data-pr-mc-smoking="">
           Never
          </dd>
</div>
</dl>
</article>
<article class="info-card medical-record-card">
<div class="medical-card-title">
<span>
          02
         </span>
<div>
<h4>
           Allergies &amp; Medications
          </h4>
<p>
           Medication and sensitivity review.
          </p>
</div>
</div>
<dl class="detail-list">
<div>
<dt>
           Drug allergy
          </dt>
<dd data-pr-med-drug="">
           None reported
          </dd>
</div>
<div>
<dt>
           Food / latex allergy
          </dt>
<dd data-pr-med-food="">
           None reported
          </dd>
</div>
<div>
<dt>
           Current medication
          </dt>
<dd data-pr-med-current="">
           None
          </dd>
</div>
<div>
<dt>
           Supplements
          </dt>
<dd data-pr-med-supplements="">
           None reported
          </dd>
</div>
<div>
<dt>
           Anticoagulants
          </dt>
<dd data-pr-med-anticoagulant="">
           None
          </dd>
</div>
<div>
<dt>
           Previous surgery
          </dt>
<dd data-pr-med-surgery="">
           None reported
          </dd>
</div>
</dl>
</article>
<article class="info-card medical-record-card">
<div class="medical-card-title">
<span>
          03
         </span>
<div>
<h4>
           Vitals &amp; Clinical Risk
          </h4>
<p>
           Latest measurements relevant to dental care.
          </p>
</div>
</div>
<dl class="detail-list">
<div>
<dt>
           Blood pressure
          </dt>
<dd data-pr-vr-bp="">
           120 / 80 mmHg
          </dd>
</div>
<div>
<dt>
           Pulse
          </dt>
<dd data-pr-vr-pulse="">
           72 bpm
          </dd>
</div>
<div>
<dt>
           ASA classification
          </dt>
<dd data-pr-vr-asa="">
           ASA I
          </dd>
</div>
<div>
<dt>
           Antibiotic prophylaxis
          </dt>
<dd data-pr-vr-prophylaxis="">
           Not indicated
          </dd>
</div>
<div>
<dt>
           Local anesthetic alert
          </dt>
<dd data-pr-vr-anesthetic="">
           None
          </dd>
</div>
<div>
<dt>
           Primary physician
          </dt>
<dd data-pr-vr-physician="">
           Not specified
          </dd>
</div>
</dl>
</article>
<article class="info-card medical-record-card">
<div class="medical-card-title">
<span>
          04
         </span>
<div>
<h4>
           Dental &amp; Health History
          </h4>
<p>
           Context that may influence treatment planning.
          </p>
</div>
</div>
<dl class="detail-list">
<div>
<dt>
           Last dental examination
          </dt>
<dd data-pr-hh-last-exam="">
           Recent
          </dd>
</div>
<div>
<dt>
           Last radiographs
          </dt>
<dd data-pr-hh-last-xray="">
           None
          </dd>
</div>
<div>
<dt>
           Prior recommended treatment
          </dt>
<dd data-pr-hh-prior-treatment="">
           Routine Care
          </dd>
</div>
<div>
<dt>
           Hospitalization
          </dt>
<dd data-pr-hh-hospitalization="">
           None reported
          </dd>
</div>
<div>
<dt>
           Dental anxiety
          </dt>
<dd data-pr-hh-anxiety="">
           Low
          </dd>
</div>
<div>
<dt>
           History verified by
          </dt>
<dd data-pr-hh-verified-by="">
           Attending Dentist
          </dd>
</div>
</dl>
</article>
</div>
<article class="medical-clinical-note">
<div>
<span class="alert-indicator amber">
</span>
<div>
<strong>
          Treatment consideration
         </strong>
<p data-pr-treatment-consideration="">
          Review medical history and verify vital signs before clinical procedures.
         </p>
</div>
</div>
<small data-pr-clinical-note-meta="">
        Clinical note · verified
       </small>
</article>
</section>
<section class="record-tab-panel premium-dental-chart" data-record-panel="chart">
<div class="patient-appointment-bar" data-patient-appointment-bar hidden style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:12px 16px;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;">
  <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
    <div style="width:36px;height:36px;border-radius:8px;background:#059669;color:#fff;display:flex;align-items:center;justify-content:center;font-size:18px;">🦷</div>
    <div>
      <div style="display:flex;align-items:center;gap:8px;">
        <span style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:#047857;">Active Appointment Assessment</span>
        <span class="status warning" data-pa-status-badge style="font-size:11px;padding:2px 8px;">Pending</span>
      </div>
      <div style="font-size:13px;color:#1e293b;margin-top:2px;">
        <strong data-pa-procedure>Procedure</strong> · <span data-pa-datetime>Date &amp; Time</span>
      </div>
    </div>
  </div>
  <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
    <span class="small muted" data-pa-message role="status" style="font-size:12px;"></span>
    <button class="btn btn-start-assessment" data-pa-start-btn type="button" style="display:inline-flex;align-items:center;gap:6px;">
      <span class="btn-icon">▶</span>
      <span>Start Assessment</span>
    </button>
    <button class="btn" data-pa-save-btn type="button" hidden style="background:#059669;color:#fff;">
      Save Record
    </button>
  </div>
</div>
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="3" data-tooth-name="Maxillary Right First Molar" style="--tooth-x:18.47%;--tooth-y:28.99%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 3 · Maxillary Right First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="8" data-tooth-name="Maxillary Right Central Incisor" style="--tooth-x:47.13%;--tooth-y:14.29%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 8 · Maxillary Right Central Incisor" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="9" data-tooth-name="Maxillary Left Central Incisor" style="--tooth-x:52.87%;--tooth-y:14.29%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 9 · Maxillary Left Central Incisor" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="14" data-tooth-name="Maxillary Left First Molar" style="--tooth-x:81.53%;--tooth-y:28.99%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 14 · Maxillary Left First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="17" data-tooth-name="Mandibular Left Third Molar" style="--tooth-x:93.00%;--tooth-y:61.00%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 17 · Mandibular Left Third Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="19" data-tooth-name="Mandibular Left First Molar" style="--tooth-x:81.53%;--tooth-y:71.01%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 19 · Mandibular Left First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="30" data-tooth-name="Mandibular Right First Molar" style="--tooth-x:18.47%;--tooth-y:71.01%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 30 · Mandibular Right First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="31" data-tooth-name="Mandibular Right Second Molar" style="--tooth-x:12.73%;--tooth-y:66.26%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 31 · Mandibular Right Second Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="3" data-tooth-name="Maxillary Right First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 3 · Maxillary Right First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="8" data-tooth-name="Maxillary Right Central Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 8 · Maxillary Right Central Incisor" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="9" data-tooth-name="Maxillary Left Central Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 9 · Maxillary Left Central Incisor" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="14" data-tooth-name="Maxillary Left First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 14 · Maxillary Left First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="17" data-tooth-name="Mandibular Left Third Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 17 · Mandibular Left Third Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="19" data-tooth-name="Mandibular Left First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 19 · Mandibular Left First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="30" data-tooth-name="Mandibular Right First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 30 · Mandibular Right First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="31" data-tooth-name="Mandibular Right Second Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 31 · Mandibular Right Second Molar" type="button">
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
         <textarea id="autoProgressNote" rows="4" placeholder="Enter clinical progress note (optional)..."></textarea>
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
<div class="chart-history">
<div class="chart-history-heading">
<div>
<h4>Cross-referenced history</h4>
<p>Previous findings, treatments and linked clinical records for this tooth.</p>
</div>
<span class="history-count">0 records</span>
</div>
<div class="history-card" style="justify-content:center;color:#667085;padding:12px 0;">
<p class="muted small">No previous tooth history recorded.</p>
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
<section class="record-tab-panel" data-record-panel="pxray">
<div class="panel-header">
<div>
<h4>
         Patient X-ray Records
        </h4>
<p>
         Radiographs are attached to this patient file and can be linked to individual teeth.
        </p>
</div>
<button class="btn" onclick="document.getElementById('patientXrayModal').showModal()" type="button">
        + Add patient X-ray
       </button>
</div>
<div class="xray-record-grid" data-pr-xray-grid>
<div class="muted" style="padding: 2.5rem 1.5rem; text-align: center; grid-column: 1 / -1; width: 100%;">No X-rays recorded for this patient.</div>
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
<dialog aria-label="Appointment Record" class="modal modal-lg" id="appointmentModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">
       Appointment workspace
      </p>
<h3>
       Appointment Record
      </h3>
<p>
       APT-— · —
      </p>
</div>
<button aria-label="Close appointment record" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</div>
<div class="modal-scroll">
<div class="appointment-dialog-grid">
<div class="appointment-main">
<div class="appointment-banner">
<div>
<h4>
          — – —
         </h4>
<p>
          Comprehensive dental checkup
         </p>
</div>
<span class="status-pill warning">
         Pending
        </span>
</div>
<div class="appointment-meta-row">
<div class="appointment-meta-card">
<small>
          Patient
         </small>
<strong>
          —
         </strong>
</div>
<div class="appointment-meta-card">
<small>
          Arrival
         </small>
<strong>
          —
         </strong>
</div>
<div class="appointment-meta-card">
<small>
          Duration
         </small>
<strong>
          —
         </strong>
</div>
<div class="appointment-meta-card">
<small>
          Contact
         </small>
<strong>
          —
         </strong>
</div>
<div class="appointment-meta-card">
<small>
          Reminder
         </small>
<strong>
          —
         </strong>
</div>
<div class="appointment-meta-card">
<small>
          Clinic hours
         </small>
<strong>
          8:00 AM – 5:00 PM
         </strong>
</div>
</div>
<div class="record-section">
<div class="record-section-head">
<h4>
          Visit reason &amp; notes
         </h4>
<span>
          Reception note
         </span>
</div>
<p class="muted small">
         Routine recall examination. Patient reports occasional cold sensitivity on lower-right posterior tooth. No swelling or acute pain reported during confirmation call.
        </p>
</div>
<div class="record-section">
<div class="record-section-head">
<h4>
          Appointment activity
         </h4>
<span>
          Latest first
         </span>
</div>
<div class="mini-activity">
<p class="muted small" style="padding:12px 0;">No logged activity for this appointment.</p>
</div>
</div>
</div>
<aside class="appointment-side">
<div class="appointment-side-card">
<h4>
         Today's schedule
        </h4>
<span class="big-number">
         {{ $metrics['appointments_today'] ?? 0 }}
        </span>
<p>
         Total appointments · {{ $metrics['scheduled_today'] ?? 0 }} still pending
        </p>
</div>
<div class="appointment-side-card">
<h4>
         Patient snapshot
        </h4>
<div class="info-field">
<small>
          Last visit
         </small>
<strong>
          —
         </strong>
</div>
<div class="info-field" style="margin-top:12px">
<small>
          Medical alert
         </small>
<strong>
          No known allergies
         </strong>
</div>
<div class="info-field" style="margin-top:12px">
<small>
          Balance
         </small>
<strong>
          ₱0.00
         </strong>
</div>
</div>
<div class="appointment-side-card">
<h4>
         Policy reminder
        </h4>
<p>
         Late arrivals are evaluated against the remaining chair time. Cancellations require a documented reason.
        </p>
</div>
</aside>
</div>
</div>
</div>
</dialog>
<dialog aria-label="Operation Record" class="modal modal-lg" id="operationModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">
       Clinical operation
      </p>
<h3>
       Operation Record
      </h3>
<p>
       —
      </p>
</div>
<button aria-label="Close operation record" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</div>
<div class="patient-hero">
<div class="patient-identity">
<div class="patient-avatar">
       --
      </div>
<div>
<h4>
        —
       </h4>
<div class="patient-meta">
<span>
         —
        </span>
<span>
         None noted
        </span>
<span>
         —
        </span>
</div>
</div>
</div>
<span class="status-pill info">
      In progress
     </span>
</div>
<div class="modal-scroll">
<form>
<div class="form-section">
<div class="form-section-title">
<div>
<h4>
          Procedure information
         </h4>
<p>
          Update the active clinical procedure and tooth reference.
         </p>
</div>
</div>
<div class="form-grid">
<label>
         Procedure
         <input required="" value=""/>
</label>
<label>
         Tooth
         <input required="" value=""/>
</label>
<label>
         Dentist
         <input required="" value="—"/>
</label>
<label>
         Status
         <select required="">
<option>
           Scheduled
          </option>
<option selected="">
           In Progress
          </option>
<option>
           Completed
          </option>
</select>
</label>
</div>
</div>
<div class="form-section">
<div class="form-section-title">
<div>
<h4>
          Clinical documentation
         </h4>
<p>
          Document material, isolation, findings, and outcome.
         </p>
</div>
</div>
<div class="form-grid">
<label>
         Surface
         <select>
<option selected="">
           Occlusal
          </option>
<option>
           Mesial
          </option>
<option>
           Distal
          </option>
<option>
           Buccal
          </option>
<option>
           Lingual
          </option>
</select>
</label>
<label>
         Material
         <input value="Nanohybrid composite · Shade A2"/>
</label>
<label class="span-2">
         Clinical Notes
         <textarea required="" rows="5">Occlusal caries removed; isolation maintained. Composite shade A2 selected. Occlusion will be checked and polished before completion.</textarea>
</label>
</div>
</div>
<div class="form-actions">
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">
        Cancel
       </button>
<button class="btn" type="submit">
        Save operation
       </button>
</div>
</form>
</div>
</div>
</dialog>
<dialog aria-label="Comprehensive Dental Care" class="modal modal-lg" id="serviceModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">
       Service details
      </p>
<h3>
       Comprehensive Dental Care
      </h3>
<p>
       Personalized preventive and restorative care planned after clinical evaluation.
      </p>
</div>
<button aria-label="Close service details" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</div>
<div class="modal-scroll">
<div class="media-mosaic">
<figure>
<img alt="Cerillo Dental Clinic treatment room" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/comprehensive-exam.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6528858/pexels-photo-6528858.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
</figure>
<figure>
<img alt="Dentist consultation" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/oral-prophylaxis.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/3779706/pexels-photo-3779706.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
</figure>
<figure>
<img alt="Dental clinician" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/composite-restoration.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/3779713/pexels-photo-3779713.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
</figure>
<figure class="more-tile">
<img alt="Dental care team" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/teeth-whitening.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/5622271/pexels-photo-5622271.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
</figure>
<figure>
<img alt="Modern dental treatment space" loading="lazy" onerror="this.onerror=null;this.src='../assets/images/services/dental-crown.svg'" referrerpolicy="no-referrer" src="https://images.pexels.com/photos/6502305/pexels-photo-6502305.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
</figure>
</div>
<div class="service-detail-grid">
<div class="service-copy">
<h4>
        About this service
       </h4>
<p>
        A comprehensive visit begins with review of your current concerns, medical and dental history, and a focused oral examination. When clinically indicated, the dentist may recommend diagnostic imaging or additional tests before presenting treatment options.
       </p>
<p>
        The exact procedure, materials, number of visits, recovery expectations, and final fee depend on the individual diagnosis. You will receive an explanation of the proposed treatment and alternatives before care proceeds.
       </p>
<div class="record-section" style="margin-top:14px">
<div class="record-section-head">
<h4>
          What your visit may include
         </h4>
<span>
          Based on need
         </span>
</div>
<div class="info-matrix">
<div class="info-field">
<small>
           Assessment
          </small>
<strong>
           History review + oral examination
          </strong>
</div>
<div class="info-field">
<small>
           Diagnostics
          </small>
<strong>
           Imaging when clinically indicated
          </strong>
</div>
<div class="info-field">
<small>
           Treatment plan
          </small>
<strong>
           Options, risks, alternatives, next steps
          </strong>
</div>
</div>
</div>
</div>
<aside class="service-facts">
<div class="service-fact">
<small>
         Typical duration
        </small>
<strong>
         30–90 minutes depending on the procedure
        </strong>
</div>
<div class="service-fact">
<small>
         Visits
        </small>
<strong>
         Some treatments require multiple appointments
        </strong>
</div>
<div class="service-fact">
<small>
         Fees
        </small>
<strong>
         Discussed after examination and treatment planning
        </strong>
</div>
<div class="service-fact">
<small>
         Preparation
        </small>
<strong>
         Bring medication list, relevant records, and insurance information if applicable
        </strong>
</div>
</aside>
</div>
</div>
</div>
</dialog>
<dialog aria-label="Radiographic Series" class="modal modal-xl" id="xrayModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">
       Diagnostic imaging
      </p>
<h3>
       Radiographic Series
      </h3>
<p>
       —
      </p>
</div>
<button aria-label="Close X-ray viewer" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</div>
<div class="modal-scroll">
<div class="xray-viewer">
<div>
<div class="xray-stage">
<img alt="Primary panoramic dental radiograph" src="{{ asset('assets/images/xray-panoramic.png') }}"/>
<div class="xray-thumbs">
<img alt="Panoramic view" src="{{ asset('assets/images/xray-panoramic.png') }}"/>
<img alt="Focused intraoral view" src="{{ asset('assets/images/xray-periapical.png') }}"/>
<img alt="Second focused intraoral view" src="{{ asset('assets/images/xray-bitewing.png') }}"/>
</div>
</div>
</div>
<aside class="xray-meta">
<div class="xray-card">
<h4>
         Study information
        </h4>
<div class="info-field">
<small>
          Patient ID
         </small>
<strong>
          —
         </strong>
</div>
<div class="info-field" style="margin-top:12px">
<small>
          Ordering dentist
         </small>
<strong>
          —
         </strong>
</div>
<div class="info-field" style="margin-top:12px">
<small>
          Region
         </small>
<strong>
          —
         </strong>
</div>
</div>
<div class="xray-card">
<h4>
         Clinical finding
        </h4>
<p>
         No findings recorded.
        </p>
</div>
<div class="xray-card">
<h4>
         Plan
        </h4>
<p>
         No clinical plan recorded.
        </p>
</div>
</aside>
</div>
</div>
</div>
</dialog>
<dialog aria-label="Create Staff Account" class="modal modal-lg" id="accountModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">
       Access control
      </p>
<h3>
       Create Staff Account
      </h3>
<p>
       Create an account for authorized clinic personnel.
      </p>
</div>
<button aria-label="Close create account dialog" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</div>
<div class="modal-scroll">
<div class="modal-form-layout">
<aside class="modal-form-aside">
<h4>
        Account setup
       </h4>
<p>
        Assign the least-privileged role required for the staff member's work.
       </p>
<div class="modal-step">
<i>
         1
        </i>
<span>
         Enter verified staff identity and contact details.
        </span>
</div>
<div class="modal-step">
<i>
         2
        </i>
<span>
         Select Admin, Dentist, or Front Desk access.
        </span>
</div>
<div class="modal-step">
<i>
         3
        </i>
<span>
         Issue a temporary password for first sign-in.
        </span>
</div>
</aside>
<div class="modal-form-main">
<form id="accountCreateForm">
<div class="form-section">
<div class="form-section-title">
<div>
<h4>
            Staff identity
           </h4>
<p>
            Use the staff member's official clinic information.
           </p>
</div>
</div>
<div class="form-grid">
<label>
           First Name
           <input id="createAccountFirstName" name="first_name" minlength="2" required=""/>
</label>
<label>
           Last Name
           <input id="createAccountLastName" name="last_name" minlength="2" required=""/>
</label>
<label>
           Email
           <input id="createAccountEmail" name="email" placeholder="name@cerillodental.com" required="" type="email"/>
</label>
<label>
           Role
           <select id="createAccountRole" name="role" required="">
<option value="">
             Select role
            </option>
<option value="admin">
             Admin
            </option>
<option value="dentist">
             Dentist
            </option>
<option value="front_desk">
             Front Desk
            </option>
</select>
</label>
<label>
           Mobile
           <div class="phone-prefix">
<span>
             +63
            </span>
<input id="createAccountPhone" name="phone" maxlength="10" pattern="9[0-9]{9}" placeholder="9175550142" type="tel"/>
</div>
</label>
<label>
           Temporary Password
           <input id="createAccountPassword" name="password" minlength="8" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,}" required="" title="At least 8 characters with uppercase, lowercase and number" type="password"/>
</label>
</div>
</div>
<div id="accountCreateMessage" class="account-form-message" aria-live="polite"></div>
<div class="form-actions">
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">
          Cancel
         </button>
<button class="btn" type="submit">
          Create account
         </button>
</div>
</form>
</div>
</div>
</dialog>
<dialog aria-label="Staff Account Details" class="modal modal-lg" id="accountDetailModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">
       Access control
      </p>
<h3>
       Staff Account Details
      </h3>
<p>
       View and update clinic staff account credentials and status.
      </p>
</div>
<div style="display:flex;align-items:center;gap:0.5rem;">
<button aria-label="Close staff account dialog" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
       ×
      </button>
</div>
</div>
<div class="modal-scroll">
<div class="modal-form-layout">
<aside class="modal-form-aside">
<h4>
        Account management
       </h4>
<p>
        Review or modify access credentials for this staff member.
       </p>
<div class="modal-step">
<i>
         1
        </i>
<span>
         Update name and email address.
        </span>
</div>
<div class="modal-step">
<i>
         2
        </i>
<span>
         Set account status to Active or Inactive.
        </span>
</div>
<div class="modal-step">
<i>
         3
        </i>
<span>
         Optionally specify a new password (min. 8 characters).
        </span>
</div>
</aside>
<div class="modal-form-main">
<!-- View Mode -->
<div id="accountDetailViewSection">
  <div class="form-section">
    <div class="form-section-title">
      <div>
        <h4>Account Profile</h4>
        <p>Current staff credentials and access level.</p>
      </div>
    </div>
    <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;padding:20px;background:var(--surface,#f8fafc);border-radius:12px;border:1px solid var(--border,#e2e8f0);">
      <div>
        <small style="display:block;text-transform:uppercase;font-size:11px;font-weight:600;letter-spacing:0.05em;color:var(--muted,#64748b);margin-bottom:6px;">Full Name</small>
        <strong id="viewAccountName" style="font-size:16px;color:var(--text,#1e293b);">—</strong>
      </div>
      <div>
        <small style="display:block;text-transform:uppercase;font-size:11px;font-weight:600;letter-spacing:0.05em;color:var(--muted,#64748b);margin-bottom:6px;">Role</small>
        <span id="viewAccountRole" class="badge info" style="font-size:13px;padding:4px 10px;">—</span>
      </div>
      <div>
        <small style="display:block;text-transform:uppercase;font-size:11px;font-weight:600;letter-spacing:0.05em;color:var(--muted,#64748b);margin-bottom:6px;">Email Address</small>
        <span id="viewAccountEmail" style="font-size:14px;color:var(--text,#1e293b);word-break:break-all;">—</span>
      </div>
      <div>
        <small style="display:block;text-transform:uppercase;font-size:11px;font-weight:600;letter-spacing:0.05em;color:var(--muted,#64748b);margin-bottom:6px;">Account Status</small>
        <span id="viewAccountStatus" class="badge success" style="font-size:13px;padding:4px 10px;">Active</span>
      </div>
    </div>
  </div>
  <div class="form-actions" style="margin-top:1.5rem;display:flex;justify-content:flex-end;gap:10px;">
    <button class="btn secondary" onclick="this.closest('dialog').close()" type="button">Close</button>
    <button class="btn" id="accountDetailEditBtn" type="button">Edit</button>
  </div>
</div>

<!-- Edit Mode (Toggled via Edit button) -->
<div id="accountDetailEditSection" style="display:none;">
<form id="accountUpdateForm">
<input id="editAccountId" name="account_id" type="hidden"/>
<div class="form-section">
<div class="form-section-title">
<div>
<h4>
            Modify Staff Information
           </h4>
<p>
            Update credentials, role permissions, or reset password.
           </p>
</div>
</div>
<div class="form-grid">
<label class="span-2">
           Full Name
           <input id="editAccountName" name="name" minlength="2" placeholder="Full name" required=""/>
</label>
<label>
           Email
           <input id="editAccountEmail" name="email" placeholder="name@cerillo.local" required="" type="email"/>
</label>
<label>
           Role
           <select id="editAccountRole" name="role" required="">
<option value="admin">
             Admin
            </option>
<option value="dentist">
             Dentist
            </option>
<option value="front_desk">
             Front Desk
            </option>
</select>
</label>
<label>
           Status
           <select id="editAccountStatus" name="status" required="">
<option value="Active">
             Active
            </option>
<option value="Inactive">
             Inactive
            </option>
</select>
</label>
<label>
           Password (leave blank to keep current)
           <input id="editAccountPassword" name="password" minlength="8" placeholder="••••••••" type="password"/>
</label>
</div>
</div>
<div id="accountFormMessage" style="margin-top:0.75rem;font-size:0.875rem;font-weight:500;"></div>
<div class="form-actions" style="margin-top:1rem;display:flex;justify-content:flex-end;gap:10px;">
<button class="btn secondary" id="cancelAccountEditBtn" type="button">
          Cancel
         </button>
<button class="btn" type="submit">
          Save Changes
         </button>
</div>
</form>
</div>
</div>
</div>
</div>
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
<script id="adminSharedWorkflows">
   function renderAdminAvailability() {
  const holder = document.getElementById('adminAvailabilityChips');
  if (!holder) return;

  let blocks = [];
  try {
    blocks = JSON.parse(localStorage.getItem('cerilloDentistBlocks') || '[]');
  } catch (error) {
    blocks = [];
  }

  holder.innerHTML = blocks.length
    ? blocks.map((block) => `
        <span class="availability-chip">
          <strong>${block.dentist || 'Dentist'}</strong>
          ${block.label || block.date} · ${block.time || 'All day'} · ${block.reason}
        </span>
      `).join('')
    : '<span class="availability-empty">No additional blocked schedules.</span>';
}

renderAdminAvailability();
window.addEventListener('storage', renderAdminAvailability);

(function bindAdminXrayForm() {
  const modal = document.getElementById('addXrayModal');
  if (!modal) return;

  const patientSelect = modal.querySelector('.xrayPatientSelect');
  const fileInput = document.getElementById('adminXrayFiles');
  const uploadPreview = document.getElementById('adminXrayUploadPreview');

  patientSelect.addEventListener('change', () => {
    const option = patientSelect.selectedOptions[0];
    modal.querySelector('.xrayPatientName').textContent = option.value || 'Select a patient';
    modal.querySelector('.xrayPatientId').textContent = `Patient ID ${window.CerilloFormat?.patientCode(option.dataset.id, option.dataset.rawId) || option.dataset.id || '—'}`;
    modal.querySelector('.xrayPatientPhone').textContent = `Phone ${window.CerilloFormat?.phone(option.dataset.phone) || option.dataset.phone || '—'}`;
    modal.querySelector('.xrayPatientEmail').textContent = `Email ${option.dataset.email || '—'}`;
    modal.querySelector('.xrayPatientDob').textContent = `DOB ${option.dataset.dob || '—'}`;
  });

  fileInput.addEventListener('change', () => {
    uploadPreview.innerHTML = '';

    [...fileInput.files].slice(0, 3).forEach((file) => {
      const image = document.createElement('img');
      image.src = URL.createObjectURL(file);
      image.alt = 'Selected X-ray preview';
      uploadPreview.appendChild(image);
    });

    if (!fileInput.files.length) {
      uploadPreview.innerHTML = '<span>No images selected.</span>';
    }
  });

  document.getElementById('adminAddXrayForm').addEventListener('submit', (event) => {
    event.preventDefault();

    const record = {
      patient: patientSelect.value,
      type: document.getElementById('adminXrayType').value,
      date: document.getElementById('adminXrayDate').value,
      area: document.getElementById('adminXrayArea').value,
      findings: document.getElementById('adminXrayFindings').value
    };

    const records = JSON.parse(localStorage.getItem('cerilloXrayRecords') || '[]');
    records.unshift(record);
    localStorage.setItem('cerilloXrayRecords', JSON.stringify(records));

    modal.close();
    event.target.reset();
    alert(`X-ray record attached to ${record.patient}'s patient record.`);
  });
})();
  </script>
<script id="adminAccessibilitySettings">
   (function bindAccessibilitySettings() {
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
    const enabled = savedValue === null
      ? Boolean(input.checked)
      : savedValue === 'true';

    input.checked = enabled;
    document.body.classList.toggle(setting.className, enabled);

    input.addEventListener('change', () => {
      document.body.classList.toggle(setting.className, input.checked);
      localStorage.setItem(setting.key, String(input.checked));
    });
  });
})();
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
          —
         </dd>
</div>
<div>
<dt>
          Service
         </dt>
<dd data-vh-service="">
          —
         </dd>
</div>
<div>
<dt>
          Date &amp; Time
         </dt>
<dd data-vh-datetime="">
          —
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
        None
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
       Add Patient Radiograph
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
       <input readonly="" value="" placeholder="Patient name & ID"/>
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
       <input required="" type="date" value="{{ date('Y-m-d') }}"/>
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
<dialog class="modal modal-lg" id="serviceCrudModal">
<div class="modal-shell">
<header class="modal-header">
<div>
<p class="eyebrow">
       Services &amp; Pricing
      </p>
<h3>
       Add / Edit Service
      </h3>
</div>
<button class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</header>
<div class="modal-body">
<form class="form-grid">
<label>
       Service name
       <input id="serviceCrudName" placeholder="e.g., Composite Restoration" required=""/>
</label>
<label>
       Category
       <select id="serviceCrudCategory"><option>Preventive</option><option>Restorative</option><option>Endodontics</option><option>Prosthodontics</option><option>Orthodontics</option><option>Oral Surgery</option><option>Implant Dentistry</option><option>Cosmetic</option><option>Occlusion</option><option>Periodontics</option><option>Diagnostics</option></select>
</label>
<label>
       Price (₱)
       <input id="serviceCrudPrice" min="0" required="" type="number"/>
</label>
<label>
       Duration
       <input id="serviceCrudDuration" placeholder="e.g., 45–60 minutes" required=""/>
</label>
<label class="span-2">
       Short description
       <textarea id="serviceCrudDescription" required="" rows="3"></textarea>
</label>
<label class="span-2">
       Service notes / preparation / aftercare
       <textarea id="serviceCrudNotes" rows="5"></textarea>
</label>
<label class="span-2">
       Service images
       <input accept="image/*" id="serviceCrudImages" multiple="" type="file"/>
</label>
<label>
       Status
       <select id="serviceCrudStatus">
<option>
         Active
        </option>
<option>
         Inactive
        </option>
</select>
</label>
<div class="form-actions span-2">
<button class="btn btn-secondary" onclick="this.closest('dialog').close()" type="button">
        Cancel
       </button>
<button class="btn" id="saveServiceCrud" type="button">
        Save Service
       </button>
</div>
</form>
</div>
</div>
</dialog>
<dialog aria-label="Payment Receipt" class="modal payment-receipt-modal" id="adminPaymentModal">
  <div class="modal-shell payment-receipt-shell">
    <header class="modal-header payment-receipt-header">
      <div>
        <p class="eyebrow">Billing &amp; Payments</p>
        <h3>Payment Receipt</h3>
        <p data-admin-payment-reference>Transaction details</p>
      </div>
      <button class="icon-btn" data-admin-payment-close type="button" aria-label="Close payment details" onclick="this.closest('dialog').close()">×</button>
    </header>
    <div class="modal-body payment-receipt-body" data-admin-payment-body></div>
    <footer class="modal-footer payment-receipt-footer">
      <span class="muted" data-admin-payment-email-note></span>
      <div class="payment-receipt-actions">
        <button class="btn secondary" data-admin-payment-email type="button">Send to email</button>
        <button class="btn" data-admin-payment-pdf type="button">Export to PDF</button>
      </div>
    </footer>
  </div>
</dialog>
<dialog aria-label="Transaction Detail" class="modal modal-xl transaction-detail-modal financial-font-up" id="saleViewModal">
<div class="modal-shell transaction-shell">
<header class="modal-head transaction-modal-head">
<div>
<p class="eyebrow">
       Transaction Detail
      </p>
<h3>
       —
      </h3>
<p>
       Transaction details
      </p>
</div>
<button aria-label="Close transaction detail" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</header>
<div class="modal-scroll transaction-modal-body">
<section class="transaction-hero">
<div>
<span class="status success">
        Completed
       </span>
<h4>
        —
       </h4>
<p>
        —
       </p>
</div>
<div class="transaction-total">
<small>
        Total amount paid
       </small>
<strong>
        ₱0.00
       </strong>
<span>
        —
       </span>
</div>
</section>
<div class="transaction-meta-grid">
<div>
<small>
        Invoice number
       </small>
<strong>
        —
       </strong>
</div>
<div>
<small>
        Processed by
       </small>
<strong>
        —
       </strong>
</div>
<div>
<small>
        Payment method
       </small>
<strong>
        —
       </strong>
</div>
<div>
<small>
        Receipt status
       </small>
<strong>
        —
       </strong>
</div>
</div>
<section class="transaction-receipt-card">
<div class="transaction-section-head">
<div>
<h4>
         Receipt Breakdown
        </h4>
<p>
         Clinical services included in this transaction.
        </p>
</div>
<span>
        0 line items
       </span>
</div>
<div class="transaction-line-head">
<span>
        Description
       </span>
<span>
        Clinician
       </span>
<span>
        Amount
       </span>
</div>
<div class="transaction-line" style="justify-content:center;color:#667085;padding:12px 0;">
<span>No items recorded</span>
</div>
<div class="transaction-grand-total">
<span>
        Total paid
       </span>
<strong>
        ₱0.00
       </strong>
</div>
</section>
<section class="refund-policy-card">
<span class="refund-policy-icon">
       !
      </span>
<div>
<h4>
        Permanent Audit Trail
       </h4>
<p>
        Voiding or refunding never deletes this transaction. The system creates a separate negative balancing entry linked to this invoice and records the responsible administrator.
       </p>
</div>
</section>
</div>
<footer class="modal-footer transaction-footer">
<div class="footer-actions left">
<button class="btn danger" type="button">
       Void / Issue Refund
      </button>
<button class="btn secondary" type="button">
       Export Receipt PDF
      </button>
</div>
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">
      Close
     </button>
</footer>
</div>
</dialog>
<dialog class="modal save-record-confirm-modal" id="saveRecordConfirmModal">
<div class="modal-shell">
<header class="modal-header">
<div>
<p class="eyebrow">Confirm Save</p>
<h3>Save Dental Assessment</h3>
<p>Confirm saving the updated odontogram and clinical records for this patient.</p>
</div>
<button aria-label="Close save confirmation" class="icon-btn" onclick="this.closest('dialog').close()" type="button">×</button>
</header>
<div class="modal-body" style="padding: 20px 24px;">
<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 16px; margin-bottom: 16px;">
<div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
<span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b;">Patient</span>
<strong style="color: #1e293b; font-size: 13.5px;" data-confirm-patient-name>—</strong>
</div>
<div style="display: flex; justify-content: space-between;">
<span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b;">Procedure</span>
<strong style="color: #1e293b; font-size: 13.5px;" data-confirm-appt-info>—</strong>
</div>
</div>
<p style="margin: 0; color: #475467; font-size: 13.5px; line-height: 1.5;">
Are you sure you want to save this dental assessment? All recorded tooth findings, diagnoses, and consultation charges will be committed to the patient's official clinical record.
</p>
</div>
<footer class="modal-footer" style="padding: 14px 24px; display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #e5ebf3;">
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">Cancel</button>
<button class="btn" data-confirm-save-btn type="button">Confirm &amp; Save</button>
</footer>
</div>
</dialog>
<dialog class="modal modal-lg dentist-appointment-detail-modal clinical-record-modal" id="dentistAppointmentDetailModal">
<div class="modal-shell">
<header class="modal-header">
<div>
<p class="eyebrow">Appointment Record</p>
<h3 data-dentist-appt-title="">Appointment Details</h3>
<p>Clinical schedule information for the selected appointment.</p>
</div>
<button aria-label="Close appointment details" class="icon-btn" onclick="this.closest('dialog').close()" type="button">×</button>
</header>
<div class="modal-body">
<div class="appointment-detail-summary">
<div><small>Patient</small><strong data-da-patient="">—</strong></div>
<div><small>Procedure</small><strong data-da-procedure="">—</strong></div>
<div><small>Date</small><strong data-da-date="">—</strong></div>
<div><small>Time</small><strong data-da-time="">—</strong></div>
<div><small>Status</small><strong data-da-status="">—</strong></div>
<div><small>Dentist</small><strong data-da-dentist="">—</strong></div>
<div><small>Booking type</small><strong data-da-source="">—</strong></div>
<div><small>Date of birth / age</small><strong data-da-dob="">—</strong></div>
<div><small>Contact</small><strong data-da-contact="">—</strong></div>
</div>
<article class="appointment-detail-note">
<h4>Appointment notes</h4>
<p data-da-notes="">—</p>
</article>
<article class="appointment-detail-note">
<h4>Medical concern / reason for visit</h4>
<p data-da-concern="">—</p>
</article>
<section class="appointment-dental-assessment" data-appointment-dental-chart>
<div class="assessment-section-header">
<div>
<span class="assessment-kicker">Clinical Odontogram &amp; Assessment</span>
<h4>Dental Assessment</h4>
<p>Record tooth findings, clinical procedures, and treatment chart for this appointment.</p>
</div>
</div>
<div class="assessment-pending-placeholder" data-assessment-pending-placeholder>
<div class="pending-state-box">
<div class="pending-icon">🦷</div>
<strong data-pending-title>Assessment Not Started</strong>
<p data-pending-desc>The appointment is currently in Pending status. The Start Assessment button below will activate once the patient is Checked In at the clinic.</p>
</div>
</div>
<div class="appointment-chart-wrapper" data-appointment-chart-wrapper hidden>
<section class="record-tab-panel premium-dental-chart active" data-record-panel="chart">
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
<div class="premium-chart-actions">
<button class="btn secondary compact" data-chart-clear="" type="button">Clear Selection</button>
<button class="btn secondary compact" data-chart-print="" type="button">Print Chart</button>
<button class="btn compact" data-chart-save="" type="button">Save Changes</button>
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="3" data-tooth-name="Maxillary Right First Molar" style="--tooth-x:18.47%;--tooth-y:28.99%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 3 · Maxillary Right First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="8" data-tooth-name="Maxillary Right Central Incisor" style="--tooth-x:47.13%;--tooth-y:14.29%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 8 · Maxillary Right Central Incisor" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="9" data-tooth-name="Maxillary Left Central Incisor" style="--tooth-x:52.87%;--tooth-y:14.29%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 9 · Maxillary Left Central Incisor" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="14" data-tooth-name="Maxillary Left First Molar" style="--tooth-x:81.53%;--tooth-y:28.99%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 14 · Maxillary Left First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="17" data-tooth-name="Mandibular Left Third Molar" style="--tooth-x:93.00%;--tooth-y:61.00%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 17 · Mandibular Left Third Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="19" data-tooth-name="Mandibular Left First Molar" style="--tooth-x:81.53%;--tooth-y:71.01%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 19 · Mandibular Left First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="30" data-tooth-name="Mandibular Right First Molar" style="--tooth-x:18.47%;--tooth-y:71.01%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 30 · Mandibular Right First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="31" data-tooth-name="Mandibular Right Second Molar" style="--tooth-x:12.73%;--tooth-y:66.26%;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 31 · Mandibular Right Second Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="3" data-tooth-name="Maxillary Right First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 3 · Maxillary Right First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="8" data-tooth-name="Maxillary Right Central Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 8 · Maxillary Right Central Incisor" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="9" data-tooth-name="Maxillary Left Central Incisor" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 9 · Maxillary Left Central Incisor" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="14" data-tooth-name="Maxillary Left First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 14 · Maxillary Left First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="17" data-tooth-name="Mandibular Left Third Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 17 · Mandibular Left Third Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="19" data-tooth-name="Mandibular Left First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 19 · Mandibular Left First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="30" data-tooth-name="Mandibular Right First Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 30 · Mandibular Right First Molar" type="button">
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
<button aria-pressed="false" class="tooth-unit tooth-sound" data-tooth="31" data-tooth-name="Mandibular Right Second Molar" style="border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;" title="Tooth 31 · Mandibular Right Second Molar" type="button">
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
         <textarea id="autoProgressNote" rows="4" placeholder="Enter clinical progress note (optional)..."></textarea>
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
<section class="extraction-prescription-panel" data-extraction-prescription-panel hidden>
<div class="extraction-prescription-head">
<div>
<span class="extraction-prescription-kicker">Post-extraction care</span>
<h4>Prescription</h4>
<p>This section appears only when Tooth Extraction is selected as the treatment.</p>
</div>
<span class="extraction-prescription-tooth" data-extraction-prescription-tooth>Extraction treatment</span>
</div>
<div class="extraction-prescription-grid">
<label>
Medication
<input data-extraction-rx-medication maxlength="255" placeholder="e.g. Amoxicillin 500 mg" type="text"/>
</label>
<label>
Dosage
<input data-extraction-rx-dosage maxlength="255" placeholder="e.g. 1 capsule" type="text"/>
</label>
<label>
Frequency
<input data-extraction-rx-frequency maxlength="255" placeholder="e.g. Every 8 hours for 5 days" type="text"/>
</label>
<label class="span-2">
Instructions
<textarea data-extraction-rx-instructions maxlength="5000" placeholder="Post-extraction instructions, precautions, and medication notes." rows="3"></textarea>
</label>
</div>
<p class="extraction-prescription-note">Prescription details are saved with the completed clinical session and become part of the patient's record.</p>
</section>
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
         Material: Nanohybrid composite · Restorative procedure
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
<div class="tooth-quick-head"><div><small>Treatment plan</small><strong data-tqc-tooth="">Tooth</strong></div><button aria-label="Close" class="icon-btn tqc-close" type="button">×</button></div>
<div class="tooth-charge-summary"><span>Finding</span><strong data-tqc-finding="">—</strong></div>
<label>Treatment / procedure<select data-tqc-procedure=""><option>Composite Restoration</option><option>Root Canal Treatment</option><option>Dental Crown</option><option>Tooth Extraction</option><option>Surgical Extraction</option><option>Restorative Treatment</option><option>Observation / Review</option><option>Other Dental Procedure</option></select></label>
<div class="tooth-charge-message" data-tqc-message="" aria-live="polite"></div>
<small class="tooth-billing-note">Adds tooth to the Treatment Invoice Draft where pricing and notes are decided.</small>
<div class="tooth-charge-actions"><button class="btn secondary" data-tqc-cancel="" type="button">Cancel</button><button class="btn" data-tqc-save="" type="button">Add to treatment draft</button></div>
</div></section>
</div>
</section>
</div>
<footer class="modal-footer appointment-modal-footer">
<div class="modal-footer-left">
<button class="btn btn-start-assessment" data-appointment-start-assessment type="button">
<span class="btn-icon">▶</span>
<span>Start Assessment</span>
</button>
</div>
<div class="modal-footer-right">
<span class="small muted" data-appointment-chart-message role="status"></span>
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">Close</button>
<button class="btn" data-appointment-chart-save type="button" hidden>Save Record</button>
</div>
</footer>
</div>
</dialog>
<script id="dentistAppointmentDetailBinding">
   (function () {
    let currentAppointment = null;

    function getModal() {
     return document.getElementById('dentistAppointmentDetailModal');
    }

    function getConfirmModal() {
     return document.getElementById('saveRecordConfirmModal');
    }

    const FDI_TO_UNIVERSAL = {
      18: '1', 17: '2', 16: '3', 15: '4', 14: '5', 13: '6', 12: '7', 11: '8',
      21: '9', 22: '10', 23: '11', 24: '12', 25: '13', 26: '14', 27: '15', 28: '16',
      38: '17', 37: '18', 36: '19', 35: '20', 34: '21', 33: '22', 32: '23', 31: '24',
      41: '25', 42: '26', 43: '27', 44: '28', 45: '29', 46: '30', 47: '31', 48: '32',
      55: 'A', 54: 'B', 53: 'C', 52: 'D', 51: 'E', 61: 'F', 62: 'G', 63: 'H', 64: 'I', 65: 'J',
      75: 'K', 74: 'L', 73: 'M', 72: 'N', 71: 'O', 81: 'P', 82: 'Q', 83: 'R', 84: 'S', 85: 'T'
    };

    function conditionToClass(condition) {
      const c = String(condition || '').toLowerCase();
      if (c.includes('decay') || c.includes('caries') || c === 'c') return 'tooth-decay';
      if (c.includes('missing') || c.includes('extracted') || c === 'm' || c === 'x') return 'tooth-missing';
      if (c.includes('planned') || c === 'tp') return 'tooth-planned';
      if (c.includes('restor') || c.includes('completed') || c.includes('amalgam') || c.includes('composite') || c === 'am' || c === 'co' || c === 'rct') return 'tooth-completed';
      if (c.includes('impacted') || c === 'im') return 'tooth-impacted';
      if (c.includes('sound') || c === '/' || c === 'sound / healthy') return 'tooth-sound';
      return 'tooth-finding';
    }

    async function hydrateDentalChart(chart, patientId) {
      if (!chart) return;
      const allStateClasses = ['tooth-sound', 'tooth-decay', 'tooth-finding', 'tooth-planned', 'tooth-completed', 'tooth-missing', 'tooth-impacted'];
      chart.querySelectorAll('.tooth-unit').forEach((tooth) => {
        tooth.classList.remove(...allStateClasses);
        tooth.classList.add('tooth-sound');
        delete tooth.dataset.toothId;
        delete tooth.dataset.finding;
        delete tooth.dataset.databaseCondition;
        delete tooth.dataset.notes;
        delete tooth.dataset.surfaces;
        tooth.title = 'Tooth ' + (tooth.dataset.tooth || '') + ' · ' + (tooth.dataset.toothName || '');
      });
      if (!patientId) return;

      try {
        const response = await fetch('/api/patients/' + encodeURIComponent(patientId) + '/chart', {headers:{Accept:'application/json'}});
        if (!response.ok) return;
        const payload = await response.json();
        const teethMap = new Map((payload.teeth || []).map((t) => [String(t.id), t]));
        (payload.current || []).forEach((record) => {
          const toothObj = teethMap.get(String(record.tooth_id));
          const fdi = toothObj ? String(toothObj.fdi_number) : '';
          const univ = fdi && FDI_TO_UNIVERSAL[fdi] ? FDI_TO_UNIVERSAL[fdi] : (toothObj?.position || '');
          const tooth = chart.querySelector('.tooth-unit[data-tooth="' + univ + '"]') ||
                        chart.querySelector('.tooth-unit[data-tooth="' + fdi + '"]') ||
                        (fdi ? chart.querySelector('.tooth-unit[data-tooth-fdi="' + fdi + '"]') : null);
          if (!tooth) return;
          tooth.dataset.toothId = record.tooth_id;
          if (fdi) tooth.dataset.toothFdi = fdi;
          tooth.dataset.chartNumber = univ || fdi;
          const condition = record.condition || 'Finding recorded';
          tooth.dataset.databaseCondition = condition;
          tooth.dataset.condition = condition;
          tooth.title = 'Tooth ' + (univ || fdi) + ' · ' + condition;
          tooth.classList.remove(...allStateClasses);
          tooth.classList.add(conditionToClass(condition));
        });

        chart.querySelectorAll('.tooth-unit').forEach((tooth) => {
          const universal = String(tooth.dataset.tooth || '');
          const match = (payload.teeth || []).find((item) => {
            const u = FDI_TO_UNIVERSAL[item.fdi_number] || String(item.position);
            return u === universal || String(item.fdi_number) === universal;
          });
          if (match) {
            tooth.dataset.toothId = match.id;
            tooth.dataset.toothFdi = match.fdi_number;
            tooth.dataset.chartNumber = universal;
          }
        });
      } catch (err) {
        console.warn('Unable to hydrate chart:', err);
      }
    }

    function isAppointmentToday(dateVal) {
      if (!dateVal) return false;
      const now = new Date();
      const s = String(dateVal).trim();
      const isoMatch = s.match(/^(\d{4})-(\d{2})-(\d{2})/);
      if (isoMatch) {
        const y = parseInt(isoMatch[1], 10);
        const m = parseInt(isoMatch[2], 10) - 1;
        const d = parseInt(isoMatch[3], 10);
        return y === now.getFullYear() && m === now.getMonth() && d === now.getDate();
      }
      const parsed = new Date(s);
      if (!isNaN(parsed.getTime())) {
        return parsed.getFullYear() === now.getFullYear() &&
               parsed.getMonth() === now.getMonth() &&
               parsed.getDate() === now.getDate();
      }
      return false;
    }

    function updateAssessmentState(status, startsAt) {
      const modal = getModal();
      if (!modal) return;
      const isPending = /pending/i.test(status);
      const isCheckedIn = /checked\s*in|arrived/i.test(status);
      const isInProgress = /in\s*progress|ongoing|started/i.test(status);
      const isCompleted = /completed|done|finalized/i.test(status);
      const dateText = modal.querySelector('[data-da-date]')?.textContent?.trim() || '';
      const dateToCheck = startsAt || modal.dataset.startsAt || dateText;
      const isToday = isAppointmentToday(dateToCheck);

      const placeholder = modal.querySelector('[data-assessment-pending-placeholder]');
      const chartWrapper = modal.querySelector('[data-appointment-chart-wrapper]');
      const startBtn = modal.querySelector('[data-appointment-start-assessment]');
      const saveBtn = modal.querySelector('[data-appointment-chart-save]');
      const msg = modal.querySelector('[data-appointment-chart-message]');
      const pendingTitle = modal.querySelector('[data-pending-title]');
      const pendingDesc = modal.querySelector('[data-pending-desc]');

      if (msg) msg.textContent = '';

      if (isInProgress) {
        modal.dataset.assessmentStarted = 'true';
        if (placeholder) placeholder.hidden = true;
        if (chartWrapper) chartWrapper.hidden = false;
        if (startBtn) startBtn.hidden = true;
        if (saveBtn) {
          saveBtn.hidden = false;
          saveBtn.disabled = false;
          saveBtn.textContent = 'Save Record';
        }
        if (typeof renderCart === 'function') renderCart(modal);
        setTimeout(() => {
          window.dispatchEvent(new Event('resize'));
        }, 50);
      } else if (isCompleted) {
        modal.dataset.assessmentStarted = 'false';
        if (placeholder) placeholder.hidden = true;
        if (chartWrapper) chartWrapper.hidden = false;
        if (startBtn) startBtn.hidden = true;
        if (saveBtn) {
          saveBtn.hidden = false;
          saveBtn.disabled = false;
          saveBtn.textContent = 'Update Record';
        }
        if (typeof renderCart === 'function') renderCart(modal);
        setTimeout(() => {
          window.dispatchEvent(new Event('resize'));
        }, 50);
      } else {
        modal.dataset.assessmentStarted = 'false';
        if (placeholder) placeholder.hidden = false;
        if (chartWrapper) chartWrapper.hidden = true;
        if (saveBtn) saveBtn.hidden = true;
        if (typeof renderCart === 'function') renderCart(modal);
        if (startBtn) {
          startBtn.hidden = false;
          if (!isToday) {
            startBtn.disabled = true;
            startBtn.title = 'Assessment can only start on the appointment date (' + (dateText || 'scheduled date') + ')';
            if (pendingTitle) pendingTitle.textContent = 'Assessment Not Available · Scheduled Date: ' + (dateText || 'Future');
            if (pendingDesc) pendingDesc.textContent = 'This appointment is scheduled for ' + (dateText || 'a future date') + '. Clinical assessment can only be started on the day of the appointment once the patient has checked in at the clinic.';
          } else if (isCheckedIn) {
            startBtn.disabled = false;
            startBtn.title = 'Start clinical assessment for this patient';
            if (pendingTitle) pendingTitle.textContent = 'Patient Checked In · Ready for Assessment';
            if (pendingDesc) pendingDesc.textContent = 'The patient has arrived and checked in for today\'s appointment. Click "Start Assessment" at the bottom-left to begin recording findings on the dental chart.';
          } else {
            startBtn.disabled = true;
            startBtn.title = 'Patient must be Checked In before starting assessment';
            if (pendingTitle) pendingTitle.textContent = 'Assessment Not Started · Patient Not Checked In';
            if (pendingDesc) pendingDesc.textContent = 'The appointment is currently in "' + status + '" status. The Start Assessment button will activate once the patient is Checked In at the clinic today.';
          }
        }
      }
    }

    function setupPatientModalAppointmentBar(patientModal, appointment) {
      if (!patientModal || !appointment) return;
      const bar = patientModal.querySelector('[data-patient-appointment-bar]');
      if (!bar) return;
      bar.hidden = false;

      const procEl = bar.querySelector('[data-pa-procedure]');
      const dtEl = bar.querySelector('[data-pa-datetime]');
      const statusBadge = bar.querySelector('[data-pa-status-badge]');
      const startBtn = bar.querySelector('[data-pa-start-btn]');
      const saveBtn = bar.querySelector('[data-pa-save-btn]');
      const msg = bar.querySelector('[data-pa-message]');

      const procName = appointment.service?.name || 'Dental Appointment';
      if (procEl) procEl.textContent = procName;

      const dateStr = (function(raw) {
        if (!raw) return '—';
        const d = new Date(raw);
        return isNaN(d.getTime()) ? String(raw) : d.toLocaleDateString(undefined, {day:'2-digit',month:'short',year:'numeric'});
      })(appointment.starts_at);

      const timeStr = (function(raw) {
        if (!raw) return '—';
        const match = String(raw).match(/[ T](\d{2}):(\d{2})/);
        if (match) {
          const h = Number(match[1]);
          return `${h % 12 || 12}:${match[2]} ${h >= 12 ? 'PM' : 'AM'}`;
        }
        const d = new Date(raw);
        return isNaN(d.getTime()) ? String(raw) : d.toLocaleTimeString('en-US', {hour:'numeric',minute:'2-digit',hour12:true});
      })(appointment.starts_at);

      if (dtEl) dtEl.textContent = `${dateStr} · ${timeStr}`;

      const status = appointment.status || 'Pending';
      if (statusBadge) {
        statusBadge.textContent = status;
        statusBadge.className = 'status ' + (
          status === 'Completed' ? 'success' :
          ['Cancelled', 'No-Show'].includes(status) ? 'danger' :
          ['Checked In', 'In Progress'].includes(status) ? 'info' : 'warning'
        );
      }

      if (msg) msg.textContent = '';

      const isToday = isAppointmentToday(appointment.starts_at);
      const isCheckedIn = /checked\s*in|arrived/i.test(status);
      const isInProgress = /in\s*progress|ongoing|started/i.test(status);
      const isCompleted = /completed|done|finalized/i.test(status);

      if (isInProgress) {
        patientModal.dataset.assessmentStarted = 'true';
        if (startBtn) startBtn.hidden = true;
        if (saveBtn) {
          saveBtn.hidden = false;
          saveBtn.disabled = false;
          saveBtn.textContent = 'Save Record';
        }
        if (msg) {
          msg.style.color = '#059669';
          msg.textContent = 'Assessment in progress.';
        }
        patientModal.querySelectorAll('.tooth-unit').forEach(t => {
          t.removeAttribute('aria-disabled');
          t.removeAttribute('tabindex');
        });
        if (typeof renderCart === 'function') renderCart(patientModal);
      } else if (isCheckedIn) {
        patientModal.dataset.assessmentStarted = 'false';
        if (startBtn) {
          startBtn.hidden = false;
          startBtn.disabled = false;
          startBtn.title = 'Start clinical assessment for this patient';
        }
        if (saveBtn) saveBtn.hidden = true;
        if (msg) {
          msg.style.color = '#1e40af';
          msg.textContent = 'Patient checked in. Click "Start Assessment" to begin.';
        }
      } else if (isCompleted) {
        patientModal.dataset.assessmentStarted = 'false';
        if (startBtn) startBtn.hidden = true;
        if (saveBtn) {
          saveBtn.hidden = false;
          saveBtn.disabled = false;
          saveBtn.textContent = 'Update Record';
        }
        if (msg) {
          msg.style.color = '#059669';
          msg.textContent = 'Appointment completed.';
        }
        if (typeof renderCart === 'function') renderCart(patientModal);
      } else {
        patientModal.dataset.assessmentStarted = 'false';
        if (startBtn) {
          startBtn.hidden = false;
          startBtn.disabled = true;
          startBtn.title = isToday ? 'Patient must be Checked In before starting assessment' : 'Assessment can only start on the appointment date (' + dateStr + ')';
        }
        if (saveBtn) saveBtn.hidden = true;
        if (msg) {
          msg.style.color = '#64748b';
          msg.textContent = isToday ? 'Patient not checked in yet.' : 'Scheduled for future date.';
        }
      }
    }

    function showToast(text, isError = false) {
      const existing = document.querySelector('.clinic-toast-banner');
      if (existing) existing.remove();
      const banner = document.createElement('div');
      banner.className = 'clinic-toast-banner ' + (isError ? 'toast-error' : 'toast-success');
      const safeText = String(text || '').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[c]));
      banner.innerHTML = `<span class="toast-icon">${isError ? '⚠️' : '✓'}</span><span>${safeText}</span>`;
      document.body.appendChild(banner);
      setTimeout(() => {
        banner.style.opacity = '0';
        banner.style.transform = 'translate(-50%, -10px)';
        setTimeout(() => banner.remove(), 250);
      }, 4500);
    }

    async function startAssessment() {
      const modal = getModal();
      if (!modal) return;
      const appointmentId = modal.dataset.appointmentId;
      const startBtn = modal.querySelector('[data-appointment-start-assessment]');
      const msg = modal.querySelector('[data-appointment-chart-message]');
      if (!appointmentId) return;

      const dateText = modal.querySelector('[data-da-date]')?.textContent?.trim() || '';
      const dateToCheck = modal.dataset.startsAt || dateText;
      if (!isAppointmentToday(dateToCheck)) {
        showToast('Cannot start assessment: this appointment is scheduled for ' + (dateText || 'a future date') + '.', true);
        return;
      }
      const currentStatus = modal.querySelector('[data-da-status]')?.textContent?.trim() || '';
      if (!/checked\s*in|arrived/i.test(currentStatus) && !/in\s*progress/i.test(currentStatus)) {
        showToast('Patient must be Checked In before starting the assessment.', true);
        return;
      }

      if (startBtn) {
        startBtn.disabled = true;
        startBtn.innerHTML = '<span class="btn-icon">⏳</span><span>Starting...</span>';
      }
      if (msg) {
        msg.className = 'small muted';
        msg.textContent = 'Starting assessment session...';
      }

      try {
        const response = await fetch('/api/appointments/' + encodeURIComponent(appointmentId) + '/start-assessment', {
          method: 'POST',
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
          }
        });
        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
          throw new Error(data.message || 'Could not start assessment.');
        }

        modal.querySelector('[data-da-status]').textContent = 'In Progress';
        updateAssessmentState('In Progress');

        const chart = modal.querySelector('[data-appointment-chart-wrapper] .premium-dental-chart');
        const pid = currentAppointment?.patient?.id || modal.dataset.patientId || data.appointment?.patient_id;
        if (pid) modal.dataset.patientId = pid;
        if (chart && pid) {
          hydrateDentalChart(chart, pid);
        }

        const row = document.querySelector('tr[data-appointment-id="' + appointmentId + '"]');
        if (row) {
          const badge = row.querySelector('.status, .badge, [data-status-badge]');
          if (badge) {
            badge.textContent = 'In Progress';
            badge.className = 'status warning';
          }
        }

        if (msg) {
          msg.className = 'small muted';
          msg.style.color = '#059669';
          msg.style.fontWeight = '700';
          msg.textContent = '✓ Assessment started. You can now record dental findings.';
        }
        showToast('Assessment started. You can now record dental findings on the odontogram.', false);

        if (typeof window.loadPatients === 'function') window.loadPatients();
        if (typeof window.loadAppointments === 'function') window.loadAppointments();
      } catch (err) {
        if (msg) {
          msg.className = 'small muted error';
          msg.style.color = '#dc2626';
          msg.style.fontWeight = '700';
          msg.textContent = '⚠️ ' + (err.message || 'Failed to start assessment.');
        }
        showToast(err.message || 'Failed to start assessment.', true);
        if (startBtn) {
          startBtn.disabled = false;
          startBtn.innerHTML = '<span class="btn-icon">▶</span><span>Start Assessment</span>';
        }
      }
    }

    async function startPatientModalAssessment(patientModal) {
      if (!patientModal) return;
      const appointmentId = patientModal.dataset.appointmentId;
      const startBtn = patientModal.querySelector('[data-pa-start-btn]');
      const saveBtn = patientModal.querySelector('[data-pa-save-btn]');
      const msg = patientModal.querySelector('[data-pa-message]');
      const statusBadge = patientModal.querySelector('[data-pa-status-badge]');
      if (!appointmentId) return;

      const startsAt = patientModal.dataset.startsAt;
      if (!isAppointmentToday(startsAt)) {
        showToast('Cannot start assessment: this appointment is scheduled for a different date.', true);
        return;
      }
      const currentStatus = patientModal.dataset.appointmentStatus || statusBadge?.textContent?.trim() || '';
      if (!/checked\s*in|arrived/i.test(currentStatus) && !/in\s*progress/i.test(currentStatus)) {
        showToast('Patient must be Checked In before starting the assessment.', true);
        return;
      }

      if (startBtn) {
        startBtn.disabled = true;
        startBtn.innerHTML = '<span class="btn-icon">⏳</span><span>Starting...</span>';
      }
      if (msg) {
        msg.style.color = '#3157e8';
        msg.textContent = 'Starting assessment session...';
      }

      try {
        const response = await fetch('/api/appointments/' + encodeURIComponent(appointmentId) + '/start-assessment', {
          method: 'POST',
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
          }
        });
        const data = await response.json().catch(() => ({}));
        if (!response.ok) throw new Error(data.message || 'Could not start assessment.');

        patientModal.dataset.assessmentStarted = 'true';
        patientModal.dataset.appointmentStatus = 'In Progress';
        if (statusBadge) {
          statusBadge.textContent = 'In Progress';
          statusBadge.className = 'status info';
        }
        if (startBtn) startBtn.hidden = true;
        if (saveBtn) {
          saveBtn.hidden = false;
          saveBtn.disabled = false;
          saveBtn.textContent = 'Save Record';
        }
        if (msg) {
          msg.style.color = '#059669';
          msg.style.fontWeight = '700';
          msg.textContent = '✓ Assessment started. You can now record dental findings.';
        }

        patientModal.querySelectorAll('.tooth-unit').forEach(t => {
          t.removeAttribute('aria-disabled');
          t.removeAttribute('tabindex');
        });

        if (typeof renderCart === 'function') renderCart(patientModal);

        const rows = document.querySelectorAll('tr[data-appointment-id="' + appointmentId + '"]');
        rows.forEach(row => {
          const badge = row.querySelector('.status, .badge, [data-status-badge]');
          if (badge) {
            badge.textContent = 'In Progress';
            badge.className = 'status info';
          }
        });

        showToast('Assessment started. You can now record dental findings on the odontogram.', false);
        if (typeof window.loadPatients === 'function') window.loadPatients();
        if (typeof window.loadAppointments === 'function') window.loadAppointments();
      } catch (err) {
        if (msg) {
          msg.style.color = '#dc2626';
          msg.style.fontWeight = '700';
          msg.textContent = '⚠️ ' + (err.message || 'Failed to start assessment.');
        }
        showToast(err.message || 'Failed to start assessment.', true);
        if (startBtn) {
          startBtn.disabled = false;
          startBtn.innerHTML = '<span class="btn-icon">▶</span><span>Start Assessment</span>';
        }
      }
    }

    function openSaveConfirmModal(targetModal) {
      const modal = targetModal || (activeRecord && (activeRecord.id === 'dentistPatientModal' || activeRecord.id === 'patientViewModal') ? activeRecord : getModal());
      const confirmModal = getConfirmModal();
      if (!modal) return;
      if (!confirmModal) {
        if (modal.id === 'dentistPatientModal' || modal.id === 'patientViewModal') {
          savePatientModalAssessment(modal);
        } else {
          saveAppointmentChart();
        }
        return;
      }
      const patientName = modal.dataset.patientName || 'Patient';
      const patientCode = modal.dataset.patientCode || '';
      const proc = modal.dataset.procedure || modal.querySelector('[data-da-procedure]')?.textContent || modal.querySelector('[data-pa-procedure]')?.textContent || 'Dental Appointment';

      confirmModal.dataset.sourceModalId = modal.id;
      const nameEl = confirmModal.querySelector('[data-confirm-patient-name]');
      if (nameEl) nameEl.textContent = patientName + (patientCode ? ' · ' + patientCode : '');
      const infoEl = confirmModal.querySelector('[data-confirm-appt-info]');
      if (infoEl) infoEl.textContent = proc;
      confirmModal.showModal();
    }

    async function saveAppointmentChart() {
      const modal = getModal();
      if (!modal) return;
      const chart = modal.querySelector('[data-appointment-chart-wrapper] .premium-dental-chart');
      const message = modal.querySelector('[data-appointment-chart-message]');
      const button = modal.querySelector('[data-appointment-chart-save]');
      const appointmentId = modal.dataset.appointmentId;
      if (!appointmentId) return;

      if (button) button.disabled = true;
      if (message) {
        message.className = 'small muted';
        message.style.color = '#3157e8';
        message.style.fontWeight = '700';
        message.textContent = 'Saving dental assessment and finalizing appointment...';
      }

      try {
        const specificFindings = [];
        const specificDiagnoses = [];
        const specificTreatments = [];

        let savedTeethCount = 0;
        if (chart) {
          const allTeeth = Array.from(chart.querySelectorAll('.tooth-unit'));
          const changed = allTeeth.filter(tooth => {
            return Boolean(tooth.dataset.finding || (tooth.dataset.condition && tooth.dataset.condition !== tooth.dataset.databaseCondition));
          });

          if (changed.length > 0) {
            const teethPayload = changed.map(tooth => ({
              tooth_id: tooth.dataset.toothId || tooth.dataset.tooth,
              tooth_id_is_database_id: Boolean(tooth.dataset.toothId),
              tooth_fdi: tooth.dataset.toothFdi || null,
              condition: tooth.dataset.finding || tooth.dataset.condition || 'Sound / Healthy',
              surfaces: String(tooth.dataset.surfaces || '').split('').filter(Boolean),
              notes: tooth.dataset.notes || ''
            }));

            const response = await fetch('/api/appointments/' + encodeURIComponent(appointmentId) + '/teeth/batch', {
              method: 'POST',
              headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
              },
              body: JSON.stringify({ teeth: teethPayload })
            });
            const payload = await response.json().catch(() => ({}));
            if (!response.ok) throw new Error(payload.message || Object.values(payload.errors || {}).flat().join(', ') || 'Unable to save tooth findings.');

            changed.forEach(tooth => {
              const condition = tooth.dataset.finding || tooth.dataset.condition || 'Sound / Healthy';
              tooth.dataset.databaseCondition = condition;
              delete tooth.dataset.finding;
            });
            savedTeethCount = changed.length;
          }

          allTeeth.forEach(tooth => {
            const cond = tooth.dataset.condition || tooth.dataset.finding;
            if (cond && cond !== 'Sound / Healthy' && !/sound/i.test(cond)) {
              const toothNum = tooth.dataset.chartNumber || tooth.dataset.tooth || '';
              const toothName = tooth.dataset.toothName || '';
              const toothLabel = 'Tooth ' + toothNum + (toothName ? ' · ' + toothName : '');
              const notes = tooth.dataset.notes ? ` (${tooth.dataset.notes})` : '';
              const surfaces = tooth.dataset.surfaces ? ` [Surfaces: ${tooth.dataset.surfaces}]` : '';
              specificFindings.push(`${toothLabel}: ${cond}${surfaces}${notes}`);
            }
          });
        }

        const cartDraft = typeof draft === 'function' ? draft(modal) : (modal._cartItems ? { items: modal._cartItems } : { items: [] });
        const draftItems = cartDraft && Array.isArray(cartDraft.items) ? cartDraft.items : [];
        draftItems.forEach(item => {
          const tNum = item.chartNumber || item.tooth || '';
          const tName = item.toothName || '';
          const tLabel = 'Tooth ' + tNum + (tName ? ' · ' + tName : '');
          if (item.finding && !specificFindings.some(f => f.startsWith(tLabel))) {
            specificFindings.push(`${tLabel}: ${item.finding}`);
          }
          if (item.finding) {
            specificDiagnoses.push(`${tLabel}: ${item.finding}`);
          }
          if (item.procedure) {
            specificTreatments.push(`${tLabel}: ${item.procedure}${item.notes ? ' (' + item.notes + ')' : ''}`);
          }
        });

        let clinicalNotes = modal.querySelector('#toothClinicalNotes')?.value?.trim() || modal.querySelector('#autoProgressNote')?.value?.trim() || '';
        if (!clinicalNotes || /select\s+one\s+or\s+more/i.test(clinicalNotes)) {
          clinicalNotes = 'None';
        }
        const pulpal = modal.querySelector('#toothPulpalDiagnosis')?.value?.trim() || '';
        const apical = modal.querySelector('#toothApicalDiagnosis')?.value?.trim() || '';
        const treatment = modal.querySelector('#toothTreatment')?.value?.trim() || '';
        const generalDiag = [pulpal, apical].filter(d => d && !d.includes('Normal') && d !== 'None').join(' · ');
        if (generalDiag) {
          specificDiagnoses.push(generalDiag);
        }

        const prescriptionPanel = modal.querySelector('[data-extraction-prescription-panel]');
        const extractionSelected = Boolean(prescriptionPanel && !prescriptionPanel.hidden);
        if (extractionSelected) {
          const rxTooth = modal.querySelector('[data-extraction-prescription-tooth]')?.textContent?.trim() || '';
          specificTreatments.push((rxTooth ? rxTooth + ': ' : '') + 'Tooth Extraction');
        } else if (treatment && treatment !== 'None') {
          specificTreatments.push(treatment);
        }

        const prescriptionDetails = extractionSelected ? {
          medication: modal.querySelector('[data-extraction-rx-medication]')?.value?.trim() || '',
          dosage: modal.querySelector('[data-extraction-rx-dosage]')?.value?.trim() || '',
          frequency: modal.querySelector('[data-extraction-rx-frequency]')?.value?.trim() || '',
          instructions: modal.querySelector('[data-extraction-rx-instructions]')?.value?.trim() || ''
        } : null;

        const uniqueFindings = [...new Set(specificFindings.filter(Boolean))];
        const uniqueDiagnoses = [...new Set(specificDiagnoses.filter(Boolean))];
        const uniqueTreatments = [...new Set(specificTreatments.filter(Boolean))];

        const finalFindings = uniqueFindings.length > 0
          ? uniqueFindings.join('\n')
          : (savedTeethCount > 0 ? `${savedTeethCount} tooth findings recorded.` : 'Clinical findings recorded.');

        const finalDiagnosis = uniqueDiagnoses.length > 0
          ? uniqueDiagnoses.join('\n')
          : (generalDiag || 'Routine clinical assessment and monitoring.');

        const finalTreatment = uniqueTreatments.length > 0
          ? uniqueTreatments.join('\n')
          : (extractionSelected ? 'Tooth Extraction' : (treatment && treatment !== 'None' ? treatment : 'Routine oral hygiene & recall.'));

        const finishBtn = modal.querySelector('[data-consultation-finish]');
        const submitBtn = modal.querySelector('[data-consultation-submit]');
        if (submitBtn) {
          submitBtn.click();
        } else if (finishBtn && !finishBtn.disabled) {
          finishBtn.click();
          const modalSubmit = modal.querySelector('[data-consultation-submit]');
          if (modalSubmit) modalSubmit.click();
        }

        const completeRes = await fetch('/api/appointments/' + encodeURIComponent(appointmentId) + '/complete', {
          method: 'POST',
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
          },
          body: JSON.stringify({
            treatment_notes: clinicalNotes || 'Dental assessment and clinical treatments recorded.',
            diagnosis: finalDiagnosis,
            treatment_recommendations: finalTreatment,
            clinical_findings: finalFindings,
            dentist_notes: clinicalNotes,
            prescription_details: prescriptionDetails
          })
        });

        const completeData = await completeRes.json().catch(() => ({}));
        if (!completeRes.ok) {
          throw new Error(completeData.message || 'Unable to finalize appointment.');
        }

        const statusEl = modal.querySelector('[data-da-status]');
        if (statusEl) statusEl.textContent = 'Completed';
        updateAssessmentState('Completed');

        const row = document.querySelector('tr[data-appointment-id="' + appointmentId + '"]');
        if (row) {
          const badge = row.querySelector('.status, .badge, [data-status-badge]');
          if (badge) {
            badge.textContent = 'Completed';
            badge.className = 'status success';
          }
        }

        const successMsg = `Record saved! Appointment successfully updated to Completed and recorded in patient file.`;

        if (message) {
          message.className = 'small muted';
          message.style.color = '#059669';
          message.style.fontWeight = '700';
          message.textContent = '✓ ' + successMsg;
          setTimeout(() => {
            if (message && message.textContent.includes('updated to Completed')) {
              message.textContent = '';
            }
          }, 5000);
        }

        showToast(successMsg, false);
        if (typeof window.showCerilloSuccess === 'function') {
          window.showCerilloSuccess('Assessment Saved', 'Dental assessment and clinical records have been saved successfully.');
        }

        const pid = currentAppointment?.patient?.id || modal.dataset.patientId || completeData?.patient_id;
        if (chart && pid) {
          hydrateDentalChart(chart, pid);
        }

        if (typeof window.loadPatients === 'function') window.loadPatients();
        if (typeof window.loadAppointments === 'function') window.loadAppointments();
      } catch (error) {
        if (message) {
          message.className = 'small muted error';
          message.style.color = '#dc2626';
          message.style.fontWeight = '700';
          message.textContent = '⚠️ ' + (error.message || 'Error saving assessment.');
        }
        showToast(error.message || 'Error saving assessment.', true);
      } finally {
        if (button) button.disabled = false;
      }
    }

    async function savePatientModalAssessment(patientModal) {
      if (!patientModal) return;
      const appointmentId = patientModal.dataset.appointmentId;
      const patientId = patientModal.dataset.rawPatientId || patientModal.dataset.patientId;
      const saveBtn = patientModal.querySelector('[data-pa-save-btn]');
      const msg = patientModal.querySelector('[data-pa-message]');
      if (!appointmentId) return;

      if (saveBtn) saveBtn.disabled = true;
      if (msg) {
        msg.style.color = '#3157e8';
        msg.style.fontWeight = '700';
        msg.textContent = 'Saving dental assessment and finalizing appointment...';
      }

      try {
        const chart = patientModal.querySelector('[data-record-panel="chart"]');
        const specificFindings = [];
        const specificDiagnoses = [];
        const specificTreatments = [];
        let savedTeethCount = 0;

        if (chart) {
          const allTeeth = Array.from(chart.querySelectorAll('.tooth-unit'));
          const changed = allTeeth.filter(tooth => {
            return Boolean(tooth.dataset.finding || (tooth.dataset.condition && tooth.dataset.condition !== tooth.dataset.databaseCondition));
          });

          if (changed.length > 0) {
            const teethPayload = changed.map(tooth => ({
              tooth_id: tooth.dataset.toothId || tooth.dataset.tooth,
              tooth_id_is_database_id: Boolean(tooth.dataset.toothId),
              tooth_fdi: tooth.dataset.toothFdi || null,
              condition: tooth.dataset.finding || tooth.dataset.condition || 'Sound / Healthy',
              surfaces: String(tooth.dataset.surfaces || '').split('').filter(Boolean),
              notes: tooth.dataset.notes || ''
            }));

            const response = await fetch('/api/appointments/' + encodeURIComponent(appointmentId) + '/teeth/batch', {
              method: 'POST',
              headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
              },
              body: JSON.stringify({ teeth: teethPayload })
            });
            const payload = await response.json().catch(() => ({}));
            if (!response.ok) throw new Error(payload.message || Object.values(payload.errors || {}).flat().join(', ') || 'Unable to save tooth findings.');

            changed.forEach(tooth => {
              const condition = tooth.dataset.finding || tooth.dataset.condition || 'Sound / Healthy';
              tooth.dataset.databaseCondition = condition;
              delete tooth.dataset.finding;
            });
            savedTeethCount = changed.length;
          }

          allTeeth.forEach(tooth => {
            const cond = tooth.dataset.condition || tooth.dataset.finding;
            if (cond && cond !== 'Sound / Healthy' && !/sound/i.test(cond)) {
              const toothNum = tooth.dataset.chartNumber || tooth.dataset.tooth || '';
              const toothName = tooth.dataset.toothName || '';
              const toothLabel = 'Tooth ' + toothNum + (toothName ? ' · ' + toothName : '');
              const notes = tooth.dataset.notes ? ` (${tooth.dataset.notes})` : '';
              const surfaces = tooth.dataset.surfaces ? ` [Surfaces: ${tooth.dataset.surfaces}]` : '';
              specificFindings.push(`${toothLabel}: ${cond}${surfaces}${notes}`);
            }
          });
        }

        const cartDraft = typeof draft === 'function' ? draft(patientModal) : { items: [] };
        const draftItems = cartDraft && Array.isArray(cartDraft.items) ? cartDraft.items : [];
        draftItems.forEach(item => {
          const tNum = item.chartNumber || item.tooth || '';
          const tName = item.toothName || '';
          const tLabel = 'Tooth ' + tNum + (tName ? ' · ' + tName : '');
          if (item.finding && !specificFindings.some(f => f.startsWith(tLabel))) {
            specificFindings.push(`${tLabel}: ${item.finding}`);
          }
          if (item.finding) specificDiagnoses.push(`${tLabel}: ${item.finding}`);
          if (item.procedure) specificTreatments.push(`${tLabel}: ${item.procedure}${item.notes ? ' (' + item.notes + ')' : ''}`);
        });

        let clinicalNotes = patientModal.querySelector('#toothClinicalNotes')?.value?.trim() || patientModal.querySelector('#autoProgressNote')?.value?.trim() || '';
        if (!clinicalNotes || /select\s+one\s+or\s+more/i.test(clinicalNotes)) {
          clinicalNotes = 'None';
        }
        const pulpal = patientModal.querySelector('#toothPulpalDiagnosis')?.value?.trim() || '';
        const apical = patientModal.querySelector('#toothApicalDiagnosis')?.value?.trim() || '';
        const treatment = patientModal.querySelector('#toothTreatment')?.value?.trim() || '';
        const generalDiag = [pulpal, apical].filter(d => d && !d.includes('Normal') && d !== 'None').join(' · ');
        if (generalDiag) specificDiagnoses.push(generalDiag);
        if (treatment && treatment !== 'None') specificTreatments.push(treatment);

        const uniqueFindings = [...new Set(specificFindings.filter(Boolean))];
        const uniqueDiagnoses = [...new Set(specificDiagnoses.filter(Boolean))];
        const uniqueTreatments = [...new Set(specificTreatments.filter(Boolean))];

        const finalFindings = uniqueFindings.length > 0 ? uniqueFindings.join('\n') : (savedTeethCount > 0 ? `${savedTeethCount} tooth findings recorded.` : 'Clinical findings recorded.');
        const finalDiagnosis = uniqueDiagnoses.length > 0 ? uniqueDiagnoses.join('\n') : (generalDiag || 'Routine clinical assessment and monitoring.');
        const finalTreatment = uniqueTreatments.length > 0 ? uniqueTreatments.join('\n') : (treatment && treatment !== 'None' ? treatment : 'Routine oral hygiene & recall.');

        const finishBtn = patientModal.querySelector('[data-consultation-finish]');
        const submitBtn = patientModal.querySelector('[data-consultation-submit]');
        if (submitBtn) {
          submitBtn.click();
        } else if (finishBtn && !finishBtn.disabled) {
          finishBtn.click();
          const modalSubmit = patientModal.querySelector('[data-consultation-submit]');
          if (modalSubmit) modalSubmit.click();
        }

        const completeRes = await fetch('/api/appointments/' + encodeURIComponent(appointmentId) + '/complete', {
          method: 'POST',
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
          },
          body: JSON.stringify({
            treatment_notes: clinicalNotes || 'Dental assessment and clinical treatments recorded.',
            diagnosis: finalDiagnosis,
            treatment_recommendations: finalTreatment,
            clinical_findings: finalFindings,
            dentist_notes: clinicalNotes
          })
        });
        const completeData = await completeRes.json().catch(() => ({}));
        if (!completeRes.ok) throw new Error(completeData.message || 'Unable to finalize appointment.');

        const rawPid = patientModal.dataset.rawPatientId || patientId;
        if (rawPid && typeof window.openPatientRecord === 'function') {
          await window.openPatientRecord(rawPid);
          const chartTab = patientModal.querySelector('[data-record-tab="chart"]');
          if (chartTab) chartTab.click();
        }

        patientModal.dataset.assessmentStarted = 'false';
        patientModal.dataset.appointmentStatus = 'Completed';
        const statusBadge = patientModal.querySelector('[data-pa-status-badge]');
        if (statusBadge) {
          statusBadge.textContent = 'Completed';
          statusBadge.className = 'status success';
        }
        if (saveBtn) {
          saveBtn.textContent = 'Update Record';
          saveBtn.disabled = false;
        }
        if (msg) {
          msg.style.color = '#059669';
          msg.style.fontWeight = '700';
          msg.textContent = '✓ Record saved and visit completed successfully.';
        }

        showToast('Assessment record saved and appointment completed successfully.', false);
        if (typeof window.showCerilloSuccess === 'function') {
          window.showCerilloSuccess('Assessment Saved', 'Dental assessment and clinical records have been saved successfully.');
        }

        if (typeof window.loadPatients === 'function') window.loadPatients();
        if (typeof window.loadAppointments === 'function') window.loadAppointments();
      } catch (err) {
        if (msg) {
          msg.style.color = '#dc2626';
          msg.style.fontWeight = '700';
          msg.textContent = '⚠️ ' + (err.message || 'Error saving assessment.');
        }
        showToast(err.message || 'Error saving assessment.', true);
      } finally {
        if (saveBtn) saveBtn.disabled = false;
      }
    }

    window.openDentistAppointment = async function (idOrButton) {
      let actualId = null;
      let targetRow = null;

      if (typeof idOrButton === 'object' && idOrButton !== null) {
        if (idOrButton.nodeType) {
          actualId = idOrButton.dataset?.appointmentId || idOrButton.getAttribute?.('data-appointment-id');
          targetRow = idOrButton.closest('tr');
        } else if (idOrButton.id || idOrButton.dataset?.appointmentId) {
          actualId = idOrButton.id || idOrButton.dataset?.appointmentId;
        }
      } else if (typeof idOrButton === 'string' || typeof idOrButton === 'number') {
        actualId = String(idOrButton).trim();
      }

      if (!actualId && targetRow) {
        actualId = targetRow.dataset?.appointmentId;
      }
      if (!targetRow && actualId) {
        targetRow = document.querySelector('tr[data-appointment-id="' + actualId + '"]');
      }

      if (!actualId) return;

      try {
        const res = await fetch('/api/appointments/' + encodeURIComponent(actualId), {headers:{Accept:'application/json'}});
        if (!res.ok) throw new Error('Could not load appointment details.');
        const appointment = await res.json();
        currentAppointment = appointment;

        const isExistingPatient = Boolean(appointment.patient_id && appointment.patient);

        if (isExistingPatient) {
          // EXISTING PATIENT: Open patient records modal with all sub-modules!
          const newApptModal = getModal();
          if (newApptModal && newApptModal.open) newApptModal.close();

          const patientModal = document.getElementById('dentistPatientModal') || document.getElementById('patientViewModal');
          if (patientModal) {
            patientModal.dataset.openedFromAppointment = 'true';
            patientModal.dataset.appointmentId = String(appointment.id);
            patientModal.dataset.appointmentStatus = appointment.status || 'Pending';
            patientModal.dataset.startsAt = appointment.starts_at || '';
            patientModal.dataset.procedure = appointment.service?.name || 'Dental Appointment';

            if (typeof window.openPatientRecord === 'function') {
              await window.openPatientRecord(appointment.patient.id);
            } else if (typeof patientModal.showModal === 'function') {
              patientModal.showModal();
            }

            setupPatientModalAppointmentBar(patientModal, appointment);

            // Ensure teeth are clickable when opened through appointment module
            patientModal.querySelectorAll('.tooth-unit').forEach(tooth => {
              tooth.removeAttribute('aria-disabled');
              tooth.removeAttribute('tabindex');
              tooth.style.pointerEvents = 'auto';
              tooth.style.cursor = 'pointer';
            });

            // Switch to Dental Chart tab automatically
            const chartTab = patientModal.querySelector('[data-record-tab="chart"]');
            if (chartTab) chartTab.click();
          }
        } else {
          // NEW PATIENT: Keep same UI (appointment details summary on top, dental assessment chart below)
          const patientModal = document.getElementById('dentistPatientModal') || document.getElementById('patientViewModal');
          if (patientModal && patientModal.open) {
            patientModal.dataset.openedFromAppointment = 'false';
            delete patientModal.dataset.appointmentId;
            const pBar = patientModal.querySelector('[data-patient-appointment-bar]');
            if (pBar) pBar.hidden = true;
            patientModal.close();
          }

          const modal = getModal();
          if (!modal) return;

          let patientName = appointment.guest_name || 'Visitor';
          let procedure = appointment.service?.name || 'Dental Appointment';
          let status = appointment.status || 'Pending';
          let dentist = appointment.dentist?.name || 'Dr. Angela Cerillo';
          let contact = [appointment.formatted_guest_phone || window.CerilloFormat?.phone(appointment.guest_phone), appointment.guest_email].filter(Boolean).join(' · ') || 'Not provided';
          const intake = appointment.intake_details || {};
          let dob = intake.date_of_birth ? String(intake.date_of_birth).slice(0, 10) : 'Not provided';
          let notes = intake.notes || intake.additional_notes || appointment.treatment_notes || 'No notes recorded.';
          let concern = intake.medical_concern || intake.reason_for_visit || 'No concern recorded.';

          const dateFormatted = (function(raw) {
            if (!raw) return '—';
            const m = String(raw).match(/^(\d{4})-(\d{2})-(\d{2})/);
            if (m) {
              const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
              return `${m[3]} ${months[parseInt(m[2], 10) - 1]} ${m[1]}`;
            }
            const p = new Date(raw);
            return isNaN(p.getTime()) ? String(raw) : p.toLocaleDateString(undefined,{day:'2-digit',month:'short',year:'numeric'});
          })(appointment.starts_at);

          const timeFormatted = (function(raw) {
            if (!raw) return '—';
            const match = String(raw).match(/[ T](\d{2}):(\d{2})/);
            if (match) {
              const hour = Number(match[1]);
              const minute = match[2];
              return `${hour % 12 || 12}:${minute} ${hour >= 12 ? 'PM' : 'AM'}`;
            }
            const p = new Date(raw);
            return isNaN(p.getTime()) ? String(raw) : p.toLocaleTimeString('en-US', {hour:'numeric',minute:'2-digit',hour12:true});
          })(appointment.starts_at);

          modal.dataset.appointmentId = String(appointment.id);
          modal.dataset.patientId = '';
          modal.dataset.patientName = patientName;
          modal.dataset.patientCode = '';
          modal.dataset.startsAt = appointment.starts_at || '';
          window.resetDentistExtractionPrescription?.(modal);

          const titleEl = modal.querySelector('[data-dentist-appt-title]');
          if (titleEl) titleEl.textContent = patientName + ' · ' + procedure;
          const pEl = modal.querySelector('[data-da-patient]');
          if (pEl) pEl.textContent = patientName;
          const procEl = modal.querySelector('[data-da-procedure]');
          if (procEl) procEl.textContent = procedure;
          const dateEl = modal.querySelector('[data-da-date]');
          if (dateEl) dateEl.textContent = dateFormatted;
          const timeEl = modal.querySelector('[data-da-time]');
          if (timeEl) timeEl.textContent = timeFormatted;
          const stEl = modal.querySelector('[data-da-status]');
          if (stEl) stEl.textContent = status;
          const dentEl = modal.querySelector('[data-da-dentist]');
          if (dentEl) dentEl.textContent = dentist;
          const srcEl = modal.querySelector('[data-da-source]');
          if (srcEl) srcEl.textContent = (appointment.source || 'online').replace('_',' ');
          const dobEl = modal.querySelector('[data-da-dob]');
          if (dobEl) dobEl.textContent = dob;
          const conEl = modal.querySelector('[data-da-contact]');
          if (conEl) conEl.textContent = contact;
          const notesEl = modal.querySelector('[data-da-notes]');
          if (notesEl) notesEl.textContent = notes;
          const concernEl = modal.querySelector('[data-da-concern]');
          if (concernEl) concernEl.textContent = concern;

          updateAssessmentState(status, appointment.starts_at);
          window.syncDentistExtractionPrescription?.(modal, appointment);

          const chart = modal.querySelector('[data-appointment-chart-wrapper] .premium-dental-chart');
          if (chart) {
            hydrateDentalChart(chart, '');
          }

          if (!modal.open) {
            if (typeof modal.showModal === 'function') {
              modal.showModal();
            } else {
              modal.setAttribute('open', '');
            }
          }
        }
      } catch (err) {
        console.warn('Error opening dentist appointment:', err);
        showToast(err.message || 'Error opening appointment.', true);
      }
    };

    document.addEventListener('click', (event) => {
      const modal = getModal();
      const confirmModal = getConfirmModal();

      if (event.target.closest('[data-appointment-start-assessment]')) {
        startAssessment();
        return;
      }
      if (event.target.closest('[data-pa-start-btn]')) {
        const pm = event.target.closest('#dentistPatientModal, #patientViewModal');
        if (pm) startPatientModalAssessment(pm);
        return;
      }
      if (event.target.closest('[data-appointment-chart-save]')) {
        openSaveConfirmModal(modal);
        return;
      }
      if (event.target.closest('[data-pa-save-btn]')) {
        const pm = event.target.closest('#dentistPatientModal, #patientViewModal');
        if (pm) openSaveConfirmModal(pm);
        return;
      }
      if (event.target.closest('[data-confirm-save-btn]')) {
        const sourceId = confirmModal?.dataset?.sourceModalId;
        if (confirmModal) confirmModal.close();
        if (sourceId === 'dentistPatientModal' || sourceId === 'patientViewModal') {
          const pm = document.getElementById(sourceId);
          if (pm) savePatientModalAssessment(pm);
        } else {
          saveAppointmentChart();
        }
        return;
      }

      const apptBtn = event.target.closest('#dentist-table-1 tr[data-appointment-id], #dentist-table-2 .appointment-view, #dentist-table-2 [data-appointment-id], #dentist-table-2 button.table-action');
      if (apptBtn) {
        event.preventDefault();
        window.openDentistAppointment(apptBtn);
        return;
      }

      const patientBtn = event.target.closest('#dentist-table-3 [data-live-patient-id], #dentist-table-3 button.table-action, #admin-patient-table button.table-action, #admin-table-1 button.table-action');
      if (patientBtn) {
        event.preventDefault();
        const patientModal = document.getElementById('dentistPatientModal') || document.getElementById('patientViewModal');
        if (patientModal) {
          patientModal.dataset.openedFromAppointment = 'false';
          delete patientModal.dataset.appointmentId;
          delete patientModal.dataset.assessmentStarted;
          const pBar = patientModal.querySelector('[data-patient-appointment-bar]');
          if (pBar) pBar.hidden = true;
          patientModal.querySelectorAll('.tooth-unit').forEach(tooth => {
            tooth.setAttribute('aria-disabled', 'true');
            tooth.setAttribute('tabindex', '-1');
            tooth.style.pointerEvents = 'none';
            tooth.style.cursor = 'default';
          });
        }
        const patientId = patientBtn.dataset?.livePatientId || patientBtn.dataset?.patientId;
        if (patientId && typeof window.openPatientRecord === 'function') {
          window.openPatientRecord(patientId);
        } else if (patientModal) {
          patientModal.showModal();
        }
        return;
      }
    });
   })();
</script>

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
      note.value = '';
      note.placeholder = 'Enter clinical progress note (optional)...';
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
      if (dialog.id === 'patientViewModal' && dialog.dataset.openedFromAppointment !== 'true') {
        return;
      }
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
        if(typeof window.updateToothFindingBelow==='function'){
          window.updateToothFindingBelow(tooth, condition);
        }
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
    const startDate = details.querySelector("[data-filter-start-date]")?.value || "";
    const endDate = details.querySelector("[data-filter-end-date]")?.value || "";

    table.querySelectorAll("tbody tr").forEach(function (row) {
      const text = (row.textContent + " " + (row.dataset.filterTags || "")).toLowerCase();
      const matchesQuery = !query || text.includes(query);
      const matchesStatus = !status || text.includes(status);
      let matchesDate = true;
      if (startDate || endDate) {
        const rawDate = (row.cells[0]?.textContent || "").trim();
        const parsed = Date.parse(rawDate);
        if (!Number.isNaN(parsed)) {
          if (startDate) matchesDate = matchesDate && parsed >= Date.parse(startDate + "T00:00:00");
          if (endDate) matchesDate = matchesDate && parsed <= Date.parse(endDate + "T23:59:59");
        }
      }
      row.hidden = !(matchesQuery && matchesStatus && matchesDate);
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
      const startDate = details.querySelector("[data-filter-start-date]");
      const endDate = details.querySelector("[data-filter-end-date]");
      if (query) query.value = "";
      if (status) status.value = "";
      if (startDate) startDate.value = "";
      if (endDate) endDate.value = "";
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

  function prepareCharts(root) {
    const scope = root && root.querySelectorAll ? root : document;
    scope.querySelectorAll('.premium-dental-chart .tooth-unit').forEach(classifyTooth);
  }

  function prepareClosest(source) {
    const chart = source?.closest?.('.premium-dental-chart');
    if (chart) prepareCharts(chart);
  }

  document.addEventListener('click', function (event) {
    const trigger = event.target.closest('[data-record-tab="chart"], [data-dentition]');
    if (trigger) requestAnimationFrame(() => prepareClosest(trigger));
  });

  if ('MutationObserver' in window) {
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        const dialog = mutation.target;
        if (dialog instanceof HTMLDialogElement && dialog.open) {
          requestAnimationFrame(() => prepareCharts(dialog));
        }
      });
    });
    document.querySelectorAll('dialog').forEach((dialog) => {
      observer.observe(dialog, { attributes: true, attributeFilter: ['open'] });
    });
  }
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
<p data-xray-detail-subtitle="">—</p>
</div>
<button aria-label="Close X-ray details" class="icon-btn" onclick="this.closest('dialog').close()" type="button">×</button>
</header>
<div class="modal-body xray-detail-layout">
<div class="patient-xray-detail-image">
<img alt="Patient dental radiograph" data-xray-detail-image="" src="{{ asset('assets/images/xray-panoramic.png') }}"/>
</div>
<div class="patient-xray-detail-info">
<div class="xray-detail-summary">
<div><small>Patient</small><strong data-xray-detail-patient="">—</strong></div>
<div><small>Date taken</small><strong data-xray-detail-date="">—</strong></div>
<div><small>Imaging type</small><strong data-xray-detail-type="">—</strong></div>
<div><small>Dentist</small><strong data-xray-detail-dentist="">—</strong></div>
</div>
<article class="xray-detail-note">
<small>Clinical findings</small>
<p data-xray-detail-findings="">No findings recorded.</p>
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
       const dentist = card.querySelector('span')?.textContent.trim() || '—';
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

    function initializeDialog(dialog) {
     if (!dialog || dialog.dataset.cerilloRecordInitialized === 'true') return;
     dialog.dataset.cerilloRecordInitialized = 'true';
     prepareDentitions(dialog);
     relocatePeriodontal(dialog);
     bindXrays(dialog);
    }

    if ('MutationObserver' in window) {
     const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
       const dialog = mutation.target;
       if (dialog instanceof HTMLDialogElement && dialog.open && dialog.classList.contains('clinical-record-modal')) {
        initializeDialog(dialog);
       }
      });
     });
     document.querySelectorAll('dialog.clinical-record-modal').forEach((dialog) => {
      observer.observe(dialog, { attributes: true, attributeFilter: ['open'] });
      if (dialog.open) initializeDialog(dialog);
     });
    } else {
     document.addEventListener('click', (event) => {
      const dialog = event.target.closest('dialog.clinical-record-modal');
      if (dialog) initializeDialog(dialog);
     });
    }
   })();
  </script>
<script id="adminInteractiveCalendar">
(function () {
  const weekGrid = document.getElementById('adminInteractiveWeek');
  const weekWrap = document.getElementById('adminCalendarWeek');
  const monthGrid = document.getElementById('adminCalendarMonth');
  const title = document.getElementById('adminCalendarTitle');
  const note = document.getElementById('adminCalendarSelection');
  const dentistFilter = document.getElementById('adminCalendarDentistFilter');
  const monthRail = document.getElementById('adminCalendarMonthRail');
  const yearLabel = document.getElementById('adminCalendarYear');
  const agenda = document.getElementById('adminCalendarAppointments');
  const agendaLabel = document.getElementById('adminCalendarAgendaLabel');
  const availabilityTable = document.getElementById('adminAvailabilityTable');
  if (!weekGrid || !weekWrap || !monthGrid || !title || !agenda) return;

  let anchor = new Date();
  anchor.setHours(12,0,0,0);
  let view = 'week';
  let selectedDate = null;
  let calendarAppointments = [];
  let calendarBlocks = [];
  let dentistNames = {};
  const hours = [9,10,11,12,13,14,15,16,17];
  const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  const pad = n => String(n).padStart(2,'0');
  const iso = d => `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`;
  const escapeHtml = value => String(value ?? '').replace(/[&<>"']/g, char => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
  const parseClinicDate = value => {
    if (!value) return new Date(NaN);
    if (value instanceof Date) return value;
    const s = String(value).trim();
    const m = s.match(/^(\d{4})-(\d{2})-(\d{2})(?:[ T](\d{2}):(\d{2})(?::(\d{2}))?)?/);
    if (m) {
      const year = parseInt(m[1], 10);
      const month = parseInt(m[2], 10) - 1;
      const day = parseInt(m[3], 10);
      const hour = m[4] ? parseInt(m[4], 10) : 0;
      const minute = m[5] ? parseInt(m[5], 10) : 0;
      const second = m[6] ? parseInt(m[6], 10) : 0;
      return new Date(year, month, day, hour, minute, second);
    }
    return new Date(s);
  };
  const fmtTime = value => {
    const d = value instanceof Date ? value : parseClinicDate(value);
    if (Number.isNaN(d.getTime())) return '—';
    return d.toLocaleTimeString('en-US',{hour:'numeric',minute:'2-digit',hour12:true});
  };
  const monday = d => { const x=new Date(d); const day=x.getDay()||7; x.setDate(x.getDate()-day+1); x.setHours(12,0,0,0); return x; };
  const sameDay = (a, b) => {
    if (!a || !b) return false;
    const da = a instanceof Date ? a : parseClinicDate(a);
    const db = b instanceof Date ? b : parseClinicDate(b);
    return !Number.isNaN(da.getTime()) && !Number.isNaN(db.getTime()) && iso(da) === iso(db);
  };
  const statusClass = status => {
    const s = String(status || '').trim();
    if (s === 'Completed') return 'completed success';
    if (['Cancelled', 'No-Show', 'No Show'].includes(s)) return 'cancelled danger';
    if (['Checked In', 'In Progress', 'Started', 'Ongoing'].includes(s)) return 'progress checked warning';
    return 'scheduled info';
  };
  const statusLabelClass = status => {
    const s = String(status || '').trim();
    if (s === 'Completed') return 'success';
    if (['Cancelled', 'No-Show', 'No Show'].includes(s)) return 'danger';
    if (['Checked In', 'In Progress', 'Started', 'Ongoing'].includes(s)) return 'warning';
    return 'info';
  };

  function rangeForView(){
    if(view==='month') return {start:new Date(anchor.getFullYear(),anchor.getMonth(),1,12),end:new Date(anchor.getFullYear(),anchor.getMonth()+1,0,12)};
    const start=monday(anchor), end=new Date(start); end.setDate(start.getDate()+5); return {start,end};
  }
  const activeBlocks = () => calendarBlocks.filter(block => !dentistFilter?.value || String(block.dentist_id) === String(dentistFilter.value));
  function blockCoversHour(block,day,h){
    const start=parseClinicDate(block.starts_at), end=parseClinicDate(block.ends_at);
    const slotStart=new Date(day); slotStart.setHours(h,0,0,0);
    const slotEnd=new Date(day); slotEnd.setHours(h+1,0,0,0);
    return start < slotEnd && end > slotStart;
  }
  function blockCoversDay(block,day){
    const start=parseClinicDate(block.starts_at), end=parseClinicDate(block.ends_at);
    const dayStart=new Date(day); dayStart.setHours(0,0,0,0);
    const dayEnd=new Date(day); dayEnd.setHours(23,59,59,999);
    return start <= dayEnd && end >= dayStart;
  }
  function periodAppointments(){
    const {start,end}=rangeForView(), from=iso(start), to=iso(end);
    return calendarAppointments.filter(a=>{ const d=a.starts_at?iso(parseClinicDate(a.starts_at)):''; return d>=from&&d<=to; }).sort((a,b)=>parseClinicDate(a.starts_at)-parseClinicDate(b.starts_at));
  }
  function periodBlocks(){
    const {start,end}=rangeForView(); const rs=new Date(start);rs.setHours(0,0,0,0); const re=new Date(end);re.setHours(23,59,59,999);
    return activeBlocks().filter(b=>parseClinicDate(b.starts_at)<=re&&parseClinicDate(b.ends_at)>=rs).sort((a,b)=>parseClinicDate(a.starts_at)-parseClinicDate(b.starts_at));
  }

  function renderMonthRail(){
    if(!monthRail)return;
    if(yearLabel)yearLabel.textContent=String(anchor.getFullYear());
    monthRail.innerHTML=monthNames.map((name,index)=>{
      const count=calendarAppointments.filter(a=>{if(!a.starts_at)return false;const d=parseClinicDate(a.starts_at);return d.getFullYear()===anchor.getFullYear()&&d.getMonth()===index;}).length;
      return `<button type="button" class="admin-month-rail-item ${index===anchor.getMonth()?'active':''}" data-admin-rail-month="${index}"><span>${name}</span><small>${count||''}</small></button>`;
    }).join('');
  }

  function renderAgenda(){
    let appointments=periodAppointments(), blocks=periodBlocks();
    if(selectedDate){appointments=appointments.filter(a=>sameDay(a.starts_at,selectedDate));blocks=blocks.filter(b=>blockCoversDay(b,selectedDate));}
    const labelDate=selectedDate?selectedDate.toLocaleDateString('en-US',{weekday:'long',month:'short',day:'numeric'}):(view==='month'?`${monthNames[anchor.getMonth()]} ${anchor.getFullYear()}`:'This week');
    if(agendaLabel)agendaLabel.textContent=labelDate;
    const items=[];
    appointments.forEach(a=>{
      const starts=parseClinicDate(a.starts_at), patient=a.patient?.name||a.guest_name||'Guest patient', service=a.service?.name||'Appointment', dentist=a.dentist?.name||dentistNames[a.dentist_id]||'Unassigned';
      items.push({when:starts,html:`<button class="admin-calendar-agenda-item ${statusClass(a.status)}" data-admin-event data-appointment-id="${a.id}" type="button"><span class="agenda-status-dot"></span><span class="agenda-time"><strong>${escapeHtml(fmtTime(starts))}</strong><small>${escapeHtml(starts.toLocaleDateString('en-US',{month:'short',day:'numeric'}))}</small></span><span class="agenda-copy"><strong>${escapeHtml(patient)}</strong><small>${escapeHtml(service)} · ${escapeHtml(dentist)}</small></span><span class="status ${statusLabelClass(a.status)}">${escapeHtml(a.status)}</span></button>`});
    });
    blocks.forEach(block=>{
      const starts=parseClinicDate(block.starts_at), ends=parseClinicDate(block.ends_at), dentist=dentistNames[block.dentist_id]||`Dentist #${block.dentist_id}`;
      const timeText=iso(starts)===iso(ends)?`${fmtTime(starts)}–${fmtTime(ends)}`:'Multi-day';
      items.push({when:starts,html:`<div class="admin-calendar-agenda-item calendar-block-agenda"><span class="agenda-status-dot"></span><span class="agenda-time"><strong>${escapeHtml(timeText)}</strong><small>${escapeHtml(starts.toLocaleDateString('en-US',{month:'short',day:'numeric'}))}</small></span><span class="agenda-copy"><strong>Unavailable · ${escapeHtml(dentist)}</strong><small>${escapeHtml(block.reason||'Blocked schedule')}</small></span><span class="status info">Unavailable</span></div>`});
    });
    items.sort((a,b)=>a.when-b.when);
    agenda.innerHTML=items.length?items.map(x=>x.html).join(''):'<div class="admin-calendar-agenda-empty"><strong>No schedule records</strong><span>No appointments or unavailable schedules match this period.</span></div>';
  }

  function renderWeek(){
    const start=monday(anchor); const days=Array.from({length:6},(_,i)=>{const d=new Date(start);d.setDate(start.getDate()+i);return d;});
    title.textContent=`${days[0].toLocaleDateString('en-US',{month:'short',day:'numeric'})} – ${days[5].toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'})}`;
    let html='<div class="calendar-time calendar-corner">Time</div>'+days.map(d=>`<button class="calendar-day admin-calendar-day ${selectedDate&&iso(selectedDate)===iso(d)?'selected-day':''}" data-date="${iso(d)}" type="button"><span>${d.toLocaleDateString('en-US',{weekday:'short'})}</span><strong>${d.getDate()}</strong></button>`).join('');
    hours.forEach(h=>{
      const timeDate=new Date(2000,0,1,h,0,0); html+=`<div class="calendar-time">${fmtTime(timeDate)}</div>`;
      days.forEach(d=>{
        const events=calendarAppointments.filter(a=>{const x=parseClinicDate(a.starts_at);return a.starts_at&&sameDay(x,d)&&x.getHours()===h;}).sort((a,b)=>parseClinicDate(a.starts_at)-parseClinicDate(b.starts_at));
        const block=activeBlocks().find(b=>blockCoversHour(b,d,h));
        if(events.length){
          html+=`<div class="calendar-slot admin-calendar-event-stack">${events.map(e=>`<button class="admin-calendar-event ${statusClass(e.status)}" data-admin-event data-appointment-id="${e.id}" type="button"><strong>${escapeHtml(e.patient?.name||e.guest_name||'Guest patient')}</strong><small>${escapeHtml(e.service?.name||'Appointment')}</small><span>${escapeHtml(e.status)}</span></button>`).join('')}</div>`;
        } else if(block){
          html+=`<div class="calendar-slot blocked admin-calendar-blocked"><strong>Unavailable</strong><small>${escapeHtml(dentistNames[block.dentist_id]||'Dentist')} · ${escapeHtml(block.reason||'Blocked')}</small></div>`;
        } else if(h===17){html+='<div class="calendar-slot calendar-closing"><small>Clinic close</small></div>';}
        else{html+=`<button class="calendar-slot admin-empty-slot" data-slot="${iso(d)} · ${fmtTime(timeDate)}" data-slot-date="${iso(d)}" type="button"><span>+</span></button>`;}
      });
    });
    weekGrid.innerHTML=html;
  }

  function renderMonth(){
    const y=anchor.getFullYear(),m=anchor.getMonth(); title.textContent=`${monthNames[m]} ${y}`;
    const first=new Date(y,m,1),count=new Date(y,m+1,0).getDate(),offset=first.getDay();
    let html=['Sun','Mon','Tue','Wed','Thu','Fri','Sat'].map(day=>`<div class="month-weekday">${day}</div>`).join('');
    const previousCount=new Date(y,m,0).getDate(); for(let i=0;i<offset;i++)html+=`<div class="month-day muted"><strong>${previousCount-offset+i+1}</strong></div>`;
    for(let day=1;day<=count;day++){
      const d=new Date(y,m,day,12),rows=calendarAppointments.filter(a=>a.starts_at&&sameDay(a.starts_at,d)),blocks=activeBlocks().filter(b=>blockCoversDay(b,d));
      const isToday=iso(d)===iso(new Date()),isSelected=selectedDate&&iso(selectedDate)===iso(d);
      const dots=rows.slice(0,2).map(a=>`<i class="month-event-dot ${statusClass(a.status)}" title="${escapeHtml(a.status)}"></i>`).join('')+(blocks.length?'<i class="month-event-dot blocked" title="Unavailable"></i>':'');
      const summary=blocks.length?`${rows.length?rows.length+' appt · ':''}Unavailable`:rows.length?`${rows.length} appointment${rows.length===1?'':'s'}`:'Open schedule';
      html+=`<button class="month-day ${isToday?'today':''} ${isSelected?'selected-day':''}" data-admin-month-date="${iso(d)}" type="button"><strong>${day}</strong><span>${summary}</span><div class="month-event-dots">${dots}</div></button>`;
    }
    const cells=offset+count,tail=(7-(cells%7))%7;for(let i=1;i<=tail;i++)html+=`<div class="month-day muted"><strong>${i}</strong></div>`;
    monthGrid.innerHTML=html;
  }

  function renderUnavailableList(){
    if(!availabilityTable)return;
    const rows=activeBlocks().slice().sort((a,b)=>parseClinicDate(a.starts_at)-parseClinicDate(b.starts_at));
    if(!rows.length){availabilityTable.innerHTML='<div class="availability-empty-state"><strong>No unavailable schedules</strong><span>Blocked dentist schedules will appear here.</span></div>';return;}
    availabilityTable.innerHTML=rows.map(block=>{
      const start=parseClinicDate(block.starts_at),end=parseClinicDate(block.ends_at),same=iso(start)===iso(end),dentist=dentistNames[block.dentist_id]||`Dentist #${block.dentist_id}`;
      const dateText=same?start.toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'}):`${start.toLocaleDateString('en-GB',{day:'2-digit',month:'short'})}–${end.toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'})}`;
      const timeText=same?`${fmtTime(start)}–${fmtTime(end)}`:'<span class="badge info">Multi-day</span>';
      return `<article class="availability-record"><div><small>Dentist</small><strong>${escapeHtml(dentist)}</strong></div><div><small>Date</small><strong>${escapeHtml(dateText)}</strong></div><div><small>Time</small><strong>${timeText}</strong></div><div><small>Reason</small><strong>${escapeHtml(block.reason||'Unavailable')}</strong></div></article>`;
    }).join('');
  }

  function renderAll(){
    weekWrap.hidden=view!=='week';monthGrid.hidden=view!=='month';
    document.querySelectorAll('[data-admin-calendar-view]').forEach(b=>b.classList.toggle('active',b.dataset.adminCalendarView===view));
    renderMonthRail();if(view==='week')renderWeek();else renderMonth();renderAgenda();renderUnavailableList();
  }

  async function populateDentists(){
    if(!dentistFilter)return;
    try{const res=await fetch('/api/public/dentists',{headers:{Accept:'application/json'}});if(!res.ok)return;const dentists=await res.json();dentistNames=Object.fromEntries(dentists.map(d=>[String(d.id),d.name]));const current=dentistFilter.value;dentistFilter.innerHTML='<option value="">All dentists</option>'+dentists.map(d=>`<option value="${d.id}">${escapeHtml(d.name)}</option>`).join('');if(current)dentistFilter.value=current;}catch(error){console.error(error);}
  }

  async function loadCalendar(){
    const year = anchor.getFullYear();
    const params = new URLSearchParams({
      from: `${year}-01-01`,
      to: `${year}-12-31`,
      calendar: '1',
      per_page: '200'
    });
    if (document.body.dataset.workspaceView === 'dentist') params.set('view', 'dentist');
    if (dentistFilter?.value) params.set('dentist_id', dentistFilter.value);
    agenda.innerHTML = '<p class="muted">Loading schedule…</p>';
    const rows = [];
    let page = 1, lastPage = 1;
    do {
      params.set('page', String(page));
      const response = await fetch(`/api/appointments?${params}`, { headers: { Accept: 'application/json' } });
      if (!response.ok) throw new Error('Calendar appointments could not be loaded.');
      const payload = await response.json();
      rows.push(...(payload.data || []));
      lastPage = Math.max(1, Number(payload.last_page || 1));
      page += 1;
    } while (page <= lastPage);
    calendarAppointments = rows;
    try {
      const blockRes = await fetch('/api/blocks?per_page=100', { headers: { Accept: 'application/json' } });
      if (blockRes.ok) {
        const payload = await blockRes.json();
        calendarBlocks = payload.data || [];
      }
    } catch (error) {
      console.warn('Unavailable schedules could not be loaded.', error);
    }
    renderAll();
  }
  window.refreshAdminCalendar = () => loadCalendar().catch(console.error);

  document.querySelectorAll('[data-admin-calendar-view]').forEach(button => button.addEventListener('click', () => {
    view = button.dataset.adminCalendarView;
    selectedDate = null;
    renderAll();
  }));
  document.querySelector('[data-admin-calendar-prev]')?.addEventListener('click', () => {
    const oldYear = anchor.getFullYear();
    if (view === 'week') anchor.setDate(anchor.getDate() - 7);
    else anchor.setMonth(anchor.getMonth() - 1);
    selectedDate = null;
    if (anchor.getFullYear() !== oldYear) loadCalendar().catch(console.error);
    else renderAll();
  });
  document.querySelector('[data-admin-calendar-next]')?.addEventListener('click', () => {
    const oldYear = anchor.getFullYear();
    if (view === 'week') anchor.setDate(anchor.getDate() + 7);
    else anchor.setMonth(anchor.getMonth() + 1);
    selectedDate = null;
    if (anchor.getFullYear() !== oldYear) loadCalendar().catch(console.error);
    else renderAll();
  });
  document.querySelector('[data-admin-calendar-today]')?.addEventListener('click', () => {
    const oldYear = anchor.getFullYear();
    anchor = new Date();
    anchor.setHours(12, 0, 0, 0);
    selectedDate = new Date(anchor);
    if (anchor.getFullYear() !== oldYear) loadCalendar().catch(console.error);
    else renderAll();
  });
  document.querySelector('[data-admin-calendar-year-prev]')?.addEventListener('click', () => {
    anchor.setFullYear(anchor.getFullYear() - 1);
    selectedDate = null;
    loadCalendar().catch(console.error);
  });
  document.querySelector('[data-admin-calendar-year-next]')?.addEventListener('click', () => {
    anchor.setFullYear(anchor.getFullYear() + 1);
    selectedDate = null;
    loadCalendar().catch(console.error);
  });
  dentistFilter?.addEventListener('change', () => loadCalendar().catch(console.error));
  monthRail?.addEventListener('click', event => {
    const button = event.target.closest('[data-admin-rail-month]');
    if (!button) return;
    anchor.setMonth(Number(button.dataset.adminRailMonth), 1);
    view = 'month';
    document.querySelectorAll('[data-admin-calendar-view]').forEach(b => b.classList.toggle('active', b.dataset.adminCalendarView === 'month'));
    selectedDate = null;
    renderAll();
  });
  weekGrid.addEventListener('click',event=>{const appointment=event.target.closest('[data-admin-event]');if(appointment){window.openAdminAppointment?.(appointment.dataset.appointmentId);return;}const day=event.target.closest('[data-date]');if(day){selectedDate=new Date(`${day.dataset.date}T12:00:00`);if(note)note.textContent=`Selected date: ${selectedDate.toLocaleDateString('en-US',{weekday:'long',month:'long',day:'numeric',year:'numeric'})}`;renderAll();return;}const slot=event.target.closest('[data-slot]');if(slot){selectedDate=new Date(`${slot.dataset.slotDate}T12:00:00`);if(note)note.textContent='Selected schedule: '+slot.dataset.slot;renderAll();}});
  monthGrid.addEventListener('click',event=>{const day=event.target.closest('[data-admin-month-date]');if(!day)return;selectedDate=new Date(`${day.dataset.adminMonthDate}T12:00:00`);if(note)note.textContent=`Selected date: ${selectedDate.toLocaleDateString('en-US',{weekday:'long',month:'long',day:'numeric',year:'numeric'})}`;renderAll();});
  agenda.addEventListener('click',event=>{const appointment=event.target.closest('[data-admin-event]');if(appointment)window.openAdminAppointment?.(appointment.dataset.appointmentId);});

  let calendarLoaded=false;
  let calendarLoading=false;
  async function ensureAdminCalendarLoaded(force=false){
    if(calendarLoading || (calendarLoaded && !force)) return;
    calendarLoading=true;
    try{
      await populateDentists();
      await loadCalendar();
      calendarLoaded=true;
    }catch(error){
      console.error(error);
      agenda.innerHTML='<p class="muted">Unable to load calendar data.</p>';
    }finally{
      calendarLoading=false;
    }
  }
  window.refreshAdminCalendar=()=>ensureAdminCalendarLoaded(true);
  window.addEventListener('cerillo:sectionchange',(event)=>{
    if(event.detail?.sectionId==='calendar') ensureAdminCalendarLoaded();
  });
  const calendarSection=document.getElementById('calendar');
  if(calendarSection?.classList.contains('active-section')) ensureAdminCalendarLoaded();
})();
</script>
<script id="dentitionPixelLayoutFinal">
(function(){
  function apply(root){
    const scope = root && root.querySelectorAll ? root : document;
    scope.querySelectorAll('.premium-dental-chart .odontogram-panel').forEach((panel)=>{
      const visible=panel.querySelector('[data-dentition-grid]:not(.hidden)');
      panel.dataset.dentitionView=visible?.dataset.dentitionGrid || 'permanent';
    });
    scope.querySelectorAll('.premium-dental-chart [data-dentition-grid]').forEach((grid)=>{
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

  document.addEventListener('click',(event)=>{
    const trigger=event.target.closest('[data-dentition], [data-record-tab="chart"]');
    if(!trigger) return;
    const chart=trigger.closest('.premium-dental-chart') || trigger.closest('dialog');
    requestAnimationFrame(()=>apply(chart || document));
  });

  if('MutationObserver' in window){
    const observer=new MutationObserver((mutations)=>{
      mutations.forEach((mutation)=>{
        const dialog=mutation.target;
        if(dialog instanceof HTMLDialogElement && dialog.open){
          requestAnimationFrame(()=>apply(dialog));
        }
      });
    });
    document.querySelectorAll('dialog').forEach((dialog)=>observer.observe(dialog,{attributes:true,attributeFilter:['open']}));
  }
})();
</script>
<script id="clinicalPanelHeightSyncFinal">
(function(){
  const observed=new WeakSet();
  const ro=('ResizeObserver' in window) ? new ResizeObserver((entries)=>{
    entries.forEach((entry)=>{
      const workspace=entry.target.closest('.odontogram-workspace');
      if(workspace) syncOne(workspace);
    });
  }) : null;

  function isVisible(el){
    return !!(el && (el.offsetWidth || el.offsetHeight || el.getClientRects().length));
  }
  function syncOne(workspace){
    const left=workspace.querySelector('.odontogram-panel');
    const right=workspace.querySelector('.tooth-detail-panel');
    if(!left||!right||!isVisible(workspace)) return;
    const h=Math.ceil(left.getBoundingClientRect().height);
    if(h>0){
      workspace.style.setProperty('--clinical-panel-height',h+'px');
      right.style.height=h+'px';
      right.style.maxHeight=h+'px';
      if(ro && !observed.has(left)){ observed.add(left); ro.observe(left); }
    }
  }
  function syncVisible(root=document){
    const scope=root && root.querySelectorAll ? root : document;
    scope.querySelectorAll('.premium-dental-chart .odontogram-workspace').forEach(syncOne);
  }
  let resizeFrame=0;
  window.addEventListener('resize',()=>{
    cancelAnimationFrame(resizeFrame);
    resizeFrame=requestAnimationFrame(()=>syncVisible());
  },{passive:true});
  document.addEventListener('click',(event)=>{
    const trigger=event.target.closest('[data-dentition], [data-record-tab="chart"]');
    if(trigger) requestAnimationFrame(()=>requestAnimationFrame(()=>syncVisible(trigger.closest('dialog') || document)));
  });
  if('MutationObserver' in window){
    const observer=new MutationObserver((mutations)=>{
      mutations.forEach((mutation)=>{
        const dialog=mutation.target;
        if(dialog instanceof HTMLDialogElement && dialog.open){
          requestAnimationFrame(()=>requestAnimationFrame(()=>syncVisible(dialog)));
        }
      });
    });
    document.querySelectorAll('dialog').forEach((dialog)=>observer.observe(dialog,{attributes:true,attributeFilter:['open']}));
  }
})();
</script>
<script id="cerilloServiceCatalogAdmin">
const CERILLO_DEFAULT_SERVICES=[{"name": "Comprehensive Dental Examination", "category": "Preventive", "description": "A complete oral assessment covering teeth, gums, bite and treatment needs.", "image": "https://images.pexels.com/photos/6528858/pexels-photo-6528858.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/comprehensive-exam.svg", "duration": "30–45 minutes", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Oral Prophylaxis", "category": "Preventive", "description": "Professional plaque and calculus removal with polishing and preventive guidance.", "image": "https://images.pexels.com/photos/3779706/pexels-photo-3779706.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/oral-prophylaxis.svg", "duration": "45–60 minutes", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Fluoride Treatment", "category": "Preventive", "description": "Topical fluoride application to strengthen enamel and support caries prevention.", "image": "https://images.pexels.com/photos/6528868/pexels-photo-6528868.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/fluoride-treatment.svg", "duration": "15–30 minutes", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Dental Sealants", "category": "Preventive", "description": "Protective resin placed on deep grooves of posterior teeth to reduce decay risk.", "image": "https://images.pexels.com/photos/6528868/pexels-photo-6528868.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/dental-sealants.svg", "duration": "30–45 minutes", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Composite Restoration", "category": "Restorative", "description": "Tooth-colored restoration for teeth affected by decay, wear or minor fracture.", "image": "https://images.pexels.com/photos/3779713/pexels-photo-3779713.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/composite-restoration.svg", "duration": "45–75 minutes", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Dental Crown", "category": "Restorative", "description": "Full-coverage restoration used to protect and rebuild a weakened tooth.", "image": "https://images.pexels.com/photos/6502305/pexels-photo-6502305.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/dental-crown.svg", "duration": "2–3 visits", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Dental Bridge", "category": "Restorative", "description": "Fixed replacement for one or more missing teeth using adjacent support.", "image": "https://images.pexels.com/photos/6502343/pexels-photo-6502343.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/dental-bridge.svg", "duration": "2–4 visits", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Root Canal Treatment", "category": "Endodontics", "description": "Removal of infected pulp tissue followed by cleaning, shaping and sealing of canals.", "image": "https://images.pexels.com/photos/6529107/pexels-photo-6529107.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/root-canal.svg", "duration": "1–3 visits", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Tooth Extraction", "category": "Oral Surgery", "description": "Removal of a tooth when preservation is not clinically appropriate.", "image": "https://images.pexels.com/photos/6528868/pexels-photo-6528868.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/tooth-extraction.svg", "duration": "30–60 minutes", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Wisdom Tooth Assessment", "category": "Oral Surgery", "description": "Clinical and imaging assessment of third molars with treatment planning when indicated.", "image": "https://images.pexels.com/photos/6528858/pexels-photo-6528858.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/wisdom-tooth.svg", "duration": "30–45 minutes", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Complete & Partial Dentures", "category": "Prosthodontics", "description": "Removable tooth replacement planned around oral anatomy, function and comfort.", "image": "https://images.pexels.com/photos/5622025/pexels-photo-5622025.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/dentures.svg", "duration": "Multiple visits", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Dental Implant Restoration", "category": "Implant Dentistry", "description": "Implant-supported tooth replacement planned after clinical and imaging evaluation.", "image": "https://images.pexels.com/photos/6502305/pexels-photo-6502305.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/implant-restoration.svg", "duration": "30–90 minutes depending on treatment", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Teeth Whitening", "category": "Cosmetic", "description": "Supervised whitening intended to lighten tooth discoloration.", "image": "https://images.pexels.com/photos/5622271/pexels-photo-5622271.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/teeth-whitening.svg", "duration": "60–90 minutes", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Porcelain Veneers", "category": "Cosmetic", "description": "Thin restorations bonded to the front surfaces of selected teeth.", "image": "https://images.pexels.com/photos/5622271/pexels-photo-5622271.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/porcelain-veneers.svg", "duration": "2–3 visits", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Clear Aligners", "category": "Orthodontics", "description": "Removable aligner therapy for selected tooth-alignment and bite concerns.", "image": "https://images.pexels.com/photos/6528907/pexels-photo-6528907.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/clear-aligners.svg", "duration": "Ongoing treatment plan", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Orthodontic Braces", "category": "Orthodontics", "description": "Fixed orthodontic brackets and wires used to gradually align teeth and correct selected bite concerns.", "image": "https://images.pexels.com/photos/3764014/pexels-photo-3764014.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/clear-aligners.svg", "duration": "12–24 months with scheduled adjustment visits", "notes": "Orthodontic braces are the only service eligible for the clinic installment plan. Final fee and installment schedule are confirmed after orthodontic assessment.", "price": "", "status": "Active", "installmentEligible": true}, {"name": "Retainers", "category": "Orthodontics", "description": "Custom appliances used to help maintain tooth position after orthodontic treatment.", "image": "https://images.pexels.com/photos/6528907/pexels-photo-6528907.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/retainers.svg", "duration": "30–45 minutes", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Night Guard", "category": "Occlusion", "description": "Custom occlusal appliance for patients with grinding or clenching concerns.", "image": "https://images.pexels.com/photos/6502345/pexels-photo-6502345.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/night-guard.svg", "duration": "2 visits", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}, {"name": "Periodontal Therapy", "category": "Periodontics", "description": "Gum-focused assessment and non-surgical care based on periodontal findings.", "image": "https://images.pexels.com/photos/3779706/pexels-photo-3779706.jpeg?auto=compress&cs=tinysrgb&w=900", "fallback": "../assets/images/services/periodontal-therapy.svg", "duration": "60–90 minutes", "notes": "Final treatment plan, preparation, aftercare and fee are confirmed after clinical evaluation.", "price": "", "status": "Active", "installmentEligible": false}];
let cerilloEditingServiceIndex=null;
function adminServiceCatalog(){try{return JSON.parse(localStorage.getItem('cerilloServiceCatalogV4')||'null')||CERILLO_DEFAULT_SERVICES;}catch(_){return CERILLO_DEFAULT_SERVICES;}}
function saveAdminServiceCatalog(list){localStorage.setItem('cerilloServiceCatalogV4',JSON.stringify(list));}
function renderAdminServiceCatalog(){const grid=document.querySelector('#services .service-grid');if(!grid)return;const list=adminServiceCatalog();grid.innerHTML=list.map((s,i)=>`<article class="service-card" data-service-index="${i}"><img alt="${s.name}" class="service-photo" src="${s.image||s.fallback||'../assets/images/clinic.jpg'}" loading="lazy" referrerpolicy="no-referrer" onerror="this.onerror=null;this.src='${s.fallback||'../assets/images/clinic.jpg'}'"><span>${s.category}</span><h3>${s.name}</h3><p>${s.description}</p>${s.installmentEligible?'<div class="service-installment-badge">Installment eligible · braces only</div>':''}<button class="action-btn" data-service-details="${i}" type="button">Details</button><button class="btn btn-secondary service-edit-btn" data-service-edit="${i}" type="button">Edit</button></article>`).join('');}
function fillServiceCrud(i){cerilloEditingServiceIndex=i;const list=adminServiceCatalog(),s=i==null?{name:'',category:'Preventive',description:'',duration:'',notes:'',price:'',status:'Active',image:'',fallback:'',installmentEligible:false}:list[i];serviceCrudName.value=s.name||'';serviceCrudCategory.value=s.category||'Preventive';serviceCrudPrice.value=s.price||'';serviceCrudDuration.value=s.duration||'';serviceCrudDescription.value=s.description||'';serviceCrudNotes.value=s.notes||'';serviceCrudStatus.value=s.status||'Active';document.getElementById('serviceCrudModal').showModal();}
function openAdminServiceDetails(i){const s=adminServiceCatalog()[i];if(!s)return;const d=document.getElementById('serviceModal');d.querySelector('h3').textContent=s.name;const intro=d.querySelector('.modal-head p:last-child');if(intro)intro.textContent=s.description;const imgs=d.querySelectorAll('.media-mosaic img');imgs.forEach(img=>{img.src=s.image||s.fallback||'../assets/images/clinic.jpg';img.alt=s.name;});const facts=d.querySelectorAll('.service-fact strong');if(facts[0])facts[0].textContent=s.duration||'Varies by treatment';if(facts[1])facts[1].textContent=s.category==='Orthodontics'?'Ongoing scheduled visits':'Depends on clinical plan';if(facts[2])facts[2].textContent='Discussed after examination and treatment planning';if(facts[3])facts[3].textContent=s.notes||'Preparation is discussed after evaluation.';d.showModal();}
document.addEventListener('click',e=>{const edit=e.target.closest('[data-service-edit]');if(edit)fillServiceCrud(Number(edit.dataset.serviceEdit));const details=e.target.closest('[data-service-details]');if(details)openAdminServiceDetails(Number(details.dataset.serviceDetails));if(e.target.closest('#addServiceBtn')){e.preventDefault();fillServiceCrud(null);}});
document.getElementById('saveServiceCrud')?.addEventListener('click',async()=>{const list=adminServiceCatalog();let image=cerilloEditingServiceIndex==null?'':(list[cerilloEditingServiceIndex]?.image||'');const file=serviceCrudImages.files?.[0];if(file)image=await new Promise(r=>{const fr=new FileReader();fr.onload=()=>r(fr.result);fr.readAsDataURL(file);});const obj={name:serviceCrudName.value.trim(),category:serviceCrudCategory.value,price:serviceCrudPrice.value,duration:serviceCrudDuration.value.trim(),description:serviceCrudDescription.value.trim(),notes:serviceCrudNotes.value.trim(),status:serviceCrudStatus.value,image,fallback:'../assets/images/services/comprehensive-exam.svg',installmentEligible:/braces/i.test(serviceCrudName.value)};if(!obj.name||!obj.description)return;if(cerilloEditingServiceIndex==null)list.push(obj);else list[cerilloEditingServiceIndex]=obj;saveAdminServiceCatalog(list);renderAdminServiceCatalog();document.getElementById('serviceCrudModal').close();});
let cerilloServiceCatalogRendered=false;
function ensureAdminServiceCatalogRendered(){
  if(cerilloServiceCatalogRendered) return;
  cerilloServiceCatalogRendered=true;
  renderAdminServiceCatalog();
}
window.addEventListener('cerillo:sectionchange',(event)=>{
  if(event.detail?.sectionId==='services') ensureAdminServiceCatalogRendered();
});
if(document.getElementById('services')?.classList.contains('active-section')) ensureAdminServiceCatalogRendered();
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



<!-- Calendar agenda is rendered by #adminInteractiveCalendar. -->
<script id="guaranteedToothFindingFlow">
(function(){
  const STATUS_CLASSES=['tooth-sound','tooth-decay','tooth-finding','tooth-planned','tooth-completed','tooth-missing','tooth-impacted'];
  const DRAFT_KEY='cerilloConsultationDrafts', BILLING_KEY='cerilloPatientToothBilling';
  let activeTooth=null, activeRecord=null, selectedFinding='';
  function money(v){return new Intl.NumberFormat('en-PH',{style:'currency',currency:'PHP',maximumFractionDigits:2}).format(Number(v||0));}
  function escapeHtml(s){return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');}
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
  function apply(tooth,f){
    tooth.classList.remove(...STATUS_CLASSES);
    tooth.classList.add(cls(f));
    tooth.dataset.finding=f;
    tooth.dataset.condition=f;
    if(typeof window.updateToothFindingBelow==='function'){
      window.updateToothFindingBelow(tooth, f);
    }
  }
  function invoiceDesc(x){return x?.type==='consultation-invoice'?'Dental consultation · '+(x.items?.length||0)+' procedure'+((x.items?.length||0)===1?'':'s'):'Tooth #'+x.tooth+' · '+x.procedure+' — '+x.finding;}
  function addLedger(r,x){const table=r?.querySelector('[data-patient-ledger]');if(!table?.tBodies?.[0]||table.querySelector('[data-tooth-charge-id="'+x.id+'"]'))return;const tr=document.createElement('tr');tr.dataset.toothChargeId=x.id;tr.innerHTML='<td>'+new Date(x.createdAt).toLocaleDateString(undefined,{day:'2-digit',month:'short',year:'numeric'})+'</td><td>'+x.reference+'</td><td>'+invoiceDesc(x)+'</td><td>'+money(x.price)+'</td><td>—</td><td>'+money(x.price)+'</td>';table.tBodies[0].appendChild(tr);const amt=Number(x.price||0);r.querySelectorAll('.ledger-summary article').forEach(card=>{const label=(card.querySelector('span')?.textContent||'').trim().toLowerCase(),strong=card.querySelector('strong');if(!strong)return;if(label.includes('total charges')||label.includes('outstanding')){const current=Number((strong.textContent||'').replace(/[^0-9.-]/g,''))||0;strong.textContent=money(current+amt);}});}
  function ensurePopups(r){
    let f=r.querySelector(':scope > [data-local-tooth-finding]');
    if(!f){
      f=document.createElement('div');
      f.className='tooth-local-popup tooth-local-finding';
      f.dataset.localToothFinding='';
      f.hidden=true;
      f.innerHTML=`<div class="tooth-flow-head"><div><small>Dental chart</small><strong data-local-tooth-title>Selected tooth</strong></div><button type="button" class="icon-btn" data-local-find-close>×</button></div><div class="tooth-flow-body"><label class="tooth-flow-label">Finding / condition<select data-local-finding-select><option value="">Select finding...</option><option value="Sound / Healthy">/</option><option value="Missing / Extracted">M</option><option value="Unerupted">Un</option><option value="Present">P</option><option value="Root Fragment">RF</option><option value="Amalgam Restoration">Am</option><option value="Composite Restoration">Co</option><option value="Extraction Indicated">X</option><option value="Observation">O</option><option value="Temporary Filling">TF</option><option value="Dentinal Caries">C</option><option value="Root Canal Treated">RCT</option><option value="Impacted">Im</option><option value="Jacket Crown">Jc</option><option value="Glass Ionomer">GI</option><option value="Sealant">S</option><option value="Erupted">ER</option><option value="3/Q">3/Q</option><option value="Metal Crown">MC</option><option value="Partially Erupted">PE</option><option value="Treatment Planned">TP</option><option value="QC">QC</option></select></label><p class="tooth-flow-help">Choose the clinical finding for this tooth. Billable findings continue to treatment plan.</p></div>`;
      r.appendChild(f);
    }
    let c=r.querySelector(':scope > [data-local-tooth-charge]');
    if(!c){
      c=document.createElement('div');
      c.className='tooth-local-popup tooth-local-charge';
      c.dataset.localToothCharge='';
      c.hidden=true;
      c.innerHTML=`<div class="tooth-flow-head"><div><small>Treatment plan</small><strong data-local-charge-title>Selected tooth</strong></div><button type="button" class="icon-btn" data-local-charge-close>×</button></div><div class="tooth-flow-body"><div class="tooth-flow-summary"><span>Finding</span><strong data-local-charge-finding>—</strong></div><label class="tooth-flow-label">Treatment / procedure<select data-local-charge-procedure><option>Composite Restoration</option><option>Root Canal Treatment</option><option>Dental Crown</option><option>Tooth Extraction</option><option>Surgical Extraction</option><option>Restorative Treatment</option><option>Observation / Review</option><option>Other Dental Procedure</option></select></label><div class="tooth-flow-message" data-local-charge-message></div><small class="tooth-billing-note">Adds tooth to the Treatment Invoice Draft where pricing and notes are decided.</small></div><div class="tooth-flow-actions"><button type="button" class="btn secondary" data-local-charge-cancel>Cancel</button><button type="button" class="btn" data-local-charge-save>Add to treatment draft</button></div>`;
      r.appendChild(c);
    }
    return{finding:f,charge:c};
  }
  function hide(p){if(p){p.hidden=true;p.classList.remove('is-visible');}}
  function pos(p,tooth,r){p.hidden=false;p.classList.add('is-visible');p.style.left='0';p.style.top='0';requestAnimationFrame(()=>{const rr=r.getBoundingClientRect(),tr=tooth.getBoundingClientRect(),pr=p.getBoundingClientRect(),pad=14,g=10;let l=tr.left-rr.left+tr.width/2-pr.width/2,t=tr.bottom-rr.top+g;if(t+pr.height>rr.height-pad)t=tr.top-rr.top-pr.height-g;l=Math.max(pad,Math.min(l,rr.width-pr.width-pad));t=Math.max(pad,Math.min(t,rr.height-pr.height-pad));p.style.left=Math.round(l)+'px';p.style.top=Math.round(t)+'px';});}
  function openFinding(tooth){const r=tooth.closest('dialog.clinical-record-modal');if(!r)return;activeTooth=tooth;activeRecord=r;selectedFinding='';const p=ensurePopups(r);hide(p.charge);p.finding.querySelector('[data-local-tooth-title]').textContent='Tooth #'+tooth.dataset.tooth+' · '+(tooth.dataset.toothName||'');const s=p.finding.querySelector('[data-local-finding-select]');s.value='';pos(p.finding,tooth,r);setTimeout(()=>s.focus(),30);}
  function openCharge(f){const p=ensurePopups(activeRecord);selectedFinding=f;hide(p.finding);p.charge.querySelector('[data-local-charge-title]').textContent='Tooth #'+activeTooth.dataset.tooth+' · '+(activeTooth.dataset.toothName||'');p.charge.querySelector('[data-local-charge-finding]').textContent=f;p.charge.querySelector('[data-local-charge-procedure]').value=proc(f);pos(p.charge,activeTooth,activeRecord);}
  function ensureCart(r){
    if(!r) return null;
    const isAppointmentModal = r.id === 'dentistAppointmentDetailModal' || r.id === 'adminAppointmentModal' || r.id === 'patientViewModal';
    const isAssessmentStarted = isAppointmentModal && (
      r.dataset.assessmentStarted === 'true' ||
      (r.dataset.appointmentStatus || '').toLowerCase() === 'in progress' ||
      (r.querySelector('[data-da-status]')?.textContent?.trim() || '').toLowerCase() === 'in progress' ||
      (r.querySelector('[data-pa-status-badge]')?.textContent?.trim() || '').toLowerCase() === 'in progress'
    );
    const panel=r.querySelector('[data-record-panel="chart"]');
    if(!panel) return null;
    let c=panel.querySelector('[data-consultation-cart]');
    if(!c){
      c=document.createElement('section');
      c.className='consultation-cart-panel';
      c.dataset.consultationCart='';
      c.innerHTML=`<div class="consultation-cart-head"><div><span class="consultation-cart-kicker">Current consultation</span><h4>Treatment invoice draft</h4><p>Add multiple tooth procedures before posting one invoice.</p></div><div class="consultation-cart-total"><small>Running total</small><strong data-consultation-total>₱0.00</strong></div></div><div class="consultation-cart-items" data-consultation-items></div><div class="consultation-cart-footer"><span data-consultation-count>0 procedures</span><div><button class="btn secondary compact" type="button" data-consultation-clear>Clear draft</button><button class="btn compact" type="button" data-consultation-finish disabled>Finish Consultation</button></div></div>`;
      const w=panel.querySelector('.odontogram-workspace');
      w?w.insertAdjacentElement('afterend',c):panel.appendChild(c);
    }
    if (!isAppointmentModal || !isAssessmentStarted) {
      c.style.display = 'none';
      c.hidden = true;
    } else {
      c.style.display = '';
      c.hidden = false;
    }
    return c;
  }
  function renderCart(r){
    if(!r) return;
    const isAppointmentModal = r.id === 'dentistAppointmentDetailModal' || r.id === 'adminAppointmentModal' || r.id === 'patientViewModal';
    const isAssessmentStarted = isAppointmentModal && (
      r.dataset.assessmentStarted === 'true' ||
      (r.dataset.appointmentStatus || '').toLowerCase() === 'in progress' ||
      (r.querySelector('[data-da-status]')?.textContent?.trim() || '').toLowerCase() === 'in progress' ||
      (r.querySelector('[data-pa-status-badge]')?.textContent?.trim() || '').toLowerCase() === 'in progress'
    );
    const c=ensureCart(r);
    if(!c) return;
    if (!isAppointmentModal || !isAssessmentStarted) {
      c.style.display = 'none';
      c.hidden = true;
      return;
    }
    c.style.display = '';
    c.hidden = false;
    const d=draft(r),items=d.items||[],total=items.reduce((s,x)=>s+Number(x.price||0),0),h=c.querySelector('[data-consultation-items]');
    h.innerHTML=items.length?items.map((x,i)=>`
      <article class="consultation-cart-item" style="display:flex;flex-direction:column;gap:8px;padding:10px;border-bottom:1px solid #e2e8f0;">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
          <div>
            <strong>Tooth #${escapeHtml(x.tooth)} · ${escapeHtml(x.procedure)}</strong>
            <span style="display:block;font-size:12px;color:#64748b;">Finding: ${escapeHtml(x.finding)}</span>
          </div>
          <button class="icon-btn" type="button" data-consultation-remove="${i}" title="Remove procedure" style="border:none;background:transparent;cursor:pointer;color:#94a3b8;font-size:16px;padding:2px 6px;line-height:1;">×</button>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1.5fr;gap:8px;align-items:center;">
          <div>
            <label style="display:block;font-size:11px;font-weight:600;color:#475569;margin-bottom:2px;">Price (₱)</label>
            <input type="text" inputmode="decimal" data-cart-price-index="${i}" value="${x.price !== undefined ? escapeHtml(x.price) : ''}" placeholder="0.00" style="width:100%;padding:4px 8px;border:1px solid #cbd5e1;border-radius:4px;font-size:13px;box-sizing:border-box;">
          </div>
          <div>
            <label style="display:block;font-size:11px;font-weight:600;color:#475569;margin-bottom:2px;">Notes (optional)</label>
            <input type="text" data-cart-notes-index="${i}" value="${x.notes ? escapeHtml(x.notes) : ''}" placeholder="Clinical / billing note" style="width:100%;padding:4px 8px;border:1px solid #cbd5e1;border-radius:4px;font-size:13px;box-sizing:border-box;">
          </div>
        </div>
      </article>
    `).join(''):'<div class="consultation-cart-empty">No billable tooth procedures added yet.</div>';
    c.querySelector('[data-consultation-total]').textContent=money(total);
    c.querySelector('[data-consultation-count]').textContent=items.length+' procedure'+(items.length===1?'':'s');
    c.querySelector('[data-consultation-finish]').disabled=!items.length;
    c.querySelector('[data-consultation-clear]').disabled=!items.length;
  }
  function summary(r){let o=r.querySelector(':scope > [data-consultation-summary]');if(!o){o=document.createElement('div');o.className='consultation-summary-overlay';o.dataset.consultationSummary='';o.hidden=true;o.innerHTML=`<section class="consultation-summary-card"><header><div><span class="consultation-cart-kicker">Consultation complete</span><h3>Review treatment summary</h3><p data-consultation-patient></p></div><button class="icon-btn" type="button" data-consultation-summary-close>×</button></header><div class="consultation-summary-body"><div class="consultation-summary-table-wrap"><table><thead><tr><th>Tooth</th><th>Finding</th><th>Procedure</th><th>Price</th></tr></thead><tbody data-consultation-summary-items></tbody></table></div><div class="consultation-summary-total"><span>Total consultation charges</span><strong data-consultation-summary-total>₱0.00</strong></div><p class="consultation-summary-note">Submitting creates one invoice and posts the total to the patient balance.</p></div><footer><button class="btn secondary" type="button" data-consultation-summary-back>Back to chart</button><button class="btn" type="button" data-consultation-submit>Submit to Patient Balance</button></footer></section>`;r.appendChild(o);}return o;}
  function openSummary(r){const d=draft(r);if(!d.items?.length)return;const o=summary(r);o.querySelector('[data-consultation-patient]').textContent=(r.dataset.patientName||'Patient')+' · '+(r.dataset.patientId||'');o.querySelector('[data-consultation-summary-items]').innerHTML=d.items.map(x=>`<tr><td>#${escapeHtml(x.tooth)}</td><td>${escapeHtml(x.finding)}</td><td>${escapeHtml(x.procedure)}</td><td>${money(x.price||0)}</td></tr>`).join('');o.querySelector('[data-consultation-summary-total]').textContent=money(d.items.reduce((s,x)=>s+Number(x.price||0),0));o.hidden=false;o.classList.add('is-visible');}
  function closeSummary(r){const o=r?.querySelector(':scope > [data-consultation-summary]');if(o){o.classList.remove('is-visible');o.hidden=true;}}
  function finish(r){const d=draft(r),items=d.items||[];if(!items.length)return;const total=items.reduce((s,x)=>s+Number(x.price||0),0),now=new Date(),ref='INV-'+now.toISOString().slice(0,10).replace(/-/g,'')+'-'+String(Date.now()).slice(-4),x={id:'CI-'+Date.now(),reference:ref,type:'consultation-invoice',patientId:r.dataset.patientId||'',patientName:r.dataset.patientName||'',tooth:'Multiple',finding:'Consultation',procedure:'Dental Consultation',price:total,notes:items.length+' dental procedures',items:items.map(i=>({...i})),createdAt:now.toISOString(),status:'Unpaid'};const list=charges();list.push(x);saveCharges(list);addLedger(r,x);clearDraft(r);closeSummary(r);}
  function addItem(r,item){const d=draft(r);d.items=d.items||[];const n=d.items.findIndex(x=>String(x.tooth)===String(item.tooth)&&x.procedure===item.procedure);n>=0?d.items[n]=item:d.items.push(item);saveDraft(r,d);}
  function removeTooth(r,tooth){const d=draft(r);d.items=(d.items||[]).filter(x=>String(x.tooth)!==String(tooth));saveDraft(r,d);}

  document.addEventListener('click',e=>{
    const t=e.target.closest('.clinical-record-modal .tooth-unit');
    if(!t) return;
    const modal = t.closest('#dentistAppointmentDetailModal, #patientViewModal, dialog.clinical-record-modal');
    if(!modal) return;
    const isStarted = modal.dataset.openedFromAppointment === 'true' ||
                      modal.dataset.assessmentStarted === 'true' ||
                      (modal.dataset.appointmentStatus || '').toLowerCase() === 'in progress' ||
                      (modal.querySelector('[data-da-status]')?.textContent?.trim() || '').toLowerCase() === 'in progress' ||
                      (modal.querySelector('[data-pa-status-badge]')?.textContent?.trim() || '').toLowerCase() === 'in progress';
    if (!isStarted) return;

    const toothNum=t.dataset.tooth||t.textContent.trim();
    const toothName=t.dataset.toothName||'';
    modal.querySelectorAll('.clinical-details-tooth').forEach(el=>{
      el.textContent='Tooth #'+toothNum;
    });
    modal.querySelectorAll('.chart-history-heading h4').forEach(el=>{
      el.textContent='Cross-referenced history · Tooth #'+toothNum+(toothName?' · '+toothName:'');
    });
    e.preventDefault();
    e.stopImmediatePropagation();
    openFinding(t);
  },true);

  // Price input filter (valid numbers and decimals only) & notes listener
  document.addEventListener('input',e=>{
    const priceInput=e.target.closest('[data-cart-price-index]');
    if(priceInput){
      const clean=priceInput.value.replace(/[^0-9.]/g,'').replace(/(\..*?)\..*/g,'$1');
      if(priceInput.value!==clean){
        priceInput.value=clean;
      }
      const idx=Number(priceInput.dataset.cartPriceIndex);
      const r=priceInput.closest('dialog')||activeRecord;
      if(r){
        const d=draft(r);
        if(d.items&&d.items[idx]){
          d.items[idx].price=clean;
          const total=d.items.reduce((s,x)=>s+Number(x.price||0),0);
          const cart=ensureCart(r);
          if(cart){
            const totEl=cart.querySelector('[data-consultation-total]');
            if(totEl) totEl.textContent=money(total);
          }
          const s=read(DRAFT_KEY,{});
          s[pkey(r)]={...d,patientId:r.dataset.patientId||'',patientName:r.dataset.patientName||'',updatedAt:new Date().toISOString()};
          write(DRAFT_KEY,s);
        }
      }
      return;
    }
    const notesInput=e.target.closest('[data-cart-notes-index]');
    if(notesInput){
      const idx=Number(notesInput.dataset.cartNotesIndex);
      const r=notesInput.closest('dialog')||activeRecord;
      if(r){
        const d=draft(r);
        if(d.items&&d.items[idx]){
          d.items[idx].notes=notesInput.value;
          const s=read(DRAFT_KEY,{});
          s[pkey(r)]={...d,patientId:r.dataset.patientId||'',patientName:r.dataset.patientName||'',updatedAt:new Date().toISOString()};
          write(DRAFT_KEY,s);
        }
      }
      return;
    }
  });

  document.addEventListener('click',e=>{
    const r=e.target.closest('dialog.clinical-record-modal')||activeRecord;
    if(e.target.closest('[data-local-find-close]')){hide(r?.querySelector(':scope > [data-local-tooth-finding]'));return;}
    if(e.target.closest('[data-local-charge-close],[data-local-charge-cancel]')){hide(r?.querySelector(':scope > [data-local-tooth-charge]'));selectedFinding='';return;}
    if(e.target.closest('[data-local-charge-save]')){
      const c=r?.querySelector(':scope > [data-local-tooth-charge]');
      if(!c||!activeTooth||!selectedFinding)return;
      const procedure=c.querySelector('[data-local-charge-procedure]').value.trim();
      apply(activeTooth,selectedFinding);
      activeTooth.dataset.procedure=procedure;
      addItem(r,{
        id:'CD-'+Date.now(),
        tooth:activeTooth.dataset.tooth,
        toothName:activeTooth.dataset.toothName||'',
        finding:selectedFinding,
        procedure:procedure,
        price:'',
        notes:'',
        createdAt:new Date().toISOString()
      });
      hide(c);
      selectedFinding='';
      return;
    }
    const rem=e.target.closest('[data-consultation-remove]');
    if(rem&&r){const d=draft(r);d.items.splice(Number(rem.dataset.consultationRemove),1);saveDraft(r,d);return;}
    if(e.target.closest('[data-consultation-clear]')&&r){if(confirm('Clear the current consultation draft?'))clearDraft(r);return;}
    if(e.target.closest('[data-consultation-finish]')&&r){openSummary(r);return;}
    if(e.target.closest('[data-consultation-summary-close],[data-consultation-summary-back]')&&r){closeSummary(r);return;}
    if(e.target.closest('[data-consultation-submit]')&&r){finish(r);return;}
  });
  document.addEventListener('change',e=>{
    const s=e.target.closest('[data-local-finding-select]');
    if(!s)return;
    const f=s.value;
    if(!f||!activeTooth||!activeRecord)return;
    apply(activeTooth,f);
    if(/sound\s*\/\s*healthy/i.test(f)){
      activeTooth.dataset.procedure='';
      activeTooth.dataset.price='0';
      activeTooth.dataset.notes='';
      removeTooth(activeRecord,activeTooth.dataset.tooth);
      hide(activeRecord.querySelector(':scope > [data-local-tooth-finding]'));
      selectedFinding='';
      return;
    }
    openCharge(f);
  });
  document.addEventListener('close',e=>{
    if(!e.target.matches('dialog.clinical-record-modal'))return;
    hide(e.target.querySelector(':scope > [data-local-tooth-finding]'));
    hide(e.target.querySelector(':scope > [data-local-tooth-charge]'));
    closeSummary(e.target);
    activeTooth=null;
    activeRecord=null;
    selectedFinding='';
  },true);
  document.querySelectorAll('dialog.clinical-record-modal').forEach(r=>renderCart(r));
})();
</script>
<script src="{{ asset('assets/js/admin-dashboard-interactions.js') }}"></script>
<script src="{{ asset('assets/js/dashboard-live.js') }}"></script>
<script src="{{ asset('assets/js/records-live.js') }}"></script>
<script src="{{ asset('assets/js/cerillo-ui-hotfix.js') }}"></script>
<script src="{{ asset('assets/js/dentist-clinical-refinements.js') }}"></script>

<script src="/assets/js/cerillo-responsive.js"></script>
<script src="/assets/js/cerillo-table-pagination.js"></script>

<script src="{{ asset('assets/js/settings-ui.js') }}"></script>
<script src="{{ asset('assets/js/appointment-chart-states.js') }}"></script>
<script defer src="/assets/js/cerillo-patient-pdf.js"></script>
<script defer src="/assets/js/cerillo-report-visit-charts.js"></script>
<script defer src="/assets/js/cerillo-report-details.js"></script>
<script defer src="/assets/js/cerillo-report-export.js"></script>
<script src="{{ asset('assets/js/backup-recovery.js') }}"></script>
</body>
</html>
