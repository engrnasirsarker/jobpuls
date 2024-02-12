<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Exception;
use DB;

class StudentSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $subject = DB::table('student_subjects')->get();
            return response()->json(['status' => 'success', 'rows' => $subject]);   
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'subject_name' => 'required|unique:student_subjects,subject_name',
            ]);
            DB::table('student_subjects')->insert([
                'subject_name' => $request->subject_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return response()->json(['status' => 'success', 'message' => 'Subject added successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'errors' => $e->errors()], 422);
            
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'subject_name' => 'required|unique:student_subjects,subject_name,'.$id,
            ]);
            DB::table('student_subjects')->where('id',$id)->update([
                'subject_name' => $request->subject_name,
                'updated_at' => Carbon::now(),
            ]);

            return response()->json(['status' => 'success', 'message' => 'Subject updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'errors' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('student_subjects')->where('id',$id)->delete();
        return response()->json([
            'status' => 'success', 
            'message' => "Request Successful"
        ]);
    }
}
