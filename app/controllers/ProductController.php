<?php

use \Utils\HashUtility;

class ProductController extends BaseController {

	public function __construct()
	{

		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		$this->beforeFilter('admin', ['only' => ['getProductsAdmin', 'deleteProduct', 'editProduct','postProduct','deleteComment']]);
		$this->beforeFilter('auth', array('except' => array('login','authenticate','getRegister')));
		parent::__construct();
	}

	/**
	 * Saves the product image to database and to destination folder. Takes the id and hashes it to use as a name.
	 * @param  [type] $product [description]
	 * @return [type]          [description]
	 */
	private function saveProductImage($product){
		$img = new Image;
		$product->images()->save($img);
		$file            = Input::file('image');
		$extension       = Input::file('image')->getClientOriginalExtension();
		$name            = Input::file('image')->getClientOriginalName();
		$path            = HashUtility::alphaId($img->id). "." . $extension;
		$destinationPath = public_path().'/img/';
		$file->move($destinationPath, $path);
		$img->path = $path;
		$product->images()->save($img);
	}

	/**
     * Generates the products page and table.
     * @return [type] [description]
     */
	public function getProducts()
	{
		return View::make('product.products')
			->with('products', Product::with('color')
			->get());
	}

	/**
	 * Generates the product info page.
	 * @param  [type] $pid [description]
	 * @return [type]      [description]
	 */
	public function getProduct($pid)
	{
		return View::make('product.product')
			->with('product', Product::with('user','images','ratings', 'comments')
			->find($pid));
	}

	/**
	 * Genrerates the priduct edit page.
	 * @param  [type] $pid [description]
	 * @return [type]      [description]
	 */
	public function editProduct($pid)
	{
		return View::make('product.productUpdate')
			->with('product', Product::with('user','images')
			->find($pid));
	}

	/**
	 * Updates an existing product with new data.
	 *
	 * @param  [type] $pid -Product id, target.
	 * @return [type]      [description]
	 */
	public function postProduct($pid){

		$validator = Validator::make(
		Input::all(),
		    array(
				'name'        => 'required|between:5,50',
				'description' => 'required|between:5,500',
				'quantity'    => 'integer|required|min:1',
				'price'       => 'integer|required|min:1',
				'image'       => 'image'
			)
		);
		if ($validator->passes())
		{
			$data = Input::all();
			$product = Product::find($pid);
			$product->update($data);
			if (Input::hasFile('image')) $this->saveProductImage($product);
			return Redirect::back()->with('message', 'Saved');
		} else {
			return Redirect::back()
				->withInput(Input::all())
				->withErrors($validator->messages());
		}
	}

	/**
	 * Generates the new product entry page.
	 * @return [type] [description]
	 */
	public function getNewProductPage(){
		return View::make('product.newProduct');
	}

	/**
	 * Creates the new product and adds it to the database.
	 * @return [type] [description]
	 */
	public function putProduct(){
		$validator = Validator::make(
		Input::all(),
		    array(
				'name'        => 'required|between:5,50',
				'description' => 'required|between:5,500',
				'quantity'    => 'integer|required|min:1',
				'price'       => 'integer|required|min:1',
				'color_id'    => 'integer|required|between:1,5',
				'image'       => 'image'
			)
		);
		if($validator->passes()){
			$data = Input::all();
			$data['user_id']= Auth::User()->id;
			$product = Product::create($data);
			if (Input::hasFile('image')) $this->saveProductImage($product);
			Session::flash('status_success', 'Product created');
			return Redirect::intended('products');
		} else {
			return Redirect::back()
				->withInput(Input::all())
				->withErrors($validator->messages());
		}
	}

	/**
	 * Generates the backend products list.
	 * @return [type] [description]
	 */
	public function getProductsAdmin(){
		return View::make('cpanel.products')
			->with('products', Product::with('color')
			->get());
	}

	/**
	 * Deletes the product.
	 * @param  [type] $pid [description]
	 * @return [type]      [description]
	 */
	public function deleteProduct($pid){
		return Product::where('id', '=', $pid)->delete();
	}

	/**
	 * Handles the search and data display for searches.
	 * @return [type] [description]
	 */
	public function searchProduct(){
		$validator = Validator::make(
		Input::all(),
			array(
				'search' => 'required',
			)
		);
		if($validator->passes()){
			$keyword = Input::get('search');
			$data = Product::search($keyword)->with('images');
			if(!$data->count()){
				return View::make('product.empty');
			}
			return View::make('product.results')->with('data', $data->get());
		} else {
			return View::make('products.empty');
		}
	}

	public function postRating(){
		$rating = new Rating;
		$rating->user_id = Input::get('user_id');
		$rating->rating = Input::get('rating');
		Product::find(Input::get('product_id'))->ratings()->save($rating);
	}

	public function getCategories(){
		return View::make('cpanel.categories')->with('categories', Category::all());
	}

	public function deleteCategory(){
		$id = Input::get('cid');
		Category::find($id)->delete();
		return 1;
	}

	/**
	 * Display products based on selected category
	 * @return [type] [description]
	 */
	public function getCategoryResults($cid){
		// return View::make('product.categoryResult')
		// 	->with('result', Category::find($cid)->with('products')->get()->toArray());
		// return Category::with('products')->find($cid)->toArray();

		return View::make('product.categoryResult')
			->with('result', Category::with('products')->find($cid)->toArray());
	}

	public function postComment(){
		$validator = Validator::make(
		Input::all(),
			array(
				'text' => 'required|min:5',
			)
		);
		if($validator->passes()){
			$comment = new comment;
			$comment->user_id = Auth::User()->id;
			$comment->comment = Input::get('text');
			Product::find(Input::get('id'))->comments()->save($comment);
			$text = Input::get('text');
			return \Utils\HtmlGenerator::generateComment($text);
		} else {
			Session::flash('status_error', 'Please enter comment.');
			return Redirect::back();
		}
	}

	public function postLike($commentId){
		return Like::create(['user_id'=> Auth::User()->id, 'comment_id' => $commentId]);
	}

	public function deleteLike($commentId){
		return Like::where('comment_id', $commentId)->where('user_id', Auth::User()->id )->delete();
	}

	public function deleteComment($commentId){
		return Comment::where('id', '=', $commentId)->delete();
	}

	public function updateCategory(){
		if (Input::get('checked')) {
			return DB::table('categorized_products')->insert(array('category_id' => Input::get('category_id'), 'product_id' => Input::get('product_id')));
		} else {
			return DB::table('categorized_products')->where('category_id', '=', Input::get('category_id'))->where('product_id', '=', Input::get('product_id'))->delete();
		}
	}

	public function getCommentsJSON($pid){
		return Product::with("comments.likes.user", "comments.user")->find($pid);

		// return Product::with(['comments' => function($query){
		// 	$query->with(['likes' => function($query){
		// 		$query->where('user_id', Auth::User()->id );
		// 		$query->with("user");
		// 	}]);
		// }, "comments.user"])->find($pid);
	}

	public function getContactPage(){
		return View::make('utils.contact');
	}
}