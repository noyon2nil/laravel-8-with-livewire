<?php

namespace App\Http\Livewire\Admin\Category;
use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Support\Facades\Validator;

class Category extends AdminComponent
{
    public $state = [];
    public $category;
    public $is_category_update = false;

    public function create(){
        $this->state = [];
        $this->dispatchBrowserEvent('show-form');
    }

    public function store(){

        Validator::make($this->state,[
            'name'=>'required|max:50',
            'status'=>'required',
        ]);

       \App\Models\Category::create([
           'name'=> $this->state['name'],
           'status'=> $this->state['status'],
       ]);
        $this->dispatchBrowserEvent('hide-form');
        return redirect()->back();

    }
    public function edit(\App\Models\Category $category){
        $this->is_category_update = true;
        $this->category = $category;
        $this->state = $category->toArray();
        $this->dispatchBrowserEvent('show-form');
    }
    public function render()
    {
        $categories = \App\Models\Category::latest()->paginate(5);
        return view('livewire.admin.category.category', [
            'categories' => $categories,
        ]);
    }
}
