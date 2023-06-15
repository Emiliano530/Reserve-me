<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Form as ResourcesForm;
use Filament\Forms\Components;

class EditReservation extends EditRecord
{
    protected static string $resource = ReservationResource::class;

    public function form(ResourcesForm $form): ResourcesForm
    {
        return $form
            ->schema([
                Components\Select::make('id_table')
                    ->relationship('tables', 'id')
                    ->required(),
                Components\Select::make('id_user')
                    ->relationship('users', 'name')
                    ->required(),
                Components\TextInput::make('guest_number')
                    ->required(),
                Components\TextInput::make('reservation_status')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('reference_name')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('associated_event')
                    ->maxLength(255),
                Components\Textarea::make('extras')
                    ->maxLength(65535),
                Components\TextInput::make('payment_status')
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
