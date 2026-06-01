@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">

        <h2>Cursos</h2>

        <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalCreate">

            Novo Curso
        </button>

    </div>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

            @foreach($turmas as $turma)

            <tr>

                <td>{{ $turma->id }}</td>

                <td>{{ $turma->nome }}</td>

                <td>

                    <button
                        class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#edit{{$turma->id}}">

                        Editar
                    </button>

                    <button
                        class="btn btn-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#delete{{$turma->id}}">

                        Excluir
                    </button>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>



{{-- Modal de cadastro --}}
<div class="modal fade" id="modalCreate">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="{{ route('turmas.store') }}"
                  method="POST">

                @csrf

                <div class="modal-header">
                    <h5>Novo Curso</h5>
                </div>

                <div class="modal-body">

                    <label>Nome</label>

                    <input
                        type="text"
                        name="nome"
                        class="form-control">

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="btn btn-success">

                        Salvar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- Modal de Edição --}}
@foreach($turmas as $turma)

<div class="modal fade" id="edit{{$turma->id}}">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                action="{{ route('turmas.update',$turma->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5>Editar Curso</h5>

                </div>

                <div class="modal-body">

                    <input
                        type="text"
                        name="nome"
                        class="form-control"
                        value="{{ $turma->nome }}">

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Atualizar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endforeach


{{-- Modal de Exclusão --}}
@foreach($turmas as $turma)

<div class="modal fade" id="delete{{$turma->id}}">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Excluir Curso</h5>

            </div>

            <div class="modal-body">

                Deseja realmente excluir:

                <strong>
                    {{ $turma->nome }}
                </strong>?

            </div>

            <div class="modal-footer">

                <form
                    action="{{ route('turmas.destroy',$turma->id) }}"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <button
                        class="btn btn-danger">

                        Excluir
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endforeach
