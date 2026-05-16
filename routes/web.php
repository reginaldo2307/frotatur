<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FinancialTransactionController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/trips/{trip}/os', [TripController::class, 'downloadOs'])->name('trips.os');
    Route::resource('vehicles', VehicleController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('trips', TripController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('finance', FinancialTransactionController::class);
    Route::resource('maintenances', MaintenanceController::class);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Super Admin Routes
    Route::middleware(['role:Super Admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('companies', \App\Http\Controllers\SuperAdmin\CompanyController::class);
        Route::resource('plans', \App\Http\Controllers\SuperAdmin\PlanController::class);
        Route::get('/finance', [\App\Http\Controllers\SuperAdmin\FinanceController::class, 'index'])->name('finance.index');
        Route::get('/tickets', [\App\Http\Controllers\SuperAdmin\TicketController::class, 'index'])->name('tickets.index');
        Route::get('/logs', function() {
            $logs = \App\Models\AuditLog::with(['user', 'company'])->latest()->paginate(20);
            return view('superadmin.logs.index', compact('logs'));
        })->name('logs.index');
    });


});

require __DIR__.'/auth.php';
