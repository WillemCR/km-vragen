<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sectors = [
            ['SBI' => '0', 'Omschrijving' => 'Geen specifieke sector'],
            ['SBI' => '0111', 'Omschrijving' => 'Teelt van granen, peulvruchten en oliehoudende zaden'],
            ['SBI' => '01131', 'Omschrijving' => 'Teelt van groenten in de volle grond'],
            ['SBI' => '01132', 'Omschrijving' => 'Teelt van groenten onder glas'],
            ['SBI' => '01133', 'Omschrijving' => 'Teelt van paddenstoelen'],
            ['SBI' => '01134', 'Omschrijving' => 'Teelt van aardappels en overige wortel- en knolgewassen'],
            ['SBI' => '0116', 'Omschrijving' => 'Teelt van vezelgewassen'],
            ['SBI' => '01191', 'Omschrijving' => 'Teelt van snijbloemen en snijheesters in de volle grond'],
            ['SBI' => '01192', 'Omschrijving' => 'Teelt van snijbloemen en snijheesters onder glas'],
            ['SBI' => '01193', 'Omschrijving' => 'Teelt van voedergewassen'],
            ['SBI' => '01199', 'Omschrijving' => 'Teelt van overige eenjarige gewassen (rest)'],
            ['SBI' => '9900', 'Omschrijving' => 'Extraterritoriale organisaties en lichamen'],
        ];
        foreach ($sectors as $sector) {
            DB::table('sectors')->insert([
                'sbi_code' => $sector['SBI'],
                'name' => $sector['Omschrijving'],
            ]);
// Nu kun je deze array in je seeder gebruiken om de sectoren toe te voegen aan de database.
        }
    }
}

