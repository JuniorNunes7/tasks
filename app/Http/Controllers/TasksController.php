<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{

    public function index()
    {
        $tasks = Task::all();

        return view('tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        return Task::create(['title' => $request->task]);
    }
}
