@extends('layouts.app')

@section('title', 'Dispute Resolution')

@section('content')

<div class="page-header d-flex align-items-center">
    <h2 class="mb-0"><i class="bi bi-flag me-2"></i>Dispute Resolution</h2>
    <span class="badge bg-danger ms-3 fs-6">2 open</span>
</div>

<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Book</th>
                    <th>Reporter</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    [1, 'Dune',             'bob',   'The book arrived in much worse condition than described.',    'open',     'Apr 22, 2026'],
                    [2, 'The Great Gatsby', 'carol', 'The other user accepted the exchange but never shipped it.',  'open',     'Apr 23, 2026'],
                    [3, '1984',             'dave',  'Minor cover damage, resolved after discussion.',              'resolved', 'Apr 18, 2026'],
                ] as [$id, $book, $reporter, $desc, $status, $date])
                <tr>
                    <td class="text-muted">#{{ $id }}</td>
                    <td class="fw-semibold">{{ $book }}</td>
                    <td><i class="bi bi-person-circle me-1"></i>{{ $reporter }}</td>
                    <td><small class="text-muted">{{ $desc }}</small></td>
                    <td>
                        <span class="badge {{ $status === 'open' ? 'bg-danger' : 'bg-success' }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>
                    <td><small class="text-muted">{{ $date }}</small></td>
                    <td class="text-end">
                        @if($status === 'open')
                        <button class="btn btn-sm btn-be" data-bs-toggle="modal"
                                data-bs-target="#resolveModal">
                            <i class="bi bi-check-circle me-1"></i>Resolve
                        </button>
                        @else
                        <span class="text-muted small">Resolved</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Resolve modal --}}
<div class="modal fade" id="resolveModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-check-circle me-1"></i>Resolve Dispute</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="#">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <label class="form-label fw-semibold" for="resolution">
                        Resolution note <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" id="resolution" name="resolution"
                              rows="4" placeholder="Describe how the dispute was resolved…" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-be">
                        <i class="bi bi-check-lg me-1"></i>Mark as Resolved
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
