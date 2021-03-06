<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Ferreteria\Entities\Categoria;

//Route::group(['middleware' => 'cors'], function () {
    Route::group(['prefix' => 'api'], function () {
        Route::post('createProducto', 'MainController@createProducto');
        Route::post('deleteProducto', 'MainController@deleteProducto');
        Route::put('editProducto', 'MainController@editProducto');
        Route::put('editProductoForSale', 'MainController@editProductoForSale');
        Route::get('getCategorias', 'MainController@getCategorias');
        Route::get('getProductos', 'MainController@getProductos');
        Route::get('getVenta', 'MainController@getVenta');
        Route::get('getProducto/{id}', 'MainController@getProducto');

        Route::post('login','MainController@login');
    });
//});


