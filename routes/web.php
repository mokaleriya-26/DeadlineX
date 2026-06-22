<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);

    Route::post('/tasks/{task}/complete', function (App\Models\Task $task) {
        abort_unless(auth()->id() === $task->user_id, 403);
        $task->update(['status' => $task->status === 'completed' ? 'pending' : 'completed']);
        return redirect()->back();
    })->name('tasks.complete');
});

require __DIR__ . '/auth.php';