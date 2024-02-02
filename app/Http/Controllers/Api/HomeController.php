<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Manga;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = Chapter::with('manga')->orderBy('id', 'DESC')->take(1)->get();

        $mangas = Manga::with('chapters')->orderBy('id', 'DESC')->take(1)->get();

        $featureds = Manga::where('featured', 'on')->orderBy('updated_at', 'DESC')->take(1)->get();

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



        $pageTitle = 'Accueil ' .config('app.name') ;

        return response()->json([
            'status' => 200,
            'status_message' => 'Recuperation effectuer avec success',
            'pageTitle' => $pageTitle,
            'data' => [
                'chapiters' => $chapters,
                'mangas' => $mangas,
                'populars' => $populars,
                'featured' => $featureds,
                

                ]
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $chapter = Chapter::with(['manga' => function ($query) {
    //         $query->select('id', 'slug');
    //     }])
    //     ->select('id', 'manga_id', 'slug')
    //     ->orderBy('id', 'DESC')
    //     ->take(1)
    //     ->get();
        
    //     $manga = Manga::withCount('chapters')
    //     ->select('id', 'slug')
    //     ->orderBy('id', 'DESC');

    //     return response()->json([
    //         'status' => 200,
    //         'data' => [
    //             'chapitreSlug' => $chapter,
    //             'mangaSlug' => $manga,
    //         ]
    //     ]);
    // }

    public function show(string $slug)
{
    
    // $titre = $request->input('titre');
    // $id = $request->user()->id;
    // $date = Carbon\Carbon::now();

    // $slug = str_slug($titre . '-' . $id . '-' . $date, '-');
    // mon-premier-article-5-2021-05-25-14-30

    $manga = Manga::where('slug', $slug)->firstOrFail();

    if($manga){
        return response()->json([
            'status' => 200,
            'data' => $manga,
        ]);
    }else{
        return response()->json([
            'status' => 402,
        ]);
    }
}

public function slug(){
    $title = 'Le tout Premier Manga'; $id = 5; $date = '2021-05-25-14-30';

    // $slug = Str::slug(Carbon::now()->timestamp. '.' .$title. '.' .$id);
    // $slug = Str::slug(strval(Carbon::now()->timestamp) . '.' . $title . '.' . strval($id));
    // $slug = Str::slug((string) Carbon::now()->timestamp +(intval($id)) .'_' . $title . '_' );
    // $slug = Str::slug((strval(Carbon::now()->timestamp))  +(intval($id)) .'_' . $title . '_' );
    $slug = Str::limit(Str::slug((integer) Carbon::now()->timestamp +(intval($id)) .'_' . $title . '_' ), 200);

    return response()->json([
        'status' => 200,
        'data' => $slug,
    ], 200);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
