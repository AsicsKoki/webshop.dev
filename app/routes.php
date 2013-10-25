
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Id legend
|--------------------------------------------------------------------------
|pid - Product id
|uid - User id
|
|
|
|
*/

Route::get('/', array('as' => 'HomePage', 'uses' => 'HomeController@welcome'));

/**
 * Product routes
 */
Route::get('products/{pid}', array('as' => 'ShowProductPage', 'uses' => 'ProductController@getProduct'))->where('pid', '\d+');
Route::get('products', array('as' => 'AllProducts', 'uses' => 'ProductController@getProducts'));
Route::post('products/{pid}/edit', array('as' => 'UpdateProduct', 'uses' => 'ProductController@postProduct'))->where('pid', '\d+');
Route::get('products/{pid}/edit', array('as' => 'ShowProductEditPage', 'uses' => 'ProductController@editProduct'))->where('pid', '\d+');

/**
 * User related routes
 */

Route::get('users', array('as' => 'AllUsers', 'uses' => 'UsersController@users'));
Route::put('users', 'UsersController@createUser');
