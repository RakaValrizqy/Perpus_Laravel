<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function(){
    Route::get('/login_check','UserController@getAuthenticatedUser');

    Route::group(['middleware' => ['api.superadmin']], function(){
        Route::delete('/kelas/{id}', 'KelasController@destroy');  
        Route::delete('/siswa/{id}', 'SiswaController@destroy');
        Route::delete('/buku/{id}', 'BukuController@destroy');
    });

    Route::group(['middleware' => ['api.admin']], function(){
        Route::put('/kelas/{id}', 'KelasController@update'); 
        Route::post('/kelas', 'KelasController@store'); 
        Route::put('/siswa/{id}', 'SiswaController@update'); 
        Route::post('/siswa', 'SiswaController@store'); 
        Route::post('/siswa/uploadImage/{id}', 'SiswaController@uploadImage'); 
        Route::put('/buku/{id}', 'BukuController@update'); 
        Route::post('/buku/uploadCover/{id}', 'BukuController@uploadCover'); 
        Route::post('/buku', 'BukuController@store'); 
        Route::post('pinjam_buku','transaksiController@pinjamBuku');
        Route::post('tambah_item/{id}','transaksiController@tambahItem');
        Route::post('mengembalikan_buku','transaksiController@mengembalikanBuku'); 
    });

    Route::get('/kelas', 'KelasController@show'); 
    Route::get('/kelas/{id}', 'KelasController@detail'); 
    Route::get('/siswa', 'SiswaController@show'); 
    Route::get('/siswa/{id}', 'SiswaController@detail'); 
    Route::get('/buku', 'BukuController@show'); 
    Route::get('/buku/{id}', 'BukuController@detail'); 
});

