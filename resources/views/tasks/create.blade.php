@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
    <h1 class="mb-4">Add New Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST" class="bg-white p-4 form-card">
        @csrf
        @include('tasks._form')

        <button type="submit" class="btn btn-success">Save Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
