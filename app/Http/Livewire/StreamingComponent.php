<?php

namespace App\Http\Livewire;

use App\Models\Chapter;
use App\Models\Comment;
use App\Models\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StreamingComponent extends Component
{
    public $pageTitle = "Mes Recueilles";

    public $chapter_id, $user_id, $manga_id, $content ;

    public $currentImageIndex = 0;
    public $images;
    


    public function mount($chapter_id)
    {
        $this->chapter_id = $chapter_id;
        
         // Charger les images depuis la base de données
         $content = Chapter::find($chapter_id);

         $contenu= $content -> content;
        //  dd($cont);

         $this->images = json_decode($contenu);

         $this->emit('action-timer-started', 3000); // Émet un événement après 3000 ms (3 secondes)

         $this->stream();

        // dd($images);
    }
    public function update($fields)
    {
        $this->validateOnly($fields, [
            'content' => 'required|min:1'
        ]);
    }

    public function AddComment()
    {
        $this->validate([
            'content' => 'required|min:2'
        ]);


        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->chapter_id = $this->chapter_id;
        $comment->manga_id = $this->manga_id;
        $comment->content = $this->content;
        $comment ->save();

        return redirect()->route('chapter.comment', ['chapter_id' => $this->chapter_id]);

    }

    public function stream()
    {
        
        $user = auth()->user();
        $chapter = Chapter::find($this->chapter_id);
        // dd($chapter);


        if(isset($user)){
            // // Vérifiez si l'utilisateur a déjà lu ce chapitre
        if (!$user->views()->where('chapter_id', $chapter->id)->exists()) {
            // Enregistrez la vue si il n'a pas encore regarde
                $view = new View();
                $view->user_id = $user->id;
                $view->chapter_id = $chapter->id;
                $view->manga_id = $chapter->manga_id; // Ajoutez cela si nécessaire
                // dd($view);
                $view->save();
        }
        }
        

    }

    public function render()
    {

        
        $chapter = Chapter::with('manga')->where('id', $this->chapter_id)->firstOrFail();

        $this->manga_id = $chapter->manga->id;

        $this->pageTitle = 'Lecture - ' .$chapter->title;
        
        return view('livewire.streaming-component',[
            'chapter' => $chapter,
        ]);
    }

    public function previousImage()
    {
        $this->currentImageIndex = max(0, $this->currentImageIndex - 1);
    }

    public function nextImage()
    {
        $this->currentImageIndex = min(count($this->images) - 1, $this->currentImageIndex + 1);
    }

    // protected $listeners = ['action-timer-started' => 'enregistrerAction'];
}
