<?php

namespace App\Http\Controllers;

use App\Models\Student; // Assuming you have a Student model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.index');
    }

    public function fetchStudents()
    {
        $students = Student::all();
        return response()->json([
            'students' => $students,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'student_name' => 'required|max:191',
                'subject' => 'required|max:191',
                'marks' => 'required|integer|min:0|max:100',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            } else {
                $student = Student::where('student_name', $request->input('student_name'))
                                  ->where('subject', $request->input('subject'))
                                  ->first();
    
                if ($student) {
                    $student->marks = $request->input('marks');
                    $student->update();
    
                    return response()->json([
                        'status' => 200,
                        'message' => 'Marks updated successfully.',
                    ]);
                } else {
                    $student = new Student;
                    $student->student_name = $request->input('student_name');
                    $student->subject = $request->input('subject');
                    $student->marks = $request->input('marks');
                    $student->save();
    
                    return response()->json([
                        'status' => 200,
                        'message' => 'Student added successfully.',
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }    

    public function edit($id)
    {
        try {
            $student = Student::find($id);
            if ($student) {
                return response()->json([
                    'status' => 200,
                    'student' => $student,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Student Found.',
                ]);
            }
        } catch (\Exception $e) {
            return response([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'student_name' => 'required|max:191',
                'subject' => 'required|max:191',
                'marks' => 'required|integer|min:0|max:100',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            } else {
                $student = Student::find($id);
                if ($student) {
                    $student->student_name = $request->input('student_name');
                    $student->subject = $request->input('subject');
                    $student->marks = $request->input('marks');
                    $student->update();

                    return response()->json([
                        'status' => 200,
                        'message' => 'Student Updated Successfully.',
                    ]);
                } else {
                    return response()->json([
                        'status' => 404,
                        'message' => 'No Student Found.',
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $student = Student::find($id);
            if ($student) {
                $student->delete();

                return response()->json([
                    'status' => 200,
                    'message' => 'Student Deleted Successfully.',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Student Found.',
                ]);
            }
        } catch (\Exception $e) {
            return response([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }
}
