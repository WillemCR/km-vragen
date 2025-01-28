<?php

namespace Database\Seeders;
use App\Models\Question;
use App\Models\DefaultAnswer;
use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'title' => 'Behoud vakmanschap en arbeidsplaatsen',
                'description' => 'Het bedrijf zet zich aantoonbaar in voor behoud van vakmanschap en arbeidsplaatsen voor bestaande en toekomstige medewerkers.',
                'pillar_id' => 1,
            ],
            [
                'title' => 'Inclusieve arbeidsmarkt beleid',
                'description' => 'Kansen bieden aan / in dienst nemen van mensen met een afstand tot de arbeidsmarkt, jobcarving, diversiteit',
                'pillar_id' => 1,
            ],
            [
                'title' => 'Veiligheid op de werkvloer',
                'description' => 'Het bedrijf neemt aantoonbare maatregelen om de veiligheid op de werkvloer te vergroten, en kan over een periode van een jaar aantonen dat de veiligheid is verbeterd.',
                'pillar_id' => 1,
            ],
            [
                'title' => 'Onderwijs eigen personeel',
                'description' => 'Het bedrijf biedt een gedocumenteerd en gemonitord opleidingstraject aan voor alle werknemers in het bedrijf.',
                'pillar_id' => 1,
            ],
            [
                'title' => 'Duurzame inzetbaarheid',
                'description' => 'Het bedrijf heeft naast een opleidingstraject een carrièreplanning met heldere doelstellingen voor iedere werknemer.',
                'pillar_id' => 1,
            ],
            [
                'title' => 'Balans privé – werk',
                'description' => 'Het bedrijf heeft een gedocumenteerd beleid op een gezonde balans tussen werk en privé. Dit kan door duidelijke grenzen aan overwerk (zijnde strenger dan de industriële norm), of door ingebouwde flexibiliteit in de werkuren.',
                'pillar_id' => 1,
            ],
            [
                'title' => 'Fysieke gesteldheid',
                'description' => 'Het bedrijf stimuleert de werknemers om gezond te eten, en aan voldoende beweging te komen.',
                'pillar_id' => 1,
            ],
            [
                'title' => 'Sociaal netwerk',
                'description' => 'Het bedrijf heeft een beleid dat stimuleert dat collega\'s elkaar kunnen ontmoeten om de betrokkenheid bij elkaar, het werk en de organisatie te bevorderen.',
                'pillar_id' => 1,
            ],
            [
                'title' => 'ARBO',
                'description' => 'Medewerkers hebben kennis van de risico\'s op de werkplek (RI&E).',
                'pillar_id' => 1,
            ],
            [
                'title' => 'Ongewenst gedrag',
                'description' => 'Binnen het bedrijf is vastgelegd wat ongewenst gedrag is (bv: pesten, seksuele intimidatie, discriminatie, etc.), en: a) dit ongewenste gedrag wordt tegengegaan; b) en de effectiviteit van dit beleid wordt geëvalueerd.',
                'pillar_id' => 1,
            ],
            [
                'title' => 'Gelijke beloning man – vrouw',
                'description' => 'Aantoonbaar (bijv. in cao) afgesproken gelijke behandeling en beloning van mannen en vrouwen.',
                'pillar_id' => 1,
            ],
            [
                'title' => 'Werknemersvrijwilligerswerk/ -beleid',
                'description' => 'Het betreft hier werkzaamheden/projecten die door de werkgever worden geïnitieerd/ondersteund met uren of middelen en er sprake is van toegevoegde waarde voor de samenleving.',
                'pillar_id' => 2,
            ],
            [
                'title' => 'Mantelzorg',
                'description' => 'Oog hebben voor: a) de belasting van mantelzorg op de inzetbaarheid van werknemers; b) het in kaart brengen van de gevolgen van de inzetbaarheid op de organisatie.',
                'pillar_id' => 2,
            ],
            [
                'title' => 'Sponsoring in geld of middelen of inzet medewerkers',
                'description' => 'a) Het ondersteunen met financiële middelen; b) vergroten van de maatschappelijke waarde.',
                'pillar_id' => 2,
            ],
            [
                'title' => 'Ondersteuning organisaties/activiteiten',
                'description' => 'Het om niet beschikbaar stellen van de kennis, kunde en evt. middelen om een maatschappelijk rendement te bewerkstelligen.',
                'pillar_id' => 2,
            ],
            [
                'title' => 'Samenwerking onderwijsinstellingen',
                'description' => 'De mensen en middelen van het bedrijf inzetten binnen een onderwijsinstelling teneinde het onderwijs af te stemmen op de behoefte van het bedrijfsleven.',
                'pillar_id' => 2,
            ],
            [
                'title' => 'Stageplaatsen beschikbaar stellen',
                'description' => 'Bieden van de mogelijkheid voor studenten om specifieke werkervaring op te doen binnen het bedrijf.',
                'pillar_id' => 2,
            ],
            [
                'title' => 'Aantoonbare betrokkenheid samenleving',
                'description' => 'Structurele betrokkenheid bij/op de maatschappij is een integraal onderdeel van de bedrijfsvoering/strategische planning.',
                'pillar_id' => 2,
            ],
            [
                'title' => 'Ketenverantwoordelijkheid',
                'description' => 'Het bedrijf legt een beleid vast t.a.v. duurzame inkoopprocessen. Dit beleid moet objectieve meetmiddelen en doelstellingen hebben. Inkoopproces koppelen aan inkoop uit ISO 26000. Extra punten indien kan worden aangetoond dat leveranciers minimaal kunnen voldoen aan dezelfde eisen t.a.v. deze norm.',
                'pillar_id' => 3,
            ],
            [
                'title' => 'Circulaire economie',
                'description' => 'Het bedrijf moet aantoonbaar zich ingespannen hebben om grondstoffen zo duurzaam mogelijk in te zetten door te kijken naar recycling van afvalstoffen - zowel binnen het bedrijf als bij leveranciers.',
                'pillar_id' => 3,
            ],
            [
                'title' => 'Milieuvervuiling',
                'description' => 'Het bedrijf ontwikkelt targets voor zichzelf om milieuvervuiling te verminderen. Dit beleidsstuk is SMART opgezet.',
                'pillar_id' => 3,
            ],
            [
                'title' => 'Brandstof en energieverbruik',
                'description' => 'Het bedrijf heeft meetbare en herleidbare targets voor het terugdringen van brandstof- en energieverbruik.',
                'pillar_id' => 3,
            ],
        ];
        $defaultAnswers = DefaultAnswer::all();

        foreach ($questions as $questionData) {
            $question = Question::create($questionData);

            foreach ($defaultAnswers as $defaultAnswer) {
                Answer::create([
                    'question_id' => $question->id,
                    'text' => $defaultAnswer->text,
                    'percentage' => $defaultAnswer->percentage,
                ]);
            }
        }
    }

}
