<?php

namespace App\Http\Livewire;

use App\Models\Chapter;
use App\Models\Comment;
use App\Models\View;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\Manga;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListeMangaComponent extends Component
{
    public $slug;
    public $pageTitle = 'Manga';

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function AddFavorite()
    {
        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $manga = Manga::with('chapters')->where('slug', $this->slug)->firstOrFail();
        $favorite->manga_id = $manga->id;
        $favorite->save();
    }

    public function RemoveFavorite()
    {
        $manga = Manga::with('chapters')->where('slug', $this->slug)->firstOrFail();
        
        $favorite = Favorite::where('manga_id', $manga->id)->firstOrFail(); 
        
        $favorite->delete();
    }

    
    public function render()
    {
        $manga = Manga::with('chapters', 'user')->where('slug', $this->slug)->firstOrFail();

            // les mangas du meme auteur sauf le  manga actuel
        $liers = Manga::where('user_id', $manga->user_id)
        ->where('id', '!=', $manga->id) // Exclure le manga actuel
        ->get();

        $genres = Genre::with('mangas')->orderBy('name', 'ASC')->get();

        
        $listes = Chapter::with('manga')->where('manga_id', $manga->id)->orderBy('id', 'DESC')->get();

        $nbrComments = Comment::where('manga_id', $manga->id)->count();

        $nbrViews = View::where('manga_id', $manga->id)->count();
        
        $userId = Auth::id();
        $favorites = Favorite::where('user_id', $userId)->pluck('manga_id')->toArray();

        $this->pageTitle = $manga->title;
        
        return view('livewire.liste-manga-component', [
            'manga' => $manga,
            'liers' => $liers,
            'genres' => $genres,
            'listes' => $listes,
            'favorites' => $favorites,
            'nbrComments' => $nbrComments,
            'nbrViews' => $nbrViews,
        ]);
    }
}
