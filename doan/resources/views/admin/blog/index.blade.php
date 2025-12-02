@extends('admin.dashboard')

@section('content')
<style>
    .blog-thumb {
        width: 70px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        cursor: pointer;
    }

    .blog-thumb:hover {
        transform: scale(1.1);
        z-index: 10;
        position: relative;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }
</style>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Blog List</h3>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">+ Create Blog</a>
    </div>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Posted Date</th>
                <th width="180">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <td>{{ $blog->id }}</td>

                <td>
                    @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}"
                        class="blog-thumb"
                        alt="Blog Image">
                    @else
                    <span class="text-muted">No Image</span>
                    @endif
                </td>


                <td>{{ $blog->blog_name }}</td>

                <td>{{ $blog->user->name ?? $blog->user->email ?? 'N/A' }}</td>

                <td>{{ $blog->posted_date }}</td>

                <td>
                    <div class="d-flex justify-content-center gap-2">

                        {{-- VIEW --}}
                        <a href="{{ route('admin.blog.show', $blog->id) }}" class="btn btn-info btn-sm">
                            View
                        </a>

                        {{-- EDIT --}}
                        <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('admin.blog.delete', $blog->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this blog?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>

                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $blogs->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>

</div>

@endsection