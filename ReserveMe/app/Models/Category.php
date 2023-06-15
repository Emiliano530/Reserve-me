<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function options()
    {
        return $this->hasMany(Option::class, 'id_category');
    }

    protected $fillable = ['category_name','categoryPhoto_url'];

    protected static function boot()
    {
        parent::boot();

        // Evento deleting: se ejecuta antes de eliminar un registro de la tabla de áreas
        static::deleting(function (Category $category) {
            // Eliminar todas las filas de la tabla OtraTabla que tengan el área como clave foránea
            $category->options()->delete();
        });

        // Evento deleted: se ejecuta después de eliminar un registro de la tabla de áreas
        static::deleted(function (Category $category) {
            // Realizar cualquier otra lógica de eliminación adicional
        });
    }
}
