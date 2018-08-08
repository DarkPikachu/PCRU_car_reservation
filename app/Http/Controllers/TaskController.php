<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class TaskController extends Controller
{
    use App\Http\Controllers\API\TaskController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTaskView()
    {
        return view('add_task');
    }

    public function store(Request $request)
    {
        // Validate the request...
        TaskController::postAddTask();
        $validatedData = $request->validate([
            'starting_point' => 'required|unique:posts|max:255',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',

            'target' => 'required',
            'objectives' => 'required',
            'province_code' => 'required',
            'start_date' => 'required',
        ]);

        $task= new Task;
        $task->starting_point = $request->starting_point;

        $task->start_date = $request->starting_point;
        $task->start_time = $request->starting_point;
        $task->end_date = $request->starting_point;
        $task->end_time = $request->starting_point;
        $task->num_date = $request->starting_point;

        $task->target = $request->starting_point;
        $task->objectives = $request->starting_point;
        $task->province_code = $request->starting_point;

        $task->status = $request->starting_point;
        $task->creator = $request->starting_point;

        $task->save();
    }
}
