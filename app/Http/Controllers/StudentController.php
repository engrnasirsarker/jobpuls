<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\AssignStudent;
use App\Models\User;
use Image;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $students = User::where('user_type', 'user')->get();
            return response()->json(['success' => true, 'rows' => $students]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        dd($request->all());
        $request->validate([
            'name' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'session_id' => 'required',
            'class_id' => 'required',
            'group_id' => 'required',
            'dob' => 'required',
        ],[ //custom validation message
            'dob.required' => 'The date of birth field is required.',
            'fname.required' => 'The Fathers Name field is required.',
            'mname.required' => 'The Mothers Name field is required.',
            'session_id.required' => 'The Session field is required.',
            'class_id.required' => 'The Class field is required.',
            'group_id.required' => 'The Group field is required.',
        ]);
       
        DB::beginTransaction();
        try {
            // insert data in user table
            $user = new User();
            $user->user_type = 'student';
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->gender = $request->gender;
            $user->status = $request->status;
            $user->dob = $request->dob;
            $user->address = $request->address;
            $user->phone = $request->phone;
            if ($request->file('image')) {
                $file = $request->file('image');
                $filename =date('YmdHi').$file->getClientOriginalName();
                    Image::make($file)->resize(500,500)->save('assets/images/students/'.$filename);
                $user['image']=$filename;
            }
            $user->save();
            // insert data in AssignStudent table
            AssignStudent::create([
                'student_id' => $user->id,
                'fees_discount_id' => 1,
                'class_id' => $request->class_id,
                'session_id' => $request->session_id,
                'group_id' => $request->group_id,
            ]);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'status'=>'fail','errors'=>$e->validator->errors()
            ],422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
