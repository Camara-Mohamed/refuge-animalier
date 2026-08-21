<?php

namespace Database\Seeders;

use App\Enums\AnimalStatus;
use App\Enums\Gender;
use App\Enums\UserRole;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Message;
use App\Models\Note;
use App\Models\User;
use App\Models\VolunteerApplication;
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
        $admin = User::factory()->create([
            'name' => 'Camara Mohamed',
            'email' => 'mohamed.camara@lespattesheureuses.com',
            'password' => 'change_this',
            'role' => UserRole::ADMIN->value,
        ]);

        $admin = User::factory()->create([
            'name' => 'Élise Administratrice',
            'email' => 'elise.admin@lespattesheureuses.com',
            'password' => 'change_this',
            'role' => UserRole::ADMIN->value,
        ]);

        $volunteer = User::factory()->create([
            'name' => 'Thomas Bénévole',
            'email' => 'thomas.benevole@lespattesheureuses.com',
            'password' => 'change_this',
            'role' => UserRole::VOLUNTEER->value,
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
        $rabbit = DB::table('species')->where('name', 'Lapin')->value('id');
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

        // Les statuts
        $statuses = [
            AnimalStatus::ADOPTABLE->value,
            AnimalStatus::PENDING->value,
            AnimalStatus::UNDER_CARE->value,
            AnimalStatus::IN_PROCESS->value,
            AnimalStatus::ADOPTED->value,
            AnimalStatus::DECEASED->value,
        ];

        $animals = [];

        for ($i = 1; $i <= 8; $i++) {
            $animals[] = [
                'name' => fake()->firstName(),
                'gender' => fake()->randomElement([Gender::MALE->value, Gender::FEMALE->value]),
                'birth_date' => Carbon::now()->subYears(rand(1, 10)),
                'chip' => fake()->unique()->numerify('######'),
                'description' => 'Chien sociable, habitué à la présence humaine, propre et joueur.',
                'status' => $statuses[$i % count($statuses)],
                'avatar' => "assets/img/public/animals/dogs/dog_{$i}.webp",
                'specie_id' => $species['Chien'],
                'race_id' => $races->random(),
                'coat_id' => $coats['Court'],
                'user_id' => $admin->id,
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
                'status' => $statuses[$i % count($statuses)],
                'avatar' => "assets/img/public/animals/hamsters/hamster_{$i}.webp",
                'specie_id' => $species['Hamster'],
                'race_id' => $races->random(),
                'coat_id' => $coats['Court'],
                'user_id' => $admin->id,
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
                'status' => $statuses[$i % count($statuses)],
                'avatar' => "assets/img/public/animals/cats/cat_{$i}.webp",
                'specie_id' => $species['Chat'],
                'race_id' => $races->random(),
                'coat_id' => $coats['Mi-long'],
                'user_id' => $admin->id,
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
                'status' => $statuses[$i % count($statuses)],
                'avatar' => "assets/img/public/animals/rabbits/rabbit_{$i}.webp",
                'specie_id' => $species['Lapin'],
                'race_id' => $races->random(),
                'coat_id' => $coats['Court'],
                'user_id' => $admin->id,
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
                'status' => $statuses[$i % count($statuses)],
                'avatar' => "assets/img/public/animals/perroquets/perroquet_{$i}.webp",
                'specie_id' => $species['Perroquet'],
                'race_id' => $races->random(),
                'coat_id' => $coats['Plumes'],
                'user_id' => $admin->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('animals')->insert($animals);

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

        $allAnimals = Animal::all();

        // les notes
        $allAnimals->random(8)->each(function (Animal $animal) use ($admin, $volunteer) {
            Note::factory()->count(rand(1, 3))->create([
                'notable_type' => Animal::class,
                'notable_id' => $animal->id,
                'user_id' => fake()->randomElement([$admin->id, $volunteer->id]),
            ]);
        });

        // les demandes d'adoption
        $allAnimals->random(6)->each(function (Animal $animal) {
            $adopter = Adopter::factory()->create();

            Adoption::factory()->create([
                'adopter_id' => $adopter->id,
                'animal_id' => $animal->id,
                'user_id' => null,
                'message' => $adopter->message,
            ]);
        });

        // les messages de contact
        $messages = [
            ['subject' => 'Question sur l\'adoption', 'message' => 'Bonjour, est-ce que Rex est encore disponible à l\'adoption ?'],
            ['subject' => 'Don de nourriture', 'message' => 'Je souhaite faire un don de croquettes, comment procéder ?'],
            ['subject' => 'Horaires du refuge', 'message' => 'Quels sont vos horaires d\'ouverture le week-end ?'],
            ['subject' => 'Animal trouvé', 'message' => 'J\'ai trouvé un chat errant, pouvez-vous le prendre en charge ?'],
            ['subject' => 'Partenariat association', 'message' => 'Nous représentons une association et aimerions organiser un événement commun.'],
            ['subject' => 'Suivi de dossier', 'message' => 'Je n\'ai pas eu de nouvelles depuis ma demande d\'adoption, pouvez-vous me tenir informé ?'],
        ];

        foreach ($messages as $message) {
            Message::factory()->create($message);
        }

        // les candidatures bénévoles
        $applications = [
            ['name' => 'Claire Dubois', 'email' => 'claire.dubois@example.com'],
            ['name' => 'Julien Petit', 'email' => 'julien.petit@example.com'],
            ['name' => 'Nadia Aziz', 'email' => 'nadia.aziz@example.com'],
            ['name' => 'Marc Lefevre', 'email' => 'marc.lefevre@example.com'],
        ];

        foreach ($applications as $application) {
            VolunteerApplication::factory()->create($application);
        }
    }
}
