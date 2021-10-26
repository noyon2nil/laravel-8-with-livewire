<?php

namespace App\Http\Livewire\Admin\SubCategory;


use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;


class ListSubCategory extends Component
{
    use WithPagination;
    public $select;
    protected $paginationTheme = 'bootstrap';
    public $state =[];
    public $sub_category;
    public $sub_category_update = false;
    public function create(){
        $this->dispatchBrowserEvent('show-form');
    }

    public function store(){
//        dd($this->state);
        Validator::make($this->state, [
            'category_id'=>'required',
            'name' => 'required|string|min:1|max:55',
            'status' => 'required'
        ])->validate();
        SubCategory::create([
            'category_id'=> $this->state['category_id'],
            'name'=> $this->state['name'],
            'status'=> $this->state['status'],
        ]);
        $this->dispatchBrowserEvent('hide-form');
        return redirect()->back();
    }
    // this SubCategory is model
    public function edit(SubCategory $sub_category){
        $this->sub_category_update =true;
        $this->sub_category = $sub_category;
        $this->state = $sub_category->toArray();
        $this->dispatchBrowserEvent('show-form');
    }
    public  function update(){
        $validate = Validator::make($this->state, [
            'category_id'=>'required',
            'name' => 'required|string|min:1|max:55',
            'status' => 'required'
        ])->validate();
        $this->sub_category->update($validate);
        $this->dispatchBrowserEvent('hide-form');
        return redirect()->back();
    }
    public function render()
    {
        $categries = Category::where('status', 0)->latest()->get();
        $sub_categories = SubCategory::where('status', 0)->latest()->paginate(5);
        return view('livewire.admin.sub-category.list-sub-category', [
            'sub_categories'=> $sub_categories,
            'categories' =>$categries,
        ]);
    }
}
