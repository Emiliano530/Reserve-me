<?php

namespace App\Http\Livewire;

use App\Models\User;

use Livewire\Component;

class UpdateProfile extends Component
{
    public $userId;
    public $name;
    public $lastName;
    public $phone;
    public $birthday;
    public $email;
    public $profileAvatar;

    public function mount()
    {
        $user = auth()->user();

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->lastName = $user->lastName;
        $this->phone = $user->phone;
        $this->birthday = $user->birthday;
        $this->email = $user->email;
        $this->profileAvatar = $user->profile_avatar;
    }

    public function render()
    {
        $user = auth()->user();
        $this->profileAvatar = $user->profile_avatar;
        return view('livewire.update-profile');
    }

    public function update()
    {
        $user = User::find($this->userId);

        $user->name = $this->name;
        $user->lastName = $this->lastName;
        $user->phone = $this->phone;
        $user->birthday = $this->birthday;
        $user->email = $this->email;

        $user->save();

        session()->flash('message', 'Usuario actualizado exitosamente.');
    }
}
