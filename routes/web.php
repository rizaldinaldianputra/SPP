<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Route yang ada di dalam group middleware “aut maka wajib login
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('kelas', 'KelasController');
    Route::resource('spp', 'SppController');
    Route::resource('siswa', 'SiswaController');
    Route::resource('petugas', 'PetugasController');
    Route::resource('pembayaran', 'PembayaranController');
    Route::get('/history', 'PembayaranController@history');
    Route::get('/laporan', function () {
        return view('laporan');
    });

    route::get('/laporan/kelas', 'LaporanController@kelas');
    route::get('/laporan/spp', 'LaporanController@spp');
    route::get('/laporan/siswa', 'LaporanController@siswa');
    route::get('/laporan/petugas', 'LaporanController@petugas');
    route::get('/laporan/pembayaran', 'LaporanController@pembayaran');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
