<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public function tables()
    {
        return $this->hasMany(Table::class, 'id_area');
    }
    protected $fillable = ['area_name'];
    protected static function boot()
    {
        parent::boot();

        // Evento deleting: se ejecuta antes de eliminar un registro de la tabla de áreas
        static::deleting(function (Area $area) {
            // Eliminar todas las filas de la tabla OtraTabla que tengan el área como clave foránea
            $area->tables()->delete();
        });

        // Evento deleted: se ejecuta después de eliminar un registro de la tabla de áreas
        static::deleted(function (Area $area) {
            // Realizar cualquier otra lógica de eliminación adicional
        });
    }
}
