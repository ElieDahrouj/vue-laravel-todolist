<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Task::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Task $task)
    {
        try {
            $task->description = $request->description;
            $task->save();
            return response()->json("Task created");
        }
        catch (\Exception $error) {
            return response()->json(["Description required"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($task)
    {
        try {
            return Task::findOrFail($task);
        }
        catch (\Exception $error) {
            return response()->json(["Cette tâche n'existe pas"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        try {
            return Task::findOrFail($task);
        }
        catch (\Exception $error) {
            return response()->json(["Cette tâche n'existe pas"]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Task::findOrFail($id)->update($request->all());
            return response()->json("Task updated");
        }
        catch (\Exception $error) {
            return response()->json("Erreur lors de la mise à jours");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($task)
    {
        try {
            Task::findOrFail($task)->delete();
            return response()->json("Task deleted");
        }
        catch (\Exception $ex){
            return response()->json("Error");
        }
    }
}
