<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert(array(

            [
                'id'   => 1,
                'role' => 'admin',
            ],
            [
                'id'   => 0,
                'role' =>'user',
            ],
        ));
    }
}