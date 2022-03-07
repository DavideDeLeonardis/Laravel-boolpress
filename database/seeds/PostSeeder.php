<?php

use App\Model\Post;
use App\User;
use App\Model\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {
            $newPost = new Post();
            $newPost->user_id = User::inRandomOrder()->first()->id;
            $newPost->category_id = Category::inRandomOrder()->first()->id;
            $newPost->title = $faker->sentence(3, true);
            $newPost->content = $faker->paragraphs(5, true);
            $newPost->image = $faker->imageUrl(640, 480, 'photo', true);
            $newPost->slug = Str::slug("$newPost->title-$i", '-');

            $newPost->save();
        }
    }
}
