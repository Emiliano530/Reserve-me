<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Option;
use Livewire\Component;

class Menu extends Component
{
    public $selectedCategory = null;

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = Category::find($categoryId);
    }

    public function selectPreviousCategory()
    {
        $currentCategory = $this->selectedCategory;
        $previousCategory = Category::where('id', '<', $currentCategory->id)->orderBy('id', 'desc')->first();
        if (!$previousCategory) {
            $previousCategory = Category::orderBy('id', 'desc')->first();
        }
        $this->selectedCategory = $previousCategory;
    }

    public function selectNextCategory()
    {
        $currentCategory = $this->selectedCategory;
        $nextCategory = Category::where('id', '>', $currentCategory->id)->orderBy('id')->first();
        if (!$nextCategory) {
            $nextCategory = Category::orderBy('id')->first();
        }
        $this->selectedCategory = $nextCategory;
    }


    public function render()
    {
        $categories = Category::all();
        $options = Option::all();
        return view('livewire.menu', compact('categories', 'options'));
    }
}
