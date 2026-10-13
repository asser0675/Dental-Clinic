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
<body class="workspace-body admin-clinical-mode {{ request()->query('view') === 'dentist' ? 'admin-dentist-scope' : 'admin-management-scope' }}" data-workspace-role="admin" data-workspace-view="{{ request()->query('view', 'admin') }}">
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
<div class="admin-module-switcher" aria-label="Admin workspace mode">
<a class="admin-module-toggle {{ request()->query('view') === 'dentist' ? '' : 'active' }}" href="{{ route('workspace', ['view' => 'admin']) }}#dashboard">Admin</a>
<a class="admin-module-toggle {{ request()->query('view') === 'dentist' ? 'active' : '' }}" href="{{ route('workspace', ['view' => 'dentist']) }}#dashboard">Dentist</a>
</div>
<div class="role-label">
    {{ request()->query('view') === 'dentist' ? 'Dentist Modules' : 'Admin Modules' }}
   </div>
<nav aria-label="Admin navigation" class="side-nav">
<a class="side-link" href="#dashboard"><span>Dashboard</span></a>
<a class="side-link" href="#patients"><span>Patient Records</span></a>
<a class="side-link" href="#calendar"><span>Calendar</span></a>
<a class="side-link" href="#appointments"><span>Appointments</span></a>
@if(request()->query('view') !== 'dentist')
<a class="side-link" href="#services"><span>Services &amp; Pricing</span></a>
<a class="side-link" href="#payments"><span>Billing &amp; Payments</span></a>
<a class="side-link" href="#sales"><span>Sales Transactions</span></a>
<a class="side-link" href="#reports"><span>Reports &amp; Analytics</span></a>
<a class="side-link" href="#activity"><span>Activity Logs</span></a>
<a class="side-link" href="#accounts"><span>Accounts</span></a>
@endif
<a class="side-link" href="#settings"><span>Settings</span></a>
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
      {{ request()->query('view') === 'dentist' ? 'Dentist Workspace' : 'Admin Workspace' }}
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
       Clinic overview
      </p>
<h2>
       {{ request()->query('view') === 'dentist' ? 'Dashboard' : 'Admin Dashboard' }}
      </h2>
<p>
       {{ request()->query('view') === 'dentist' ? 'Clinical patients, assigned appointments, and treatment activity for your dentist role.' : 'Daily operations, patient activity, appointments, and collections at a glance.' }}
      </p>
</div>
</div>
@if(request()->query('view') === 'dentist')
<div class="stats-grid admin-dentist-dashboard-kpis">
<article class="stat-card" data-dashboard-metric="completed_today"><p>Completed</p><strong>0</strong><span>Completed appointments today</span></article>
<article class="stat-card" data-dashboard-metric="checked_in_today"><p>Checked In</p><strong>0</strong><span>Patients ready for care</span></article>
<article class="stat-card" data-dashboard-metric="in_progress_today"><p>In Progress</p><strong>0</strong><span>Current clinical cases</span></article>
<article class="stat-card" data-dashboard-metric="cancelled_today"><p>Cancelled</p><strong>0</strong><span>Cancelled today</span></article>
</div>
@else
<div class="metric-strip">
<div class="metric-box" data-dashboard-metric="patients_today">
<small>
       Today's patients
      </small>
<strong>
       26
      </strong>
<span>
       4 waiting
      </span>
</div>
<div class="metric-box" data-dashboard-metric="pending_verifications">
<small>
       Pending confirmations
      </small>
<strong>
       7
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
       18
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
       0
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
       18
      </strong>
<small>
       4 still pending
      </small>
</article>
<article class="stat-card" data-dashboard-metric="total_patients">
<span>
       Active Patients
      </span>
<strong>
       248
      </strong>
<small>
       12 new this month
      </small>
</article>
<article class="stat-card" data-dashboard-metric="collections_today">
<span>
       Today's Collections
      </span>
<strong>
       ₱28,450
      </strong>
<small>
       Across 14 payments
      </small>
</article>
<article class="stat-card" data-dashboard-metric="cancelled_today">
<span>
       Cancelled today
      </span>
<strong>
       0
      </strong>
<small>
       Cancelled or no-show appointments
      </small>
</article>
</div>
@endif
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
         12
        </span>
<div class="bar" style="height: 48%">
</div>
<small>
         Mon
        </small>
</div>
<div class="bar-column">
<span class="bar-value">
         16
        </span>
<div class="bar" style="height: 64%">
</div>
<small>
         Tue
        </small>
</div>
<div class="bar-column">
<span class="bar-value">
         18
        </span>
