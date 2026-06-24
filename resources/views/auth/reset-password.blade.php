<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Set your new password for Deadline Panic Tracker.">
    <title>Reset Password — Deadline Panic Tracker</title>

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
            height: 500px;
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
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #e4e4e7;
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(255,255,255,0.1);
        }

        .btn-submit:active {
            transform: translateY(0);
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
                Resetting<br>
                your <span class="accent-red">password.</span><br>
                Secure your <span class="accent-green">tracker.</span>
            </h1>
            <p class="left-sub">
                Choose a strong new password to secure your tasks and regain access to your dashboard.
            </p>
            <div class="stat-pills">
                <div class="stat-pill"><div class="pill-dot red"></div> 🤯 CRITICAL — Overdue</div>
                <div class="stat-pill"><div class="pill-dot orange"></div> 🤬 HIGH — Due today</div>
                <div class="stat-pill"><div class="pill-dot yellow"></div> 😡 MEDIUM — 2-3 days</div>
                <div class="stat-pill"><div class="pill-dot green"></div> 😩 LOW — 4+ days</div>
            </div>
        </div>
        <div class="brand-name">
            5024137 - Riya Pradeep Mokale
        </div>
        <div class="left-footer">
            © {{ date('Y') }} Deadline Panic Tracker — Built with Laravel Herd
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">
        <div class="auth-card">
            <div class="auth-header">
                <h2 class="auth-title">New Password 🔐</h2>
                <p class="auth-subtitle">Choose a safe password you'll remember.</p>
            </div>

            {{-- Global error --}}
            @if($errors->any() && !$errors->has('email') && !$errors->has('password') && !$errors->has('password_confirmation'))
                <div class="alert-error">
                    ⚠ {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}" id="resetForm">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                            value="{{ old('email', $request->email) }}"
                            placeholder="you@example.com"
                            required
                            autofocus
                            autocomplete="username"
                        >
                    </div>
                    @error('email')
                        <div class="input-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔑</span>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                            placeholder="Minimum 8 characters"
                            required
                            autocomplete="new-password"
                        >
                        <button type="button" class="pw-toggle" id="pwToggle" onclick="togglePw('password', 'pwToggle')" aria-label="Show password">
                            👁
                        </button>
                    </div>
                    @error('password')
                        <div class="input-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="input-wrap">
                        <span class="input-icon">🔑</span>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="form-input {{ $errors->has('password_confirmation') ? 'error' : '' }}"
                            placeholder="Repeat password"
                            required
                            autocomplete="new-password"
                        >
                        <button type="button" class="pw-toggle" id="pwConfirmToggle" onclick="togglePw('password_confirmation', 'pwConfirmToggle')" aria-label="Show confirm password">
                            👁
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="input-error">⚠ {{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span id="btnText">Reset Password →</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePw(fieldId, toggleBtnId) {
            const inp = document.getElementById(fieldId);
            const btn = document.getElementById(toggleBtnId);
            if (inp.type === 'password') {
                inp.type = 'text';
                btn.textContent = '🙈';
            } else {
                inp.type = 'password';
                btn.textContent = '👁';
            }
        }

        // Loading state on submit
        document.getElementById('resetForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            document.getElementById('btnText').textContent = 'Resetting password…';
            btn.style.opacity = '0.7';
        });
    </script>
</body>
</html>
