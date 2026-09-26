<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // View all tasks
    public function index()
    {
        $tasks = Task::latest()->get();
        $pendingCount = Task::where('status','Pending')->count();
        $completedCount = Task::where('status','Completed')->count();

        return view('tasks.index', compact('tasks','pendingCount','completedCount'));
    }

    // Show the "add task" form
    public function create()
    {
        return view('tasks.create');
    }

    // Save a new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // Show the "edit task" form
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Save changes to an existing task
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    // Toggle Pending <-> Completed
    public function updateStatus(Task $task)
    {
        $task->status = $task->status === 'Pending' ? 'Completed' : 'Pending';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task status updated.');
    }
}
