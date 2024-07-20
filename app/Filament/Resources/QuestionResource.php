<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Question;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Imports\QuestionImporter;
use App\Filament\Resources\QuestionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Filament\Resources\QuestionResource\Pages\ImportQuestions;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question_text')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
                Action::make('import')
                    ->label('Import Questions')
                    ->url(fn (): string => route('filament.admin.resources.questions.import'))
                    ->hidden(! auth()->user()->can('create exam question'))
                    ->button()
                    ->outlined()
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
            'import' => ImportQuestions::route('/import'),
        ];
    }
}
