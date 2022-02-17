<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function(){
    Route::get('/kelas', 'KelasController@show'); 
    Route::get('/kelas/{id}', 'KelasController@detail'); 
    Route::put('/kelas/{id}', 'KelasController@update'); 
    Route::post('/kelas', 'KelasController@store'); 
    Route::delete('/kelas/{id}', 'KelasController@destroy'); 
     
    Route::get('/siswa', 'SiswaController@show'); 
    Route::get('/siswa/{id}', 'SiswaController@detail'); 
    Route::put('/siswa/{id}', 'SiswaController@update'); 
    Route::post('/siswa', 'SiswaController@store'); 
    Route::delete('/siswa/{id}', 'SiswaController@destroy'); 
});

Route::post('pinjam_buku','transaksiController@pinjamBuku');
Route::post('tambah_item/{id}','transaksiController@tambahItem');
Route::post('mengembalikan_buku','transaksiController@mengembalikanBuku');