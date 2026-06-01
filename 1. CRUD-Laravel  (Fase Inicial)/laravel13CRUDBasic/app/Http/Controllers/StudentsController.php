<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Turma;

class StudentsController extends Controller
{
    //
    public function index(){
        $students = Student::orderBy('created_at', 'desc')->paginate(7);
        $turmas = Turma::all();
        return view('students.index', compact(
        'students',
        'turmas'
    ));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|min:2|max:255',
        'email'=> 'required|email|unique:students,email',
        'phone'=> 'required|digits:9|unique:students,phone',
        'image'=> 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'turma_id' => 'required|exists:turmas,id'
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

    public function edit(Student $student) {
    $turmas = Turma::orderBy('nome')->get();
    return view('students.edit', compact('student', 'turmas'));
}

    public function update(Request $request, Student $student)
{
    // CORREÇÃO: Adicionado o "$validated =" antes de $request->validate
    $validated = $request->validate([
        'name' => 'required|string|min:2|max:255',
        'email'=> [
            'required',
            'email',
            Rule::unique('students', 'email')->ignore($student->id)
        ],
        'phone'=> [
            'required',
            'digits:9',
            Rule::unique('students', 'phone')->ignore($student->id)
        ],
        'image'=> 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'turma_id' => 'required|exists:turmas,id'
    ]);

    if ($request->hasFile('image')) {
        // OPCIONAL (Boa prática): Deleta a imagem antiga do servidor para não acumular lixo
        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }

        $path = $request->file('image')->store('students', 'public');
        $validated['image'] = $path;
    }


    $student->update($validated);

    return redirect()->route('students.index')->with('success', 'Student updated successfully');
}

    public function destroy(Student $student){
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student Deleted sucessfully');
    }
}

