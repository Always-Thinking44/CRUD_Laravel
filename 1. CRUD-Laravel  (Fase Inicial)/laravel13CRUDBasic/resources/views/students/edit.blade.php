@extends('layouts.app')

@section('title', 'Editar Estudante')

@section('content')

{{-- Page header --}}
<div class="page-header">
    <div>
        <a href="{{ route('students.index') }}" class="btn-secondary-custom" style="margin-bottom:0.75rem;display:inline-flex">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <h1 class="page-title" style="margin:0">
            <i class="bi bi-pencil-square"></i> Editar Estudante
        </h1>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="app-card" style="padding:0">

            {{-- Card header with avatar --}}
            <div style="padding:1rem 1rem 1rem;border-bottom:1px solid var(--border-color);display:flex;align-items:center;justify-content:center;">

                <img style="width:60px;height:60px;border-radius:50%" src="{{ asset('storage/'.$student->image) }}" alt="">

            </div>

            {{-- Form --}}
            <form action="{{ route('students.update', $student->id) }}" method="POST" style="padding:1.5rem" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if ($errors->any())
                <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:10px;padding:0.75rem 1rem;margin-bottom:1.25rem;font-size:0.85rem;color:var(--accent-red)">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                    Por favor corrija os erros abaixo.
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-person me-1"></i>Nome
                    </label>
                    <input type="text" name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $student->name) }}"
                        placeholder="Nome completo">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-envelope me-1"></i>Email
                    </label>
                    <input type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $student->email) }}"
                        placeholder="email@exemplo.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-telephone me-1"></i>Telefone
                    </label>
                    <input type="number" name="phone"
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $student->phone) }}"
                        placeholder="9XXXXXXXX">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                 <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-person-circle me-1"></i>Image
                    </label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display:flex;gap:0.75rem">
                    <a href="{{ route('students.index') }}" class="btn-secondary-custom" style="flex:1;justify-content:center">
                        <i class="bi bi-x"></i> Cancelar
                    </a>
                    <button type="submit" class="btn-primary-custom" style="flex:1;justify-content:center">
                        <i class="bi bi-floppy"></i> Guardar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
