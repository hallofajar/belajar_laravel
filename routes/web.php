<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Umum\landing;
use App\Http\Controllers\Auth\Registrasi;
use App\Http\Controllers\Auth\Login;


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

Route::get('/', [landing::class, 'index']);

// Auth Route
Route::get('/Login', [Login::class, 'index']);

Route::controller(Registrasi::class)->group(function () {
	Route::get('/Register', 'index');
	Route::post('/Register', 'store');
});


// end Admin Route
