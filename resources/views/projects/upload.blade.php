@extends('layouts.app')

@section('content')
<style>
    .header {
        display:flex;
        justify-content:space-between;
        margin-bottom:48px;
    }

    .uploadArea {
        height:240px;
        background:#FFFFFF;
        border:1px solid #000000;
        border-radius:12px;
    }

    .uploadArea.highlight {
        background-color: rgba(22, 131, 255, 0.1);
    }

    .uploadArea p{
        line-height: 240px;
        text-align: center;
    }

    .uploadArea input{
        display:none;
    }
</style>

<div class="container">
    <div class="header">
        <h3>Upload File</h3>
        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">Back to Projects</a>
    </div>

    <div class="uploadArea" id="dragArea" ondrop="storeFile(event)">
        <p>Drag and Drop file here</p>
        <input type="file" />
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dragArea = document.getElementById('dragArea');

        dragArea.addEventListener('dragover', e => {
            e.preventDefault();
            dragArea.classList.add('highlight');
        });

        dragArea.addEventListener('drop', e => {
            e.preventDefault();
        });

        dragArea.addEventListener('dragleave', e => {
            dragArea.classList.remove('highlight');
        });
    });

    function storeFile(event) {
        event.preventDefault();
        const files = event.dataTransfer.files;
        
        if (files.length > 0) {
            const formData = new FormData();
            formData.append('files', files[0]);
            formData.append('project_id', '{{ $project->id }}');
            fetch('{{ route("projects.upload") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.message === "success") {
                    window.location.replace("{{ route('projects.show', $project->id) }}");
                } else {
                    console.log(data.message);
                }
            });
        }
    }
</script>
@endsection