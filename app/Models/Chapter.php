<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'manga_id', 'chapter_number', 'title', 'content',
    ];


    // relation "manga" pour indiquer que chaque chapitre appartient à un manga spécifique en utilisant
    // la méthode belongsTo.
    public function manga()
    {
        return $this->belongsTo(Manga::class, 'manga_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function chapiterlangue()
    {
        return $this->belongsTo(ChapitreLangue::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
