<?php

class ColorsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('colors')->delete();

        DB::table('colors')->insert(array(

            [
                'id'         => 1,
                'color_name' => 'Red',
            ],
            [
                'id'         => 2,
                'color_name' =>'Green',
            ],
            [
                'id'         => 3,
                'color_name' => 'Blue',
            ],
            [
                'id'         => 4,
                'color_name' =>'Purple',
            ],
        ));
    }
}