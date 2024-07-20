<?php

namespace App\Filament\Resources\AssessmentResource\Pages;

use Filament\Resources\Pages\Page;
use App\Filament\Resources\AssessmentResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class AssessmentQuestions extends Page
{
    use InteractsWithRecord;

    protected static string $resource = AssessmentResource::class;

    protected static string $view = 'filament.resources.assessment-resource.pages.assessment-questions';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}
