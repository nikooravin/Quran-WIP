<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ayah;
use App\Models\Surah;
use App\Models\Translation;

class WordController extends Controller
{
    public function index()
    {
        // $objReader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
        // $phpword = $objReader->load("../resources/habibsm.docx");

        // $content = [];

        // foreach ($phpword->getSections() as $section) {
        //     $arrays = $section->getElements();
        // }
        // foreach ($arrays as $e) {
        //     foreach ($e->getElements() as $text) {
        //         $pattern1 = "/[٠-٩]/i";
        //         $pattern2 = "/[0-9]/i";
        //         if (preg_match($pattern2, $text->getText())) {
        //             $content[] = $text->getText();
        //         } elseif (preg_match($pattern1, $text->getText())) {
        //             $content[] = $text->getText();
        //         }
        //     }
        // }
        // dd ($content);

        // // return view('quran.quran', compact('content'));


        // $phpWord = \PhpOffice\PhpWord\IOFactory::load('../resources/habibi_translation.docx');
        $text = $sorename = '';
        $s = [];
        ini_set('memory_limit', -1);
        set_time_limit(0);
        foreach ($phpWord->getSections() as $section) {
            $els = $section->getElements();
            foreach ($els as $e) {
                if (get_class($e) === 'PhpOffice\PhpWord\Element\TextRun') {
                    foreach ($e->getElements() as $els1) {
                        if (get_class($els1) === 'PhpOffice\PhpWord\Element\Text') {
                            $text .= $els1->getText(); // .... + سوره + حمد + - +  1 + بسم الله الرحمن الرحیم
                        }
                    }
                    $text = trim(preg_replace("/\r|\n/", "", $text));
                    $text = isset($beforeText) ? str_replace($beforeText, '', $text) : $text;
                    $text = str_replace([1, 2, 3, 4, 5, 6, 7, 8, 9, 0], '', $text);
                    // arabic Numeric
                    $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
                    $text = str_replace($arabic, '', $text);
                    // Persian Numeric
                    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
                    $text = str_replace($persian, '', $text);
                    $text = str_replace('()', '', $text);
                    $text = trim($text);
                    if (strstr($text, 'سوره') && (strstr($text, '–') || strstr($text, '-'))) {
                        $text = str_replace(' -', '', $text);
                        $text = str_replace(' –', '', $text);
                        $sorename = $text; // سوره بقره
                    }
                    $s[$sorename][] = $text;
                    $beforeText = $text;
                }
            }
        }

        $arabic = $persian = [];
        foreach ($s as $soreName => $ayat) {
            unset($ayat[0]);
            $ayat= array_values($ayat);

            $sore = Surah::create(['name' => $soreName, 'ayah_count'=>'7']);

            $y=1;
            $z =1;
            foreach ($ayat as $key => $aye) {
                // arabic
                if ($key % 2) {
                    $persian[] = $aye;
                    Translation::create(['translation' => $aye, 'ayah_id'=> $z]);
                    $z++;
                } else {
                    $arabic[] = $aye;
                    Ayah::create(['ayah_ar_content' => $aye, 'surah_id' => $sore->id, 'ayah_num'=> $y]);
                    $y++;
                }
            }
            // dd($persian);
        }
    }
}
