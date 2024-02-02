<?php

namespace App\Http\Livewire\Admin;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAuthor extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pageTitle = 'Auteur';

    public $authors_id;

    public function deleteAuthor()
    {
        $authors = Author::find($this->authors_id);
        $authors->delete();
        session()->flash('danger', 'Autheur supprime avec success');
    }

    public function render()
    {
        $authors = Author::with('mangas')->paginate(6);

        $this->pageTitle = 'Auteur' .config('app.name');
        
        return view('livewire.admin.admin-author',[
            'authors' => $authors,
        ]);
    }
}
