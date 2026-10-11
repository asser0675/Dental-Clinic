# Cerillo Dental Clinic Front-End

A role-based dental clinic front-end built with semantic HTML, shared CSS, and small inline scripts for page interaction. Each role has one complete HTML workspace. No external JavaScript files are used.

## Run locally

1. Extract the ZIP and keep the folder structure intact.
2. Open the folder in VS Code.
3. Run `index.html` with Live Server, or double-click `START-WINDOWS.bat` if Python is installed.
4. Use the Sign In page to test each role.

## Sign-in accounts

| Role | Email | Password |
| --- | --- | --- |
| Super Admin | `superadmin@cerillodental.com` | `Cerillo@2026` |
| Admin | `admin@cerillodental.com` | `Admin@2026` |
| Dentist | `dentist@cerillodental.com` | `Dentist@2026` |
| Front Desk | `frontdesk@cerillodental.com` | `FrontDesk@2026` |
| Patient | `patient@cerillodental.com` | `Patient@2026` |

## Role workspaces

- **Super Admin** — system dashboard, Admin accounts, Admin access logs, system settings.
- **Admin** — clinic dashboard, patient/appointment records, services, billing and payments, dental chart, visit history, operations, X-rays, sales, reports and analytics, activity logs, staff accounts, settings.
- **Dentist** — schedule, assigned patients, consultation, dental chart, X-ray records, clinical availability.
- **Front Desk** — dashboard, appointments, patient queue, patient registration, payments, sales transactions, follow-ups.
- **Patient** — own appointments, visit history, profile and personal records.

## Current workflow updates

- Front Desk can create appointments.
- Front Desk can set appointment status only to **Checked In**, **Pending**, or **Cancelled**.
- Cancelling requires a reason and can immediately reopen New Appointment with the same patient preselected.
- Dentist unavailable blocks can cover a time range, a whole date, or a whole week. The same browser origin shares those blocks with Admin and Front Desk appointment screens through local storage.
- X-ray records can be added by selecting a patient, automatically loading their identifying details, attaching image files, and saving the record metadata under that patient.
- Sidebar sign out uses a confirmation dialog and the sign-out control sits beside the signed-in name and role.
- KPI values are positioned on the right side of KPI cards.
- Accessibility settings are displayed vertically and include persistent dark mode, large text, high contrast, reduced motion, and enhanced focus.
- Service cards use local service-specific dental illustrations rather than unrelated clinic/staff photographs.

## Front-end storage note

This build has no backend or database. Interactive changes such as dentist availability blocks, appointment status changes, new appointment metadata, X-ray metadata, and accessibility preferences use browser local storage on the same Live Server origin. They are suitable for front-end presentation and workflow testing; a production implementation should replace them with authenticated backend APIs and database records.

## 2026-10-05 Clinical Workflow Consolidation

This revision reorganizes Cerillo around the patient file as the central clinical record.

### Dentist
- Dashboard statuses: Completed, Checked In, In Progress, Cancelled only.
- Calendar module manages unavailable dates/time ranges/weeks.
- Appointments table order: Name, Procedure, Date, Time, Status, Action.
- Patient Records uses the shared patient-file layout and gives the dentist clinical-update controls for patients appointed that day.
- Standalone Consultation & Treatment, Dental Chart, X-ray Records and Availability modules were removed; charting and X-rays live in each patient record.

### Front Desk
- Dashboard includes Completed KPI.
- Appointments supports combined patient registration + appointment booking.
- Patient Queue retained.
- Patient record uses the shared patient-file layout and includes a green Proceed to Checkout action in Billing Ledger.
- Payments and Follow-ups retained.
- Sales Transactions removed.

### Admin
- Patient Management renamed Patient Records.
- Standalone Dental Chart, Visit History, Operations and X-ray Records removed.
- Services & Pricing includes Add Service and Edit controls.
- Billing & Payments uses the same core table structure as Front Desk with Admin-only financial override detail.
- Sales Transactions is read-only with View, Void/Refund and Export actions; refunds are modeled as balancing negative entries rather than deletion.

### Shared Patient Record
Tabs now include Overview, Visit History, Medical Record, Dental Chart, X-rays and Billing Ledger. The Dental Chart includes permanent/primary/mixed dentition views, tooth-specific findings, surfaces, pulpal/apical diagnoses, treatment shorthand, periodontal fields, auto progress-note drafting and smart missing/extracted tooth treatment locking.

## Final UI / Workflow Polish (October 2026)

This build includes the final Cerillo clinical workflow consolidation and a visual QA pass based on the approved clean dental-SaaS direction.

### Global workspace behavior
- Persistent upper-right live date and time on all authenticated role screens.
- KPI values are right-aligned in a dedicated value column; titles/subtext no longer collide with values.
- Table filters use compact filter-icon popovers with keyword/status controls and Apply/Reset actions.
- Sign-out remains beside the signed-in user's name and role with confirmation.

### Admin
- Patient Records uses the unified clinical Patient File with Overview, Visit History, Medical Record, Dental Chart, X-rays and Billing Ledger tabs.
- Appointments table order: Patient, Dentist, Service, Date, Time, Arrival, Action.
- Weekly schedule is horizontally scrollable.
- Services & Pricing supports Add/Edit and spaced Details/Edit actions.
- Billing & Payments uses an administrative Payment Oversight modal with processing metadata and financial overrides.
- Sales Transactions uses a detailed receipt modal with immutable void/refund audit behavior and export actions.
- Standalone Visit History, Operations, Dental Chart and X-ray modules are not exposed as separate Admin navigation items.

### Dentist
- Dashboard statuses are restricted to Completed, Checked In, In Progress and Cancelled.
- Calendar is the dedicated availability-management module.
- Appointments order: Name, Procedure, Date, Time, Status, Action.
- Patient Records uses the same unified clinical Patient File, with dentist update capability for active clinical records.
- No standalone Consultation & Treatment, Dental Chart or X-ray modules.

### Front Desk
- Dashboard includes Completed appointments today and removes the old confirmed-count subtext.
- Appointments includes the patient-registration + appointment-booking workflow.
- Patient Queue remains intact.
- Patient file mirrors the shared record structure; Billing Ledger includes Proceed to Checkout.
- Payments and Follow-ups remain; Sales Transactions is removed.
