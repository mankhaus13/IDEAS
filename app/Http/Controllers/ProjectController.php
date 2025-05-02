<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::query()
            ->when($request->search, function($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->created_at, function($query, $date) {
                return $query->whereDate('start_date', $date);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('project.index', compact('projects'));
    }

    public function edit(int $id) {
        $project = Project::find($id);
        return view('project.edit',compact('project'));
    }
    public function update(Request $request, int $id) {
        $projectData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'deadline' => 'required',
        ]);

        $project = Project::find($id);
        $project->update($projectData);
        return redirect()->route('project.index');
    }

    public function destroy(int $id) {
        Project::destroy($id);
        return redirect()->route('project.index');
    }

    public function create() {
        $users = User::all();
        return view('project.create',compact('users'));
    }
    public function store(Request $request) {
        $projectData = $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'deadline' => 'required|after:start_date',
        ]);
        Project::create($projectData);
        return redirect()->route('project.index');
    }
}
