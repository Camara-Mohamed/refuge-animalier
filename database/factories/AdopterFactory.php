<?php

namespace Database\Factories;

use App\Enums\House;
use App\Models\Adopter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AdopterFactory extends Factory{
    protected $model = Adopter::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'number' => $this->faker->buildingNumber(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'have_garden' => $this->faker->boolean(),
            'house_type' => $this->faker->randomElement([House::APARTMENT, House::LOFT, House::HOUSE, House::STUDIO]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
