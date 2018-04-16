<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Corp\Http\Requests\MenusRequest;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\RolesRepository;
use Corp\Repositories\UsersRepository;
use Gate;
use Corp\User;

class UsersController extends AdminController
{
    protected $us_rep;
    protected $rol_rep;

    public function __construct(RolesRepository $rol_rep, UsersRepository $us_rep) {
        
        parent::__construct();
        
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('EDIT_USERS'))
                {
                    abort(404);
                }
            return $next($request);
        });     
        
        
        $this->us_rep = $us_rep;
        $this->rol_rep = $rol_rep;       
        
        $this->template = env('THEME').'.admin.users';
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  $this->us_rep->get();
        
        $this->content = view(env('THEME').'.admin.users_content')->with('users',$users)->render();
        
        return $this->renderOutput();
    }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        
    public function edit( $id)
    {
              
        $user = User::where('id',$id)->first();
        
//        if(Gate::denies('edit',new Article)){
//            abort(404);
//        }
        
//        $categories = Category::select(['title','alias','parent_id','id'])->get();
//        $lists = array();
//        
//        foreach ($categories as $category) {
//            if($category->parent_id == 0){
//                $lists[$category->title] = array();
//            }
//            else {
//                $lists[$categories
//                        ->where('id',$category->parent_id)
//                        ->first()->title][$category->id] 
//                        = $category->title;
//                
//            }
//        } 
//
//        $this->title  = 'Редактирование материала - '.$article->title; 
        
        $this->content = view(env('THEME').'.admin.users_create_content')
                ->with(['user' => $user])
                ->render();
        
        return $this->renderOutput();        
        
        
    }      
        
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \Corp\Menu $menu)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\Corp\Menu $menu)
    {
        //

    }
}























