<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'subject' => $this->faker->sentence(4),
            'message' => $this->faker->paragraph(),
            'read_at' => null,
        ];
    }

    public function read(): static
    {
        return $this->state(fn () => ['read_at' => now()]);
    }
}
