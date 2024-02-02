<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class AdminEditStreamersComponent extends Component
{
    
    public $pseudo;
    public $role = [];
    public $email;


    public $user_id;

    public function mount($user_id)
    {
        $user = User::find($user_id);
        $this->pseudo = $user->pseudo;
        $this->role = $user->role;
        $this->email = $user->email;
    }

    public function StreamersEdit()
    {
        $this->validate([
            'pseudo' => 'required|unique:users,pseudo,' .$this->user_id,
            'email' => 'required|unique:users,email,' .$this->user_id,
            'role' => 'required',
        ]);

        $user = User::find($this->user_id);
        $user->pseudo = $this->pseudo;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->save();
        
        return redirect()->route('admin.streamers')->with('success', 'Modification prise en compte');


    }
    
    public function render()
    {
        // $roles = User::distinct('role')->pluck('role');
        $roles = ['admin', 'author', 'user'];

        return view('livewire.admin.admin-edit-streamers-component', [
            'roles' => $roles
        ]);
    }
}
