<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ayah_count',
    ];

    public function ayahs()
    {
        return $this->hasMany(Ayah::class);
    }
}
