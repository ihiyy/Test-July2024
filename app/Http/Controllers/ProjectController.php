<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }
   
    public function store(ProjectRequest $request)
    {
        try {
            $request->validate([
                'project_name' => 'required|string|max:255',
                'project_description' => 'required|string',
                'deadline' => 'required|date',
            ]);
    
            Project::create([
                'project_name' => $request->project_name,
                'project_description' => $request->project_description,
                'deadline' => $request->deadline,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
    
            return redirect()->route('projects.index');
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function show(Project $project)
    {
        try {
            $files = ProjectFile::where('project_id', $project->id)->get();

            return view('projects.show', compact('project', 'files'));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
        
    }

    public function editproject(Project $project)
    {
        try {   
            return view('projects.edit', compact('project'));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            Project::where('id', $request->id)->update([
                'project_name' => $request->project_name,
                'project_description' => $request->project_description,
                'deadline' => $request->deadline,
            ]);

            return redirect()->route('projects.index');
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();

            return redirect()->route('projects.index');
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function addfile(Project $project) {
        return view('projects.upload', compact('project'));
    }

    public function uploadfile(Request $request) {
        try {
            $files = $request->file('files');
            
            $files->storeAs('uploads', $files->getClientOriginalName());
    
            ProjectFile::create([
                'project_id' => $request->input('project_id'),
                'file' => $files->getClientOriginalName(),
                'mime_type' => $files->getClientMimeType(),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);

            return response()->json(['message' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