<div class="bar" style="height: 72%">
</div>
<small>
         Wed
        </small>
</div>
<div class="bar-column">
<span class="bar-value">
         14
        </span>
<div class="bar" style="height: 56%">
</div>
<small>
         Thu
        </small>
</div>
<div class="bar-column">
<span class="bar-value">
         20
        </span>
<div class="bar" style="height: 80%">
</div>
<small>
         Fri
        </small>
</div>
<div class="bar-column">
<span class="bar-value">
         9
        </span>
<div class="bar" style="height: 36%">
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
        94 visits
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
          18
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
          8
         </strong>
</span>
<span>
<i class="dot blue">
</i>
         Checked in
         <strong data-dashboard-status="Checked In">
          4
         </strong>
</span>
<span>
<i class="dot amber">
</i>
         Pending
         <strong data-dashboard-status="Pending">
          4
         </strong>
</span>
<span>
<i class="dot red">
</i>
         Cancelled
         <strong data-dashboard-status="Cancelled">
          2
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
<div>
<span>
         GCash
        </span>
<div>
<i style="width:74%">
</i>
</div>
<strong>
         ₱12,850
        </strong>
</div>
<div>
<span>
         Cash
        </span>
<div>
<i style="width:59%">
</i>
</div>
<strong>
         ₱9,600
        </strong>
</div>
<div>
<span>
         Card
        </span>
<div>
<i style="width:37%">
</i>
</div>
<strong>
         ₱6,000
        </strong>
</div>
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
         2
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
         11
        </strong>
<span>
         Follow-ups due
        </span>
</div>
<div>
<strong>
         6
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
<select id="adminCalendarDentistFilter"><option value="">All dentists</option></select>
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
<strong id="adminCalendarYear">2026</strong>
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
<div>
<span>Agenda</span>
<strong id="adminCalendarAgendaLabel">Current period</strong>
</div>
<small>Click an appointment to view details.</small>
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
         Oct 05 – Oct 09, 2026
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
          Oct 05
         </small>
</div>
<div class="calendar-cell day">
         Tuesday
         <br/>
<small>
          Oct 06
         </small>
</div>
<div class="calendar-cell day">
         Wednesday
         <br/>
<small>
          Oct 07
         </small>
</div>
<div class="calendar-cell day">
         Thursday
         <br/>
<small>
          Oct 08
         </small>
</div>
<div class="calendar-cell day">
         Friday
         <br/>
<small>
          Oct 09
         </small>
</div>
<div class="calendar-cell time">
         9:00 AM
        </div>
<div class="calendar-cell">
<button class="calendar-event" onclick="document.getElementById('appointmentModal').showModal()" type="button">
          John Reyes
          <small>
           Checkup · 45 min
          </small>
</button>
</div>
<div class="calendar-cell">
</div>
<div class="calendar-cell">
<button class="calendar-event" onclick="document.getElementById('appointmentModal').showModal()" type="button">
          Ana Cruz
          <small>
           Cleaning · 60 min
          </small>
</button>
</div>
<div class="calendar-cell">
</div>
<div class="calendar-cell">
<button class="calendar-event amber" onclick="document.getElementById('appointmentModal').showModal()" type="button">
          Mia Santos
          <small>
           Pending · 45 min
          </small>
</button>
</div>
<div class="calendar-cell time">
         10:00 AM
        </div>
<div class="calendar-cell">
<button class="calendar-event amber" onclick="document.getElementById('appointmentModal').showModal()" type="button">
          Carlo Mendoza
          <small>
           Root canal review
          </small>
</button>
</div>
<div class="calendar-cell">
</div>
<div class="calendar-cell">
</div>
<div class="calendar-cell">
<button class="calendar-event" onclick="document.getElementById('appointmentModal').showModal()" type="button">
          Bea Lim
          <small>
           Restoration · 60 min
          </small>
</button>
</div>
<div class="calendar-cell">
</div>
<div class="calendar-cell time">
         11:00 AM
        </div>
<div class="calendar-cell">
</div>
<div class="calendar-cell">
<button class="calendar-event green" onclick="document.getElementById('appointmentModal').showModal()" type="button">
          Nina Lopez
          <small>
           Completed · Cleaning
          </small>
</button>
</div>
<div class="calendar-cell">
</div>
<div class="calendar-cell">
</div>
<div class="calendar-cell">
<button class="calendar-event" onclick="document.getElementById('appointmentModal').showModal()" type="button">
          Rafael Tan
          <small>
           Crown consult
          </small>
</button>
</div>
<div class="calendar-cell time">
         1:00 PM
        </div>
