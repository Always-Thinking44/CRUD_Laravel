@extends('layouts.app')

@section('title', 'Estudantes Eliminados - Lixeira')

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
    .s-title svg { width: 26px; height: 26px; color: var(--red); }

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

    .id-pill {
        display: inline-block;
        font-size: 0.7rem; font-weight: 600;
        color: var(--ink-faint); background: #f0ece5;
        border-radius: 20px; padding: 2px 8px;
        font-variant-numeric: tabular-nums;
    }

    .s-avatar {
        width: 36px; height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 1.5px solid var(--border);
    }

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

    .ra-restore { color: var(--green); border-color: #b8dfc9; }
    .ra-restore:hover { background: var(--green-bg); }
    .ra-del { color: var(--red); border-color: var(--red-bdr); }
    .ra-del:hover { background: var(--red-bg); }

    /* ── Empty state ────────────────────────────────────────── */
    .empty-state {
        text-align: center; padding: 3.5rem 1rem; color: var(--ink-faint);
    }
    .empty-state svg { width: 40px; height: 40px; opacity: 0.35; margin-bottom: 0.75rem; display: block; margin-inline: auto; }
    .empty-state p { font-size: 0.9rem; margin: 0; }

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
    .modal-body   { padding: 1.25rem 1.4rem !important; }
    .modal-footer { border-top: 1px solid var(--border-lt) !important; padding: 0.9rem 1.4rem !important; gap: 0.5rem; }

    .m-close {
        width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        background: transparent; border: 1px solid var(--border);
        border-radius: 6px; cursor: pointer; margin-left: auto;
        color: var(--ink-muted); transition: background 0.12s;
    }
    .m-close:hover { background: #f0ece5; color: var(--ink); }
    .m-close svg { width: 13px; height: 13px; }

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
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
            Lixeira de Estudantes
        </h1>
        <div class="s-header-actions">
            <a href="{{ route('students.index') }}" class="btn-ink">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Voltar aos Estudantes
            </a>
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
                    <th>Turma</th>
                    <th>Eliminado em</th>
                    <th style="text-align:right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                <tr>
                    <td><span class="id-pill">{{ $student->id }}</span></td>
                    <td>
                        @if($student->image)
                            <img src="{{ asset('storage/'.$student->image) }}" class="s-avatar" width="36" height="36">
                        @else
                            <div class="s-avatar" style="background:#ece9e3;display:flex;align-items:center;justify-content:center">
                                <svg viewBox="0 0 24 24" fill="none" stroke="#a09890" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                        @endif
                    </td>
                    <td class="s-name">{{ $student->name }}</td>
                    <td class="s-sub">{{ $student->email }}</td>
                    <td class="s-sub">{{ $student->turma->nome ?? 'Sem Turma' }}</td>
                    <td class="s-sub" style="color: var(--red)">{{ $student->deleted_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="row-actions">
                            {{-- Restaurar --}}
                            <form action="{{ url('students/'.$student->id.'/restore') }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="ra ra-restore" title="Restaurar estudante">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                                </button>
                            </form>

                            {{-- Forçar Eliminação --}}
                            <button class="ra ra-del force-delete-btn"
                                title="Eliminar Definitivamente"
                                data-id="{{ $student->id }}"
                                data-name="{{ $student->name }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                            <p>A lixeira está vazia.</p>
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
{{-- MODAL: FORCE DELETE CONFIRM (PERMANENT)                    --}}
{{-- ══════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="forceDeleteStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-header" style="border-bottom:none;padding-bottom:0">
                <button type="button" class="m-close ms-auto" data-bs-dismiss="modal">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </                button>
            </div>

            <div class="modal-body" style="text-align:center;padding-top:0.25rem">
                <div class="del-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                </div>
                <h5 style="font-family:'Lora',serif;font-weight:600;font-size:1rem;margin-bottom:0.4rem">Destruir Registo?</h5>
                <p style="color:var(--ink-muted);font-size:0.85rem;margin:0">
                    Atenção: <strong id="forceDeleteStudentName" style="color:var(--ink)">—</strong> será apagado do sistema permanentemente. Esta ação **não tem retorno**.
                </p>
            </div>

            <div class="modal-footer" style="justify-content:center;gap:0.6rem">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancelar</button>
                <form id="forceDeleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete-confirm">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                        Apagar de Vez
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Gatilho para abrir o modal de exclusão permanente via JS e injetar a rota correta
        const forceDeleteButtons = document.querySelectorAll('.force-delete-btn');
        const forceDeleteModal = new bootstrap.Modal(document.getElementById('forceDeleteStudentModal'));
        const forceDeleteForm = document.getElementById('forceDeleteForm');
        const forceDeleteNameSpan = document.getElementById('forceDeleteStudentName');

        forceDeleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');

                // Ajuste para a rota de exclusão forçada (mude se sua nomenclatura de rotas diferir)
                forceDeleteForm.action = `/students/${id}/force-delete`;
                forceDeleteNameSpan.textContent = name;

                forceDeleteModal.show();
            });
        });
    });
</script>

@endsection


