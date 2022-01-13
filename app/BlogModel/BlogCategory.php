<?php

namespace App\BlogModel;
use App\Model;

class BlogCategory extends Model
{
    public function posts(){
        return $this->hasMany(BlogPost::class,'id');
    }
    public function categories(){
        return $this->hasMany('App\BlogModel\BlogCategory','parent_id');
    }
}
