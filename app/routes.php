
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




Route::get('products', array('as' => 'AllProducts', 'uses' => 'ProductController@products'));
Route::get('/', array('as' => 'HomePage', 'uses' => 'HomeController@welcome'));
Route::get('users', array('as' => 'AllUsers', 'uses' => 'UsersController@users'));
Route::put('users', 'UsersController@createUser');
Route::get('products/{pid}', array('as' => 'ShowProductPage', 'uses' => 'ProductController@product'))->where('pid', '\d+');