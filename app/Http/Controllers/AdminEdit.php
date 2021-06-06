<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surah;
use App\Models\Translation;

class AdminEdit extends Controller
{
   public function index($item){
    // dd($item);
       return view('translation.admin-edit',
       [
           'Translations' => Translation::select('*')
           ->where('surah_id', '!=', 0)
           ->where('surah_id', $item)
           ->where('trans_ayah_num', '!=', 0)
           ->paginate(35),

       ]);

   }
}
