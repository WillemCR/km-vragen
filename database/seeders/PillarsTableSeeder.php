<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PillarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pillars = [
            ['pillar_name' => 'Mens en Arbeidsmarkt'],
            ['pillar_name' => 'Mens en Maatschappij'],
            ['pillar_name' => 'Mens en Wereld'],
            ['pillar_name' => 'Extra vragen'],
        ];

        foreach ($pillars as $pillar) {
            DB::table('pillars')->insert($pillar);
        }
    }
}
