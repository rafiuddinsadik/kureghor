<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // By default, normal users will get user_role = 2
        $users = [[
            'name' => "Admin Imran",
            'email' => 'adminimran@email.com',
            'password' => bcrypt('123456'),
            'user_role' => 1
        ],[
            'name' => "User Imran",
            'email' => 'userimran@email.com',
            'password' => bcrypt('123456'),
        ]];
        foreach ($users as $user)
            DB::table('users')->insert($user);
    }
}
