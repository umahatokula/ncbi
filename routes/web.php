<?php

use App\Livewire\Assessment\Confirmation as AssessmentConfirmation;
use App\Livewire\Assessment\Exam as AssessmentExam;
use App\Livewire\Assessment\Index as AssessmentIndex;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard', 301);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('assessments', AssessmentIndex::class)->name('assessments.index');
    Route::get('assessments/{slug}/{attemptNumber}/exam', AssessmentExam::class)->name('assessment.show');
    Route::get('assessments/{slug}/{attemptNumber}/confirmation', AssessmentConfirmation::class)->name('assessment.confirmation');

});
