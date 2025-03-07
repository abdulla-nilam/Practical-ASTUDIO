<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('securepassword'),
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('securepassword'),
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Brown',
                'email' => 'michael@example.com',
                'password' => Hash::make('securepassword'),
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Johnson',
                'email' => 'emily@example.com',
                'password' => Hash::make('securepassword'),
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Lee',
                'email' => 'david@example.com',
                'password' => Hash::make('securepassword'),
            ],
        ]);
    }
}
