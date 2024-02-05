@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header pt-3">
                        <div class="row d-flex justify-content-center">
                            <div class="col-auto">
                                <select class="form-control project-dropdown" name="projects">
                                    <option value="">- All Projects -</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($tasks->count() > 0)
                            <ul class="list-group tasks" id="sortable">
                                @foreach ($tasks as $task)
                                    <li class="list-group-item" data-task-id="{{ $task->id }}"
                                        data-project-id="{{ $task->project ? $task->project->id : '' }}">
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col fw-bold">{{ $task->name }}</div>
                                                </div>
                                                <div class="row">
                                                    <small>{{ $task->project ? $task->project->name : '' }}</small>
                                                </div>
                                            </div>

                                            <div class="col-auto pe-0">
                                                <a class="btn btn-link" href="{{ route('tasks.edit', ['id' => $task->id]) }}">
                                                    <i class="fas fa-pen-to-square"></i>
                                                </a>
                                            </div>

                                            <div class="col-auto">
                                                <form action="{{ route('tasks.destroy', ['id' => $task->id]) }}" method="POST" class="delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>There is no tasks yet, <a href="{{ route('tasks.create') }}">Create the first one.</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#sortable").sortable({
            stop: function(event, ui) {
                var $e = $(ui.item);
                var $prevItem = $e.prev();
                var $nextItem = $e.next();

                $.ajax({
                    url: "{{ route('tasks.setPriority') }}",
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        task_id: $e.data('task-id'),
                        prev_id: $prevItem ? $prevItem.data('task-id') : null,
                        next_id: $nextItem ? $nextItem.data('task-id') : null
                    }
                });
            }
        });

        $('[name="projects"]').on('change', function() {
            var $this = $(this);

            if ($this.val()) {
                $('.tasks li').hide();

                $('.tasks li')
                    .filter($(`[data-project-id="${$this.val()}"]`))
                    .show();

                return;
            }

            $('.tasks li').show();
        });
    </script>
@endsection
