@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')

<div class="page-header d-flex align-items-center">
    <h2 class="mb-0"><i class="bi bi-folder2-open me-2"></i>Manage Categories</h2>
</div>

{{-- Add category form --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header fw-semibold bg-light">
        <i class="bi bi-plus-circle me-1"></i>Add New Category
    </div>
    <div class="card-body">
        <form method="POST" action="#" class="row g-3 align-items-end">
            @csrf
            <div class="col-md-4">
                <label class="form-label fw-semibold" for="name">Name <span class="text-danger">*</span></label>
                <input class="form-control" id="name" name="name" type="text"
                       placeholder="e.g. Horror" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold" for="description">Description <span class="text-danger">*</span></label>
                <input class="form-control" id="description" name="description" type="text"
                       placeholder="Brief description…" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-be w-100" type="submit">
                    <i class="bi bi-plus-lg me-1"></i>Add
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Categories table --}}
<div class="card shadow-sm border-0">
    <div class="card-header fw-semibold bg-light">
        <i class="bi bi-list-ul me-1"></i>Existing Categories
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th class="text-center">Books</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['Fiction',         'fiction',         'Novels, short stories, and other fictional works', 12],
                    ['Non-Fiction',     'non-fiction',     'Biographies, history, science, and essays',        7],
                    ['Science Fiction', 'science-fiction', 'Sci-fi and speculative fiction',                   9],
                    ['Fantasy',         'fantasy',         'Fantasy and magical realism',                      5],
                    ['Mystery',         'mystery',         'Mystery, thriller, and crime novels',              4],
                    ['Romance',         'romance',         'Romance novels',                                   3],
                    ['Children',        'children',        'Books for children and young adults',              2],
                    ['Academic',        'academic',        'Textbooks and academic publications',              6],
                ] as [$name, $slug, $desc, $count])
                <tr>
                    <td class="fw-semibold">{{ $name }}</td>
                    <td><code class="text-muted">{{ $slug }}</code></td>
                    <td><small class="text-muted">{{ $desc }}</small></td>
                    <td class="text-center">
                        <span class="badge bg-secondary">{{ $count }}</span>
                    </td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger"
                                {{ $count > 0 ? 'disabled title=Cannot delete category with books' : '' }}>
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
