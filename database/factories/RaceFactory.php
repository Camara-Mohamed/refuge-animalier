<?php

namespace Database\Factories;

use App\Models\Race;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RaceFactory extends Factory{
    protected $model = Race::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'specie_id' => Specie::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
