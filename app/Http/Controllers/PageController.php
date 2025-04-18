<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WarningEmail;

class PageController extends Controller
{
    public function show($page)
    {
        if($page == 'history'){
            // $history = DB::table('weather_history')->get();
            // // dd($history);
            // return view($page, [
            //     'history' => $history
            // ]);
            $precip = 150;

    // $threshold = DB::table('weather_history')
    //         ->orderBy('created_at', 'desc')
    //         ->first();

            $th = 158;
            $yellow = (50/100)*$th;
            $orange = (75/100)*$th;
            $red = $th;

            // if( $precip >= $yellow && $precip < $orange){
            //     //send email yellow warning
            // }else if( $precip >= $orange && $precip < $red){
            //     //send email orange warning
            // }else if( $precip >= $red ){
            //     //send email red warning
            // }

            if ($precip >= $yellow && $precip < $orange) {
                Mail::to('primo.marc@clsu2.edu.ph')->send(new WarningEmail('yellow', $precip));
                dd('Yellow');
            } elseif ($precip >= $orange && $precip < $red) {
                Mail::to('primo.marc@clsu2.edu.ph')->send(new WarningEmail('orange', $precip));
                dd('Orange');
            } elseif ($precip >= $red) {
                Mail::to('primo.marc@clsu2.edu.ph')->send(new WarningEmail('red', $precip));
                dd('Red');
            }
        }else{
            return view($page);
        }
    }
}
