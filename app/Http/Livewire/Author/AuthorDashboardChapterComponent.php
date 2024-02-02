<?php

namespace App\Http\Livewire\Author;

use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AuthorDashboardChapterComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pageTitle, $chapter_number, $chapters_id;

    public $perPage = 10;

    

    public function deleteChapter()
    {
        $chapter = Chapter::find($this->chapters_id);
        $chapter->delete();
        session()->flash('danger', 'Chapitre supprimé avec success');
    }
    
    public function render()
    {
        $chapters = Chapter::where('user_id', Auth::id())->with('manga', 'genre')->paginate($this->perPage);

        $this->pageTitle = 'Les Chapitres'.config('app.name');

        return view('livewire.author.author-dashboard-chapter-component', [
            'chapters' => $chapters,
        ]);
    }
}