<div class="calendar-cell">
</div>
<div class="calendar-cell">
</div>
<div class="calendar-cell">
<button class="calendar-event" onclick="document.getElementById('appointmentModal').showModal()" type="button">
          Ella Cruz
          <small>
           Orthodontic review
          </small>
</button>
</div>
<div class="calendar-cell">
<button class="calendar-event green" onclick="document.getElementById('appointmentModal').showModal()" type="button">
          Liam Go
          <small>
           Checked in
          </small>
</button>
</div>
<div class="calendar-cell">
</div>
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
         11:30 AM · Dr. Reyes
        </b>
</div>
</div>
<div class="today-card">
<span>
        Total appointments
       </span>
<strong>
        18
       </strong>
</div>
<div class="today-card">
<span>
        Completed
       </span>
<strong>
        9
       </strong>
</div>
<div class="today-card">
<span>
        Pending check-ins
       </span>
<strong>
        4
       </strong>
</div>
<div class="today-card">
<span>
        No-shows
       </span>
<strong>
        1
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
         Arrival
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
  $arrivalFormatted = $appt->checked_in_at ? \Illuminate\Support\Carbon::parse($appt->checked_in_at)->format('g:i A') : 'Not arrived';
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
@if($appt->status === 'Checked In' && $appt->checked_in_at)
<span class="arrival-state arrived">
{{ $arrivalFormatted }}
</span>
@elseif($appt->status === 'Completed')
<span class="arrival-state arrived">
Completed
</span>
@else
<span class="arrival-state waiting">
Not arrived
</span>
@endif
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
<div class="panel ortho-installment-admin" id="orthoInstallmentPanel"><div class="panel-heading"><div><h3>Installment Oversight</h3><p>Monitor active payment plans, upcoming dues, and installment collections.</p></div></div><div class="installment-summary-row"><div><small>Active plans</small><strong>3</strong></div><div><small>Next due</small><strong>₱3,500</strong></div><div><small>Collected this month</small><strong>₱10,500</strong></div></div></div>
<div class="stats-grid">
<article class="stat-card" data-dashboard-metric="collections_today">
<p>
       Collected today
      </p>
<strong>
       ₱0.00
      </strong>
<span>
       <span data-dashboard-metric="payments_today">0</span> payments
      </span>
</article>
<article class="stat-card" data-dashboard-metric="total_patients">
<p>
       Outstanding
      </p>
<strong>
       ₱0.00
      </strong>
<span>
       14 patient balances
      </span>
</article>
<article class="stat-card" data-dashboard-metric="collections_today">
<p>
       Partial balances
      </p>
<strong>
       ₱22,300
      </strong>
<span>
       6 active plans
      </span>
</article>
<article class="stat-card">
<p>
       Adjustments
      </p>
<strong>
       -₱3,250
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
          Treating Dentist
         </th>
<th>
          Payment Method
         </th>
<th>
          Total Amount Paid
         </th>
<th>
          Action
         </th>
</tr>
</thead>
<tbody>
<tr><td colspan="7" class="muted" style="text-align:center;padding:24px;">Loading sales records...</td></tr>
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
<div class="metric-strip">
<div class="metric-box">
<small>
       Patients served
      </small>
<strong>
       428
      </strong>
<span>
       this month
      </span>
</div>
<div class="metric-box">
<small>
       Completed visits
      </small>
<strong>
       386
      </strong>
<span>
       90.2% completion
      </span>
</div>
<div class="metric-box">
<small>
       Cancellation rate
      </small>
<strong>
       5.4%
      </strong>
<span>
       23 appointments
      </span>
</div>
<div class="metric-box">
<small>
       Collection rate
      </small>
<strong>
       94.8%
      </strong>
<span>
       posted payments
      </span>
</div>
<div class="metric-box">
<small>
       New patients
      </small>
<strong>
       67
      </strong>
<span>
       this month
      </span>
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
<table id="admin-table-5">
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
</article>
<div class="cerillo-report-visit-pair cerillo-report-sidecharts">
<article class="panel report-chart-card patient-activity-card"><div class="panel-heading"><div><h3>Completed Visits by Month</h3><p>Actual completed appointments from the database.</p></div></div><div id="v6PatientVisitsTrend" class="v6-patient-trend" aria-label="Completed visits by month"></div></article>
<article class="panel report-chart-card patient-activity-card"><div class="panel-heading"><div><h3>Appointment Outcomes</h3><p>Recorded outcomes for the selected reporting period.</p></div></div><div id="v6PatientVisitOutcomes" class="cerillo-outcome-chart" aria-label="Appointment outcomes"></div></article>
</div>
</div>
<div class="report-expansion-grid">
<article class="panel report-visual-card report-wide">
<div class="panel-heading">
<div>
<h3>
         Collections Trend
        </h3>
