<?php

namespace App\Http\Livewire;

use App\Models\Chapter;
use App\Models\Genre;
use App\Models\Manga;
use App\Models\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomeComponent extends Component
{
    public $pageTitle;


    
    public function render()
    {
        
        $chapters = Chapter::with('manga')->orderBy('id', 'DESC')->take(3)->get();
 
        $mangas = Manga::with('chapters')->orderBy('id', 'DESC')->take(4)->get();
        
        $featureds = Manga::where('featured', 'on')->orderBy('updated_at', 'DESC')->take(6)->get();

        // Récupérer toutes les entrées triées par le nombre décroissant de 'manga_id'
        $populars = View::select('manga_id', DB::raw('count(*) as total_views'))
        ->groupBy('manga_id')
        ->orderByDesc('total_views')
        ->get();

        // Maintenant, vous pouvez parcourir les résultats
        foreach ($populars as $popular) {
            
        $mangaId = $popular->manga_id;
        $totalViews = $popular->total_views;
        // Affichons-les ou stockez-les dans un tableau
        // dd($totalViews);
        // echo "Manga ID: $mangaId, Total Views: $totalViews <br>";
        }

        $genres = Genre::orderBy('name', 'ASC')->get();

        // $mangas = Manga::orderBy('title', 'ASC')->get();

        $this->pageTitle = 'Accueil ' .config('app.name') ;
        
        return view('livewire.home-component',
        [
            'chapters' => $chapters,
            'mangas' => $mangas,
            'featureds' => $featureds,
            'populars' => $populars,
            'genres' => $genres,
        ]
    );
    }
}
