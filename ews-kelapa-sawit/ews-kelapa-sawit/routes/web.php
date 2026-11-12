<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoringPageController;
use App\Http\Controllers\DeviceManagementController;
use App\Http\Controllers\RiskNotificationController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {return view('landing');})
    ->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/monitoring', [MonitoringPageController::class, 'index'])
    ->name('monitoring.index');

Route::get('/monitoring/device/{id}', [MonitoringPageController::class, 'show'])
    ->whereNumber('id')
    ->name('monitoring.show');

Route::get('/login', [LoginController::class,'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class,'login'])
    ->name('login.submit');

Route::post('/logout', [LoginController::class,'logout'])
    ->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/devices', [DeviceManagementController::class, 'index'])
        ->name('devices.index');

    Route::get('/devices/create', [DeviceManagementController::class, 'create'])
        ->name('devices.create');

    Route::post('/devices', [DeviceManagementController::class, 'store'])
        ->name('devices.store');

    Route::get('/devices/{device}/edit', [DeviceManagementController::class, 'edit'])
        ->name('devices.edit');

    Route::put('/devices/{device}', [DeviceManagementController::class, 'update'])
        ->name('devices.update');

    Route::delete('/devices/{device}', [DeviceManagementController::class, 'destroy'])
        ->name('devices.destroy');

    Route::get('/analysis', [RiskNotificationController::class,'analysisIndex'])
        ->name('analysis.index');

    Route::get('/notifications', [RiskNotificationController::class,'notificationsIndex'])
        ->name('notifications.index');

    Route::patch('/notifications/{notification}/read', [RiskNotificationController::class,'markAsRead'])
        ->name('notifications.read');

    Route::patch('/notifications/read-all', [RiskNotificationController::class,'markAllAsRead'])
        ->name('notifications.read-all');
});