<p>
         Posted collections across the last six months.
        </p>
</div>
<span class="chart-total">
        ₱612,400 YTD
       </span>
</div>
<div class="svg-chart-wrap compact">
<svg aria-label="Collections trend May to October" class="line-chart-svg" role="img" viewbox="0 0 720 210">
<g class="chart-grid-lines">
<line x1="44" x2="690" y1="36" y2="36">
</line>
<line x1="44" x2="690" y1="82" y2="82">
</line>
<line x1="44" x2="690" y1="128" y2="128">
</line>
<line x1="44" x2="690" y1="174" y2="174">
</line>
</g>
<path class="chart-area" d="M60,154 C140,142 172,132 226,126 S330,104 374,112 S470,88 520,82 S620,70 678,54 L678,174 L60,174 Z">
</path>
<path class="chart-line" d="M60,154 C140,142 172,132 226,126 S330,104 374,112 S470,88 520,82 S620,70 678,54">
</path>
<g class="chart-axis-labels">
<text x="52" y="200">
          May
         </text>
<text x="178" y="200">
          Jun
         </text>
<text x="302" y="200">
          Jul
         </text>
<text x="422" y="200">
          Aug
         </text>
<text x="546" y="200">
          Sep
         </text>
<text x="658" y="200">
          Oct
         </text>
</g>
</svg>
</div>
</article>
<article class="panel report-visual-card">
<div class="panel-heading">
<div>
<h3>
         Payment Method Mix
        </h3>
<p>
         Share of posted payments this month.
        </p>
</div>
</div>
<div class="donut-layout">
<div class="donut-chart payment-donut">
<div>
<strong>
          ₱184k
         </strong>
<span>
          collected
         </span>
</div>
</div>
<div class="chart-legend-list">
<span>
<i class="dot blue">
</i>
         GCash
         <strong>
          46%
         </strong>
</span>
<span>
<i class="dot green">
</i>
         Cash
         <strong>
          34%
         </strong>
</span>
<span>
<i class="dot violet">
</i>
         Card
         <strong>
          20%
         </strong>
</span>
</div>
</div>
</article>
<article class="panel report-visual-card">
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
<strong>
        78%
       </strong>
<span>
        accepted this month
       </span>
</div>
<div class="stacked-progress">
<i style="width:78%">
</i>
</div>
<div class="mini-stats">
<span>
<strong>
         57
        </strong>
        accepted
       </span>
<span>
<strong>
         16
        </strong>
        pending
       </span>
</div>
</article>
<article class="panel report-visual-card report-wide">
<div class="panel-heading">
<div>
<h3>
         Dentist Workload
        </h3>
<p>
         Completed clinical cases this month.
        </p>
</div>
</div>
<div class="workload-bars">
<div>
<span>
         Dr. Ana Cerillo
        </span>
<div>
<i style="width:88%">
</i>
</div>
<strong>
         148
        </strong>
</div>
<div>
<span>
         Dr. Paolo Reyes
        </span>
<div>
<i style="width:76%">
</i>
</div>
<strong>
         127
        </strong>
</div>
<div>
<span>
         Dr. Mia Tan
        </span>
<div>
<i style="width:69%">
</i>
</div>
<strong>
         111
        </strong>
</div>
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
<tr>
<td colspan="5" class="muted">
         Loading staff accounts...
        </td>
</tr>
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
<div>
<strong>
           Oct 02 · 3:18 PM
          </strong>
<br/>
          SMS reminder delivered to patient.
         </div>
<div>
<strong>
           Oct 01 · 10:42 AM
          </strong>
<br/>
          Appointment created by Front Desk — Lea Morales.
         </div>
<div>
<strong>
           Sep 28 · 2:05 PM
          </strong>
<br/>
          Recall recommendation recorded after previous visit.
         </div>
</div>
</div>
</div>
<aside class="appointment-side">
<div class="appointment-side-card">
<h4>
         Today's schedule
        </h4>
<span class="big-number">
         18
        </span>
<p>
         Total appointments · 4 still pending
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
          Apr 04, 2026
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
<dialog aria-label="Operation Record — Composite Restoration" class="modal modal-lg" id="operationModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">
       Clinical operation
      </p>
<h3>
       Composite Restoration · Tooth 16
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
         Penicillin allergy
        </span>
<span>
         Tooth 16 · Occlusal
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
         <input required="" value="Composite Restoration"/>
