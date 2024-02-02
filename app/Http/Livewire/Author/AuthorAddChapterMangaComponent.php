<?php

namespace App\Http\Livewire\Author;

use App\Models\Chapter;
use App\Models\Manga;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AuthorAddChapterMangaComponent extends Component
{
    use WithFileUploads;
    
    public $manga_id;
    public $chapter_number , $chapterSlug;
    public $slug;
    public $chapter_cover;
    public $title;
    public $contents = [], $contentImages = [];
    public $user_id;
    public $pageTitle;

    public function mount($id)
    {
        $chapter = Chapter::find($id);
        if (!$chapter) {
            abort(404); // Gérez le cas où le manga n'est pas trouvé
        }
        
        
        $this->manga_id = $chapter->id;
        $this->chapter_number  = $this->chapterNumber();
        $this->chapterSlug = $this->chapterNumber();

    }

    public function chapterNumber()
    {
        $number = Chapter::where('manga_id', $this->manga_id)
        ->orderBy('chapter_number', 'DESC')
        ->first();

        
         // Si aucun chapitre n'existe encore pour ce manga, retournez 1
        if (!$number) {
            return sprintf("%03d", 1);
        }

        // Incrémente le numéro du dernier chapitre

        $nb = intval($number->chapter_number );
        $nextChapterNumber = sprintf("%03d", $nb + 1);

        return $nextChapterNumber;

    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function generate()
    {
        $this->chapterSlug = Str::slug($this->chapter_number);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'manga_id' => 'required',
            'chapter_number' => 'required',
            'slug'=> 'required',
            'title' => 'required',
            'chapter_cover' => 'required',
            'contents' => 'required',
        ]);
    }

    public function ChaptersAdd()
    {
        
        $this->validate([
            'manga_id' => 'required',
            'chapter_number' => 'required',
            'slug'=> 'required',
            'title' => 'required',
            'chapter_cover' => 'required',
            'contents' => 'required',
        ]);

        // Pour l'enreigitrement des images en local
        // se rendre dans config/filesystems
        // 'disks' => [
            // 'local' => [
            // 'root' => public_path('assets/imgs'),
            
        $chapters = new Chapter();
        $chapters->manga_id = $this->manga_id;
        $chapters->chapter_number = $this->chapter_number;
        $chapters->title = $this->title;
        
        $imageCover = Carbon::now()->timestamp. '.' .$this->chapter_cover->extension();
        $this->chapter_cover->storeAs('chapters/covers', $imageCover);
        $chapters->chapter_cover= $imageCover;

        $chapters->slug = $this->slug. '_' .$this->chapterSlug;
        
        $manga = Manga::find($this->manga_id);
        $chapters->user_id = $manga->user_id;
        // $chapters->genre_id = $manga->genre_id;

        foreach ($this->contents as $key => $content) {
            $imageName = Carbon::now()->timestamp . $key . '.' . $this->contents[$key]->extension();
            $this->contents[$key]->storeAs('chapters', $imageName);
            $this->contentImages[] = $imageName; // Ajoutez le nom de fichier au tableau
        }
        
        $chapters->content = json_encode($this->contentImages); // Stockez le tableau dans la base de données (en tant que JSON)
        

    

        $chapters-> save();

        session()->flash('success', 'Chapitre Creer avec Success');

        $this->manga_id = '';
        $this->contents = '';
        $this->chapter_number = '';
        $this->chapter_cover = '';
        $this->title = '';
        
    }
    
    public function render()
    {
        $userId = Auth::id();
        
        $mangas = Manga::where('user_id', $userId)->orderBy('title', 'ASC')->get();

        $this->pageTitle = "Ajout de Chapitre".config('app.name');
        
        return view('livewire.author.author-add-chapter-manga-component', [
            'mangas' => $mangas,
        ]);
    }
}
