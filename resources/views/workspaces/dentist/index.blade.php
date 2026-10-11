<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="Cerillo Dental Clinic Dentist workspace" name="description"/>
<title>
   Dentist · Cerillo Dental Clinic
  </title>
<link href="{{ asset('assets/images/cerillo-logo.png') }}" rel="icon"/>
<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet"/>
<meta name="csrf-token" content="{{ csrf_token() }}"><link rel="stylesheet" href="{{ asset('assets/css/clinic-fixes.css') }}"><link rel="stylesheet" href="/assets/css/cerillo-responsive.css">
<script src="/assets/js/cerillo-format.js"></script>
</head>
<body class="workspace-body" data-workspace-role="dentist">
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
<div class="role-label">
    Dentist Workspace
   </div>
<nav aria-label="Dentist navigation" class="side-nav">
<a class="side-link" href="#dashboard">
<span>
      Dashboard
     </span>
</a>
<a class="side-link" href="#calendar">
<span>
      Calendar
     </span>
</a>
<a class="side-link" href="#appointments">
<span>
      Appointments
     </span>
</a>
<a class="side-link" href="#patients">
<span>
      Patient Records
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
     D
    </div>
<div>
<strong id="dentistAccountName">
      Dr. Angela Cerillo
     </strong>
<small>
      Dentist
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
      Dentist Workspace
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
       Clinical workspace
      </p>
<h2>
       Dentist Dashboard
      </h2>
<p>
       Today's clinical schedule uses only Completed, Checked In, In Progress, and Cancelled statuses.
      </p>
</div>
</div>
<div class="stats-grid">
<article class="stat-card" data-dashboard-metric="completed_today">
<p>
       Completed
      </p>
<strong>
       4
      </strong>
<span>
       Completed appointments today
      </span>
</article>
<article class="stat-card" data-dashboard-metric="checked_in_today">
<p>
       Checked In
      </p>
<strong>
       2
      </strong>
<span>
       Patients ready for care
      </span>
</article>
<article class="stat-card" data-dashboard-metric="in_progress_today">
<p>
       In Progress
      </p>
<strong>
       1
      </strong>
<span>
       Current clinical case
      </span>
</article>
<article class="stat-card" data-dashboard-metric="cancelled_today">
<p>
       Cancelled
      </p>
<strong>
       1
      </strong>
<span>
       Cancelled today
      </span>
</article>
</div>
<div class="panel table-panel">
<div class="table-wrap">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="dentist-table-1" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="dentist-table-1">
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
<details class="filter-popover" data-filter-for="dentist-table-1">
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
            In Progress
           </option>
<option>
            Cancelled
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
<table id="dentist-table-1">
<thead>
<tr>
<th>
          Time
         </th>
<th>
          Patient
         </th>
<th>
          Procedure
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
<span class="status warning">
           In Progress
          </span>
</td>
</tr>
<tr>
<td>
          1:30 PM
         </td>
<td>
          Paolo Garcia
         </td>
<td>
          Tooth Extraction
         </td>
<td>
<span class="status danger">
           Cancelled
          </span>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</section>
<section class="workspace-section" id="calendar">
<div class="section-heading">
<div>
<p class="eyebrow">Clinical availability</p>
<h2>Calendar</h2>
<p>Review appointments and mark specific dates, time ranges, or full weeks as unavailable.</p>
</div>
<button class="btn" id="startAvailabilityPicker" type="button">+ Mark Unavailable</button>
</div>
<div class="availability-pick-hint" id="availabilityPickHint">
Select a day header for an all-day block, or choose an empty time box for a specific one-hour block. The selected date and time will be filled automatically.
</div>
<div class="panel admin-calendar-shell admin-calendar-v2 dentist-calendar-v2">
<div class="admin-calendar-v2-toolbar">
<div class="admin-calendar-period-nav">
<button class="calendar-nav-btn" data-dentist-calendar-prev type="button" aria-label="Previous period">‹</button>
<div class="admin-calendar-period-copy">
<span>Schedule period</span>
<strong id="dentistCalendarTitle">Current schedule</strong>
</div>
<button class="calendar-nav-btn" data-dentist-calendar-next type="button" aria-label="Next period">›</button>
<button class="btn secondary sm admin-calendar-today" data-dentist-calendar-today type="button">Today</button>
</div>
<div class="admin-calendar-v2-controls">
<label class="calendar-dentist-filter">Dentist <select aria-label="Current dentist" disabled><option>{{ auth()->user()->name }}</option></select></label>
<div aria-label="Calendar view" class="segmented admin-calendar-view-toggle">
<button class="active" data-dentist-calendar-view="week" type="button">Week</button>
<button data-dentist-calendar-view="month" type="button">Month</button>
</div>
</div>
</div>
<div class="admin-calendar-v2-layout">
<aside class="admin-calendar-month-rail" aria-label="Month navigation">
<div class="admin-calendar-year-row">
<button type="button" data-dentist-calendar-year-prev aria-label="Previous year">‹</button>
<strong id="dentistCalendarYear">2026</strong>
<button type="button" data-dentist-calendar-year-next aria-label="Next year">›</button>
</div>
<div class="admin-calendar-month-list" id="dentistCalendarMonthRail"></div>
</aside>
<div class="admin-calendar-main-stage">
<div class="calendar-selection-note" id="dentistCalendarSelection">Select an appointment to open its details, or select an empty schedule to mark that time unavailable.</div>
<div class="weekly-calendar-scroll" id="dentistCalendarWeek">
<div class="weekly-calendar wide-calendar" id="dentistInteractiveWeek"></div>
</div>
<div class="admin-month-calendar dentist-month-calendar" hidden id="dentistCalendarMonth"></div>
</div>
<aside class="admin-calendar-agenda" aria-label="Calendar agenda">
<div class="admin-calendar-agenda-head">
<div>
<span>Agenda</span>
<strong id="dentistCalendarAgendaLabel">Current period</strong>
</div>
<small>Appointments and unavailable schedules.</small>
</div>
<div class="admin-calendar-agenda-list" id="dentistCalendarAppointments" aria-live="polite">
<p class="muted">Loading schedule…</p>
</div>
</aside>
</div>
</div>
<div class="panel availability-schedule-panel">
<div class="panel-header">
<div>
<h3>Unavailable Schedules</h3>
<p>Dates and times when this dentist is not available for appointments.</p>
</div>
</div>
<div class="availability-records" id="dentistAvailabilityTable">
<article class="availability-record">
<div><small>Dentist</small><strong>Dr. Angela Cerillo</strong></div>
<div><small>Date</small><strong>08 Oct 2026</strong></div>
<div><small>Time</small><strong>1:00 PM–5:00 PM</strong></div>
<div><small>Reason</small><strong>Personal leave</strong></div>
</article>
<article class="availability-record">
<div><small>Dentist</small><strong>Dr. Angela Cerillo</strong></div>
<div><small>Date</small><strong>12–16 Oct 2026</strong></div>
<div><small>Time</small><strong><span class="badge info">Full Week</span></strong></div>
<div><small>Reason</small><strong>Continuing education conference</strong></div>
</article>
</div>
</div>
</section>
<section class="workspace-section" id="appointments">
<div class="section-heading">
<div>
<p class="eyebrow">
       My schedule
      </p>
<h2>
       Appointments
      </h2>
<p>
       Appointments assigned to this dentist. Availability is managed from Calendar.
      </p>
</div>
</div>
<div class="stats-grid">
<article class="stat-card" data-dashboard-metric="appointments_today"><p>Today's Appointments</p><strong>0</strong><span>Assigned to you</span></article>
<article class="stat-card" data-dashboard-metric="upcoming_appointments"><p>Upcoming</p><strong>0</strong><span>Next 7 days</span></article>
<article class="stat-card" data-dashboard-metric="completed_today"><p>Completed</p><strong>0</strong><span>Completed visits today</span></article>
<article class="stat-card" data-dashboard-metric="cancelled_today"><p>Cancelled / No-show</p><strong>0</strong><span>Today's exceptions</span></article>
</div>
<div class="weekly-calendar-scroll">
<div class="mini-week-strip" id="dentistAppointmentsWeekStrip">
<article>
<strong>
        Mon 5
       </strong>
<span>
        4 appointments
       </span>
</article>
<article>
<strong>
        Tue 6
       </strong>
<span>
        5 appointments
       </span>
</article>
<article>
<strong>
        Wed 7
       </strong>
<span>
        3 appointments
       </span>
</article>
<article>
<strong>
        Thu 8
       </strong>
<span>
        Unavailable PM
       </span>
</article>
<article>
<strong>
        Fri 9
       </strong>
<span>
        6 appointments
       </span>
</article>
<article>
<strong>
        Sat 10
       </strong>
<span>
        2 appointments
       </span>
</article>
</div>
</div>
<div class="panel table-panel">
<div class="table-wrap">
<div class="table-filter-dock">
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="dentist-table-2" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="dentist-table-2">
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
<details class="filter-popover" data-filter-for="dentist-table-2">
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
            In Progress
           </option>
<option>
            Cancelled
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
<table id="dentist-table-2">
<thead>
<tr>
<th>
          Name
         </th>
<th>
          Procedure
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
<tr data-appointment-id="1">
<td>
          Maria Santos
         </td>
<td>
          Oral Prophylaxis
         </td>
<td>
          05 Oct 2026
         </td>
<td>
          8:30 AM
         </td>
<td>
<span class="status success">
           Completed
          </span>
</td>
<td>
<button class="table-action appointment-view" data-appointment-id="1" onclick="window.openDentistAppointment ? window.openDentistAppointment(this) : (document.getElementById('dentistAppointmentDetailModal') &amp;&amp; document.getElementById('dentistAppointmentDetailModal').showModal())" type="button">
           View
          </button>
</td>
</tr>
<tr data-appointment-id="2">
<td>
          Joshua Lim
         </td>
<td>
          Composite Restoration
         </td>
<td>
          05 Oct 2026
         </td>
<td>
          9:30 AM
         </td>
<td>
<span class="status info">
           Checked In
          </span>
</td>
<td>
<button class="table-action appointment-view" data-appointment-id="2" onclick="window.openDentistAppointment ? window.openDentistAppointment(this) : (document.getElementById('dentistAppointmentDetailModal') &amp;&amp; document.getElementById('dentistAppointmentDetailModal').showModal())" type="button">
           View
          </button>
</td>
</tr>
<tr data-appointment-id="3">
<td>
          Andrea Cruz
         </td>
<td>
          Root Canal Therapy
         </td>
<td>
          05 Oct 2026
         </td>
<td>
          10:30 AM
         </td>
