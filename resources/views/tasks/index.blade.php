<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DeadX — manage your tasks sorted by urgency, track panic levels, and never miss a deadline.">
    <title>DeadX — Deadline Panic Tracker</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* ─────────────────────────────────────────────
           DESIGN TOKENS
        ───────────────────────────────────────────── */
        :root {
            --bg-base:       #0b0b0b;
            --bg-card:       rgba(20, 20, 22, 0.80);
            --bg-card-solid: #161618;
            --bg-input:      #252528;
            --border:        rgba(255,255,255,0.07);
            --border-light:  rgba(255,255,255,0.13);

            --text-primary:  #f0f0f2;
            --text-secondary:#8a8a90;
            --text-muted:    #55555c;

            --critical:      #ef4444;
            --critical-glow: rgba(239,68,68,0.15);
            --high:          #f97316;
            --high-glow:     rgba(249,115,22,0.15);
            --medium:        #f59e0b;
            --medium-glow:   rgba(245,158,11,0.15);
            --low:           #22c55e;
            --low-glow:      rgba(34,197,94,0.15);

            --radius:        14px;
            --radius-sm:     9px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { font-size: 15px; }

        /* ─── FULL PAGE BACKGROUND ─── */
        body {
            font-family: 'Inter', system-ui, sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
            background-image: url('{{ asset('bgp.png') }}');
            background-size: 100%;
            background-position: center -120px;
            background-attachment: fixed;
            background-color: var(--bg-base);
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(0,0,0,0.10) 0%,
                rgba(0,0,0,0.45) 28%,
                rgba(11,11,11,0.82) 55%,
                rgba(11,11,11,0.97) 100%
            );
            z-index: 0;
            pointer-events: none;
        }

        body > * { position: relative; z-index: 1; }

        /* ─────────────────────────────────────────────
           APP WRAPPER
        ───────────────────────────────────────────── */
        .app-wrapper {
            max-width: 980px;
            margin: 0 auto;
            padding: 0 24px 80px;
        }

        /* ─────────────────────────────────────────────
           TOP NAV (user / logout)
        ───────────────────────────────────────────── */
        .top-nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            padding: 28px 24px 0;
            max-width: 980px;
            margin: 0 auto;
        }

        .nav-user {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.70);
            font-weight: 500;
        }
        .nav-divider { color: rgba(255,255,255,0.22); font-size: 0.8rem; }

        .nav-link {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.70);
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-weight: 500;
            transition: color 0.2s;
            padding: 0;
        }
        .nav-link:hover { color: #fff; }

        /* ─────────────────────────────────────────────
           PAGE HEADER  (logo + title + actions)
        ───────────────────────────────────────────── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 52px 0 28px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .app-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(145deg, #c0392b, #e74c3c);
            box-shadow: 0 6px 24px rgba(231,76,60,0.45);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .app-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .app-info h1 {
            font-size: 1.85rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: #fff;
            line-height: 1;
            margin-bottom: 5px;
            text-shadow: 0 2px 12px rgba(0,0,0,0.5);
        }

        .app-info p {
            font-size: 0.80rem;
            color: rgba(255,255,255,0.50);
            font-weight: 400;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-shrink: 0;
        }

        /* ─────────────────────────────────────────────
           BUTTONS
        ───────────────────────────────────────────── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 20px;
            border-radius: 50px;
            font-size: 0.84rem;
            font-weight: 600;
            cursor: pointer;
            border: 1.5px solid transparent;
            transition: all 0.2s ease;
            text-decoration: none;
            font-family: inherit;
            line-height: 1;
            white-space: nowrap;
        }

        .btn-ghost {
            background: rgba(255,255,255,0.09);
            border-color: rgba(255,255,255,0.14);
            color: var(--text-primary);
            backdrop-filter: blur(4px);
        }
        .btn-ghost:hover {
            background: rgba(255,255,255,0.16);
            border-color: rgba(255,255,255,0.22);
        }

        .btn-primary {
            background: #f0f0f2;
            color: #111;
            border-color: transparent;
        }
        .btn-primary:hover {
            background: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(255,255,255,0.14);
        }

        /* ─────────────────────────────────────────────
           STAT CARDS
        ───────────────────────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 36px;
        }

        @media (max-width: 680px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        .stat-card {
            background: rgba(14, 14, 16, 0.90);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 18px;
            padding: 22px 22px 22px;
            position: relative;
            overflow: hidden;
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 14px 44px rgba(0,0,0,0.55); }

        #total-panic {
            border-color: rgba(239,68,68,0.45);
            background: linear-gradient(145deg, rgba(22,22,24,0.85) 0%, rgba(239,68,68,0.08) 100%);
        }

        #complete {
            border-color: rgba(34,197,94,0.32);
            background: linear-gradient(145deg, rgba(22,22,24,0.85) 0%, rgba(34,197,94,0.06) 100%);
        }

        #avg-panic {
            border-color: rgba(245,158,11,0.40);
            background: linear-gradient(145deg, rgba(22,22,24,0.85) 0%, rgba(245,158,11,0.07) 100%); 
        }

        .stat-ghost {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            user-select: none;
            pointer-events: none;
            font-size: 2rem;
            opacity: 0.32;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.76rem;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 14px;
        }

        .stat-value {
            font-size: 2.55rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1;
        }

        .stat-value.white  { color: #f0f0f2; }
        .stat-value.red    { color: var(--critical); }
        .stat-value.green  { color: var(--low); }
        .stat-value.orange { color: var(--medium); }

        /* ─────────────────────────────────────────────
           SECTION HEADER + FILTER TABS
        ───────────────────────────────────────────── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .filter-tabs {
            display: flex;
            gap: 4px;
            background: rgba(255,255,255,0.04);
            padding: 3px;
            border-radius: 50px;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .filter-tab {
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-secondary);
            cursor: pointer;
            border: none;
            background: transparent;
            font-family: inherit;
            text-decoration: none;
            transition: all 0.18s;
            line-height: 1.4;
        }
        .filter-tab:hover { color: var(--text-primary); }
        .filter-tab.active {
            background: rgba(255,255,255,0.12);
            color: var(--text-primary);
            font-weight: 600;
        }

        /* ─────────────────────────────────────────────
           TASK GRID
        ───────────────────────────────────────────── */
        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 13px;
            margin-bottom: 28px;
        }

        @media (max-width: 680px) {
            .tasks-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 900px) and (min-width: 681px) {
            .tasks-grid { grid-template-columns: repeat(2, 1fr); }
        }

        /* ─────────────────────────────────────────────
           TASK CARD
        ───────────────────────────────────────────── */
        .task-card {
            background: rgba(22, 22, 24, 0.82);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: var(--radius);
            padding: 18px 18px 16px;
            border: 1.5px solid rgba(255,255,255,0.07);
            transition: all 0.22s ease;
            position: relative;
            overflow: hidden;
        }

        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 36px rgba(0,0,0,0.50);
        }

        .task-card.critical {
            border-color: rgba(239,68,68,0.45);
            background: linear-gradient(145deg, rgba(22,22,24,0.85) 0%, rgba(239,68,68,0.08) 100%);
        }
        .task-card.high {
            border-color: rgba(249,115,22,0.40);
            background: linear-gradient(145deg, rgba(22,22,24,0.85) 0%, rgba(249,115,22,0.07) 100%);
        }
        .task-card.medium {
            border-color: rgba(245,158,11,0.40);
            background: linear-gradient(145deg, rgba(22,22,24,0.85) 0%, rgba(245,158,11,0.07) 100%);
        }
        .task-card.low {
            border-color: rgba(34,197,94,0.32);
            background: linear-gradient(145deg, rgba(22,22,24,0.85) 0%, rgba(34,197,94,0.06) 100%);
        }
        .task-card.done {
            opacity: 0.52;
            border-color: rgba(255,255,255,0.06);
            background: rgba(22,22,24,0.75);
        }

        .task-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 8px;
        }

        .task-title {
            font-size: 0.93rem;
            font-weight: 700;
            line-height: 1.3;
            flex: 1;
            color: var(--text-primary);
        }

        .task-card.done .task-title {
            text-decoration: line-through;
            color: var(--text-secondary);
        }

        /* ── Panic Badge ── */
        .panic-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            white-space: nowrap;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .panic-badge.critical  { background: var(--critical-glow);  color: var(--critical); border: 1px solid rgba(239,68,68,0.28); }
        .panic-badge.high      { background: var(--high-glow);       color: var(--high);     border: 1px solid rgba(249,115,22,0.28); }
        .panic-badge.medium    { background: var(--medium-glow);     color: var(--medium);   border: 1px solid rgba(245,158,11,0.28); }
        .panic-badge.low       { background: var(--low-glow);        color: var(--low);      border: 1px solid rgba(34,197,94,0.28); }
        .panic-badge.done-badge { background: rgba(34,197,94,0.10); color: var(--low);       border: 1px solid rgba(34,197,94,0.25); }

        .task-deadline {
            font-size: 0.78rem;
            color: var(--text-secondary);
            margin-bottom: 12px;
        }

        /* Progress */
        .progress-wrap { margin-bottom: 6px; }

        .progress-track {
            height: 4px;
            background: rgba(255,255,255,0.07);
            border-radius: 99px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 99px;
            transition: width 0.65s ease;
        }

        .progress-fill.critical { background: var(--critical); }
        .progress-fill.high     { background: var(--high); }
        .progress-fill.medium   { background: var(--medium); }
        .progress-fill.low      { background: var(--low); }
        .progress-fill.done     { background: var(--text-muted); }

        .progress-label {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 5px;
            margin-bottom: 12px;
        }

        .task-actions {
            display: flex;
            gap: 7px;
            align-items: center;
        }

        .btn-sm-danger {
            background: rgba(239,68,68,0.10);
            border: 1px solid rgba(239,68,68,0.25);
            color: var(--critical);
            padding: 5px 12px;
            font-size: 0.77rem;
            border-radius: 50px;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .btn-sm-danger:hover { background: rgba(239,68,68,0.20); }

        .btn-sm-success {
            background: rgba(34,197,94,0.10);
            border: 1px solid rgba(34,197,94,0.25);
            color: var(--low);
            padding: 5px 12px;
            font-size: 0.77rem;
            border-radius: 50px;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .btn-sm-success:hover { background: rgba(34,197,94,0.20); }

        .btn-sm-ghost {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.10);
            color: var(--text-secondary);
            padding: 5px 12px;
            font-size: 0.77rem;
            border-radius: 50px;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .btn-sm-ghost:hover { background: rgba(255,255,255,0.10); }

        /* ─────────────────────────────────────────────
           EMPTY STATE
        ───────────────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
            grid-column: 1 / -1;
        }
        .empty-state .emoji { font-size: 3rem; margin-bottom: 12px; }
        .empty-state p { font-size: 0.88rem; }

        /* ─────────────────────────────────────────────
           PANIC-O-METER CARD
        ───────────────────────────────────────────── */
        .chart-card {
            background: rgba(16,16,18,0.80);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: var(--radius);
            padding: 26px 28px;
            margin-bottom: 28px;
        }

        .chart-title {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .panic-meter-container {
            display: flex;
            align-items: center;
            gap: 44px;
        }

        .panic-meter-gauge { flex: 0 0 200px; width: 200px; height: 112px; }
        .gauge-svg { width: 100%; height: 100%; display: block; }
        .panic-meter-info { display: flex; flex-direction: column; justify-content: center; }
        .panic-label { font-size: 0.82rem; color: var(--text-secondary); margin-bottom: 6px; }
        .panic-value { display: flex; align-items: baseline; margin-bottom: 10px; line-height: 1; }
        .panic-score { font-size: 2.8rem; font-weight: 800; color: var(--text-primary); letter-spacing: -0.03em; }
        .panic-max   { font-size: 1.1rem; color: var(--text-muted); font-weight: 500; margin-left: 3px; }

        .panic-status-alert {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .panic-status-alert.hot   { color: #ff6b6b; }
        .panic-status-alert.chill { color: #4ade80; }

        @media (max-width: 600px) {
            .panic-meter-container { flex-direction: column; align-items: center; text-align: center; gap: 20px; }
            .panic-meter-info { align-items: center; }
            .panic-value { justify-content: center; }
        }

        /* ─────────────────────────────────────────────
           MODAL (New Task)
        ───────────────────────────────────────────── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.75);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.22s;
        }
        .modal-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal {
            background: #1c1c1e;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 32px;
            width: 100%;
            max-width: 440px;
            transform: translateY(22px) scale(0.97);
            transition: transform 0.26s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 28px 80px rgba(0,0,0,0.70);
        }
        .modal-overlay.open .modal { transform: translateY(0) scale(1); }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .modal-title { font-size: 1.05rem; font-weight: 700; }

        .modal-close {
            background: rgba(255,255,255,0.08);
            border: none;
            width: 32px; height: 32px;
            border-radius: 50%;
            color: var(--text-secondary);
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .modal-close:hover { background: rgba(255,255,255,0.14); color: var(--text-primary); }

        .form-group { margin-bottom: 16px; }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 6px;
        }

        .form-input, .form-textarea {
            width: 100%;
            background: var(--bg-input);
            border: 1.5px solid rgba(255,255,255,0.08);
            border-radius: var(--radius-sm);
            padding: 10px 13px;
            color: var(--text-primary);
            font-size: 0.87rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-input:focus, .form-textarea:focus { border-color: rgba(255,255,255,0.18); }
        .form-textarea { resize: vertical; min-height: 80px; }

        /* ─────────────────────────────────────────────
           FOCUS MODE
        ───────────────────────────────────────────── */
        .focus-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.90);
            backdrop-filter: blur(10px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 998;
            flex-direction: column;
            gap: 16px;
        }
        .focus-overlay.open { display: flex; }

        .focus-content { text-align: center; }
        .focus-emoji { font-size: 4rem; margin-bottom: 12px; }
        .focus-title { font-size: 1.5rem; font-weight: 800; margin-bottom: 8px; }
        .focus-task  { font-size: 2rem; font-weight: 700; color: var(--critical); margin-bottom: 12px; }
        .focus-sub   { color: var(--text-secondary); font-size: 0.88rem; }

        /* ─────────────────────────────────────────────
           TOAST
        ───────────────────────────────────────────── */
        .toast {
            position: fixed;
            bottom: 28px;
            right: 28px;
            background: #1c1c1e;
            border: 1px solid var(--low);
            color: var(--low);
            padding: 12px 20px;
            border-radius: var(--radius-sm);
            font-size: 0.84rem;
            font-weight: 500;
            z-index: 9999;
            transform: translateY(60px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .toast.show { transform: translateY(0); opacity: 1; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.12); border-radius: 99px; }

        /* ─── Responsive header ─── */
        @media (max-width: 600px) {
            .page-header { flex-direction: column; align-items: flex-start; gap: 14px; }
            .header-actions { width: 100%; justify-content: flex-start; }
        }
    </style>
</head>
<body>

    {{-- ══════════════════════════════
         TOP NAV (user/logout)
    ══════════════════════════════ --}}
    <nav class="top-nav">
        @auth
            <span class="nav-user">{{ auth()->user()->name }}</span>
            <span class="nav-divider">|</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="nav-link">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-link">Login</a>
            <span class="nav-divider">|</span>
            <a href="{{ route('register') }}" class="nav-link">Register</a>
        @endauth
    </nav>

    {{-- ══════════════════════════════
         MAIN CONTENT
    ══════════════════════════════ --}}
    <div class="app-wrapper">

        {{-- PAGE HEADER: logo + title + buttons --}}
        <div class="page-header">
            <div class="header-left">
                <div class="app-icon">
                    <img src="{{ asset('logo.png') }}" alt="DeadX Logo">
                </div>
                <div class="app-info">
                    <h1>DeadX</h1>
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
        </div>

        {{-- STAT CARDS --}}
        <div class="stats-grid">

            {{-- Total tasks — white, clipboard icon --}}
            <div class="stat-card" id="total-panic">
                <div class="stat-label">Total tasks</div>
                <div class="stat-value white" id="statTotal">{{ $totalTasks }}</div>
                <div class="stat-ghost">
                    <svg width="62" height="62" viewBox="0 0 24 24" fill="none"
                        stroke="#ef4444" stroke-width="1.4"
                        stroke-linecap="round" stroke-linejoin="round"
                        style="filter:drop-shadow(0 0 12px rgba(239,68,68,0.7))">
                        <rect x="9" y="2" width="6" height="4" rx="1.5"/>
                        <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/>
                        <line x1="9" y1="11" x2="15" y2="11"/>
                        <line x1="9" y1="15" x2="13" y2="15"/>
                    </svg>
                </div>
            </div>

            {{-- Panic tasks — red, skull icon --}}
            <div class="stat-card" id="total-panic">
                <div class="stat-label">Panic tasks</div>
                <div class="stat-value red" id="statPanic">{{ $panicTasks }}</div>
                <div class="stat-ghost">
                    <svg width="60" height="60" viewBox="0 0 128 128"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        aria-hidden="true" role="img" class="iconify iconify--noto" 
                        preserveAspectRatio="xMidYMid meet" fill="#ef4444">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <radialGradient id="IconifyId17ecdb2904d178eab20356" cx="63.887" cy="74.925" r="64.936" gradientTransform="matrix(1 0 0 1.0839 0 -6.29)" gradientUnits="userSpaceOnUse">
                                <stop offset=".396" stop-color="#b52821"></stop>
                                <stop offset=".993" stop-color="#530c03"></stop>
                            </radialGradient>
                            <path d="M111.79 67.58c.57-3.41 2.93-15.55.78-27.47c-1.37-7.59-6.11-17.5-11.4-22.51C90.96 7.93 76.74 4 63.66 4s-26.59 3.93-36.8 13.6c-5.29 5.01-10.03 14.93-11.4 22.51c-2.15 11.92.21 24.06.78 27.47c.77 4.65-1.27 9.79-1.67 14.42c-.43 5.04 1.95 8.95 6.21 11.72c3.55 2.31 7.69 3.53 11.53 5.32c4.57 2.13.42 9.82 2.11 13.7c.85 1.96 2.71 3.31 4.63 4.26c2.44 1.22 5.25 1.98 7.9 1.31c-.4.1.76 2.43 2.29 3.38c1.4.86 3.13 1.74 4.74 2.09c3.2.7 6.37-.48 8.35-1.5a3.67 3.67 0 0 1 3.41 0c1.98 1.02 5.15 2.2 8.35 1.5c2.41-.53 4.56-1.96 6.1-3.83c.72-.88 1.84-1.36 2.97-1.28c3.36.22 8.5-1.15 10.73-6.22c1.25-2.82-.01-6.14.82-9.09c1.41-5 6.33-6.24 10.29-8.57c5.25-3.08 8.35-6.53 8.49-11.39c.14-5.16-2.36-11.83-1.7-15.82z" fill="url(#IconifyId17ecdb2904d178eab20356)"></path>
                            <ellipse transform="rotate(-75.001 39.832 64.151)" cx="39.83" cy="64.15" rx="13.74" ry="12.49" fill="#252e30"></ellipse>
                            <ellipse transform="rotate(-14.999 88.202 64.154)" cx="88.2" cy="64.15" rx="12.49" ry="13.74" fill="#252e30"></ellipse>
                            <path d="M55.98 86.71c0-4.43 3.59-15.41 8.03-15.41s8.03 10.97 8.03 15.41c0 9.01-8.03 2.87-8.03 2.87s-8.03 6.66-8.03-2.87z" fill="#252e30"></path>
                            <path d="M42.63 118.43c-1.2-.23-2.34-.6-3.36-1.35c.85-.2 1.7-.42 2.48-.8c1.94-.97 1.89-2.53 2.32-4.45c.37-1.68.73-3.36 1.16-5.03c.29-1.12 1.03-2.19 2.18-2.03c1.44.2 1.58 1.22 1.34 2.77c-.23 1.44-1.97 10.93-1.97 10.94c-.08.43-2.97.14-3.25.1c-.3-.04-.6-.09-.9-.15z" fill="#000000"></path>
                            <path d="M86.04 118.43c1.2-.23 2.34-.6 3.36-1.35c-.85-.2-1.7-.42-2.48-.8c-1.94-.97-1.89-2.53-2.32-4.45c-.37-1.68-.73-3.36-1.16-5.03c-.29-1.12-1.03-2.19-2.18-2.03c-1.44.2-1.58 1.22-1.34 2.77c.23 1.44 1.97 10.93 1.97 10.94c.08.43 2.97.14 3.25.1c-.3-.04-.6-.09-.9-.15z" fill="#000000"></path>
                            <path d="M59.47 123.45s2.27-3.06 2.35-5.15c.15-3.73.36-8.77.36-11.69c0-1.16.7-2.05 1.87-2.05c1.16 0 1.81.78 1.81 1.94c0 .05.27 6.83.27 11.55c0 2.18 2.44 5.39 2.44 5.39c-1-.45-2.75-1.32-4.55-1.24c-2.28.11-4.55 1.25-4.55 1.25z" fill="#000000"></path>
                        </g>
                    </svg>
                </div>
            </div>

            {{-- Completed — green, circle-check icon --}}
            <div class="stat-card" id="complete">
                <div class="stat-label">Completed</div>
                <div class="stat-value green" id="statCompleted">{{ $completedCount }}</div>
                <div class="stat-ghost">
                    <svg width="62" height="62" viewBox="0 0 24 24" fill="none"
                         stroke="#22c55e" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"
                         style="filter:drop-shadow(0 0 10px rgba(34,197,94,0.65))">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="8 12 11 15 16 9"/>
                    </svg>
                </div>
            </div>

            {{-- Avg panic — orange, gauge/speedometer icon --}}
            <div class="stat-card" id="avg-panic">
                <div class="stat-label">Avg panic %</div>
                <div class="stat-value orange" id="statAvg">{{ $avgPanic }}%</div>
                <div class="stat-ghost">
                    <svg width="62" height="62" viewBox="0 0 24 24" fill="none"
                         stroke="#f59e0b" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"
                         style="filter:drop-shadow(0 0 10px rgba(245,158,11,0.65))">
                        <path d="M12 2a10 10 0 100 20A10 10 0 0012 2z"/>
                        <path d="M12 6v2M6 12H4M20 12h-2M7.76 7.76l-1.42-1.42M17.66 7.76l1.42-1.42"/>
                        <line x1="12" y1="12" x2="15.5" y2="9" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="12" cy="12" r="1.5" fill="#f59e0b" stroke="none"/>
                    </svg>
                </div>
            </div>

        </div>

        {{-- SECTION HEADER --}}
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
                    $panic       = $task->panic_level;
                    $pColor      = $panic['color'];
                    $isDone      = $task->status === 'completed';
                    $timeUsed    = $task->time_used;
                    $daysLeft    = $task->days_left;
                    $cardClass   = $isDone ? 'done' : $pColor;

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
                                {{ $panic['icon'] }} {{ strtoupper($panic['label']) }}
                            </span>
                        @else
                            <span class="panic-badge done-badge">✓ Done</span>
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
                                <button type="submit" class="btn-sm-ghost">↩ Undo</button>
                            @else
                                <button type="submit" class="btn-sm-success">✓ Done</button>
                            @endif
                        </form>

                        {{-- Delete --}}
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" style="margin:0"
                              onsubmit="return confirm('Delete this task?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm-danger">✕ Remove</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
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
                                <stop offset="0%"   stop-color="#22c55e" />
                                <stop offset="35%"  stop-color="#eab308" />
                                <stop offset="65%"  stop-color="#f97316" />
                                <stop offset="100%" stop-color="#ef4444" />
                            </linearGradient>
                            <filter id="needleShadow" x="-20%" y="-20%" width="140%" height="140%">
                                <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#000" flood-opacity="0.6" />
                            </filter>
                        </defs>
                        <!-- Track -->
                        <path d="M 25 100 A 75 75 0 0 1 175 100"
                              fill="none"
                              stroke="rgba(255,255,255,0.08)"
                              stroke-width="16"
                              stroke-linecap="round" />
                        <!-- Colored arc -->
                        <path d="M 25 100 A 75 75 0 0 1 175 100"
                              fill="none"
                              stroke="url(#gaugeGradient)"
                              stroke-width="16"
                              stroke-linecap="round" />
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
                        <span class="panic-score">{{ $avgPanic }}</span>
                        <span class="panic-max">/100</span>
                    </div>
                    <div class="panic-status-alert {{ $panicTasks > 0 ? 'hot' : 'chill' }}">
                        <span>{{ $panicTasks > 0 ? '🤬' : '😎' }}</span>
                        <span>
                            @if($panicTasks > 0)
                                Running hot — {{ $panicTasks }} {{ $panicTasks === 1 ? 'task needs' : 'tasks need' }} attention
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
                <button type="submit" class="btn btn-primary"
                        style="width:100%;justify-content:center;border-radius:10px;padding:13px;">
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

        // ── Show success toast after task creation ──
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
