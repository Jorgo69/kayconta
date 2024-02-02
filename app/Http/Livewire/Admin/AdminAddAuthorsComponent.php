<?php

namespace App\Http\Livewire\Admin;

use App\Models\Author;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminAddAuthorsComponent extends Component
{
    public $nom;
    public $pseudo;
    public $slug;
    public $numero;
    public $email;
    public $localisation;
    public $pageTitle = 'Ajout d\'auteur';

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
            'email' => 'required',
            'numero' => 'required',
            'localisation' => 'required'
        ]);
    }

    public function AuthorsAdd()
    {
        $this->validate([
            'nom' => 'required',
            'pseudo' => 'required',
            'slug' => 'required',
            'email' => 'required',
            'numero' => 'required',
            'localisation' => 'required'
        ]);

        $authors = new Author();
        $authors->nom_complet = $this->nom;
        $authors->pseudo = $this->pseudo;
        $authors->slug = $this->slug;
        $authors->numero = $this->numero;
        $authors->email = $this->email;
        $authors->localisation = $this->localisation;

        $authors->save();

        session()->flash('success', 'Auteur ajouter avec success');

        $this->nom = '';
        $this->pseudo = '';
        $this->slug = '';
        $this->numero = '';
        $this->email = '';
        $this->localisation = '';

    }

    public function render()
    {
        $this->pageTitle = 'Ajout d\'un auteur'.config('app.name');
        
        return view('livewire.admin.admin-add-authors-component');
    }
}
