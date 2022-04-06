<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/doctor-list', [App\Http\Controllers\DoctorDetailController::class, 'getDoctorList']);
Route::get('/doctor-schedules', [App\Http\Controllers\PatientAppointmentController::class, 'getScheduleDoctorWise']);
Route::get('/book-schedules', [App\Http\Controllers\PatientAppointmentController::class, 'bookAppointment']);
