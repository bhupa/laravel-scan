<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();
        $data = [];
            for ($i = 0; $i < 5; $i++) {
                $data [] = [
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password'=> bcrypt('password'),
                    'email_verified_at' => \Carbon\Carbon::now(),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()

                ];
            }
        User::insert($data);
    }
}
