<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactChannel extends Model
{
    protected $fillable = [
        'group','type','label','value','url','sort_order','is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
