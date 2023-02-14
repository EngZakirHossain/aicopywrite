<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use Hash;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'wordCount' => 5000,
            'customerSupport' => 1000,
            'current_word' => 10000
        ];

        User::create([
            'user_type' => 'user',
            'plan_id' => 3,
            'name' => 'Zakir Hossain',
            'email' => 'user@gmail.com',
            'data' => json_encode($data),
            'password' => Hash::make('rootadmin'),
        ]);

        User::create([
            'user_type' => 'admin',
            'plan_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'data' => json_encode($data),
            'password' => Hash::make('rootadmin'),
        ]);
    }
}
