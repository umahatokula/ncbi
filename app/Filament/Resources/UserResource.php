<?php

namespace App\Filament\Resources;

use App\Models\C3;
use Filament\Forms;
use App\Enums\Title;
use App\Models\User;
use Filament\Tables;
use App\Enums\Gender;
use App\Models\Center;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ServiceTeam;
use App\Enums\MaritalStatus;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Group::make()->schema([
                    Forms\Components\TextInput::make('name')->required()->maxLength(255),
                    Forms\Components\TextInput::make('email')->email()->required()->maxLength(255),
                ])->columns(2),
                Group::make()
                    ->relationship('profile')
                    ->schema([
                        Select::make('title')
                            ->searchable()
                            ->native(false)
                            ->options(Title::class),
                        TextInput::make('phone')->required()->maxLength(255),
                        TextInput::make('whatsapp_number')->required()->maxLength(255),
                        TextInput::make('occupation')->required()->maxLength(255),
                        Radio::make('gender')
                            ->required()
                            ->options(Gender::class),
                        Select::make('marital_status')
                            ->searchable()
                            ->native(false)
                            ->required()
                            ->options(MaritalStatus::class),
                        Select::make('center_id')
                            ->label('Center')
                            ->native(false)
                            ->relationship(name: 'center', titleAttribute: 'name')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required(),
                                ToggleButtons::make('is_active')
                                    ->boolean()
                                    ->inline(),
                                TextInput::make('address'),
                                TextInput::make('phone')->numeric(),
                            ])->columns(2),
                        Select::make('c3_id')
                            ->label('C3')
                            ->native(false)
                            ->relationship(name: 'c3', titleAttribute: 'name')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required(),
                                ToggleButtons::make('is_active')
                                    ->boolean()
                                    ->inline(),
                                TextInput::make('address'),
                                TextInput::make('phone')->numeric(),
                            ])->columns(2),
                        Select::make('service_team_id')
                            ->label('Service Team')
                            ->native(false)
                            ->relationship(name: 'serviceTeam', titleAttribute: 'name')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required(),
                                ToggleButtons::make('is_active')
                                    ->boolean()
                                    ->inline(),
                            ])->columns(2),
                        TextInput::make('phone')->required()->maxLength(255),
                        Toggle::make('gone_through_growth_track'),
                        TextInput::make('growth_track_year')->required()->numeric(),
                    ])->columns(2),
            ])->columnSpan(2),
            Section::make()->schema([
                Select::make('sets')
                    ->multiple()
                    ->preload()
                    ->relationship('sets', titleAttribute: 'name')
            ])->columnSpan(1)
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('profile.phone')->label('Phone number')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
