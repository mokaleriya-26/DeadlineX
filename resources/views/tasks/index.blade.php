<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Deadline Panic Tracker — manage your tasks sorted by urgency, track panic levels, and never miss a deadline.">
    <title>Deadline Panic Tracker</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ─────────────────────────────────────────────
           DESIGN TOKENS
        ───────────────────────────────────────────── */
        :root {
            --bg-base:       #111111;
            --bg-card:       #1c1c1e;
            --bg-card-hover: #242428;
            --bg-input:      #2a2a2e;
            --border:        #2e2e32;
            --border-light:  #3a3a3f;

            --text-primary:  #f5f5f7;
            --text-secondary:#8e8e93;
            --text-muted:    #636366;

            --critical:      #ef4444;
            --critical-glow: rgba(239,68,68,0.18);
            --high:          #f97316;
            --high-glow:     rgba(249,115,22,0.18);
            --medium:        #eab308;
            --medium-glow:   rgba(234,179,8,0.18);
            --low:           #22c55e;
            --low-glow:      rgba(34,197,94,0.18);

            --accent:        #f5f5f7;
            --radius:        14px;
            --radius-sm:     8px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { font-size: 15px; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            line-height: 1.5;
        }

        /* ─────────────────────────────────────────────
           LAYOUT WRAPPER
        ───────────────────────────────────────────── */
        .app-wrapper {
            max-width: 960px;
            margin: 0 auto;
            padding: 28px 20px 60px;
        }

        /* ─────────────────────────────────────────────
           HEADER
        ───────────────────────────────────────────── */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 14px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            box-shadow: 0 4px 20px rgba(231,76,60,0.35);
        }

        .header-title h1 {
            font-size: 1.45rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text-primary);
        }

        .header-title p {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* ─────────────────────────────────────────────
           BUTTONS
        ───────────────────────────────────────────── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            border: 1.5px solid transparent;
            transition: all 0.2s ease;
            text-decoration: none;
            font-family: inherit;
            line-height: 1;
        }

        .btn-ghost {
            background: transparent;
            border-color: var(--border-light);
            color: var(--text-primary);
        }
        .btn-ghost:hover {
            background: var(--bg-card);
            border-color: var(--text-secondary);
        }

        .btn-primary {
            background: var(--text-primary);
            color: #111;
        }
        .btn-primary:hover {
            background: #e0e0e4;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(255,255,255,0.1);
        }

        .btn-danger {
            background: rgba(239,68,68,0.12);
            border-color: rgba(239,68,68,0.3);
            color: var(--critical);
            padding: 6px 12px;
            font-size: 0.78rem;
        }
        .btn-danger:hover { background: rgba(239,68,68,0.22); }

        .btn-success {
            background: rgba(34,197,94,0.12);
            border-color: rgba(34,197,94,0.3);
            color: var(--low);
            padding: 6px 12px;
            font-size: 0.78rem;
        }
        .btn-success:hover { background: rgba(34,197,94,0.22); }

        /* ─────────────────────────────────────────────
           STAT CARDS
        ───────────────────────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 32px;
        }

        @media (max-width: 700px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px 22px;
            transition: border-color 0.2s;
        }
        .stat-card:hover { border-color: var(--border-light); }

        .stat-label {
            font-size: 0.78rem;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 8px;
            text-transform: none;
        }

        .stat-value {
            font-size: 2.1rem;
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1;
        }

        .stat-value.white   { color: var(--text-primary); }
        .stat-value.red     { color: var(--critical); }
        .stat-value.green   { color: var(--low); }
        .stat-value.orange  { color: var(--medium); }

        /* ─────────────────────────────────────────────
           TASK SECTION HEADER
        ───────────────────────────────────────────── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .section-title {
            font-size: 1.05rem;
            font-weight: 600;
        }

        .filter-tabs {
            display: flex;
            gap: 6px;
            background: var(--bg-card);
            padding: 4px;
            border-radius: 50px;
            border: 1px solid var(--border);
        }

        .filter-tab {
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-secondary);
            cursor: pointer;
            border: none;
            background: transparent;
            font-family: inherit;
            text-decoration: none;
            transition: all 0.2s;
        }
        .filter-tab:hover { color: var(--text-primary); }
        .filter-tab.active {
            background: var(--bg-base);
            color: var(--text-primary);
            font-weight: 600;
        }

        /* ─────────────────────────────────────────────
           TASK GRID
        ───────────────────────────────────────────── */
        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 32px;
        }

        @media (max-width: 700px) {
            .tasks-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 900px) and (min-width: 701px) {
            .tasks-grid { grid-template-columns: repeat(2, 1fr); }
        }

        /* ─────────────────────────────────────────────
           TASK CARD
        ───────────────────────────────────────────── */
        .task-card {
            background: var(--bg-card);
            border-radius: var(--radius);
            padding: 20px;
            border: 1.5px solid var(--border);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .task-card:hover {
            border-color: var(--border-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }

        .task-card.critical { border-color: rgba(239,68,68,0.5); background: linear-gradient(135deg, var(--bg-card) 0%, rgba(239,68,68,0.06) 100%); }
        .task-card.high     { border-color: rgba(249,115,22,0.45); background: linear-gradient(135deg, var(--bg-card) 0%, rgba(249,115,22,0.05) 100%); }
        .task-card.medium   { border-color: rgba(234,179,8,0.4); background: linear-gradient(135deg, var(--bg-card) 0%, rgba(234,179,8,0.05) 100%); }
        .task-card.low      { border-color: rgba(34,197,94,0.3); background: linear-gradient(135deg, var(--bg-card) 0%, rgba(34,197,94,0.04) 100%); }
        .task-card.done     { opacity: 0.55; border-color: var(--border); }

        .task-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
            gap: 10px;
        }

        .task-title {
            font-size: 0.97rem;
            font-weight: 700;
            line-height: 1.3;
            flex: 1;
        }

        .task-card.done .task-title {
            text-decoration: line-through;
            color: var(--text-secondary);
        }

        /* Panic badge */
        .panic-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .panic-badge.critical { background: var(--critical-glow); color: var(--critical); border: 1px solid rgba(239,68,68,0.3); }
        .panic-badge.high     { background: var(--high-glow);     color: var(--high);     border: 1px solid rgba(249,115,22,0.3); }
        .panic-badge.medium   { background: var(--medium-glow);   color: var(--medium);   border: 1px solid rgba(234,179,8,0.3); }
        .panic-badge.low      { background: var(--low-glow);      color: var(--low);      border: 1px solid rgba(34,197,94,0.3); }

        .task-deadline {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-bottom: 14px;
        }

        /* Progress bar */
        .progress-wrap {
            margin-bottom: 6px;
        }

        .progress-track {
            height: 4px;
            background: var(--border);
            border-radius: 99px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 99px;
            transition: width 0.6s ease;
        }

        .progress-fill.critical { background: var(--critical); }
        .progress-fill.high     { background: var(--high); }
        .progress-fill.medium   { background: var(--medium); }
        .progress-fill.low      { background: var(--low); }
        .progress-fill.done     { background: var(--text-muted); }

        .progress-label {
            font-size: 0.74rem;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .task-actions {
            display: flex;
            gap: 8px;
            margin-top: 14px;
        }

        /* ─────────────────────────────────────────────
           EMPTY STATE
        ───────────────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }
        .empty-state .emoji { font-size: 3rem; margin-bottom: 12px; }
        .empty-state p { font-size: 0.9rem; }

        /* ─────────────────────────────────────────────
           WEEKLY PANIC CHART
        ───────────────────────────────────────────── */
        .chart-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            margin-bottom: 32px;
        }

        .chart-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .panic-meter-container {
            display: flex;
            align-items: center;
            gap: 48px;
            margin-top: 14px;
        }

        .panic-meter-gauge {
            flex: 0 0 200px;
            width: 200px;
            height: 110px;
            position: relative;
        }

        .gauge-svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .panic-meter-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .panic-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 6px;
        }

        .panic-value {
            display: flex;
            align-items: baseline;
            margin-bottom: 12px;
            line-height: 1;
        }

        .panic-score {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.03em;
        }

        .panic-max {
            font-size: 1.2rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-left: 2px;
        }

        .panic-status-alert {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .panic-status-alert.hot {
            color: #ff6b6b;
        }

        .panic-status-alert.chill {
            color: #4ade80;
        }

        @media (max-width: 600px) {
            .panic-meter-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 24px;
            }
            .panic-meter-info {
                align-items: center;
            }
            .panic-value {
                justify-content: center;
            }
        }

        /* ─────────────────────────────────────────────
           MODAL (New Task)
        ───────────────────────────────────────────── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s;
        }
        .modal-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal {
            background: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: 20px;
            padding: 32px;
            width: 100%;
            max-width: 440px;
            transform: translateY(20px) scale(0.97);
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 24px 80px rgba(0,0,0,0.6);
        }
        .modal-overlay.open .modal {
            transform: translateY(0) scale(1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .modal-title {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .modal-close {
            background: var(--bg-input);
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            color: var(--text-secondary);
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .modal-close:hover {
            background: var(--border-light);
            color: var(--text-primary);
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 6px;
        }

        .form-input, .form-textarea {
            width: 100%;
            background: var(--bg-input);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            color: var(--text-primary);
            font-size: 0.88rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-input:focus, .form-textarea:focus {
            border-color: var(--border-light);
        }

        .form-textarea {
            resize: vertical;
            min-height: 80px;
        }

        /* ─────────────────────────────────────────────
           FOCUS MODE OVERLAY
        ───────────────────────────────────────────── */
        .focus-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.85);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 998;
            flex-direction: column;
            gap: 16px;
        }

        .focus-overlay.open { display: flex; }

        .focus-content {
            text-align: center;
        }

        .focus-emoji { font-size: 4rem; margin-bottom: 12px; }

        .focus-title {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .focus-task {
            font-size: 2rem;
            font-weight: 700;
            color: var(--critical);
            margin-bottom: 12px;
        }

        .focus-sub {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* ─────────────────────────────────────────────
           TOAST
        ───────────────────────────────────────────── */
        .toast {
            position: fixed;
            bottom: 28px;
            right: 28px;
            background: var(--bg-card);
            border: 1px solid var(--low);
            color: var(--low);
            padding: 12px 20px;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 500;
            z-index: 9999;
            transform: translateY(60px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* ─────────────────────────────────────────────
           NAV BAR (auth links)
        ───────────────────────────────────────────── */
        .nav-bar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 12px 20px 0;
            max-width: 960px;
            margin: 0 auto;
            gap: 12px;
        }

        .nav-link {
            font-size: 0.8rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }
        .nav-link:hover { color: var(--text-primary); }

        .nav-user {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Divider */
        .divider { color: var(--border); }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-base); }
        ::-webkit-scrollbar-thumb { background: var(--border-light); border-radius: 99px; }
    </style>
</head>
<body>

    {{-- NAV --}}
    <nav class="nav-bar">
        @auth
            <span class="nav-user">{{ auth()->user()->name }}</span>
            <span class="divider">|</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="nav-link" style="background:none;border:none;cursor:pointer;font-family:inherit;font-size:0.8rem;">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-link">Login</a>
            <span class="divider">|</span>
            <a href="{{ route('register') }}" class="nav-link">Register</a>
        @endauth
    </nav>

    <div class="app-wrapper">

        {{-- HEADER --}}
        <header class="header">
            <div class="header-left">
                <div class="header-icon">⏰</div>
                <div class="header-title">
                    <h1>DeadlineX</h1>
                    <p>{{ now()->format('l, F j') }} — sorted by urgency</p>
                </div>
            </div>
            <div class="header-actions">
                <button class="btn btn-ghost" id="focusModeBtn" onclick="openFocusMode()">
                    🔥 Focus mode
                </button>
                <button class="btn btn-primary" id="newTaskBtn" onclick="openModal()">
                    + New task
                </button>
            </div>
        </header>

        {{-- STATS --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total tasks</div>
                <div class="stat-value white" id="statTotal">{{ $totalTasks }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Panic tasks</div>
                <div class="stat-value red" id="statPanic">{{ $panicTasks }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Completed</div>
                <div class="stat-value green" id="statCompleted">{{ $completedCount }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Avg panic %</div>
                <div class="stat-value orange" id="statAvg">{{ $avgPanic }}%</div>
            </div>
        </div>

        {{-- TASK LIST --}}
        <div class="section-header">
            <h2 class="section-title">All tasks</h2>
            <div class="filter-tabs" role="tablist">
                <a href="{{ route('tasks.index', ['filter' => 'all']) }}"
                   class="filter-tab {{ $filter === 'all' ? 'active' : '' }}"
                   role="tab">All</a>
                <a href="{{ route('tasks.index', ['filter' => 'pending']) }}"
                   class="filter-tab {{ $filter === 'pending' ? 'active' : '' }}"
                   role="tab">Pending</a>
                <a href="{{ route('tasks.index', ['filter' => 'completed']) }}"
                   class="filter-tab {{ $filter === 'completed' ? 'active' : '' }}"
                   role="tab">Completed</a>
            </div>
        </div>

        {{-- TASK CARDS GRID --}}
        <div class="tasks-grid" id="tasksGrid">
            @forelse($tasks as $task)
                @php
                    $panic   = $task->panic_level;
                    $pColor  = $panic['color'];
                    $isDone  = $task->status === 'completed';
                    $timeUsed = $task->time_used;
                    $daysLeft = $task->days_left;
                    $cardClass = $isDone ? 'done' : $pColor;

                    if ($daysLeft < 0) {
                        $deadlineText = 'Overdue by ' . abs($daysLeft) . ' day' . (abs($daysLeft) !== 1 ? 's' : '');
                    } elseif ($daysLeft === 0) {
                        $deadlineText = 'Due today';
                    } else {
                        $deadlineText = 'Due in ' . $daysLeft . ' day' . ($daysLeft !== 1 ? 's' : '');
                    }
                @endphp

                <div class="task-card {{ $cardClass }}" id="task-{{ $task->id }}">
                    <div class="task-card-header">
                        <div class="task-title">{{ $task->title }}</div>
                        @if(!$isDone)
                            <span class="panic-badge {{ $pColor }}">
                                {{ $panic['icon'] }} {{ $panic['label'] }}
                            </span>
                        @else
                            <span class="panic-badge low">✓ Done</span>
                        @endif
                    </div>

                    <div class="task-deadline">{{ $deadlineText }}</div>

                    <div class="progress-wrap">
                        <div class="progress-track">
                            <div class="progress-fill {{ $isDone ? 'done' : $pColor }}"
                                 style="width: {{ $timeUsed }}%"></div>
                        </div>
                        <div class="progress-label">Time used: {{ $timeUsed }}%</div>
                    </div>

                    <div class="task-actions">
                        {{-- Toggle complete --}}
                        <form method="POST" action="{{ route('tasks.complete', $task) }}" style="margin:0">
                            @csrf
                            @if($isDone)
                                <button type="submit" class="btn btn-ghost" style="padding:6px 12px;font-size:0.78rem;">↩ Undo</button>
                            @else
                                <button type="submit" class="btn btn-success">✓ Done</button>
                            @endif
                        </form>

                        {{-- Delete --}}
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" style="margin:0"
                              onsubmit="return confirm('Delete this task?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">✕ Remove</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <div class="emoji">🎉</div>
                    <p>No tasks here — you're all clear!</p>
                </div>
            @endforelse
        </div>

        {{-- PANIC-O-METER --}}
        <div class="chart-card">
            <div class="chart-title">Panic-o-meter</div>
            
            <div class="panic-meter-container">
                <div class="panic-meter-gauge">
                    <svg viewBox="0 0 200 115" class="gauge-svg">
                        <defs>
                            <linearGradient id="gaugeGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#22c55e" />
                                <stop offset="35%" stop-color="#eab308" />
                                <stop offset="65%" stop-color="#f97316" />
                                <stop offset="100%" stop-color="#ef4444" />
                            </linearGradient>
                            <filter id="needleShadow" x="-20%" y="-20%" width="140%" height="140%">
                                <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#000" flood-opacity="0.6" />
                            </filter>
                        </defs>
                        <!-- Colored Arc -->
                        <path d="M 25 100 A 75 75 0 0 1 175 100" fill="none" stroke="url(#gaugeGradient)" stroke-width="16" stroke-linecap="round" />
                        
                        <!-- Needle -->
                        <g transform="rotate({{ ($avgPanic / 100) * 180 - 90 }} 100 100)" filter="url(#needleShadow)">
                            <polygon points="98,100 102,100 100,32" fill="#ffffff" />
                            <circle cx="100" cy="100" r="8" fill="#ffffff" />
                        </g>
                    </svg>
                </div>

                <div class="panic-meter-info">
                    <div class="panic-label">Today's overall panic level</div>
                    <div class="panic-value">
                        <span class="panic-score">{{ $avgPanic }}</span><span class="panic-max">/100</span>
                    </div>
                    
                    <div class="panic-status-alert {{ $panicTasks > 0 ? 'hot' : 'chill' }}">
                        <span class="status-emoji">{{ $panicTasks > 0 ? '🤬' : '😎' }}</span>
                        <span class="status-text">
                            @if($panicTasks > 0)
                                Running hot — {{ $panicTasks }} {{ $panicTasks === 1 ? 'task needs' : 'tasks need' }} attention today
                            @else
                                Chilled out — no urgent tasks today
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- /app-wrapper --}}

    {{-- NEW TASK MODAL --}}
    <div class="modal-overlay" id="modalOverlay" onclick="closeModalOnBg(event)">
        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
            <div class="modal-header">
                <div class="modal-title" id="modalTitle">+ New Task</div>
                <button class="modal-close" onclick="closeModal()" aria-label="Close">✕</button>
            </div>

            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Task title *</label>
                    <input type="text" id="title" name="title" class="form-input"
                           placeholder="e.g. Submit tax filing" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">Description (optional)</label>
                    <textarea id="description" name="description" class="form-textarea"
                              placeholder="Additional details..."></textarea>
                </div>
                <div class="form-group">
                    <label for="deadline" class="form-label">Deadline *</label>
                    <input type="date" id="deadline" name="deadline" class="form-input" required
                           min="{{ now()->toDateString() }}">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;border-radius:10px;padding:13px;">
                    Add Task →
                </button>
            </form>
        </div>
    </div>

    {{-- FOCUS MODE --}}
    <div class="focus-overlay" id="focusOverlay">
        <div class="focus-content">
            <div class="focus-emoji">🔥</div>
            <div class="focus-title">Focus Mode</div>
            <div class="focus-task" id="focusTaskName">
                @php $mostUrgent = collect($tasks)->where('status','pending')->first(); @endphp
                {{ $mostUrgent ? $mostUrgent->title : 'Nothing urgent!' }}
            </div>
            <div class="focus-sub">Most urgent task — you got this!</div>
            <br>
            <button class="btn btn-ghost" onclick="closeFocusMode()">Exit focus mode</button>
        </div>
    </div>

    {{-- TOAST --}}
    <div class="toast" id="toast"></div>

    {{-- CSRF meta for JS (future AJAX) --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        // ── Modal ──────────────────────────────────
        function openModal() {
            document.getElementById('modalOverlay').classList.add('open');
            document.getElementById('title').focus();
        }
        function closeModal() {
            document.getElementById('modalOverlay').classList.remove('open');
        }
        function closeModalOnBg(e) {
            if (e.target === document.getElementById('modalOverlay')) closeModal();
        }

        // ── Focus Mode ────────────────────────────
        function openFocusMode() {
            document.getElementById('focusOverlay').classList.add('open');
        }
        function closeFocusMode() {
            document.getElementById('focusOverlay').classList.remove('open');
        }

        // ── Toast ──────────────────────────────────
        function showToast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3000);
        }

        // ── Keyboard shortcuts ────────────────────
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') { closeModal(); closeFocusMode(); }
            if (e.key === 'n' && !e.target.matches('input,textarea')) openModal();
        });

        // ── Show success toast if redirected after task creation ──
        document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
                showToast("{{ session('success') }}");
            @endif
        });

        // ── Progress bar animation ────────────────
        document.querySelectorAll('.progress-fill').forEach(el => {
            const w = el.style.width;
            el.style.width = '0';
            setTimeout(() => { el.style.width = w; }, 200);
        });
    </script>

</body>
</html>
