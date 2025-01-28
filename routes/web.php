<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/questions', [AdminController::class, 'questions'])->name('admin.questions');
    Route::get('/questions/edit/{id}', [AdminController::class, 'editQuestion'])->name('admin.questions.edit');
    Route::get('/default-answers', [AdminController::class, 'defaultAnswers'])->name('admin.default-answers');
    Route::post('/default-answers', [AdminController::class, 'storeDefaultAnswer'])->name('admin.default-answers.store');
    Route::delete('/default-answers/{id}', [AdminController::class, 'destroyDefaultAnswer'])->name('admin.default-answers.destroy');
    Route::put('/questions/{id}', [AdminController::class, 'updateQuestion'])->name('admin.questions.update');
    Route::post('/questions/{id}/answer', [AdminController::class, 'addAnswer'])->name('admin.questions.addAnswer');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{id}/extra', [AdminController::class, 'updateExtraQuestion'])->name('admin.users.extra');
    Route::post('/users/{id}/activate', [AdminController::class, 'activateUser'])->name('admin.users.activate');
    Route::post('/users/{id}/reset', [AdminController::class, 'resetUser'])->name('admin.users.reset');
    Route::get('/results', [AdminController::class, 'results'])->name('admin.results');
    Route::get('/download-excel/{user}', [AdminController::class, 'downloadExcel'])->name('admin.results.download');
    Route::get('/questions/create', [AdminController::class, 'createQuestion'])->name('admin.questions.create');
    Route::post('/questions', [AdminController::class, 'store'])->name('admin.questions.store');
    Route::delete('/questions/{id}', [AdminController::class, 'destroyQuestion'])->name('admin.questions.destroy');
    Route::post('/users/{id}/reset-activation', [AdminController::class, 'resetActivation'])->name('admin.users.resetActivation');
});

// Dashboard Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Survey Routes
Route::middleware('auth')->group(function () {
    Route::get('/survey', [SurveyController::class, 'index'])->name('survey.index');
    Route::post('/survey/submit', [SurveyController::class, 'submitAnswer'])->name('survey.submit');
    Route::get('/survey/results', [SurveyController::class, 'results'])->name('survey.results');
    Route::get('/survey/previous', [SurveyController::class, 'previous'])->name('survey.previous');
    Route::get('survey/notActive', [SurveyController::class, 'notActive'])->name('survey.notActive');
});

// Answer Routes (assuming this is used in the survey context)
Route::middleware('auth')->group(function () {
    Route::post('/answer/store', [SurveyController::class, 'store'])->name('answer.store');
});

require __DIR__.'/auth.php';
