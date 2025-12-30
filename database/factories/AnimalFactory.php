<?php

namespace Database\Factories;

use App\Enums\AnimalStatus;
use App\Enums\Gender;
use App\Models\Animal;
use App\Models\Coat;
use App\Models\Race;
use App\Models\Specie;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory{
    protected $model = Animal::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'genre' =>$this->faker->randomElement([Gender::MALE->value, Gender::FEMALE->value]),
            'age' =>$this->faker->year(max: 10),
            'chip' => $this->faker->uuid,
            'description' => $this->faker->text(),
            'status' => $this->faker->randomElement([AnimalStatus::ADOPTABLE->value, AnimalStatus::ADOPTED->value, AnimalStatus::IN_PROCESS->value]),
            'user_id' => User::factory(),
            'race_id' => Race::factory(),
            'species_id' => Specie::factory(),
            'coat_id' => Coat::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
