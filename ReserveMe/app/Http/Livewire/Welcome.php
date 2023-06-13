<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Welcome extends Component
{

    public function render()
    {
        return view('livewire.welcome');
    }
    public function guardado($tipo, $mensaje)
    {
        // Lógica del método guardado
        // Puedes utilizar los parámetros $tipo y $mensaje para personalizar la lógica según tus necesidades

        // Por ejemplo, puedes mostrar una notificación utilizando SweetAlert2
        $this->dispatchBrowserEvent('guardado', ['tipo' => $tipo, 'mensaje' => $mensaje]);
    }
    protected $listeners = ['guardado'];
}
