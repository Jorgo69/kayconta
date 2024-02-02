<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'chapter_id', 'content',
    ];


    // deux relations belongsTo pour indiquer qu'un commentaire appartient à un utilisateur et à un manga spécifiques.

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }

}
