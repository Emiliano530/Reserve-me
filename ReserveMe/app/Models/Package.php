<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_package');
    }

    protected $fillable = ['package_name', 'description', 'options', 'priceXguest', 'packageImage_url'];
    protected function packageName(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucfirst($value),

            set: fn($value) => strtolower($value)
        );
    }
    protected function description(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucfirst($value),

            set: fn($value) => strtolower($value)
        );
    }
    protected function options(): Attribute
    {
        return new Attribute(
            get: fn($value) => unserialize($value),

            set: fn($value) => serialize($value)
        );
    }
}
