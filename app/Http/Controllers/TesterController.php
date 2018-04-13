<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class TesterController extends Controller
{
public function index() {
    
    //Auth::logout();
    dd(Auth::user());
    //$testers = \Corp\Tester::all();
    //dd($testers);
    //$testers = \Corp\Tester::paginate(4);
    $testers = DB::table('testers')->paginate(1);
    //$testers->setPath('');
    return view(env('THEME').'.tester', ['testers'=>$testers]);
    

}
    
}
