<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::orderBy('nome')->get();

        return view('turmas.index', compact('turmas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255'
        ]);

        Turma::create([
            'nome' => $request->nome
        ]);

        return redirect()
            ->route('turmas.index')
            ->with('success', 'Turma cadastrada com sucesso.');
    }

    public function update(Request $request, Turma $turma)
    {
        $request->validate([
            'nome' => 'required|string|max:255'
        ]);

        $turma->update([
            'nome' => $request->nome
        ]);

        return redirect()
            ->route('turmas.index')
            ->with('success', 'Turma atualizada com sucesso.');
    }

    public function destroy(Turma $turma)
    {
        /*
         * Impede apagar turmas que possuem alunos.
         */
        if ($turma->alunos()->exists()) {

            return redirect()
                ->route('turmas.index')
                ->with('error',
                    'Esta turma possui alunos associados.');
        }

        $turma->delete();

        return redirect()
            ->route('turmas.index')
            ->with('success', 'Turma removida com sucesso.');
    }
    public function create() {
        $turmas = Turma::orderBy('nome')->get();
        return view('students.create', compact('turmas'));
    }
}
