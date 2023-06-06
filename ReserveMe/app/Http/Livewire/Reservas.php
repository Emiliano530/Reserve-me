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
        $user = Auth::user();
        $reservaciones = Reservation::where('id_user', $user->id)->get();

        $this->reservasPendientes = $reservaciones->where('reservation_status', 'Pendiente');
        $this->reservasHistorial = $reservaciones->where('reservation_status', '!=', 'Pendiente');
        return view('livewire.reservas', [
            'reservasPendientes' => $this->reservasPendientes,
            'reservasHistorial' => $this->reservasHistorial,
        ]);
    }

    public function confirmarActualizarColumna($id)
    {
        $this->emit('cancelar', $id, '¿Estás seguro de cancelar la reserva?');
        $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
    }

    public function actualizarColumna($id)
    {
        $reserva = Reservation::where('id', $id)->first();
        $reserva->reservation_status = 'cancelada';
        $reserva->save();
        $this->emit('confirmCancel', 'Lamentamos que hayas cancelado', '¿Podrias contarnos el motivo?');
        $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
    }

    public function confirmarEliminarReserva($id)
    {
        $this->emit('eliminar', $id, '¿Estás seguro de eliminar la reserva del historial?');
        $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
    }

    public function eliminarReserva($id)
    {
        $reserva = Reservation::find($id);
        if ($reserva) {
            $reserva->delete();
            $this->emit('confirm', '!Eliminada!', 'La reserva ha sido eliminada del historial');
            $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
        }
    }

    public function confirmarEliminarHistorial()
    {
        $this->emit('confirmEliminarHistorial', '¿Estás seguro de eliminar historial completo?');
        $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
    }

    public function eliminarHistorial()
    {
        $user = Auth::user();
        $reservas = Reservation::where('id_user', $user->id)
            ->whereNotIn('reservation_status', ['pendiente'])
            ->get();

        foreach ($reservas as $reserva) {
            $reserva->delete();
        }

        $this->emit('confirm', '!Historial eliminado!', 'Todo el historial ha sido eliminado.');
        $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
    }



    protected $listeners = ['actualizarColumna', 'eliminarReserva','eliminarHistorial'];
}
