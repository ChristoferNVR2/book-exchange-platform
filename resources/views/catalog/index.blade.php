@extends('layouts.app')

@section('title', 'Book Catalog')

@section('content')

<div class="d-flex justify-content-between align-items-center page-header">
    <h2 class="mb-0"><i class="bi bi-grid-3x3-gap me-2"></i>Book Catalog</h2>
    <small class="text-muted">Showing 6 books</small>
</div>

{{-- Book grid --}}
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">

    @foreach([
        [1, 'cover-1', 'The Great Gatsby',    'F. Scott Fitzgerald', 'Fiction',        'good'],
        [2, 'cover-2', 'Dune',                'Frank Herbert',       'Science Fiction','fair'],
        [3, 'cover-3', 'The Hobbit',          'J.R.R. Tolkien',      'Fantasy',        'good'],
        [4, 'cover-4', '1984',                'George Orwell',       'Fiction',        'poor'],
        [5, 'cover-5', 'Sapiens',             'Yuval Noah Harari',   'Non-Fiction',    'new'],
        [6, 'cover-6', 'Murder on the Orient','Agatha Christie',     'Mystery',        'fair'],
    ] as [$id, $cover, $title, $author, $category, $condition])

    <div class="col">
        <div class="card book-card">
            <div class="book-cover {{ $cover }}">
                <i class="bi bi-book"></i>
            </div>
            <div class="card-body d-flex flex-column">
                <h6 class="card-title fw-semibold mb-1">{{ $title }}</h6>
                <p class="card-text text-muted small mb-2">{{ $author }}</p>
                <div class="d-flex gap-2 mb-3">
                    <span class="badge bg-secondary">{{ $category }}</span>
                    <span class="badge
                        {{ $condition === 'new'  ? 'bg-success' : '' }}
                        {{ $condition === 'good' ? 'bg-primary' : '' }}
                        {{ $condition === 'fair' ? 'bg-warning text-dark' : '' }}
                        {{ $condition === 'poor' ? 'bg-danger'  : '' }}
                    ">{{ ucfirst($condition) }}</span>
                </div>
                <a href="{{ route('books.show', $id) }}"
                   class="btn btn-be btn-sm mt-auto">
                    <i class="bi bi-eye me-1"></i>View Details
                </a>
            </div>
        </div>
    </div>

    @endforeach

</div>

{{-- Pagination placeholder --}}
<nav class="mt-5 d-flex justify-content-center">
    <ul class="pagination">
        <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul>
</nav>

@endsection
