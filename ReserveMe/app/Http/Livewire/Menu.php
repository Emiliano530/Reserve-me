<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Option;
use Livewire\Component;

class Menu extends Component
{
    public function render()
    {
        $categories = Category::all();
        $options = Option::all();
        return view('livewire.menu', compact('categories','options'));
    }
}
