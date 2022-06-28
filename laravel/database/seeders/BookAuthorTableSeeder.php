<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookAuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            // 'id' => 1,
            'book_id' => 1,
            'author_id' => 1,
        ];
        DB::table('book_author')->insert($param);
    }
}
