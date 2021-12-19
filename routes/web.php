<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
Auth::routes();
Route::get('/', function () {
    // Uses first & second middleware...
    return view('auth.login');
});
Route::get('/home', function () {
    return view('home',[HomeController::class, 'index']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'App\Http\Controllers\HomeController@index');
    Route::post('/patient_info','App\Http\Controllers\HomeController@patient_info');
    Route::get('/results/{id}','App\Http\Controllers\pdfViewController@index');
});