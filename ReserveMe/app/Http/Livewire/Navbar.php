<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $user;
    public $profileAvatar;

    protected $listeners = ['profileUpdated' => 'refreshUser'];

    public $personas;
    public $fecha;
    public $hora;
    public $referencia;
    public $evento;
    public $packageId;
    public $redirectTo;
    public function mount()
    {
        $this->user = Auth::user();

        // Verificar si hay datos de reserva en la sesión
        if (session()->has('recomendation_data')) {
            // Obtener los datos de reserva de la sesión
            $recomendationData = session('recomendation_data');

            // Asignar los valores de reserva a las propiedades del componente
            $this->fecha = $recomendationData['fecha'];
            $this->hora = $recomendationData['hora'];
            $this->personas = $recomendationData['personas'];
            $this->referencia = $recomendationData['referencia'];
            $this->evento = $recomendationData['evento'];
            $this->packageId = $recomendationData['packageId'];

            // Eliminar los datos de reserva de la sesión
            session()->forget('recomendation_data');

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

    public function refreshUser()
    {
        $this->user = Auth::user();
        $this->profileAvatar = $this->user->profileAvatar_url;
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
        if ($this->personas <= $capacidadDisponible) {
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
                $reservation->guest_number = $this->personas;
                $reservation->reservation_datetime = $this->fecha . ' ' . $this->hora;
                $reservation->reservation_status = 'Pendiente';
                $reservation->reference_name = $this->referencia;
                $reservation->associated_event = $this->evento;
                $reservation->payment_status = 'Pendiente';
                $reservation->id_package = $this->packageId;
                $reservation->id_table = $randomTableId;
                $reservation->id_user = auth()->user()->id;
                // Guardar la reserva en la base de datos
                $reservation->save();

                // Limpiar los campos después de guardar la reserva
                $this->fecha = null;
                $this->hora = null;
                $this->personas = null;
                $this->referencia = null;
                $this->evento = null;
                $this->packageId = null;

                $this->redirectTo = route('reservas');
                // Redireccionar o realizar alguna otra acción después de guardar la reserva
                // Por ejemplo, redireccionar a una página de éxito o mostrar un mensaje de confirmación
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
        // Renderizar el componente
        $user = Auth::user();
        $this->profileAvatar = $user ? $user->profileAvatar_url : null;
        return view('livewire.navbar');
        // Realizar la redirección después de que el componente se haya renderizado
        if ($this->redirectTo) {
            session()->put('save_reserve', [
                'saveData' => true,
            ]);
            return redirect($this->redirectTo);
        }
    }
}
