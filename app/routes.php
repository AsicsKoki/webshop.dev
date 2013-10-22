
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

Route::get('products', 'HomeController@products');
Route::post('/', 'PostController@postData');
Route::get('users', 'UsersController@users');
Route::put('users', 'UsersController@createUser');
// Route::get('/users', 'HomeController@users');
/*Route::get('/', function()
{
	return View::make('index');
});*/