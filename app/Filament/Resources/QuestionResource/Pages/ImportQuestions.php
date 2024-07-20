<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use App\Filament\Resources\QuestionResource;
use Filament\Resources\Pages\Page;

class ImportQuestions extends Page
{
    protected static string $resource = QuestionResource::class;

    protected static string $view = 'filament.resources.question-resource.pages.import-questions';
}
