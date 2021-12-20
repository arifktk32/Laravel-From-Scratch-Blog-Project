<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        User::truncate();
        Post::truncate();

        $user = \App\Models\User::factory()->create();
        
        $personal = Category::create([
            "title" => "Personal",
            "slug" => "personal"
        ]);

        $work = Category::create([
            "title" => "Work",
            "slug" => "work"
        ]);

        $hobbies = Category::create([
            "title" => "Hobbies",
            "slug" => "hobbies"
        ]);

        Post::create([
            "user_id" => $user->id,
            "category_id" => $personal->id,
            "title" => "Just a personal post",
            "slug" => "just-a-personal-post",
            "excerpt" => "personal post excerpt",
            "body" => "personal post body Lorem ipsum is simply a dummy text"
        ]);

        Post::create([
            "user_id" => $user->id,
            "category_id" => $work->id,
            "title" => "Post about my job work",
            "slug" => "work-post",
            "excerpt" => "work post excerpt",
            "body" => "work post body Lorem ipsum is simply a dummy text"
        ]);

        Post::create([
            "user_id" => $user->id,
            "category_id" => $hobbies->id,
            "title" => "Post about my hobbies",
            "slug" => "hobbies-post",
            "excerpt" => "hobbies post excerpt",
            "body" => "hobbies post body Lorem ipsum is simply a dummy text"
        ]);
    }
}
