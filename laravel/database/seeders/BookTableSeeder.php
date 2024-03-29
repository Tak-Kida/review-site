<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BookTableSeeder extends Seeder
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
            'name' => 'イシューからはじめよ 知的生産の「シンプルな本質」',
            'publisher_id' => 1, // 英治出版
            'first_published' => '2010-11-01', // 2010-11-01
            'created_at' => '2022-05-01', // 2022-05-01
            'updated_at' => '2022-05-01', // 2022-05-01
            'image_name' => 'no_image.png', // no_image.png
        ];
        DB::table('books')->insert($param);
    }
}
