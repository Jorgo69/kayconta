<?php

namespace App\Http\Livewire\Author;

use App\Models\Chapter;
use App\Models\Manga;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AuthorEditChapterComponent extends Component
{
    use WithFileUploads;
    
    public $chapters_id;

    public $user_id;
    public $new_contents =[], $newContentImages = [];
    public $new_chapter_cover;

    public $manga_id;
    public $chapter_number, $slug;
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

    // public function generate()
    // {
    //     $this->chapterSlug = Str::slug($this->chapter_number);
    // }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'manga_id' => 'required',
            'chapter_number' => 'required',
            'title' => 'required',
            'content' => 'required',
            'chapter_cover' => 'required',
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
                
                // foreach (json_decode($chapters->content) as $oldImage) {
                //     $oldImagePath = public_path('kayconta-app/public/assets/imgs/chapters/' . $oldImage);
                    
                //     if (file_exists($oldImagePath)) {
                //         unlink($oldImagePath);
                //     }
                // }
                
                
                $imageName = Carbon::now()->timestamp . $key . '.' . $this->new_contents[$key]->extension();
                $this->new_contents[$key]->storeAs('chapters', $imageName);
                $this->newContentImages[] = $imageName; // Ajoutez le nom de fichier au tableau
            }

            $chapters->content = json_encode($this->newContentImages);
        }
        
        if($this->new_chapter_cover)
        {
            
            $oldImagePath = public_path('assets/imgs/chapters/covers/' . $chapters->chapter_cover);

            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            
            $imageCover = Carbon::now()->timestamp. '.' .$this->new_chapter_cover->extension();
            $this->new_chapter_cover->storeAs('chapters/covers', $imageCover);
            $chapters->chapter_cover = $imageCover;
        }
        
        // dd($chapters);
        $chapters-> save();

        return redirect()->route('author.dashboard')->with('success', 'Chapitre Modifier avec Success');
    }

    
    public function render()
    {
        $mangas = Manga::orderBy('title', 'ASC')->get();
        $chapters = Chapter::with('user', 'genre')->get();

        $this->pageTitle = 'Modification du Chapitre'.config('app.name');
        
        return view('livewire.author.author-edit-chapter-component', [
            'mangas' => $mangas,
            'chapters' => $chapters,
        ]);
    }
}
