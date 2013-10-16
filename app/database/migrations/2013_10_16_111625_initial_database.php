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
			$table->integer('role_id')->nullable();
		});

		Schema::table('products', function($table)
		{
			$table->create();
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('user_id');
			$table->string('name');
		    $table->integer('color_id');
		    $table->integer('price');
		    $table->integer('quantity');
			$table->string('description', 300)->nullable();
			$table->integer('active');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}