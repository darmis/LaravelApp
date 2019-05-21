<?php

namespace Ciklas\Http\Controllers;

use Illuminate\Http\Request;
use Ciklas\Http\Controllers\Controller;
use Ciklas\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'))->with('name', 'Kalendorius');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Task::create($request->all());
        return redirect()->route('tasks.index');
    }

    public function updateTask(Request $request)
    {
        $task = Task::find($request->input('id'));
        $task->name = $request->input('editTitle');
        $task->description = $request->input('editDescription');
        $task->task_date = $request->input('editDate');
        $task->save();

        return redirect()->back();
    }

    public function deleteTask(Request $request)
    {
        $task = Task::find($request->input('id'));
        $task->delete();

        return redirect()->back()->with('success', 'Įrašas ištrintas');
    }

    public function updateDate(Request $request)
    {
        $task = Task::find($request->id);
        $task->task_date = $request->date;
        $task->save();

        return;
    }
}
