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

Route::get('/drivers', function() {
    return view('testing.drivers');
});

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

Route::middleware(['auth.basic'])->group(function() {
    Route::get('/appointments/day-view/{date}', 'Pantry\AppointmentController@showDay');
    Route::get('/appointments/month-view/{date}', 'Pantry\AppointmentController@showMonth');

    Route::get('/appointments/view-appointment/{id}', 'Pantry\AppointmentController@viewAppointment')->name('view-appointment');
    Route::get('/appointments/create-appointment/{date}', 'Pantry\AppointmentController@showCreateForm');
    Route::post('/appointments/create-appointment', 'Pantry\AppointmentController@createAppointment');
    Route::post('/appointments/check-in', 'Pantry\AppointmentController@checkIn');
    Route::get('/appointments/check-in/schedule-next/{id}', 'Pantry\AppointmentController@scheduleNext');
    Route::post('/appointments/create-pending', 'Pantry\AppointmentController@createPendingAppointment');
    Route::post('/appointments/cancel-pending', 'Pantry\AppointmentController@cancelPendingAppointment');
    Route::post('/appointments/cancel', 'Pantry\AppointmentController@cancel');
});

//------

Route::get('/testing/schedule-appointment', function (){
    return view('crud.schedule-appointment');
});

Route::get('/testing/view-appointment', function (){
    return view('crud.view-appointment');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('register', 'Auth\RegisterController@register');

//Test Routes

//Test routes are all protected by authentication to safegaurd application if they are forgotten.
Route::middleware(['auth.basic'])->group(function() {

    Route::get('testing/appointments/{view}-view', function($view) {
        $now = new DateTime();
        $currentDate = $now->format(FCEvent::$FCDateFormat);
        return redirect('testing/appointments/'.$view.'-view/'.$currentDate);
    });

    Route::get('testing/testcon', 'AppointmentController@test');
});

//Automatically added for default auth.
// Auth::routes();
