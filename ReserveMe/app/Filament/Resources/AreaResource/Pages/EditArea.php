<?php

namespace App\Filament\Resources\AreaResource\Pages;

use App\Filament\Resources\AreaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Form as ResourcesForm;
use Filament\Forms\Components;

class EditArea extends EditRecord 
{
    protected static string $resource = AreaResource::class;

    public function form(ResourcesForm $form): ResourcesForm
    {
        return $form 
            ->schema([
                Components\TextInput::make('area_name')
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
