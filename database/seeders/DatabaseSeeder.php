<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
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
        // \App\Models\User::factory(10)->create();
        Category::truncate();
        Product::truncate();
        Blog::truncate();
        Comment::truncate();

        Category::factory(20)->create();
        Product::factory(50)->create();
        Blog::factory(20)->create();
        Comment::factory(50)->create();
    }
}
