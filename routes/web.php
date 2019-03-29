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

Route::get('/',function(){
  return view('HomeView');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('report','HomeController@reportPDF')->name('report.pdf');

Route::resource('gate-Entry','GateEntryController');
Route::get('getGateEntry','GateEntryController@getGateEntry');

Route::resource('yarn-Store','YarnStoreController');
Route::get('getYarnStore','YarnStoreController@getYarnStore');
Route::get('findyarn', 'YarnStoreController@search');

Route::resource('grey-Fabric','GreyFabricController');
Route::get('getGreyFabric','GreyFabricController@getGreyFabric');
Route::get('findGreyFabric', 'GreyFabricController@search');

Route::get('{path}','HomeController@index')->where('path','[A-Za-z]+');
