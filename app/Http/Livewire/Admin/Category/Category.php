<?php

namespace App\Http\Livewire\Admin\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;


class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
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
    public function edit(Category $category){
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
