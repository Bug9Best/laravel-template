<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskCtrl extends Controller
{
    public function getTasks()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function getTaskById($id)
    {
        $task = Task::find($id);
        if ($task) {
            return response()->json($task);
        } else {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }

    public function createTask(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $task = new Task();
        $task->fill($data);
        $task->save();

        return response()->json($task, 201);
    }

    public function updateTask(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $task->update($data);

        return response()->json($task);
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
