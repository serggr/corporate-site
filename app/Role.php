<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users() {
        return $this->belongsToMany('Corp\User','role_user'); //role_user -таблица связи; Corp\User -  с какой таблицей связываемся
    }
    
    public function perms() {
        return $this->belongsToMany('Corp\Permission','permission_role'); 
    }    
    
    public function hasPermissions($name, $require = false) {
        
        if (is_array($name)){
            foreach ($name as $permissionName){
                $hasPermission = $this->hasPermissions($permissionName);
                
                if($hasPermission && !$require){
                    return true;
                } elseif (!$hasPermission && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->perms()->get() as $permission){
                if ($permission->name == $name) {
                    return true;
                }
            }
        } 
        
        return FALSE;
        
    }
    
    public function savePermissions($inputPermissions) {
       // dd($inputPermissions);
        if(!empty($inputPermissions)){
            $this->perms()->sync($inputPermissions);
        }
        else {
            $this->perms()->detach();
        }
        return true;
    }
    
}


































