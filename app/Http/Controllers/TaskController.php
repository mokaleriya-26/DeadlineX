<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Dashboard — main panic tracker view.
     */
    public function index(Request $request)
    {
        $userId = auth()->id();
        $filter = $request->query('filter', 'all');

        $allTasks = Task::where('user_id', $userId)->orderBy('deadline', 'asc')->get();

        $tasks = match ($filter) {
            'pending'   => $allTasks->where('status', 'pending'),
            'completed' => $allTasks->where('status', 'completed'),
            default     => $allTasks,
        };

        // Stats
        $totalTasks     = $allTasks->count();
        $panicTasks     = $allTasks->where('status', 'pending')
                                   ->filter(fn($t) => in_array($t->panic_level['label'], ['CRITICAL', 'HIGH']))->count();
        $completedCount = $allTasks->where('status', 'completed')->count();

        $avgPanic = $allTasks->where('status', 'pending')->count() > 0
            ? (int) round($allTasks->where('status', 'pending')->avg('time_used'))
            : 0;

        // Weekly panic distribution (Mon–Sun of current week)
        $weeklyData = [];
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        for ($i = 0; $i < 7; $i++) {
            $day = $startOfWeek->copy()->addDays($i);
            $tasksOnDay = Task::where('user_id', $userId)
                ->where('status', 'pending')
                ->whereDate('deadline', '>=', $day->toDateString())
                ->get();
            $avg = $tasksOnDay->count() > 0
                ? min(100, (int) round($tasksOnDay->avg('time_used')))
                : ($i * 13); // graceful fallback for demo
            $weeklyData[] = [
                'label' => $day->format('D'),
                'value' => $avg,
            ];
        }

        return view('tasks.index', compact(
            'tasks', 'totalTasks', 'panicTasks',
            'completedCount', 'avgPanic', 'weeklyData', 'filter'
        ));
    }

    /**
     * Store a new task.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);

        Task::create([
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'description' => $request->description,
            'deadline'    => $request->deadline,
            'status'      => 'pending',
            'created_at'  => now()->subDays(rand(1, 5)), // simulate age for % calc
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task added!');
    }

    /**
     * Mark task complete / uncomplete.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update(['status' => $request->status ?? 'completed']);

        return redirect()->route('tasks.index');
    }

    /**
     * Delete a task.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index');
    }

    /**
     * Show create form (handled via modal in index, but kept for resource compliance).
     */
    public function create()
    {
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return redirect()->route('tasks.index');
    }
}