<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $user;
    public $is_user_update = false;
    public $user_id;

    public function create()
    {
        $this->state = [];
        $this->dispatchBrowserEvent('show-form');
    }
//    public function updated($fileds){
//        $this->validateOnly($fileds, [
//            '$state["email"]' => 'required|string|email|unique:users,email',
//        ]);
//    }

    public function store()
    {
        Validator::make($this->state, [
            'name' => 'required|string|min:3|max:35',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|max:16|confirmed'
        ])->validate();
        User::create([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'password' => bcrypt($this->state['password']),
        ]);
        $this->dispatchBrowserEvent('hide-form');
        return redirect()->back();
    }
    public function edit(User $user){
            $this->is_user_update = true;
            $this->user =$user;
            $this->state = $user->toArray();
            $this->dispatchBrowserEvent('show-form');
    }

    public function update(){
        $validate_data = Validator::make($this->state, [
            'name' => 'required|string|min:3|max:35',
//            'email' => 'required|string|email|unique:users,email'.$this->user->id,
            'email' => 'required|string|email|unique:users,email',
            'password' => 'sometimes|string|min:8|max:16|confirmed'
        ])->validate();
        if(!empty($this->state['password'])){
            $validate_data['password'] = bcrypt($this->state['password']);
        }
        $this->user->update($validate_data);
        $this->dispatchBrowserEvent('hide-form');
        return redirect()->back();
    }
    public function delete($id){
        $this->user_id = $id;
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }

    public function render()
    {
        $users = User::latest()->paginate(8);
        return view('livewire.admin.users.list-users', [
            'users' => $users
        ]);
    }
}
