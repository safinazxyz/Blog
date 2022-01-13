<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::prefix('/admin')->namespace('Admin')->group(function () {
    //All the admin routes will be defined here :-
    Route::match(['get', 'post'], '/', 'AdminController@login');

    Route::group(['middleware' => ['admin']], function () {

        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('settings', 'AdminController@settings');
        Route::get('logout', 'AdminController@logout');
        Route::post('check-current-pwd', 'AdminController@chkCurrentPassword');
        Route::post('update-current-pwd', 'AdminController@updateCurrentPassword');
        //Route::get('{anypath}', 'AdminController@dashboard')->where('path','.*');
        //Admin GET Enquiries getPage
        Route::get('get-enquiries', 'CmsController@getEnquiries');
        //BLOG
        Route::namespace('Blog')->group(function () {
            //Category
            Route::match(['get', 'post'],'add-category','BlogCategoryController@addCategory');
            Route::get('category','BlogCategoryController@allCategory');
            Route::get('enabledCategory','BlogCategoryController@enabledCategory');
            Route::match(['get', 'post'],'category/{id}','BlogCategoryController@deleteCategory');
            Route::match(['get', 'post'],'edit-category/{id}','BlogCategoryController@editCategory');
            Route::match(['get', 'post'],'update-category/{id}','BlogCategoryController@updateCategory');
            Route::match(['get', 'post'],'deleteCategory/{id}','BlogCategoryController@selectedCategory');
            //Post
            Route::match(['get', 'post'],'add-post','BlogPostController@addPost');
            Route::get('posts','BlogPostController@allPosts');
            Route::match(['get', 'post'],'post-delete/{id}','BlogPostController@deletePost');
            Route::match(['get', 'post'],'postVideo-delete/{id}','BlogPostController@deletePostVideo');
            Route::match(['get', 'post'],'edit-post/{id}','BlogPostController@editPost');
            Route::match(['get', 'post'],'update-post/{id}','BlogPostController@updatePost');

        });
    });
});

Route::get('/blogPost','BlogController@getAllBlogPosts');
Route::get('/singlePost/{id}','BlogController@getPostById');
Route::get('/categories','BlogController@getAllCategories');
Route::get('/categorypost/{id}','BlogController@getAllPostByCatId');
Route::match(['get', 'post'],'/search','BlogController@searchPost');
Route::get('/latestpost','BlogController@getLatestPost');
// Display Contact Page (for Vue.js)
Route::match(['get', 'post'], '/blog-contact', 'CmsController@sendEnquiry');
