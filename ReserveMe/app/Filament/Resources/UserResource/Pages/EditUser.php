<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Resources\Form as ResourcesForm;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Spatie\Permission\Models\Role;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function form(ResourcesForm $form): ResourcesForm
    {
        return $form
            ->schema([
                Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('lastName')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Components\DatePicker::make('birthday'),
                Components\Select::make('role')
                    ->options(Role::pluck('name', 'id')->toArray())
                    ->required(),
                // Agrega aquí los demás campos que deseas permitir editar
            ]);
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

