<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminStreamersComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $pageTitle;
    public $user_id;

    public $pageSize = 12;

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }

    public function deleteUser() 
    {
        $user = User::find($this->user_id);
        $user->delete();
        session()->flash('danger', 'Utilisateur supprimer avec Success');
    }


    public function render()
    {
        $users = User::orderBy('pseudo', 'ASC')->paginate($this->pageSize);

        $this->pageTitle = 'Streamer'.config('app.name');

        return view('livewire.admin.admin-streamers-component',[
            'users' => $users,
        ]);
    }
}
