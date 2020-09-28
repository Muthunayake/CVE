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

Auth::routes();

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/pv_create', 'DashboardController@prioritizedVanalability')->name('pv.create');


Route::get('/scan-data', 'ScanDataController@index')->name('scan.data');
Route::delete('/scan-data/{id}', 'ScanDataController@delete')->name('scan.delete');
Route::put('/scan-data/{id}', 'ScanDataController@edit')->name('scan.edit');
Route::get('/scan_data/all', 'ScanDataController@all')->name('scan.all');
Route::post('/scan-data-upload', 'ScanDataController@upload')->name('scan.data.upload');


Route::get('/cve', 'CVEController@index')->name('cve');
Route::delete('/cve/{id}', 'CVEController@delete')->name('cve.delete');
Route::put('/cve/{id}', 'CVEController@edit')->name('cve.edit');
Route::get('/cve/all', 'CVEController@all')->name('cve.all');
Route::post('/cve-upload', 'CVEController@upload')->name('cve.upload');


Route::get('/exploit', 'EXPController@index')->name('exp');
Route::delete('/exploit/{id}', 'EXPController@delete')->name('exp.delete');
Route::put('/exploit/{id}', 'EXPController@edit')->name('exp.edit');
Route::get('/exploit/all', 'EXPController@all')->name('exp.all');
Route::post('/exploit-upload', 'EXPController@upload')->name('exp.upload');


Route::get('/asset-lists', 'AssetsListsController@index')->name('asset.lists');
Route::get('/asset-lists/all', 'AssetsListsController@all')->name('asset.lists.all');
Route::post('/asset-list/update', 'AssetsListsController@update')->name('asset.lists.update');

Route::get('/current-control', 'CurrentControlController@index')->name('current-control');
Route::get('/current-control/all', 'CurrentControlController@all')->name('current-control.all');
Route::post('/current-control/update', 'CurrentControlController@update')->name('current-control.update');

Route::get('/upload', 'UploadController@index')->name('upload');
Route::post('/upload/zero_day', 'UploadController@uploadZeroDay')->name('upload.zero.day');
Route::post('/upload/active_exploit', 'UploadController@ActiveExploit')->name('upload.active.exploit');
