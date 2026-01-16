@extends('layouts.app')

@section('content')
<div class="page-heading">
    <h3>My Projects</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Project List</h4>
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">Submit New Project</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Search and Filter Form -->
                    <form method="GET" action="{{ route('mahasiswa.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Search by title or description" value="{{ request('search') }}">
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
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Mahasiswa Name</th>
                                <th>Status</th>
                                <th>Submitted At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                                <tr>
                                    <td>{{ $projects->firstItem() + $loop->index }}</td>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->mahasiswa_name }}</td>
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
                                    <td>{{ $project->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('mahasiswa.show', $project) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('mahasiswa.edit', $project) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('mahasiswa.destroy', $project) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No projects found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    {{ $projects->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
