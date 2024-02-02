<?php

namespace App\Http\Livewire;

use App\Models\Chapter;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentsComponent extends Component
{
    public $pageTitle = "Mes Recueilles";

    public $chapter_id, $user_id, $content, $manga_id, $dispatchBrowserEvent ;

    public function mount($chapter_id)
    {
        $this->chapter_id = $chapter_id;
    }


    public function update($fields)
    {
        $this->validateOnly($fields,[
            'content' => 'required',
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

        session()->flash('success', 'Commentaire ajouter avec Success');

        $this->content = '';
        $this->dispatchBrowserEvent('refresh-page');

        
        // $comment->refresh();

        // dd($comment);
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
    
        if ($comment) {
            $comment->delete();
            session()->flash('danger', 'Commentaire supprimer avec success');
        }
    }


    public function render()
    {
        $chapter = Chapter::with('manga')->where('id', $this->chapter_id)->firstOrFail();
        
        $this->manga_id = $chapter->manga->id;
        
        $comments = Comment::with('user')->where('chapter_id', $chapter->id)->get();

        // $this->pageTitle = 'Chapitre - ' . $chapter->title;
        $this->pageTitle = 'Commentaire ' .$chapter->title  .config('app.name') ;

        return view('livewire.comments-component',[
            'chapter' => $chapter,
            'comments' => $comments,
        ]);
    }
}
