<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Staff;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $totalProjects = Project::count();
            $runningProjects = Project::where('status', 'in_progress')->count();
            $completedProjects = Project::where('status', 'completed')->count();
            $totalStaff = Staff::count();

            return view('admin.dashboard', compact('totalProjects', 'runningProjects', 'completedProjects', 'totalStaff'));
        } elseif (auth()->user()->hasRole(['staff', 'dosen'])) {
            $staff = auth()->user()->staff;
            if ($staff) {
                $totalProjects = $staff->projects()->count();
                $runningProjects = $staff->projects()->where('status', 'in_progress')->count();
                $completedProjects = $staff->projects()->where('status', 'completed')->count();
                $pendingProjects = $staff->projects()->where('status', 'pending')->count();
            } else {
                $totalProjects = $runningProjects = $completedProjects = $pendingProjects = 0;
            }

            return view('staff.dashboard', compact('totalProjects', 'runningProjects', 'completedProjects', 'pendingProjects'));
        }

        // Default fallback
        return redirect()->route('home');
    }
}
