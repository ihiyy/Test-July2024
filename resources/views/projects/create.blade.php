@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Project</h1>
        <form id="create-project-form" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="project_name">Project Name</label>
                <input type="text" name="project_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="project_description">Project Description</label>
                <textarea name="project_description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="datetime-local" name="deadline" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection
