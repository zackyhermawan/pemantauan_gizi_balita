<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prayer extends Model
{
    //
    protected $fillable = [
        'title',
        'category',
        'arabic_text',
        'latin_text',
        'translation',
        'fadhilah',
    ];
}
