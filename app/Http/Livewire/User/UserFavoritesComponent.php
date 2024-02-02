<?php

namespace App\Http\Livewire\User;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserFavoritesComponent extends Component
{
    // public $userId;

    public function render()
    {
        $userId = Auth::id();
        $favorites = Favorite::with('manga')->where('user_id', $userId)->get();
        // dd($favorites);

        return view('livewire.user.user-favorites-component', [
            'favorites' => $favorites,
        ]);
    }
}
