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
use Carp\User;

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

    public function getMenus() {
        
        $menu = $this->m_rep->get();
               
        if($menu->isEmpty()){
            return FALSE;
        }
        
        return Menu::make('forMenuPart', function($m) use($menu){
            
                    foreach ($menu as $item){
                        if($item->parent == 0){
                            $m->add($item->title,$item->path)->id($item->id);
                        }
                        else {
                           if($m->find($item->parent)){
                             $m->find($item->parent)->add($item->title,$item->path)->id($item->id); 
                           } 
                        }
                    }
            
        });
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->title = 'Новый пункт меню';
        
        $tmp = $this->getMenus()->roots();
        
        $menus = $tmp->reduce(function($returnMenus,$menu){
        
            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;
            
        },['0' => 'Родительский пункт меню']);
        
        $categories = \Corp\Category::select(['title','alias','parent_id','id'])->get();
        
        $list = array();
        $list = array_add($list, '0', 'Не используется');
        $list = array_add($list, 'parent', 'Раздел блог');
        
        foreach($categories as $category){
            
            if($category->parent_id == 0){
                $list[$category->title] = array();
            }else{
                $list[$categories->where('id',$category->parent_id)->first()->title][$category->alias] = $category->title;
            }
            
        }
        
        $articles = $this->a_rep->get(['id','title','alias']);
        
        $articles = $articles->reduce(function($returnArticles,$article){
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
            
        },[]); 
        
        $filters = \Corp\Filter::select('id','title','alias')->get();
        $filters = $filters->reduce(function($returnFilters,$filter){
        
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
            
        },['parent' => 'Раздел портфолио']); 
        
        
        
        $portfolios = $this->p_rep->get(['id','title','alias']);        
        $portfolios = $portfolios->reduce(function($returnPortfolios,$portfolio){
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
            
        },['0' => 'Не используется']);         
        
        $this->content = view(env('THEME').'.admin.menus_create_content')
                ->with(['menus'=>$menus,
                    'categories'=>$list,
                    'articles'=>$articles,
                    'filters'=>$filters,
                    'portfolios'=>$portfolios])->render();
        
        return $this->renderOutput();
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
       $result = $this->us_rep->addUser($request); 
       if (is_array($result) && !empty($result['error'])){
           return back()->with($result);
       }
       
       return redirect('/admin')->with($result);        
        
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
    public function edit(\Corp\Menu $menu)
    {
        
        //
        $this->title = 'Редактирование ссылки - '.$menu->title;
        
        $type = FALSE;
        $option = FALSE;
        
        $route = app('router')->getRoutes()->match(app('request')->create($menu->path));
        
        $aliasRoute = $route->getName();
        $parameters = $route->parameters();
        
        if($aliasRoute == 'articles.index' || $aliasRoute == 'articlesCat'){
           $type = 'blogLink'; 
           $option = isset($parameters['cat_alias']) ? $parameters['cat_alias'] : 'parent';
        }
        else if ($aliasRoute == 'articles.show') {
           $type = 'blogLink'; 
           $option = isset($parameters['alias']) ? $parameters['alias'] : '';            
        
        }
        else if ($aliasRoute == 'portfolios.index') {
           $type = 'portfolioLink'; 
           $option = 'parent'; 
        }        
        else if ($aliasRoute == 'portfolios.show') {
           $type = 'portfolioLink'; 
           $option = isset($parameters['alias']) ? $parameters['alias'] : '';  
        }  
        else {
            $type = 'customLink';
        }
        
        
        $tmp = $this->getMenus()->roots();
        
        $menus = $tmp->reduce(function($returnMenus,$menu){
        
            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;
            
        },['0' => 'Родительский пункт меню']);
        
        $categories = \Corp\Category::select(['title','alias','parent_id','id'])->get();
        
        $list = array();
        $list = array_add($list, '0', 'Не используется');
        $list = array_add($list, 'parent', 'Раздел блог');
        
        foreach($categories as $category){
            
            if($category->parent_id == 0){
                $list[$category->title] = array();
            }else{
                $list[$categories->where('id',$category->parent_id)->first()->title][$category->alias] = $category->title;
            }
            
        }
        
        $articles = $this->a_rep->get(['id','title','alias']);
        
        $articles = $articles->reduce(function($returnArticles,$article){
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
            
        },[]); 
        
        $filters = \Corp\Filter::select('id','title','alias')->get();
        $filters = $filters->reduce(function($returnFilters,$filter){
        
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
            
        },['parent' => 'Раздел портфолио']); 
        
        
        
        $portfolios = $this->p_rep->get(['id','title','alias']);        
        $portfolios = $portfolios->reduce(function($returnPortfolios,$portfolio){
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
            
        },['0' => 'Не используется']);         
        
        $this->content = view(env('THEME').'.admin.menus_create_content')
                ->with(['menu'=>$menu,
                    'type'=>$type,
                    'option'=>$option,
                    'menus'=>$menus,
                    'categories'=>$list,
                    'articles'=>$articles,
                    'filters'=>$filters,
                    'portfolios'=>$portfolios])->render();
        
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
       $result = $this->m_rep->updateMenu($request, $menu); 
       if (is_array($result) && !empty($result['error'])){
           return back()->with($result);
       }
       
       return redirect('/admin')->with($result);        
        
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
       $result = $this->m_rep->deleteMenu($menu); 
       if (is_array($result) && !empty($result['error'])){
           return back()->with($result);
       }
       
       return redirect('/admin')->with($result);
    }
}























