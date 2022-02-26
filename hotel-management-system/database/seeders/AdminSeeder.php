<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('admins')->insert([
            'name' => 'yasser',
            'email' => 'yassersaad@gmail.com',
            'password' => Hash::make('123456789'),
            'national_id' => '1991110908',
            'avatar_img' => 'avatar.jpg'

        ]);
    }
}
