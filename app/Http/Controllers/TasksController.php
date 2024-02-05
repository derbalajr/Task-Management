<?php

namespace App\Http\Controllers;


use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks    = Task::orderBy('priority', 'asc')->get();
        $projects = Project::hasTasks()->get();
        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $maxPrioroty = Task::max('priority') ?: 0;

        $newTask             = new Task();
        $newTask->name       = $request->name;
        $newTask->project_id = $request->project_id;
        $newTask->priority   = ++$maxPrioroty;

        $newTask->save();

        return redirect()->route('tasks.index');
    }


    public function edit($id)
    {
        $task     = Task::findOrFail($id);
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'name'       => 'required',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $task->name       = $request->name;
        $task->project_id = $request->project_id;

        $task->save();

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        Task::where('priority', '>', $task->priority)
            ->update(['priority' => \DB::raw('priority - 1')]);

        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function apiSetPriority(Request $request){

        $task = Task::findOrFail($request->input('task_id'));
        $prev = Task::find( $request->input('prev_id') );

        if( !$request->input('prev_id') ){
            $destination = 1;
        }else if( !$request->input('next_id') ){
            $destination = Task::count();
        }else{
            $destination = $task->priority < $prev->priority ? $prev->priority : $prev->priority + 1;
        }

        Task::where('priority', '>', $task->priority)
            ->where('priority', '<=', $destination)
            ->update(['priority' => \DB::raw('priority - 1')]);

        Task::where('priority', '<', $task->priority)
            ->where('priority', '>=', $destination)
            ->update(['priority' => \DB::raw('priority + 1')]);

        $task->priority = $destination;
        $task->save();

        return response()->json(true);
    }
}
