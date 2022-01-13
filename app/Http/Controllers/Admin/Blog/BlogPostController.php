<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogModel\BlogCategory;
use App\BlogModel\BlogPost;
use Auth;
use Image;
use Illuminate\Support\Facades\Storage;


class BlogPostController extends Controller
{
    public function allPosts()
    {
        $posts = BlogPost::with('admin', 'category')->orderBy('id', 'desc')->get();
        return response()->json([
            'posts' => $posts
        ], 200);
    }

    public function addPost(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'title' => 'required|min:2|max:50',
                'description' => 'required|min:2',
                'cat_id' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Please enter title!',
                'title.max' => 'Please enter less then 50 char',
                'description.required' => 'Please enter description!',
                'cat_id.required' => 'Please select a category!',
            ];
            $this->validate($request, $rules, $customMessages);
            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }
            //Upload Image
            $strpos = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $filename = rand(111, 99999) . '.' . $ex;
            $large_image_path = 'images/blog/post/large/' . $filename;
            $medium_image_path = 'images/blog/post/medium/' . $filename;
            $small_image_path = 'images/blog/post/small/' . $filename;
            //Resize Images
            Image::make($request->photo)->save($large_image_path);
            Image::make($request->photo)->resize(600, 600)->save($medium_image_path);
            Image::make($request->photo)->resize(300, 300)->save($small_image_path);

            //Upload Video
            if (empty($data['video'])) {
                $videoName = '';
            } else {
                $strposvideo = strpos($request->video, ';');
                $subvideo = substr($request->video, 0, $strposvideo);
                $exvideo = explode('/', $subvideo)[1];
                $videoName = rand(111, 99999) . '.' . $exvideo;
                $video_path = 'app/public/blog/post/';
                $filevideo = $request->video;
                Storage::putFileAs($video_path, $filevideo, $videoName);
            }

            $post = new BlogPost;
            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->cat_id = $data['cat_id'];
            $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
            $post->admin_id = $adminDetails->id;
            $post->video = $videoName;
            $post->photo = $filename;
            $post->status = $status;
            $post->save();

        }
    }

    public function deletePost($id = null)
    {
        //Get Post Image Name
        $postFile = BlogPost::where(['id' => $id])->first();  //image name
        $large_image_path = 'images/blog/post/large/';
        $medium_image_path = 'images/blog/post/medium/';
        $small_image_path = 'images/blog/post/small/';

        //Delete Large Image if not exists inFolder
        if (file_exists($large_image_path . $postFile->photo)) {
            unlink($large_image_path . $postFile->photo);
        }
        //Delete Medium Image if not exists inFolder
        if (file_exists($medium_image_path . $postFile->photo)) {
            unlink($medium_image_path . $postFile->photo);
        }
        //Delete Small Image if not exists inFolder
        if (file_exists($small_image_path . $postFile->photo)) {
            unlink($small_image_path . $postFile->photo);
        }
        //Delete Videos
        $video_path = 'storage/videos/blog/post/';
        if (file_exists($video_path . $postFile->video)) {
            unlink($video_path . $postFile->video);
        }
        if (!empty($id)) {
            BlogPost::where(['id' => $id])->update(['photo' => ""]);
            BlogPost::where(['id' => $id])->update(['video' => ""]);
            BlogPost::where(['id' => $id])->delete();
        }
    }
    public function deletePostVideo($id = null)
    {

        $postFile = BlogPost::where(['id' => $id])->first();
        //Delete Videos
        $video_path = 'storage/videos/blog/post/';
        if (file_exists($video_path . $postFile->video)) {
            unlink($video_path . $postFile->video);
        }
        if (!empty($id)) {
            BlogPost::where(['id' => $id])->update(['video' => ""]);
        }
    }

    public function editPost($id = null)
    {
        $posts = BlogPost::find($id);
        return response()->json([
            'posts' => $posts,
        ], 200);
    }

    public function updatePost(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $post = BlogPost::find($id);
            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }
            $rules = [
                'title' => 'required|min:2|max:50',
                'description' => 'required|min:2',
                'cat_id' => 'required',

            ];
            $customMessages = [
                'title.required' => 'Please enter title!',
                'title.max' => 'Please enter less then 50 char',
                'description.required' => 'Please enter description!',
                'cat_id.required' => 'Please select a category!',
            ];
            $this->validate($request, $rules, $customMessages);
            //Edit Video
            if(empty($post['video'])) {
                if ($request->video != null || $request->video != '') {
                    $strposvideo = strpos($request->video, ';');
                    $subvideo = substr($request->video, 0, $strposvideo);
                    $exvideo = explode('/', $subvideo)[1];
                    $videoName = rand(111, 99999) . '.' . $exvideo;
                    $video_path = 'public/videos/blog/post/';
                    $filevideo = $request->video;
                    Storage::putFileAs($video_path, $filevideo, $videoName);
                    //Delete Video if not exists inFolder
                }
                else{
                    $videoName='';
                }
            }if(!empty($post['video'])){
                if ($request->video != $post->video) {
                    $strposvideo = strpos($request->video, ';');
                    $subvideo = substr($request->video, 0, $strposvideo);
                    $exvideo = explode('/', $subvideo)[1];
                    $videoName = rand(111, 99999) . '.' . $exvideo;
                    $video_path = 'public/videos/blog/post/';
                    $video_path2 = 'storage/videos/blog/post/';
                    $filevideo = $request->video;
                    Storage::putFileAs($video_path, $filevideo, $videoName);
                    //Delete Video if not exists inFolder
                    if (file_exists($video_path2 . $post->video)) {
                        unlink($video_path2 . $post->video);
                    }
                } else {
                    $videoName = $post->video;
                }
            }
            //Edit Image
            if ($request->photo != $post->photo) {
                $strpos = strpos($request->photo, ';');
                $sub = substr($request->photo, 0, $strpos);
                $ex = explode('/', $sub)[1];
                $filename = rand(111, 99999) . '.' . $ex;
                $large_image_path = 'images/blog/post/large/' . $filename;
                $medium_image_path = 'images/blog/post/medium/' . $filename;
                $small_image_path = 'images/blog/post/small/' . $filename;
                $large_image_path2 = 'images/blog/post/large/';
                $medium_image_path2 = 'images/blog/post/medium/';
                $small_image_path2 = 'images/blog/post/small/';
                //Resize Images
                Image::make($request->photo)->save($large_image_path);
                Image::make($request->photo)->resize(600, 600)->save($medium_image_path);
                Image::make($request->photo)->resize(300, 300)->save($small_image_path);
                //Delete Large Image if not exists inFolder
                if (file_exists($large_image_path2 . $post->photo)) {
                    unlink($large_image_path2 . $post->photo);
                }
                //Delete Medium Image if not exists inFolder
                if (file_exists($medium_image_path2 . $post->photo)) {
                    unlink($medium_image_path2 . $post->photo);
                }
                //Delete Small Image if not exists inFolder
                if (file_exists($small_image_path2 . $post->photo)) {
                    unlink($small_image_path2 . $post->photo);
                }
            } else {
                $filename = $post->photo;
            }


            BlogPost::where(['id' => $id])->update(
                ['cat_id' => $data['cat_id'],
                    'description' => $data['description'],
                    'title' => $data['title'],
                    'photo' => $filename,
                    'video' => $videoName,
                    'status' => $status]);
        }
    }
}
