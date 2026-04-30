@extends('layouts.app')

@section('title', $book->title)

@section('content')

<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item">
                <a href="{{ route('catalog.index') }}">Catalog</a>
            </li>
            <li class="breadcrumb-item active">{{ $book->title }}</li>
        </ol>
    </nav>
    <h2 class="mb-0">Book Details</h2>
</div>

<div class="row g-4">

    {{-- Cover --}}
    <div class="col-md-3 text-center">
        @if($book->cover_image)
            <img src="{{ Storage::url($book->cover_image) }}"
                 class="img-fluid rounded shadow-sm"
                 style="max-height:280px; object-fit:cover;"
                 alt="{{ $book->title }}">
        @else
            <div class="book-cover cover-{{ ($book->id % 6) + 1 }} rounded" style="height:280px; font-size:5rem;">
                <i class="bi bi-book"></i>
            </div>
        @endif
        <div class="mt-3">
            <span class="badge fs-6 px-3 py-2
                {{ $book->condition === 'new'  ? 'bg-success' : '' }}
                {{ $book->condition === 'good' ? 'bg-primary' : '' }}
                {{ $book->condition === 'fair' ? 'bg-warning text-dark' : '' }}
                {{ $book->condition === 'poor' ? 'bg-danger'  : '' }}
            ">{{ ucfirst($book->condition) }} condition</span>
        </div>
    </div>

    {{-- Info --}}
    <div class="col-md-9">
        <h2 class="fw-bold mb-1">{{ $book->title }}</h2>
        <h5 class="text-muted mb-3">{{ $book->author }}</h5>

        <table class="table table-sm table-borderless w-auto mb-3">
            @if($book->isbn)
            <tr>
                <th class="text-muted pe-4">ISBN</th>
                <td>{{ $book->isbn }}</td>
            </tr>
            @endif
            <tr>
                <th class="text-muted pe-4">Category</th>
                <td>
                    <a href="{{ route('catalog.index', ['category' => $book->category->slug]) }}"
                       class="badge bg-secondary text-decoration-none">
                        {{ $book->category->name }}
                    </a>
                </td>
            </tr>
            <tr>
                <th class="text-muted pe-4">Status</th>
                <td>
                    <span class="badge
                        {{ $book->status === 'available' ? 'bg-success'  : '' }}
                        {{ $book->status === 'pending'   ? 'bg-warning text-dark' : '' }}
                        {{ $book->status === 'exchanged' ? 'bg-secondary' : '' }}
                    ">{{ ucfirst($book->status) }}</span>
                </td>
            </tr>
            <tr>
                <th class="text-muted pe-4">Owner</th>
                <td><i class="bi bi-person-circle me-1"></i>{{ $book->owner->username }}</td>
            </tr>
            <tr>
                <th class="text-muted pe-4">Listed on</th>
                <td>{{ $book->created_at->format('F j, Y') }}</td>
            </tr>
        </table>

        @if($book->description)
            <p class="mb-4">{{ $book->description }}</p>
        @endif

        <div class="d-flex gap-2 flex-wrap">
            @auth
                @if(auth()->user()->id !== $book->user_id && $book->status === 'available')
                    <button class="btn btn-be btn-lg">
                        <i class="bi bi-arrow-left-right me-1"></i>Request Exchange
                    </button>
                @elseif(auth()->user()->id === $book->user_id)
                    <span class="text-muted fst-italic align-self-center">This is your book</span>
                @endif
            @else
                <a class="btn btn-be btn-lg" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Log in to request exchange
                </a>
            @endauth

            <a class="btn btn-be-outline btn-lg" href="{{ route('catalog.index') }}">
                <i class="bi bi-arrow-left me-1"></i>Back to Catalog
            </a>
        </div>
    </div>

</div>

@endsection
