<?php

namespace App\BlogModel;

use App\Admin;
use App\BlogModel\BlogCategory;
use App\Model;

class BlogPost extends Model
{
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public  function category(){
        return $this->belongsTo(BlogCategory::class,'cat_id');
    }

}
