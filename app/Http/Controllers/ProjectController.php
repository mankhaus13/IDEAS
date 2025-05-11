<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'deadline' => 'required',
            'project_file' => 'nullable|file|max:10240',
        ]);

        $project = Project::findOrFail($id);
        $project->update($validated);

        $file = $request->file('project_file');
        if(!is_null($file)) {
            $path = $file->store('project_files', 'public');

            $project->files()->create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);
        }

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
            'project_file' => 'nullable|file|max:10240',
        ]);

        $project = Project::create($projectData);

        if ($request->hasFile('project_file')) {
            $file = $request->file('project_file');
            $path = $file->store('project_files', 'public');

            $project->files()->create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        return redirect()->route('project.index');
    }

    public function deleteFile(int $projectId, int $fileId) {
        $file = File::findOrFail($fileId);
        Storage::disk('public')->delete($file->path);
        $file->delete();

        return back()->with('success', 'Файл удален');
    }
}
