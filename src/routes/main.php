<?php 
header('Access-Control-Allow-Origin: *');

use App\Http\Route;

Route::get('/',         'HomeController@index');
Route::post('/products',        'ProductsController@index');
// Route::post('/',        'UserController@login');
Route::get('/products/all',         'ProductsController@show');
// Route::put('/',         'UserController@update');
Route::delete('/products/{id}/delete',      'ProductsController@destroy');