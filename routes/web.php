<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
  // \App\Models\Task::latest()->where('completed', true)->get()
    return view('index', [
        'tasks' => Task::latest('id')->paginate(10),
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
->name('tasks.create');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task,
    ]);
})->name('tasks.show');

Route::post('/tasks', function (TaskRequest $request) {
  // $data = $request->validated();
  // $task = new Task();
  // $task->title = $data['title'];
  // $task->description = $data['description'];
  // $task->long_description = $data['long_description'];
  // $task->completed = $data['completed'] ?? false;
  // $task->save();
  $task = Task::create($request->validated());

  return redirect()->route('tasks.show', ['task' => $task->id])
  ->with('success', 'Task created successfully');
})->name('tasks.store');

Route::put('/tasks/{task}', function (TaskRequest $request, Task $task) {
    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->completed = $data['completed'] ?? false;
    // $task->save();
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Task updated successfully');
})->name('tasks.update');

Route::get('/tasks/{task}/edit', function (Task $task) {
    // $task = Task::findOrFail($id);
    return view('edit', [
        'task' => $task,
    ]);
})->name('tasks.edit');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')
    ->with('success', 'Task deleted successfully');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task update successfully');
})->name('tasks.toggle-completed');

// Route::get('/about', function () {
//     return "About Page";
// })->name('about');

// Route::get('/greet/{name}', function ($name) {
//     return "Hello, $name";
// })->name('greet');

// Route::get('newPage', function () {
//     return redirect('/about');
// })->name('newPage');

// Route::get('dataPage', function () {
//     return redirect()->route('greet', ['name' => 'John']);
// })->name('dataPage');

Route::fallback(function () {
    return "Page not found";
});