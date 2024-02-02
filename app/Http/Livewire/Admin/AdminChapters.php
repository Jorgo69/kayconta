<?php

namespace App\Http\Livewire\Admin;

use App\Models\Chapter;
use Livewire\Component;
use Livewire\WithPagination;

class AdminChapters extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pageTitle;

    public $chapters_id;

    public $pageSize = 12;

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }


    public function deleteChapter()
    {
        $chapter = Chapter::find($this->chapters_id);
        $chapter->delete();
        session()->flash('danger', 'Chapitre supprimé avec success');
    }

    public function render()
    {
        $chapters = Chapter::with('manga', 'genre')->paginate($this->pageSize);

        $this->pageTitle = 'Les Chapitres'.config('app.name');
        
        return view('livewire.admin.admin-chapters',[
            'chapters' => $chapters,
        ]);
    }
}
