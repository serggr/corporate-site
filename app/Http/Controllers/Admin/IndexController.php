<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class IndexController extends AdminController
{
    public function __construct(Request $request) {

        
        parent::__construct();
        
            $this->middleware(function ($request, $next) {
                echo Gate::allows('VIEW_ADMIN') ? '' : abort(404);
                return $next($request);
            }
        
        );        


        $this->template = env('THEME').'.admin.index';

    }
    
    public function index() {
        $this->title = 'Панель администратора';
        
        return $this->renderOutput();
    }
    
}































