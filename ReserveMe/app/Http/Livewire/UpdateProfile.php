<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UpdateProfile extends Component
{
    public $state;

    public function mount()
    {
        $user = auth()->user();
        $this->state = [
            'name' => $user->name,
            'lastName' => $user->lastName,
            'phone' => $user->phone,
            'birthday' => $user->birthday,
            'email' => $user->email,
        ];
    }

    public function updateProfile()
    {
        $validatedData = $this->validate([
            'state.name' => 'required',
            'state.lastName' => 'required',
            'state.phone' => 'required',
            'state.birthday' => 'required',
            'state.email' => 'required|email',
        ]);
    
        $user = auth()->user();
    
        $user->name = $validatedData['state']['name'];
        $user->lastName = $validatedData['state']['lastName'];
        $user->phone = $validatedData['state']['phone'];
        $user->birthday = $validatedData['state']['birthday'];
        $user->email = $validatedData['state']['email'];
    
        $user->save();
    
        session()->flash('success', '¡Perfil actualizado correctamente!');
    }
    

    public function render()
    {
        $user = auth()->user();

        return view('livewire.update-profile', compact('user'));
    }
}
