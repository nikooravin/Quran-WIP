<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Surah;
use App\Models\Ayah;
use App\Models\Translation;
use App\Models\Limit;
use App\Models\Root;
use Livewire\WithPagination;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;;


class Mycomponent extends Component
{
    use WithPagination;

    public $surahs;
    public $ayahs;
    public $selectedSurah;
    public $selectedAyah;
    public $selectedPage;
    public $ayah_count;
    protected $ar_verse;
    protected $fa_verse;
    protected $translation;
    public $selectedText;
    public $ayahStart;
    public $ayahEnd;
    protected $dividers;
    public $start;
    public $end;
    public $term;
    protected $result_fa = null;
    protected $result_ar = null;
    public $language;
    public $selectedroot;
    public $roots_word;
    public $roots_count;
    public $roots_id;
    public $roots_place;
    // public $root_data;
    public $rootayah_num = [];


    public function mount()
    {
        
        $this->surahs = Surah::all();
        $this->roots_word = Root::all();
        // dd($this->roots_word);
    }

    public function render()
    {
        return view('livewire.mycomponent', [
            'ar_verse' => $this->ar_verse,
            'fa_verse' => $this->fa_verse,
            'translation' => $this->translation,
            'dividers' => $this->dividers,
            'result_fa' => $this->result_fa,
            'result_ar' => $this->result_ar,
            // 'result' => Translation::where('translation', 'like',  "%$this->term%")
            //     ->paginate(8),
            'roots_result' => Ayah::wherein('id', $this->rootayah_num)->paginate()
        ]);
        
    }

    public function updatedselectedroot()
    {
        $row = Root::find($this->selectedroot+1)->json;
        foreach ($row['place'] as &$item) {
            $item['index'] = $item['index'] + 1;
        }
        $this->rootayah_num = Arr::pluck($row['place'], 'index');
        // dd( $this->rootayah_num);
    }

    public function updatedterm()
    {
        if ($this->language == "Farsi") {
            if (!is_null($this->term)) {
                $this->result_fa = Translation::where('translation', 'like',  "%$this->term%")
                    ->paginate();
            }
        }
        if ($this->language == "Arabic") {
            if (!is_null($this->term)) {
                $this->result_ar = Ayah::where('ayah_ar_content', 'like',  "%$this->term%")
                    ->paginate();
            }
        }
    }

    public function next()
    {
        $this->gotoPage($this->page + 1);
    }

    public function back()
    {
        $this->gotoPage($this->page - 1);
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->updatedselectedSurah($this->selectedSurah);
        $this->updatedterm();
    }

    public function cut($surah_id, $page)
    {
        if (!isset(Limit::where('surah_id', $surah_id)
            ->pluck('page_ayah')[$page - 1])) {
            $page = 1;
            $this->setPage(1);
        }

        $this->start = Limit::where('surah_id', $surah_id)
            ->pluck('page_ayah')[$page - 1];

        $this->end = Limit::where('surah_id', $surah_id)
            ->pluck('page_ayah_end')[$page - 1];

        $this->dividers = $this->end - $this->start + 1;
    }


    public function showAyahs($surah_id)
    {
        $this->ar_verse = Ayah::where('surah_id', $surah_id)
            ->whereBetween('ayah_num', [$this->start, $this->end])
            ->get()->toArray();

        $this->fa_verse = Translation::where('surah_id', $surah_id)
            ->whereBetween('trans_ayah_num', [$this->start, $this->end])
            ->get()->toArray();
    }

    public function updatedselectedSurah($surah_id)
    {
        if ($this->selectedSurah == 0) {
            return
                [$this->selectedAyah = 0,];
        }

        // $this->updatedselectedAyah($this->selectedSurah);

        $this->cut($surah_id, $this->page);

        $this->ayah_count = Surah::where('id', $surah_id)->get('ayah_count')
            ->pluck('ayah_count')[0];

        if (is_null($this->selectedAyah) or ($this->selectedAyah == 0)) {
            $this->showAyahs($surah_id, 1, $this->ayah_count); //کل سوره
        } else {
            $this->showAyahs($surah_id, $this->selectedAyah, $this->selectedAyah);
        };
    }

    public function updatedselectedAyah()
    {
        if ($this->selectedAyah == 0) {
            $this->updatedselectedSurah($this->selectedSurah);
        } else {
            $this->start = $this->end = $this->selectedAyah;
            $this->showAyahs($this->selectedSurah);
            // $this->updatedselectedAyah($this->selectedSurah);
        }
    }
}



// -------------
        // $this->ar_verse = array_slice($this->ar_verse, $this->start-1, $this->dividers, true);
    // dd($this->page, $this->start, $this->end, $this->dividers, $this->ar_verse);

    // $fixed_jsonArray = array_map('trim', $jsonArray);
        // dd($fixed_jsonArray);


         // $this->rootayah_num = Arr::flatten($this->rootayah_num, 1);
        // dd($data);
        // $this->rootayah_num = Root::select('json')->get('place');
        // $this->rootayah_num = array_map(function ($val) {
        //     return $val + 1;
        // }, $this->rootayah_num);

        // ========================
        // $this->rootayah_num = Arr::pluck($this->roots_place[$this->selectedroot], 'index');
        // $this->rootayah_num = Arr::flatten($this->rootayah_num, 1);
        // $this->rootayah_num = array_map(function ($val) {
        //     return $val + 1;
        // }, $this->rootayah_num);
        //increases root ayah numbers by one


        // $file = file_get_contents(public_path('../resources/root.json'));
        // $Array = explode("\n", $file);
        // $root_data = collect([]);
        // foreach ($Array as $element) {
        //     $root_data->push(json_decode($element));
        // }

        