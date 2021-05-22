<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qurantext;
use Illuminate\Support\Facades\DB;
use App\Models\Metadata;

class QurantextController extends Controller
{

    public function index()
    {

        $xmlString = file_get_contents(public_path('../resources/quran-data.xml'));
        $xmlObject = simplexml_load_string($xmlString);
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);



        function array_push_assoc($array, $key, $value)
        {
            $array[$key] = $value;
            return $array;
        }

        $data = array();
        
        $index = 1;
        $l1 = ($phpArray['suras']['sura']);
        foreach ($phpArray['suras']['sura'] as $sura) {
            foreach ($sura as $item) {
                // DB::table('metadatas') -> insert([
                //     ['id' => $index, 'surah_title' => $item['name'], 'ayah_count' => $item['ayas']],
                // ]);
                $index++;
                $data = array_push_assoc($data, $item['name'], $item['ayas']);
            }
        }

        // dd($data);


        $surah = 40;
        $ayah = 17;

        $data_ar = DB::table('Qurantexts')
            ->where('sura', '=', $surah)
            ->where('aya', '=', $ayah)
            ->first()->text;

        $data_fa = DB::table('Htranslations')
            ->where('surah_id', '=', $surah)
            ->where('ayah_num', '=', $ayah)
            ->first()->translation;

        return view('quran.q', compact(['data_ar', 'data_fa', 'surah', 'ayah']));
    }
}
