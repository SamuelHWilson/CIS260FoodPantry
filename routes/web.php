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

Route::get('/testing/client-dump', function () {
    $clients = DB::table('Customer')->get();
    return view('testing.client-dump', ['clients' => $clients]);
});

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

//Automatically added for default auth.
// Auth::routes();
