
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo-icon">🎓</div>
        <div class="logo-text">
            <h2>GradProject</h2>
            <p>Student Platform</p>
        </div>
    </div>
    
    <nav class="nav-menu">
        <!-- Student Navigation (default example) -->
        <a href="#" class="nav-item active">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{route('student.problems')}}" class="nav-item">
            <i class="fas fa-search"></i>
            <span>Browse Problems</span>
        </a>
        <a href="{{route('student.projects')}}" class="nav-item">
            <i class="fas fa-folder-open"></i>
            <span>My Projects</span>
        </a>
        <a href="{{route('student.portfolio')}}" class="nav-item">
            <i class="fas fa-trophy"></i>
            <span>Portfolio</span>
        </a>
        
        <!-- Settings & Logout -->
        <div style="margin-top: 40px;">
            <a href="#" class="nav-item">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
            <button class="nav-item logout-btn" style="width: 100%; background: none; border: none; cursor: pointer;">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </div>
    </nav>
</aside>

<style>
    /* Sidebar Styles - Pure UI */
    .sidebar {
        width: 280px;
        background: var(--bg-secondary);
        border-right: 1px solid var(--border);
        position: fixed;
        height: 100vh;
        overflow-y: auto;
        transition: all 0.3s ease;
        z-index: 100;
    }

    .sidebar-header {
        padding: 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .logo-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary), #7209b7);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        color: white;
    }

    .logo-text h2 {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
    }

    .logo-text p {
        font-size: 11px;
        color: var(--text-secondary);
        margin: 2px 0 0 0;
    }

    .nav-menu {
        padding: 20px 16px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 12px;
        color: var(--text-secondary);
        font-weight: 500;
        transition: all 0.2s;
        margin-bottom: 4px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
    }

    .nav-item:hover {
        background: var(--primary-light);
        color: var(--primary);
    }

    .nav-item.active {
        background: var(--primary-light);
        color: var(--primary);
    }

    .nav-item i {
        width: 20px;
        font-size: 18px;
    }

    /* Logout button specific */
    .logout-btn {
        margin-top: 8px;
    }

    /* Scrollbar */
    .sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: var(--border);
        border-radius: 4px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: var(--primary);
        border-radius: 4px;
    }

    /* CSS Variables */
    :root {
        --bg-secondary: #ffffff;
        --border: #e2e8f0;
        --text-primary: #1a1a2e;
        --text-secondary: #64748b;
        --primary-light: #e8ecff;
        --primary: #4361ee;
    }

    [data-theme="dark"] {
        --bg-secondary: #1e293b;
        --border: #334155;
        --text-primary: #f8fafc;
        --text-secondary: #94a3b8;
        --primary-light: #2d3a5e;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            position: fixed;
        }
        
        .sidebar.open {
            transform: translateX(0);
        }
    }
</style>

<script>
    // Optional: Theme toggle handling (if needed)
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile sidebar toggle
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        
        if(toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });
        }
    });
</script>