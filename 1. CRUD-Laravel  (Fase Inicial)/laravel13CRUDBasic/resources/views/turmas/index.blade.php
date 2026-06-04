@extends('layouts.app')

@section('content')

<style>
    /* ── Reset & base ─────────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; }

    body {
        background: #f4f1ec;
        color: #1e1b17;
        font-family: 'DM Sans', sans-serif;
    }

    /* ── Page wrapper ─────────────────────────────────────── */
    .t-page {
        max-width: 760px;
        margin: 2.5rem auto;
        padding: 0 1.25rem;
    }

    /* ── Header ───────────────────────────────────────────── */
    .t-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        gap: 1rem;
    }

    .t-title {
        font-family: 'Lora', Georgia, serif;
        font-size: 1.9rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: #1e1b17;
        margin: 0;
    }

    /* ── Primary button ───────────────────────────────────── */
    .t-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: #1e1b17;
        color: #f4f1ec;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.15s, transform 0.1s;
        text-decoration: none;
        white-space: nowrap;
    }
    .t-btn-primary:hover {
        background: #3a3530;
        transform: translateY(-1px);
        color: #f4f1ec;
    }
    .t-btn-primary svg { width: 15px; height: 15px; flex-shrink: 0; }

    /* ── Table card ───────────────────────────────────────── */
    .t-card {
        background: #ffffff;
        border: 1px solid #e2ddd5;
        border-radius: 12px;
        overflow: hidden;
    }

    .t-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    .t-table thead {
        background: #f9f7f3;
        border-bottom: 1px solid #e2ddd5;
    }

    .t-table thead th {
        padding: 0.75rem 1.1rem;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #8a8075;
    }

    .t-table tbody tr {
        border-bottom: 1px solid #f0ece5;
        transition: background 0.12s;
    }
    .t-table tbody tr:last-child { border-bottom: none; }
    .t-table tbody tr:hover { background: #faf8f4; }

    .t-table td {
        padding: 0.8rem 1.1rem;
        color: #1e1b17;
        vertical-align: middle;
    }

    /* ID pill */
    .id-pill {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 600;
        color: #8a8075;
        background: #f0ece5;
        border-radius: 20px;
        padding: 2px 8px;
        font-variant-numeric: tabular-nums;
    }

    /* ── Action buttons ───────────────────────────────────── */
    .t-actions { display: flex; gap: 0.4rem; }

    .t-act {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        border: 1px solid;
        border-radius: 7px;
        padding: 0.3rem 0.65rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.78rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.12s, transform 0.1s;
        background: transparent;
    }
    .t-act:hover { transform: translateY(-1px); }
    .t-act svg { width: 13px; height: 13px; }

    .t-act-edit {
        color: #4a6fa5;
        border-color: #c5d5ec;
    }
    .t-act-edit:hover { background: #eef3fb; }

    .t-act-del {
        color: #b94040;
        border-color: #e8c5c5;
    }
    .t-act-del:hover { background: #fdf0f0; }

    /* ── Empty state ──────────────────────────────────────── */
    .t-empty {
        text-align: center;
        padding: 3rem 1rem;
        color: #a09890;
    }
    .t-empty svg { width: 36px; height: 36px; opacity: 0.4; margin-bottom: 0.75rem; }

    /* ── Modals ───────────────────────────────────────────── */
    .modal-content {
        border: 1px solid #e2ddd5 !important;
        border-radius: 14px !important;
        box-shadow: 0 8px 40px rgba(0,0,0,0.10) !important;
        background: #ffffff;
    }

    .modal-header {
        border-bottom: 1px solid #f0ece5 !important;
        padding: 1.1rem 1.4rem !important;
    }

    .modal-header h5, .modal-title {
        font-family: 'Lora', Georgia, serif;
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e1b17;
        margin: 0;
    }

    .modal-body {
        padding: 1.25rem 1.4rem !important;
    }

    .modal-footer {
        border-top: 1px solid #f0ece5 !important;
        padding: 0.9rem 1.4rem !important;
        gap: 0.5rem;
    }

    /* Form controls inside modal */
    .modal .form-label,
    .modal label {
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #6b6560;
        margin-bottom: 0.35rem;
        display: block;
    }

    .modal .form-control,
    .modal input[type="text"] {
        width: 100%;
        border: 1px solid #ddd8d0;
        border-radius: 8px;
        padding: 0.55rem 0.85rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        color: #1e1b17;
        background: #faf8f4;
        transition: border-color 0.15s, box-shadow 0.15s;
        outline: none;
    }
    .modal .form-control:focus,
    .modal input[type="text"]:focus {
        border-color: #1e1b17;
        box-shadow: 0 0 0 3px rgba(30,27,23,0.07);
        background: #fff;
    }

    /* Modal delete confirm */
    .t-modal-del-icon {
        width: 52px; height: 52px;
        border-radius: 50%;
        background: #fdf0f0;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem;
    }
    .t-modal-del-icon svg { width: 22px; height: 22px; color: #b94040; }

    /* Modal buttons */
    .t-btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: transparent;
        color: #6b6560;
        border: 1px solid #ddd8d0;
        border-radius: 8px;
        padding: 0.48rem 0.95rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.12s;
        text-decoration: none;
    }
    .t-btn-secondary:hover { background: #f4f1ec; color: #1e1b17; }

    .t-btn-danger {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: #b94040;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.48rem 0.95rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.12s;
    }
    .t-btn-danger:hover { background: #9e3535; }

    .t-btn-save {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: #1e1b17;
        color: #f4f1ec;
        border: none;
        border-radius: 8px;
        padding: 0.48rem 0.95rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.12s;
    }
    .t-btn-save:hover { background: #3a3530; }
</style>

{{-- Google Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<div class="t-page">

    <div class="t-header">
        <h2 class="t-title">Turmas</h2>

        <button
            class="t-btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalCreate">
            {{-- plus icon --}}
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nova Turma
        </button>
    </div>

    <div class="t-card">
        <table class="t-table">
            <thead>
                <tr>
                    <th style="width:64px">ID</th>
                    <th>Nome</th>
                    <th style="text-align:right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($turmas as $turma)
                <tr>
                    <td><span class="id-pill">{{ $turma->id }}</span></td>
                    <td>{{ $turma->nome }}</td>
                    <td>
                        <div class="t-actions" style="justify-content:flex-end">
                            <button
                                class="t-act t-act-edit"
                                data-bs-toggle="modal"
                                data-bs-target="#edit{{$turma->id}}">
                                {{-- pencil --}}
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Editar
                            </button>
                            <button
                                class="t-act t-act-del"
                                data-bs-toggle="modal"
                                data-bs-target="#delete{{$turma->id}}">
                                {{-- trash --}}
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                Excluir
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


{{-- ── Modal de cadastro ──────────────────────────────────── --}}
<div class="modal fade" id="modalCreate">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('turmas.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Nova Turmas</h5>
                </div>

                <div class="modal-body">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" placeholder="Ex: Turma A">
                </div>

                <div class="modal-footer">
                    <button type="button" class="t-btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="t-btn-save">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Salvar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


{{-- ── Modais de Edição ───────────────────────────────────── --}}
@foreach($turmas as $turma)
<div class="modal fade" id="edit{{$turma->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('turmas.update',$turma->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Editar Curso</h5>
                </div>

                <div class="modal-body">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" value="{{ $turma->nome }}">
                </div>

                <div class="modal-footer">
                    <button type="button" class="t-btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="t-btn-save">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><polyline points="20 6 9 17 4 12"/></svg>
                        Atualizar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endforeach


{{-- ── Modais de Exclusão ─────────────────────────────────── --}}
@foreach($turmas as $turma)
<div class="modal fade" id="delete{{$turma->id}}">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-header" style="border-bottom:none;padding-bottom:0">
                <h5 class="modal-title" style="font-size:0.95rem">Excluir Curso</h5>
            </div>

            <div class="modal-body" style="text-align:center;padding-top:0.5rem">
                <div class="t-modal-del-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                </div>
                <p style="font-size:0.9rem;color:#6b6560;margin:0">
                    Deseja realmente excluir <strong style="color:#1e1b17">{{ $turma->nome }}</strong>?
                </p>
            </div>

            <div class="modal-footer" style="justify-content:center">
                <form action="{{ route('turmas.destroy',$turma->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div style="display:flex;gap:0.5rem">
                        <button type="button" class="t-btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="t-btn-danger">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                            Excluir
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endforeach

@endsection
