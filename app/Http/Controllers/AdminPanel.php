<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surah;

class AdminPanel extends Controller
{
    public function index(){

        return view('translation.admin-panel', [
            'Surahs'=>Surah::paginate(35),
        ]); 
    }
}
