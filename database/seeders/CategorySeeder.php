<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Model\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $newCategory = new Category();
            $newCategory->name = $faker->words(2, true);
            $newCategory->slug = Str::slug("$newCategory->name-$i", '-');

            $newCategory->save();
        }
    }
}
