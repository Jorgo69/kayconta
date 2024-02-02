<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'user_id',
        'author_id',
    ];


    // relation "user" pour indiquer que chaque manga appartient à un utilisateur spécifique en utilisant
    // la méthode "belongsTo".
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'manga_genres');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // La relation "hasMany" entre les modèles "User" et "Manga" 
    // et le modèle "Favorite" permettront de lier les favoris de chaque utilisateur aux mangas correspondants.
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function featureds()
    {
        return $this->hasMany(Featured::class);
    }
    
}
