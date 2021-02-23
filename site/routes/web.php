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

Route::get('/', function () {
    return view('visitorsplayground');
});

Auth::routes();
Route::get('/testhome', 'HomeController@home');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/savefile', 'HomeController@savefile');
Route::get('/makecontroller', 'HomeController@makecontroller');
Route::get('/makecontrollerclient', 'HomeController@makecontrollerclient');
Route::get('/makecontrollerserver', 'HomeController@makecontrollerserver');
Route::get('/writAndDownloadZip', 'HomeController@writAndDownloadZip');
Route::get('/download', 'HomeController@downloadFile')->name("download");