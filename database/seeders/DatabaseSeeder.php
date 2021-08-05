<?php

namespace Database\Seeders;

use App\Models\Family;
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

        \App\Models\Person::factory(10)->hasAttached(Family::factory()->create())->create();
        \App\Models\Person::factory(10)->hasAttached(Family::factory()->create())->create();
    }
}
