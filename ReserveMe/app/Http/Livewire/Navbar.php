<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $user;

    protected $listeners = ['profileUpdated' => 'refreshUser'];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function refreshUser()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
