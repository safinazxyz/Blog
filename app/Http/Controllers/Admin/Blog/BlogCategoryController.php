<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BlogModel\BlogCategory;
use App\BlogModel\BlogPost;
use Illuminate\Support\Arr;

class BlogCategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }
            if (empty($data['meta_title'])) {
                $meta_title = "";
            } else {
                $meta_title = $data['meta_title'];
            }
            if (empty($data['meta_description'])) {
                $meta_description = "";
            } else {
                $meta_description = $data['meta_description'];
            }
            if (empty($data['meta_keywords'])) {
                $meta_keywords = "";
            } else {
                $meta_keywords = $data['meta_keywords'];
            }
            $rules = [
                'cat_name' => 'required|min:2|max:50',
                'description' =>'required',
                'parent_id' => 'required',
                'url' => 'required|min:2|max:100',
            ];
            $customMessages = [
                'cat_name.required' => 'Please enter a category name!',
                'cat_name.min' => 'Min char length 2!',
                'cat_name.max' => 'Max char length 50!',
                'description.required' => 'Please enter a description!',
                'parent_id.required' => 'Please select a category level!',
                'url.required' => 'Please enter a url!',
            ];
            $this->validate($request, $rules, $customMessages);
            $category = New BlogCategory;
            $category->cat_name = $data['cat_name'];
            $category->parent_id = $data['parent_id'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $meta_title;
            $category->meta_description = $meta_description;
            $category->meta_keywords = $meta_keywords;
            $category->status = $status;
            $category->save();
        }
        $categoryLevels = BlogCategory::where(['parent_id' => 0])->get();
        return response()->json([
            'categoryLevels' => $categoryLevels
        ], 200);
    }

    public function allCategory()
    {
        $categories = BlogCategory::all();
        return response()->json([
            'categories' => $categories
        ], 200);
    }
    public function enabledCategory()
    {
        $categories = BlogCategory::where('status',1)->get();
        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function deleteCategory($id)
    {
        if (!empty($id)) {
            BlogCategory::where(['id' => $id])->delete();
        }
    }

    public function editCategory($id = null)
    {
        $category = BlogCategory::find($id);
        return response()->json([
            'category' => $category
        ], 200);
    }

    public function updateCategory(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'cat_name' => 'required|min:2|max:50',
                'description' =>'required',
                'parent_id' => 'required',
                'url' => 'required|min:2|max:100',
            ];
            $customMessages = [
                'cat_name.required' => 'Please enter a category name!',
                'cat_name.min' => 'Min char length 2!',
                'cat_name.max' => 'Max char length 50!',
                'description.required' => 'Please enter a description!',
                'parent_id.required' => 'Please select a category level!',
                'url.required' => 'Please enter a url!',
            ];
            $this->validate($request, $rules, $customMessages);
            $data = $request->all();
            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }
            if (empty($data['meta_title'])) {
                $meta_title = "";
            } else {
                $meta_title = $data['meta_title'];
            }
            if (empty($data['meta_description'])) {
                $meta_description = "";
            } else {
                $meta_description = $data['meta_description'];
            }
            if (empty($data['meta_keywords'])) {
                $meta_keywords = "";
            } else {
                $meta_keywords = $data['meta_keywords'];
            }
            BlogCategory::where(['id' => $id])->update([
                'cat_name' => $data['cat_name'],
                'parent_id' => $data['parent_id'],
                'description' => $data['description'],
                'url' => $data['url'],
                'meta_title' =>$meta_title,
                'meta_description' =>$meta_description,
                'meta_keywords' =>$meta_keywords,
                'status' =>$status,
                ]);
        }
    }
    public function selectedCategory($ids){
        $all_id = explode(',',$ids);
        foreach ($all_id as $id){
            if (!empty($id)) {
                BlogCategory::where(['id' => $id])->delete();
            }
        }
    }
}
