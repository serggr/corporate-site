<?php

namespace Corp\Repositories;

use Corp\User;

class UsersRepository extends Repository {
    
    public function __construct(User $user) {
        
        $this->model = $user;
    }
    
    public function addUser($request) {
        
    
    if(\Gate::denies('create',$this->model)){
        abort(404);
    }
    $data = $request->all();
    $user = $this->model->create([
        'name'=>$data['name'],
        'login'=>$data['login'],
        'email'=>$data['email'],
        'password'=> bcrypt($data['password']),
    ]);
    
    if($user){
        $user->roles()->attach($data['role_id']);
    }
    
    return ['status' => 'Пользователь добавлен'];
    
    }
    
}


