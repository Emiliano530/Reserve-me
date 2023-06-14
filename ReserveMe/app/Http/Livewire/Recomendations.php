<?php

namespace App\Http\Livewire;

use App\Models\Package;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use DateTimeZone;
use Livewire\Component;

class Recomendations extends Component
{
    public $packages;
    public $package;
    public $visiblepackages = [];
    public $currentIndex = 0;
    public $itemsToShow = 3;

    //reservar
    public $personas;
    public $fecha;
    public $hora;
    public $referencia;
    public $evento;
    public $packageId;

    public function mount()
    {
        $this->packages = Package::all();

        $this->updateVisiblepackages();
        $zonaHoraria = new DateTimeZone('America/Mexico_City');
        $fechaHoraLocal = Carbon::now($zonaHoraria);

        $fecha = Carbon::now()->isoFormat('ddd, D MMM YYYY');
        $fechaModificada = str_replace('.', '', $fecha);
        $fechaCapitalizada = ucwords($fechaModificada);

        $this->fecha = $fechaCapitalizada;
        $this->hora = $fechaHoraLocal->format('g:i A');
    }

    public function nextItems()
    {
        $this->currentIndex += $this->itemsToShow;
        if ($this->currentIndex >= count($this->packages)) {
            $this->currentIndex = 0; // Vuelve al principio de la lista
        }
        $this->updateVisiblepackages();
    }

    public function previousItems()
    {
        $this->currentIndex -= $this->itemsToShow;
        if ($this->currentIndex < 0) {
            $count = count($this->packages);
            $this->currentIndex = $count - ($count % $this->itemsToShow);
            // Ajusta el índice para volver al final de la lista
            if ($this->currentIndex === $count) {
                $this->currentIndex -= $this->itemsToShow;
            }
        }
        $this->updateVisiblepackages();
    }

    private function updateVisiblepackages()
    {
        $this->visiblepackages = $this->packages->slice($this->currentIndex, $this->itemsToShow);
    }

    public function showData($id)
    {
        $this->package = Package::findOrFail($id);
        $this->dispatchBrowserEvent('show-overlay');
    }
    public function clearPackage()
    {
        $this->package = null;
        $zonaHoraria = new DateTimeZone('America/Mexico_City');
        $fechaHoraLocal = Carbon::now($zonaHoraria);

        $fecha = Carbon::now()->isoFormat('ddd, D MMM YYYY');
        $fechaModificada = str_replace('.', '', $fecha);
        $fechaCapitalizada = ucwords($fechaModificada);

        $this->fecha = $fechaCapitalizada;
        $this->hora = $fechaHoraLocal->format('g:i A');

        $this->personas = null;
    }

    public function MakeReservation()
    {
        // Validar los datos de entrada
        $this->packageId = $this->package->id;
        $this->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'personas' => 'required|integer|min:1',
            'referencia' => 'required',
        ]);
        // Verificar si el usuario está autenticado
        if (!auth()->check()) {
            // Guardar los datos de reserva en la sesión
            session()->put('recomendation_data', [
                'fecha' => $this->fecha,
                'hora' => $this->hora,
                'personas' => $this->personas,
                'referencia' => $this->referencia,
                'evento' => $this->evento,
                'packageId' => $this->packageId,
            ]);

            // Redirigir al usuario al inicio de sesión
            return redirect()->route('login');
        }

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
                $mexicoTimezone = 'America/Mexico_City';
                $mexicoTime = Carbon::now($mexicoTimezone)->format('g:i A');

                $fecha = Carbon::now()->isoFormat('ddd, D MMM YYYY');
                $fechaModificada = str_replace('.', '', $fecha);
                $fechaCapitalizada = ucwords($fechaModificada);

                $this->fecha = $fechaCapitalizada;
                $this->hora = $mexicoTime;
                $this->personas = null;
                $this->referencia = null;
                $this->evento = null;
                $this->packageId = null;

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

    public function sendFilter()
    {
        if ($this->personas != null) {
            session()->put('filter_data', [
                'fecha' => $this->fecha,
                'hora' => $this->hora,
                'personas' => $this->personas,
            ]);
            return redirect()->route('filtrados');
        }
    }
    public function render()
    {
        return view('livewire.recomendations');
    }

    public function redireccionar()
    {
        if (!request()->routeIs('reservas')) {
            return redirect()->route('reservas'); ////aqui estpy checando que no redirija
        }
    }

    protected $listeners = ['redireccionar'];
}
