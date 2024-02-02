<?php

namespace App\Http\Livewire\Admin;

use App\Models\DemandeAuteur;
use App\Models\User;
use Livewire\Component;

class AdminViewDemandeDetailComponent extends Component
{
    public $demandeId;
    public $userId;
    
    public function mount($id)
    {
        $this->demandeId = $id;
    }

    public function Valider()
    {
        $d = DemandeAuteur::find($this->demandeId);
        $ask = $d->user_id;
        $accept = User::where("id", $ask)->firstOrFail();
        $accept->update(["role" => "author"]);
        dd($accept);
    }

    public function render()
    {
        $demande = DemandeAuteur::where('id', $this->demandeId)->firstOrFail();

        return view('livewire.admin.admin-view-demande-detail-component', [
            'demande' => $demande,
        ]);
    }
}
