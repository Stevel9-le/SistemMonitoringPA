<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = \App\Models\Project::where('mahasiswa_name', auth()->user()->name);

        // Search
        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter by status
        if ($status = request('status')) {
            $query->where('status', $status);
        }

        $projects = $query->paginate(10);

        return view('mahasiswa.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'mahasiswa_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'assigned_staff_id' => 'required|exists:staff,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB max
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('project_files', 'public');
        }

        \App\Models\Project::create([
            'title' => $request->title,
            'mahasiswa_name' => $request->mahasiswa_name,
            'description' => $request->description,
            'status' => 'pending',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'assigned_staff_id' => $request->assigned_staff_id,
            'file_path' => $filePath,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Project submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Add logic to show mahasiswa
        return view('mahasiswa.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Add logic to edit mahasiswa
        return view('mahasiswa.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Add validation and update logic
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Add delete logic
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa deleted successfully.');
    }
}
