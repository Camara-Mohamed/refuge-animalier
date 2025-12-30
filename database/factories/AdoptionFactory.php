<?php

namespace Database\Factories;

use App\Enums\AnimalStatus;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AdoptionFactory extends Factory{
    protected $model = Adoption::class;

    public function definition(): array
    {
        return [
            'adoption_date' => Carbon::now(),
            'message' => $this->faker->text(),
            'status' => $this->faker->randomElement([AnimalStatus::IN_PROCESS, AnimalStatus::ADOPTED,
                AnimalStatus::ADOPTABLE]),
            'adopter_id' => Adopter::factory(),
            'animal_id' => Animal::factory(),
            'user_id' => User::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
