@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Staff Management</h3>
                <p class="text-subtitle text-muted">Manage staff members and their roles</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Staff</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>All Staff Members</h4>
                    <a href="{{ route('admin.staff.create') }}" class="btn btn-primary">Add New Staff</a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Search and Filter Form -->
                <form method="GET" action="{{ route('admin.staff.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control" placeholder="Search by name, role, or email" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="role" class="form-control" placeholder="Filter by role" value="{{ request('role') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Linked User</th>
                            <th>Projects Count</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staff as $member)
                            <tr>
                                <td>{{ $staff->firstItem() + $loop->index }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->role }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->user ? $member->user->name : 'Not Linked' }}</td>
                                <td>{{ $member->projects->count() }}</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.staff.show', $member) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('admin.staff.edit', $member) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.staff.destroy', $member) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No staff members found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                {{ $staff->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
@endsection
