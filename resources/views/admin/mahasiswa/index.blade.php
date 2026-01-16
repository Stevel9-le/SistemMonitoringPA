@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Mahasiswa Management</h3>
                <p class="text-subtitle text-muted">Manage mahasiswa users and their information</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Mahasiswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>All Mahasiswa</h4>
                    <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">Add New Mahasiswa</a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Search and Filter Form -->
                <form method="GET" action="{{ route('admin.mahasiswa.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search by name, email, or student ID" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="department" class="form-control" placeholder="Filter by department" value="{{ request('department') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="study_program" class="form-control" placeholder="Filter by study program" value="{{ request('study_program') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Student ID</th>
                            <th>Department</th>
                            <th>Study Program</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $student)
                            <tr>
                                <td>{{ $mahasiswa->firstItem() + $loop->index }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->department }}</td>
                                <td>{{ $student->study_program }}</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.mahasiswa.show', $student) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('admin.mahasiswa.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.mahasiswa.destroy', $student) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No mahasiswa found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                {{ $mahasiswa->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
</div>
@endsection
