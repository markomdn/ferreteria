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
Route::get('breweries', ['middleware' => 'cors', function()
{
    return Categoria::all();
}]);

//Route::group(['middleware' => 'cors'], function () {
    Route::group(['prefix' => 'api'], function () {
        Route::post('createProducto', 'MainController@createProducto');
        Route::delete('deleteProducto', 'MainController@deleteProducto');
        Route::put('editProducto', 'MainController@editProducto');

        Route::get('getCategorias', 'MainController@getCategorias');
        Route::get('getProductos', 'MainController@getProductos');
        Route::get('getProducto/{id}', 'MainController@getProducto');

        Route::get('login',' MainController@login');
    });
//});


