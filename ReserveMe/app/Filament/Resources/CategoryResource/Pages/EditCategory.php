<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Form as ResourcesForm;
use Filament\Forms\Components;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    public function form(ResourcesForm $form): ResourcesForm
    {
        return $form 
            ->schema([
                Components\TextInput::make('category_name')
                    ->required()
                    ->maxLength(255),
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
