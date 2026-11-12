<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorDataController;
use App\Http\Controllers\Api\MonitoringController;

// API untuk menerima data dari ESP32
Route::post('/sensor-data', [SensorDataController::class, 'store']);

// API untuk monitoring
Route::get('/devices', [MonitoringController::class, 'devices']);

Route::get(
    '/devices/{id}/readings',
    [MonitoringController::class, 'readings']
);

Route::get(
    '/devices/{id}/risk-analyses',
    [MonitoringController::class, 'riskAnalyses']
);

Route::get(
    '/devices/{id}/notifications',
    [MonitoringController::class, 'notifications']
);
