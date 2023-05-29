<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

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
        $this->profileAvatar = $user->profileAvatar_url;
    }

    public function render()
    {
        $user = auth()->user();
        $this->profileAvatar = $user->profileAvatar_url;
        return view('livewire.update-profile');
    }

    public function updatedProfileAvatar()
    {
        $this->validate([
            'profileAvatar' => 'image',
        ]);

        if ($this->profileAvatar) {
            $user = User::find($this->userId);

            // Eliminar la imagen anterior si existe
            if ($user->profileAvatar_url) {
                Storage::delete('public/' . $user->profileAvatar_url);
            }

            // Obtener el nombre único para el archivo
            $filename = $this->profileAvatar->hashName();

            // Guardar la imagen en la carpeta deseada
            $path = $this->profileAvatar->storeAs('public/avatar', $filename);

            // Actualizar la ruta en la base de datos
            $user->profileAvatar_url = 'storage/avatar/' . $filename;
            $user->save();

            $this->emit('profileUpdated');
            $this->emit('notification', 'hecho', 'Imagen de perfil actualizada exitosamente.');
            $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
        }
    }


    public function update()
    {
        $this->validate([
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($this->userId);

        $user->name = $this->name;
        $user->lastName = $this->lastName;
        $user->phone = $this->phone;
        $user->birthday = $this->birthday;
        $user->email = $this->email;

        $user->save();

        $this->emit('profileUpdated');
        $this->emit('notification', 'hecho', 'Usuario actualizado exitosamente.');
        $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
    }

    public function updatePassword()
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);

        $user = User::find($this->userId);

        // Verificar si la contraseña actual ingresada coincide con la contraseña del usuario
        if (!Hash::check($this->currentPassword, $user->password)) {
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
            $user->password = Hash::make($this->newPassword);
        }

        $user->save();

        // Restablecer las variables de las contraseñas a un valor vacío
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->confirmPassword = '';

        $this->emit('notification', 'hecho', 'Contraseña actualizada exitosamente.');
        $this->dispatchBrowserEvent('mostrarMensaje', ['duration' => 1000]);
    }
}
