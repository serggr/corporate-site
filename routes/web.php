<?php

Route::resource('/','IndexController',['only'=>['index'],'names'=>['index'=>'home']]);
Route::resource('portfolios','PortfolioController',[
    'parameters' => [
        'portfolios' => 'alias'
    ]
]);
Route::resource('articles','ArticlesController',[
    'parameters' => [
        'articles' => 'alias'
    ]
]);

Route::get('articles/cat/{cat_alias}',['uses'=> 'ArticlesController@index','as'=>'articlesCat'])->where('cat_alias','[\w-]+');

Route::get('tester',['uses' => 'TesterController@index']);
Route::get('testadm',['uses' => 'Admin\TesterController@index']);

Route::resource('comment','CommentController',['only'=>['store']]);

Route::match(['get','post'],'/contacts',['uses'=>'ContactsController@index','as'=>'contacts']);

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'],function(){
    
    Route::get('/',['uses' => 'Admin\IndexController@index', 'as' => 'adminIndex']);   
    Route::resource('articles','Admin\ArticlesController', ['as' => 'admin']);
    Route::resource('permissions','Admin\PermissionsController', ['as' => 'admin']);
    Route::resource('menus','Admin\MenusController', ['as' => 'admin']);
    Route::resource('users','Admin\UserController', ['as' => 'admin']);
    
});


