@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="stat-card text-center">
                <h2>{{ $tasks->count() }}</h2>
                <span>Total Tasks</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card text-center">
                <h2 class="text-warning">{{ $pendingCount }}</h2>
                <span>Pending</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card text-center">
                <h2 class="text-success">{{ $completedCount }}</h2>
                <span>Completed</span>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">My Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Task
        </a>
    </div>

    <table class="table table-bordered bg-white task-table">
        <thead>
            <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->due_date ?? '—' }}</td>
                    <td>
                        <span class="badge {{ $task->status === 'Completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $task->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-arrow-repeat"></i>
                                {{ $task->status === 'Pending' ? 'Complete' : 'Reopen' }}
                            </button>
                        </form>

                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">No tasks yet. Add one above!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