</label>
<label>
         Tooth
         <input required="" value="#16"/>
</label>
<label>
         Dentist
         <input required="" value="Dr. Angela Cerillo"/>
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
       Sep 28, 2026 · Panoramic + selected intraoral views
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
          PT-2026-0148
         </strong>
</div>
<div class="info-field" style="margin-top:12px">
<small>
          Ordering dentist
         </small>
<strong>
          Dr. Angela Cerillo
         </strong>
</div>
<div class="info-field" style="margin-top:12px">
<small>
          Region
         </small>
<strong>
          Full dentition · Tooth 26 focus
         </strong>
</div>
</div>
<div class="xray-card">
<h4>
         Clinical finding
        </h4>
<p>
         Proximal radiolucency associated with tooth 26. Correlate with direct clinical examination, symptoms, and vitality testing before definitive treatment.
        </p>
</div>
<div class="xray-card">
<h4>
         Plan
        </h4>
<p>
         Focused restorative assessment for tooth 26. Imaging remains part of the complete clinical record and is interpreted together with examination findings.
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
<form id="accountUpdateForm">
<input id="editAccountId" name="account_id" type="hidden"/>
<div class="form-section">
<div class="form-section-title">
<div>
<h4>
            Staff information
           </h4>
<p>
            Official credentials and authorization level.
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
<div class="form-actions" style="margin-top:1rem;">
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">
          Cancel
         </button>
<button class="btn" type="submit">
          Update Account
         </button>
</div>
</form>
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
<dialog aria-label="Payment Oversight" class="modal modal-xl financial-record-modal financial-font-up" id="adminPaymentModal">
<div class="modal-shell financial-shell">
<header class="modal-head financial-modal-head">
<div>
<p class="eyebrow">
       Payment Oversight
      </p>
<h3>
       —
      </h3>
<p>
       Administrative payment review with processing and clinical attribution.
      </p>
</div>
<button aria-label="Close payment oversight" class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</header>
<div class="modal-scroll financial-modal-body">
<section class="financial-hero">
<div class="financial-identity">
<div class="financial-avatar">
        --
       </div>
<div>
<small>
         Patient
        </small>
<h4>
         —
        </h4>
<span>
         —
        </span>
</div>
</div>
<div class="financial-amount-block">
<span class="status success">
        Paid
       </span>
<small>
        Amount received
       </small>
<strong>
        ₱4,500.00
       </strong>
</div>
</section>
<div class="financial-grid">
<article class="financial-card">
<div class="financial-card-head">
<div>
<span class="financial-icon">
          ₱
         </span>
<div>
<h4>
           Payment Summary
          </h4>
<p>
           Posted transaction information
          </p>
</div>
</div>
</div>
<dl class="financial-detail-list">
<div>
<dt>
          Date &amp; time
         </dt>
<dd>
          04 Oct 2026 · 4:42 PM
         </dd>
</div>
<div>
<dt>
          Payment method
         </dt>
<dd>
          GCash
         </dd>
</div>
<div>
<dt>
          Reference
         </dt>
<dd>
          GC-89210477
         </dd>
</div>
<div>
<dt>
          Invoice
         </dt>
<dd>
          INV-2026-1052
         </dd>
</div>
<div>
<dt>
          Original balance
         </dt>
<dd>
          ₱9,000.00
         </dd>
</div>
<div>
<dt>
          Remaining balance
         </dt>
<dd>
          ₱4,500.00
         </dd>
</div>
</dl>
</article>
<article class="financial-card">
<div class="financial-card-head">
<div>
<span class="financial-icon blue">
          ↳
         </span>
<div>
<h4>
           Processing Metadata
          </h4>
<p>
           Accountability and clinical attribution
          </p>
</div>
</div>
</div>
<dl class="financial-detail-list">
<div>
<dt>
          Processed by
         </dt>
<dd>
          Maria Reyes · Front Desk
         </dd>
</div>
<div>
<dt>
          Treating dentist
         </dt>
<dd>
          Dr. Ana Cerillo
         </dd>
</div>
<div>
<dt>
          Operatory
         </dt>
<dd>
          Operatory 2
         </dd>
</div>
<div>
<dt>
          Posted from
         </dt>
<dd>
          Front Desk Checkout
         </dd>
</div>
<div>
<dt>
          Audit status
         </dt>
<dd>
<span class="status success">
           Verified
          </span>
</dd>
</div>
<div>
<dt>
          Last updated
         </dt>
<dd>
          04 Oct 2026 · 4:43 PM
         </dd>
