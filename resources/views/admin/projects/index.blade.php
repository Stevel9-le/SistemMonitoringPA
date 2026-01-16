@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Project Management</h3>
                <p class="text-subtitle text-muted">Manage final projects and their progress</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Projects</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>All Projects</h4>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Add New Project</a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Search and Filter Form -->
                <form method="GET" action="{{ route('admin.projects.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control" placeholder="Search by title, mahasiswa name, or description" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Mahasiswa Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Assigned Staff</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                            <tr>
                                <td>{{ $projects->firstItem() + $loop->index }}</td>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->mahasiswa_name }}</td>
                                <td>{{ Str::limit($project->description, 50) }}</td>
                                <td>
                                    <span class="badge
                                        @if($project->status == 'pending') bg-warning
                                        @elseif($project->status == 'in_progress') bg-primary
                                        @elseif($project->status == 'completed') bg-success
                                        @else bg-danger
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </td>
                                <td>{{ $project->assignedStaff ? $project->assignedStaff->name : 'Not Assigned' }}</td>
                                <td>{{ $project->start_date ? $project->start_date->format('d/m/Y') : '-' }}</td>
                                <td>{{ $project->end_date ? $project->end_date->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No projects found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                {{ $projects->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
</div>
@endsection