<td>
<span class="status warning">
           In Progress
          </span>
</td>
<td>
<button class="table-action appointment-view" data-appointment-id="3" onclick="window.openDentistAppointment ? window.openDentistAppointment(this) : (document.getElementById('dentistAppointmentDetailModal') &amp;&amp; document.getElementById('dentistAppointmentDetailModal').showModal())" type="button">
           View
          </button>
</td>
</tr>
<tr data-appointment-id="4">
<td>
          Paolo Garcia
         </td>
<td>
          Tooth Extraction
         </td>
<td>
          05 Oct 2026
         </td>
<td>
          1:30 PM
         </td>
<td>
<span class="status danger">
           Cancelled
          </span>
</td>
<td>
<button class="table-action appointment-view" data-appointment-id="4" onclick="window.openDentistAppointment ? window.openDentistAppointment(this) : (document.getElementById('dentistAppointmentDetailModal') &amp;&amp; document.getElementById('dentistAppointmentDetailModal').showModal())" type="button">
           View
          </button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</section>
<section class="workspace-section" id="patients">
<div class="section-heading">
<div>
<p class="eyebrow">
       Clinical files
      </p>
<h2>
       Patient Records
      </h2>
<p>
       Same patient-file structure as Admin, with clinical updates enabled for patients appointed to you today.
      </p>
</div>
<button class="btn secondary" data-export-current-patient-pdf="" type="button">Export patient record PDF</button></div>
<div class="stats-grid">
<article class="stat-card">
<p>
       Assigned Today
      </p>
<strong>
       8
      </strong>
<span>
       Current schedule
      </span>
</article>
<article class="stat-card">
<p>
       Checked In
      </p>
<strong>
       2
      </strong>
<span>
       Ready for care
      </span>
</article>
<article class="stat-card">
<p>
       Clinical Updates
      </p>
<strong>
       5
      </strong>
<span>
       Documented today
      </span>
</article>
<article class="stat-card">
<p>
       Follow-up Needed
      </p>
<strong>
       3
      </strong>
<span>
       After today's visits
      </span>
</article>
</div>
<div class="panel table-panel">
<div class="table-wrap">
<div class="table-filter-dock"><select aria-label="Patient segment" class="patient-segment-control" data-patient-segment-for="dentist-table-3"><option value="">All segments</option><option value="Orthodontics">Orthodontics</option><option value="Preventive">Preventive</option><option value="Restorative">Restorative</option><option value="Endodontics">Endodontics</option><option value="Oral Surgery">Oral Surgery</option><option value="General">General</option></select><select aria-label="Procedure filter" class="patient-procedure-control" data-patient-procedure-for="dentist-table-3"><option value="">All procedures</option><option value="Oral Prophylaxis">Oral Prophylaxis</option><option value="Composite Restoration">Composite Restoration</option><option value="Root Canal Therapy">Root Canal Therapy</option><option value="Orthodontic Braces">Orthodontic Braces</option><option value="Dental Checkup">Dental Checkup</option></select>
<input aria-label="Search this table" class="table-search table-search-inline" data-table-search="dentist-table-3" placeholder="Search records..." type="search"/>
<select aria-label="Sort table" class="table-sort-control" data-table-sort="dentist-table-3">
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
<details class="filter-popover" data-filter-for="dentist-table-3">
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
<table id="dentist-table-3">
<thead>
<tr>
<th>
          Patient
         </th>
<th>
          Age
         </th>
<th>
          Phone
         </th>
<th>
          Allergies
         </th>
<th>
          Appointment
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
<tr data-procedure="Composite Restoration" data-segment="Restorative">
<td>
          Maria Santos
         </td>
<td>
          34
         </td>
<td>
          +63 917 842 1180
         </td>
<td>
          Penicillin
         </td>
<td>
          8:30 AM · Oral Prophylaxis
         </td>
<td>
          Completed
         </td>
<td>
<button class="table-action" onclick="document.getElementById('dentistPatientModal').showModal()" type="button">
           View / Update
          </button>
</td>
</tr>
<tr data-procedure="Composite Restoration" data-segment="Restorative">
<td>
          Joshua Lim
         </td>
<td>
          29
         </td>
<td>
          +63 918 337 1401
         </td>
<td>
          None
         </td>
<td>
          9:30 AM · Composite Restoration
         </td>
<td>
          Checked In
         </td>
<td>
<button class="table-action" onclick="document.getElementById('dentistPatientModal').showModal()" type="button">
           View / Update
          </button>
</td>
</tr>
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
<form action="{{ route('logout') }}" method="POST">
@csrf
<button class="btn danger" type="submit">
      Sign out
     </button>
</form>
</div>
</div>
</dialog>
<dialog aria-label="Mark Dentist Unavailable" class="modal modal-lg" id="availabilityModal">
<div class="modal-shell">
<div class="modal-head">
<div>
<p class="eyebrow">Dentist schedule</p>
<h3>Confirm unavailable schedule</h3>
<p>The calendar selection is filled automatically. Add the reason and an optional note before confirming.</p>
</div>
<button aria-label="Close" class="icon-btn" onclick="this.closest('dialog').close()" type="button">×</button>
</div>
<form class="modal-body" id="availabilityForm">
<div class="availability-selected-slot">
<div><small>Dentist</small><strong id="availabilityDentistDisplay">Dr. Angela Cerillo</strong></div>
<div><small>Selected schedule</small><strong id="availabilitySelectedDisplay">Choose a day or time box from the calendar</strong></div>
</div>
<input id="availabilityType" type="hidden" value="date"/>
<input id="availabilityDentist" type="hidden" value="Dr. Angela Cerillo"/>
<input id="availabilityDate" type="hidden"/>
<input id="availabilityEndDate" type="hidden"/>
<input id="availabilityStartTime" type="hidden"/>
<input id="availabilityEndTime" type="hidden"/>
<div class="form-section">
<div class="form-grid">
<label class="span-2">
        Reason for unavailability
        <select id="availabilityReason" required="">
<option value="">Select reason</option>
<option>Personal leave</option>
<option>Training / continuing education</option>
<option>Conference</option>
<option>Clinical meeting</option>
<option>Emergency leave</option>
<option>Other</option>
</select>
</label>
<label class="span-2">
        Notes
        <textarea id="availabilityNotes" placeholder="Optional note for Front Desk and Admin" rows="4"></textarea>
</label>
</div>
</div>
<div class="form-actions">
<button class="btn secondary" onclick="this.closest('dialog').close()" type="button">Cancel</button>
<button class="btn" type="submit">Confirm Unavailability</button>
</div>
</form>
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
<dialog aria-label="Patient Record — Maria Santos" class="modal modal-xl clinical-record-modal" data-patient-id="PT-2026-0018" data-patient-name="Maria Santos" id="dentistPatientModal">
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
<div class="premium-chart-actions">
<button class="btn secondary compact" data-chart-print="" type="button">Print Chart</button>
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
</section>
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
<script id="dentistAvailabilityWorkflow">
   (function hydrateDentistIdentity(){
  const storedName = localStorage.getItem('cerilloCurrentUserName');
  const displayName = storedName && /^Dr\./.test(storedName) ? storedName : 'Dr. Angela Cerillo';
  const accountName = document.getElementById('dentistAccountName');
  if (accountName) accountName.textContent = displayName;
  const dentistInput = document.getElementById('availabilityDentist');
  const dentistDisplay = document.getElementById('availabilityDentistDisplay');
  if (dentistInput) dentistInput.value = displayName;
  if (dentistDisplay) dentistDisplay.textContent = displayName;
})();

function getDentistBlocks() {
  try {
    return JSON.parse(localStorage.getItem('cerilloDentistBlocks') || '[]');
  } catch (error) {
    return [];
  }
}

function saveDentistBlocks(blocks) {
  localStorage.setItem('cerilloDentistBlocks', JSON.stringify(blocks));
}

function renderDentistAppointmentAvailability() {
  const holder = document.getElementById('dentistAppointmentAvailabilityChips');
  if (!holder) return;

  const blocks = getDentistBlocks();
  holder.innerHTML = blocks.length
    ? blocks.map((block) => `
        <span class="availability-chip">
          ${block.label || block.date} · ${block.time || 'All day'} · ${block.reason}
        </span>
      `).join('')
    : '<span class="availability-empty">No additional blocked schedules.</span>';
}

function renderDentistBlocks() {
  const holder = document.getElementById('dentistAvailabilityTable');
  if (!holder) return;
  holder.querySelectorAll('[data-local-block]').forEach((item) => item.remove());
  getDentistBlocks().forEach((block, index) => {
    const item = document.createElement('article');
    item.className = 'availability-record';
    item.dataset.localBlock = '1';
    const dateText = block.type === 'week' ? `${block.date} – ${block.endDate}` : block.date;
    const timeText = block.type === 'week' ? '<span class="badge info">Full Week</span>' : (block.time || 'All day');
    item.innerHTML = `
      <div><small>Dentist</small><strong>${block.dentist || 'Dr. Angela Cerillo'}</strong></div>
      <div><small>Date</small><strong>${dateText}</strong></div>
      <div><small>Time</small><strong>${timeText}</strong></div>
      <div><small>Reason</small><strong>${block.reason || 'Unavailable'}${block.notes ? ` · ${block.notes}` : ''}</strong></div>
      <button class="availability-remove" type="button" data-remove-block="${index}">Remove</button>`;
    holder.prepend(item);
  });
  holder.querySelectorAll('[data-remove-block]').forEach((button) => button.addEventListener('click', () => {
    const blocks = getDentistBlocks(); blocks.splice(Number(button.dataset.removeBlock),1); saveDentistBlocks(blocks); renderDentistBlocks();
  }));
  renderDentistAppointmentAvailability();
}

function openAvailabilitySelection(selection) {
  const modal = document.getElementById('availabilityModal');
  const accountName = document.getElementById('dentistAccountName')?.textContent.trim() || 'Dentist';
  document.getElementById('availabilityDentist').value = accountName;
  document.getElementById('availabilityDentistDisplay').textContent = accountName;
  document.getElementById('availabilityType').value = selection.type;
  document.getElementById('availabilityDate').value = selection.date;
  document.getElementById('availabilityEndDate').value = selection.endDate || selection.date;
  document.getElementById('availabilityStartTime').value = selection.startTime || '';
  document.getElementById('availabilityEndTime').value = selection.endTime || '';
  document.getElementById('availabilitySelectedDisplay').textContent = selection.display;
  document.getElementById('availabilityReason').value = '';
  document.getElementById('availabilityNotes').value = '';
  modal.showModal();
}

