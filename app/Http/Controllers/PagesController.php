<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PagesController extends Controller
{
    // index page
    public function index(){
        return view('pages.index');
    }

    // training page
    public function training(){
        $words = DB::table('words')->pluck('word');
        return view('pages.training' , ['words' => $words ]);
    }

    // import view
    public function importView(){
        return view('pages.import');
    }

    // import process
    public function importProcess( Request $req){

        // $words_db = DB::table('words')
        //         ->where('id', array(1,2,3))
        //         ->get();
        // if(!empty($words_db)){
        //     return redirect('/');
        // }
        $words_doc = $req->file('words_doc');
        $words = file($words_doc->getRealPath(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $wordsArr = [];
        foreach ($words as $word) {
            $words = explode(',', $word);
            foreach ($words as $word) {
                $wordsArr[] = $word;
            }
        }

        if(!is_null( $wordsArr)){

            foreach ($wordsArr as $word) {
                DB::table('words')->insert([
                    'word' => $word ,
                ]);
            }
    
        }


    }
}
