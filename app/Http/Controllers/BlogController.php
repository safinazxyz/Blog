<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BlogModel\BlogCategory;
use App\BlogModel\BlogPost;

class BlogController extends Controller
{
    public function getAllBlogPosts()
    {
        $posts = BlogPost::with('admin', 'category')->orderBy('id', 'desc')->get();
        return response()->json([
            'posts' => $posts
        ], 200);

    }

    public function getPostById($id)
    {
        $posts = BlogPost::with('admin', 'category')->where('id', $id)->first();
        return response()->json([
            'posts' => $posts
        ], 200);
    }
    public function getAllCategories(){
        $categories = BlogCategory::with('categories')->where(['parent_id' => 0])->where('status',1)->get();
        return response()->json([
            'categories' => $categories,
        ], 200);
    }
    public function getAllPostByCatId($id){
        $posts = BlogPost::with('admin', 'category')
            ->where('cat_id',$id)
            ->orderBy('id', 'desc')->get();
        return response()->json([
            'posts' => $posts
        ], 200);
    }
    public function searchPost(Request $request){

        $search = \Request::get('s');
        if($search!=null){
            $posts = BlogPost::with('admin','category')
                ->where('title','like','%'.$search.'%')
                ->orWhere('description','like','%'.$search.'%')
                ->get();
            return response()->json([
                'posts'=>$posts
            ],200);
        }else{
            return $this->getAllBlogPosts();
        }
    }
    public function getLatestPost(){
        $posts = BlogPost::with('admin', 'category')->orderBy('id', 'desc')->get();
        return response()->json([
            'posts' => $posts
        ], 200);
    }


}
