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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/visitormakecontrollerserver', 'VisitorController@makecontrollerserver');
Route::get('/tablesave', 'TsaveController@store');
Route::get('/history', 'TsaveController@index');
// Route::get('savetables.destroy', 'TsaveController@destroy');

Route::get('/', function () {
    return view('visitorsplayground');
});

Route::delete('history/{id}', 'TsaveController@destroy')->name('savetables.destroy');

Route::get('/saved', function () {
    return view('visitorsplayground');
});

Route::get('/saved/{id}/{table_nmae}', 'TsaveController@edit');
Route::get('/saved/{id}/visitormakecontrollerserver', 'TsaveController@makecontrollerserver');

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/sendmail', 'VisitorController@mail');

Auth::routes();
Route::get('/testhome', 'HomeController@home');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/savefile', 'HomeController@savefile');
Route::get('/makecontroller', 'HomeController@makecontroller');
Route::get('/makecontrollerclient', 'HomeController@makecontrollerclient');
Route::get('/makecontrollerserver', 'HomeController@makecontrollerserver');
Route::get('/writAndDownloadZip', 'HomeController@writAndDownloadZip');
Route::get('/download', 'HomeController@downloadFile')->name("download");