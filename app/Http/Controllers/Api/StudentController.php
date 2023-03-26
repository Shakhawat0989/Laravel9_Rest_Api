<?php

namespace App\Http\Controllers\Api;


use App\Models\student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){

        $students =student::all();

        if($students->count()> 0){

            return response()->json([
            'status' => 200,
            'students' => $students
        ],200);
        }else{

            return response()->json([
            'status' => 404,
            'message' => 'No Records Found'
        ],404);
        }


}
   public function store(Request $request){

    $validator = Validator::make($request->all(),[
        'name'=> 'required|string|max:100',
        'course'=> 'required|string|max:100',
        'email'=> 'required|email|max:100',
        'phone'=> 'required|digits:11',
    ]);

    if($validator->fails()){
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages()
        ],422);
    }else{
        $student = student::create([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        if($student){

            return response()->json([
                'status' => 200,
                'message' => 'Student Created Successfully'
            ],200);

        }else{

             return response()->json([
                'status' => 500,
                'message' => 'Something Went Worng'
            ],500);

        }
    }
   }

   public function show($id){

    $student = student::find($id);
    if($student){
           return response()->json([
                'status' => 200,
                'student' => $student
            ],200);

    }else{
          return response()->json([
                'status' => 404,
                'message' => 'No Such Student Found'
            ],404);
    }
   }

   public function edit($id) {

    $student = student::find($id);
    if($student){
           return response()->json([
                'status' => 200,
                'student' => $student
            ],200);

    }else{
          return response()->json([
                'status' => 404,
                'message' => 'No Such Student Found'
            ],404);
    }
   }

   public function update(Request $request, int $id){

    $validator = Validator::make($request->all(),[
        'name'=> 'required|string|max:100',
        'course'=> 'required|string|max:100',
        'email'=> 'required|email|max:100',
        'phone'=> 'required|digits:11',
    ]);

    if($validator->fails()){
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages()
        ],422);
    }else{
        $student = student::find($id);

        if($student){
            $student->update([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

            return response()->json([
                'status' => 200,
                'message' => 'Student Updated Successfully'
            ],200);

        }else{

             return response()->json([
                'status' => 404,
                'message' => 'Student Not Updated'
            ],404);

        }
    }
   }

   public function delete($id){

    $student = student::find($id);

    if($student){

        $student->delete();
          return response()->json([
                'status' => 200,
                'message' => 'Student Deleted Successfully'
            ],200);

    }else{
         return response()->json([
                'status' => 404,
                'message' => 'Student Not Updated'
            ],404);
    }
   }
}
