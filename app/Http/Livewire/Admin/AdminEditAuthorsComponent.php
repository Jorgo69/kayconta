<?php

namespace App\Http\Livewire\Admin;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AdminEditAuthorsComponent extends Component
{
    use WithFileUploads;
    public $authors_id;

    public $nom;
    public $pseudo;
    public $slug;
    public $numero;
    public $email;
    public $localisation;

    public $pageTitle;



    public function mount($authors_id)
    {
        $authors = Author::find($authors_id);
        $this->authors_id = $authors->id;
        $this->nom = $authors->nom_complet;
        $this->pseudo = $authors->pseudo;
        $this->slug = $authors->slug;
        $this->numero = $authors->numero;
        $this->email = $authors->email;
        $this->localisation = $authors->localisation;
    }

    public function SlugGenerate()
    {
        $this->slug = Str::slug($this->pseudo);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'nom' => 'required',
            'pseudo' => 'required',
            'slug' => 'required',
            'numero' => 'required',
            'email' => 'required',
            'localisation' => 'required',
        ]);
    }

    public function AuthorsEdit()
    {
        $this->validate([
            'nom' => 'required',
            'pseudo' => 'required',
            'slug' => 'required',
            'numero' => 'required',
            'email' => 'required',
            'localisation' => 'required',
        ]);

        $authors = Author::find($this->authors_id);
        $authors -> nom_complet = $this->nom;
        $authors -> pseudo = $this->pseudo;
        $authors -> slug = $this->slug;
        $authors -> numero = $this->numero;
        $authors -> email = $this->email;
        $authors -> localisation = $this->localisation;

        $authors-> save();

        session()->flash('success', 'Modification apporte avec success');

        $this->nom = '';
        $this->pseudo = '';
        $this->slug = '';
        $this->numero = '';
        $this->email = '';
        $this->localisation = '';


        return redirect()->route('admin.authors');

    }

    public function render()
    {
        $this->pageTitle = 'Modifier '.config('app.name');

        return view('livewire.admin.admin-edit-authors-component');
    }
}
