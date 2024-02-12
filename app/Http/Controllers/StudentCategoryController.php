<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use DB;

class StudentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = DB::table('student_categories')->get();
            return response()->json([
                'status' => 'success',
                'rows' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::table('student_categories')->insert([
                'student_category_name' => $request->student_category_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);           
            return response()->json([
                'status' => 'success', 
                'message' => 'Category added successfully'
            ]);
        } catch (ValidationException $e) {           
            return response()->json([
                'status' => 'error', 
                'errors' => $e->errors()
            ], 422);
        }
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::table('student_categories')->where('id',$id)->update([
                'student_category_name' => $request->student_category_name,
                'updated_at' => Carbon::now()
            ]);
            return response()->json([
                'status' => 'success', 
                'message' => 'Category updated successfully'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error', 
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::table('student_categories')->where('id',$id)->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'Category deleted successfully'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error', 
                'errors' => $e->errors()
            ], 422);
        }
    }
}
