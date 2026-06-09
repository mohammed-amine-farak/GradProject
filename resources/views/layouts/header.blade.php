{{-- resources/views/layouts/header.blade.php --}}
<div class="flex justify-between items-center mb-8 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-5 md:p-6">
    <!-- Left Side: Page Title -->
    <div class="flex-1">
        <h1 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white mb-1">
            @yield('page_title', 'Dashboard')
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Welcome back, <strong class="text-indigo-600 dark:text-indigo-400">{{ Auth::user()->name ?? 'Guest' }}</strong>
        </p>
    </div>

    <!-- Right Side: Actions -->
    <div class="flex items-center gap-2 md:gap-3">
        <!-- Notifications -->
        <div class="relative">
            <button id="notificationBtn" class="relative w-9 h-9 md:w-10 md:h-10 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl flex items-center justify-center cursor-pointer transition-all duration-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:border-indigo-400 dark:hover:border-indigo-500 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                <i class="fas fa-bell text-base md:text-lg"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-semibold px-1.5 py-0.5 rounded-full min-w-[18px] text-center">3</span>
            </button>
        </div>

        <!-- Theme Toggle -->
        <button id="themeToggle" class="w-9 h-9 md:w-10 md:h-10 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl flex items-center justify-center cursor-pointer transition-all duration-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:border-indigo-400 dark:hover:border-indigo-500 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
            <i class="fas fa-moon text-base md:text-lg"></i>
        </button>

        <!-- User Dropdown -->
        <div class="relative">
            <button id="userMenuBtn" class="flex items-center gap-2 px-2 py-1.5 md:px-3 md:py-1.5 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-full cursor-pointer transition-all duration-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:border-indigo-400 dark:hover:border-indigo-500">
                <div class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-full flex items-center justify-center text-white font-semibold text-xs md:text-sm">
                    {{ Str::upper(Str::substr(Auth::user()->name ?? 'GU', 0, 2)) }}
                </div>
                <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400 text-xs transition-transform duration-200"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="userMenu" class="absolute top-full right-0 mt-3 w-72 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-xl opacity-0 invisible translate-y-[-10px] transition-all duration-200 z-50">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ Str::upper(Str::substr(Auth::user()->name ?? 'GU', 0, 2)) }}
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name ?? 'Guest User' }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">{{ Auth::user()->email ?? 'guest@example.com' }}</p>
                            <span class="inline-block text-[10px] font-medium px-2 py-0.5 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 rounded-full">
                                <i class="fas fa-graduation-cap mr-1"></i> Student
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="py-2">
                    <a href="" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <i class="fas fa-user w-5 text-gray-400"></i> My Profile
                    </a>
                    <a href="{{ route('student.portfolio') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <i class="fas fa-trophy w-5 text-gray-400"></i> My Portfolio
                    </a>
                    <a href="" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <i class="fas fa-cog w-5 text-gray-400"></i> Settings
                    </a>
                </div>
                
                <div class="border-t border-gray-200 dark:border-gray-700 py-2">
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 w-full text-left transition-colors">
                            <i class="fas fa-sign-out-alt w-5"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Sidebar Toggle -->
<button id="sidebarToggle" class="fixed bottom-5 right-5 z-50 w-12 h-12 bg-indigo-600 text-white rounded-full shadow-lg flex items-center justify-center cursor-pointer transition-all duration-200 hover:bg-indigo-700 hover:scale-105 md:hidden">
    <i class="fas fa-bars text-xl"></i>
</button>

<script>
    // Theme Toggle
    const themeToggle = document.getElementById('themeToggle');
    const htmlElement = document.documentElement;
    const themeIcon = themeToggle.querySelector('i');
    
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        htmlElement.classList.add('dark');
        themeIcon.className = 'fas fa-sun text-base md:text-lg';
    }

    themeToggle.addEventListener('click', () => {
        if (htmlElement.classList.contains('dark')) {
            htmlElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
            themeIcon.className = 'fas fa-moon text-base md:text-lg';
        } else {
            htmlElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
            themeIcon.className = 'fas fa-sun text-base md:text-lg';
        }
    });

    // Toggle User Dropdown
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userMenu = document.getElementById('userMenu');
    const chevronIcon = userMenuBtn.querySelector('.fa-chevron-down');

    userMenuBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        userMenu.classList.toggle('opacity-0');
        userMenu.classList.toggle('invisible');
        userMenu.classList.toggle('translate-y-[-10px]');
        userMenu.classList.toggle('opacity-100');
        userMenu.classList.toggle('visible');
        userMenu.classList.toggle('translate-y-0');
        chevronIcon.style.transform = userMenu.classList.contains('opacity-100') ? 'rotate(180deg)' : 'rotate(0deg)';
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!userMenuBtn.contains(e.target) && !userMenu.contains(e.target)) {
            userMenu.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]');
            userMenu.classList.remove('opacity-100', 'visible', 'translate-y-0');
            chevronIcon.style.transform = 'rotate(0deg)';
        }
    });

    // Mobile Sidebar Toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        });
    }
</script>