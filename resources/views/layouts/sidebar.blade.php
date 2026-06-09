{{-- resources/views/layouts/sidebar.blade.php --}}
<aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-transform duration-300 -translate-x-full lg:translate-x-0">
    <!-- Sidebar Header -->
    <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-xl flex items-center justify-center text-white font-bold text-xl">
            🎓
        </div>
        <div>
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">GradProject</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400">Student Platform</p>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="p-4">
        <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 dark:text-gray-400 font-medium transition-all duration-200 mb-1 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 {{ request()->routeIs('student.dashboard') ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : '' }}">
            <i class="fas fa-th-large w-5 text-lg"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('student.problems') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 dark:text-gray-400 font-medium transition-all duration-200 mb-1 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 {{ request()->routeIs('student.problems') ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : '' }}">
            <i class="fas fa-search w-5 text-lg"></i>
            <span>Browse Problems</span>
        </a>

        <a href="{{ route('student.projects') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 dark:text-gray-400 font-medium transition-all duration-200 mb-1 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 {{ request()->routeIs('student.projects') ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : '' }}">
            <i class="fas fa-folder-open w-5 text-lg"></i>
            <span>My Projects</span>
        </a>

        <a href="{{ route('student.portfolio') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 dark:text-gray-400 font-medium transition-all duration-200 mb-1 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 {{ request()->routeIs('student.portfolio') ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : '' }}">
            <i class="fas fa-trophy w-5 text-lg"></i>
            <span>Portfolio</span>
        </a>

        <!-- Divider -->
        <div class="my-6 border-t border-gray-200 dark:border-gray-700"></div>

        <!-- Settings & Logout -->
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 dark:text-gray-400 font-medium transition-all duration-200 mb-1 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400">
            <i class="fas fa-cog w-5 text-lg"></i>
            <span>Settings</span>
        </a>

        <form method="POST" action="">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 dark:text-gray-400 font-medium transition-all duration-200 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400">
                <i class="fas fa-sign-out-alt w-5 text-lg"></i>
                <span>Logout</span>
            </button>
        </form>
    </nav>
</aside>

<!-- Mobile Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-30 opacity-0 invisible transition-all duration-300 lg:hidden"></div>

<style>
    /* Custom scrollbar for sidebar */
    #sidebar::-webkit-scrollbar {
        width: 4px;
    }

    #sidebar::-webkit-scrollbar-track {
        background: #e2e8f0;
        border-radius: 4px;
    }

    #sidebar::-webkit-scrollbar-thumb {
        background: #6366f1;
        border-radius: 4px;
    }

    .dark #sidebar::-webkit-scrollbar-track {
        background: #334155;
    }

    .dark #sidebar::-webkit-scrollbar-thumb {
        background: #818cf8;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        // Toggle sidebar on mobile
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('translate-x-0');
                sidebar.classList.toggle('-translate-x-full');
                
                if (sidebarOverlay) {
                    sidebarOverlay.classList.toggle('opacity-0');
                    sidebarOverlay.classList.toggle('invisible');
                    sidebarOverlay.classList.toggle('opacity-100');
                    sidebarOverlay.classList.toggle('visible');
                }
            });
        }
        
        // Close sidebar when clicking overlay
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                sidebarOverlay.classList.add('opacity-0', 'invisible');
                sidebarOverlay.classList.remove('opacity-100', 'visible');
            });
        }
        
        // Close sidebar on window resize (if open on mobile)
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                if (sidebarOverlay) {
                    sidebarOverlay.classList.add('opacity-0', 'invisible');
                    sidebarOverlay.classList.remove('opacity-100', 'visible');
                }
            } else {
                if (!sidebar.classList.contains('translate-x-0')) {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                }
            }
        });
    });
</script>