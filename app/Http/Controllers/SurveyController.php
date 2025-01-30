<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
class SurveyController extends Controller
{
    public function start()
    {
        return view('survey.start');
    }
    public function index()
    {
        $user = Auth::user();

        if (!$user->is_active){
            return redirect()->route('survey.notActive');
        }

        $resultsCount = $user->results()->count();
       if($resultsCount > 0 || session()->previousUrl() === route('survey.start')) {
           if(!session()->previousUrl() === route('survey.previous')) {
               session(['current_question_index' => $resultsCount]);
           }
        } else {
            return redirect()->route('survey.start');
        }


        if ($user->is_finished) {
            return redirect()->route('survey.results');
        }

        $noSpecificSector = 1;
        $extraPillarId = 4;

        $questions = Question::with('answers')
            ->where(function ($query) use ($user, $noSpecificSector) {
                $query->where('sector_id', $user->sector_id)
                    ->orWhere('sector_id', $noSpecificSector);
            });

        if (!$user->extra_questions) {
            $questions = $questions->where('pillar_id', '!=', $extraPillarId);
        }

        $questions = $questions->orderBy('pillar_id')
            ->get();

        if (!session()->has('current_question_index')) {
            session(['current_question_index' => 0]);
        }

        $currentQuestionIndex = session('current_question_index');
        $currentQuestion = $questions[$currentQuestionIndex] ?? null;

        if (!$currentQuestion) {

            $user->update(['is_finished' => true]);
            session()->forget('current_question_index');
            return redirect()->route('survey.results');
        }

        $answers = $currentQuestion->has_custom_answer
            ? $currentQuestion->answers->where('is_default', false)
            : $currentQuestion->answers;

        if (!session()->has('answered_questions')) {
            session(['answered_questions' => []]);
        }

        $answeredQuestions = session('answered_questions');

        return view('survey.question', compact('currentQuestion', 'questions', 'currentQuestionIndex', 'answeredQuestions', 'answers'));
    }


    public function submitAnswer(Request $request)
    {
        $currentQuestionIndex = session('current_question_index');
        $questions = Question::with('answers')->orderBy('id')->get();

        $answeredQuestions = session('answered_questions', []);
        $answeredQuestions[] = $currentQuestionIndex;
        session(['answered_questions' => $answeredQuestions]);

        if ($request->has('answer')) {
            $answerId = $request->input('answer');
            $answer = Answer::find($answerId); // Validatie dat het antwoord bestaat

            if ($answer) {
                $user = Auth::user();
                $questionId = $questions[$currentQuestionIndex]->id;

                // Controleer of er al een resultaat bestaat voor deze gebruiker en vraag
                $existingResult = Result::where('user_id', $user->id)
                    ->where('question_id', $questionId)
                    ->first();

                if ($existingResult) {
                    // Update bestaand resultaat
                    $existingResult->update([
                        'answer_id' => $answerId,
                    ]);
                } else {
                    // Creëer nieuw resultaat
                    Result::create([
                        'user_id' => $user->id,
                        'question_id' => $questionId,
                        'answer_id' => $answerId,
                    ]);
                }
            }
        }

        if ($currentQuestionIndex < $questions->count() - 1) {
            session(['current_question_index' => $currentQuestionIndex + 1]);
        } else {
            session()->forget('current_question_index');
            $user = Auth::user();
            $user->update(['is_finished' => true]);

            // Zet is_finished op true voordat je doorstuurt
            return redirect()->route('survey.results');
        }

        return redirect()->route('survey.index');
    }
    public function results()
    {
        $user = Auth::user();

        // Fetch all results for the user with their associated pillar and answer
        $userResults = Result::where('user_id', $user->id)
            ->with('question.pillar', 'answer')
            ->get();

        // Calculate the total score and average percentage
        $totalScore = $userResults->sum(function ($result) {
            return $result->answer->percentage ?? 0;
        });
        $averagePercentage = $userResults->count() > 0 ? round(($totalScore / $userResults->count()), 2) : 0;

        // Calculate scores per pillar
        $pillarScores = $userResults->groupBy('question.pillar.id')
            ->mapWithKeys(function ($group, $key) {
                $pillar = $group->first()->question->pillar;
                $pillarTotal = $group->sum(function ($result) {
                    return $result->answer->percentage ?? 0;
                });
                $pillarCount = $group->count();
                return [$pillar->pillar_name => $pillarCount > 0 ? round($pillarTotal / $pillarCount, 2) : 0];
            });

        return view('survey.results', compact('averagePercentage', 'pillarScores'));
    }
    public function previous()
    {
        // Haal de huidige vraagindex op
        $currentQuestionIndex = session('current_question_index', 0);

        // Controleer of er een vorige vraag is
        if ($currentQuestionIndex > 0) {
            // Update de sessie voor de vorige vraag
            session(['current_question_index' => $currentQuestionIndex - 1]);
        }

        return redirect()->route('survey.index');
    }
    public function notActive()
    {
        return view('survey.notActive');
    }

    public function store(Request $request) {
        foreach ($request->all() as $questionId => $answerId) {
            Result::create([
                'user_id' => auth()->id(),
                'question_id' => $questionId,
                'answer_id' => $answerId,
            ]);
        }
        return redirect()->route('results.show');
    }


    // ... andere methodes zoals results, addCustomAnswer, etc.
}
