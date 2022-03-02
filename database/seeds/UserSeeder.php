<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $newUser = new User();
        $newUser->name = 'davide';
        $newUser->email = 'd@d.it';
        $string = 'dddddddd';
        $newUser->password = Hash::make($string);
        $newUser->save();

        for ($i = 0; $i < 5; $i++) {
            $newUser = new User();
            $newUser->name = $faker->name();
            $newUser->email = $faker->email();
            $string = '123_789_IT';
            $newUser->password = Hash::make($string);
            $newUser->save();
        }
    }
}
