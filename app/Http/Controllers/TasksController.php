<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{

    /**
     * Página de tasks
     *
     * @return view
     */
    public function index()
    {
        $tasks = Task::all(); // Pega todos os tasks do banco

        return view('tasks', compact('tasks')); // Chama a view e passa todos os tasks pra ela ($task)
    }

    /**
     * Cadastrar uma task no banco
     *
     * @param  Request $request
     * @return Task $task
     */
    public function store(Request $request)
    {
        return Task::create($request->task); // $request->task = ['title' => (titulo-da-requisicao)]
    }

    /**
     * Atualiza uma task no banco
     *
     * @param  Task    $task
     * @param  Request $request
     * @return void
     */
    public function update(Task $task, Request $request)
    {
        $task->update($request->task);
    }

    /**
     * Remove uma task no banco
     *
     * @param  Task   $task
     * @return void
     */
    public function destroy(Task $task)
    {
        $task->delete();
    }
}
