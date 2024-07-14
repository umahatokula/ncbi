<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Center;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\C3;
use App\Models\ServiceTeam;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(255),
            Forms\Components\TextInput::make('email')->email()->required()->maxLength(255),
            Group::make()
                ->relationship('profile')
                ->schema([
                    Forms\Components\TextInput::make('title')->required()->maxLength(255),
                    Forms\Components\TextInput::make('phone')->required()->maxLength(255),
                    Forms\Components\TextInput::make('whatsapp_number')->required()->maxLength(255),
                    Forms\Components\TextInput::make('occupation')->required()->maxLength(255),
                    Forms\Components\TextInput::make('gender')->required()->maxLength(255),
                    Forms\Components\TextInput::make('marital_status')->required()->maxLength(255),
                    Forms\Components\Select::make('center_id')->required()->options(Center::all()->pluck('name', 'id')),
                    Forms\Components\Select::make('center_id')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->email(),
                    ]),
                    Forms\Components\Select::make('c3_id')->required()->options(C3::all()->pluck('name', 'id')),
                    Forms\Components\Select::make('service_team_id')->required()->options(ServiceTeam::all()->pluck('name', 'id')),
                    Forms\Components\TextInput::make('phone')->required()->maxLength(255),
                    Forms\Components\Toggle::make('gone_through_growth_track'),
                    Forms\Components\TextInput::make('growth_track_year')->required()->numeric(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([Tables\Columns\TextColumn::make('name')->searchable(), Tables\Columns\TextColumn::make('email')->searchable(), Tables\Columns\TextColumn::make('email_verified_at')->dateTime()->sortable(), Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true), Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)])
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
