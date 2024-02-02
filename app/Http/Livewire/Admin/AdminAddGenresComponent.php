<?php

namespace App\Http\Livewire\Admin;

use App\Models\Genre;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminAddGenresComponent extends Component
{
    public $name;
    public $description;
    // public $slug;
    public $pageTitle;

    // public function SlugGenerate()
    // {
    //     $this->slug = Str::slug($this->name);
    // }

    public function update($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'description' => 'required',
        ]);
    }

    public function GenresAdd()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $genres = new Genre();
        $genres ->name = $this->name;
        $genres ->description = $this->description;

        $genres-> save();

        
        // Réinitialiser les variables après l'enregistrement
        $this->name = '';
        $this->description = '';

        session()->flash('success', 'Genre Cree avec Success');
        // return redirect()-> back();

    }

    public function render()
    {
        $this->pageTitle = 'Ajout Genres'.config('app.name');

        return view('livewire.admin.admin-add-genres-component');
    }
}
