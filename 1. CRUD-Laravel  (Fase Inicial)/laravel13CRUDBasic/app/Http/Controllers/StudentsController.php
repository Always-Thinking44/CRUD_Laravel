<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Validation\Rule;

class StudentsController extends Controller
{
    //
    public function index(){
        $students = Student::orderBy('created_at', 'desc')->paginate(7);
        return view('students.index', compact('students'));
    }
    public function create(){
        return view('students.create');
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|min:2|max:255',
        'email'=> 'required|email|unique:students,email',
        'phone'=> 'required|digits:9|unique:students,phone',
        'image'=> 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    if ($request->hasFile('image')) {

        $path = $request->file('image')->store(
            'students',
            'public'
        );

        $validated['image'] = $path;
    }

    Student::create($validated);

    return redirect()
            ->route('students.index')
            ->with('success','Student added successfully');
}

    public function show(Student $student){
        //$student = Student::findOrFail($id);
        //dd($student);
        return view('students.show', compact('student'));
    }

    public function edit(Student $student){
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student){
        //validate data
        $request->validate([
        'name' => 'required|string|min:2|max:255',
        'email'=> ['required',
                    'email',
                    Rule::unique('students', 'email')->ignore($student->id)

                ],
        'phone'=> ['required',
                    'digits:9',
                    Rule::unique('students', 'phone')->ignore($student->id)
                ],
        ]);

        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated sucessfully');

    }

    public function destroy(Student $student){
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student Deleted sucessfully');
    }
}

