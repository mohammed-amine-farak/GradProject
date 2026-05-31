<?php

use App\Http\Controllers\Student\StudentProblemController;

use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentPortfolioController;
use App\Http\Controllers\Student\StudentProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/problems', [StudentProblemController::class, 'index'])->name('problems');
     Route::get('/projects', [StudentProjectController::class, 'index'])->name('projects');
     Route::get('/portfolio', [StudentPortfolioController::class, 'index'])->name('portfolio');
});
