<?php

namespace Database\Factories;

use App\Enums\Day;
use App\Models\VolunteerApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

class VolunteerApplicationFactory extends Factory
{
    protected $model = VolunteerApplication::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'number' => $this->faker->buildingNumber(),
            'city' => $this->faker->city(),
            'code_postal' => $this->faker->postcode(),
            'availabilities' => $this->faker->randomElements(
                array_column(Day::cases(), 'value'),
                $this->faker->numberBetween(1, 3)
            ),
            'read_at' => null,
        ];
    }

    public function read(): static
    {
        return $this->state(fn () => ['read_at' => now()]);
    }
}
