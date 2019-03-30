<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
  'user'=>'API\UserController'
]);

Route::apiResources([
  'grey-Fabric' => 'API\GreyFabricController'
]);
Route::get('findGreyFabric', 'API\GreyFabricController@searchGreyFabric');

Route::apiResources([
  'dyes-Chemical' => 'API\DyesChemicalController'
]);
Route::get('findDyesChemical', 'API\DyesChemicalController@searchDyesChemical');

Route::apiResources([
  'finish-Fabric' => 'API\FinishFabricController'
]);
