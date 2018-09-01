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

Route::group(['namespace' => 'API'], function () {

Route::get('categories/abc', 'categoryAPIController@getCategory');

Route::resource('categories', 'categoryAPIController');

Route::resource('websites', 'websiteAPIController');

// Route::get('products/search/id', 'productAPIController@searchId');
// Route::get('products/search/name', 'productAPIController@searchName');
Route::get('products/search', 'productAPIController@fullSearch');
Route::get('products/show','productAPIController@showMoreProduct');
Route::resource('products', 'productAPIController');


});