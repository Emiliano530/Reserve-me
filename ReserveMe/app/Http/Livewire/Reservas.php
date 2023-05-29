<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Reservas extends Component
{
    public $reservasPendientes;
    public $reservasHistorial;

    public function mount()
    {
        $user = Auth::user();
        $reservaciones = Reservation::where('id_user', $user->id)->get();

        $this->reservasPendientes = $reservaciones->where('reservation_status', 'Pendiente');
        $this->reservasHistorial = $reservaciones->where('reservation_status', '!=', 'Pendiente');
    }

    public function render()
    {
        return view('livewire.reservas', [
            'reservasPendientes' => $this->reservasPendientes,
            'reservasHistorial' => $this->reservasHistorial,
        ]);
    }

    public function actualizarColumna($id)
    {
        $reserva = Reservation::where('id', $id)->first();
        $reserva->reservation_status = 'cancelada';
        $reserva->save();
    }
}
