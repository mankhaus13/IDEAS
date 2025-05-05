<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tt;
use Illuminate\Support\Facades\Log;

class TechnicalTaskController extends Controller
{
    public function index(Request $request) {

        $projectId = request('projectId');
        $tts = Project::find($projectId)->tasks()
            ->when($request->search, function($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->paginate(10);

        return view('technical-task.index', compact('tts', 'projectId'));
    }

    public function edit(int $id) {
        $tt = Tt::find($id);

        return view('technical-task.edit',compact('tt'));
    }
    public function update(Request $request, int $id) {
        $ttData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'deadline' => 'required',
        ]);

        $tt = Tt::find($id);
        $project = $tt->projects()->first();
        $projectId = $project->id;
        $tt->update($ttData);
        return redirect()->route('tt.index', ['projectId' => $projectId]);
    }

    public function create() {
        $projectId = request('projectId');
        return view('technical-task.create', compact('projectId'));
    }
    public function store(Request $request, int $projectId) {
        $ttData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'deadline' => 'required|after:start_date',
        ]);
        $projectId = request('projectId');
        $tt = Tt::create($ttData);
        $project = Project::findOrFail($projectId);
        $project->tasks()->attach($tt);

        return redirect()->route('tt.index', ['projectId' => $projectId]);
    }

    public function destroy(int $ttId) {
        $tt = Tt::find($ttId);
        $project = $tt->projects()->first();
        $projectId = $project->id;

        Tt::destroy($ttId);

        return redirect()->route('tt.index', ['projectId' => $projectId]);
    }
}
