<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyQuote extends Model
{
    //
    protected $fillable = [
        'surah',
        'arabic_text',
        'translation',
        'nutrition_note',
    ];
}
