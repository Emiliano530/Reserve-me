<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    protected $fillable = ['option_name','description','ingredients','shift','price','id_category','optionImage_url'];
}
