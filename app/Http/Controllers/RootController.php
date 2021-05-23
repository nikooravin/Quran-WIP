<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Root;

class RootController extends Controller
{
    public function index()
    {
        ini_set('memory_limit', -1);
        set_time_limit(0);
        
        // Writer
        // $file = file_get_contents(public_path('../resources/root.json'));
        // $Array = explode("\n", $file);
        // foreach ($Array as $element) {
        //     DB::table('roots')->insert(
        //                 [
        //                     'json' => $element,
        //                     'word' => json_decode($element)->word
        //                 ]
        //             );
        // }
// --------------------
        $selectedroot = 1;
        $data = Root::find(1);
        $data = $data->json['place'];
        dd($data);
// ------------------------
        
        

        // dd($root_data);
        // foreach ($root_data as $item) {
        //     DB::table('roots')->insert(
        //         [
        //             'word' => $root_data->get($item)->pluck('word'),
        //             'json' => $root_data->get($item),
        //         ]
        //     );
        // }


        // Root::insert(['json' => $root_data]);
                // $root_data = collect([]);

    }
}
