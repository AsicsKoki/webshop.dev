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

		$this->call('UsersTableSeeder');
		$this->call('ProductsTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('ColorsTableSeeder');
		$this->call('CategoriesTableSeeder');
	}

}