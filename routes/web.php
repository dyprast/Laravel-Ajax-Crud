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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('siswa')->group(function(){
    Route::get('/', 'SiswaController@index')->name('siswaHome');
    Route::get('/getDataTable', 'SiswaController@get');
    Route::post('/simpanData', 'SiswaController@save');
    Route::get('/getDataSiswa/{id}', 'SiswaController@getSiswa');
    Route::post('/EditData/{id}', 'SiswaController@update');
    Route::get('/hapusData/{id}', 'SiswaController@delete');
});