</div>
</dl>
</article>
</div>
<section class="financial-card line-item-card">
<div class="financial-card-head">
<div>
<span class="financial-icon violet">
         ≡
        </span>
<div>
<h4>
          Applied Charges
         </h4>
<p>
          Services covered by this payment
         </p>
</div>
</div>
</div>
<div class="receipt-table">
<div class="receipt-table-head">
<span>
         Clinical item
        </span>
<span>
         Charge
        </span>
<span>
         Applied
        </span>
</div>
<div>
<span>
<strong>
          Tooth #30 · Root Canal Therapy
         </strong>
<small>
          D3310 · Dr. Ana Cerillo
         </small>
</span>
<span>
         ₱7,000
        </span>
<span>
         ₱3,500
        </span>
</div>
<div>
<span>
<strong>
          Diagnostic radiograph
         </strong>
<small>
          Periapical image
         </small>
</span>
<span>
         ₱1,000
        </span>
<span>
         ₱500
        </span>
</div>
<div>
<span>
<strong>
          Professional fee
         </strong>
<small>
          Clinical procedure fee
         </small>
</span>
<span>
         ₱1,000
        </span>
<span>
         ₱500
        </span>
</div>
</div>
</section>
<section class="admin-override-panel">
<div class="override-heading">
<div>
<span class="financial-icon amber">
         !
        </span>
<div>
<h4>
          Administrative Financial Override
         </h4>
<p>
          Admin-only adjustments are recorded permanently in the audit log.
         </p>
</div>
</div>
<span class="admin-only-chip">
        ADMIN ONLY
       </span>
</div>
<div class="override-grid">
<label>
        Professional discount
        <input min="0" placeholder="₱ 0.00" type="number"/>
</label>
<label>
        Partial balance adjustment
        <input placeholder="₱ 0.00" type="number"/>
</label>
<label class="waive-option">
<input type="checkbox"/>
<span>
<strong>
          Waive remaining treatment fee
         </strong>
<small>
          Creates a documented financial adjustment.
         </small>
</span>
</label>
<label class="span-full">
        Override reason
        <textarea placeholder="Required whenever an amount is adjusted or waived" rows="3"></textarea>
</label>
</div>
</section>
</div>
<footer class="modal-footer financial-footer">
<div>
<small>
       Original payment remains preserved in the transaction ledger.
      </small>
</div>
<div class="footer-actions">
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">
       Close
      </button>
<button class="btn" type="button">
       Apply Adjustment &amp; Log
      </button>
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
        ₱10,000.00
       </strong>
<span>
        GCash · GC-89210477
       </span>
</div>
</section>
<div class="transaction-meta-grid">
<div>
<small>
        Invoice number
       </small>
<strong>
        INV-2026-1048
       </strong>
</div>
<div>
<small>
        Processed by
       </small>
<strong>
        Maria Reyes · Front Desk
       </strong>
</div>
<div>
<small>
        Payment method
       </small>
<strong>
        GCash
       </strong>
</div>
<div>
<small>
        Receipt status
       </small>
<strong>
        Posted &amp; reconciled
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
        2 line items
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
<div class="transaction-line">
<span>
<strong>
         Tooth #30 · Root Canal Therapy
        </strong>
<small>
         D3310 · Endodontic treatment
        </small>
</span>
<span>
        Dr. Ana Cerillo
       </span>
<strong>
        ₱7,000
       </strong>
</div>
<div class="transaction-line">
<span>
<strong>
         Tooth #31 · Composite Filling
        </strong>
<small>
         D2391 · 1-surface posterior composite
        </small>
</span>
<span>
        Dr. Ana Cerillo
       </span>
<strong>
        ₱3,000
       </strong>
</div>
<div class="transaction-grand-total">
<span>
        Total paid
       </span>
