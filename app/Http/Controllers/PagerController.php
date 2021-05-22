<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qurantext;
use Illuminate\Support\Facades\DB;
use App\Models\Metadata;

class PagerController extends Controller
{

    public function index()
    {

        $xmlString = file_get_contents(public_path('../resources/page_pagination.xml'));
        $xmlObject = simplexml_load_string($xmlString);
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);

        // dd($phpArray);

        // function array_push_assoc($array, $key, $value)
        // {
        //     $array[$key] = $value;
        //     return $array;
        // }

        // $data = array();

        $index = 1;
        $l1 = ($phpArray['page']);

        foreach ($l1 as $opener) {
            foreach ($opener as $item) {
               
                DB::table('pages')->insert(
                    ['id' => $index, 'surah' => $item['sura'], 'page_ayah' => $item['aya']]
                );
                $index++;
            }
            // $data = array_push_assoc($data, $item['name'], $item['ayas']);
            // }
        }

        // dd($data);


        // $surah = 40;
        // $ayah = 17;

        // $data_ar = DB::table('Qurantexts')
        //     ->where('sura', '=', $surah)
        //     ->where('aya', '=', $ayah)
        //     ->first()->text;

        // $data_fa = DB::table('Htranslations')
        //     ->where('surah_id', '=', $surah)
        //     ->where('ayah_num', '=', $ayah)
        //     ->first()->translation;

        // return view('quran.q', compact(['data_ar', 'data_fa', 'surah', 'ayah']));
    }
}
