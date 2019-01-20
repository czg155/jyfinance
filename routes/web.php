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

Route::get('/buy', 'Buy\BuyViewController@getBuy');

Route::get('/buy/add_buy', function () {
	return view('/buy/add_buy');
});

Route::get('/buy/operate_buy', 'Buy\BuyViewController@operateBuy');
Route::get('/buy/price_buy', 'Buy\BuyViewController@priceBuy');


Route::get('/sale', function () {
	return view('/sale/sale');
});

Route::get('/test', 'Buy\BuyViewController@test');


////////////////////////////////////////////
Route::post('/m/buy/add_buy', 'Buy\BuyMethodController@addBuy');
Route::post('/m/buy/delete_buy', 'Buy\BuyMethodController@deleteBuy');
Route::post('/m/buy/update_buy', 'Buy\BuyMethodController@updateBuy');
Route::post('/m/buy/sortattr_buy', 'Buy\BuyMethodController@sortAttrBuy');
Route::post('/m/buy/sel_buy', 'Buy\BuyMethodController@selBuy');
Route::post('/m/buy/sel_price_buy', 'Buy\BuyMethodController@selPrice');
Route::post('/m/buy/add_price_buy', 'Buy\BuyMethodController@addPriceBuy');