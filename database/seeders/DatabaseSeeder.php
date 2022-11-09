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
         \App\Models\User::factory(10)->create();
         \App\Models\Client::factory(10)->create();
         \App\Models\Payment::factory(1000)->create();
         \App\Models\Dollar::factory(1)->create();
    }
}
