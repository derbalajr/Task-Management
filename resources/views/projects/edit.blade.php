
@extends('layouts.app')

@section('content')
<div class="container custom-section">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col d-flex justify-content-center">Update Project</div>
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

                    <form method="POST" action="{{ route('projects.update', ['id' => $project->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label>Name</label>
                            <input class="form-control mt-1" type="text" name="name" value="{{ $project->name }}" required>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('projects.index') }}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
