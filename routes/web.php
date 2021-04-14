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
// Route::get('/', function() {
//   return view('index');
// });

// Login
Route::get('/', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@postlogin');

Route::group(['middleware' => 'auth'], function(){
  
  // Dashboard
  Route::get('/dashboard', 'DashboardController@index');
  
  // Pemasok
  Route::get('/pemasok', 'PemasokController@index');
  Route::post('/pemasok', 'PemasokController@store');
  Route::delete('/pemasok/{b}', 'PemasokController@destroy');
  Route::get('/pemasok/{b}/edit', 'PemasokController@edit');
  Route::patch('/pemasok/{b}', 'PemasokController@update');
  Route::post('/pemasok/search', 'PemasokController@search');
  
  // Barang
  Route::get('/barang', 'BarangController@index');
  Route::post('/barang', 'BarangController@store');
  Route::delete('/barang/{b}', 'BarangController@destroy');
  Route::get('/barang/{b}/edit', 'BarangController@edit');
  Route::patch('/barang/{b}', 'BarangController@update');
  Route::post('/barang/search', 'BarangController@search');
  
  // Barang Keluar
  Route::get('/barangkeluar', 'BarangkeluarController@index');
  Route::post('/barangkeluar', 'BarangkeluarController@store');
  Route::delete('/barangkeluar/{b}', 'BarangkeluarController@destroy');
  Route::post('/barangkeluar/search', 'BarangkeluarController@search');
  // Route::get('/barangkeluar/{b}/edit', 'BarangkeluarController@edit');
  // Route::patch('/barangkeluar/{b}', 'BarangkeluarController@update');

  // Ganti Password
  Route::get('/gantipassword', 'AuthController@gantipassword');
  Route::post('/gantipassword', 'AuthController@postgantipassword');

  Route::get('/logout', 'AuthController@logout');
});





