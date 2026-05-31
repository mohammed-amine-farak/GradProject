{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ session('theme', 'light') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GradProject') - {{ config('app.name') }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
     
    
    <style>
        /* جميع الأنماط من اللوحة السابقة */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            --bg-primary: #f5f7fb;
            --bg-secondary: #ffffff;
            --text-primary: #1a1a2e;
            --text-secondary: #64748b;
            --border: #e2e8f0;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 10px 20px -5px rgba(0,0,0,0.02);
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --primary-light: #e8ecff;
            --success: #06d6a0;
            --warning: #ff9e00;
            --danger: #ef476f;
            --info: #4cc9f0;
            --sidebar-width: 280px;
        }

        [data-theme="dark"] {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --border: #334155;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .dashboard { display: flex; min-height: 100vh; }
        .sidebar { width: var(--sidebar-width); background: var(--bg-secondary); border-right: 1px solid var(--border); position: fixed; height: 100vh; overflow-y: auto; transition: all 0.3s ease; z-index: 100; }
        .main-content { flex: 1; margin-left: var(--sidebar-width); padding: 24px 32px; }
        
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); position: fixed; }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }

        /* باقي الأنماط من اللوحة السابقة */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 32px; }
        .stat-card { background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 20px; padding: 24px; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: var(--card-shadow); }
        .charts-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 32px; }
        .chart-card { background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 20px; padding: 20px; }
        @media (max-width: 1200px) { .charts-grid { grid-template-columns: 1fr; } }
        
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-in { animation: fadeInUp 0.5s ease forwards; }
        
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--border); border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 10px; }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="dashboard">
        @include('layouts.sidebar')
        
        <main class="main-content">
            @include('layouts.header')
            
            @yield('content')
        </main>
    </div>
    
    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const htmlElement = document.documentElement;
        
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            htmlElement.setAttribute('data-theme', 'dark');
            if(themeToggle) themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }

        if(themeToggle) {
            themeToggle.addEventListener('click', () => {
                const currentTheme = htmlElement.getAttribute('data-theme');
                if (currentTheme === 'dark') {
                    htmlElement.removeAttribute('data-theme');
                    localStorage.setItem('theme', 'light');
                    themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                } else {
                    htmlElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                }
            });
        }

        // Sidebar Toggle for Mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        if(sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>