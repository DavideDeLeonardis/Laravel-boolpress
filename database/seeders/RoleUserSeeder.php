<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->name == 'admin') {
                $user->roles()->attach(1);
            } else {
                $user->roles()->attach(2);
            }
        }
    }
}
