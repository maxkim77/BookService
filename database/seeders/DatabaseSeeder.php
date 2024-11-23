<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
        ]);
    
        Book::create([
            'id' => 'vvGjDgAAQBAJ',
            'title' => '러닝 PHP',
            'author' => '데이비드 스클라',
            'thumbnail' => 'xKu9scZ5Shw1yFfihIDn1yjA21qZXz01pekwI1Vl8SSgWmBQpbmDD4GMoz1zLAXFlhFigGUqrSzZzJWd&source=gbs_api',
            'extraLarge' => 'http://books.google.com/books/publisher/content?id=vvGjDgAAQBAJ&printsec=frontcover&img=1&zoom=6&edge=curl&imgtk=AFLRE70e_rE3CJBTZa6-aP-JGgnX3pvIcrFG54s1ZHg4L1dbC8bmqrBkgx0AAIz4zHolQb4kGX0I7bTFhHOVms-CUSmqe9A92fct4dkE5eqc-1DupqK5bqik9YqYHzmhEVNqEzCZ8gu-&source=gbs_api',
            'category' => 'Computers / Programming Languages / PHP',
            'publisher' => '한빛미디어',
            'publishedDate' => '2017-04-10',
            'price' => 20160,
            'buyLink' => 'https://play.google.com/store/books/details?id=vvGjDgAAQBAJ&rdid=book-vvGjDgAAQBAJ&rdot=1&source=gbs_api',

        ]);
        Review::create([ 
            'user_id' => 1,
            'book_id' => 'vvGjDgAAQBAJ',
            'review_title' => "1번리뷰입니다.",
            'review_category' => '사회',
            'review' => '리뷰입니다.',
            'shared_with' => 'my_library'
            ]);

            Review::create([ 
                'user_id' => 1,
                'book_id' => 'vvGjDgAAQBAJ',
                'review_title' => "2번리뷰입니다.",
                'review_category' => '사회',
                'review' => '2번리뷰입니다.',
                'shared_with' => 'my_library'
                ]);
                Review::create([ 
                    'user_id' => 1,
                    'book_id' => 'vvGjDgAAQBAJ',
                    'review_title' => "3번 번리뷰입니다.",
                    'review_category' => '사회',
                    'review' => '3번 리뷰입니다.',
                    'shared_with' => 'my_library'
                    ]);
    }
}
