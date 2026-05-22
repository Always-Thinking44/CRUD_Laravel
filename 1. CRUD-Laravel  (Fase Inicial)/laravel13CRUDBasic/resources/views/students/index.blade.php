@extends('layouts.app')

@section('title', 'Estudantes')

@section('content')

{{-- Page header --}}
<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-people-fill"></i> Estudantes
    </h1>
    <button class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#createStudentModal">
        <i class="bi bi-plus-lg"></i> Adicionar Estudante
    </button>
</div>

{{-- Success alert --}}
@session('success')
    <div class="alert-success-custom mb-3">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ $value }}</span>
    </div>
@endsession

{{-- Table card --}}
<div class="app-card">
    <table class="table app-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th style="text-align:right">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
            <tr>
                <td><span class="id-badge">{{ $student->id }}</span></td>
                <td>
                    @if($student->image)
                        <img src="{{ asset('storage/'.$student->image) }}"
                            width="50"
                            height="50"
                            style="border-radius:50%; object-fit:cover;">
                    @endif
                </td>
                <td style="font-weight:500">{{ $student->name }}</td>
                <td style="color:var(--text-muted)">{{ $student->email }}</td>
                <td style="color:var(--text-muted)">{{ $student->phone }}</td>
                <td>
                    <div style="display:flex; gap:0.4rem; justify-content:flex-end">
                        {{-- View --}}
                        <button class="btn-action btn-view view-btn"
                            data-bs-toggle="tooltip" title="Ver detalhes"
                            data-id="{{ $student->id }}"
                            data-name="{{ $student->name }}"
                            data-email="{{ $student->email }}"
                            data-phone="{{ $student->phone }}"
                            data-created="{{ $student->created_at->format('d/m/Y H:i') }}">
                            <i class="bi bi-eye"></i>
                        </button>

                        {{-- Edit --}}
                        <a href="{{ route('students.edit', $student->id) }}"
                            class="btn-action btn-edit"
                            data-bs-toggle="tooltip" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>

                        {{-- Delete --}}
                        <button class="btn-action btn-delete delete-btn"
                            data-bs-toggle="tooltip" title="Eliminar"
                            data-id="{{ $student->id }}"
                            data-name="{{ $student->name }}">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p style="font-size:0.95rem">Nenhum estudante encontrado.</p>
                        <button class="btn-primary-custom" style="margin:0 auto" data-bs-toggle="modal" data-bs-target="#createStudentModal">
                            <i class="bi bi-plus-lg"></i> Adicionar primeiro estudante
                        </button>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="mt-3 d-flex justify-content-end">
    {{ $students->links() }}
</div>



{{-- MODAL: CREATE STUDENT --}}
<div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:0.6rem">
                    <div style="width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,var(--accent-blue),var(--accent-purple));display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-person-plus-fill" style="color:#fff;font-size:0.85rem"></i>
                    </div>
                    <h5 class="modal-title" id="createStudentModalLabel">Novo Estudante</h5>
                </div>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Fechar">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <form action="{{ route('students.store') }}" method="POST" id="createForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @if ($errors->any() && old('_form') === 'create')
                    <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:10px;padding:0.75rem 1rem;margin-bottom:1rem;font-size:0.85rem;color:var(--accent-red)">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        Por favor corrija os erros abaixo.
                    </div>
                    @endif

                    <input type="hidden" name="_form" value="create">

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-person-circle me-1"></i>Image
                        </label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-person me-1"></i>Nome
                        </label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Ex: João Silva"
                            value="{{ old('name') }}">
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
                            placeholder="Ex: joao@email.com"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-1">
                        <label class="form-label">
                            <i class="bi bi-telephone me-1"></i>Telefone
                        </label>
                        <input type="number" name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            placeholder="Ex: 923456789"
                            value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                        <i class="bi bi-x"></i> Cancelar
                    </button>
                    <button type="submit" class="btn-primary-custom">
                        <i class="bi bi-floppy"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{--  MODAL: VIEW STUDENT DETAILS  --}}
<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:0.6rem">
                    <div style="width:32px;height:32px;border-radius:8px;background:rgba(34,211,238,0.15);display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-person-badge-fill" style="color:var(--accent-cyan);font-size:0.85rem"></i>
                    </div>
                    <h5 class="modal-title" id="viewStudentModalLabel">Detalhes do Estudante</h5>
                </div>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Fechar">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="modal-body" style="padding-top:1rem;padding-bottom:0.5rem">
                {{-- Avatar area --}}
                <div style="text-align:center;margin-bottom:1.25rem">
                    <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,var(--accent-blue),var(--accent-purple));margin:0 auto;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-person-fill" style="color:#fff;font-size:1.75rem"></i>
                    </div>
                    <p style="margin-top:0.6rem;font-size:1.05rem;font-weight:600;color:var(--text-primary)" id="viewName">—</p>
                    <span style="font-size:0.75rem;background:rgba(79,142,247,0.12);color:var(--accent-blue);border-radius:20px;padding:2px 10px" id="viewId">ID #—</span>
                </div>

                {{-- Detail rows --}}
                <div class="detail-row">
                    <div class="detail-icon" style="background:rgba(34,211,238,0.1)">
                        <i class="bi bi-envelope-fill" style="color:var(--accent-cyan)"></i>
                    </div>
                    <div>
                        <div class="detail-label">Email</div>
                        <div class="detail-value" id="viewEmail">—</div>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-icon" style="background:rgba(16,185,129,0.1)">
                        <i class="bi bi-telephone-fill" style="color:var(--accent-green)"></i>
                    </div>
                    <div>
                        <div class="detail-label">Telefone</div>
                        <div class="detail-value" id="viewPhone">—</div>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-icon" style="background:rgba(139,92,246,0.1)">
                        <i class="bi bi-calendar3" style="color:var(--accent-purple)"></i>
                    </div>
                    <div>
                        <div class="detail-label">Registado em</div>
                        <div class="detail-value" id="viewCreated">—</div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                    <i class="bi bi-x"></i> Fechar
                </button>
                <a href="#" id="viewEditLink" class="btn-primary-custom">
                    <i class="bi bi-pencil"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>


{{-- MODAL: DELETE CONFIRM --}}

<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none;padding-bottom:0">
                <button type="button" class="btn-close-custom ms-auto" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body" style="text-align:center;padding-top:0.5rem">
                <div style="width:56px;height:56px;border-radius:50%;background:rgba(239,68,68,0.1);margin:0 auto 1rem;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-trash3-fill" style="font-size:1.4rem;color:var(--accent-red)"></i>
                </div>
                <h5 style="font-weight:600;margin-bottom:0.4rem">Eliminar Estudante?</h5>
                <p style="color:var(--text-muted);font-size:0.875rem;margin-bottom:0">
                    Vai eliminar <strong id="deleteStudentName" style="color:var(--text-primary)">—</strong>. Esta acção não pode ser revertida.
                </p>
            </div>
            <div class="modal-footer" style="justify-content:center;gap:0.75rem">
                <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:var(--accent-red);border:none;color:#fff;border-radius:10px;padding:0.5rem 1.1rem;font-size:0.9rem;font-weight:500;display:inline-flex;align-items:center;gap:0.4rem;cursor:pointer">
                        <i class="bi bi-trash3"></i> Eliminar
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
