@extends('layouts.app')

@section('content')
<div class="container custom-section">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col d-flex justify-content-center">Update Task</div>
                    </div>
                </div>

                <div class="card-body">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tasks.update', ['id' => $task->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label>Name</label>
                            <input class="form-control mt-1" type="text" name="name" value="{{ $task->name }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label>Project</label>
                            <select class="form-control mt-1" name="project_id">
                                <option value="">-</option>
                                @foreach( $projects as $project )
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('[name="project_id"]').val({{ $task->project_id }});

            $('form.delete').on('submit', function(){
                if( !confirm("Do you really want to detele this task?") )
                    return false;
            });
        });
    </script>
@endsection
