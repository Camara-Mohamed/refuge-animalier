<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\AnimalPicture;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnimalPictureFactory extends Factory{
    protected $model = AnimalPicture::class;

    public function definition(): array
    {
        return [
            'alt' => $this->faker->text(),
            'animal_id' => Animal::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
