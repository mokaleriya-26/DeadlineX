# ⏰ DeadlineX — Deadline Panic Tracker

**DeadlineX** is a premium, custom-styled dark dashboard utility designed to track your pending task schedule sorted by urgency, monitor overall panic levels, and zoom in on critical items when you need to focus.

---

## 🎨 Key Features

1. **Panic-o-meter Gauge Chart**:
   - Replaces traditional distribution charts with a premium circular gauge.
   - Powered by dynamic SVG layout using custom CSS linear gradients spanning Green ➔ Yellow ➔ Orange ➔ Red with rounded endpoints.
   - Rotates the needle dynamically based on your average panic percent via Blade template rendering.
   - Reports the dynamic status of pending tasks (e.g. `🤬 Running hot — 2 tasks need attention today`).

2. **Urgency-Mapping Emojis**:
   - Custom urgency mappings translate task deadlines to dynamic emojis in both task card badges and explanation panels:
     - 🤯 **CRITICAL** (Overdue tasks)
     - 🤬 **HIGH** (Tasks due today or tomorrow)
     - 😟 **MEDIUM** (Tasks due in 2–3 days)
     - 🥺 **LOW** (Tasks due in 4+ days)

3. **🔥 Focus Mode**:
   - An overlay spotlight that hides all distraction to keep you focused exclusively on the single most urgent pending task.
   - Easy key binding triggers for seamless access.

4. **Premium Authentication**:
   - Custom two-panel dark interfaces for **Register**, **Login**, **Forgot Password**, and **Reset Password** views to match the central dashboard aesthetic.

5. **Responsive & Mobile Friendly**:
   - Adaptive flex grids and media queries to resize components and wrap the gauge layout cleanly on mobile screens.

---

## ⚙️ Quick Setup

### Prerequisites
- [Laravel Herd](https://herd.laravel.com) installed (highly recommended for macOS) **OR** PHP 8.3+ and Composer installed locally.

### Setup Instructions

1. **Clone and navigate to the project directory**:
   ```bash
   cd ~/Herd/test
   ```

2. **Install Composer dependencies**:
   ```bash
   composer install
   ```

3. **Initialize Environment Configuration**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set Up Local Database**:
   Run the migrations and seeders to initialize schema tables and seed demo tasks:
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Configure Timezone Alignment (Optional)**:
   By default, Laravel apps run in UTC. To sync task countdowns and dates with your local timezone (e.g. India Standard Time), set the `APP_TIMEZONE` in your `.env` file:
   ```env
   APP_TIMEZONE=Asia/Kolkata
   ```
   Clear the application configurations to register the timezone:
   ```bash
   php artisan config:clear && php artisan view:clear && php artisan cache:clear
   ```

---

## 🚀 Running the App

### Option A: Using Laravel Herd (Recommended)
Since you are inside the Herd path, your app is automatically served locally. Simply open:
```
http://test.test
```

### Option B: Using Artisan Serve
If not using Herd, run the standard development server:
```bash
php artisan serve
```
And access the dashboard at:
```
http://127.0.0.1:8000
```

### 👤 Demo Account Credentials
Log in with the pre-seeded account:
- **Email**: `demo@example.com`
- **Password**: `password`

---

## 📂 Project Architecture

```
app/
├── Http/Controllers/
│   ├── TaskController.php         # Central dashboard logic (stats & weekly scopes)
│   └── Auth/                      # Authentication routes and actions
├── Models/
│   └── Task.php                   # Carbon date-difference & urgency level definitions
├── Policies/
│   └── TaskPolicy.php             # User gate permissions (authorization)

resources/views/
├── auth/                          # Custom styled login, register, password views
└── tasks/
    └── index.blade.php            # Core Dashboard blade template (Vanilla CSS/HTML/JS)
```

---

## 🤖 Results
<img width="2940" height="1752" alt="image" src="https://github.com/user-attachments/assets/bb7a554b-eb4e-40bb-b738-67ebdbb5bd7f" />
<img width="2940" height="1752" alt="image" src="https://github.com/user-attachments/assets/9ed3fb59-0ea0-464e-bcca-25955b54792e" />
<img width="2940" height="1752" alt="image" src="https://github.com/user-attachments/assets/5c069c89-d647-4338-9a53-01bd3ff4c104" />



