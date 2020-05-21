<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/logout', function () {
    \Auth::logout();
    return redirect('/');
});

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('/dashboard', function () {
        // \Auth::logout();
        // return redirect('/');
        echo 'Welcome to your dashboard';
        echo '<a href="/logout">Logout</a>';
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

