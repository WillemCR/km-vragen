<?php

namespace App\Http\Controllers;


use App\Models\Sector;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use App\Models\Result;
use App\Models\Answer;
use App\Models\Pillar;
use App\Models\DefaultAnswer;




class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.admin-dashboard');
    }

    // Vragen beheren
    public function questions(Request $request)
    {
        $sortField = $request->input('sort', 'title'); // Default sort by title
        $sortDirection = $request->input('direction', 'asc'); // Default direction is ascending

        $query = Question::with('pillar');

        // Apply sorting logic
        if ($sortField == 'pillar_name') {
            $query->join('pillars', 'questions.pillar_id', '=', 'pillars.id')
                ->select('questions.*', 'pillars.pillar_name')
                ->orderBy('pillars.pillar_name', $sortDirection);
        } else {
            $query->orderBy($sortField, $sortDirection);
        }

        $questions = $query->get(); // Adjust the number of items per page as needed

        return view('admin.questions', compact('questions'))
            ->with('sortField', $sortField)
            ->with('sortDirection', $sortDirection);
    }

    public function editQuestion($id)
    {
        $question = Question::findOrFail($id);
        $pillars = Pillar::all();
        $sectors = Sector::all();

        return view('admin.edit-question', compact('question', 'pillars', 'sectors',));
    }
    public function defaultAnswers()
    {
        $questions = DefaultAnswer::orderBy('percentage', 'asc')->get();
        return view('admin.default-answer', compact('questions'));
    }

    public function storeDefaultAnswer(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        DefaultAnswer::create($request->only('text', 'percentage'));

        return redirect()->route('admin.default-answers')->with('success', 'Succesvol toegevoegd!');
    }

    public function destroyDefaultAnswer($id)
    {
        $answer = DefaultAnswer::findOrFail($id);
        $answer->delete();

        return redirect()->route('admin.default-answers')->with('success', 'Succesvol verwijderd!');
    }
    public function updateQuestion(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        // Controleer of standaardantwoorden moeten worden geladen
        if ($request->has('load_defaults')) {
            $defaultAnswers = DefaultAnswer::all();

            // Verwijder alle bestaande antwoorden van de vraag
            $question->answers()->delete();

            // Voeg de standaardantwoorden toe aan de vraag
            foreach ($defaultAnswers as $defaultAnswer) {
                $question->answers()->create([
                    'text' => $defaultAnswer->text,
                    'percentage' => $defaultAnswer->percentage,
                ]);
            }


        }

        // Validatie
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'pillar_id' => 'required|exists:pillars,id',
            'sector_id' => 'required|exists:sectors,id',
            'answers.*.id' => 'nullable|numeric|max:100000',
            'answers.*.text' => 'nullable|string|max:255',
            'answers.*.percentage' => 'nullable|numeric|min:0|max:100',
            'new_answers.*.text' => 'nullable|string|max:255',
            'new_answers.*.percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        // Update vraag
        $question->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'pillar_id' => $validatedData['pillar_id'],
            'sector_id' => $validatedData['sector_id'],
        ]);

        // Update bestaande antwoorden
        if (isset($validatedData['answers'])) {
            foreach ($validatedData['answers'] as $answerData) {
                if (isset($answerData['id'])) {
                    Answer::where('id', $answerData['id'])->update([
                        'text' => $answerData['text'],
                        'percentage' => $answerData['percentage'],
                    ]);
                }
            }
        }

        // Verwijder antwoorden
        if ($request->has('delete_answers')) {
            Answer::whereIn('id', $request->delete_answers)->delete();
        }

        // Voeg nieuwe antwoorden toe
        if (isset($validatedData['new_answers'])) {
            foreach ($validatedData['new_answers'] as $newAnswer) {
                if (!empty($newAnswer['text'])) {
                    $question->answers()->create([
                        'text' => $newAnswer['text'],
                        'percentage' => $newAnswer['percentage'] ?? 0,
                    ]);
                }
            }
        }
        return redirect()->route('admin.questions')->with('success', 'Vraag bijgewerkt.');
    }

    public function addAnswer(Request $request, $id)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        $question = Question::findOrFail($id);
        $question->answers()->create([
            'text' => $request->text,
            'percentage' => $request->percentage,
        ]);

        return redirect()->back()->with('success', 'Antwoord toegevoegd.');
    }


    // Gebruikers activeren
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function updateExtraQuestion($id)
    {
        $user = User::findOrFail($id);// Update the "extra_vragen" status based on the checkbox value
        $user->update([
            'extra_questions' => !$user->extra_questions,
        ]);


        // Redirect back with a success message
        return redirect()->route('admin.users')->with('success', 'Extra vragen veranderd!');
    }
    public function activateUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => true]);
        $user->update(['activated_at' => now() ]);
        return redirect()->route('admin.users')->with('success', 'Gebruiker geactiveerd!');
    }

    public function resetUser($id)
    {
        $user = User::findOrFail($id);

        // Update de gebruiker om de enquête als onvoltooid te markeren
        $user->update(['is_finished' => false]);

        // Verwijder alle bestaande antwoorden van de gebruiker
        Result::where('user_id', $user->id)->delete();

        return redirect()->route('admin.users')->with('success', 'Voortgang gereset!');
    }
    public function resetActivation($id){
        $user = User::findOrFail($id);
        $user->update(['activated_at'=>now()]);
        return redirect()->route('admin.users')->with('success', 'Activatie tijd gereset!');
    }

    // Resultaten bekijken
    public function results()
    {
        $results = Result::with('user', 'question.pillar', 'answer')
            ->get()
            ->groupBy('user_id')
            ->map(function ($userResults, $userId) {
                $user = $userResults->first()->user;
                $totalQuestions = $userResults->count();
                $totalScore = $userResults->sum(function ($result) {
                    return $result->answer->percentage ?? 0;
                });
                $averagePercentage = $totalQuestions > 0 ? round(($totalScore / $totalQuestions), 2) : 0;

                // Bereken scores per pilaar
                $pillarScores = $userResults->groupBy('question.pillar.id')
                    ->mapWithKeys(function ($group, $key) {
                        $pillar = $group->first()->question->pillar;
                        $pillarTotal = $group->sum(function ($result) {
                            return $result->answer->percentage ?? 0;
                        });
                        $pillarCount = $group->count();
                        return [$pillar->pillar_name => $pillarCount > 0 ? round($pillarTotal / $pillarCount, 2) : 0];
                    });

                // Details voor uitklappen
                $detailedResults = $userResults->map(function ($result) {
                    return [
                        'title' => $result->question->title,
                        'description' => $result->question->description,
                        'answer' => $result->answer->text ?? 'Geen antwoord',
                        'percentage' => $result->answer->percentage ?? 0,
                    ];
                });

                return [
                    'user' => $user,
                    'average_percentage' => $averagePercentage,
                    'pillar_scores' => $pillarScores,
                    'detailed_results' => $detailedResults,
                ];
            });
        return view('admin.results', compact('results'));
    }
    public function downloadExcel($user)
    {
        // Haal de resultaten voor de specifieke gebruiker op
        $userResults = Result::with('question.pillar', 'answer') // Zorg dat 'pillar' en 'description' beschikbaar zijn
        ->where('user_id', $user)
            ->get()
            ->groupBy('question_id')
            ->map(function ($questionResults, $questionId) {
                $question = $questionResults->first()->question;
                $answer = $questionResults->first()->answer;
                return [
                    'pillar' => $question->pillar->pillar_name ?? 'Geen pijler', // Pijlerinformatie
                    'question' => $question->title,
                    'description' => $question->description ?? 'Geen beschrijving', // Beschrijving
                    'answer' => $answer->text ?? 'Geen antwoord',
                    'percentage' => $answer->percentage ?? 0,
                ];
            });

        $user = User::findOrFail($user);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Stel de breedte van de kolommen in
        $sheet->getColumnDimension('A')->setWidth(20); // Pijler
        $sheet->getColumnDimension('B')->setWidth(15); // Vraag
        $sheet->getColumnDimension('C')->setWidth(80); // Beschrijving
        $sheet->getColumnDimension('D')->setWidth(60); // Antwoord
        $sheet->getColumnDimension('E')->setWidth(15); // Percentage


        // Headers toevoegen
        $sheet->setCellValue('A1', 'Pijler');
        $sheet->setCellValue('B1', 'Vraag');
        $sheet->setCellValue('C1', 'Beschrijving');
        $sheet->setCellValue('D1', 'Antwoord');
        $sheet->setCellValue('E1', 'Percentage');

        $sheet->getStyle('C1:C' . $userResults->count() + 1)->getAlignment()->setWrapText(true);

        $row = 2;
        foreach ($userResults as $detail) {
            $sheet->setCellValue('A' . $row, $detail['pillar']);
            $sheet->setCellValue('B' . $row, $detail['question']);
            $sheet->setCellValue('C' . $row, $detail['description']); // Voeg beschrijving toe
            $sheet->setCellValue('D' . $row, $detail['answer']);
            $sheet->setCellValue('E' . $row, $detail['percentage']);
            $sheet->getRowDimension($row)->setRowHeight(30);
            $row++;
        }

        // Schrijf de spreadsheet naar een Xlsx bestand
        $writer = new Xlsx($spreadsheet);

        $fileNamePart = $user->first_name . '_' . $user->last_name;
        $filename = 'survey_results_' . $fileNamePart . '_' . date('Y-m-d') . '.xlsx';

        // Stuur het bestand naar de browser voor download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }


    public function createQuestion()
    {
        $pillars = Pillar::all();
        $sectors = Sector::all();

        return view('admin.create-question', compact('pillars','sectors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'pillar_id' => 'required|exists:pillars,id',
            'sector_id' => 'required|exists:sectors,id',
            'answers.*.text' => 'nullable|string|max:255',
            'answers.*.percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        // Maak de vraag aan
        $question = Question::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'pillar_id' => $validatedData['pillar_id'],
            'sector_id' => $validatedData['sector_id'],
        ]);

        // Antwoorden opslaan
        if ($request->has('load_defaults')) {
            // Voeg standaardantwoorden toe
            $defaultAnswers = DefaultAnswer::all();
            foreach ($defaultAnswers as $defaultAnswer) {
                $question->answers()->create([
                    'text' => $defaultAnswer->text,
                    'percentage' => $defaultAnswer->percentage,
                ]);
            }
        } else if (isset($validatedData['answers'])) {
            foreach ($validatedData['answers'] as $answer) {

                    $question->answers()->create($answer);
                }
        }

        return redirect()->route('admin.questions')->with('success', 'Vraag succesvol toegevoegd!');
    }



    public function destroyQuestion($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('admin.questions')->with('success', 'Vraag verwijderd!');
    }

}
