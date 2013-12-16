<?php

use Illuminate\Database\Migrations\Migration;

class InitialDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('email');
			$table->string('password');
		    $table->string('first_name', 64);
		    $table->string('last_name', 64);
		    $table->string('username', 64);
			$table->string('bio', 300)->nullable();
			$table->integer('role_id')->unsigned();
			$table->timestamps();
			$table->index('role_id');
		});

		Schema::table('products', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('name');
		    $table->integer('color_id')->unsigned();
		    $table->integer('price');
		    $table->integer('quantity');
			$table->string('description', 300)->nullable();
			$table->integer('active');
			$table->timestamps();
			$table->index('user_id');
		});

		Schema::table('comments', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->string('comment', 300)->nullable();
			$table->integer('approved');
			$table->timestamps();
			$table->index('user_id');
			$table->index('product_id');
		});

		Schema::table('colors', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('color_name');
		});

		Schema::table('categorized_products', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->integer('category_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->timestamps();
		});

		Schema::table('comment_likes', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->integer('comment_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->increments('id');
			$table->index('commenT_id');
			$table->index('user_id');
			$table->timestamps();
		});

		Schema::table('roles', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('role', 300);
		});

		Schema::table('categories', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('parent_id')->nullable()->unsigned();
			$table->string('name', 300);
			$table->index('parent_id');
			$table->timestamps();
		});

		Schema::table('banners', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('banner', 300);
		});

		Schema::table('product_ratings', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->integer('rating');
			$table->timestamps();
			$table->index('user_id');
			$table->index('product_id');
		});

		Schema::table('images', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('imageable_id');
			$table->string('imageable_type', 300);
			$table->string('path', 300);
			$table->timestamps();
		});

		Schema::table('products', function($table)
		{
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});

		Schema::table('comments', function($table)
		{
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});

		Schema::table('comment_likes', function($table)
		{
			$table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});

		Schema::table('categories', function($table)
		{
			$table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
		});

		Schema::table('product_ratings', function($table)
		{
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categorized_products');
		Schema::drop('comment_likes');
		Schema::drop('product_ratings');
		Schema::drop('roles');
		Schema::drop('categories');
		Schema::drop('colors');
		Schema::drop('images');
		Schema::drop('banners');
		Schema::drop('comments');
		Schema::drop('products');
		Schema::drop('users');
	}

}