(function bindCalendarAvailabilityPicker() {
  const calendarSection = document.getElementById('calendar');
  const startButton = document.getElementById('startAvailabilityPicker');
  const grid = calendarSection?.querySelector('.weekly-calendar');
  if (!calendarSection || !startButton || !grid) return;

  const dates = ['2026-10-05','2026-10-06','2026-10-07','2026-10-08','2026-10-09'];
  const dayHeaders = Array.from(grid.querySelectorAll('.calendar-day'));
  const slots = Array.from(grid.querySelectorAll('.calendar-slot'));
  const hours = ['08:00','09:00','10:00'];

  dayHeaders.forEach((header, index) => {
    header.dataset.availabilityDate = dates[index] || '';
    header.title = 'Mark this whole day unavailable';
  });
  slots.forEach((slot, index) => {
    slot.dataset.availabilityDate = dates[index % 5] || '';
    const row = Math.floor(index / 5);
    const start = hours[row] || '09:00';
    const endHour = String(Number(start.slice(0,2)) + 1).padStart(2,'0') + ':00';
    slot.dataset.availabilityStart = start;
    slot.dataset.availabilityEnd = endHour;
    if (!slot.classList.contains('event') && !slot.classList.contains('blocked')) {
      slot.title = 'Mark this time unavailable';
    }
  });

  startButton.addEventListener('click', () => {
    calendarSection.classList.toggle('availability-pick-mode');
    if (calendarSection.classList.contains('availability-pick-mode')) {
      calendarSection.querySelector('.weekly-calendar-scroll')?.scrollIntoView({behavior:'smooth', block:'center'});
    }
  });

  grid.addEventListener('click', (event) => {
    if (!calendarSection.classList.contains('availability-pick-mode')) return;
    const day = event.target.closest('.calendar-day');
    const slot = event.target.closest('.calendar-slot:not(.event):not(.blocked)');
    if (!day && !slot) return;

    if (day) {
      const date = day.dataset.availabilityDate;
      openAvailabilitySelection({type:'date', date, endDate:date, display:`${day.textContent.trim()} · All day`});
    } else {
      const date = slot.dataset.availabilityDate;
      const startTime = slot.dataset.availabilityStart;
      const endTime = slot.dataset.availabilityEnd;
      openAvailabilitySelection({type:'time', date, endDate:date, startTime, endTime, display:`${date} · ${startTime}–${endTime}`});
    }
    calendarSection.classList.remove('availability-pick-mode');
  });
})();

document.getElementById('availabilityForm')?.addEventListener('submit', async (event) => {
  event.preventDefault();
  const type = document.getElementById('availabilityType').value;
  const date = document.getElementById('availabilityDate').value;
  const endDate = document.getElementById('availabilityEndDate').value || date;
  const startTime = document.getElementById('availabilityStartTime').value;
  const endTime = document.getElementById('availabilityEndTime').value;
  const reason = document.getElementById('availabilityReason').value;
  if (!date) {
    alert('Select a day or time box from the calendar first.');
    document.getElementById('availabilityModal').close();
    return;
  }

  const startsAt = type === 'time' ? `${date}T${startTime}:00` : `${date}T09:00:00`;
  const endsAt = type === 'time' ? `${date}T${endTime}:00` : `${endDate}T17:00:00`;
  const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
  try {
    const response = await fetch('/api/blocks', {
      method: 'POST',
      headers: {'Accept':'application/json','Content-Type':'application/json','X-CSRF-TOKEN':token},
      body: JSON.stringify({dentist_id: {{ auth()->id() }}, starts_at: startsAt, ends_at: endsAt, reason})
    });
    if (!response.ok) {
      const payload = await response.json().catch(() => ({}));
      throw new Error(payload.message || 'Unable to save unavailable schedule.');
    }
    document.getElementById('availabilityModal').close();
    await window.refreshDentistCalendar?.();
  } catch (error) {
    alert(error.message || 'Unable to save unavailable schedule.');
  }
});

renderDentistBlocks();
renderDentistAppointmentAvailability();

