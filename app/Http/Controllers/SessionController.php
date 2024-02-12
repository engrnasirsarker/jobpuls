<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use DB;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $rows = DB::table('sessions')->get();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (ValidationException $e) {
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
                'session_name' => 'required|unique:sessions,session_name',
            ]);
            DB::table('sessions')->insert([
                'session_name' => $request->session_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return response()->json(['status' => 'success', 'message' => 'session added successfully']);
        } catch(ValidationException $e) {
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
                'session_name' => 'required|unique:sessions,session_name,'.$id,
            ]);
            DB::table('sessions')->where('id', $id)->update([
                'session_name' => $request->session_name,
                'updated_at' => Carbon::now(),
            ]);
            return response()->json(['status' => 'success', 'message' => 'session updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'errors' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('sessions')->where('id',$id)->delete();
        return response()->json([
            'status' => 'success', 
            'message' => "Request Successful"
        ]);
    }
}
