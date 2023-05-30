<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FastBooking extends Component
{
    public $fecha;
    public $hora;
    public $cantidad_personas;


    public function render()
    {
        return view('livewire.fast-booking');
    }

    public function reloadComponent()
    {
        // Realiza cualquier lógica adicional si es necesario
        $this->reset(); // Reinicia los datos del componente
    }
    public function MakeReservation()
    {
        // Verificar si el usuario está autenticado
        if (!auth()->check()) {
            // Guardar los datos de reserva en la sesión
            session()->put('reservation_data', [
                'fecha' => $this->fecha,
                'hora' => $this->hora,
                'cantidad_personas' => $this->cantidad_personas,
            ]);

            // Redirigir al usuario al inicio de sesión
            return redirect()->route('login');
        }

        // Validar los datos de entrada
        $this->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'cantidad_personas' => 'required|integer|min:1',
        ]);

        // Realizar la reserva
        $this->guardarReserva();
    }

    protected function guardarReserva()
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
        if ($this->cantidad_personas <= $capacidadDisponible) {
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
                $reservation->guest_number = $this->cantidad_personas;
                $reservation->reservation_datetime = $this->fecha . ' ' . $this->hora;
                $reservation->reservation_status = 'Pendiente';
                $reservation->reference_name = auth()->user()->name;
                $reservation->payment_status = 'Pendiente';
                $reservation->id_table = $randomTableId;
                $reservation->id_user = auth()->user()->id;
                // Guardar la reserva en la base de datos
                $reservation->save();

                // Limpiar los campos después de guardar la reserva
                $this->fecha = null;
                $this->hora = null;
                $this->cantidad_personas = null;

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

    public function mount()
    {
        // Verificar si hay datos de reserva en la sesión
        if (session()->has('reservation_data')) {
            // Obtener los datos de reserva de la sesión
            $reservationData = session('reservation_data');

            // Asignar los valores de reserva a las propiedades del componente
            $this->fecha = $reservationData['fecha'];
            $this->hora = $reservationData['hora'];
            $this->cantidad_personas = $reservationData['cantidad_personas'];

            // Eliminar los datos de reserva de la sesión
            session()->forget('reservation_data');

            // Realizar la reserva automáticamente
            $this->guardarReserva();
        } else {
            // Establecer la fecha y hora actuales de México por defecto
            $mexicoTimezone = 'America/Mexico_City';
            $mexicoTime = Carbon::now($mexicoTimezone)->format('H:i');

            $this->fecha = now()->format('Y-m-d');
            $this->hora = $mexicoTime;
        }
    }

    public function redireccionar()
    {
        if (!request()->routeIs('reservas')) {
            return redirect()->route('reservas'); ////aqui estpy checando que no redirija
        }
    }


    protected $listeners = ['redireccionar'];
}
