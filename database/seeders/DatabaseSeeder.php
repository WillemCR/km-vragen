<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //make admin user
        User::factory()
            ->create([
                'first_name' => 'Willem',
                'last_name' => 'van Ede',
                'email' => 'willemvanede@hotmail.nl',
                'password' => bcrypt('V@r1@t1eNw'),
                'is_admin' => true,
            ]);
        User::factory()
            ->create([
                'first_name' => 'André',
                'last_name' => 'Visser',
                'email' => 'info@keurmerksocialeonderneming.nl',
                'password' => bcrypt('L3@r!nGp8s'),
                'is_admin' => true,
            ]);
        // Call other seeders
        $this->call([
            AnswersTableSeeder::class,
            PillarsTableSeeder::class,
            SectorsTableSeeder::class,
            QuestionsTableSeeder::class,

        ]);

    }
}
