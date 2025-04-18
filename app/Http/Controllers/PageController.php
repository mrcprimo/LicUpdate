<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function show($page)
    {
        if($page == 'history'){
            $history = DB::table('weather_history')->get();
            // dd($history);
            return view($page, [
                'history' => $history
            ]);
        }else{
            return view($page);
        }
    }
}
