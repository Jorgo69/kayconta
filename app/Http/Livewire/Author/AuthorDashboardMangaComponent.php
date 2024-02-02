<?php

namespace App\Http\Livewire\Author;

use App\Models\Manga;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AuthorDashboardMangaComponent extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $mangas_id;
    public $pageTitle;

    // public $perPage = 10;
    



    public function deleteManga()
    {
        $manga = Manga::find($this->mangas_id);
        $manga->delete();
        session()->flash('danger', 'Manga supprimer avec success');
    }
    
    public function render()
    {
        $manga = Manga::where('user_id', Auth::id())->get();

        return view('livewire.author.author-dashboard-manga-component',[
            'manga' => $manga,
        ]);
    }
}
