<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Staff;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of reports.
     */
    public function index()
    {
        // Get project statistics
        $totalProjects = Project::count();
        $pendingProjects = Project::where('status', 'pending')->count();
        $inProgressProjects = Project::where('status', 'in_progress')->count();
        $completedProjects = Project::where('status', 'completed')->count();
        $cancelledProjects = Project::where('status', 'cancelled')->count();

        // Get staff statistics
        $totalStaff = Staff::count();
        $staffWithProjects = Staff::has('projects')->count();

        // Get recent projects
        $recentProjects = Project::with('assignedStaff')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.reports.index', compact(
            'totalProjects',
            'pendingProjects',
            'inProgressProjects',
            'completedProjects',
            'cancelledProjects',
            'totalStaff',
            'staffWithProjects',
            'recentProjects'
        ));
    }

    /**
     * Generate project status report.
     */
    public function projectStatus()
    {
        $projects = Project::with('assignedStaff')
            ->orderBy('status')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reports.project-status', compact('projects'));
    }

    /**
     * Generate staff performance report.
     */
    public function staffPerformance()
    {
        $staff = Staff::with('projects')
            ->withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->get();

        return view('admin.reports.staff-performance', compact('staff'));
    }
}
