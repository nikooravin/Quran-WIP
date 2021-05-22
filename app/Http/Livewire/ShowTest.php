<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Translation;
use Livewire\WithPagination;

class ShowTest extends Component
{
    use WithPagination;

    public $term;
    protected $data;
    
    public function render()
    {return view('livewire.show-test', ['data' => $this->data]);}

    public function setPage($page)
    {
        $this->page = $page;
        $this->updatedTerm();
    }
    
    public function updatedTerm(){
        $this->data = Translation::where('translation', 'like', '%'.$this->term.'%')
        ->paginate(5);
    }
}

