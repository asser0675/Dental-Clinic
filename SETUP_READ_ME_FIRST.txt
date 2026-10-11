CERILLO DENTAL CLINIC V4.1 - WINDOWS SETUP

1. Extract this ZIP into a NEW SHORT folder, preferably:
   C:\CerilloV41

2. Do not paste files on top of the old broken folder.

3. Start MySQL/XAMPP.

4. Open the extracted folder and double-click:
   RUN_SETUP.cmd

   OR run from PowerShell:
   powershell -ExecutionPolicy Bypass -File .\SETUP_CERILLO_WINDOWS.ps1

5. When setup finishes, run:
   php artisan serve

6. Open:
   http://127.0.0.1:8000

If setup stops, copy everything from the FIRST red/yellow error line through the final COMMAND FAILED line. The revised script now prints exactly which command failed.
