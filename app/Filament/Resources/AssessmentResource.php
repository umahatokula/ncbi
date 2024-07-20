<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Assessment;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Livewire;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssessmentResource\Pages;
use App\Filament\Resources\AssessmentResource\RelationManagers;
use App\Filament\Resources\AssessmentResource\RelationManagers\QuestionsRelationManager;
use App\Livewire\Assessment\AssessmentQuestions;

class AssessmentResource extends Resource
{
    protected static ?string $model = Assessment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $navigationGroup = 'Assessments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\Select::make('set_id')
                        ->relationship('set', 'name')
                        ->columnSpan(2)
                        ->native(false)
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live()
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('number_of_attempts')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('duration_minutes')
                        ->required()
                        ->numeric(),
                    Forms\Components\DateTimePicker::make('validity_start_time')
                        ->required(),
                    Forms\Components\DateTimePicker::make('validity_end_time')
                        ->required(),
                ])->columns(2)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number_of_attempts')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_minutes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('validity_start_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('validity_end_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            QuestionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssessments::route('/'),
            'create' => Pages\CreateAssessment::route('/create'),
            'edit' => Pages\EditAssessment::route('/{record}/edit'),
            'questions' => Pages\AssessmentQuestions::route('/{record}/questions'),
        ];
    }
}
