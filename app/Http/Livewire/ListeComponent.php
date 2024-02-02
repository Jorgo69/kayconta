<?php

namespace App\Http\Livewire;

use App\Models\Chapter;
use App\Models\Comment;
use App\Models\View;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\Manga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListeComponent extends Component
{
    public $pageTitle = "Mes Recueilles";

    public $slug;
    public $chapter_id;
    public $manga_id;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function AddFavorite()
    {
        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $chapter = Chapter::with('manga')->where('slug', $this->slug)->firstOrFail();
        $favorite->manga_id = $chapter->manga_id ;
        // dd($favorite);
        $favorite->save();
    }

    public function RemoveFavorite()
    {
        $chapter = Chapter::with('manga')->where('slug', $this->slug)->firstOrFail();
        
        $favorite = Favorite::where('manga_id', $chapter->manga_id)->firstOrFail();
        
        $favorite->delete();
    }

    public function render()
    {
        $chapter = Chapter::with('manga', 'user')->where('slug', $this->slug)->firstOrFail();
        // dd($chapter);

        // les mangas du meme auteur sauf le  manga actuel
        $liers = Manga::where('user_id', $chapter->user_id)
                ->where('id', '!=', $chapter->manga_id) // Exclure le manga actuel
                ->get();


        $listes = Chapter::where('manga_id', $chapter->manga_id)->orderBy('id', 'DESC')->get();

        $nbrComments = Comment::where('manga_id', $chapter->manga_id)->count();

        $nbrViews = View::where('manga_id', $chapter->manga_id)->count();
        

        $genres = Genre::with('mangas')->orderBy('name', 'ASC')->get();

        

        $userId = Auth::id();
        $favorites = Favorite::where('user_id', $userId)->pluck('manga_id')->toArray();

        $populars = View::select('manga_id', DB::raw('count(*) as total_views'))
        ->groupBy('manga_id')
        ->orderByDesc('total_views')
        ->get();
        
        

        $this->pageTitle = 'Liste ' .$chapter->manga->title ;

        return view('livewire.liste-component',[
            'chapter' => $chapter,
            'liers' => $liers,
            'listes' => $listes,
            'genres' => $genres,
            'favorites' => $favorites,
            'nbrComments' => $nbrComments,
            'nbrViews' => $nbrViews,
            'populars' => $populars
        ]);
    }
}
