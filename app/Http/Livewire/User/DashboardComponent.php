<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class DashboardComponent extends Component
{
    public $pageTitle = 'titre' ;

    public function render()
    { 
        $this->pageTitle = 'Dashboard de ' . config('app.name');

        return view('livewire.user.dashboard-component');
    }
}
