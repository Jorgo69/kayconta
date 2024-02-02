<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeNotification extends Model
{
    use HasFactory;


    public function demandeAuteurs()
    {
        return $this->belongsTo(Demande::class);
    }

}
