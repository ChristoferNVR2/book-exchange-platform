@extends('layouts.app')

@section('title', 'Dune')

@section('content')

<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}">Catalog</a></li>
            <li class="breadcrumb-item active">Dune</li>
        </ol>
    </nav>
    <h2 class="mb-0">Book Details</h2>
</div>

<div class="row g-4">

    {{-- Cover --}}
    <div class="col-md-3 text-center">
        <div class="book-cover cover-2 rounded" style="height:280px; font-size:5rem;">
            <i class="bi bi-book"></i>
        </div>
        <div class="mt-3">
            <span class="badge bg-primary fs-6 px-3 py-2">Good condition</span>
        </div>
    </div>

    {{-- Info --}}
    <div class="col-md-9">
        <h2 class="fw-bold mb-1">Dune</h2>
        <h5 class="text-muted mb-3">Frank Herbert</h5>

        <table class="table table-sm table-borderless w-auto mb-3">
            <tr>
                <th class="text-muted pe-4">ISBN</th>
                <td>9780441013593</td>
            </tr>
            <tr>
                <th class="text-muted pe-4">Category</th>
                <td><span class="badge bg-secondary">Science Fiction</span></td>
            </tr>
            <tr>
                <th class="text-muted pe-4">Condition</th>
                <td><span class="badge bg-primary">Good</span></td>
            </tr>
            <tr>
                <th class="text-muted pe-4">Status</th>
                <td><span class="badge bg-success">Available</span></td>
            </tr>
            <tr>
                <th class="text-muted pe-4">Owner</th>
                <td>
                    <i class="bi bi-person-circle me-1"></i>alice
                </td>
            </tr>
            <tr>
                <th class="text-muted pe-4">Listed on</th>
                <td>April 20, 2026</td>
            </tr>
        </table>

        <p class="mb-4">
            Epic sci-fi saga set on a desert planet. Paul Atreides, a brilliant and gifted young man
            born into a great destiny beyond his understanding, must travel to the most dangerous
            planet in the universe to ensure the future of his family and his people.
        </p>

        {{-- Exchange button (disabled for guests in dynamic phase) --}}
        <button class="btn btn-be btn-lg me-2">
            <i class="bi bi-arrow-left-right me-1"></i>Request Exchange
        </button>
        <a class="btn btn-be-outline btn-lg" href="{{ route('catalog.index') }}">
            <i class="bi bi-arrow-left me-1"></i>Back to Catalog
        </a>
    </div>

</div>

@endsection
