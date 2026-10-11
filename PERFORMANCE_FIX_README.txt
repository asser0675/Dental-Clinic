Cerillo Dental Clinic V5 - Admin/Dentist performance hotfix

What was fixed:
- Admin and Dentist calendars no longer fetch/render in the background immediately after login.
- Calendar data loads only when the Calendar module is opened.
- Admin Services catalog no longer builds its image/card grid while Dashboard is active; it loads when Services is opened.
- Dental chart layout/height scripts no longer scan and measure every hidden odontogram during login.
- Patient-record chart/X-ray enhancements initialize only when the record dialog is actually opened.
- Repeated startup DOM scans and hidden ResizeObserver work were removed.

No database/schema changes are included.
After copying/replacing files run:
  php artisan optimize:clear
  php artisan serve
