<?php

namespace Database\Seeders;

use App\Enums\AnimalStatus;
use App\Enums\Gender;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
            'password' => 'change_this',
        ]);

        DB::table('species')->insert([
            ['name' => 'Chien'],
            ['name' => 'Chat'],
            ['name' => 'Perroquet'],
            ['name' => 'Hamster'],
            ['name' => 'Lapin'],
        ]);

        $dog = DB::table('species')->where('name', 'Chien')->value('id');
        $cat = DB::table('species')->where('name', 'Chat')->value('id');
        $hamster = DB::table('species')->where('name', 'Hamster')->value('id');
        $rabbit  = DB::table('species')->where('name', 'Lapin')->value('id');
        $parrot = DB::table('species')->where('name', 'Perroquet')->value('id');

        DB::table('races')->insert([
            ['name' => 'Berger allemand', 'specie_id' => $dog],
            ['name' => 'Labrador', 'specie_id' => $dog],
            ['name' => 'Malinois', 'specie_id' => $dog],
            ['name' => 'Croisé', 'specie_id' => $dog],

            ['name' => 'Européen', 'specie_id' => $cat],
            ['name' => 'Maine Coon', 'specie_id' => $cat],
            ['name' => 'Siamois', 'specie_id' => $cat],

            ['name' => 'Gris du Gabon', 'specie_id' => $parrot],
            ['name' => 'Ara', 'specie_id' => $parrot],
            ['name' => 'Calopsitte', 'specie_id' => $parrot],

            ['name' => 'Hamster doré', 'specie_id' => $hamster],
            ['name' => 'Hamster russe', 'specie_id' => $hamster],
            ['name' => 'Hamster roborovski', 'specie_id' => $hamster],

            ['name' => 'Lapin nain', 'specie_id' => $rabbit],
            ['name' => 'Bélier', 'specie_id' => $rabbit],
            ['name' => 'Fauve de Bourgogne', 'specie_id' => $rabbit],
        ]);

        DB::table('coats')->insert([
            ['name' => 'Court'],
            ['name' => 'Mi-long'],
            ['name' => 'Long'],
            ['name' => 'Sans poils'],
            ['name' => 'Écailles'],
            ['name' => 'Plumes'],
        ]);

        $species = DB::table('species')->pluck('id', 'name');
        $races = DB::table('races')->pluck('id', 'name');
        $coats = DB::table('coats')->pluck('id', 'name');

        $animals = [];

        for ($i = 1; $i <= 8; $i++) {
            $animals[] = [
                'name' => fake()->firstName(),
                'gender' => fake()->randomElement([Gender::MALE->value, Gender::FEMALE->value]),
                'birth_date' => Carbon::now()->subYears(rand(1, 10)),
                'chip' => fake()->unique()->numerify('######'),
                'description' => 'Chien sociable, habitué à la présence humaine, propre et joueur.',
                'status' => AnimalStatus::ADOPTABLE->value,
                'avatar' => "assets/img/public/animals/dogs/dog_{$i}.webp",
                'specie_id' => $species['Chien'],
                'race_id' => $races->random(),
                'coat_id' => $coats['Court'],
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        for ($i = 1; $i <= 2; $i++) {
            $animals[] = [
                'name' => fake()->firstName(),
                'gender' => fake()->randomElement([Gender::MALE->value, Gender::FEMALE->value]),
                'birth_date' => now()->subMonths(rand(2, 18)),
                'chip' => null,
                'description' => 'Hamster calme, idéal pour une adoption responsable avec encadrement.',
                'status' => AnimalStatus::ADOPTABLE->value,
                'avatar' => "assets/img/public/animals/hamsters/hamster_{$i}.webp",
                'specie_id' => $species['Hamster'],
                'race_id' => $races->random(),
                'coat_id' => $coats['Court'],
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        for ($i = 1; $i <= 6; $i++) {
            $animals[] = [
                'name' => fake()->firstName(),
                'gender' => fake()->randomElement([Gender::MALE->value, Gender::FEMALE->value]),
                'birth_date' => Carbon::now()->subYears(rand(1, 15)),
                'chip' => fake()->unique()->numerify('######'),
                'description' => 'Chat calme, affectueux, propre et compatible avec la vie en appartement.',
                'status' => AnimalStatus::ADOPTABLE->value,
                'avatar' => "assets/img/public/animals/cats/cat_{$i}.webp",
                'specie_id' => $species['Chat'],
                'race_id' => $races->random(),
                'coat_id' => $coats['Mi-long'],
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        for ($i = 1; $i <= 2; $i++) {
            $animals[] = [
                'name' => fake()->firstName(),
                'gender' => fake()->randomElement([Gender::MALE->value, Gender::FEMALE->value]),
                'birth_date' => now()->subYears(rand(1, 6)),
                'chip' => fake()->optional()->numerify('######'),
                'description' => 'Lapin sociable, propre, habitué à la manipulation et à la vie en intérieur.',
                'status' => AnimalStatus::ADOPTABLE->value,
                'avatar' => "assets/img/public/animals/rabbits/rabbit_{$i}.webp",
                'specie_id' => $species['Lapin'],
                'race_id' => $races->random(),
                'coat_id' => $coats->random(),
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        for ($i = 1; $i <= 2; $i++) {
            $animals[] = [
                'name' => fake()->firstName(),
                'gender' => fake()->randomElement([Gender::MALE->value, Gender::FEMALE->value]),
                'birth_date' => Carbon::now()->subYears(rand(2, 30)),
                'chip' => null,
                'description' => 'Perroquet intelligent, sociable, nécessitant stimulation et attention.',
                'status' => AnimalStatus::ADOPTABLE->value,
                'avatar' => "assets/img/public/animals/perroquets/perroquet_{$i}.webp",
                'specie_id' => $species['Perroquet'],
                'race_id' => $races->random(),
                'coat_id' => $coats['Plumes'],
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('animals')->insert($animals);

        $species = DB::table('species')->pluck('id', 'name');

        DB::table('vaccines')->insert([
            ['name' => 'Maladie de Carré', 'specie_id' => $species['Chien']],
            ['name' => 'Hépatite de Rubarth', 'specie_id' => $species['Chien']],
            ['name' => 'Parvovirose', 'specie_id' => $species['Chien']],
            ['name' => 'Leptospirose', 'specie_id' => $species['Chien']],
            ['name' => 'Rage', 'specie_id' => $species['Chien']],

            ['name' => 'Typhus', 'specie_id' => $species['Chat']],
            ['name' => 'Coryza', 'specie_id' => $species['Chat']],
            ['name' => 'Leucose (FeLV)', 'specie_id' => $species['Chat']],
            ['name' => 'Rage', 'specie_id' => $species['Chat']],

            ['name' => 'Polyomavirus', 'specie_id' => $species['Perroquet']],
            ['name' => 'Maladie de Pacheco', 'specie_id' => $species['Perroquet']],
            ['name' => 'Chlamydiose', 'specie_id' => $species['Perroquet']],

            ['name' => 'Contrôle parasitaire', 'specie_id' => $species['Hamster']],
            ['name' => 'Suivi vétérinaire annuel', 'specie_id' => $species['Hamster']],

            ['name' => 'Myxomatose', 'specie_id' => $species['Lapin']],
            ['name' => 'VHD (maladie hémorragique)', 'specie_id' => $species['Lapin']],
            ['name' => 'VHD2', 'specie_id' => $species['Lapin']],
        ]);
    }
}
