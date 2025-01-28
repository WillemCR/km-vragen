<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Question;
use App\Models\DefaultAnswer;

class AnswersTableSeeder extends Seeder
{
    public function run()
    {
        $questions = Question::all();

        $defaultAnswers = [
            ['text' => 'Nee', 'percentage' => 0],
            ['text' => 'besproken is in het managementteam', 'percentage' => 10],
            ['text' => 'besproken is met belanghebbende afdelingen', 'percentage' => 15],
            ['text' => 'besproken met alle verantwoordelijken van alle afdelingen in het bedrijf', 'percentage' => 25],
            ['text' => 'besproken, bevestigd en gedeeld met het gehele personeelsbestand waarbij zo nodig werkomstandigheden en werkafspraken zijn aangepast in volledig beleidsplan', 'percentage' => 50],
            ['text' => 'gedeeld met de stakeholders', 'percentage' => 75],
            ['text' => 'besproken en gedeeld in de keten', 'percentage' => 85],
            ['text' => 'besproken en gedeeld in de keten met onderliggende schriftelijke afspraken', 'percentage' => 99],
            ['text' => 'besproken en gedeeld met afnemers de keten', 'percentage' => 100],
        ];


            foreach ($defaultAnswers as $answer) {
                DefaultAnswer::create([
                    'text' => $answer['text'],
                    'percentage' => $answer['percentage'],
                ]);
            }

    }
}
