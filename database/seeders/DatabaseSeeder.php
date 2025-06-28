<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 authors
        $authors = Author::factory(10)->create();

        // Create 20 books, each book assigned a random author_id from created authors
        Book::factory(20)->create([
            'author_id' => function () use ($authors) {
                return $authors->random()->id;
            }
        ]);
    }
}
