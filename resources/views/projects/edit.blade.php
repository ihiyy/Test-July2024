@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Project</h1>
    <form action="{{ route('projects.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="project_name">Project ID</label>
            <input type="text" name="id" class="form-control" value="{{ $project->id }}" readonly="readonly" required>
        </div>
        <div class="form-group">
            <label for="project_name">Project Name</label>
            <input type="text" name="project_name" class="form-control" value="{{ $project->project_name }}" required>
        </div>
        <div class="form-group">
            <label for="project_description">Project Description</label>
            <textarea name="project_description" class="form-control" required>{{ $project->project_description }}</textarea>
        </div>
        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="datetime-local" name="deadline" class="form-control" value="{{ $project->deadline instanceof \Carbon\Carbon ? $project->deadline->format('Y-m-d\TH:i') : $project->deadline }}">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
