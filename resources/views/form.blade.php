@extends ('layouts.app')

@section ('title', isset($task) ? 'Edit Task': 'Create Task')

@section ('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ 
    isset($task) ? 
    route('tasks.update', ['task' => $task->id]) : 
    route( 'tasks.store') }}" method="POST">
        @csrf
        @isset($task)
        @method('PUT')
        @endisset
        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}" placeholder="Task Title" @class(['border',
                'border-red-500' => $errors->has('title'),
            ])>
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description">Description</label>
            <textarea rows="5" name="description" id="description" @class([
                'border',
                'border-red-500' => $errors->has('description'),
            ])
                placeholder="Task Description">{{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="long_description">Long Description</label>
            <textarea rows="10" name="long_description" id="long_description" @class([
                'border',
                'border-red-500' => $errors->has('long_description'),
            ])
                placeholder="Task Long Description">{{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="completed">Completed</label>
            <input type="hidden" name="completed" value="0">
            <input type="checkbox" name="completed" value="1" id="completed">

        </div>
        <div class="flex justify-end gap-2 items-center">
            <button type="submit" class="btn btn-green">
                {{ isset($task) ? 'Edit Task' : 'Create Task' }}
            </button>
            <a href="{{ route('tasks.index') }}" class="btn btn-gray">Cancel</a>
        </div>
    </form>
@endsection