<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];


    // relation "mangas" pour indiquer que chaque genre peut appartenir à plusieurs mangas en utilisant la méthode belongsToMany.
    // Cette relation est réalisée à travers la table pivot "manga_genres" qui est implicite grâce à la convention de nommage.
    public function mangas()
    {
        return $this->belongsToMany(Manga::class, 'manga_genres');
    }

    public function chapter()
    {
        return $this->hasMany(Chapter::class);
    }
}
