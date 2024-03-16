<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Blog::with('user')->get();
        return response()->json($data);
    }
    public function getFrontBlogs()
    {
        $data = Blog::with('user')->get();
        return response()->json($data);
    }
    public function getFrontBlog($id)
    {
        $data = Blog::where('id',$id)->with('user')->first();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->body = $request->body;
        if ($request->feature_image) {
            // Process and save the banner image
            $position = strpos($request->feature_image, ';');
            $sub = substr($request->feature_image, 0 ,$position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;

            $manager = ImageManager::gd();
            $image = $manager->read($request->feature_image)->resize(1200, 800);
            $upload_path = 'assets/images/blogs/';
            $image_url = $upload_path.$name;
            $image->save($image_url);
            
            $blog->feature_image = $image_url;
        }
        $blog->created_by = \Auth::user()->id;
        $blog->save();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Blog::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $blog = Blog::find($request->id);
        $blog->title = $request->title;
        $blog->body = $request->body;
        if ($request->feature_image) {
            // Process and save the banner image
            $position = strpos($request->feature_image, ';');
            $sub = substr($request->feature_image, 0 ,$position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;

            $manager = ImageManager::gd();
            $image = $manager->read($request->feature_image)->resize(1200, 800);
            $upload_path = 'assets/images/blogs/';
            $image_url = $upload_path.$name;
            $image->save($image_url);
            if ($blog->feature_image) {
                $old_img = public_path($blog->feature_image);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
            }  
            $blog->feature_image = $image_url;
        }
        $blog->created_by = \Auth::user()->id;
        $blog->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if ($blog->feature_image) {
            $old_img = public_path($blog->feature_image);
            if (file_exists($old_img)) {
                unlink($old_img);
            }
        }  
        $blog->delete();
    }
}
