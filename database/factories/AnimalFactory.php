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
            'gender' =>$this->faker->randomElement([Gender::MALE->value, Gender::FEMALE->value]),
            'birth_date' => Carbon::now(),
            'chip' => '#' . $this->faker->numerify('######'),
            'description' => $this->faker->text(),
            'status' => $this->faker->randomElement([
                AnimalStatus::ADOPTABLE->value, AnimalStatus::IN_PROCESS->value, AnimalStatus::ADOPTED->value,
            ]),
            'user_id' => User::factory(),
            'race_id' => Race::factory(),
            'specie_id' => Specie::factory(),
            'coat_id' => Coat::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
