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
        \App\Models\User::factory()->create(['is_admin' => true]);
        \App\Models\User::factory(30)->create();
        
        $users = \App\Models\User::all();

        foreach($users as $user1){
            if($user1->id < 5)
            foreach($users as $user2){
                if($user2->id > 20)
                if($user1->id <= $user2->id){
                    Message::factory(1)->create(['sender_id' => $user1->id, 'receiver_id' => $user2->id]);
                    Message::factory(1)->create(['sender_id' => $user2->id, 'receiver_id' => $user1->id]);
                }
            }
        }
        

    }
}
