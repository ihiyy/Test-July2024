@extends('layouts.app')

@section('content')
<style>
    .header {
        display:flex;
        justify-content:space-between;
        margin-bottom:24px;
    }

    .body {
        border:1px solid #000000;
        border-radius:8px;
        padding:32px;
    }

    .content {
        margin-top:48px;
    }

    .tableAction {
        display:flex;
        justify-content:end;
        margin-bottom:18px;
    }
</style>

<div class="container">
    <div class="header">
        <h3>Project Details</h3>
        <a href="{{ route('projects.index') }}" class="btn btn-primary">Back to Projects</a>
    </div>
    
    <div class="body">
        <div class="form-group">
            <b><label for="project_name">Project Name</label></b>
            <p>{{ $project->project_name }}</p>
        </div>
        <div class="form-group">
            <b><label for="project_description">Project Description</label></b>
            <p>{{ $project->project_description }}</p>
        </div>
        <div class="form-group">
            <b><label for="deadline">Deadline</label></b>
            <p>{{ $project->deadline }}</p>
        </div>
        <div class="form-group">
            <b><label for="created_by">Created By</label></b>
            <p>{{ DB::table('users')->where('id', $project->created_by)->value('name') }}</p>
        </div>
        <div class="form-group">
            <b><label for="updated_by">Last Updated By</label></b>
            <p>{{ DB::table('users')->where('id', $project->updated_by)->value('name') }}</p>
        </div>
    </div>
    
    <div class="content">
        <div class="tableAction">
            <a href="{{ route('projects.add', $project->id) }}" class="btn btn-primary">Upload File</a>
        </div>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Mime type</th>
                <th>Created by</th>
                <th>Created at</th>
            </thead>
            <tbody>
                @foreach($files as $file)
                    <tr>
                        <td>{{ $file->id }}</td>
                        <td>{{ $file->file }}</td>
                        <td>{{ $file->mime_type }}</td>
                        <td>{{ DB::table('users')->where('id', $file->created_by)->value('name') }}</td>
                        <td>{{ $file->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>





@endsection
