<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    public function areas()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }
    

    protected $fillable = ['table_number','guestNumber','description', 'id_area','table_url'];

    protected function tableUrl(): Attribute
    {
        return new Attribute(
            get: fn($value) => unserialize($value),

            set: fn($value) => serialize($value)
        );
    }
}
