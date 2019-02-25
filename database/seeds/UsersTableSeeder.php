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
        //
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'date_birth' => \Carbon\Carbon::createFromDate(1994,05,26)->toDateTimeString(),
            'email' => 'leoperazzini@hotmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
