<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rotas de perfil do Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔒 Todas as rotas do CRUD, agora protegidas por autenticação
Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        return view('layouts.home');
    });

    // student routes
    Route::get('/students', [StudentsController::class, 'index'])
        ->name('students.index');

    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/trash', [StudentsController::class, 'trash'])->name('trash');
        Route::patch('/{id}/restore', [StudentsController::class, 'restore'])->name('restore');
        Route::delete('/{id}/force-delete', [StudentsController::class, 'forceDelete'])->name('force-delete');
    });

    Route::post('/students', [StudentsController::class, 'store'])->name('students.store');
    Route::get('/students/{student}', [StudentsController::class, 'show'])->name('students.show');
    Route::get('/students/{student}/edit', [StudentsController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentsController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentsController::class, 'destroy'])->name('students.destroy');

    Route::resource('students', StudentsController::class);

    // turma routes
    Route::get('/turmas', [TurmaController::class, 'index'])->name('turmas.index');
    Route::post('/turmas', [TurmaController::class, 'store'])->name('turmas.store');
    Route::put('/turmas/{turma}', [TurmaController::class, 'update'])->name('turmas.update');
    Route::delete('/turmas/{turma}', [TurmaController::class, 'destroy'])->name('turmas.destroy');
});

require __DIR__.'/auth.php';
