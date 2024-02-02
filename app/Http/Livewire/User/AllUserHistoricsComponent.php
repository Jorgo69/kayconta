<?php

namespace App\Http\Livewire\User;

use App\Models\Comment;
use Livewire\Component;

class AllUserHistoricsComponent extends Component
{
    public function deleteHComment($commentId)
    {
        $comment = Comment::find($commentId);
        // dd($comment);
    
        if ($comment) {
            $comment->delete();
            session()->flash('danger', 'Commentaire supprimer avec success');
        }
    }

    public function render()
    {
        $historics = Comment::where("user_id", auth()->user()->id)->get();
        
        return view('livewire.user.all-user-historics-component', [
            'historics' => $historics,
        ]);
    }
}
