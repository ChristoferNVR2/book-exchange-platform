<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $alice    = User::where('username', 'alice')->first();
        $fiction  = Category::where('slug', 'fiction')->first();
        $scifi    = Category::where('slug', 'science-fiction')->first();
        $fantasy  = Category::where('slug', 'fantasy')->first();

        $books = [
            [
                'title'       => 'The Great Gatsby',
                'author'      => 'F. Scott Fitzgerald',
                'isbn'        => '9780743273565',
                'description' => 'A classic novel of the Jazz Age.',
                'condition'   => 'good',
                'category_id' => $fiction->id,
            ],
            [
                'title'       => 'Dune',
                'author'      => 'Frank Herbert',
                'isbn'        => '9780441013593',
                'description' => 'Epic sci-fi saga set on a desert planet.',
                'condition'   => 'fair',
                'category_id' => $scifi->id,
            ],
            [
                'title'       => 'The Hobbit',
                'author'      => 'J.R.R. Tolkien',
                'isbn'        => '9780547928227',
                'description' => 'A fantasy adventure in Middle-earth.',
                'condition'   => 'good',
                'category_id' => $fantasy->id,
            ],
        ];

        foreach ($books as $data) {
            Book::firstOrCreate(
                ['isbn' => $data['isbn']],
                array_merge($data, ['user_id' => $alice->id, 'status' => 'available'])
            );
        }
    }
}
