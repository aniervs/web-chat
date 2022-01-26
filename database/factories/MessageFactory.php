<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sender_id' => function(){
                return User::factory()->create();
            },
            'receiver_id' => function(){
                return User::factory()->create();
            },
            'body' => $this->faker->text()
        ];
    }
}
