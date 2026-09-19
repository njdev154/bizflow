<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/google/redirect', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('onboarding/entreprise', [OnboardingController::class, 'create'])->name('onboarding.company');
    Route::post('onboarding/entreprise', [OnboardingController::class, 'store'])->name('onboarding.company.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('has.org')->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('clients', App\Http\Controllers\ClientController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::resource('services', App\Http\Controllers\ServiceController::class)->only(['index', 'create', 'store', 'edit', 'update']);

        Route::resource('appointments', App\Http\Controllers\AppointmentController::class)->only(['index', 'create', 'store']);
        Route::patch('appointments/{appointment}/status', [App\Http\Controllers\AppointmentController::class, 'updateStatus'])->name('appointments.status');

        Route::resource('payments', App\Http\Controllers\PaymentController::class)->only(['index', 'create', 'store']);

        Route::get('reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');

        Route::get('settings', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
        Route::get('settings/audit-log', [App\Http\Controllers\SettingsController::class, 'auditLog'])->name('settings.audit-log');

        Route::resource('employees', App\Http\Controllers\EmployeeController::class)->only(['index', 'create', 'store', 'destroy']);
        Route::patch('employees/{member}/role', [App\Http\Controllers\EmployeeController::class, 'updateRole'])->name('employees.role');

    });

});

require __DIR__.'/auth.php';
