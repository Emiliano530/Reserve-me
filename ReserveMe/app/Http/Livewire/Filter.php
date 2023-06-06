<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Table;
use Carbon\Carbon;
use DateTimeZone;
use Livewire\Component;

class Filter extends Component
{
    public $fecha;
    public $hora;
    public $personas;
    public $mesas;
    public $areas;
    public $selectedOptions = [];
    public $filteredMesas; // Variable para almacenar las mesas filtradas

    public function mount()
    {
        if (session()->has('filter_data')) {
            // Obtener los datos de reserva de la sesión
            $recomendationData = session('filter_data');

            // Asignar los valores de reserva a las propiedades del componente
            $this->fecha = $recomendationData['fecha'];
            $this->hora = $recomendationData['hora'];
            $this->personas = $recomendationData['personas'];
            // Eliminar los datos de reserva de la sesión
            session()->forget('filter_data');

            // Realizar la reserva automáticamente
            $this->findFilter();
        } else {
            $zonaHoraria = new DateTimeZone('America/Mexico_City');
            $fechaHoraLocal = Carbon::now($zonaHoraria);

            $this->fecha = $fechaHoraLocal->format('Y-m-d');
            $this->hora = $fechaHoraLocal->format('H:i');
            $this->mesas = Table::all();
        }
        $this->areas = Area::all();
    }

    public function render()
    {
        return view('livewire.filter');
    }

    public function findFilter()
    {
        if ($this->personas == null) {
            $this->mesas = Table::all();
            $this->selectedOptions = [];
        } else {
            $query = Table::with('areas')->where('guestNumber', $this->personas);

            if (!empty($this->selectedOptions)) {
                $query->whereIn('id_area', $this->selectedOptions);
            }

            $this->filteredMesas = $query->get();

            $this->mesas = $this->filteredMesas->isEmpty() ? '' : $this->filteredMesas;
        }
    }

    public function updatedSelectedOptions()
    {
        if (count($this->selectedOptions) > 1) {
            $this->selectedOptions = [end($this->selectedOptions)];
        }

        $this->filterMesas();

        if ($this->filteredMesas) {
            $this->findFilter();
        }
    }

    public function filterMesas()
    {
        if (empty($this->selectedOptions)) {
            $this->mesas = Table::all();
        } else {
            $this->mesas = Table::with('areas')
                ->whereIn('id_area', $this->selectedOptions)
                ->get();
        }
    }

    public function showDataTable(){
        return redirect()->route('mesa');
    }
}
