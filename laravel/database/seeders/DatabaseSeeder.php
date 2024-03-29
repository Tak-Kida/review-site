<?php

namespace Database\Seeders;

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
        $this->call(BookTableSeeder::class);
        $this->call(ChaptersTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(PublishersTableSeeder::class);
        $this->call(BookAuthorTableSeeder::class);
    }
}
