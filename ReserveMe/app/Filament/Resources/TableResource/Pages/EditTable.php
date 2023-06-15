<?php

namespace App\Filament\Resources\TableResource\Pages;

use App\Filament\Resources\TableResource;
use App\Models\Area;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Form as ResourcesForm;
use Filament\Forms\Components;

class EditTable extends EditRecord
{
    protected static string $resource = TableResource::class;

    public function form(ResourcesForm $form): ResourcesForm
    {
        return $form
            ->schema([
                Components\TextInput::make('table_number')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('guestNumber')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('table_url')
                    ->required()
                    ->maxLength(255),

                Components\Select::make('id_area')
                    ->options(Area::pluck('area_name', 'id')->toArray())
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
