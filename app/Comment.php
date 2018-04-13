<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['id','name','text','site','user_id','article_id','parent_id','email'];
    
    public function article(){
        return $this->belongsTo('Corp\Article');
    }
    
    public function user(){
        return $this->belongsTo('Corp\User');
    }    
    
}
