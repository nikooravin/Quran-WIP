<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Root extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'json' => 'array',
        'place' => 'array'
    ];
}
