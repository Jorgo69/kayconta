<?php

namespace App\Http\Livewire\Admin;

use App\Models\DemandeAuteur;
use Livewire\Component;

class AdminViewDemandeComponent extends Component
{
    public function render()
    {
        $demandes = DemandeAuteur::with('user')->where('lu', false)->get();

        return view('livewire.admin.admin-view-demande-component', [
            'demandes' => $demandes,
        ]);
    }
}
