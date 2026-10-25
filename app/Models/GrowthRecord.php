<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrowthRecord extends Model
{
    protected $fillable = [
        'child_id',
        'record_date',
        'weight',
        'height',
        'nutritional_status',
        'admin_notes',
        'admin_id',
    ];

    public function child()
    {
        return $this->belongsTo(Children::class);
    }
    
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id'); 
    }

    public function monitoring()
    {
        return $this->hasOne(Monitoring::class, 'growth_record_id');
    }
}