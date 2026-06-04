@extends('layouts.app')

@section('title', 'Estudantes')

@section('content')

<style>
    /* ── Reset & tokens ─────────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; }

    :root {
        --bg:        #f4f1ec;
        --surface:   #ffffff;
        --border:    #e2ddd5;
        --border-lt: #f0ece5;
        --ink:       #1e1b17;
        --ink-muted: #6b6560;
        --ink-faint: #a09890;
        --blue:      #4a6fa5;
        --blue-bg:   #eef3fb;
        --blue-bdr:  #c5d5ec;
        --red:       #b94040;
        --red-bg:    #fdf0f0;
        --red-bdr:   #e8c5c5;
        --green:     #3d7a5c;
        --green-bg:  #eef7f2;
    }

    body { background: var(--bg); color: var(--ink); font-family: 'DM Sans', sans-serif; }

    /* ── Page ───────────────────────────────────────────────── */
    .s-page {
        max-width: 980px;
        margin: 2.5rem auto;
        padding: 0 1.25rem;
    }

    /* ── Page header ────────────────────────────────────────── */
    .s-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .s-title {
        font-family: 'Lora', Georgia, serif;
        font-size: 1.9rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: var(--ink);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.55rem;
    }
    .s-title svg { width: 26px; height: 26px; color: var(--ink-muted); }

    .s-header-actions { display: flex; align-items: center; gap: 0.5rem; }

    /* ── Buttons ────────────────────────────────────────────── */
    .btn-ink {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: var(--ink); color: var(--bg);
        border: none; border-radius: 8px;
        padding: 0.5rem 1rem;
        font-family: 'DM Sans', sans-serif; font-size: 0.875rem; font-weight: 500;
        cursor: pointer; text-decoration: none; white-space: nowrap;
        transition: background 0.14s, transform 0.1s;
    }
    .btn-ink:hover { background: #3a3530; transform: translateY(-1px); color: var(--bg); }
    .btn-ink svg { width: 15px; height: 15px; }

    .btn-outline {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: transparent; color: var(--ink-muted);
        border: 1px solid var(--border); border-radius: 8px;
        padding: 0.48rem 0.9rem;
        font-family: 'DM Sans', sans-serif; font-size: 0.875rem; font-weight: 500;
        cursor: pointer; text-decoration: none; white-space: nowrap;
        transition: background 0.12s;
    }
    .btn-outline:hover { background: #ece9e3; color: var(--ink); }
    .btn-outline svg { width: 15px; height: 15px; }

    /* ── Success alert ──────────────────────────────────────── */
    .alert-ok {
        display: flex; align-items: center; gap: 0.6rem;
        background: var(--green-bg); border: 1px solid #b8dfc9;
        border-radius: 10px; padding: 0.7rem 1rem;
        font-size: 0.875rem; color: var(--green);
        margin-bottom: 1.25rem;
    }
    .alert-ok svg { width: 16px; height: 16px; flex-shrink: 0; }

    /* ── Card & table ───────────────────────────────────────── */
    .s-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
    }

    .s-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.895rem;
    }

    .s-table thead {
        background: #f9f7f3;
        border-bottom: 1px solid var(--border);
    }
    .s-table thead th {
        padding: 0.7rem 1rem;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.09em;
        text-transform: uppercase;
        color: var(--ink-faint);
    }

    .s-table tbody tr {
        border-bottom: 1px solid var(--border-lt);
        transition: background 0.1s;
    }
    .s-table tbody tr:last-child { border-bottom: none; }
    .s-table tbody tr:hover { background: #faf8f4; }

    .s-table td {
        padding: 0.75rem 1rem;
        vertical-align: middle;
    }

    /* ID pill */
    .id-pill {
        display: inline-block;
        font-size: 0.7rem; font-weight: 600;
        color: var(--ink-faint); background: #f0ece5;
        border-radius: 20px; padding: 2px 8px;
        font-variant-numeric: tabular-nums;
    }

    /* Avatar image */
    .s-avatar {
        width: 36px; height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 1.5px solid var(--border);
    }

    /* Name cell */
    .s-name { font-weight: 500; color: var(--ink); }
    .s-sub  { font-size: 0.82rem; color: var(--ink-muted); }

    /* ── Row actions ────────────────────────────────────────── */
    .row-actions { display: flex; gap: 0.35rem; justify-content: flex-end; }

    .ra {
        width: 30px; height: 30px;
        display: inline-flex; align-items: center; justify-content: center;
        border: 1px solid; border-radius: 7px;
        background: transparent; cursor: pointer;
        transition: background 0.12s, transform 0.1s;
        padding: 0;
    }
    .ra:hover { transform: translateY(-1px); }
    .ra svg { width: 14px; height: 14px; }

    .ra-view  { color: var(--ink-muted); border-color: var(--border); }
    .ra-view:hover  { background: #f0ece5; color: var(--ink); }
    .ra-edit  { color: var(--blue);       border-color: var(--blue-bdr); }
    .ra-edit:hover  { background: var(--blue-bg); }
    .ra-del   { color: var(--red);        border-color: var(--red-bdr); }
    .ra-del:hover   { background: var(--red-bg); }

    /* ── Empty state ────────────────────────────────────────── */
    .empty-state {
        text-align: center; padding: 3.5rem 1rem; color: var(--ink-faint);
    }
    .empty-state svg { width: 40px; height: 40px; opacity: 0.35; margin-bottom: 0.75rem; display: block; margin-inline: auto; }
    .empty-state p { font-size: 0.9rem; margin: 0 0 1.25rem; }

    /* ── Pagination ─────────────────────────────────────────── */
    .s-pagination { margin-top: 1rem; display: flex; justify-content: flex-end; }

    /* ── Modals base ────────────────────────────────────────── */
    .modal-content {
        border: 1px solid var(--border) !important;
        border-radius: 14px !important;
        box-shadow: 0 10px 48px rgba(0,0,0,0.10) !important;
        background: var(--surface);
    }
    .modal-header {
        border-bottom: 1px solid var(--border-lt) !important;
        padding: 1.1rem 1.4rem !important;
        align-items: center;
    }
    .modal-title {
        font-family: 'Lora', Georgia, serif;
        font-size: 1.1rem; font-weight: 600; color: var(--ink);
        margin: 0;
    }
    .modal-body    { padding: 1.25rem 1.4rem !important; }
    .modal-footer  { border-top: 1px solid var(--border-lt) !important; padding: 0.9rem 1.4rem !important; gap: 0.5rem; }

    /* Close btn */
    .m-close {
        width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        background: transparent; border: 1px solid var(--border);
        border-radius: 6px; cursor: pointer; margin-left: auto;
        color: var(--ink-muted); transition: background 0.12s;
    }
    .m-close:hover { background: #f0ece5; color: var(--ink); }
    .m-close svg { width: 13px; height: 13px; }

    /* Form inside modal */
    .m-label {
        display: block;
        font-size: 0.72rem; font-weight: 600;
        letter-spacing: 0.07em; text-transform: uppercase;
        color: var(--ink-muted); margin-bottom: 0.35rem;
    }
    .m-input {
        width: 100%;
        border: 1px solid #ddd8d0; border-radius: 8px;
        padding: 0.55rem 0.85rem;
        font-family: 'DM Sans', sans-serif; font-size: 0.9rem; color: var(--ink);
        background: #faf8f4; outline: none;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .m-input:focus { border-color: var(--ink); box-shadow: 0 0 0 3px rgba(30,27,23,0.07); background: #fff; }
    .m-input.is-invalid { border-color: var(--red); }
    .invalid-feedback { font-size: 0.78rem; color: var(--red); margin-top: 0.3rem; }

    .m-select {
        width: 100%;
        border: 1px solid #ddd8d0; border-radius: 8px;
        padding: 0.55rem 0.85rem;
        font-family: 'DM Sans', sans-serif; font-size: 0.9rem; color: var(--ink);
        background: #faf8f4; outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238a8075' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        cursor: pointer;
    }

    /* Error banner */
    .m-error-banner {
        background: rgba(185,64,64,0.08); border: 1px solid rgba(185,64,64,0.25);
        border-radius: 8px; padding: 0.65rem 0.9rem;
        font-size: 0.82rem; color: var(--red); margin-bottom: 1rem;
        display: flex; align-items: center; gap: 0.5rem;
    }
    .m-error-banner svg { width: 14px; height: 14px; flex-shrink: 0; }

    /* Modal footer buttons */
    .btn-save {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: var(--ink); color: var(--bg);
        border: none; border-radius: 8px;
        padding: 0.48rem 1rem;
        font-family: 'DM Sans', sans-serif; font-size: 0.875rem; font-weight: 500;
        cursor: pointer; transition: background 0.12s;
    }
    .btn-save:hover { background: #3a3530; }
    .btn-save svg { width: 14px; height: 14px; }

    .btn-cancel {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: transparent; color: var(--ink-muted);
        border: 1px solid var(--border); border-radius: 8px;
        padding: 0.46rem 0.95rem;
        font-family: 'DM Sans', sans-serif; font-size: 0.875rem; font-weight: 500;
        cursor: pointer; transition: background 0.12s;
    }
    .btn-cancel:hover { background: #f0ece5; color: var(--ink); }

    .btn-delete-confirm {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: var(--red); color: #fff;
        border: none; border-radius: 8px;
        padding: 0.48rem 1rem;
        font-family: 'DM Sans', sans-serif; font-size: 0.875rem; font-weight: 500;
        cursor: pointer; transition: background 0.12s;
    }
    .btn-delete-confirm:hover { background: #9e3535; }
    .btn-delete-confirm svg { width: 14px; height: 14px; }

    /* ── View modal detail rows ─────────────────────────────── */
    .detail-row {
        display: flex; align-items: flex-start; gap: 0.85rem;
        padding: 0.7rem 0;
        border-bottom: 1px solid var(--border-lt);
    }
    .detail-row:last-child { border-bottom: none; }
    .detail-icon {
        width: 34px; height: 34px; flex-shrink: 0;
        border-radius: 8px; display: flex; align-items: center; justify-content: center;
        background: #f0ece5;
    }
    .detail-icon svg { width: 15px; height: 15px; }
    .detail-label { font-size: 0.72rem; font-weight: 600; letter-spacing: 0.07em; text-transform: uppercase; color: var(--ink-faint); margin-bottom: 0.15rem; }
    .detail-value { font-size: 0.9rem; color: var(--ink); }

    /* View modal avatar */
    .view-avatar {
        width: 60px; height: 60px; border-radius: 50%;
        background: #ece9e3; border: 2px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto;
    }
    .view-avatar svg { width: 26px; height: 26px; color: var(--ink-faint); }

    /* Delete modal icon */
    .del-icon-wrap {
        width: 52px; height: 52px; border-radius: 50%;
        background: var(--red-bg); display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem;
    }
    .del-icon-wrap svg { width: 22px; height: 22px; color: var(--red); }
</style>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<div class="s-page">

    {{-- ── Header ──────────────────────────────────────────── --}}
    <div class="s-header">
        <h1 class="s-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Estudantes
        </h1>
        <div class="s-header-actions">
            <a href="{{ route('turmas.index') }}" class="btn-outline">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                Turmas
            </a>
            <button class="btn-ink" data-bs-toggle="modal" data-bs-target="#createStudentModal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Adicionar Estudante
            </button>
        </div>
    </div>

    {{-- ── Success alert ────────────────────────────────────── --}}
    @session('success')
        <div class="alert-ok">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            <span>{{ $value }}</span>
        </div>
    @endsession

    {{-- ── Table card ──────────────────────────────────────── --}}
    <div class="s-card">
        <table class="s-table">
            <thead>
                <tr>
                    <th style="width:56px">#</th>
                    <th style="width:52px">Foto</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th style="text-align:right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                <tr>
                    <td><span class="id-pill">{{ $student->id }}</span></td>
                    <td>
                        @if($student->image)
                            <img src="{{ asset('storage/'.$student->image) }}"
                                class="s-avatar"
                                width="36" height="36">
                        @else
                            <div class="s-avatar" style="background:#ece9e3;display:flex;align-items:center;justify-content:center">
                                <svg viewBox="0 0 24 24" fill="none" stroke="#a09890" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                        @endif
                    </td>
                    <td class="s-name">{{ $student->name }}</td>
                    <td class="s-sub">{{ $student->email }}</td>
                    <td class="s-sub">{{ $student->phone }}</td>
                    <td>
                        <div class="row-actions">
                            {{-- View --}}
                            <button class="ra ra-view view-btn"
                                title="Ver detalhes"
                                data-id="{{ $student->id }}"
                                data-name="{{ $student->name }}"
                                data-email="{{ $student->email }}"
                                data-phone="{{ $student->phone }}"
                                data-created="{{ $student->created_at->format('d/m/Y H:i') }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            {{-- Edit --}}
                            <a href="{{ route('students.edit', $student->id) }}" class="ra ra-edit" title="Editar">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            {{-- Delete --}}
                            <button class="ra ra-del delete-btn"
                                title="Eliminar"
                                data-id="{{ $student->id }}"
                                data-name="{{ $student->name }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                            <p>Nenhum estudante encontrado.</p>
                            <button class="btn-ink" style="margin:0 auto" data-bs-toggle="modal" data-bs-target="#createStudentModal">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                Adicionar primeiro estudante
                            </button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ── Pagination ───────────────────────────────────────── --}}
    <div class="s-pagination">
        {{ $students->links() }}
    </div>

</div>


{{-- ══════════════════════════════════════════════════════════ --}}
{{-- MODAL: CREATE STUDENT                                      --}}
{{-- ══════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createStudentModalLabel">Novo Estudante</h5>
                <button type="button" class="m-close" data-bs-dismiss="modal" aria-label="Fechar">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <form action="{{ route('students.store') }}" method="POST" id="createForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    @if ($errors->any() && old('_form') === 'create')
                    <div class="m-error-banner">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        Por favor corrija os erros abaixo.
                    </div>
                    @endif

                    <input type="hidden" name="_form" value="create">

                    <div class="mb-3">
                        <label class="m-label">Foto</label>
                        <input type="file" id="image" name="image" class="m-input" accept="image/*" style="padding:0.4rem 0.7rem">
                    </div>

                    <div class="mb-3">
                        <label class="m-label">Nome</label>
                        <input type="text" name="name"
                            class="m-input @error('name') is-invalid @enderror"
                            placeholder="Ex: João Silva"
                            value="{{ old('name') }}">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="m-label">Email</label>
                        <input type="email" name="email"
                            class="m-input @error('email') is-invalid @enderror"
                            placeholder="Ex: joao@email.com"
                            value="{{ old('email') }}">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="m-label">Telefone</label>
                        <input type="number" name="phone"
                            class="m-input @error('phone') is-invalid @enderror"
                            placeholder="Ex: 923456789"
                            value="{{ old('phone') }}">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-1">
                        <label class="m-label">Turma</label>
                        <select name="turma_id" class="m-select">
                            @foreach($turmas as $turma)
                                <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-save">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


{{-- ══════════════════════════════════════════════════════════ --}}
{{-- MODAL: VIEW STUDENT DETAILS                                --}}
{{-- ══════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="viewStudentModalLabel">Detalhes do Estudante</h5>
                <button type="button" class="m-close" data-bs-dismiss="modal" aria-label="Fechar">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <div class="modal-body" style="padding-top:1rem;padding-bottom:0.5rem">
                <div style="text-align:center;margin-bottom:1.25rem">
                    <div class="view-avatar">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <p style="margin-top:0.6rem;font-family:'Lora',serif;font-size:1.1rem;font-weight:600;color:var(--ink)" id="viewName">—</p>
                    <span style="font-size:0.72rem;background:#f0ece5;color:var(--ink-muted);border-radius:20px;padding:2px 10px;font-weight:600" id="viewId">ID #—</span>
                </div>

                <div class="detail-row">
                    <div class="detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#4a6fa5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div>
                        <div class="detail-label">Email</div>
                        <div class="detail-value" id="viewEmail">—</div>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#3d7a5c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.59 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div>
                        <div class="detail-label">Telefone</div>
                        <div class="detail-value" id="viewPhone">—</div>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#8a6a30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div>
                        <div class="detail-label">Registado em</div>
                        <div class="detail-value" id="viewCreated">—</div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Fechar</button>
                <a href="#" id="viewEditLink" class="btn-save">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Editar
                </a>
            </div>

        </div>
    </div>
</div>


{{-- ══════════════════════════════════════════════════════════ --}}
{{-- MODAL: DELETE CONFIRM                                      --}}
{{-- ══════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-header" style="border-bottom:none;padding-bottom:0">
                <button type="button" class="m-close ms-auto" data-bs-dismiss="modal">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <div class="modal-body" style="text-align:center;padding-top:0.25rem">
                <div class="del-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                </div>
                <h5 style="font-family:'Lora',serif;font-weight:600;font-size:1rem;margin-bottom:0.4rem">Eliminar Estudante?</h5>
                <p style="color:var(--ink-muted);font-size:0.85rem;margin:0">
                    Vai eliminar <strong id="deleteStudentName" style="color:var(--ink)">—</strong>. Esta acção não pode ser revertida.
                </p>
            </div>

            <div class="modal-footer" style="justify-content:center;gap:0.6rem">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete-confirm">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                        Eliminar
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── View modal ────────────────────────────────────────────
    const viewBtns = document.querySelectorAll('.view-btn');
    viewBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('viewName').textContent    = this.dataset.name;
            document.getElementById('viewEmail').textContent   = this.dataset.email;
            document.getElementById('viewPhone').textContent   = this.dataset.phone;
            document.getElementById('viewCreated').textContent = this.dataset.created;
            document.getElementById('viewId').textContent      = 'ID #' + this.dataset.id;
            document.getElementById('viewEditLink').href       = '/students/' + this.dataset.id + '/edit';

            new bootstrap.Modal(document.getElementById('viewStudentModal')).show();
        });
    });

    // ── Delete modal ──────────────────────────────────────────
    const deleteBtns = document.querySelectorAll('.delete-btn');
    const deleteForm = document.getElementById('deleteForm');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('deleteStudentName').textContent = this.dataset.name;
            deleteForm.action = '/students/' + this.dataset.id;
            new bootstrap.Modal(document.getElementById('deleteStudentModal')).show();
        });
    });

    // ── Re-open create modal if validation failed ─────────────
    @if ($errors->any() && old('_form') === 'create')
        new bootstrap.Modal(document.getElementById('createStudentModal')).show();
    @endif
});
</script>
@endsection
