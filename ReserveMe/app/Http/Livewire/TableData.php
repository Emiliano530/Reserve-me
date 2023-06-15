<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TableData extends Component
{
    public $user;
    public $mesaId;
    public $mesa;
    public $mostrarImagenes = false;
    public $cuadricula;
    public $imagenSeleccionada;
    public $fecha;
    public $hora;


    public function mount($mesaId)
    {
        $this->user = Auth::user();
        $this->mesaId = $mesaId;
        $this->mesa = Table::findOrFail($mesaId);
        $this->cuadricula = true;
        $mexicoTimezone = 'America/Mexico_City';
        $mexicoTime = Carbon::now($mexicoTimezone)->format('H:i');

        $fecha = Carbon::now()->isoFormat('ddd, D MMM YYYY');
        $fechaModificada = str_replace('.', '', $fecha);
        $fechaCapitalizada = ucwords($fechaModificada);

        $this->fecha = $fechaCapitalizada;
        $this->hora = $mexicoTime;
    }

    public function mostrarMasImagenes()
    {
        $this->mostrarImagenes = true;
        $this->cuadricula = false;
    }


    public function zoomImage($mesaId, $imagenUrl)
    {
        // Puedes realizar alguna lógica adicional aquí si es necesario

        $this->imagenSeleccionada = $imagenUrl;
    }

    public function clearZoom()
    {
        $this->imagenSeleccionada = null;
    }

    public function reservarMesa()
    {
        // Definir los rangos de tiempo para los turnos
        $turnoMananaInicio = '07:00';
        $turnoMananaFin = '11:00';
        $turnoNocheInicio = '19:00';
        $turnoNocheFin = '23:00';

        // Obtener la cantidad máxima de personas en el local
        $cantidadMaxima = Table::sum('guestNumber');

        // Obtener la cantidad de personas ya reservadas en el rango de fecha y hora especificado
        $personasReservadas = Reservation::where('reservation_datetime', '>=', $this->fecha . ' ' . $turnoMananaInicio)
            ->where('reservation_datetime', '<=', $this->fecha . ' ' . $turnoNocheFin)
            ->sum('guest_number');

        // Calcular la capacidad disponible en el local
        $capacidadDisponible = $cantidadMaxima - $personasReservadas;

        // Verificar si hay suficiente capacidad para la reserva
        if ($this->mesa->guestNumber <= $capacidadDisponible) {
            // Obtener todos los IDs de tabla disponibles
            $availableTableIds = Table::pluck('id')->toArray();

            // Verificar si hay mesas disponibles
            if (count($availableTableIds) > 0) {
                // Generar un índice aleatorio basado en el número de IDs de tabla disponibles
                $randomIndex = mt_rand(0, count($availableTableIds) - 1);

                // Obtener el ID de tabla aleatorio
                $randomTableId = $availableTableIds[$randomIndex];

                // Crear una nueva reserva con los datos proporcionados
                $reservation = new Reservation();
                $reservation->guest_number = $this->mesa->guestNumber;
                $reservation->reservation_datetime = $this->fecha . ' ' . $this->hora;
                $reservation->reservation_status = 'Pendiente';
                $reservation->reference_name = $this->user->name;
                $reservation->associated_event = null;
                $reservation->payment_status = 'Pendiente';
                $reservation->id_package = null;
                $reservation->id_table = $this->mesa->id;
                $reservation->id_user = auth()->user()->id;
                // Guardar la reserva en la base de datos
                $reservation->save();

                // Limpiar los campos después de guardar la reserva
                $mexicoTimezone = 'America/Mexico_City';
                $mexicoTime = Carbon::now($mexicoTimezone)->format('g:i A');

                $fecha = Carbon::now()->isoFormat('ddd, D MMM YYYY');
                $fechaModificada = str_replace('.', '', $fecha);
                $fechaCapitalizada = ucwords($fechaModificada);

                $this->fecha = $fechaCapitalizada;
                $this->hora = $mexicoTime;

                // Redireccionar o realizar alguna otra acción después de guardar la reserva
                // Por ejemplo, redireccionar a una página de éxito o mostrar un mensaje de confirmación
                $this->emit('guardado', 'hecho', '¡Reserva guardada exitosamente!');
                $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 200]);
            } else {
                // Mostrar un mensaje de error indicando que no hay mesas disponibles
                $this->emit('notification', 'error', 'No hay mesas disponibles para hacer la reserva.');
                $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
            }
        } else {
            // Mostrar un mensaje de error indicando que no hay suficiente capacidad
            $this->emit('notification', 'error', 'No hay suficiente capacidad en el local para la cantidad de personas especificada.');
            $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
        }
    }
    public function render()
    {
        return view('livewire.table-data');
    }
}
