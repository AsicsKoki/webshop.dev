<?php

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert(array(

            [
                'name' => 'Car parts',
            ],
            [
                'name' =>'Computers',
            ],
                        [
                'name' => 'Healthcare',
            ],
            [
                'name' =>'Cell phone and tablet',
            ],
                        [
                'name' => 'Sports',
            ],
            [
                'name' =>'Clothes',
            ],
                        [
                'name' => 'Books',
            ],
            [
                'name' =>'Antiques',
            ],
                        [
                'name' => 'Home decoration',
            ],
            [
                'name' =>'Other',
            ],
              [
                'name' => 'Tires',
                'parent_id' => '1'
            ],
            [
                'name' =>'Suspension',
                'parent_id' => '1'

            ],
            [
                'name' => 'Engine mods',
                'parent_id' => '1'
            ],
            [
                'name' =>'CPU',
                'parent_id' => '2'
            ],
            [
                'name' => 'Hard drives',
                'parent_id' => '2'
            ],
        ));
    }
}