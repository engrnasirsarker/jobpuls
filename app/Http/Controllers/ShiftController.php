<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use DB;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $rows = DB::table('shifts')->get();
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
                'shift_name' => 'required|unique:shifts,shift_name',
            ]);
            DB::table('shifts')->insert([
                'shift_name' => $request->shift_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return response()->json(['status' => 'success', 'message' => 'shift added successfully']);
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
                'shift_name' => 'required|unique:shifts,shift_name,'.$id,
            ]);
            DB::table('shifts')->where('id', $id)->update([
                'shift_name' => $request->shift_name,
                'updated_at' => Carbon::now(),
            ]);
            return response()->json(['status' => 'success', 'message' => 'shift updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'errors' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::table('shifts')->where('id',$id)->delete();
            return response()->json([
                'status' => 'success', 
                'message' => "Request Successful"
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'errors' => $e->errors()], 422);
        }
    }
}
