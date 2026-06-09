{{-- resources/views/student/projects.blade.php --}}
@extends('layouts.app')

@section('title', 'My Projects - GradProject')
@section('page_title', 'My Projects')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Tabs -->
    <div class="flex flex-wrap gap-2 mb-6">
        <button data-tab="active" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-medium transition-all bg-indigo-600 text-white shadow-sm">
            <i class="fas fa-play-circle mr-2"></i> Active
            <span class="ml-1.5 px-2 py-0.5 bg-white/20 rounded-full text-xs">3</span>
        </button>
        <button data-tab="pending" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-medium transition-all text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
            <i class="fas fa-clock mr-2"></i> Pending
            <span class="ml-1.5 px-2 py-0.5 bg-gray-200 dark:bg-gray-700 rounded-full text-xs">1</span>
        </button>
        <button data-tab="completed" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-medium transition-all text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
            <i class="fas fa-check-circle mr-2"></i> Completed
            <span class="ml-1.5 px-2 py-0.5 bg-gray-200 dark:bg-gray-700 rounded-full text-xs">2</span>
        </button>
        <button data-tab="all" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-medium transition-all text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
            <i class="fas fa-list mr-2"></i> All
            <span class="ml-1.5 px-2 py-0.5 bg-gray-200 dark:bg-gray-700 rounded-full text-xs">6</span>
        </button>
    </div>

    <!-- Search Bar -->
    <div class="relative mb-6">
        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
        <input type="text" id="searchInput" placeholder="Search by project name or entity..." 
               class="w-full pl-11 pr-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
    </div>

    <!-- Projects List -->
    <div id="projectsList" class="space-y-4">
        <!-- Projects will be loaded dynamically -->
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="hidden text-center py-16 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
        <i class="fas fa-folder-open text-5xl text-gray-400 dark:text-gray-500 mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No projects found</h3>
        <p class="text-gray-500 dark:text-gray-400 mb-4">You haven't applied to any projects yet.</p>
        <a href="{{ route('student.problems') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-all">
            <i class="fas fa-search"></i> Browse Problems
        </a>
    </div>

    <!-- Loading State -->
    <div id="loadingState" class="hidden text-center py-16">
        <div class="inline-block w-10 h-10 border-4 border-gray-200 dark:border-gray-700 border-t-indigo-600 rounded-full animate-spin"></div>
        <p class="mt-4 text-gray-500 dark:text-gray-400">Loading your projects...</p>
    </div>
</div>
@endsection

