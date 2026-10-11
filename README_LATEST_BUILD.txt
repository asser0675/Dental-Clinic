CERILLO DENTAL CLINIC V4.1 — DENTIST CLINICAL REFINEMENTS
Updated: 2026-10-11

This build continues from CERILLO_DENTAL_V4.1_GENERAL_MINOR_REFINEMENTS_FULL.

Dentist changes in this build:
- Removed the Periodontal Layer from Dentist dental-chart areas.
- Appointment Details now shows a Prescription section only for extraction treatment context.
- Patient Record dental chart remains read-only; Appointment Details dental chart remains interactive.
- Dental chart display labels now use quadrant-position numbering. Primary teeth display 5 4 3 2 1 | 1 2 3 4 5, matching the supplied reference. Permanent teeth use 8..1 | 1..8.
- Tooth spacing is more compact without changing the existing tooth artwork.
- The database continues to store canonical FDI tooth numbers; Tooth API data also exposes chart_number, arch, and side for clarity.
- Added a data migration that clarifies tooth reference labels and backfills Patient Records for existing Completed appointments.
- Future appointment completion creates/links the Patient Record and related clinical records automatically.
- Prescription rows are included when Patient Record visit data is loaded.

Required after copying/updating this project:
  php artisan migrate
  php artisan optimize:clear
  php artisan serve

Do NOT run migrate:fresh unless you intentionally want to delete your database data.
