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
        \App\Models\User::factory()->create([
            'email' => 'admin@admin.test',
            'api_token' => hash('sha256', 'XwwPzz157PkFFN1JiVLmG8GAasz4Q8xckoBRYSIIJ9KldEY6Yowfs8lmn4No')
        ]);

        \App\Models\Person::factory(10)->hasAttached(Family::factory()->create())->create();
        \App\Models\Person::factory(10)->hasAttached(Family::factory()->create())->create();
    }
}
