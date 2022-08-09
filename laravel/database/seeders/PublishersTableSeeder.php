<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublishersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // #01
        $param = [
            'name' => '英治出版',
            'name_furigana' => 'えいじしゅっぱん',
            'created_at' => '2022-05-01', // 2022-05-01
            'updated_at' => '2022-05-01', // 2022-05-01
        ];
        DB::table('publishers')->insert($param);

        // #02
        $param = [
            'name' => 'SBクリエイティブ',
            'name_furigana' => 'えすびーくりえいてぃぶ',
            'created_at' => '2022-05-01', // 2022-05-01
            'updated_at' => '2022-05-01', // 2022-05-01
        ];
        DB::table('publishers')->insert($param);

        // #03
        $param = [
            'name' => '東洋経済新報社',
            'name_furigana' => 'とうようけいざいしんぽうしゃ',
            'created_at' => '2022-05-01', // 2022-05-01
            'updated_at' => '2022-05-01', // 2022-05-01
        ];
        DB::table('publishers')->insert($param);
    }
}
