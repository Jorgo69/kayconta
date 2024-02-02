<?php

namespace App\Http\Livewire\Admin;

use App\Models\Chapter;
use App\Models\Manga;
use Livewire\Component;
use Livewire\WithPagination;

class AdminMangasComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $mangas_id;
    public $pageTitle;

    public $pageSize = 12;

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }

    public function latestChapter()
{
    return $this->hasOne(Chapter::class)->latest();
}


    public function deleteManga()
    {
        $manga = Manga::find($this->mangas_id);
        $manga->delete();
        session()->flash('danger', 'Manga supprimer avec success');
    }


    public function render()
    {
        $mangas = Manga::with('user')->paginate($this->pageSize);
        
        $this->pageTitle = 'Mangas'.config('app.name');
        
        return view('livewire.admin.admin-mangas-component',[
            'mangas' => $mangas,
        ]);
    }
}
