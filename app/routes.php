
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
Route::get('newProduct', array('as'=>'newProductPage', 'uses' => 'ProductController@getNewProductPage'));
Route::put('newProduct', array('as'=> 'putNewProduct', 'uses' =>'ProductController@putProduct'));

/**
 * User related routes
 */

Route::get('users', array('as' => 'AllUsers', 'uses' => 'UsersController@getUsers'));
Route::get('register', array('as' => 'RegisterForm', 'uses'=>'UsersController@getNewUser'));
Route::put('register', array('as'=>'PutNewUser', 'uses' => 'UsersController@putNewUser'));
Route::get('user/{uid}', array('as' => 'ShowUserPage', 'uses' => 'UsersController@getUser'))->where('uid', '\d+');

/**
 * Authenticantion
 */
Route::get('login', array('uses' => 'SessionsController@login'));
Route::post('login', array('as' => 'authenticate', 'uses' => 'SessionsController@authenticate'));
Route::get('logout', array('as' => 'logout', 'uses' => 'SessionsController@logout'));

/**
 * Control panel
 */


Route::get('admin', array('as'=>'ShowProductsBackend', 'uses'=>'ProductController@getProductsAdmin'));
Route::get('admin/users', array('as'=>'ShowUsersBackend', 'uses'=>'UsersController@getUsersBackend'));
Route::get('admin/users/{uid}/edit', array('as' => 'ShowUserEditPage', 'uses' => 'UsersController@editUser'))->where('uid', '\d+');
Route::post('admin/users/{uid}/edit', array('as' => 'UpdateUser', 'uses' => 'UsersController@postUser'))->where('uid', '\d+');
Route::post('products/{pid}/edit', array('as' => 'UpdateProduct', 'uses' => 'ProductController@postProduct'))->where('pid', '\d+');
Route::get('products/{pid}/edit', array('as' => 'ShowProductEditPage', 'uses' => 'ProductController@editProduct'))->where('pid', '\d+');
Route::delete('admin/products/{pid}', array('as'=> 'DeleteProduct', 'uses' => 'ProductController@deleteProduct'))->where('pid', '\d+');
Route::delete('admin/user/{uid}', array('as'=> 'DeleteUser', 'uses' => 'UsersController@deleteUser'))->where('uid', '\d+');
Route::get('admin/categories', array('as'=>'GetCategories','uses'=>'ProductController@getCategories'));

/**
 * Utils and features(such as ratings and liking)
 */
Route::post('result', array('as'=>'SearchProducts', 'uses'=>'ProductController@searchProduct'));
Route::post('products/rate', array('as'=>'AjaxRatingSubmit', 'uses'=>'ProductController@postRating'));

/**
 * Cart
 */
Route::get('cart', array('as'=>'showCart', 'uses'=>'CartController@getCartPage'));
Route::post('products/{pid}', array('as'=>'addToCart', 'uses'=>'CartController@postToCart'))->where('pid', '\d+');
Route::get('ajaxSlideCart', array('as'=>'ajaxSlideCart','uses'=>'CartController@getCartPage'));
Route::delete('ajaxCartDelete', array('as'=>'cartDelete','uses'=>'CartController@cartDeleteEntry'));
