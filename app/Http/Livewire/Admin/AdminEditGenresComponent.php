<?php

namespace App\Http\Livewire\Admin;

use App\Models\Genre;
use Illuminate\Support\Str;
use Livewire\Component;

class AdminEditGenresComponent extends Component
{
    public $genre_id;
    public $name;
    public $description;
    public $pageTitle;

    public function mount($genre_id)
    {
        $genres = Genre::find($genre_id);
        $this->name = $genres ->name  ;
        $this->description = $genres ->description  ;
    }


    public function EditGenre()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $genre = Genre::find($this->genre_id);
        $genre ->name = $this->name;
        $genre ->description = $this->description;

        $genre->save();

        return redirect()->route('admin.genres')->with('success', 'Modification apporté avec Success');


    }
    public function render()
    {
        $this->pageTitle = 'Modifer Genre'.config('app.name');
        
        return view('livewire.admin.admin-edit-genres-component');
    }
}
