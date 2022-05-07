<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'title' => 'はじめに　優れた知的生産に共通すること',
            'book_id' => '1', // 『イシューからはじめよ 知的生産の「シンプルな本質」』
            'summary' => 'ここにまとめを入力する', // このチャプターの要約
            'created_at' => '2022-05-01', // 2022-05-01
            'updated_at' => '2022-05-01', // 2022-05-01
        ];
        DB::table('chapters')->insert($param);
    }
}
