<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;

class TaskController extends Controller
{
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
        $provinces = Province::all();
        return view('add_task', ['provinces' => $provinces ]);
    }

    public function waitingTaskList(){
        $waiting_list = Province::all();
        return view('waiting_list', ['waiting_list' => $waiting_list ]);
    }

}
