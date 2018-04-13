<?php

namespace Corp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function articles() {
        return $this->hasMany('Corp\Article');
    }
    
    public function roles() {
        return $this->belongsToMany('Corp\Role','role_user'); //role_user -таблица связи
    }
    
    //$permission 'string' or array('View_Admin', 'ADD_Articles')
    //TRUE должны все права быть позволены, FALSE должно быть позволено хотя бы одно право
    
    public function canDo($permission,$require = FALSE) {
       if(is_array($permission)){ 
           foreach($permission as $permName){
               
               $permName = $this->canDo($permName);
               if($permName && !$require){
                   return TRUE;
               }
               else if(!$permName && $require){
                   return FALSE;
               }             
            }
            return $require;
       }
       else{
           foreach($this->roles as $role) {
               foreach($role->perms as $perm){
                   if(str_is($permission,$perm->name)){
                       return TRUE;
                   }
               }
           }
       }
           
    } 
    
    // принимает роль или массив ролей
    
    public function hasRole($name,$require = FALSE) {
       if(is_array($name)){ 
           foreach($name as $roleName){
               
               $hasRole = $this->hasRole($roleName);
               if($hasRole && !$require){
                   return TRUE;
               }
               else if(!$hasRole && $require){
                   return FALSE;
               }             
            }
            return $requireAll;
       }else{
            foreach($this->roles as $role) {
               
                if($role->name == $name){
                    return TRUE;
                }
               
           }
       }
           
    } 
    
}
