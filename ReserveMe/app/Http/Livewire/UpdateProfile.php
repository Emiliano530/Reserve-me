<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;

    public $userId;
    public $name;
    public $lastName;
    public $phone;
    public $birthday;
    public $email;
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;
    public $profileAvatar;
    public $mensaje;

    protected $listeners = ['profileUpdated' => '$refresh'];

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

    public function updatedProfileAvatar()
    {
        $this->validate([
            'profileAvatar' => 'image', // Ajusta las reglas de validación según tus necesidades
        ]);

        if ($this->profileAvatar) {
            $user = User::find($this->userId);

            $imageData = $this->profileAvatar->get();
            $user->profile_avatar = $imageData;
            $user->save();

            $this->mensaje = 'Imagen de perfil actualizada exitosamente.';
            $this->emit('profileUpdated');
            $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
        }
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

        // Restablecer las variables de las contraseñas a un valor vacío
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->confirmPassword = '';

        $this->mensaje = 'Usuario actualizado exitosamente.';
        $this->emit('profileUpdated');
        $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
    }

    public function updatePassword()
    {
        $user = User::find($this->userId);
        // Verificar si la contraseña actual ingresada coincide con la contraseña del usuario
        if (!password_verify($this->currentPassword, $user->password)) {
            $this->addError('currentPassword', 'La contraseña actual es incorrecta.');
            return;
        }

        // Verificar si la contraseña nueva coincide con el campo de confirmación de contraseña
        if ($this->newPassword !== $this->confirmPassword) {
            $this->addError('confirmPassword', 'La contraseña nueva y la confirmación de contraseña no coinciden.');
            return;
        }

        // Actualizar la contraseña solo si se ha proporcionado una nueva contraseña
        if (!empty($this->newPassword)) {
            $user->password = bcrypt($this->newPassword);
        }

        $user->save();
        // Restablecer las variables de las contraseñas a un valor vacío
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->confirmPassword = '';

        $this->mensaje = 'Contraseña actualizada exitosamente.';
        $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
    }
}
