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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('/', 'antrian\poli\queuePoliController');
Route::get('api/queue/poli/{id}', 'antrian\poli\queuePoliController@apiFindQueue')->name('cari.antrian');
