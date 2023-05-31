<?php

namespace App\Http\Livewire;

use App\Models\Package;
use Livewire\Component;

class Recomendations extends Component
{
    public $packages;
    public $package;
    public $visiblepackages = [];
    public $currentIndex = 0;
    public $itemsToShow = 3;

    public function mount()
    {
        $this->packages = Package::all();
        $this->updateVisiblepackages();
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
    }
    
    public function render()
    {
        return view('livewire.recomendations');
    }
}
