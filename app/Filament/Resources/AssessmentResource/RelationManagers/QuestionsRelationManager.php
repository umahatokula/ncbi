<?php

namespace App\Filament\Resources\AssessmentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\Textarea::make('question_text')
                        ->required()
                        ->columnSpanFull(),
                ]),
                Section::make()->schema([
                    Repeater::make('options')
                        ->maxItems(4)
                        ->relationship('options')
                        ->schema([
                            TextInput::make('option_text')->required(),
                            Toggle::make('is_correct')
                        ])
                        ->columns(2)
                ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_text')
            ->columns([
                Tables\Columns\TextColumn::make('question_text'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Action::make('questions')
                    ->label('Select Questions')
                    ->url(fn (): string => route('filament.admin.resources.assessments.questions', ['record' => $this->getOwnerRecord()->id]))
                    ->hidden(! auth()->user()->can('create exam question'))
                    ->button()
                    ->outlined()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
