@extends('layouts.app')

@section('title', 'Detalhes do Estudante')

@section('content')

<div class="page-header">
    <div>
        <a href="{{ route('students.index') }}" class="btn-secondary-custom" style="margin-bottom:0.75rem;display:inline-flex">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <h1 class="page-title" style="margin:0">
            <i class="bi bi-person-badge"></i> Detalhes do Estudante
        </h1>
    </div>
    <a href="{{ route('students.edit', $student->id) }}" class="btn-primary-custom">
        <i class="bi bi-pencil"></i> Editar
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="app-card" style="padding:0">
            {{-- Avatar header --}}
            <div style="padding:2rem;text-align:center;border-bottom:1px solid var(--border-color);background:linear-gradient(180deg,rgba(79,142,247,0.05) 0%,transparent 100%)">
                <div style="width:72px;height:72px;border-radius:50%;background:linear-gradient(135deg,var(--accent-blue),var(--accent-purple));margin:0 auto;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-person-fill" style="color:#fff;font-size:2rem"></i>
                </div>
                <h3 style="margin-top:0.9rem;font-weight:700;font-size:1.2rem">{{ $student->name }}</h3>
                <span style="font-size:0.78rem;background:rgba(79,142,247,0.12);color:var(--accent-blue);border-radius:20px;padding:3px 12px">ID #{{ $student->id }}</span>
            </div>

            {{-- Info rows --}}
            <div style="padding:0 1.5rem">
                <div class="detail-row">
                    <div class="detail-icon" style="background:rgba(34,211,238,0.1)">
                        <i class="bi bi-envelope-fill" style="color:var(--accent-cyan)"></i>
                    </div>
                    <div>
                        <div class="detail-label">Email</div>
                        <div class="detail-value">{{ $student->email }}</div>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-icon" style="background:rgba(16,185,129,0.1)">
                        <i class="bi bi-telephone-fill" style="color:var(--accent-green)"></i>
                    </div>
                    <div>
                        <div class="detail-label">Telefone</div>
                        <div class="detail-value">{{ $student->phone }}</div>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-icon" style="background:rgba(139,92,246,0.1)">
                        <i class="bi bi-calendar3" style="color:var(--accent-purple)"></i>
                    </div>
                    <div>
                        <div class="detail-label">Registado em</div>
                        <div class="detail-value">{{ $student->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-icon" style="background:rgba(245,158,11,0.1)">
                        <i class="bi bi-clock-history" style="color:var(--accent-yellow)"></i>
                    </div>
                    <div>
                        <div class="detail-label">Última actualização</div>
                        <div class="detail-value">{{ $student->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <div style="padding:1.25rem 1.5rem;display:flex;gap:0.75rem">
                <a href="{{ route('students.index') }}" class="btn-secondary-custom" style="flex:1;justify-content:center">
                    <i class="bi bi-list-ul"></i> Lista
                </a>
                <a href="{{ route('students.edit', $student->id) }}" class="btn-primary-custom" style="flex:1;justify-content:center">
                    <i class="bi bi-pencil"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
