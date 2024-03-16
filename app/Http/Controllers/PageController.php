<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAbout()
    {
        $data = DB::table('abouts')->first();
        return response()->json($data);
    }
    /**
     * Update the specified resource in storage.
     */
    
    public function updateAbout(Request $request)
    {
        // Retrieve the row you want to update
        $data = DB::table('abouts')->first();
    
        if ($data) {
            // Update the fields
            $data->page_title = $request->page_title;
            $data->company_history = $request->company_history;
            $data->company_vision = $request->company_vision;
    
            if ($request->edit_banner_image) {
                // Process and save the banner image
                $position = strpos($request->edit_banner_image, ';');
                $sub = substr($request->edit_banner_image, 0 ,$position);
                $ext = explode('/', $sub)[1];
                $name = time().".".$ext;

                $manager = ImageManager::gd();
                $image = $manager->read($request->edit_banner_image)->resize(1200, 200);
                $upload_path = 'assets/images/pages/';
                $image_url = $upload_path.$name;
                $image->save($image_url);

                // Remove the previous image from the public directory
                if ($data->banner_image) {
                    $old_img = public_path($data->banner_image);
                    if (file_exists($old_img)) {
                        unlink($old_img);
                    }
                }    
                $data->banner_image = $image_url;
            }
    
            // Save the changes
            DB::table('abouts')->where('id', $data->id)->update([
                'page_title' => $request->page_title,
                'company_history' => $request->company_history,
                'company_vision' => $request->company_vision,
                'banner_image' => $data->banner_image
            ]);
    
            return response()->json(['message' => 'About updated successfully']);
        }
    
        return response()->json(['message' => 'No About found'], 404);
    }
    /**
     * Display a listing of the resource.
     */
    public function getContact()
    {
        $data = DB::table('contacts')->first();
        return response()->json($data);
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateContact(Request $request)
    {
        // Retrieve the row you want to update
        $data = DB::table('contacts')->first();
    
        if ($data) {
            // Update the fields
            $data->page_title = $request->page_title;
            $data->company_address = $request->company_address;
    
            if ($request->edit_banner_image) {
                // Process and save the banner image
                $position = strpos($request->edit_banner_image, ';');
                $sub = substr($request->edit_banner_image, 0 ,$position);
                $ext = explode('/', $sub)[1];
                $name = time().".".$ext;

                $manager = ImageManager::gd();
                $image = $manager->read($request->edit_banner_image)->resize(1200, 200);
                $upload_path = 'assets/images/pages/';
                $image_url = $upload_path.$name;
                $image->save($image_url);

                // Remove the previous image from the public directory
                if ($data->banner_image) {
                    $old_img = public_path($data->banner_image);
                    if (file_exists($old_img)) {
                        unlink($old_img);
                    }
                }    
                $data->banner_image = $image_url;
            }
    
            // Save the changes
            DB::table('contacts')->where('id', $data->id)->update([
                'page_title' => $data->page_title,
                'company_address' => $data->company_address,
                'banner_image' => $data->banner_image
            ]);
    
            return response()->json(['message' => 'Contact updated successfully']);
        }
    
        return response()->json(['message' => 'No contact found'], 404);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
    }
}
