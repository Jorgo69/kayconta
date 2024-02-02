<?php

namespace App\Http\Livewire\Admin;

use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;

class AdminGenresComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pageTitle;
    public $genre_id;

    public $pageSize = 12;

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }


    public function deleteGenre()
    {
        $genre = Genre::find($this->genre_id);
        $genre ->delete();
        session()->flash('danger', 'Genre Supprime avec Success');
    }

    public function render()
    {
        $genres = Genre::paginate($this->pageSize);

        $this->pageTitle = 'Genres'.config('app.name');
        
        return view('livewire.admin.admin-genres-component',[
            'genres' => $genres,
        ]);
    }
}
