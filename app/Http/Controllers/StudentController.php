<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $jsonData = json_encode(['status' => 200, 'data' => $students], JSON_PRETTY_PRINT);
        return response($jsonData)->header('Content-Type', 'application/json');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        $jsonData = json_encode(['status' => 200, 'data' => $student], JSON_PRETTY_PRINT);
        return response($jsonData)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'course' => 'required',
            'email' => 'required|email|unique:students,email', // Use 'students' table for uniqueness check
            'phone' => 'required|numeric|unique:students,phone', // Use 'students' table for uniqueness check
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $student = Student::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        }

        if ($student) {
            return response()->json([
                'status' => 200,
                'success' => 'Student Added Succesfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'error' => 'Something Went Wrong'
            ], 500);
        }
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'course' => 'required',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|numeric|unique:students,phone,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        }

        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'status' => 200,
            'success' => 'Student Updated Successfully'
        ], 200);
    }

    public function delete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json([
            'status' => 200,
            'success' => 'Student deleted successfully.'
        ]);
    }
}
