<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Root;

class RootController extends Controller
{
    public function index()
    {
        $file = file_get_contents(public_path('../resources/root.json'));
        $Array = explode("\n", $file);
        $root_data = collect([]);
        foreach ($Array as $element) {
            $root_data->push(json_decode($element));
        }
        // dd($root_data);
        // foreach ($root_data as $item) {
        //     DB::table('roots')->insert(
        //         [
        //             'word' => $root_data->get($item)->pluck('word'),
        //             'json' => $root_data->get($item),
        //         ]
        //     );
        // }


        Root::insert(['json' => $root_data]);
                // $root_data = collect([]);

    }
}
