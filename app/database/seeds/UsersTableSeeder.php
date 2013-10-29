<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert(array(

            [
                'email'      => 'admin@reccircle.me',
                'password'   => Hash::make('admin'),
                'username'   => 'admin',
                'first_name' => 'admin',
                'last_name'  => 'Admin',
                'role_id'    => 1,
            ],
            [
                'email'      => 'admin@reccircle.me',
                'password'   => Hash::make('admin'),
                'username'   => 'Pera',
                'first_name' => 'Petar',
                'last_name'  => 'peric',
                'role_id'    => 1,
            ],
            [
                'email'      => 'admin@reccircle.me',
                'password'   => Hash::make('admin'),
                'username'   => 'Mika',
                'first_name' => 'Mika',
                'last_name'  => 'Mikic',
                'role_id'    => 0,
            ],
            [
                'email'      => 'admin@reccircle.me',
                'password'   => Hash::make('admin'),
                'username'   => 'zika',
                'first_name' => 'Zika',
                'last_name'  => 'Zivkovic',
                'role_id'    => 0,
            ]
            ));
    }

}