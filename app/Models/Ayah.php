<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayah extends Model
{
    protected $guarded = [
        'id',
    ];

    public function Surah(){
        return $this->belongsTo(Surah::class);
    }
    use HasFactory;
}
