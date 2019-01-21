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

Route::get('/', function () {
    return view('index');
});

Route::get('/buy', 'BuyViewController@getBuy');

Route::get('/buy/add_buy', function () {
	return view('/buy/add_buy');
});

Route::get('/buy/operate_buy', 'BuyViewController@operateBuy');
Route::get('/buy/price_buy', 'BuyViewController@priceBuy');
Route::get('/buy/state_buy', 'BuyViewController@stateBuy');


Route::get('/sale', function () {
	return view('/sale/sale');
});

Route::get('/test', 'BuyViewController@test');


////////////////////////////////////////////
Route::post('/m/buy/add_buy', 'BuyMethodController@addBuy');
Route::post('/m/buy/delete_buy', 'BuyMethodController@deleteBuy');
Route::post('/m/buy/update_buy', 'BuyMethodController@updateBuy');
Route::post('/m/buy/sortattr_buy', 'BuyMethodController@sortAttrBuy');
Route::post('/m/buy/sel_buy', 'BuyMethodController@selBuy');
Route::post('/m/buy/sel_price_buy', 'BuyMethodController@selPrice');
Route::post('/m/buy/add_price_buy', 'BuyMethodController@addPriceBuy');
Route::post('/m/buy/state_material_buy', 'BuyMethodController@stateMaterialBuy');