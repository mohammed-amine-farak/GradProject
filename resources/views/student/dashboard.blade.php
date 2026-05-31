{{-- resources/views/student/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Student Dashboard - GradProject')
@section('page_title', 'Student Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="stats-grid">
        <x-stat-card 
            icon="fa-check-circle" 
            value="8" 
            label="Completed Projects" 
            change="↑ +2 this semester" 
            :delay="0.1" 
        />
        <x-stat-card 
            icon="fa-star" 
            value="4.8" 
            label="Average Rating" 
            change="↑ +0.3 from last month" 
            :delay="0.2" 
        />
        <x-stat-card 
            icon="fa-clock" 
            value="124" 
            label="Hours Worked" 
            change="↑ +18 this month" 
            :delay="0.3" 
        />
        <x-stat-card 
            icon="fa-trophy" 
            value="1,250" 
            label="Trust Points" 
            change="Top 5% of students" 
            :delay="0.4" 
        />
    </div>

    <!-- Charts -->
    <div class="charts-grid">
        <div class="chart-card animate-in" style="animation-delay: 0.5s">
            <div class="chart-title">Weekly Activity</div>
            <canvas id="activityChart" height="200"></canvas>
        </div>
        <div class="chart-card animate-in" style="animation-delay: 0.6s">
            <div class="chart-title">Projects by Category</div>
            <canvas id="categoryChart" height="200"></canvas>
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="projects-card animate-in" style="animation-delay: 0.7s">
        <div class="projects-header">
            <h3>Recent Projects</h3>
            <a href="#" style="color: var(--primary); text-decoration: none;">View all →</a>
        </div>
        <div class="projects-table">
            <table>
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Entity</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Due Date</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Project 1 -->
                    <tr>
                        <td><strong>Clinic Appointment System</strong></td>
                        <td>Dr. Filali Clinic</td>
                        <td><span class="status-badge status-progress">In Progress</span></td>
                        <td>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 65%"></div>
                            </div>
                            <small style="color: var(--text-secondary)">65%</small>
                        </td>
                        <td>Jun 15, 2026</td>
                        <td>—</td>
                    </tr>
                    
                    <!-- Project 2 -->
                    <tr>
                        <td><strong>Sales Analysis Dashboard</strong></td>
                        <td>Fashion Store</td>
                        <td><span class="status-badge status-progress">In Progress</span></td>
                        <td>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 40%"></div>
                            </div>
                            <small style="color: var(--text-secondary)">40%</small>
                        </td>
                        <td>Jun 20, 2026</td>
                        <td>—</td>
                    </tr>
                    
                    <!-- Project 3 -->
                    <tr>
                        <td><strong>Apple Rot Detection AI</strong></td>
                        <td>Azilal Cooperative</td>
                        <td><span class="status-badge status-pending">Pending</span></td>
                        <td>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 15%"></div>
                            </div>
                            <small style="color: var(--text-secondary)">15%</small>
                        </td>
                        <td>Jul 01, 2026</td>
                        <td>—</td>
                    </tr>
                    
                    <!-- Project 4 (Completed) -->
                    <tr>
                        <td><strong>Student Management System</strong></td>
                        <td>Al-Nahda School</td>
                        <td><span class="status-badge status-completed">Completed</span></td>
                        <td>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 100%"></div>
                            </div>
                            <small style="color: var(--text-secondary)">100%</small>
                        </td>
                        <td>May 30, 2026</td>
                        <td>4.9 ★</td>
                    </tr>
                    
                    <!-- Project 5 -->
                    <tr>
                        <td><strong>Patient Wait Time Analysis</strong></td>
                        <td>Ibn Sina Hospital</td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 80%"></div>
                            </div>
                            <small style="color: var(--text-secondary)">80%</small>
                        </td>
                        <td>Jun 25, 2026</td>
                        <td>—</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .projects-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 20px;
    }
    
    .projects-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .projects-header h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }
    
    .projects-table {
        width: 100%;
        overflow-x: auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th {
        text-align: left;
        padding: 12px;
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 13px;
        border-bottom: 1px solid var(--border);
    }
    
    td {
        padding: 16px 12px;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }
    
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-active {
        background: #e3f2fd;
        color: #1565c0;
    }
    
    .status-progress {
        background: #fff3e0;
        color: #ed6c02;
    }
    
    .status-pending {
        background: #f3e5f5;
        color: #7b1fa2;
    }
    
    .status-completed {
        background: #e8f5e9;
        color: #2e7d32;
    }
    
    [data-theme="dark"] .status-active {
        background: #0d2b3e;
        color: #42a5f5;
    }
    
    [data-theme="dark"] .status-progress {
        background: #3a2a1a;
        color: #ffa726;
    }
    
    [data-theme="dark"] .status-pending {
        background: #2a1a3e;
        color: #ce93d8;
    }
    
    [data-theme="dark"] .status-completed {
        background: #1a3a1a;
        color: #4caf50;
    }
    
    .progress-bar {
        width: 120px;
        height: 6px;
        background: var(--border);
        border-radius: 3px;
        overflow: hidden;
    }
    
    .progress-fill {
        height: 100%;
        background: var(--primary);
        border-radius: 3px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .charts-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .chart-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 20px;
    }
    
    .chart-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 16px;
    }
    
    @media (max-width: 1200px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }
    }
    
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
    
    .animate-in {
        animation: fadeInUp 0.5s ease forwards;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Activity Chart (Weekly Hours)
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
                legend: {
                    labels: {
                        color: getComputedStyle(document.body).getPropertyValue('--text-secondary')
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleColor: '#fff',
                    bodyColor: '#ddd'
                }
            },
            scales: {
                y: {
                    grid: {
                        color: getComputedStyle(document.body).getPropertyValue('--border')
                    },
                    ticks: {
                        color: getComputedStyle(document.body).getPropertyValue('--text-secondary')
                    }
                },
                x: {
                    grid: {
                        color: getComputedStyle(document.body).getPropertyValue('--border')
                    },
                    ticks: {
                        color: getComputedStyle(document.body).getPropertyValue('--text-secondary')
                    }
                }
            }
        }
    });

    // Category Chart (Projects Distribution)
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
                legend: {
                    position: 'bottom',
                    labels: {
                        color: getComputedStyle(document.body).getPropertyValue('--text-secondary'),
                        usePointStyle: true,
                        boxWidth: 10
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>
@endpush