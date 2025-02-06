<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Insert static categories
        $categories = [
            'PHP',
            'Laravel',
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'Node.js',
            'JS',
            'jQuery',
            'Vue',
            'React',
            'Angular',
            'Bootstrap',
            'Tailwind',
            'Sass',
            'CSS',
            'HTML'
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }

        // Create users
        User::factory(10)->create();

        // Create posts
        Post::factory(100)->create();

        // Create comments
        Comment::factory(300)->create();
    }
}
