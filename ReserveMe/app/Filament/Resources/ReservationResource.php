<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_table')
                    ->required(),
                Forms\Components\TextInput::make('id_user')
                    ->required(),
                Forms\Components\TextInput::make('guest_number')
                    ->required(),
                Forms\Components\DateTimePicker::make('reservation_datetime')
                    ->required(),
                Forms\Components\TextInput::make('reservation_status')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('reference_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('associated_event')
                    ->maxLength(255),
                Forms\Components\Textarea::make('extras')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('payment_status')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_table'),
                Tables\Columns\TextColumn::make('id_user'),
                Tables\Columns\TextColumn::make('guest_number'),
                Tables\Columns\TextColumn::make('reservation_datetime')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('reservation_status'),
                Tables\Columns\TextColumn::make('reference_name'),
                Tables\Columns\TextColumn::make('associated_event'),
                Tables\Columns\TextColumn::make('extras'),
                Tables\Columns\TextColumn::make('payment_status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }    
}