<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Exception;
use DB;

class StudentClassController extends Controller
{
    // get resources from database
    function index()
    {       
        try {
            $rows = DB::table('students_class')->get();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
        
    }
    // store data to database
    function store(Request $request)
    {
        try {
            $request->validate([
                'class_name' => 'required|unique:students_class,class_name'
            ]);
            
            DB::table('students_class')->insert([
                'class_name' => $request->class_name
            ]);
            
            return response()->json([
                'status' => 'success', 
                'message' => "Request Successful"
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'fail', 'errors' => $e->validator->errors()], 422);
        } 
       
    }
    
    // update data to database
    function update(Request $request, $id)
    {
        try {          
            $request->validate([
                'class_name' => 'required|unique:students_class,class_name,'.$id
            ]);
            DB::table('students_class')->where('id',$request->id)->update([
                'class_name' => $request->class_name
            ]);
            
            return response()->json([
                'status' => 'success', 
                'message' => "Request Successful"
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'fail', 'errors' => $e->validator->errors()], 422);
        } 
       
    }

    // remove data from storage device
    function destroy($id)
    {
        DB::table('students_class')->where('id',$id)->delete();
        return response()->json([
            'status' => 'success', 
            'message' => "Request Successful"
        ]);
    }
    

}
