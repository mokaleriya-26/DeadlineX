<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reset your password for Deadline Panic Tracker.">
    <title>Forgot Password — Deadline Panic Tracker</title>

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
            grid-template-columns: 1fr 1fr;
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            background: linear-gradient(160deg, #0e0e10 0%, #1a1a1f 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            position: relative;
            overflow: hidden;
            border-right: 1px solid var(--border);
        }

        /* Animated blobs */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.18;
            animation: drift 8s ease-in-out infinite alternate;
        }
        .blob-1 { width: 380px; height: 380px; background: #ef4444; top: -80px; left: -100px; animation-delay: 0s; }
        .blob-2 { width: 280px; height: 280px; background: #f97316; top: 40%; right: -60px; animation-delay: -3s; }
        .blob-3 { width: 220px; height: 220px; background: #eab308; bottom: 40px; left: 20%; animation-delay: -5s; }

        @keyframes drift {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(20px, 30px) scale(1.08); }
        }

        .left-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 4px 20px rgba(231,76,60,0.4);
        }

        .brand-name {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .left-content {
            position: relative;
            z-index: 1;
        }

        .left-headline {
            font-size: 2.6rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1.1;
            margin-bottom: 18px;
        }

        .left-headline .accent-red   { color: var(--critical); }
        .left-headline .accent-orange { color: var(--high); }
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
            background: var(--bg-base);
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
        }

        .auth-header {
            margin-bottom: 30px;
        }

        .auth-title {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 6px;
        }

        .auth-subtitle {
            font-size: 0.88rem;
            color: var(--text-secondary);
            line-height: 1.5;
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
            margin-bottom: 20px;
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

        /* Success banner */
        .alert-success {
            background: rgba(34,197,94,0.08);
            border: 1px solid rgba(34,197,94,0.25);
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 0.83rem;
            color: var(--low);
            display: flex;
            align-items: center;
            gap: 10px;
            line-height: 1.4;
        }

        /* Error banner */
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
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <div class="left-brand">
            <div class="brand-icon">⏰</div>
            <span class="brand-name">Deadline Panic Tracker</span>
        </div>

        <div class="left-content">
            <h1 class="left-headline">
                Forgot<br>
                your <span class="accent-orange">password?</span><br>
                We got <span class="accent-green">you covered.</span>
            </h1>
            <p class="left-sub">
                Just enter your email address and we'll send you a password reset link to get you back on track.
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
            <div class="auth-header">
                <h2 class="auth-title">Reset password 🔑</h2>
                <p class="auth-subtitle">
                    Remembered it? <a href="{{ route('login') }}">Back to sign in</a>
                </p>
            </div>

            {{-- Success / Session status message --}}
            @if(session('status'))
                <div class="alert-success">
                    ✓ {{ session('status') }}
                </div>
            @endif

            {{-- Global error --}}
            @if($errors->any() && !$errors->has('email'))
                <div class="alert-error">
                    ⚠ {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" id="forgotForm">
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

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span id="btnText">Send Password Reset Link →</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        // Loading state on submit
        document.getElementById('forgotForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            document.getElementById('btnText').textContent = 'Sending link…';
            btn.style.opacity = '0.7';
        });
    </script>
</body>
</html>
