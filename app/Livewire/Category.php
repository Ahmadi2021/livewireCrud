<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category as CategoryModel;

class Category extends Component
{
    public $categories,$title,$id;
    public $isEdit = false;
    public function render()
    {
        $this->categories = CategoryModel::all();
        return view('livewire.category');
    }

    public function resetInput()
    {
        $this->title = '';
        $this->id = null;
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|min:3',
        ]);
        CategoryModel::create([
            'title' => $this->title
        ]);
        session()->flash('message', 'Created successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('hideModal');
    }
}
