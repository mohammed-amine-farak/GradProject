{{-- resources/views/layouts/header.blade.php --}}
<div class="header">
    <div class="page-title">
        <h1>@yield('page_title', 'Dashboard')</h1>
        <p>Welcome back, </p>
    </div>
    <div class="header-actions">
        <button class="theme-toggle" id="themeToggle" style="background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 10px; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
            <i class="fas fa-moon"></i>
        </button>
        <div class="user-avatar" style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--primary), #7209b7); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; color: white;">
           
        </div>
    </div>
</div>

<button id="sidebarToggle" style="display: none; position: fixed; bottom: 20px; right: 20px; background: var(--primary); color: white; border: none; border-radius: 50%; width: 50px; height: 50px; font-size: 24px; cursor: pointer; z-index: 1000; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
    <i class="fas fa-bars"></i>
</button>

<style>
    @media (max-width: 768px) {
        #sidebarToggle { display: flex !important; align-items: center; justify-content: center; }
        .header { flex-direction: column; align-items: flex-start; gap: 16px; margin-bottom: 24px; }
        .header-actions { width: 100%; justify-content: space-between; }
    }
</style>