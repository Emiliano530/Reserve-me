<?php

namespace App\Filament\Resources\OptionResource\Pages;

use App\Filament\Resources\OptionResource;
use App\Models\Category;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Form as ResourcesForm;
use Filament\Forms\Components;

class EditOption extends EditRecord
{
    protected static string $resource = OptionResource::class;

    public function form(ResourcesForm $form): ResourcesForm
    {
        return $form
            ->schema([
                Components\TextInput::make('option_name')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('ingredients')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('shift')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('price')
                    ->required()
                    ->maxLength(255),

                Components\Select::make('id_category')
                    ->options(Category::pluck('category_name', 'id')->toArray())
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
