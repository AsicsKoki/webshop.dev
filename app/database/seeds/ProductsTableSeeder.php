<?php

class ProductsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('products')->delete();

        DB::table('products')->insert(array(

            [
                'name'      => 'Product 1',
                'user_id'   => 1,
                'color_id'   => 1,
                'price' => 15,
                'quantity'  => 14,
                'description'    => 'Lorem ipsum labore occaecat magna Excepteur dolore officia in nulla veniam qui mollit in occaecat. ',
                'active' => 1,
            ],
            [
                'name'      => 'Product 1',
                'user_id'   => 2,
                'color_id'   => 2,
                'price' => 35,
                'quantity'  => 'peric',
                'description'    => 'Lorem ipsum proident sed culpa est nulla dolor ex. ',
                'active' => 1,
            ],
            [
                'name'      => 'Product 3',
                'user_id'   => 1,
                'color_id'       => 3,
                'price' => '1000',
                'quantity'  => 111,
                'description'    => 'Lorem ipsum ut exercitation sunt id consectetur cupidatat. ',
                'active' => 1,
            ],
            [
                'name'      => 'Product 4',
                'user_id'   => 4,
                'color_id'       => 4,
                'price' => 322,
                'quantity'  => 44,
                'description'    => 'Lorem ipsum voluptate officia nisi aute deserunt id consequat fugiat irure pariatur dolore aliquip ad proident sunt ullamco qui adipisicing ad. ',
                'active' => 1,
            ]
            ));
    }

}