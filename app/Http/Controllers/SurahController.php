<?php

namespace App\Http\Controllers;

use App\Models\Surah;
use App\Models\Ayah;
use Illuminate\Support\Facades\DB;

class SurahController extends Controller
{
    public function index()
    {
        $xmlString = file_get_contents(public_path('../resources/quran-data.xml'));
        $xmlObject = simplexml_load_string($xmlString);
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);
        
        // $data = array();
        
        $index = 1;
        
        foreach ($phpArray['suras']['sura'] as $sura) {
            foreach ($sura as $item) {
                DB::table('surahs') -> insert([
                    ['id' => $index, 'name' => $item['name'], 'ayah_count' => $item['ayas']],
                ]);
                $index++;
            }
        }

        echo("Ok");
    }
}
