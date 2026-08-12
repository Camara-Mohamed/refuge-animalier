<?php

namespace Database\Factories;

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->text(),
            'notable_type' => Animal::class,
            'notable_id' => Animal::factory(),
            'user_id' => User::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function forAdoption(): static
    {
        return $this->state(fn () => [
            'notable_type' => Adoption::class,
            'notable_id' => Adoption::factory(),
        ]);
    }
}
