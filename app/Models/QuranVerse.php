<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuranVerse extends Model
{
    //
    protected $fillable = [
        'status_gizi',
        'surah',
        'arabic_text',
        'translation',
        'meaning',
    ];
}
