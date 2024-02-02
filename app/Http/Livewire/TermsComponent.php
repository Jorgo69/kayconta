<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TermsComponent extends Component
{
    public $title = "Termes & Condition";

    public function render()
    {
        return view('livewire.terms-component');
    }
}
