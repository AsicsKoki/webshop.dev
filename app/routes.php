
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
Route::get('products/category/{cid}', array('as'=>'getCategoryResults', 'uses'=>'ProductController@getCategoryResults'))->where('cid', '\d+');;
Route::get('products/{pid}/comments', array('as' => 'getProductComments', 'uses' => 'ProductController@getCommentsJSON'))->where('uid', '\d+');

/**
 * User related routes
 */

Route::get('users', array('as' => 'AllUsers', 'uses' => 'UsersController@getUsers'));
Route::get('register', array('as' => 'RegisterForm', 'uses'=>'UsersController@getNewUser'));
Route::put('register', array('as'=>'PutNewUser', 'uses' => 'UsersController@putNewUser'));
Route::get('user/{uid}', array('as' => 'ShowUserPage', 'uses' => 'UsersController@getUser'))->where('uid', '\d+');
Route::get('user/{uid}/comments', array('as' => 'showComments', 'uses' => 'UsersController@getComments'))->where('uid', '\d+');
Route::get('user/{uid}/comments/rawComments', array('as' => 'showCommentsRaw', 'uses' => 'UsersController@getCommentsRaw'))->where('uid', '\d+');
Route::get('profile/{uid}', array('as' => 'showProfilePage', 'uses' => 'UsersController@getProfile'))->where('uid', '\d+');
Route::get('profile/{uid}/profileJson', array('as' => 'getProfileData', 'uses' => 'UsersController@getProfileJson'))->where('uid', '\d+');

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
Route::delete('admin/deleteCategory', array('as'=>'deleteCategory','uses'=>'ProductController@deleteCategory'));
/**
 * Utils and features(such as ratings and liking)
 */
Route::post('result', array('as'=>'SearchProducts', 'uses'=>'ProductController@searchProduct'));
Route::post('products/rate', array('as'=>'AjaxRatingSubmit', 'uses'=>'ProductController@postRating'));
Route::post('products/comment', array('as'=>'postComment', 'uses'=>'ProductController@postComment'));
Route::put('products/postLike/{commentId}', array('as'=>'postLike', 'uses'=>'ProductController@postLike'))->where('commentId', '\d+');
Route::delete('products/unLike/{commentId}', array('as'=>'unLike', 'uses'=>'ProductController@deleteLike'));
Route::delete('products/deleteComment/{commentId}', array('as'=>'deleteComment', 'uses'=>'ProductController@deleteComment'))->where('commentId', '\d+');
Route::post('products/updateCategory', array('as'=>'updateCategory', 'uses'=>'ProductController@updateCategory'));
//delete comments on user page
Route::delete('user/deleteProfileComment', array('as'=>'deleteUserProfileComment', 'uses'=>'ProductController@deleteComment'));
Route::delete('profile/deleteComment/{commentId}', array('as'=>'deleteCommentProfile', 'uses'=>'ProductController@deleteComment'))->where('commentId', '\d+');
Route::delete('profile/deleteProduct/{pid}', array('as'=> 'profileDeleteProduct', 'uses' => 'ProductController@deleteProduct'))->where('pid', '\d+');
Route::post('profile/postReview', array('as'=>'postReview', 'uses'=>'UsersController@postReview'));
Route::post('profile/deleteReview/{reviewId}', array('as'=>'deleteReview', 'uses'=>'UsersController@deleteReview'));
Route::get('contact', array('as'=>'contactFormPage', 'uses'=>'ProductController@getContactPage'));
Route::post('contact/sendEmail', array('as'=>'sendContactEmail', 'uses'=>'UsersController@sendContactEmail'));

/**
 * Cart
 */
Route::get('cart', array('as'=>'showCart', 'uses'=>'CartController@getCartPage'));
Route::post('products/{pid}', array('as'=>'addToCart', 'uses'=>'CartController@postToCart'))->where('pid', '\d+');
Route::get('ajaxSlideCart', array('as'=>'ajaxSlideCart','uses'=>'CartController@getCartPage'));
Route::delete('ajaxCartDelete', array('as'=>'cartDelete','uses'=>'CartController@cartDeleteEntry'));
Route::resource('payment', 'PaypalPaymentController');