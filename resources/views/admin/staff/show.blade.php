@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Staff Details</h3>
                <p class="text-subtitle text-muted">View staff information</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $staff->name }}</h4>
                    <div>
                        <a href="{{ route('staff.edit', $staff) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('staff.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Basic Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $staff->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Role:</strong></td>
                                <td>{{ $staff->role }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $staff->email }}</td>
                            </tr>
                            @if($staff->user)
                            <tr>
                                <td><strong>User Account:</strong></td>
                                <td>{{ $staff->user->name }} ({{ $staff->user->email }})</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Assigned Projects</h6>
                        @if($staff->projects->count() > 0)
                            <ul class="list-group">
                                @foreach($staff->projects as $project)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $project->title }}
                                        <span class="badge bg-primary">{{ $project->status }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No projects assigned.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
