<div class="mb-3">
    <label class="form-label">Task Name</label>
    <input type="text" name="task_name" class="form-control"
           value="{{ old('task_name', $task->task_name ?? '') }}">
    @error('task_name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $task->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Due Date</label>
    <input type="date" name="due_date" class="form-control"
           value="{{ old('due_date', $task->due_date ?? '') }}">
</div>
