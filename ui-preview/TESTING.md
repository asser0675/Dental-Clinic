# Acceptance Checklist

## Navigation and session

- Sign in with each listed role account and confirm the matching role workspace opens.
- Click several sidebar items and verify only the selected workspace section is visible.
- Confirm the selected sidebar item remains highlighted.
- Confirm the sign-out button is beside the name/role at the bottom of the sidebar.
- Click sign out and verify the confirmation dialog appears before navigation to Sign In.

## Front Desk appointments

- Open **Appointments** and click **New Appointment**.
- Confirm Patient, Service, Dentist, Date, Time and Duration are required.
- Save an available slot and verify a new Pending row is added.
- Click **View** on an appointment and verify Status contains only Checked In, Pending and Cancelled.
- Select Cancelled and confirm a cancellation reason becomes required.
- Keep **Offer another appointment** checked; save the cancellation and confirm New Appointment opens with the patient preselected.

## Dentist availability

- Sign in as Dentist and open **Appointments** or **Availability**.
- Click **Mark Unavailable**.
- Test Date & Time Range, Whole Date and Whole Week.
- Save a block.
- Reload Admin → Appointments and Front Desk → Appointments on the same local origin and verify the blocked schedule appears.
- In Front Desk New Appointment, choose the blocked dentist/date/time and verify the conflict message prevents creation.

## X-ray records

- Open Admin or Dentist → X-ray Records.
- Click **Add X-ray Record**.
- Select a patient and confirm Patient ID, phone, email and DOB populate automatically.
- Attach one or more image files and confirm thumbnails appear.
- Complete X-ray type, date, tooth/area and findings, then save.

## Accessibility and presentation

- Confirm KPI values are right-aligned on the right side of the cards.
- Open several dialogs and confirm the larger typography is readable.
- Open Admin → Settings and verify accessibility controls are vertically aligned.
- Enable Dark mode, reload, and verify the preference persists.
- Test Large text, High contrast, Reduced motion and Enhanced focus.
- Open Admin → Services and verify each service uses a treatment-related local image.

## Technical checks completed

- No external `.js` files exist in the project.
- Inline scripts were syntax-checked with Node.
- Service assets are local to the ZIP.
- HTML remains formatted across multiple lines rather than minified into one-line sections.

## Final visual acceptance checks

1. Open every authenticated role screen and verify the date/time remains visible in the upper-right while switching sidebar modules.
2. Verify KPI labels/subtext remain left-aligned and KPI values stay right-aligned at 100%, 125% and 150% browser zoom.
3. Open every table Filter control; confirm the popover is attached to the filter button, is not clipped by the table, and Apply/Reset changes the visible rows.
4. Admin > Patient Records > View: check the patient identity header, tab bar, scrollable body, Visit History, Medical Record, Dental Chart, X-rays and Billing Ledger.
5. Dental Chart: verify condition legend colors, Permanent/Primary/Mixed controls, individual tooth selection and selected-tooth clinical panel.
6. Admin > Appointments: confirm columns are Patient, Dentist, Service, Date, Time, Arrival, Action and the weekly calendar can scroll horizontally.
7. Admin > Services & Pricing: confirm Details/Edit have visible vertical spacing and Add/Edit controls are available.
8. Admin > Billing & Payments > View: verify Payment Oversight contains payment summary, processed-by staff, treating dentist, applied charges and Admin override controls.
9. Admin > Sales Transactions > View: verify receipt breakdown, treating dentist, payment method, total paid, Void/Refund and Export actions.
10. Dentist > Calendar: verify availability controls use the styled Week/Month segmented control and Mark Unavailable exists only in Calendar.
11. Dentist > Appointments: confirm no Mark Unavailable button and the table order matches Name, Procedure, Date, Time, Status, Action.
12. Front Desk > Appointments: verify registration/booking modal header, patient-data step, appointment-data step and availability checks.
13. Front Desk > Patients > View > Billing Ledger: verify green Proceed to Checkout opens the payment workflow.

## Targeted polish acceptance checks — October 2026

- Patient X-ray attachment dialog keeps header and footer visible; the form body scrolls when the viewport is short.
- Patient X-ray form uses Clinical indication instead of Tooth / Area and defaults to Full-mouth series (FMX).
- Patient Record header contains only patient name + patient ID; demographic/contact values live in Overview.
- Patient Overview contains personal/contact data, Insurance/HMO, chief concern, care snapshot, and clinical alerts.
- Visit History rows show dentist, date/time, Completed status and a chevron; no merged “CompletedView” text.
- Medical Record contains expanded medical conditions, allergies/medications, vitals/risk, dental/health history and treatment considerations.
- Dental Chart displays tooth-shaped controls and allows multi-select before applying chart data/status/findings/diagnoses/treatment/code/notes.
- Search, Sort and filter icon controls sit together on the right side of table toolbars; filter opens a small popover.
- Admin Dashboard retains prior KPIs/content and includes additional useful visit, appointment, payment and capacity analytics.
- Reports & Analytics retains prior reports and adds collections trend, payment mix, treatment acceptance and dentist workload.
- Accessibility Settings are available for Admin, Dentist, Front Desk, Patient and Super Admin roles.
- Front Desk Register Patient & Book Appointment dialog scrolls its content without clipping the action controls.
- Alternative Contact is removed; Insurance/HMO is collected instead.
- Front Desk Patients module has no Add Patient button.
- Public Services disclose no prices and instead show a variable-fee note with expandable service details.
- Public navigation contains only one Sign in control; duplicate Sign in / Sign up links beside Contact are removed.
