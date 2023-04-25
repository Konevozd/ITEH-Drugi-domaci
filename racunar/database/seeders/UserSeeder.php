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
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('admin');   //pass = admin
        $faker = \Faker\Factory::create();

        $i = 0;
        while($i < 25) {

            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password
            ]);

            $i = $i + 1;
        }
    }
}
