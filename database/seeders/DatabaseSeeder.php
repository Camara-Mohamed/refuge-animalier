<?php

namespace Database\Seeders;

use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Race;
use App\Models\Specie;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Camara Mohamed',
            'email' => 'mohamed.camara@lespattesheureuses.com',
        ]);

        $users = User::factory(5)->create();
        $animals = Animal::factory(10)->create();
        $adopters = Adopter::factory(5)->create();

        foreach ($animals as $animal) {
            Adoption::factory()->create([
                'animal_id' => $animal->id,
                'adopter_id' => $adopters->random()->id,
                'user_id' => $users->random()->id
            ]);
        }

        $species = Specie::factory(2)->create();
        foreach ($species as $specie) {
            Race::factory(3)->create([
                'specie_id' => $specie->id
            ]);
        }
    }
}
