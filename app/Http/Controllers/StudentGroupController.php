<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use DB;
class StudentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $groups = DB::table('groups')->get();
            return response()->json([
                'status' => 'success',
                'rows' => $groups
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
            DB::table('groups')->insert([
                'student_group_name' => $request->student_group_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);           
            return response()->json([
                'status' => 'success', 
                'message' => 'Group added successfully'
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
            DB::table('groups')->where('id',$id)->update([
                'student_group_name' => $request->student_group_name,
                'updated_at' => Carbon::now()
            ]);
            return response()->json([
                'status' => 'success', 
                'message' => 'Group updated successfully'
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
            DB::table('groups')->where('id',$id)->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'Group deleted successfully'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error', 
                'errors' => $e->errors()
            ], 422);
        }
    }
}
