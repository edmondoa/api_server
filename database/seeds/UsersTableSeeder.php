<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Ed",
            'email' => 'test@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
