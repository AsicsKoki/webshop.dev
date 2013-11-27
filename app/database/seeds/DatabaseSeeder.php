<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		//disable key checks
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		$this->call('UsersTableSeeder');
		$this->call('ProductsTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('ColorsTableSeeder');
		$this->call('CategoriesTableSeeder');

		//enable key checks
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

}