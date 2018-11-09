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

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('register', 'Auth\RegisterController@register');

//Test Routes

//Test routes are all protected by authentication to safegaurd application if they are forgotten.
Route::middleware(['auth.basic'])->group(function() {

    Route::get('/testing/calendar', function() {
        return view('calendar');
    });
    
    Route::get('testing/client-dump', 'Pantry\ClientController@index');
    Route::get('testing/appointment-dump', 'Pantry\AppointmentController@index');
    Route::get('testing/status-dump', 'Pantry\StatusController@index');

    Route::get('testing/testcon', 'TestController@test');
});

//Automatically added for default auth.
// Auth::routes();
