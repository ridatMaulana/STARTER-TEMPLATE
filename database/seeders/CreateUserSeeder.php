<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => "isUser",
                'email' => "ridatmaulana28@gmail.com",
                'password' => bcrypt('12345678'),
                'roles_id' => 2
            ],
            [
                'name' => "isAdmin",
                'email' => "ridatmaulana27@gmail.com",
                'password' => bcrypt('12345678'),
                'roles_id' => 1
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }

    }
}
