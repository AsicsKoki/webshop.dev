
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
Route::get('newProduct', array('as'=>'newProductPage', 'uses' => 'ProductController@getNewProductPage'));
Route::put('newProduct', array('as'=> 'putNewProduct', 'uses' =>'ProductController@putProduct'));

/**
 * User related routes
 */

Route::get('users', array('as' => 'AllUsers', 'uses' => 'UsersController@getUsers'));
Route::get('register', array('as' => 'RegisterForm', 'uses'=>'UsersController@getRegister'));
Route::put('register', array('as'=>'PutNewUser', 'uses' => 'UsersController@putNewUser'));
Route::get('user/{uid}', array('as' => 'ShowUserPage', 'uses' => 'UsersController@getUser'))->where('uid', '\d+');
Route::post('users/{uid}/edit', array('as' => 'UpdateUser', 'uses' => 'UsersController@postUser'))->where('uid', '\d+');
Route::get('users/{uid}/edit', array('as' => 'ShowUserEditPage', 'uses' => 'UsersController@editUser'))->where('uid', '\d+');

/**
 * Authenticantion
 */
Route::get('login', array('uses' => 'SessionsController@login'));
Route::post('login', array('as' => 'authenticate', 'uses' => 'SessionsController@authenticate'));
Route::get('logout', array('as' => 'logout', 'uses' => 'SessionsController@logout'));