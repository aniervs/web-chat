<?php

namespace Database\Seeders;

use App\Models\Message;
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
        
    }
}
