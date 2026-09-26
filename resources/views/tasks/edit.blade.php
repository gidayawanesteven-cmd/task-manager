@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <h1 class="mb-4">Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST" class="bg-white p-4 form-card">
        @csrf
        @method('PUT')
        @include('tasks._form')

        <button type="submit" class="btn btn-success">Update Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
