<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TurmaController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('layouts.home');
});

//student routes

//display all the students
Route::get('/students', [StudentsController::class, 'index'])
    ->name('students.index');

//route to display the form for creating a sutdent

//route to store a student in the table
Route::post('/students', [StudentsController::class, 'store'])->name('students.store');

//Show details of a specific student by ID
Route::get('/students/{student}', [StudentsController::class, 'show'])->name('students.show');

Route::get('/students/{student}/edit', [StudentsController::class, 'edit'])->name('students.edit');

Route::put('/students/{student}', [StudentsController::class, 'update'])->name('students.update');

Route::delete('/students/{student}', [StudentsController::class, 'destroy'])->name('students.destroy');


Route::get('/turmas', [TurmaController::class, 'index'])
    ->name('turmas.index');

Route::post('/turmas', [TurmaController::class, 'store'])
    ->name('turmas.store');

Route::put('/turmas/{turma}', [TurmaController::class, 'update'])
    ->name('turmas.update');

Route::delete('/turmas/{turma}', [TurmaController::class, 'destroy'])
    ->name('turmas.destroy');
