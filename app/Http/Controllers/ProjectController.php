<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('staff')) {
            // Get staff record for the user
            $staff = $user->staff;
            if ($staff) {
                $projects = Project::with('assignedStaff')->where('assigned_staff_id', $staff->id)->get();
            } else {
                $projects = collect(); // Empty collection if no staff record
            }
        } else {
            // Admin or other roles see all projects
            $projects = Project::with('assignedStaff')->get();
        }

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->hasRole('staff')) {
            abort(403, 'Unauthorized');
        }

        $staff = Staff::all();
        return view('admin.projects.create', compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'mahasiswa_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'assigned_staff_id' => 'required|exists:staff,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with('assignedStaff')->findOrFail($id);
        $user = auth()->user();

        // Staff can only view their assigned projects
        if ($user->hasRole('staff')) {
            $staff = $user->staff;
            if (!$staff || $project->assigned_staff_id != $staff->id) {
                abort(403, 'Unauthorized');
            }
        }

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('staff')) {
            abort(403, 'Unauthorized');
        }

        $project = Project::findOrFail($id);
        $staff = Staff::all();
        return view('admin.projects.edit', compact('project', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'mahasiswa_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'assigned_staff_id' => 'required|exists:staff,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('staff')) {
            abort(403, 'Unauthorized');
        }

        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
