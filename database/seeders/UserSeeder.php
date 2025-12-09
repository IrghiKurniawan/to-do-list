<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'irghi@gmail.com',
            'role' => 'admin',
            'password' => Hash ::make('irghi123'),
        ]);
        User::create([
            'name' => 'user',
            'email' => 'adly@gmail.com',
            'role' => 'user',
            'password' => Hash ::make('adly123'),
        ]);
        //
    }
}