(function bindDentistXrayForm() {
  const modal = document.getElementById('addXrayModal');
  if (!modal) return;

  const patientSelect = modal.querySelector('.xrayPatientSelect');
  const files = document.getElementById('xrayFiles');
  const preview = document.getElementById('xrayUploadPreview');

  patientSelect.addEventListener('change', () => {
    const option = patientSelect.selectedOptions[0];
    modal.querySelector('.xrayPatientName').textContent = option.value || 'Select a patient';
    modal.querySelector('.xrayPatientId').textContent = `Patient ID ${window.CerilloFormat?.patientCode(option.dataset.id, option.dataset.rawId) || option.dataset.id || '—'}`;
    modal.querySelector('.xrayPatientPhone').textContent = `Phone ${window.CerilloFormat?.phone(option.dataset.phone) || option.dataset.phone || '—'}`;
    modal.querySelector('.xrayPatientEmail').textContent = `Email ${option.dataset.email || '—'}`;
    modal.querySelector('.xrayPatientDob').textContent = `DOB ${option.dataset.dob || '—'}`;
  });

  files?.addEventListener('change', () => {
    preview.innerHTML = '';

    [...files.files].slice(0, 3).forEach((file) => {
      const image = document.createElement('img');
      image.src = URL.createObjectURL(file);
      image.alt = 'Selected X-ray preview';
      preview.appendChild(image);
    });

    if (!files.files.length) {
      preview.innerHTML = '<span>No images selected.</span>';
    }
  });

  document.getElementById('addXrayForm')?.addEventListener('submit', (event) => {
    event.preventDefault();

    const patient = patientSelect.value;
    const record = {
      patient,
      type: document.getElementById('xrayType').value,
      date: document.getElementById('xrayDate').value,
      area: document.getElementById('xrayArea').value,
      findings: document.getElementById('xrayFindings').value
    };

    const records = JSON.parse(localStorage.getItem('cerilloXrayRecords') || '[]');
    records.unshift(record);
    localStorage.setItem('cerilloXrayRecords', JSON.stringify(records));

    document.getElementById('addXrayModal').close();
    event.target.reset();
    preview.innerHTML = '<span>No images selected.</span>';
    alert(`X-ray record attached to ${patient}'s patient record.`);
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
        tooth.dataset.finding = condition;
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
<dialog class="modal modal-lg today-patient-modal" id="clinicalUpdateModal">
<div class="modal-shell">
<header class="modal-header">
<div>
<p class="eyebrow">
       Today's Patient
      </p>
<h3>
       Update Clinical Record
      </h3>
</div>
<button class="icon-btn" onclick="this.closest('dialog').close()" type="button">
      ×
     </button>
</header>
<div class="modal-body">
<form class="form-grid">
<label>
       Patient
       <input readonly="" value="Maria Santos · PT-2026-0018"/>
</label>
<label>
       Appointment
       <input readonly="" value="05 Oct 2026 · 8:30 AM"/>
</label>
<label>
       Procedure
       <select>
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
         Extraction
        </option>
</select>
</label>
<label>
       Status
       <select>
<option>
         Checked In
        </option>
<option>
         In Progress
        </option>
<option>
         Completed
        </option>
<option>
         Cancelled
        </option>
</select>
</label>
<label class="span-2">
       Findings
       <textarea required="" rows="4">Generalized light calculus. Tooth #30 recurrent caries noted clinically.</textarea>
</label>
<label class="span-2">
       Dentist notes
       <textarea required="" rows="4"></textarea>
</label>
<label>
       Follow-up date
       <input type="date" value="2026-10-19"/>
</label>
<label>
       Next recommended service
       <input value="Restorative consultation"/>
</label>
<div class="form-actions span-2">
<button class="btn btn-secondary" onclick="this.closest('dialog').close()" type="button">
        Cancel
       </button>
<button class="btn" onclick="this.closest('dialog').close(); alert('Clinical record updated for today's patient.')" type="button">
        Save Clinical Update
       </button>
</div>
</form>
</div>
</div>
</dialog>
<script id="dentistClinicalUpdate">
   document.querySelectorAll('[data-clinical-edit]').forEach(function(b){b.addEventListener('click',function(){document.getElementById('clinicalUpdateModal').showModal();});});
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
<p data-xray-detail-subtitle="">Maria Santos · PT-2026-0018</p>
</div>
<button aria-label="Close X-ray details" class="icon-btn" onclick="this.closest('dialog').close()" type="button">×</button>
</header>
<div class="modal-body xray-detail-layout">
<div class="patient-xray-detail-image">
<img alt="Patient dental radiograph" data-xray-detail-image="" src="{{ asset('assets/images/xray-panoramic.png') }}"/>
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
<div><small>Dentist</small><strong data-da-dentist="">Dr. Angela Cerillo</strong></div>
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

    async function hydrateDentalChart(chart, patientId) {
     if (!chart || !patientId) return;
     try {
      const response = await fetch('/api/patients/' + encodeURIComponent(patientId) + '/chart', {headers:{Accept:'application/json'}});
      if (!response.ok) return;
      const payload = await response.json();
      const toothNumbers = new Map((payload.teeth || []).map((tooth) => [String(tooth.id), String(tooth.fdi_number)]));
      (payload.current || []).forEach((record) => {
       const number = toothNumbers.get(String(record.tooth_id));
       const tooth = number ? (chart.querySelector('.tooth-unit[data-tooth-fdi="' + number + '"]') || chart.querySelector('.tooth-unit[data-tooth="' + number + '"]')) : null;
       if (!tooth) return;
       tooth.dataset.toothId = record.tooth_id;
       const condition = record.condition || 'Finding recorded';
       tooth.dataset.databaseCondition = condition;
       tooth.title = 'Tooth ' + number + ' · ' + condition;
       tooth.classList.remove('tooth-sound', 'tooth-decay', 'tooth-finding', 'tooth-planned', 'tooth-completed', 'tooth-missing', 'tooth-impacted');
       const normalized = condition.toLowerCase();
       tooth.classList.add(normalized.includes('caries') || normalized.includes('decay') ? 'tooth-decay' : normalized.includes('missing') || normalized.includes('extracted') ? 'tooth-missing' : normalized.includes('impacted') ? 'tooth-impacted' : 'tooth-finding');
      });
      chart.querySelectorAll('.tooth-unit').forEach((tooth) => {
       const fdi = String(tooth.dataset.toothFdi || '');
       const universal = String(tooth.dataset.tooth || '');
       const match = (payload.teeth || []).find((item) => String(item.fdi_number) === fdi)
        || (payload.teeth || []).find((item) => String(item.fdi_number) === universal);
       if (match) {
        tooth.dataset.toothId = match.id;
        tooth.dataset.toothFdi = match.fdi_number;
        tooth.dataset.chartNumber = match.chart_number || match.position || tooth.dataset.chartNumber || '';
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
       if (placeholder) placeholder.hidden = true;
       if (chartWrapper) chartWrapper.hidden = false;
       if (startBtn) startBtn.hidden = true;
       if (saveBtn) {
        saveBtn.hidden = false;
        saveBtn.disabled = false;
        saveBtn.textContent = 'Save Record';
       }
       setTimeout(() => {
        window.dispatchEvent(new Event('resize'));
       }, 50);
      } else if (isCompleted) {
       if (placeholder) placeholder.hidden = true;
       if (chartWrapper) chartWrapper.hidden = false;
       if (startBtn) startBtn.hidden = true;
       if (saveBtn) {
        saveBtn.hidden = false;
        saveBtn.disabled = false;
        saveBtn.textContent = 'Update Record';
       }
       setTimeout(() => {
        window.dispatchEvent(new Event('resize'));
       }, 50);
      } else {
       if (placeholder) placeholder.hidden = false;
       if (chartWrapper) chartWrapper.hidden = true;
       if (saveBtn) saveBtn.hidden = true;
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

    function openSaveConfirmModal() {
     const modal = getModal();
     const confirmModal = getConfirmModal();
     if (!modal) return;
     if (!confirmModal) {
      saveAppointmentChart();
      return;
     }
     const patientName = modal.dataset.patientName || 'Patient';
     const patientCode = modal.dataset.patientCode || '';
     const proc = modal.querySelector('[data-da-procedure]')?.textContent || 'Dental Appointment';

     confirmModal.querySelector('[data-confirm-patient-name]').textContent = patientName + (patientCode ? ' · ' + patientCode : '');
     confirmModal.querySelector('[data-confirm-appt-info]').textContent = proc;
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
      let savedTeethCount = 0;
      if (chart) {
       const changed = Array.from(chart.querySelectorAll('.tooth-unit')).filter(tooth => {
        return Boolean(tooth.dataset.finding || (tooth.dataset.condition && tooth.dataset.condition !== tooth.dataset.databaseCondition));
       });

       for (const tooth of changed) {
        const toothId = tooth.dataset.toothId || tooth.dataset.tooth;
        const condition = tooth.dataset.finding || tooth.dataset.condition || 'Sound / Healthy';
        const response = await fetch('/api/appointments/' + encodeURIComponent(appointmentId) + '/teeth', {
         method: 'POST',
         headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
         },
         body: JSON.stringify({
          tooth_id: toothId,
          tooth_id_is_database_id: Boolean(tooth.dataset.toothId),
          tooth_fdi: tooth.dataset.toothFdi || null,
          condition: condition,
          surfaces: String(tooth.dataset.surfaces || '').split('').filter(Boolean),
          notes: tooth.dataset.notes || ''
         })
        });
        const payload = await response.json().catch(() => ({}));
        if (!response.ok) throw new Error(payload.message || Object.values(payload.errors || {}).flat().join(', ') || 'Unable to save tooth finding.');
        tooth.dataset.databaseCondition = condition;
        delete tooth.dataset.finding;
        savedTeethCount++;
       }
      }

      // Collect clinical details
      const clinicalNotes = modal.querySelector('#toothClinicalNotes')?.value?.trim() || modal.querySelector('#autoProgressNote')?.value?.trim() || '';
      const pulpal = modal.querySelector('#toothPulpalDiagnosis')?.value?.trim() || '';
      const apical = modal.querySelector('#toothApicalDiagnosis')?.value?.trim() || '';
      const treatment = modal.querySelector('#toothTreatment')?.value?.trim() || '';
      const diagnosis = [pulpal, apical].filter(Boolean).join(' · ');
      const prescriptionPanel = modal.querySelector('[data-extraction-prescription-panel]');
      const extractionSelected = Boolean(prescriptionPanel && !prescriptionPanel.hidden);
      const prescriptionDetails = extractionSelected ? {
       medication: modal.querySelector('[data-extraction-rx-medication]')?.value?.trim() || '',
       dosage: modal.querySelector('[data-extraction-rx-dosage]')?.value?.trim() || '',
       frequency: modal.querySelector('[data-extraction-rx-frequency]')?.value?.trim() || '',
       instructions: modal.querySelector('[data-extraction-rx-instructions]')?.value?.trim() || ''
      } : null;
      const prescriptionSummary = prescriptionDetails ? [
       prescriptionDetails.medication ? 'Medication: ' + prescriptionDetails.medication : '',
       prescriptionDetails.dosage ? 'Dosage: ' + prescriptionDetails.dosage : '',
       prescriptionDetails.frequency ? 'Frequency: ' + prescriptionDetails.frequency : '',
       prescriptionDetails.instructions ? 'Instructions: ' + prescriptionDetails.instructions : ''
      ].filter(Boolean).join('\n') : '';

      // Commit draft consultation charges if present
      const finishBtn = modal.querySelector('[data-consultation-finish]');
      const submitBtn = modal.querySelector('[data-consultation-submit]');
      if (submitBtn) {
       submitBtn.click();
      } else if (finishBtn && !finishBtn.disabled) {
       finishBtn.click();
       const modalSubmit = modal.querySelector('[data-consultation-submit]');
       if (modalSubmit) modalSubmit.click();
      }

      // Complete the appointment in DB (transitions status to Completed and finalizes clinical session)
      const completeRes = await fetch('/api/appointments/' + encodeURIComponent(appointmentId) + '/complete', {
       method: 'POST',
       headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
       },
       body: JSON.stringify({
        treatment_notes: clinicalNotes || 'Dental assessment and clinical treatments recorded.',
        diagnosis: diagnosis || null,
        treatment_recommendations: extractionSelected ? 'Tooth Extraction' : (treatment && treatment !== 'None' ? treatment : null),
        clinical_findings: savedTeethCount > 0 ? `${savedTeethCount} tooth findings recorded.` : 'Clinical findings recorded.',
        prescriptions: prescriptionSummary || null,
        prescription_details: prescriptionDetails
       })
      });

      const completeData = await completeRes.json().catch(() => ({}));
      if (!completeRes.ok) {
       // If complete returned validation or status issue, also try notes route as fallback
       await fetch('/api/appointments/' + encodeURIComponent(appointmentId) + '/clinical', {
        method: 'PUT',
        headers: {
         Accept: 'application/json',
         'Content-Type': 'application/json',
         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({
         treatment_notes: clinicalNotes
        })
       }).catch(() => {});
      }

      // Update UI Status to Completed
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

      const pid = currentAppointment?.patient?.id || modal.dataset.patientId || completeData?.patient_id;
      if (chart && pid) {
       hydrateDentalChart(chart, pid);
      }

      if (typeof window.loadPatients === 'function') {
       window.loadPatients();
      }
      if (typeof window.loadAppointments === 'function') {
       window.loadAppointments();
      }
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

    window.openDentistAppointment = function (idOrButton) {
     const modal = getModal();
     if (!modal) return;

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

     let patientName = 'Visitor';
     let procedure = 'Dental Appointment';
     let dateStr = new Date().toLocaleDateString(undefined, {day:'2-digit',month:'short',year:'numeric'});
     let timeStr = '9:00 AM';
     let status = 'Pending';
     let dentist = 'Dr. Angela Cerillo';
     let contact = 'Not provided';
     let dob = 'Not provided';
     let notes = 'No notes recorded.';
     let concern = 'No concern recorded.';
     let patientId = '';

     if (targetRow) {
      const cells = targetRow.querySelectorAll('td');
      if (cells.length === 4) {
       timeStr = cells[0]?.textContent?.trim() || timeStr;
       patientName = cells[1]?.textContent?.trim() || patientName;
       procedure = cells[2]?.textContent?.trim() || procedure;
       status = cells[3]?.querySelector('.status, .badge')?.textContent?.trim() || cells[3]?.textContent?.trim() || status;
       dateStr = new Date().toLocaleDateString(undefined, {day:'2-digit',month:'short',year:'numeric'});
      } else if (cells.length >= 5) {
       patientName = cells[0]?.textContent?.trim() || patientName;
       procedure = cells[1]?.textContent?.trim() || procedure;
       dateStr = cells[2]?.textContent?.trim() || dateStr;
       timeStr = cells[3]?.textContent?.trim() || timeStr;
       status = cells[4]?.querySelector('.status, .badge')?.textContent?.trim() || cells[4]?.textContent?.trim() || status;
      }
     }

     modal.dataset.appointmentId = actualId || '';
     modal.dataset.patientId = '';
     modal.dataset.patientName = patientName;
     modal.dataset.patientCode = '';
     modal.dataset.startsAt = targetRow?.dataset?.startsAt || dateStr || '';
     window.resetDentistExtractionPrescription?.(modal);

     const titleEl = modal.querySelector('[data-dentist-appt-title]');
     if (titleEl) titleEl.textContent = patientName + ' · ' + procedure;
     const pEl = modal.querySelector('[data-da-patient]');
     if (pEl) pEl.textContent = patientName;
     const procEl = modal.querySelector('[data-da-procedure]');
     if (procEl) procEl.textContent = procedure;
     const dateEl = modal.querySelector('[data-da-date]');
     if (dateEl) dateEl.textContent = dateStr;
     const timeEl = modal.querySelector('[data-da-time]');
     if (timeEl) timeEl.textContent = timeStr;
     const stEl = modal.querySelector('[data-da-status]');
     if (stEl) stEl.textContent = status;
     const dentEl = modal.querySelector('[data-da-dentist]');
     if (dentEl) dentEl.textContent = dentist;
     const srcEl = modal.querySelector('[data-da-source]');
     if (srcEl) srcEl.textContent = 'online';
     const dobEl = modal.querySelector('[data-da-dob]');
     if (dobEl) dobEl.textContent = dob;
     const conEl = modal.querySelector('[data-da-contact]');
     if (conEl) conEl.textContent = contact;
     const notesEl = modal.querySelector('[data-da-notes]');
     if (notesEl) notesEl.textContent = notes;
     const concernEl = modal.querySelector('[data-da-concern]');
     if (concernEl) concernEl.textContent = concern;

     updateAssessmentState(status, modal.dataset.startsAt);

     const msg = modal.querySelector('[data-appointment-chart-message]');
     if (msg) msg.textContent = '';

     if (!modal.open) {
      if (typeof modal.showModal === 'function') {
       modal.showModal();
      } else {
       modal.setAttribute('open', '');
      }
     }

     if (actualId) {
      fetch('/api/appointments/' + encodeURIComponent(actualId), {headers:{Accept:'application/json'}})
       .then(res => res.ok ? res.json() : null)
       .then(appointment => {
        if (!appointment) return;
        currentAppointment = appointment;
        const intake = appointment.intake_details || {};
        const parsedDate = new Date(String(appointment.starts_at).replace(' ', 'T'));

        patientName = appointment.patient?.name || appointment.guest_name || patientName;
        procedure = appointment.service?.name || procedure;
        status = appointment.status || status;
        dentist = appointment.dentist?.name || dentist;
        patientId = appointment.patient?.id || '';

        modal.dataset.appointmentId = appointment.id;
        modal.dataset.patientId = patientId;
        modal.dataset.patientName = patientName;
        modal.dataset.patientCode = appointment.patient?.formatted_patient_code || window.CerilloFormat?.patientCode(appointment.patient?.patient_code, appointment.patient?.id) || '';
        modal.dataset.startsAt = appointment.starts_at || '';

        const dateFormatted = (function(raw) {
          if (!raw) return dateStr;
          const m = String(raw).match(/^(\d{4})-(\d{2})-(\d{2})/);
          if (m) {
            const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            return `${m[3]} ${months[parseInt(m[2], 10) - 1]} ${m[1]}`;
          }
          const p = new Date(raw);
          return isNaN(p.getTime()) ? dateStr : p.toLocaleDateString(undefined,{day:'2-digit',month:'short',year:'numeric'});
        })(appointment.starts_at);

        const timeFormatted = (function(raw) {
          if (!raw) return timeStr;
          const match = String(raw).match(/[ T](\d{2}):(\d{2})/);
          if (match) {
            const hour = Number(match[1]);
            const minute = match[2];
            return `${hour % 12 || 12}:${minute} ${hour >= 12 ? 'PM' : 'AM'}`;
          }
          const p = new Date(raw);
          return isNaN(p.getTime()) ? timeStr : p.toLocaleTimeString('en-US', {hour:'numeric',minute:'2-digit',hour12:true});
        })(appointment.starts_at);

        if (titleEl) titleEl.textContent = patientName + ' · ' + procedure;
        if (pEl) pEl.textContent = patientName;
        if (procEl) procEl.textContent = procedure;
        if (dateEl) dateEl.textContent = dateFormatted;
        if (timeEl) timeEl.textContent = timeFormatted;
        if (stEl) stEl.textContent = status;
        if (dentEl) dentEl.textContent = dentist;
        if (srcEl) srcEl.textContent = (appointment.source || 'online').replace('_',' ');

        const dateOfBirth = appointment.patient?.date_of_birth || intake.date_of_birth;
        const age = dateOfBirth ? Math.floor((Date.now() - new Date(dateOfBirth).getTime()) / 31557600000) : null;
        if (dobEl) {
          if (dateOfBirth) {
            const dobClean = String(dateOfBirth).slice(0, 10);
            dobEl.textContent = `${dobClean} || ${age !== null && age >= 0 ? age : '—'}`;
          } else {
            dobEl.textContent = dob;
          }
        }
        if (conEl) conEl.textContent = [appointment.formatted_guest_phone || window.CerilloFormat?.phone(appointment.guest_phone), appointment.guest_email].filter(Boolean).join(' · ') || contact;
        if (notesEl) notesEl.textContent = intake.notes || intake.additional_notes || appointment.treatment_notes || notes;
        if (concernEl) concernEl.textContent = intake.medical_concern || intake.reason_for_visit || concern;

        updateAssessmentState(status, appointment.starts_at);
        window.syncDentistExtractionPrescription?.(modal, appointment);

        const chart = modal.querySelector('[data-appointment-chart-wrapper] .premium-dental-chart');
        if (chart && patientId) {
         hydrateDentalChart(chart, patientId);
        }
       })
       .catch(err => {
        console.warn('Live API enrichment note:', err);
       });
     }
    };

    document.addEventListener('click', (event) => {
     const modal = getModal();
     const confirmModal = getConfirmModal();

     if (event.target.closest('[data-appointment-start-assessment]')) {
      startAssessment();
      return;
     }
     if (event.target.closest('[data-appointment-chart-save]')) {
      openSaveConfirmModal();
      return;
     }
     if (event.target.closest('[data-confirm-save-btn]')) {
      if (confirmModal) confirmModal.close();
      saveAppointmentChart();
      return;
     }

     const apptBtn = event.target.closest('#dentist-table-1 tr[data-appointment-id], #dentist-table-2 .appointment-view, #dentist-table-2 [data-appointment-id], #dentist-table-2 button.table-action');
     if (apptBtn) {
      event.preventDefault();
      window.openDentistAppointment(apptBtn);
      return;
     }

     const patientBtn = event.target.closest('#dentist-table-3 [data-live-patient-id], #dentist-table-3 button.table-action');
     if (patientBtn) {
      event.preventDefault();
      const patientModal = document.getElementById('dentistPatientModal');
      if (patientModal) patientModal.showModal();
      return;
     }
    });
   })();
</script>
<script id="dentistCalendarInteractionV2">
(function () {
  const section = document.getElementById('calendar');
  const weekGrid = document.getElementById('dentistInteractiveWeek');
  const weekWrap = document.getElementById('dentistCalendarWeek');
  const monthGrid = document.getElementById('dentistCalendarMonth');
  const title = document.getElementById('dentistCalendarTitle');
  const note = document.getElementById('dentistCalendarSelection');
  const monthRail = document.getElementById('dentistCalendarMonthRail');
  const yearLabel = document.getElementById('dentistCalendarYear');
  const agenda = document.getElementById('dentistCalendarAppointments');
  const agendaLabel = document.getElementById('dentistCalendarAgendaLabel');
  if (!section || !weekGrid || !weekWrap || !monthGrid || !title || !agenda) return;

  let anchor = new Date();
  anchor.setHours(12, 0, 0, 0);
  let view = 'week';
  let selectedDate = null;
  let liveAppointments = [];
  let liveBlocks = [];
  const hours = [9,10,11,12,13,14,15,16,17];
  const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  const pad = n => String(n).padStart(2, '0');
  const iso = d => `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`;
  const escapeHtml = value => String(value ?? '').replace(/[&<>"']/g, char => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
  const fmtTime = value => {
    const d = value instanceof Date ? value : new Date(value);
    if (Number.isNaN(d.getTime())) return '—';
    return d.toLocaleTimeString('en-US', { hour:'numeric', minute:'2-digit', hour12:true });
  };
  const monday = d => {
    const x = new Date(d);
    const day = x.getDay() || 7;
    x.setDate(x.getDate() - day + 1);
    x.setHours(12,0,0,0);
    return x;
  };
  const sameDay = (value, date) => iso(new Date(value)) === iso(date);
  const statusClass = status => status === 'Completed' ? 'completed' : status === 'Cancelled' ? 'cancelled' : status === 'Checked In' ? 'checked' : 'progress';
  const statusLabelClass = status => status === 'Completed' ? 'success' : status === 'Cancelled' ? 'danger' : status === 'Checked In' ? 'info' : 'warning';

  function rangeForView() {
    if (view === 'month') {
      return {
        start: new Date(anchor.getFullYear(), anchor.getMonth(), 1, 12),
        end: new Date(anchor.getFullYear(), anchor.getMonth() + 1, 0, 12)
      };
    }
    const start = monday(anchor);
    const end = new Date(start);
    end.setDate(start.getDate() + 5);
    return { start, end };
  }

  function blockCoversHour(block, day, hour) {
    const start = new Date(block.starts_at);
    const end = new Date(block.ends_at);
    const slotStart = new Date(day);
    slotStart.setHours(hour,0,0,0);
    const slotEnd = new Date(day);
    slotEnd.setHours(hour+1,0,0,0);
    return start < slotEnd && end > slotStart;
  }

  function blockCoversDay(block, day) {
    const start = new Date(block.starts_at);
    const end = new Date(block.ends_at);
    const dayStart = new Date(day); dayStart.setHours(0,0,0,0);
    const dayEnd = new Date(day); dayEnd.setHours(23,59,59,999);
    return start <= dayEnd && end >= dayStart;
  }

  function periodAppointments() {
    const { start, end } = rangeForView();
    const from = iso(start), to = iso(end);
    return liveAppointments.filter(a => {
      const d = a.starts_at ? iso(new Date(a.starts_at)) : '';
      return d >= from && d <= to;
    }).sort((a,b) => new Date(a.starts_at) - new Date(b.starts_at));
  }

  function periodBlocks() {
    const { start, end } = rangeForView();
    const rangeStart = new Date(start); rangeStart.setHours(0,0,0,0);
    const rangeEnd = new Date(end); rangeEnd.setHours(23,59,59,999);
    return liveBlocks.filter(block => new Date(block.starts_at) <= rangeEnd && new Date(block.ends_at) >= rangeStart)
      .sort((a,b) => new Date(a.starts_at) - new Date(b.starts_at));
  }

  function renderMonthRail() {
    if (!monthRail) return;
    if (yearLabel) yearLabel.textContent = String(anchor.getFullYear());
    monthRail.innerHTML = monthNames.map((name,index) => {
      const count = liveAppointments.filter(a => {
        if (!a.starts_at) return false;
        const d = new Date(a.starts_at);
        return d.getFullYear() === anchor.getFullYear() && d.getMonth() === index;
      }).length;
      return `<button type="button" class="admin-month-rail-item ${index === anchor.getMonth() ? 'active' : ''}" data-dentist-rail-month="${index}"><span>${name}</span><small>${count || ''}</small></button>`;
    }).join('');
  }

  function renderAgenda() {
    let appointments = periodAppointments();
    let blocks = periodBlocks();
    if (selectedDate) {
      appointments = appointments.filter(a => sameDay(a.starts_at, selectedDate));
      blocks = blocks.filter(b => blockCoversDay(b, selectedDate));
    }
    const labelDate = selectedDate
      ? selectedDate.toLocaleDateString('en-US',{weekday:'long',month:'short',day:'numeric'})
      : (view === 'month' ? `${monthNames[anchor.getMonth()]} ${anchor.getFullYear()}` : 'This week');
    if (agendaLabel) agendaLabel.textContent = labelDate;

    const items = [];
    appointments.forEach(a => {
      const starts = new Date(a.starts_at);
      const patient = a.patient?.name || a.guest_name || 'Guest patient';
      const service = a.service?.name || 'Appointment';
      items.push({ when: starts, html: `<button class="admin-calendar-agenda-item ${statusClass(a.status)}" data-dentist-event data-appointment-id="${a.id}" type="button"><span class="agenda-status-dot"></span><span class="agenda-time"><strong>${escapeHtml(fmtTime(starts))}</strong><small>${escapeHtml(starts.toLocaleDateString('en-US',{month:'short',day:'numeric'}))}</small></span><span class="agenda-copy"><strong>${escapeHtml(patient)}</strong><small>${escapeHtml(service)}</small></span><span class="status ${statusLabelClass(a.status)}">${escapeHtml(a.status)}</span></button>` });
    });
    blocks.forEach(block => {
      const starts = new Date(block.starts_at);
      const ends = new Date(block.ends_at);
      const same = iso(starts) === iso(ends);
      const timeText = same ? `${fmtTime(starts)}–${fmtTime(ends)}` : 'Multi-day';
      items.push({ when: starts, html: `<div class="admin-calendar-agenda-item calendar-block-agenda"><span class="agenda-status-dot"></span><span class="agenda-time"><strong>${escapeHtml(timeText)}</strong><small>${escapeHtml(starts.toLocaleDateString('en-US',{month:'short',day:'numeric'}))}</small></span><span class="agenda-copy"><strong>Unavailable</strong><small>${escapeHtml(block.reason || 'Blocked schedule')}</small></span><span class="status info">Unavailable</span></div>` });
    });
    items.sort((a,b) => a.when - b.when);
    agenda.innerHTML = items.length ? items.map(x => x.html).join('') : '<div class="admin-calendar-agenda-empty"><strong>No schedule records</strong><span>No appointments or unavailable schedules match this period.</span></div>';
  }

  function renderWeek() {
    const start = monday(anchor);
    const days = Array.from({length:6},(_,i) => { const d = new Date(start); d.setDate(start.getDate()+i); return d; });
    title.textContent = `${days[0].toLocaleDateString('en-US',{month:'short',day:'numeric'})} – ${days[5].toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'})}`;
    weekGrid.style.gridTemplateColumns = `90px repeat(${days.length}, 1fr)`;
    let html = '<div class="calendar-time calendar-corner">Time</div>' + days.map(d => `<button class="calendar-day admin-calendar-day ${selectedDate && iso(selectedDate)===iso(d) ? 'selected-day' : ''}" data-date="${iso(d)}" data-availability-date="${iso(d)}" type="button"><span>${d.toLocaleDateString('en-US',{weekday:'short'})}</span><strong>${d.getDate()}</strong></button>`).join('');
    hours.forEach(h => {
      const timeDate = new Date(2000,0,1,h,0,0);
      html += `<div class="calendar-time">${fmtTime(timeDate)}</div>`;
      days.forEach(d => {
        const events = liveAppointments.filter(a => {
          if (!a.starts_at) return false;
          const x = new Date(a.starts_at);
          return sameDay(x,d) && x.getHours() === h;
        }).sort((a,b)=>new Date(a.starts_at)-new Date(b.starts_at));
        const block = liveBlocks.find(b => blockCoversHour(b,d,h));
        if (events.length) {
          html += `<div class="calendar-slot admin-calendar-event-stack">${events.map(e => `<button class="admin-calendar-event ${statusClass(e.status)}" data-dentist-event data-appointment-id="${e.id}" type="button"><strong>${escapeHtml(e.patient?.name || e.guest_name || 'Guest patient')}</strong><small>${escapeHtml(e.service?.name || 'Appointment')}</small><span>${escapeHtml(e.status)}</span></button>`).join('')}</div>`;
        } else if (block) {
          html += `<div class="calendar-slot blocked admin-calendar-blocked"><strong>Unavailable</strong><small>${escapeHtml(block.reason || 'Blocked schedule')}</small></div>`;
        } else if (h === 17) {
          html += '<div class="calendar-slot calendar-closing"><small>Clinic close</small></div>';
        } else {
          html += `<button class="calendar-slot admin-empty-slot" data-slot-date="${iso(d)}" data-slot="${iso(d)} · ${fmtTime(timeDate)}" data-availability-date="${iso(d)}" data-availability-start="${pad(h)}:00" data-availability-end="${pad(h+1)}:00" type="button"><span>+</span></button>`;
        }
      });
    });
    weekGrid.innerHTML = html;
  }

  function renderMonth() {
    const y=anchor.getFullYear(), m=anchor.getMonth();
    title.textContent = `${monthNames[m]} ${y}`;
    const first=new Date(y,m,1), count=new Date(y,m+1,0).getDate(), offset=first.getDay();
    let html=['Sun','Mon','Tue','Wed','Thu','Fri','Sat'].map(day=>`<div class="month-weekday">${day}</div>`).join('');
    const previousCount = new Date(y,m,0).getDate();
    for(let i=0;i<offset;i++) html += `<div class="month-day muted"><strong>${previousCount-offset+i+1}</strong></div>`;
    for(let day=1;day<=count;day++) {
      const d=new Date(y,m,day,12);
      const rows=liveAppointments.filter(a=>a.starts_at && sameDay(a.starts_at,d));
      const blocks=liveBlocks.filter(b=>blockCoversDay(b,d));
      const isToday=iso(d)===iso(new Date());
      const isSelected=selectedDate && iso(selectedDate)===iso(d);
      const dots=rows.slice(0,2).map(a=>`<i class="month-event-dot ${statusClass(a.status)}" title="${escapeHtml(a.status)}"></i>`).join('') + (blocks.length ? '<i class="month-event-dot blocked" title="Unavailable"></i>' : '');
      const summary = blocks.length ? 'Unavailable' : rows.length ? `${rows.length} appointment${rows.length===1?'':'s'}` : 'Open schedule';
      html += `<button class="month-day ${isToday?'today':''} ${isSelected?'selected-day':''}" data-dentist-month-date="${iso(d)}" type="button"><strong>${day}</strong><span>${summary}</span><div class="month-event-dots">${dots}</div></button>`;
    }
    const cells=offset+count, tail=(7-(cells%7))%7;
    for(let i=1;i<=tail;i++) html += `<div class="month-day muted"><strong>${i}</strong></div>`;
    monthGrid.innerHTML=html;
  }

  function renderUnavailableList() {
    const holder = document.getElementById('dentistAvailabilityTable');
    if (!holder) return;
    const dentistName = document.getElementById('dentistAccountName')?.textContent.trim() || 'Dentist';
    if (!liveBlocks.length) {
      holder.innerHTML = '<div class="availability-empty-state"><strong>No unavailable schedules</strong><span>Marked dates and time blocks will appear here.</span></div>';
      return;
    }
    holder.innerHTML = liveBlocks.map(block => {
      const start = new Date(block.starts_at), end = new Date(block.ends_at);
      const sameDate = iso(start) === iso(end);
      const dateText = sameDate ? start.toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'}) : `${start.toLocaleDateString('en-GB',{day:'2-digit',month:'short'})}–${end.toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'})}`;
      const timeText = sameDate ? `${fmtTime(start)}–${fmtTime(end)}` : '<span class="badge info">Multi-day</span>';
      return `<article class="availability-record"><div><small>Dentist</small><strong>${escapeHtml(dentistName)}</strong></div><div><small>Date</small><strong>${escapeHtml(dateText)}</strong></div><div><small>Time</small><strong>${timeText}</strong></div><div><small>Reason</small><strong>${escapeHtml(block.reason || 'Unavailable')}</strong></div></article>`;
    }).join('');
  }

  function renderAll() {
    weekWrap.hidden = view !== 'week';
    monthGrid.hidden = view !== 'month';
    section.querySelectorAll('[data-dentist-calendar-view]').forEach(b => b.classList.toggle('active', b.dataset.dentistCalendarView === view));
    renderMonthRail();
    if (view === 'week') renderWeek(); else renderMonth();
    renderAgenda();
    renderUnavailableList();
  }

  async function loadCalendarData() {
    agenda.innerHTML = '<p class="muted">Loading schedule…</p>';
    try {
      const [apptsRes, blocksRes] = await Promise.all([
        fetch('/api/appointments?per_page=100', { headers:{Accept:'application/json'} }),
        fetch('/api/blocks?per_page=100', { headers:{Accept:'application/json'} })
      ]);
      if (apptsRes.ok) {
        const data = await apptsRes.json();
        liveAppointments = data.data || [];
      }
      if (blocksRes.ok) {
        const data = await blocksRes.json();
        liveBlocks = data.data || [];
      }
    } catch (error) {
      console.warn('Could not load dentist calendar data:', error);
    }
    renderAll();
    window.renderDentistWeekKPIs?.(liveAppointments);
  }
  let calendarLoaded = false;
  let calendarLoading = false;
  async function ensureDentistCalendarLoaded(force = false) {
    if (calendarLoading || (calendarLoaded && !force)) return;
    calendarLoading = true;
    try {
      await loadCalendarData();
      calendarLoaded = true;
    } finally {
      calendarLoading = false;
    }
  }
  window.refreshDentistCalendar = () => ensureDentistCalendarLoaded(true);

  section.querySelectorAll('[data-dentist-calendar-view]').forEach(button => button.addEventListener('click', () => {
    view = button.dataset.dentistCalendarView;
    selectedDate = null;
    renderAll();
  }));
  section.querySelector('[data-dentist-calendar-prev]')?.addEventListener('click', () => {
    if (view === 'week') anchor.setDate(anchor.getDate()-7); else anchor.setMonth(anchor.getMonth()-1);
    selectedDate = null; renderAll();
  });
  section.querySelector('[data-dentist-calendar-next]')?.addEventListener('click', () => {
    if (view === 'week') anchor.setDate(anchor.getDate()+7); else anchor.setMonth(anchor.getMonth()+1);
    selectedDate = null; renderAll();
  });
  section.querySelector('[data-dentist-calendar-today]')?.addEventListener('click', () => {
    anchor = new Date(); anchor.setHours(12,0,0,0); selectedDate = new Date(anchor); renderAll();
  });
  section.querySelector('[data-dentist-calendar-year-prev]')?.addEventListener('click', () => { anchor.setFullYear(anchor.getFullYear()-1); selectedDate=null; renderAll(); });
  section.querySelector('[data-dentist-calendar-year-next]')?.addEventListener('click', () => { anchor.setFullYear(anchor.getFullYear()+1); selectedDate=null; renderAll(); });
  monthRail?.addEventListener('click', event => {
    const button = event.target.closest('[data-dentist-rail-month]');
    if (!button) return;
    anchor.setMonth(Number(button.dataset.dentistRailMonth),1);
    selectedDate = null;
    renderAll();
  });

  weekGrid.addEventListener('click', event => {
    const appointment = event.target.closest('[data-dentist-event]');
    if (appointment) {
      window.openDentistAppointment?.(appointment);
      return;
    }
    const day = event.target.closest('[data-date]');
    const empty = event.target.closest('button.admin-empty-slot');
    if (section.classList.contains('availability-pick-mode')) {
      if (day && typeof openAvailabilitySelection === 'function') {
        const date = day.dataset.availabilityDate || day.dataset.date;
        openAvailabilitySelection({type:'date',date,endDate:date,display:`${day.textContent.trim()} · All day`});
        section.classList.remove('availability-pick-mode');
        return;
      }
      if (empty && typeof openAvailabilitySelection === 'function') {
        openAvailabilitySelection({type:'time',date:empty.dataset.availabilityDate,endDate:empty.dataset.availabilityDate,startTime:empty.dataset.availabilityStart,endTime:empty.dataset.availabilityEnd,display:`${empty.dataset.availabilityDate} · ${empty.dataset.availabilityStart}–${empty.dataset.availabilityEnd}`});
        section.classList.remove('availability-pick-mode');
        return;
      }
    }
    if (day) {
      selectedDate = new Date(`${day.dataset.date}T12:00:00`);
      if (note) note.textContent = `Selected date: ${selectedDate.toLocaleDateString('en-US',{weekday:'long',month:'long',day:'numeric',year:'numeric'})}`;
      renderAll();
    } else if (empty) {
      selectedDate = new Date(`${empty.dataset.slotDate}T12:00:00`);
      if (note) note.textContent = `Selected schedule: ${empty.dataset.slot}`;
      weekGrid.querySelectorAll('.selected-slot').forEach(x=>x.classList.remove('selected-slot'));
      empty.classList.add('selected-slot');
      renderAgenda();
    }
  });

  monthGrid.addEventListener('click', event => {
    const day = event.target.closest('[data-dentist-month-date]');
    if (!day) return;
    if (section.classList.contains('availability-pick-mode') && typeof openAvailabilitySelection === 'function') {
      openAvailabilitySelection({type:'date',date:day.dataset.dentistMonthDate,endDate:day.dataset.dentistMonthDate,display:`${day.dataset.dentistMonthDate} · All day`});
      section.classList.remove('availability-pick-mode');
      return;
    }
    selectedDate = new Date(`${day.dataset.dentistMonthDate}T12:00:00`);
    if (note) note.textContent = `Selected date: ${selectedDate.toLocaleDateString('en-US',{weekday:'long',month:'long',day:'numeric',year:'numeric'})}`;
    renderAll();
  });

  agenda.addEventListener('click', event => {
    const appointment = event.target.closest('[data-dentist-event]');
    if (appointment) window.openDentistAppointment?.(appointment);
  });

  window.addEventListener('cerillo:sectionchange', (event) => {
    if (event.detail?.sectionId === 'calendar') {
      ensureDentistCalendarLoaded();
    }
  });
  if (section.classList.contains('active-section')) {
    ensureDentistCalendarLoaded();
  }
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

<script id="guaranteedToothFindingFlow">
(function(){
  const STATUS_CLASSES=['tooth-sound','tooth-decay','tooth-finding','tooth-planned','tooth-completed','tooth-missing','tooth-impacted'];
  const DRAFT_KEY='cerilloConsultationDrafts', BILLING_KEY='cerilloPatientToothBilling';
  let activeTooth=null, activeRecord=null, selectedFinding='';

  function escapeHtml(value) {
    return String(value ?? '').replace(/[&<>"']/g, char => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
  }
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
  function invoiceDesc(x){return x?.type==='consultation-invoice'?'Dental consultation · '+(x.items?.length||0)+' procedure'+((x.items?.length||0)===1?'':'s'):'Tooth '+(x.chartNumber||x.tooth)+' · '+x.procedure+' — '+x.finding;}
  function addLedger(r,x){const table=r?.querySelector('[data-patient-ledger]');if(!table?.tBodies?.[0]||table.querySelector('[data-tooth-charge-id="'+x.id+'"]'))return;const tr=document.createElement('tr');tr.dataset.toothChargeId=x.id;tr.innerHTML='<td>'+new Date(x.createdAt).toLocaleDateString(undefined,{day:'2-digit',month:'short',year:'numeric'})+'</td><td>'+x.reference+'</td><td>'+invoiceDesc(x)+'</td><td>'+money(x.price)+'</td><td>—</td><td>'+money(x.price)+'</td>';table.tBodies[0].appendChild(tr);const amt=Number(x.price||0);r.querySelectorAll('.ledger-summary article').forEach(card=>{const label=(card.querySelector('span')?.textContent||'').trim().toLowerCase(),strong=card.querySelector('strong');if(!strong)return;if(label.includes('total charges')||label.includes('outstanding')){const current=Number((strong.textContent||'').replace(/[^0-9.-]/g,''))||0;strong.textContent=money(current+amt);}});}

  function ensurePopups(r){
    if(!r) return {finding:null, charge:null};
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
    return {finding:f, charge:c};
  }

  function hide(p){if(p){p.hidden=true;p.classList.remove('is-visible');}}
  function pos(p,tooth,r){p.hidden=false;p.classList.add('is-visible');p.style.left='0';p.style.top='0';requestAnimationFrame(()=>{const rr=r.getBoundingClientRect(),tr=tooth.getBoundingClientRect(),pr=p.getBoundingClientRect(),pad=14,g=10;let l=tr.left-rr.left+tr.width/2-pr.width/2,t=tr.bottom-rr.top+g;if(t+pr.height>rr.height-pad)t=tr.top-rr.top-pr.height-g;l=Math.max(pad,Math.min(l,rr.width-pr.width-pad));t=Math.max(pad,Math.min(t,rr.height-pr.height-pad));p.style.left=Math.round(l)+'px';p.style.top=Math.round(t)+'px';});}

  function openFinding(tooth){
    const r=tooth.closest('#dentistAppointmentDetailModal, dialog.clinical-record-modal');
    if(!r) return;
    activeTooth=tooth; activeRecord=r; selectedFinding='';
    const p=ensurePopups(r);
    if(!p?.finding) return;
    hide(p.charge);
    p.finding.querySelector('[data-local-tooth-title]').textContent='Tooth '+(tooth.dataset.chartNumber||tooth.dataset.tooth)+' · '+(tooth.dataset.toothName||'');
    const s=p.finding.querySelector('[data-local-finding-select]');
    s.value='';
    pos(p.finding,tooth,r);
    setTimeout(()=>s.focus(),30);
  }

  function openCharge(f){
    if(!activeRecord) return;
    const p=ensurePopups(activeRecord);
    if(!p?.charge||!activeTooth) return;
    selectedFinding=f;
    hide(p.finding);
    p.charge.querySelector('[data-local-charge-title]').textContent='Tooth '+(activeTooth.dataset.chartNumber||activeTooth.dataset.tooth)+' · '+(activeTooth.dataset.toothName||'');
    p.charge.querySelector('[data-local-charge-finding]').textContent=f;
    p.charge.querySelector('[data-local-charge-procedure]').value=proc(f);
    p.charge.querySelector('[data-local-charge-message]').textContent='';
    pos(p.charge,activeTooth,activeRecord);
  }

  function ensureCart(r){
    if(!r) return null;
    const panel=r.querySelector('[data-record-panel="chart"]');
    if(!panel) return null;
    let c=panel.querySelector('[data-consultation-cart]');
    if(!c){
      c=document.createElement('section');
      c.className='consultation-cart-panel';
      c.dataset.consultationCart='';
      c.innerHTML=`<div class="consultation-cart-head"><div><span class="consultation-cart-kicker">Current consultation</span><h4>Treatment invoice draft</h4><p>Set procedure pricing and notes for the invoice.</p></div><div class="consultation-cart-total"><small>Running total</small><strong data-consultation-total>₱0.00</strong></div></div><div class="consultation-cart-items" data-consultation-items></div><div class="consultation-cart-footer"><span data-consultation-count>0 procedures</span><div><button class="btn secondary compact" type="button" data-consultation-clear>Clear draft</button><button class="btn compact" type="button" data-consultation-finish disabled>Finish Consultation</button></div></div>`;
      const w=panel.querySelector('.odontogram-workspace');
      w ? w.insertAdjacentElement('afterend',c) : panel.appendChild(c);
    }
    return c;
  }

  function renderCart(r){
    if(!r) return;
    const c=ensureCart(r);
    if(!c) return;
    const d=draft(r), items=d.items||[];
    const total=items.reduce((s,x)=>s+Number(x.price||0),0);
    const h=c.querySelector('[data-consultation-items]');
    h.innerHTML=items.length ? items.map((x,i)=>`
      <article class="consultation-cart-item" style="display:flex;align-items:center;justify-content:space-between;gap:12px;padding:10px 12px;border:1px solid #e3e9f1;border-radius:12px;background:#fff;">
        <div style="flex:1;min-width:140px;">
          <strong style="display:block;color:#1e293b;font-size:12px;">Tooth ${x.chartNumber || x.tooth} · ${escapeHtml(x.procedure)}</strong>
          <span style="display:block;margin-top:2px;color:#64748b;font-size:11px;">${escapeHtml(x.finding)}</span>
        </div>
        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
          <div style="display:flex;align-items:center;gap:3px;">
            <span style="font-size:11px;font-weight:700;color:#64748b;">₱</span>
            <input type="text" inputmode="decimal" class="cart-item-price" data-cart-price-index="${i}" value="${x.price !== undefined && x.price !== '' ? escapeHtml(x.price) : ''}" placeholder="0.00" title="Enter procedure price (numbers only)" style="width:85px;padding:4px 8px;font-size:12px;border:1px solid #cbd5e1;border-radius:6px;outline:none;" />
          </div>
          <input type="text" class="cart-item-notes" data-cart-notes-index="${i}" value="${escapeHtml(x.notes || '')}" placeholder="Notes (optional)" style="width:115px;padding:4px 8px;font-size:12px;border:1px solid #cbd5e1;border-radius:6px;outline:none;" />
          <button class="icon-btn" type="button" data-consultation-remove="${i}" title="Remove procedure" style="border:none;background:transparent;cursor:pointer;color:#94a3b8;font-size:16px;padding:2px 6px;line-height:1;">×</button>
        </div>
      </article>
    `).join('') : '<div class="consultation-cart-empty">No billable tooth procedures added yet.</div>';

    c.querySelector('[data-consultation-total]').textContent=money(total);
    c.querySelector('[data-consultation-count]').textContent=items.length+' procedure'+(items.length===1?'':'s');
    c.querySelector('[data-consultation-finish]').disabled=!items.length;
    c.querySelector('[data-consultation-clear]').disabled=!items.length;
  }

  function summary(r){
    if(!r) return null;
    let o=r.querySelector(':scope > [data-consultation-summary]');
    if(!o){
      o=document.createElement('div');
      o.className='consultation-summary-overlay';
      o.dataset.consultationSummary='';
      o.hidden=true;
      o.innerHTML=`<section class="consultation-summary-card"><header><div><span class="consultation-cart-kicker">Consultation complete</span><h3>Review treatment summary</h3><p data-consultation-patient></p></div><button class="icon-btn" type="button" data-consultation-summary-close>×</button></header><div class="consultation-summary-body"><div class="consultation-summary-table-wrap"><table><thead><tr><th>Tooth</th><th>Finding</th><th>Procedure</th><th>Price</th></tr></thead><tbody data-consultation-summary-items></tbody></table></div><div class="consultation-summary-total"><span>Total consultation charges</span><strong data-consultation-summary-total>₱0.00</strong></div><p class="consultation-summary-note">Submitting creates one invoice and posts the total to the patient balance.</p></div><footer><button class="btn secondary" type="button" data-consultation-summary-back>Back to chart</button><button class="btn" type="button" data-consultation-submit>Submit to Patient Balance</button></footer></section>`;
      r.appendChild(o);
    }
    return o;
  }

  function openSummary(r){
    if(!r) return;
    const d=draft(r);
    if(!d.items?.length) return;
    const o=summary(r);
    if(!o) return;
    o.querySelector('[data-consultation-patient]').textContent=(r.dataset.patientName||'Patient')+' · '+(r.dataset.patientId||'');
    o.querySelector('[data-consultation-summary-items]').innerHTML=d.items.map(x=>`<tr><td>${escapeHtml(x.chartNumber || x.tooth)}</td><td>${escapeHtml(x.finding)}</td><td>${escapeHtml(x.procedure)}</td><td>${money(x.price||0)}</td></tr>`).join('');
    o.querySelector('[data-consultation-summary-total]').textContent=money(d.items.reduce((s,x)=>s+Number(x.price||0),0));
    o.hidden=false;
    o.classList.add('is-visible');
  }

  function closeSummary(r){const o=r?.querySelector(':scope > [data-consultation-summary]');if(o){o.classList.remove('is-visible');o.hidden=true;}}

  function finish(r){
    if(!r) return;
    const d=draft(r), items=d.items||[];
    if(!items.length) return;
    const total=items.reduce((s,x)=>s+Number(x.price||0),0), now=new Date(), ref='INV-'+now.toISOString().slice(0,10).replace(/-/g,'')+'-'+String(Date.now()).slice(-4), x={id:'CI-'+Date.now(), reference:ref, type:'consultation-invoice', patientId:r.dataset.patientId||'', patientName:r.dataset.patientName||'', tooth:'Multiple', finding:'Consultation', procedure:'Dental Consultation', price:total, notes:items.length+' dental procedures', items:items.map(i=>({...i})), createdAt:now.toISOString(), status:'Unpaid'};
    const list=charges();
    list.push(x);
    saveCharges(list);
    addLedger(r,x);
    clearDraft(r);
    closeSummary(r);
  }

  function addItem(r,item){
    if(!r) return;
    const d=draft(r);
    d.items=d.items||[];
    const n=d.items.findIndex(x=>String(x.tooth)===String(item.tooth)&&x.procedure===item.procedure);
    n>=0 ? d.items[n]=item : d.items.push(item);
    saveDraft(r,d);
  }

  function removeTooth(r,tooth){
    if(!r) return;
    const d=draft(r);
    d.items=(d.items||[]).filter(x=>String(x.tooth)!==String(tooth));
    saveDraft(r,d);
  }

  // Interactive tooth selection is intentionally limited to Appointment Details.
  // Patient Records are historical records and remain read-only.
  document.addEventListener('click', e => {
    const t = e.target.closest('.tooth-unit');
    if (!t) return;
    const modal = t.closest('#dentistAppointmentDetailModal, dialog.clinical-record-modal');
    if (!modal || modal.id !== 'dentistAppointmentDetailModal') return;

    const toothNum = t.dataset.chartNumber || t.dataset.tooth || t.textContent.trim();
    const toothName = t.dataset.toothName || '';
    document.querySelectorAll('.chart-history-heading h4').forEach(el => {
      el.textContent = 'Cross-referenced history · Tooth ' + toothNum + (toothName ? ' · ' + toothName : '');
    });

    const isStarted = modal.dataset.assessmentStarted === 'true' ||
                      (modal.dataset.appointmentStatus || '').toLowerCase() === 'in progress' ||
                      (modal.querySelector('[data-da-status]')?.textContent?.trim() || '').toLowerCase() === 'in progress';
    if (!isStarted) return;

    e.preventDefault();
    e.stopImmediatePropagation();
    openFinding(t);
  }, true);

  // Price input filter (valid numbers and decimals only) & notes listener
  document.addEventListener('input', e => {
    const priceInput = e.target.closest('[data-cart-price-index]');
    if (priceInput) {
      const clean = priceInput.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
      if (priceInput.value !== clean) {
        priceInput.value = clean;
      }
      const idx = Number(priceInput.dataset.cartPriceIndex);
      const r = priceInput.closest('dialog') || activeRecord;
      if (r) {
        const d = draft(r);
        if (d.items && d.items[idx]) {
          d.items[idx].price = clean;
          const total = d.items.reduce((s, x) => s + Number(x.price || 0), 0);
          const cart = ensureCart(r);
          if (cart) {
            const totEl = cart.querySelector('[data-consultation-total]');
            if (totEl) totEl.textContent = money(total);
          }
          const s = read(DRAFT_KEY, {});
          s[pkey(r)] = { ...d, patientId: r.dataset.patientId || '', patientName: r.dataset.patientName || '', updatedAt: new Date().toISOString() };
          write(DRAFT_KEY, s);
        }
      }
      return;
    }
    const notesInput = e.target.closest('[data-cart-notes-index]');
    if (notesInput) {
      const idx = Number(notesInput.dataset.cartNotesIndex);
      const r = notesInput.closest('dialog') || activeRecord;
      if (r) {
        const d = draft(r);
        if (d.items && d.items[idx]) {
          d.items[idx].notes = notesInput.value;
          const s = read(DRAFT_KEY, {});
          s[pkey(r)] = { ...d, patientId: r.dataset.patientId || '', patientName: r.dataset.patientName || '', updatedAt: new Date().toISOString() };
          write(DRAFT_KEY, s);
        }
      }
      return;
    }
  });

  document.addEventListener('click', e => {
    const r = e.target.closest('#dentistAppointmentDetailModal, dialog.clinical-record-modal') || activeRecord;
    if (!r) return;

    if (e.target.closest('[data-local-find-close]')) {
      hide(r?.querySelector(':scope > [data-local-tooth-finding]'));
      return;
    }
    if (e.target.closest('[data-local-charge-close],[data-local-charge-cancel]')) {
      hide(r?.querySelector(':scope > [data-local-tooth-charge]'));
      selectedFinding = '';
      return;
    }
    if (e.target.closest('[data-local-charge-save]')) {
      const c = r?.querySelector(':scope > [data-local-tooth-charge]');
      if (!c || !activeTooth || !selectedFinding) return;
      const procedure = c.querySelector('[data-local-charge-procedure]').value.trim();
      apply(activeTooth, selectedFinding);
      activeTooth.dataset.procedure = procedure;
      addItem(r, {
        id: 'CD-' + Date.now(),
        tooth: activeTooth.dataset.tooth,
        chartNumber: activeTooth.dataset.chartNumber || activeTooth.dataset.tooth,
        toothFdi: activeTooth.dataset.toothFdi || '',
        toothName: activeTooth.dataset.toothName || '',
        finding: selectedFinding,
        procedure: procedure,
        price: '',
        notes: '',
        createdAt: new Date().toISOString()
      });
      hide(c);
      selectedFinding = '';
      return;
    }
    const rem = e.target.closest('[data-consultation-remove]');
    if (rem && r) {
      const d = draft(r);
      d.items.splice(Number(rem.dataset.consultationRemove), 1);
      saveDraft(r, d);
      return;
    }
    if (e.target.closest('[data-consultation-clear]') && r) {
      if (confirm('Clear the current consultation draft?')) clearDraft(r);
      return;
    }
    if (e.target.closest('[data-consultation-finish]') && r) {
      openSummary(r);
      return;
    }
    if (e.target.closest('[data-consultation-summary-close],[data-consultation-summary-back]') && r) {
      closeSummary(r);
      return;
    }
    if (e.target.closest('[data-consultation-submit]') && r) {
      finish(r);
      return;
    }
  });

  document.addEventListener('change', e => {
    const s = e.target.closest('[data-local-finding-select]');
    if (!s) return;
    const f = s.value;
    if (!f || !activeTooth || !activeRecord) return;
    if (/sound\s*\/\s*healthy/i.test(f)) {
      apply(activeTooth, f);
      activeTooth.dataset.procedure = '';
      activeTooth.dataset.price = '0';
      activeTooth.dataset.notes = '';
      removeTooth(activeRecord, activeTooth.dataset.tooth);
      hide(activeRecord.querySelector(':scope > [data-local-tooth-finding]'));
      selectedFinding = '';
      return;
    }
    openCharge(f);
  });

  document.addEventListener('close', e => {
    const modal = e.target;
    if (modal?.id === 'dentistAppointmentDetailModal' || modal?.classList.contains('clinical-record-modal')) {
      hide(modal.querySelector(':scope > [data-local-tooth-finding]'));
      hide(modal.querySelector(':scope > [data-local-tooth-charge]'));
      closeSummary(modal);
      activeTooth = null;
      activeRecord = null;
      selectedFinding = '';
    }
  }, true);

  document.querySelectorAll('#dentistAppointmentDetailModal, dialog.clinical-record-modal').forEach(r => renderCart(r));
})();
</script>


<script src="{{ asset('assets/js/dashboard-live.js') }}"></script>
<script src="{{ asset('assets/js/records-live.js') }}"></script>
<script src="{{ asset('assets/js/cerillo-ui-hotfix.js') }}"></script>

<script src="/assets/js/cerillo-responsive.js"></script>
<script src="/assets/js/cerillo-table-pagination.js"></script>
<script src="{{ asset('assets/js/dentist-clinical-refinements.js') }}"></script>

<script src="{{ asset('assets/js/settings-ui.js') }}"></script>
<script src="{{ asset('assets/js/appointment-chart-states.js') }}"></script>
<script defer src="/assets/js/cerillo-patient-pdf.js"></script>
</body>
</html>
