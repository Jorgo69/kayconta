<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AboutComponent extends Component
{
    public $title = "A propos";
    
    public function render()
    {
        $this->title = 'A propos' .config('app.name');

        return view('livewire.about-component');
    }
}
