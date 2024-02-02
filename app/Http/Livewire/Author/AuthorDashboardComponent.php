<?php

namespace App\Http\Livewire\Author;

use App\Models\Manga;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AuthorDashboardComponent extends Component
{
    public function render()
    {
        return view('livewire.author.author-dashboard-component');
    }
}
