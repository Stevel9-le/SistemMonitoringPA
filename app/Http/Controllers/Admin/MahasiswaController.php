<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = User::role('mahasiswa');

        // Search
        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('student_id', 'like', '%' . $search . '%');
            });
        }

        // Filter by department
        if ($department = request('department')) {
            $query->where('department', $department);
        }

        // Filter by study_program
        if ($study_program = request('study_program')) {
            $query->where('study_program', $study_program);
        }

        $mahasiswa = $query->paginate(10);

        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'student_id' => 'required|string|max:255|unique:users',
            'department' => 'required|string|max:255',
            'study_program' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'student_id' => $request->student_id,
            'department' => $request->department,
            'study_program' => $request->study_program,
        ]);

        // Ensure the role exists before assigning
        $mahasiswaRole = Role::firstOrCreate(['name' => 'mahasiswa']);
        $user->assignRole($mahasiswaRole);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = User::findOrFail($id);
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa = User::findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'student_id' => 'required|string|max:255|unique:users,student_id,' . $id,
            'department' => 'required|string|max:255',
            'study_program' => 'required|string|max:255',
        ]);

        $mahasiswa = User::findOrFail($id);
        $mahasiswa->update($request->only(['name', 'email', 'student_id', 'department', 'study_program']));

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = User::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa deleted successfully.');
    }
}