@push('styles')
<style>
    .tab-btn.active {
        background: #4f46e5;
        color: white;
    }
    .dark .tab-btn.active {
        background: #4f46e5;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    // Mock Projects Data
    const projectsData = [
        {
            id: 1,
            title: "Clinic Appointment System",
            entity: "Dr. Filali Clinic",
            location: "Casablanca",
            status: "active",
            progress: 65,
            appliedDate: "May 1, 2026",
            startDate: "May 15, 2026",
            deadline: "Jun 15, 2026",
            category: "Healthcare",
            categoryIcon: "fa-heartbeat",
            skills: ["Python", "Pandas", "Data Visualization"],
            hasRating: false,
            rating: null,
            review: null
        },
        {
            id: 2,
            title: "Sales Performance Dashboard",
            entity: "Fashion Store",
            location: "Rabat",
            status: "active",
            progress: 40,
            appliedDate: "May 10, 2026",
            startDate: "May 20, 2026",
            deadline: "Jun 20, 2026",
            category: "Business",
            categoryIcon: "fa-chart-line",
            skills: ["Power BI", "Excel", "SQL"],
            hasRating: false,
            rating: null,
            review: null
        },
        {
            id: 3,
            title: "Apple Rot Detection AI",
            entity: "Azilal Cooperative",
            location: "Azilal",
            status: "pending",
            progress: 0,
            appliedDate: "May 25, 2026",
            startDate: null,
            deadline: "Jul 1, 2026",
            category: "Agriculture",
            categoryIcon: "fa-seedling",
            skills: ["Deep Learning", "CNN", "Python"],
            hasRating: false,
            rating: null,
            review: null
        },
        {
            id: 4,
            title: "Student Management System",
            entity: "Al-Nahda School",
            location: "Fes",
            status: "completed",
            progress: 100,
            appliedDate: "Mar 1, 2026",
            startDate: "Mar 15, 2026",
            deadline: "May 30, 2026",
            completedDate: "May 28, 2026",
            category: "Education",
            categoryIcon: "fa-graduation-cap",
            skills: ["Laravel", "MySQL", "HTML/CSS"],
            hasRating: true,
            rating: 4.9,
            review: "Excellent work! The system exceeded our expectations and has been fully implemented.",
            academicRating: 18.5
        },
        {
            id: 5,
            title: "Customer Churn Prediction",
            entity: "Telecom Company",
            location: "Casablanca",
            status: "completed",
            progress: 100,
            appliedDate: "Feb 15, 2026",
            startDate: "Mar 1, 2026",
            deadline: "Apr 30, 2026",
            completedDate: "Apr 25, 2026",
            category: "Data Science",
            categoryIcon: "fa-chart-pie",
            skills: ["Python", "Scikit-learn", "Pandas"],
            hasRating: true,
            rating: 4.7,
            review: "Great analysis! The model is now in production and helping us retain customers.",
            academicRating: 17.8
        }
    ];

    let currentTab = 'active';
    let searchTerm = '';

    // Helper Functions
    function getStatusBadgeClass(status) {
        const classes = {
            'active': 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
            'pending': 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400',
            'completed': 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400'
        };
        return classes[status] || classes.pending;
    }

    function getStatusText(status) {
        const texts = { 'active': 'Active', 'pending': 'Pending Review', 'completed': 'Completed' };
        return texts[status] || status;
    }

    function getStatusIcon(status) {
        const icons = { 'active': 'fa-play-circle', 'pending': 'fa-clock', 'completed': 'fa-check-circle' };
        return icons[status] || 'fa-clock';
    }

    function getProgressColor(progress) {
        if (progress < 30) return '#ef4444';
        if (progress < 70) return '#f59e0b';
        return '#10b981';
    }

    // Filter Projects
    function getFilteredProjects() {
        let filtered = [...projectsData];
        
        if (currentTab === 'active') {
            filtered = filtered.filter(p => p.status === 'active');
        } else if (currentTab !== 'all') {
            filtered = filtered.filter(p => p.status === currentTab);
        }
        
        if (searchTerm) {
            filtered = filtered.filter(p => 
                p.title.toLowerCase().includes(searchTerm) || 
                p.entity.toLowerCase().includes(searchTerm)
            );
        }
        
        return filtered;
    }

    // Render Projects
    function renderProjects() {
        const filtered = getFilteredProjects();
        const container = document.getElementById('projectsList');
        const emptyState = document.getElementById('emptyState');
        const loadingState = document.getElementById('loadingState');
        
        // Show loading
        loadingState.classList.remove('hidden');
        container.classList.add('hidden');
        emptyState.classList.add('hidden');
        
        setTimeout(() => {
            loadingState.classList.add('hidden');
            
            if (filtered.length === 0) {
                container.classList.add('hidden');
                emptyState.classList.remove('hidden');
                return;
            }
            
            container.classList.remove('hidden');
            emptyState.classList.add('hidden');
            
            container.innerHTML = filtered.map(project => `
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-all">
                    <!-- Project Header -->
                    <div class="p-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/30">
                        <div class="flex flex-col md:flex-row justify-between items-start gap-3">
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-xs font-medium">
                                        <i class="fas ${project.categoryIcon} text-xs"></i> ${project.category}
                                    </span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">${project.title}</h3>
                                <div class="flex flex-wrap items-center gap-3 mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    <span><i class="fas fa-building mr-1"></i> ${project.entity}</span>
                                    <span><i class="fas fa-map-marker-alt mr-1"></i> ${project.location}</span>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium ${getStatusBadgeClass(project.status)}">
                                <i class="fas ${getStatusIcon(project.status)}"></i> ${getStatusText(project.status)}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Project Details -->
                    <div class="p-5">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Applied On</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">${project.appliedDate}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Started</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">${project.startDate || 'Not started'}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Deadline</p>
                                <p class="text-sm font-medium ${new Date(project.deadline) < new Date() && project.status !== 'completed' ? 'text-red-600 dark:text-red-400' : 'text-gray-900 dark:text-white'}">${project.deadline}</p>
                            </div>
                            ${project.completedDate ? `
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Completed</p>
                                <p class="text-sm font-medium text-green-600 dark:text-green-400">${project.completedDate}</p>
                            </div>
                            ` : ''}
                        </div>
                        
                        <!-- Skills -->
                        <div class="mb-4">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Required Skills</p>
                            <div class="flex flex-wrap gap-2">
                                ${project.skills.map(skill => `<span class="px-2.5 py-1 bg-gray-100 dark:bg-gray-700 rounded-lg text-xs text-gray-600 dark:text-gray-300">${skill}</span>`).join('')}
                            </div>
                        </div>
                        
                        <!-- Progress Bar (for active projects) -->
                        ${project.status === 'active' ? `
                        <div class="mb-5">
                            <div class="flex justify-between text-sm mb-1.5">
                                <span class="text-gray-600 dark:text-gray-400">Project Progress</span>
                                <span class="font-semibold text-gray-900 dark:text-white">${project.progress}%</span>
                            </div>
                            <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-500" style="width: ${project.progress}%; background: linear-gradient(90deg, #4f46e5, ${getProgressColor(project.progress)});"></div>
                            </div>
                        </div>
                        ` : ''}
                        
                        <!-- Rating & Review (for completed projects) -->
                        ${project.hasRating ? `
                        <div class="mb-5 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
                            <div class="flex flex-wrap justify-between items-start gap-3">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Entity Rating</p>
                                    <div class="flex items-center gap-1">
                                        <span class="text-lg font-bold text-gray-900 dark:text-white">${project.rating}</span>
                                        <i class="fas fa-star text-yellow-500"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Academic Rating</p>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">${project.academicRating}<span class="text-sm text-gray-500">/20</span></p>
                                </div>
                                <div class="flex-1 min-w-[150px]">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Feedback</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 italic">"${project.review}"</p>
                                </div>
                            </div>
                        </div>
                        ` : ''}
                        
                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-3 justify-end pt-2">
                            ${project.status === 'pending' ? `
                                <button onclick="viewDetails(${project.id})" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                                    <i class="fas fa-eye mr-1"></i> View Application
                                </button>
                                <button onclick="cancelApplication(${project.id})" class="px-4 py-2 border border-red-300 dark:border-red-700 rounded-lg text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                                    <i class="fas fa-times mr-1"></i> Cancel
                                </button>
                            ` : project.status === 'completed' ? `
                                <button onclick="viewCertificate(${project.id})" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                                    <i class="fas fa-certificate mr-1"></i> Certificate
                                </button>
                                <button onclick="downloadReport(${project.id})" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                                    <i class="fas fa-download mr-1"></i> Report
                                </button>
                            ` : `
                                <button onclick="viewDetails(${project.id})" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                                    <i class="fas fa-eye mr-1"></i> View Details
                                </button>
                                <button onclick="submitWork(${project.id})" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition-all">
                                    <i class="fas fa-upload mr-1"></i> Submit Work
                                </button>
                                <button onclick="messageEntity(${project.id})" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                                    <i class="fas fa-comment mr-1"></i> Message
                                </button>
                            `}
                        </div>
                    </div>
                </div>
            `).join('');
        }, 300);
    }

    // Action Functions
    function viewDetails(id) {
        const project = projectsData.find(p => p.id === id);
        alert(`📋 Viewing details for:\n\n${project.title}\n\nThis feature will be implemented soon!`);
    }

    function submitWork(id) {
        const project = projectsData.find(p => p.id === id);
        alert(`📤 Submit work for:\n\n${project.title}\n\nThis feature will be implemented soon!`);
    }

    function messageEntity(id) {
        const project = projectsData.find(p => p.id === id);
        alert(`💬 Message ${project.entity} about:\n\n${project.title}\n\nThis feature will be implemented soon!`);
    }

    function cancelApplication(id) {
        if (confirm('Are you sure you want to cancel this application?')) {
            alert('❌ Application cancelled!');
        }
    }

    function viewCertificate(id) {
        alert('🎓 Certificate will be generated soon!');
    }

    function downloadReport(id) {
        alert('📄 Report download started!');
    }

    // Tab Switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('active');
                b.classList.add('text-gray-600', 'dark:text-gray-400', 'bg-transparent');
            });
            this.classList.add('active');
            this.classList.remove('text-gray-600', 'dark:text-gray-400', 'bg-transparent');
            
            currentTab = this.dataset.tab;
            renderProjects();
        });
    });

    // Search Input
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function(e) {
        searchTerm = e.target.value.toLowerCase();
        renderProjects();
    });

    // Update tab counts
    function updateTabCounts() {
        const activeCount = projectsData.filter(p => p.status === 'active').length;
        const pendingCount = projectsData.filter(p => p.status === 'pending').length;
        const completedCount = projectsData.filter(p => p.status === 'completed').length;
        
        document.querySelector('[data-tab="active"] .rounded-full').textContent = activeCount;
        document.querySelector('[data-tab="pending"] .rounded-full').textContent = pendingCount;
        document.querySelector('[data-tab="completed"] .rounded-full').textContent = completedCount;
        document.querySelector('[data-tab="all"] .rounded-full').textContent = projectsData.length;
    }

    // Initialize
    updateTabCounts();
    renderProjects();
</script>
@endpush