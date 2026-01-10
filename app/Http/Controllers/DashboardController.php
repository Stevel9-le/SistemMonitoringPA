<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Staff;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $runningProjects = Project::where('status', 'in_progress')->count();
        $completedProjects = Project::where('status', 'completed')->count();
        $totalStaff = Staff::count();

        return view('admin.dashboard', compact('totalProjects', 'runningProjects', 'completedProjects', 'totalStaff'));
    }
}
