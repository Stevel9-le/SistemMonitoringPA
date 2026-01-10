@extends('layouts.app')

@section('content')
<div class="page-heading">
    <h3>Project Details</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $project->title }}</h4>
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to Projects</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Basic Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th>Title:</th>
                                    <td>{{ $project->title }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
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
                                </tr>
                                <tr>
                                    <th>Assigned Staff:</th>
                                    <td>{{ $project->assignedStaff ? $project->assignedStaff->name . ' (' . $project->assignedStaff->role . ')' : 'Not Assigned' }}</td>
                                </tr>
                                <tr>
                                    <th>Start Date:</th>
                                    <td>{{ $project->start_date ? $project->start_date->format('d/m/Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>End Date:</th>
                                    <td>{{ $project->end_date ? $project->end_date->format('d/m/Y') : '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Description</h5>
                            <p>{{ $project->description ?: 'No description provided.' }}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning">Edit Project</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete Project</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
