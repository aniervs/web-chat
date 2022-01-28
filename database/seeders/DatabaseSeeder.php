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
        \App\Models\User::factory()->create(['is_admin' => true, 'name' => 'Anier Velasco', 'email' => 'anier.velasco@gmail.com']);
        \App\Models\User::factory()->create(['is_admin' => true, 'name' => 'Asiel Velasco', 'email' => 'asiel.velasco@gmail.com']);
        \App\Models\User::factory(50)->create(['is_admin' => false]);
    }
}
