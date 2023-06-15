<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;



class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_user');
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $roleId = $user->getAttribute('role');
            $role = Role::find($roleId);

            if ($role) {
                $user->assignRole($role);
            }
        });

        static::updated(function ($user) {
            if ($user->isDirty('role')) {
                $roleId = $user->getAttribute('role');
                $role = Role::find($roleId);

                if ($role) {
                    $user->syncRoles([$role]);
                }
            }
        });
    }


    protected $fillable = [
        'name', 'lastName', 'phone', 'birthday', 'email', 'password', 'profile_avatar', 'role'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
