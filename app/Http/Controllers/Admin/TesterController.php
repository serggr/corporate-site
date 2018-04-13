<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Corp\Http\Controllers\Controller;
use Auth;

class TesterController extends Controller
{
    public $user;


    public function __construct() {
         
//        $this->middleware(function ($request, $next)
//        {
//            $this->user = Auth::user();
//            return $next($request);
//        });
//        
    
    }  

    public function index() {

        
      //  Auth::logout();
        dd(Auth::check());
        //$testers = \Corp\Tester::all();
        //dd($testers);
        //$testers = \Corp\Tester::paginate(4);
        $testers = DB::table('testers')->paginate(1);
        //$testers->setPath('');
        return view(env('THEME').'.tester', ['testers'=>$testers]);


    }
    
}
