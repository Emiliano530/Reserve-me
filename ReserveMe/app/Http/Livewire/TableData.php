<?php

namespace App\Http\Livewire;

use App\Models\Table;
use Livewire\Component;

class TableData extends Component
{
    public $mesaId;
    public $mesa;
    public $mostrarImagenes = false;
    public $cuadricula;
    public $imagenSeleccionada;


    public function mount($mesaId)
    {
        $this->mesaId = $mesaId;
        $this->mesa = Table::findOrFail($mesaId);
        $this->cuadricula = true;
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
    public function render()
    {
        return view('livewire.table-data');
    }
}
