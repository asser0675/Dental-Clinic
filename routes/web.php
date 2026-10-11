<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\OperationsController;
use App\Http\Middleware\Role;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public pages and booking API
|--------------------------------------------------------------------------
*/

Route::view('/', 'landing')->name('home');
Route::view('/appointment/request', 'public-register')->name('booking');

Route::get('/api/slots', [AppointmentController::class, 'slots']);
Route::get('/api/public/services', fn () => Service::query()
    ->where('active', true)
    ->orderBy('name')
    ->get(['id', 'name', 'duration_minutes']));
Route::get('/api/public/dentists', fn () => User::query()
    ->whereIn('role', ['dentist', 'admin'])
    ->orderBy('name')
    ->get(['id', 'name']));
Route::post('/api/appointments', [AppointmentController::class, 'store'])
    ->middleware('throttle:10,1');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:6,1');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authenticated workspaces and clinic API
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function (): void {
    Route::get('/workspace', [ClinicController::class, 'workspace'])
        ->name('workspace');
    Route::get('/operations', [OperationsController::class, 'index'])
        ->name('operations')
        ->middleware(Role::class.':dentist,front_desk');

    Route::prefix('api')->group(function (): void {
        Route::get('/services', [ClinicController::class, 'services']);

        Route::middleware(Role::class.':admin,dentist,front_desk')->group(function (): void {
            Route::get('/appointments', [AppointmentController::class, 'index']);
            Route::get('/patients', [DirectoryController::class, 'patients']);
            Route::get('/dashboard', [DirectoryController::class, 'dashboard']);
        });

        Route::middleware(Role::class.':admin,front_desk')->group(function (): void {
            Route::get('/payments', [DirectoryController::class, 'payments']);
            Route::get('/payments/{transaction}/pdf', [DirectoryController::class, 'paymentPdf']);
            Route::post('/payments/{transaction}/email', [DirectoryController::class, 'emailPaymentReceipt']);
            Route::get('/accounts', [DirectoryController::class, 'accounts']);
            Route::post('/transactions', [ClinicController::class, 'recordPayment']);
        });

        Route::middleware(Role::class.':admin,dentist,front_desk')->group(function (): void {
            Route::get('/appointments/{appointment}', [AppointmentController::class, 'detail']);
            Route::get('/patients/{patient}', [DirectoryController::class, 'show']);
        });

        Route::middleware(Role::class.':admin,front_desk')->group(function (): void {
            Route::get('/appointments/{appointment}/matches', [AppointmentController::class, 'matches']);
            Route::post('/appointments/{appointment}/verify', [AppointmentController::class, 'verify']);
            Route::put('/appointments/{appointment}/dentist', [ClinicController::class, 'reassign']);
        });

        Route::patch('/appointments/{appointment}/status', [AppointmentController::class, 'changeStatus'])
            ->middleware(Role::class.':admin,front_desk');

        Route::middleware(Role::class.':admin,dentist')->group(function (): void {
            Route::put('/appointments/{appointment}/clinical', [AppointmentController::class, 'notes']);
            Route::post('/appointments/{appointment}/complete', [AppointmentController::class, 'complete']);
            Route::post('/appointments/{appointment}/start-assessment', [AppointmentController::class, 'startAssessment']);
            Route::get('/patients/{patient}/chart', [ClinicController::class, 'chart']);
            Route::post('/appointments/{appointment}/teeth', [ClinicController::class, 'saveTooth']);
            Route::post('/patients/{patient}/teeth', [ClinicController::class, 'savePatientTooth']);
            Route::get('/blocks', [ClinicController::class, 'blocks']);
            Route::post('/blocks', [ClinicController::class, 'saveBlock']);
            Route::delete('/blocks/{block}', [ClinicController::class, 'deleteBlock']);
        });

        Route::middleware(Role::class.':admin')->group(function (): void {
            Route::get('/reports', [DirectoryController::class, 'reports']);
            Route::get('/activity', [DirectoryController::class, 'activity']);
            Route::put('/accounts/{user}', [DirectoryController::class, 'updateAccount']);
            Route::post('/accounts', [DirectoryController::class, 'createAccount']);
            Route::post('/services', [ClinicController::class, 'saveService']);
            Route::put('/services/{service}', [ClinicController::class, 'saveService']);
            Route::delete('/services/{service}', [ClinicController::class, 'deleteService']);
            Route::get('/transactions', [ClinicController::class, 'transactions']);
            Route::post('/transactions/{transaction}/void', [ClinicController::class, 'voidPayment']);
        });
    });
});
