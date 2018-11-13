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

use App\Scheduling\FCEvent;

Route::get('/', function() {
    return redirect('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

//Auth Routes

//This route must be named, otherwise the auth middleware can't find it.
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/testing/schedule-appointment', function (){
    return view('crud.schedule-appointment');
});

Route::get('/testing/view-appointment', function (){
    return view('crud.view-appointment');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('register', 'Auth\RegisterController@register');

//Test Routes

//Test routes are all protected by authentication to safegaurd application if they are forgotten.
Route::middleware(['auth.basic'])->group(function() {

    Route::get('testing/appointments/day-view/{date}', 'Pantry\AppointmentController@showDay');
    Route::get('testing/appointments/month-view/{date}', 'Pantry\AppointmentController@showMonth');
    Route::get('testing/appointments/{view}-view', function($view) {
        $now = new DateTime();
        $currentDate = $now->format(FCEvent::$FCDateFormat);
        return redirect('testing/appointments/'.$view.'-view/'.$currentDate);
    });

    Route::get('testing/testcon', 'AppointmentController@test');
});

//Automatically added for default auth.
// Auth::routes();
