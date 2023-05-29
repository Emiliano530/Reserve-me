<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $user;
    public $profileAvatar;

    protected $listeners = ['profileUpdated' => 'refreshUser'];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function refreshUser()
    {
        $this->user = Auth::user();
        $this->profileAvatar = $this->user->profileAvatar_url;
    }


    public function render()
    {
        $user = Auth::user();
        $this->profileAvatar = $user ? $user->profileAvatar_url : null;
        return view('livewire.navbar');
    }
}
