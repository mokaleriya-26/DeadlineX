<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sign in to Deadline Panic Tracker — manage your tasks by urgency.">
    <title>Login — DeadlX</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-base:      #0e0e10;
            --bg-card:      #18181b;
            --bg-input:     #27272a;
            --border:       #3f3f46;
            --border-focus: #71717a;
            --text-primary: #fafafa;
            --text-secondary:#a1a1aa;
            --text-muted:   #71717a;
            --critical:     #ef4444;
            --high:         #f97316;
            --medium:       #eab308;
            --low:          #22c55e;
            --accent:       #ffffff;
            --radius:       16px;
            --radius-sm:    10px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { font-size: 15px; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            background-image: url('{{ asset('bgp.png') }}');
            background-size: 94%;
            background-position: left;
            background-attachment: fixed;
            background-color: var(--bg-base);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            position: relative;
            overflow: hidden;
        }

        .left-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .brand-icon {
            width: 80px;
            height: 80px;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(145deg, #c0392b, #e74c3c);
            box-shadow: 0 6px 24px rgba(231,76,60,0.45);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brand-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .brand-name {
            font-size: 40px;
            font-weight: 700;
            letter-spacing: -0.01em;
            font-family: "serif";
        }

        .left-content {
            position: relative;
            z-index: 1;
        }

        .left-headline {
            font-size: 80px;
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1.1;
            margin-bottom: 18px;
        }

        .left-headline .accent-red   { color: var(--critical); }
        .left-headline .accent-green  { color: var(--low); }

        .left-sub {
            font-size: 0.95rem;
            color: var(--text-secondary);
            line-height: 1.6;
            max-width: 380px;
            margin-bottom: 40px;
        }

        /* Panic stat pills */
        .stat-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .stat-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 50px;
            padding: 8px 16px;
            font-size: 0.82rem;
            font-weight: 500;
        }

        .pill-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .pill-dot.red    { background: var(--critical); box-shadow: 0 0 6px var(--critical); }
        .pill-dot.orange { background: var(--high);     box-shadow: 0 0 6px var(--high); }
        .pill-dot.yellow { background: var(--medium);   box-shadow: 0 0 6px var(--medium); }
        .pill-dot.green  { background: var(--low);      box-shadow: 0 0 6px var(--low); }

        .left-footer {
            font-size: 0.75rem;
            color: var(--text-muted);
            position: relative;
            z-index: 1;
        }

        /* ── RIGHT PANEL ── */
        .right-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 32px;
            background-image: url('{{ asset('bgr.png') }}');
            background-size: 100%;
            background-position: left;
            background-attachment: fixed;
            background-color: var(--bg-base);
        }

        .auth-card {
            width: 500px;
            height: 700px;
            border-width: 2px;
            border-style: solid;
            border-color: #6e0808ff;
            background: linear-gradient(145deg, rgba(22,22,24,0.85) 0%, rgba(239,68,68,0.08) 100%);
            border-radius: 15px;
            padding: 50px;
            box-shadow: 0 6px 24px rgba(255,255,255,0.1);
            position: relative;
            z-index: 1;
        }

        .auth-header {
            margin-bottom: 36px;
        }

        .auth-title {
            font-size: 40px;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 6px;
        }

        .auth-subtitle {
            font-size: 0.88rem;
            color: var(--text-secondary);
        }

        .auth-subtitle a {
            color: var(--text-primary);
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1px;
            transition: border-color 0.2s;
        }
        .auth-subtitle a:hover { border-color: var(--text-primary); }

        /* Form */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .form-label a {
            color: var(--text-muted);
            font-size: 0.78rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }
        .form-label a:hover { color: var(--text-primary); }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            opacity: 0.45;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            background: var(--bg-input);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 12px 14px 12px 42px;
            color: var(--text-primary);
            font-size: 0.9rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-input:focus {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(113,113,122,0.15);
            background: #2a2a2e;
        }

        .form-input.error {
            border-color: var(--critical);
            box-shadow: 0 0 0 3px rgba(239,68,68,0.12);
        }

        .input-error {
            font-size: 0.77rem;
            color: var(--critical);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Password toggle */
        .pw-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-muted);
            font-size: 1.1rem;
            padding: 4px;
            line-height: 1;
            transition: color 0.2s;
        }
        .pw-toggle:hover { color: var(--text-secondary); }

        /* Remember row */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .checkbox-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .checkbox-input {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 1.5px solid var(--border);
            border-radius: 5px;
            background: var(--bg-input);
            cursor: pointer;
            transition: all 0.15s;
            flex-shrink: 0;
        }
        .checkbox-input:checked {
            background: var(--text-primary);
            border-color: var(--text-primary);
        }
        .checkbox-input:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.65rem;
            color: #111;
            font-weight: 800;
        }

        .remember-label {
            font-size: 0.83rem;
            color: var(--text-secondary);
            cursor: pointer;
            user-select: none;
        }

        /* Submit button */
        .btn-submit {
            width: 100%;
            background: var(--text-primary);
            color: #0e0e10;
            border: none;
            border-radius: var(--radius-sm);
            padding: 14px;
            font-size: 0.92rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: 0.01em;
        }

        .btn-submit:hover {
            background: #e4e4e7;
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(255,255,255,0.1);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: var(--text-muted);
            font-size: 0.78rem;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* Demo badge */
        .demo-badge {
            background: rgba(34,197,94,0.08);
            border: 1px solid rgba(34,197,94,0.25);
            border-radius: var(--radius-sm);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .demo-badge-icon {
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .demo-badge-text {
            font-size: 0.8rem;
        }

        .demo-badge-text strong {
            color: var(--low);
            display: block;
            font-size: 0.78rem;
            margin-bottom: 2px;
        }

        .demo-badge-text span {
            color: var(--text-secondary);
            font-family: monospace;
        }

        /* Alert error banner */
        .alert-error {
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 0.83rem;
            color: var(--critical);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .left-panel { display: none; }
            .right-panel { padding: 32px 20px; }
        }
    </style>
</head>
<body>

    <!-- LEFT PANEL -->
    <div class="left-panel">
        <div class="left-brand">
            <div class="brand-icon">
                <img src="{{ asset('logo.png') }}" alt="deadx_logo">
            </div>
            <span class="brand-name">DeadX</span>
        </div>

        <div class="left-content">
            <h1 class="left-headline">
                Stop<br>
                <span class="accent-red">panicking.</span><br>
                Start <span class="accent-green">tracking.</span>
            </h1>
            <p class="left-sub">
                Know exactly how close you are to the edge. Every task, ranked by urgency — so you always work on what matters most.
            </p>
            <div class="stat-pills">
                <div class="stat-pill"><div class="pill-dot red"></div> 🤯 CRITICAL — Overdue</div>
                <div class="stat-pill"><div class="pill-dot orange"></div> 🤬 HIGH — Due today</div>
                <div class="stat-pill"><div class="pill-dot yellow"></div> 😡 MEDIUM — 2-3 days</div>
                <div class="stat-pill"><div class="pill-dot green"></div> 😩 LOW — 4+ days</div>
            </div>
        </div>

        <div class="left-footer">
            © {{ date('Y') }} Deadline Panic Tracker — Built with Laravel Herd
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">
        <div class="auth-card">
            <div class="auth-header" >
                <h2 class="auth-title">Welcome back 👋</h2>
                <p class="auth-subtitle">
                    No account? <a href="{{ route('register') }}">Create one free</a>
                </p>
            </div>

            {{-- Global error (credentials mismatch) --}}
            @if($errors->any() && !$errors->has('email') && !$errors->has('password'))
                <div class="alert-error">
                    ⚠ {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email address</label>
                    <div class="input-wrap">
                        <span class="input-icon">✉</span>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <div class="input-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password" class="form-label">
                        Password
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    </label>
                    <div class="input-wrap">
                        <span class="input-icon">🔑</span>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="pw-toggle" id="pwToggle" onclick="togglePw()" aria-label="Show password">
                            👁
                        </button>
                    </div>
                    @error('password')
                        <div class="input-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Remember me --}}
                <div class="remember-row">
                    <div class="checkbox-wrap">
                        <input type="checkbox" id="remember" name="remember" class="checkbox-input">
                    </div>
                    <label for="remember" class="remember-label">Keep me signed in</label>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span id="btnText">Sign in →</span>
                </button>
            </form>

            <div class="divider">or use demo account</div>

            <div class="demo-badge">
                <span class="demo-badge-icon">🚀</span>
                <div class="demo-badge-text">
                    <strong>Demo credentials</strong>
                    <span>demo@example.com &nbsp;/&nbsp; password</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePw() {
            const inp = document.getElementById('password');
            const btn = document.getElementById('pwToggle');
            if (inp.type === 'password') {
                inp.type = 'text';
                btn.textContent = '🙈';
            } else {
                inp.type = 'password';
                btn.textContent = '👁';
            }
        }

        // Loading state on submit
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            document.getElementById('btnText').textContent = 'Signing in…';
            btn.style.opacity = '0.7';
        });

        // Auto-fill demo credentials on badge click
        document.querySelector('.demo-badge').addEventListener('click', function() {
            document.getElementById('email').value = 'demo@example.com';
            document.getElementById('password').value = 'password';
            this.style.borderColor = 'rgba(34,197,94,0.5)';
            setTimeout(() => this.style.borderColor = '', 1000);
        });
    </script>
</body>
</html>