<strong>
        ₱10,000
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
    if (tooth && tooth.closest('.clinical-record-modal') && !tooth.closest('#patientViewModal')) {
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
  const fmtTime = value => {
    const d = value instanceof Date ? value : new Date(value);
    if (Number.isNaN(d.getTime())) return '—';
    return d.toLocaleTimeString('en-US',{hour:'numeric',minute:'2-digit',hour12:true});
  };
  const monday = d => { const x=new Date(d); const day=x.getDay()||7; x.setDate(x.getDate()-day+1); x.setHours(12,0,0,0); return x; };
  const sameDay = (value,date) => iso(new Date(value)) === iso(date);
  const statusClass = status => status === 'Completed' ? 'completed' : status === 'Cancelled' ? 'cancelled' : status === 'Checked In' ? 'checked' : 'progress';
  const statusLabelClass = status => status === 'Completed' ? 'success' : status === 'Cancelled' ? 'danger' : status === 'Checked In' ? 'info' : 'warning';

  function rangeForView(){
    if(view==='month') return {start:new Date(anchor.getFullYear(),anchor.getMonth(),1,12),end:new Date(anchor.getFullYear(),anchor.getMonth()+1,0,12)};
    const start=monday(anchor), end=new Date(start); end.setDate(start.getDate()+5); return {start,end};
  }
  const activeBlocks = () => calendarBlocks.filter(block => !dentistFilter?.value || String(block.dentist_id) === String(dentistFilter.value));
  function blockCoversHour(block,day,h){
    const start=new Date(block.starts_at), end=new Date(block.ends_at);
    const slotStart=new Date(day); slotStart.setHours(h,0,0,0);
    const slotEnd=new Date(day); slotEnd.setHours(h+1,0,0,0);
    return start < slotEnd && end > slotStart;
  }
  function blockCoversDay(block,day){
    const start=new Date(block.starts_at), end=new Date(block.ends_at);
    const dayStart=new Date(day); dayStart.setHours(0,0,0,0);
    const dayEnd=new Date(day); dayEnd.setHours(23,59,59,999);
    return start <= dayEnd && end >= dayStart;
  }
  function periodAppointments(){
    const {start,end}=rangeForView(), from=iso(start), to=iso(end);
    return calendarAppointments.filter(a=>{ const d=a.starts_at?iso(new Date(a.starts_at)):''; return d>=from&&d<=to; }).sort((a,b)=>new Date(a.starts_at)-new Date(b.starts_at));
  }
  function periodBlocks(){
    const {start,end}=rangeForView(); const rs=new Date(start);rs.setHours(0,0,0,0); const re=new Date(end);re.setHours(23,59,59,999);
    return activeBlocks().filter(b=>new Date(b.starts_at)<=re&&new Date(b.ends_at)>=rs).sort((a,b)=>new Date(a.starts_at)-new Date(b.starts_at));
  }

  function renderMonthRail(){
    if(!monthRail)return;
    if(yearLabel)yearLabel.textContent=String(anchor.getFullYear());
    monthRail.innerHTML=monthNames.map((name,index)=>{
      const count=calendarAppointments.filter(a=>{if(!a.starts_at)return false;const d=new Date(a.starts_at);return d.getFullYear()===anchor.getFullYear()&&d.getMonth()===index;}).length;
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
      const starts=new Date(a.starts_at), patient=a.patient?.name||a.guest_name||'Guest patient', service=a.service?.name||'Appointment', dentist=a.dentist?.name||dentistNames[a.dentist_id]||'Unassigned';
      items.push({when:starts,html:`<button class="admin-calendar-agenda-item ${statusClass(a.status)}" data-admin-event data-appointment-id="${a.id}" type="button"><span class="agenda-status-dot"></span><span class="agenda-time"><strong>${escapeHtml(fmtTime(starts))}</strong><small>${escapeHtml(starts.toLocaleDateString('en-US',{month:'short',day:'numeric'}))}</small></span><span class="agenda-copy"><strong>${escapeHtml(patient)}</strong><small>${escapeHtml(service)} · ${escapeHtml(dentist)}</small></span><span class="status ${statusLabelClass(a.status)}">${escapeHtml(a.status)}</span></button>`});
    });
    blocks.forEach(block=>{
      const starts=new Date(block.starts_at), ends=new Date(block.ends_at), dentist=dentistNames[block.dentist_id]||`Dentist #${block.dentist_id}`;
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
        const events=calendarAppointments.filter(a=>{const x=new Date(a.starts_at);return a.starts_at&&sameDay(x,d)&&x.getHours()===h;}).sort((a,b)=>new Date(a.starts_at)-new Date(b.starts_at));
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
    const rows=activeBlocks().slice().sort((a,b)=>new Date(a.starts_at)-new Date(b.starts_at));
    if(!rows.length){availabilityTable.innerHTML='<div class="availability-empty-state"><strong>No unavailable schedules</strong><span>Blocked dentist schedules will appear here.</span></div>';return;}
    availabilityTable.innerHTML=rows.map(block=>{
      const start=new Date(block.starts_at),end=new Date(block.ends_at),same=iso(start)===iso(end),dentist=dentistNames[block.dentist_id]||`Dentist #${block.dentist_id}`;
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
    const {start,end}=rangeForView();const params=new URLSearchParams({from:iso(start),to:iso(end),per_page:'100'});if(document.body.dataset.workspaceView==='dentist')params.set('view','dentist');if(dentistFilter?.value)params.set('dentist_id',dentistFilter.value);
    agenda.innerHTML='<p class="muted">Loading schedule…</p>';
    const rows=[];let page=1,lastPage=1;
    do{params.set('page',String(page));const response=await fetch(`/api/appointments?${params}`,{headers:{Accept:'application/json'}});if(!response.ok)throw new Error('Calendar appointments could not be loaded.');const payload=await response.json();rows.push(...(payload.data||[]));lastPage=Math.max(1,Number(payload.last_page||1));page+=1;}while(page<=lastPage);
    calendarAppointments=rows;
    try{const blockRes=await fetch('/api/blocks?per_page=100',{headers:{Accept:'application/json'}});if(blockRes.ok){const payload=await blockRes.json();calendarBlocks=payload.data||[];}}catch(error){console.warn('Unavailable schedules could not be loaded.',error);}
    renderAll();
  }

  document.querySelectorAll('[data-admin-calendar-view]').forEach(button=>button.addEventListener('click',()=>{view=button.dataset.adminCalendarView;selectedDate=null;loadCalendar().catch(console.error);}));
  document.querySelector('[data-admin-calendar-prev]')?.addEventListener('click',()=>{if(view==='week')anchor.setDate(anchor.getDate()-7);else anchor.setMonth(anchor.getMonth()-1);selectedDate=null;loadCalendar().catch(console.error);});
  document.querySelector('[data-admin-calendar-next]')?.addEventListener('click',()=>{if(view==='week')anchor.setDate(anchor.getDate()+7);else anchor.setMonth(anchor.getMonth()+1);selectedDate=null;loadCalendar().catch(console.error);});
  document.querySelector('[data-admin-calendar-today]')?.addEventListener('click',()=>{anchor=new Date();anchor.setHours(12,0,0,0);selectedDate=new Date(anchor);loadCalendar().catch(console.error);});
  document.querySelector('[data-admin-calendar-year-prev]')?.addEventListener('click',()=>{anchor.setFullYear(anchor.getFullYear()-1);selectedDate=null;loadCalendar().catch(console.error);});
  document.querySelector('[data-admin-calendar-year-next]')?.addEventListener('click',()=>{anchor.setFullYear(anchor.getFullYear()+1);selectedDate=null;loadCalendar().catch(console.error);});
  dentistFilter?.addEventListener('change',()=>loadCalendar().catch(console.error));
  monthRail?.addEventListener('click',event=>{const button=event.target.closest('[data-admin-rail-month]');if(!button)return;anchor.setMonth(Number(button.dataset.adminRailMonth),1);selectedDate=null;loadCalendar().catch(console.error);});
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
  function apply(tooth,f){tooth.classList.remove(...STATUS_CLASSES);tooth.classList.add(cls(f));tooth.dataset.finding=f;}
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
  function ensureCart(r){const panel=r.querySelector('[data-record-panel="chart"]');if(!panel)return null;let c=panel.querySelector('[data-consultation-cart]');if(!c){c=document.createElement('section');c.className='consultation-cart-panel';c.dataset.consultationCart='';c.innerHTML=`<div class="consultation-cart-head"><div><span class="consultation-cart-kicker">Current consultation</span><h4>Treatment invoice draft</h4><p>Add multiple tooth procedures before posting one invoice.</p></div><div class="consultation-cart-total"><small>Running total</small><strong data-consultation-total>₱0.00</strong></div></div><div class="consultation-cart-items" data-consultation-items></div><div class="consultation-cart-footer"><span data-consultation-count>0 procedures</span><div><button class="btn secondary compact" type="button" data-consultation-clear>Clear draft</button><button class="btn compact" type="button" data-consultation-finish disabled>Finish Consultation</button></div></div>`;const w=panel.querySelector('.odontogram-workspace');w?w.insertAdjacentElement('afterend',c):panel.appendChild(c);}return c;}
  function renderCart(r){
    const c=ensureCart(r);if(!c)return;
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

  // Real-time periodontal layer and tooth click listener
  document.addEventListener('click',e=>{
    const t=e.target.closest('.clinical-record-modal .tooth-unit');
    if(!t || t.closest('#patientViewModal'))return;
    const toothNum=t.dataset.tooth||t.textContent.trim();
    const toothName=t.dataset.toothName||'';
    document.querySelectorAll('.clinical-details-tooth').forEach(el=>{
      el.textContent='Tooth #'+toothNum;
    });
    document.querySelectorAll('.chart-history-heading h4').forEach(el=>{
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
    if(/sound\s*\/\s*healthy/i.test(f)){
      apply(activeTooth,f);
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
</body>
</html>
