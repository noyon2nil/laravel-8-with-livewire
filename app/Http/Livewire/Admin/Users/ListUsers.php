<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ListUsers extends AdminComponent
{
    public $state = [];
    public $user;
    public $user_id;
    public $search_keywords = null;
    public $is_user_update = false;

    protected $listeners = [
        'confirm_deleted' => 'deleted'
    ];

    public function create()
    {
        $this->state = [];
        $this->dispatchBrowserEvent('show-form');
    }

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

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User created successfully.']);
        return redirect()->back();
    }

    public function edit(User $user)
    {
        $this->is_user_update = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function update()
    {
        $validate_data = Validator::make($this->state, [
            'name' => 'required|string|min:3|max:35',
            'email' => 'required|string|email|unique:users,email,' . $this->user->id,
            'password' => 'sometimes|string|min:8|max:16|confirmed'
        ])->validate();

        if (!empty($this->state['password'])) {
            $validate_data['password'] = bcrypt($this->state['password']);
        }

        $this->user->update($validate_data);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully.']);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->user_id = $id;
        $this->dispatchBrowserEvent('delete-confirm-alert');
    }

    public function deleted()
    {
        $user = User::findOrFail($this->user_id);
        $user->delete();

        $this->dispatchBrowserEvent('deleted-success-alert', ['message' => 'User deleted successfully.']);

        return redirect()->back();
    }

    public function render()
    {
        //$users = User::latest()->paginate(8);

        $users = User::where('name', 'like', '%' . $this->search_keywords . '%')
            ->orWhere('email', 'like', '%' . $this->search_keywords . '%')
            ->latest()
            ->paginate(2);
        return view('livewire.admin.users.list-users', [
            'users' => $users
        ]);
    }
}
