<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $student = Student::with('academic')->get();
        $student = Student::with('country')->get();
        return response()->json(['student'=> $student]);
    }
    public function create (){
        return view('student.create');
    }
    public function store(Request $request) {
        $student = Student::create($request->all());
        $student -> academic()->create($request->input('academic'));
        $student -> country()->create($request->input('country'));

    }
    public function update(Request $request, $id) {
        $student = Student::find($id);
        $student -> update($request->all());
        $student -> academic()->update($request->input('academic'));
        $student -> country()->update($request->input('country'));
        return response()->json(['student' => $student]);
    }

    public function destroy($id) {
        $student = Student::find($id);
        $student -> academic()->delete();
        $student -> country()->delete();
        $student->delete();
        return response()->json(['message' => "Deletion succesful!"]);
    }
}
