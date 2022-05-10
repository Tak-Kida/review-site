<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 1,
            'name' => '安宅 一夫',
            'name_furigana' => 'アタカ カズオ',
            'created_at' => '2022-05-01', // 2022-05-01
            'updated_at' => '2022-05-01', // 2022-05-01
        ];
        DB::table('authors')->insert($param);
    }
}
