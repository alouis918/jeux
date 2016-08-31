<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;

class TaskController extends Controller
{
    protected  $tasks;
    /**
     * TaskController constructor.
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){

        return view('task.index',['tasks' => $this->tasks->forUser($request->user())]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request){
        $this->validate($request, [
            'name' =>'required|max:255',
        ]);
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);
        return redirect('/tasks');
    }

    public function destroy(Request $request, Task $task){
        $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');
    }

    public function viewTask(Request $request,  Task $task){
       return view('task.view', ['task' => $task]);
    }

}
