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
        $this->categories = CategoryModel::orderBy('id','desc')->get();
        return view('livewire.category');
    }

    public function resetInput()
    {
        $this->title = '';
        $this->id = null;
        $this->isEdit = false;
    }

    public function create()
    {
        $this->resetInput();
        session()->forget('message');
        $this->js("window.dispatchEvent(new CustomEvent('showModal'))");
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|min:2',
        ]);
        CategoryModel::create([
            'title' => $this->title
        ]);
        session()->flash('message', 'Created successfully');
        $this->resetInput();
        $this->js('window.dispatchEvent(new CustomEvent("hideModal"))');
    }

    public function edit($id){
        $cate = CategoryModel::findOrFail($id);
        $this->title = $cate->title;
        $this->id = $cate->id;
        $this->isEdit = true;
        session()->forget('message');
        $this->js("window.dispatchEvent(new CustomEvent('showModal'))");
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|min:2',
        ]);
        if ($this->id) {
            $cate = CategoryModel::findOrFail($this->id);
            $cate->update([
                'title' => $this->title
            ]);

            session()->flash('message', 'Updated successfully');
            $this->resetInput();
            $this->js('window.dispatchEvent(new CustomEvent("hideModal"))');
        }

    }

    public function delete($id){
        $cate = CategoryModel::findOrFail($id);
        $cate->delete();
        session()->flash('message', 'Deleted Successfully');
    }

    public function resetValidationState()
    {
        $this->resetErrorBag();
        $this->reset('title'); // Optional: also reset the field
    }
}
