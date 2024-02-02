<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    use HasFactory;

    protected $fillable = [
        'manga_id', 'description', 'start_date', 'end_date',
    ];

    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }
}
