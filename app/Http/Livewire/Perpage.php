<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Surah;
use App\Models\Ayah;
use App\Models\Translation;
use App\Models\Page;
use Illuminate\Support\Facades\DB;



class Perpage extends Component
{

    public $surahs;
    public $ayahs;
    public $data1;

    public function showSurahData()
    {
        $this->surahs = Page::all()->where('surah_id', 2);
        $this->ayahs = ayah::all()->where('surah_id', 2);
    }

    public function breakPoint()
    {
        $this->data1 = Page::all()->where('surah_id', 2);
    }

    public function render()
    {
        $this->breakPoint();
        $this->showSurahData();
        return view('livewire.perpage');
    }
}
