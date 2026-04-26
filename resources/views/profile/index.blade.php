@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

{{-- Profile header --}}
<div class="page-header d-flex align-items-center gap-3">
    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white"
         style="width:56px; height:56px; font-size:1.6rem;">
        <i class="bi bi-person-fill"></i>
    </div>
    <div>
        <h2 class="mb-0">alice <span class="badge bg-secondary fs-6">user</span></h2>
        <small class="text-muted">Member since April 2026</small>
    </div>
    <a class="btn btn-be btn-sm ms-auto" href="{{ route('books.create') }}">
        <i class="bi bi-plus-circle me-1"></i>Publish a Book
    </a>
</div>

{{-- Tabs --}}
<ul class="nav nav-tabs mb-4" id="profileTabs">
    <li class="nav-item">
        <a class="nav-link active" href="#my-books" data-bs-toggle="tab">
            <i class="bi bi-collection me-1"></i>My Books
            <span class="badge bg-secondary ms-1">3</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#inbox" data-bs-toggle="tab" id="inbox-tab">
            <i class="bi bi-inbox me-1"></i>Inbox
            <span class="badge be-badge ms-1">2</span>
        </a>
    </li>
</ul>

<div class="tab-content">

    {{-- My Books tab --}}
    <div class="tab-pane fade show active" id="my-books">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Book</th>
                        <th>Condition</th>
                        <th>Status</th>
                        <th>Listed</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([
                        ['The Great Gatsby',    'F. Scott Fitzgerald', 'good', 'available', 'Apr 20, 2026'],
                        ['Dune',                'Frank Herbert',       'fair', 'pending',   'Apr 21, 2026'],
                        ['The Hobbit',          'J.R.R. Tolkien',      'good', 'available', 'Apr 22, 2026'],
                    ] as [$title, $author, $condition, $status, $date])
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $title }}</div>
                            <small class="text-muted">{{ $author }}</small>
                        </td>
                        <td>
                            <span class="badge
                                {{ $condition === 'good' ? 'bg-primary' : '' }}
                                {{ $condition === 'fair' ? 'bg-warning text-dark' : '' }}
                            ">{{ ucfirst($condition) }}</span>
                        </td>
                        <td>
                            <span class="badge
                                {{ $status === 'available' ? 'bg-success' : '' }}
                                {{ $status === 'pending'   ? 'bg-warning text-dark' : '' }}
                                {{ $status === 'exchanged' ? 'bg-secondary' : '' }}
                            ">{{ ucfirst($status) }}</span>
                        </td>
                        <td><small class="text-muted">{{ $date }}</small></td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary me-1" href="#">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Inbox tab --}}
    <div class="tab-pane fade" id="inbox">

        <h6 class="text-muted text-uppercase small mb-3">
            <i class="bi bi-arrow-down-left-circle me-1"></i>Incoming Requests
        </h6>
        <div class="table-responsive mb-4">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Book requested</th>
                        <th>From</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-semibold">The Great Gatsby</td>
                        <td><i class="bi bi-person-circle me-1"></i>bob</td>
                        <td><small class="text-muted">I'd love to read this classic!</small></td>
                        <td><small class="text-muted">Apr 23, 2026</small></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-be me-1">
                                <i class="bi bi-check-lg"></i> Accept
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-x-lg"></i> Reject
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">The Hobbit</td>
                        <td><i class="bi bi-person-circle me-1"></i>carol</td>
                        <td><small class="text-muted">Tolkien fan here 🙂</small></td>
                        <td><small class="text-muted">Apr 24, 2026</small></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-be me-1">
                                <i class="bi bi-check-lg"></i> Accept
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-x-lg"></i> Reject
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h6 class="text-muted text-uppercase small mb-3">
            <i class="bi bi-arrow-up-right-circle me-1"></i>Outgoing Requests
        </h6>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Book requested</th>
                        <th>Owner</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-semibold">1984</td>
                        <td><i class="bi bi-person-circle me-1"></i>dave</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td><small class="text-muted">Apr 22, 2026</small></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
