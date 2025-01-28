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
                'password' => bcrypt('wwwwwww'),
                'is_admin' => true,
            ]);
        User::factory()
            ->create([
                'first_name' => 'Henk',
                'last_name' => 'de Groot',
                'email' => 'willemvanede@hotmail.com',
                'password' => bcrypt('wwwwwww'),
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
