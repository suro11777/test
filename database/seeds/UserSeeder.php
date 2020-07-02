<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Api',
                'surname' => 'admin',
                'email' => 'adminadmin@mail.ru',
                'password' => Hash::make('adminadmin'), // secret
                'remember_token' => md5(rand()),
                'role' => ConstUserRole::ADMIN,
            ],
            [
                'name' => 'User1',
                'surname' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user11'), // secret
                'remember_token' => md5(rand()),
                'role' => ConstUserRole::USER,
            ],
            [
                'name' => 'User2',
                'surname' => 'user',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('user11'), // secret
                'remember_token' => md5(rand()),
                'role' => ConstUserRole::USER,
            ],
            [
                'name' => 'User3',
                'email' => 'user3@gmail.com',
                'surname' => 'user',
                'password' => Hash::make('user11'), // secret
                'remember_token' => md5(rand()),
                'role' => ConstUserRole::USER,
            ],
        ]);
    }
}
