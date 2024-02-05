@extends('layouts.app')

@section('content')
<div class="container custom-section">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-center">Create Task</div>
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

                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <div class="form-group mb-4">
                            <label>Name</label>
                            <input class="form-control mt-1" type="text" name="name" value="{{ old('name') }}" required>
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
                        <button type="submit" class="btn btn-success">Create</button>
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
            $('[name="project_id"]').val({{ old('project') }});
        });
    </script>
@endsection
