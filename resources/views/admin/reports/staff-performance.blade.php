@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Staff Performance Report</h3>
                <p class="text-subtitle text-muted">Detailed staff performance overview</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}">Reports</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Staff Performance</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>All Staff Performance</h4>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">Back to Reports</a>
                </div>
            </div>
            <div class="card-body">
                <!-- Search and Filter Form -->
                <form method="GET" action="{{ route('admin.reports.staff-performance') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control" placeholder="Search by name, role, or email" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="role" class="form-control" placeholder="Filter by role" value="{{ request('role') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('admin.reports.staff-performance') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Total Projects</th>
                            <th>Completed Projects</th>
                            <th>Pending Projects</th>
                            <th>In Progress Projects</th>
                            <th>Performance Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staff as $member)
                            <tr>
                                <td>{{ $staff->firstItem() + $loop->index }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->projects_count }}</td>
                                <td>{{ $member->projects->where('status', 'completed')->count() }}</td>
                                <td>{{ $member->projects->where('status', 'pending')->count() }}</td>
                                <td>{{ $member->projects->where('status', 'in_progress')->count() }}</td>
                                <td>
                                    @php
                                        $completed = $member->projects->where('status', 'completed')->count();
                                        $total = $member->projects_count;
                                        $score = $total > 0 ? round(($completed / $total) * 100, 2) : 0;
                                    @endphp
                                    <span class="badge
                                        @if($score >= 80) bg-success
                                        @elseif($score >= 60) bg-warning
                                        @else bg-danger
                                        @endif">
                                        {{ $score }}%
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No staff found.</td>
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
