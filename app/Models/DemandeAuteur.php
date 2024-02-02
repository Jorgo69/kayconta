<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeAuteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'objet',
        'about',
        'contrat',
        'planches',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

        // Dans le modèle Demande
        public function notifications()
        {
            return $this->hasMany(Notification::class);
        }
}
