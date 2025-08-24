@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}">
            <button class="
            bg-blue-500 
            hover:bg-blue-600 
            text-gray-700 
            font-bold 
            py-2 
            px-4 
            rounded">
                Create New Task
            </button>
        </a>
    </nav>
    <ul>
            @forelse ($tasks as $task)
                <li class="mb-1"> Title: <a 
                @class([
                    'font-bold' => !$task->completed,
                    'line-through' => $task->completed,
                ])
                href="{{ route('tasks.show', ['task' => $task->id]) }}">
                {{ $task->title }}
            </a>
                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">
                    <button class="
                    bg-blue-500 
                    hover:bg-blue-600 
                    text-white 
                    font-bold 
                    py-2 
                    px-4 
                    rounded">
                        Edit
                    </button>
                </a>
            </li>
            @empty
                <li>No tasks found</li>
            @endforelse
        </ul>
    @if ($tasks->count())
    <nav class="mt-4">
    {{  $tasks->links() }}
    </nav>
    @endif
@endsection
