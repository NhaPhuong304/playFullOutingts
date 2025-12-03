@extends('admin.dashboard')

@section('page-title', 'Blogs')

@section('content')

<style>
    .blog-thumb {
        width: 75px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform .25s ease, box-shadow .25s ease;
        cursor: pointer;
    }

    .blog-thumb:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 14px rgba(0,0,0,.25);
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .btn-action {
        width: 34px;
        height: 34px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 6px;
    }
</style>

<div class="container mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Blog Management</h3>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Create Blog
        </a>
    </div>

    {{-- SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    {{-- TABLE --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-hover text-center align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="60">ID</th>
                        <th width="110">Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Posted Date</th>
                        <th width="170">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>

                        {{-- IMAGE --}}
                        <td>
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" class="blog-thumb">
                            @else
                                <span class="text-muted fst-italic">No Image</span>
                            @endif
                        </td>

                        <td class="fw-semibold">{{ $blog->blog_name }}</td>

                        <td>{{ $blog->user->name ?? $blog->user->email ?? 'N/A' }}</td>

                        <td>{{ \Carbon\Carbon::parse($blog->posted_date)->format('d/m/Y') }}</td>

                        {{-- ACTION BUTTONS --}}
                        <td>
                            <div class="d-flex justify-content-center gap-2">

                                {{-- VIEW --}}
                                <a href="{{ route('admin.blog.show', $blog->id) }}"
                                    class="btn btn-sm btn-outline-info btn-action" 
                                    data-bs-toggle="tooltip" title="View">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                    class="btn btn-sm btn-outline-warning btn-action"
                                    data-bs-toggle="tooltip" title="Edit">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('admin.blog.delete', $blog->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger btn-action"
                                            data-bs-toggle="tooltip" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $blogs->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>

</div>

@endsection
