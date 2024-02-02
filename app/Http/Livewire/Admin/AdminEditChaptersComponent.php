<?php

namespace App\Http\Livewire\Admin;

use App\Models\Chapter;
use App\Models\Manga;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminEditChaptersComponent extends Component
{
    use WithFileUploads;
    
    public $chapters_id;

    public $user_id;
    public $new_contents =[], $newContentImages = [];
    public $new_chapter_cover;

    public $manga_id, $slug, $selectLangue;
    public $chapter_number;
    public $title;
    public $content = [];
    public $chapter_cover;
    public $pageTitle;


    public function mount($chapters_id)
    {
        $chapter = Chapter::with('user')->find($chapters_id);
        $this->chapters_id = $chapter->id;
        $this->manga_id = $chapter->manga_id;
        $this->title = $chapter->title;
        $this->content = $chapter->content;
        $this->chapter_cover = $chapter->chapter_cover;
        $this->chapter_number = $chapter->chapter_number;
        $this->slug = $chapter->slug;

        // Pré-remplir les informations de l'auteur et du genre associés au chapitre
        $this->user_id = $chapter->user->id;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'manga_id' => 'required',
            'chapter_number' => 'required',
            'title' => 'required',
            'content' => 'required',
            'chapter_cover' => 'required',
            'slug' => 'required',
            'selectLangue' => '',
        ]);
    }

    public function ChaptersEdit()
    {
        $this->validate([
            'manga_id' => 'required',
            'chapter_number' => 'required',
            'title' => 'required',
            'content' => 'required',
            'chapter_cover' => 'required',
            'slug' => 'required',
            'selectLangue' => '',
        ]);

        // Pour l'enreigitrement des images en local
        // se rendre dans config/filesystems
        // 'disks' => [
            // 'local' => [
            // 'root' => public_path('assets/imgs'),
            
        $chapters =Chapter::find($this->chapters_id);
        $chapters->manga_id = $this->manga_id;
        $chapters->chapter_number = $this->chapter_number;
        $chapters->title = $this->title;
        $chapters->langue_id = $this->selectLangue;

        $chapters->slug = $this->slug;

        if($this->new_contents)
        {
            // foreach($this->new_contents as $key => $new_content)
            // {
            //     unlink('assets/imgs/chapters/'.$chapters->content);
            //     $imageName = Carbon::now()->timestamp .$key .'.' .$this->new_content->extension();
            //     $this->new_content->storeAs('chapters', $imageName);
            //     $chapters->content = $imageName;

            // }

            foreach ($this->new_contents as $key => $content) {
                // unlink('assets/imgs/chapters/'.$chapters->content);
                $imageName = Carbon::now()->timestamp . $key . '.' . $this->new_contents[$key]->extension();
                $this->new_contents[$key]->storeAs('chapters', $imageName);
                $this->newContentImages[] = $imageName; // Ajoutez le nom de fichier au tableau
            }

            $chapters->content = json_encode($this->newContentImages);
        }
        
        if($this->new_chapter_cover)
        {
            $imageCover = Carbon::now()->timestamp. '.' .$this->new_chapter_cover->extension();
            $this->new_chapter_cover->storeAs('chapters/covers', $imageCover);
            $chapters->chapter_cover = $imageCover;
        }
        
        // dd($chapters);
        $chapters-> save();
        
        return redirect()->route('admin.chapters')->with('success', 'Chapitre Modifier avec Success');
    }


    public function render()
    {
        $mangas = Manga::orderBy('title', 'ASC')->get();
        $chapters = Chapter::with('user', 'genre')->get();

        $this->pageTitle = 'Modification du Chapitre'.config('app.name');
        
        return view('livewire.admin.admin-edit-chapters-component', [
            'mangas' => $mangas,
            'chapters' => $chapters,
        ]);
    }
}
