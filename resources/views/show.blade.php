@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <p class="mb-4 text-slate-700">Description: {{ $task->description }}</p>
    @if ($task->long_description)
        <p class="mb-4 text-slate-700">Long Description: {{ $task->long_description }}</p>
    @endif
    <p class="mb-4">
        Completed: 
        @if ($task->completed)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium text-red-500">Not Completed</span>
        @endif
        <form action="{{ route('tasks.toggle-completed', ['task' => $task]) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit">
                Mark as {{  $task->completed ? 'Not Completed' : 'Completed' }}
            </button>
        </form>
    </p>
    <p class="mb-4 text-sm text-slate-500">Created: {{ $task->created_at->diffForHumans() }}, Updated: {{ $task->updated_at->format('Y-M-D h:i a') }}</p>
    <div class="flex gap-2">
    <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="
        btn
        btn-red" type="submit">Delete</button>
    </form>
    <a class="
    btn
    btn-info" href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a>
    <a 
    class="
    btn
    btn-gray"
    href="{{ route('tasks.index') }}"
    >🔙 Back to tasks</a>
    </div>
@endsection
