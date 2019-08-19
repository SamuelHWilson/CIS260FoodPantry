<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use App\Scheduling\FCEvent;

Route::get('/', function() { 
    if (Auth::check()) {
        $date = new DateTime();
        return redirect('/appointments/day-view/'.$date->format(FCEvent::$FCDateFormat));
    } else {
        return redirect('login');
    }
})->name('home');

//This route must be named, otherwise the auth middleware can't find it.
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/access-denied', function() {
    return view('auth.accessdenied');
})->name('access-denied');

Route::middleware(['auth.basic'])->group(function() {
    
    Route::get('/appointments/day-view/{date}', 'Pantry\AppointmentController@showDay');
    Route::get('/appointments/month-view/{date}', 'Pantry\AppointmentController@showMonth');

    Route::get('/appointments/view-appointment/{id}', 'Pantry\AppointmentController@viewAppointment')->name('view-appointment');
});

Route::middleware(['check-edit'])->group(function() {
    Route::get('/appointments/create-appointment/{date}', 'Pantry\AppointmentController@showCreateForm');
    Route::post('/appointments/create-appointment', 'Pantry\AppointmentController@createAppointment');
    Route::post('/appointments/check-in', 'Pantry\AppointmentController@checkIn');
    Route::get('/appointments/check-in/schedule-next/{id}', 'Pantry\AppointmentController@scheduleNext');
    Route::post('/appointments/create-pending', 'Pantry\AppointmentController@createPendingAppointment');
    Route::post('/appointments/cancel-pending', 'Pantry\AppointmentController@cancelPendingAppointment');
    Route::post('/appointments/cancel', 'Pantry\AppointmentController@cancel');
    Route::post('/appointments/restore', 'Pantry\AppointmentController@restore');
    Route::view('/appointments/create-bulk/success', 'crud/create-bulk/success');
    Route::view('/appointments/create-bulk', 'crud/create-bulk/pick-day');
    Route::get('/appointments/create-bulk/{date}', 'Pantry\AppointmentController@showBulkCreate');
    Route::post('/appointments/create-bulk/{date}', 'Pantry\AppointmentController@bulkCreate');


    Route::get('/clients/edit', 'Pantry\ClientController@showClient');

    Route::get('/hours/set-hours', 'Pantry\AvailabilityController@createAvailability');
    Route::post('/hours/set-hours', 'Pantry\AvailabilityController@saveAvailability');
    Route::get('/hours/view-hours', 'Pantry\AvailabilityController@viewAvailability');
    Route::get('/hours/delete-change/{id}', 'Pantry\AvailabilityController@confirmDelete');
    Route::post('/hours/delete-change', 'Pantry\AvailabilityController@deleteChange');

    Route::get('/reporting/reports', 'Pantry\ReportController@showReports');
    Route::get('/reporting/no-shows', 'Pantry\ReportController@showNoShowReport');
    Route::get('/reporting/reschedules', 'Pantry\ReportController@showRescheduleReport');
    Route::get('/reporting/daily-appointments/{date}', 'Pantry\ReportController@showDailyAppointmentsReport');
    Route::get('/reporting/daily-clients/{date}', 'Pantry\ReportController@showDailyClientsReport');

    Route::get('/password/change', 'Pantry\PasswordController@viewChangePassword');
    Route::post('/password/change', 'Pantry\PasswordController@changePassword');
});

// Maintenance only.
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('register', 'Auth\RegisterController@register');
