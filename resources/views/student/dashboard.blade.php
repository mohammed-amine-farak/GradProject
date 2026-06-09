{{-- resources/views/student/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Student Dashboard - GradProject')
@section('page_title', 'Student Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 hover:shadow-lg transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.1s">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
            </div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white mb-1">8</div>
            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">Completed Projects</div>
            <div class="text-xs text-green-600 dark:text-green-400">
                <i class="fas fa-arrow-up"></i> +2 this semester
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 hover:shadow-lg transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.2s">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <i class="fas fa-star text-xl"></i>
                </div>
            </div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white mb-1">4.8</div>
            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">Average Rating</div>
            <div class="text-xs text-green-600 dark:text-green-400">
                <i class="fas fa-arrow-up"></i> +0.3 from last month
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 hover:shadow-lg transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.3s">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <i class="fas fa-clock text-xl"></i>
                </div>
            </div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white mb-1">124</div>
            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">Hours Worked</div>
            <div class="text-xs text-green-600 dark:text-green-400">
                <i class="fas fa-arrow-up"></i> +18 this month
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 hover:shadow-lg transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.4s">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <i class="fas fa-trophy text-xl"></i>
                </div>
            </div>
            <div class="text-3xl font-bold text-gray-900 dark:text-white mb-1">1,250</div>
            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">Trust Points</div>
            <div class="text-xs text-indigo-600 dark:text-indigo-400">Top 5% of students</div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Activity Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 animate-fade-in-up" style="animation-delay: 0.5s">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Weekly Activity</h3>
            <canvas id="activityChart" height="200"></canvas>
        </div>

        <!-- Category Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 animate-fade-in-up" style="animation-delay: 0.6s">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Projects by Category</h3>
            <canvas id="categoryChart" height="200"></canvas>
        </div>
    </div>

    <!-- Recent Projects Table -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 animate-fade-in-up" style="animation-delay: 0.7s">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Projects</h3>
            <a href="#" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">View all →</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 dark:text-gray-400">Project Name</th>
                        <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 dark:text-gray-400">Entity</th>
                        <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 dark:text-gray-400">Status</th>
                        <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 dark:text-gray-400">Progress</th>
                        <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 dark:text-gray-400">Due Date</th>
                        <th class="text-left py-3 px-3 text-xs font-medium text-gray-500 dark:text-gray-400">Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Project 1 -->
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="py-4 px-3 font-medium text-gray-900 dark:text-white">Clinic Appointment System</td>
                        <td class="py-4 px-3 text-gray-600 dark:text-gray-400">Dr. Filali Clinic</td>
                        <td class="py-4 px-3"><span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">In Progress</span></td>
                        <td class="py-4 px-3">
                            <div class="flex items-center gap-2">
                                <div class="w-24 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 rounded-full" style="width: 65%"></div>
                                </div>
                                <span class="text-xs text-gray-500">65%</span>
                            </div>
                        </td>
                        <td class="py-4 px-3 text-gray-600 dark:text-gray-400">Jun 15, 2026</td>
                        <td class="py-4 px-3 text-gray-500">—</td>
                    </tr>
                    
                    <!-- Project 2 -->
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="py-4 px-3 font-medium text-gray-900 dark:text-white">Sales Analysis Dashboard</td>
                        <td class="py-4 px-3 text-gray-600 dark:text-gray-400">Fashion Store</td>
                        <td class="py-4 px-3"><span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">In Progress</span></td>
                        <td class="py-4 px-3">
                            <div class="flex items-center gap-2">
                                <div class="w-24 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 rounded-full" style="width: 40%"></div>
                                </div>
                                <span class="text-xs text-gray-500">40%</span>
                            </div>
                        </td>
                        <td class="py-4 px-3 text-gray-600 dark:text-gray-400">Jun 20, 2026</td>
                        <td class="py-4 px-3 text-gray-500">—</td>
                    </tr>
                    
                    <!-- Project 3 -->
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="py-4 px-3 font-medium text-gray-900 dark:text-white">Apple Rot Detection AI</td>
                        <td class="py-4 px-3 text-gray-600 dark:text-gray-400">Azilal Cooperative</td>
                        <td class="py-4 px-3"><span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">Pending</span></td>
                        <td class="py-4 px-3">
                            <div class="flex items-center gap-2">
                                <div class="w-24 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 rounded-full" style="width: 15%"></div>
                                </div>
                                <span class="text-xs text-gray-500">15%</span>
                            </div>
                        </td>
                        <td class="py-4 px-3 text-gray-600 dark:text-gray-400">Jul 01, 2026</td>
                        <td class="py-4 px-3 text-gray-500">—</td>
                    </tr>
                    
                    <!-- Project 4 (Completed) -->
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="py-4 px-3 font-medium text-gray-900 dark:text-white">Student Management System</td>
                        <td class="py-4 px-3 text-gray-600 dark:text-gray-400">Al-Nahda School</td>
                        <td class="py-4 px-3"><span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Completed</span></td>
                        <td class="py-4 px-3">
                            <div class="flex items-center gap-2">
                                <div class="w-24 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-green-500 rounded-full" style="width: 100%"></div>
                                </div>
                                <span class="text-xs text-gray-500">100%</span>
                            </div>
                        </td>
                        <td class="py-4 px-3 text-gray-600 dark:text-gray-400">May 30, 2026</td>
                        <td class="py-4 px-3 text-yellow-500">4.9 ★</td>
                    </tr>
                    
                    <!-- Project 5 -->
                    <tr>
                        <td class="py-4 px-3 font-medium text-gray-900 dark:text-white">Patient Wait Time Analysis</td>
                        <td class="py-4 px-3 text-gray-600 dark:text-gray-400">Ibn Sina Hospital</td>
                        <td class="py-4 px-3"><span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">Active</span></td>
                        <td class="py-4 px-3">
                            <div class="flex items-center gap-2">
                                <div class="w-24 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 rounded-full" style="width: 80%"></div>
                                </div>
                                <span class="text-xs text-gray-500">80%</span>
                            </div>
                        </td>
                        <td class="py-4 px-3 text-gray-600 dark:text-gray-400">Jun 25, 2026</td>
                        <td class="py-4 px-3 text-gray-500">—</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Get text color based on theme
    function getTextColor() {
        return document.documentElement.getAttribute('data-theme') === 'dark' ? '#94a3b8' : '#64748b';
    }

    // Activity Chart
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Hours',
                data: [4, 3, 5, 6, 4, 2, 1],
                borderColor: '#4361ee',
                backgroundColor: 'rgba(67, 97, 238, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#4361ee',
                pointBorderColor: '#fff',
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { labels: { color: getTextColor() } }
            },
            scales: {
                y: { grid: { color: '#e2e8f0' }, ticks: { color: getTextColor() } },
                x: { grid: { display: false }, ticks: { color: getTextColor() } }
            }
        }
    });

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['Data Science', 'Healthcare', 'Education', 'Business', 'Other'],
            datasets: [{
                data: [35, 25, 20, 15, 5],
                backgroundColor: ['#4361ee', '#06d6a0', '#ff9e00', '#ef476f', '#7209b7'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '60%',
            plugins: {
                legend: { position: 'bottom', labels: { color: getTextColor(), usePointStyle: true, boxWidth: 10 } },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = ((context.raw / total) * 100).toFixed(1);
                            return `${context.label}: ${context.raw} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>
@endpush