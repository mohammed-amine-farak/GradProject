{{-- resources/views/student/projects.blade.php --}}
@extends('layouts.app')

@section('title', 'My Projects - GradProject')
@section('page_title', 'My Projects')

@section('content')
<div class="projects-container">
    <!-- Tabs -->
    <div class="projects-tabs">
        <button class="tab-btn active" data-tab="active">
            <i class="fas fa-play-circle"></i> Active Projects
            <span class="tab-count" id="activeCount">0</span>
        </button>
        <button class="tab-btn" data-tab="pending">
            <i class="fas fa-clock"></i> Pending
            <span class="tab-count" id="pendingCount">0</span>
        </button>
        <button class="tab-btn" data-tab="completed">
            <i class="fas fa-check-circle"></i> Completed
            <span class="tab-count" id="completedCount">0</span>
        </button>
        <button class="tab-btn" data-tab="all">
            <i class="fas fa-list"></i> All Projects
            <span class="tab-count" id="allCount">0</span>
        </button>
    </div>

    <!-- Search Bar -->
    <div class="search-section">
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Search by project name or entity..." class="search-input">
        </div>
    </div>

    <!-- Projects List -->
    <div class="projects-list" id="projectsList">
        <!-- Projects will be loaded here -->
    </div>

    <!-- Loading State -->
    <div class="loading-state" id="loadingState" style="display: none;">
        <div class="spinner"></div>
        <p>Loading your projects...</p>
    </div>

    <!-- Empty State -->
    <div class="empty-state" id="emptyState" style="display: none;">
        <i class="fas fa-folder-open"></i>
        <h3>No projects found</h3>
        <p>You haven't applied to any projects yet.</p>
        <a href="{{ route('student.problems') }}" class="btn-primary">Browse Problems</a>
    </div>
</div>

@push('styles')
<style>
    .projects-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Tabs */
    .projects-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 32px;
        background: var(--bg-secondary);
        padding: 8px;
        border-radius: 16px;
        border: 1px solid var(--border);
    }

    .tab-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        background: transparent;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.2s;
    }

    .tab-btn i {
        font-size: 16px;
    }

    .tab-btn:hover {
        background: var(--bg-primary);
        color: var(--text-primary);
    }

    .tab-btn.active {
        background: var(--primary);
        color: white;
    }

    .tab-btn.active .tab-count {
        background: rgba(255,255,255,0.2);
        color: white;
    }

    .tab-count {
        display: inline-block;
        padding: 2px 8px;
        background: var(--bg-primary);
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        color: var(--text-secondary);
    }

    /* Search Section */
    .search-section {
        margin-bottom: 24px;
    }

    .search-bar {
        position: relative;
    }

    .search-bar i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
    }

    .search-input {
        width: 100%;
        padding: 14px 16px 14px 45px;
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 14px;
        font-size: 14px;
        color: var(--text-primary);
        transition: all 0.2s;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    /* Projects List */
    .projects-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .project-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 24px;
        transition: all 0.2s;
    }

    .project-card:hover {
        box-shadow: var(--card-shadow);
        border-color: var(--primary-light);
    }

    .project-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .project-title-section h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 6px;
        color: var(--text-primary);
    }

    .project-entity {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--text-secondary);
    }

    .project-entity i {
        font-size: 12px;
    }

    .project-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-active {
        background: #e3f2fd;
        color: #1565c0;
    }

    .status-in_progress {
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

    .status-rejected {
        background: #ffebee;
        color: #c62828;
    }

    [data-theme="dark"] .status-active {
        background: #0d2b3e;
        color: #42a5f5;
    }

    [data-theme="dark"] .status-in_progress {
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

    .project-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 20px;
        padding: 16px 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-item i {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-primary);
        border-radius: 10px;
        color: var(--primary);
        font-size: 14px;
    }

    .detail-info {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        font-size: 11px;
        color: var(--text-secondary);
    }

    .detail-value {
        font-size: 14px;
        font-weight: 500;
        color: var(--text-primary);
    }

    .project-progress {
        margin-bottom: 20px;
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 13px;
    }

    .progress-bar {
        height: 8px;
        background: var(--border);
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--success));
        border-radius: 4px;
        transition: width 0.3s;
    }

    .project-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    .btn-outline {
        padding: 8px 20px;
        background: transparent;
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-outline:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--primary-light);
    }

    .btn-primary {
        padding: 8px 20px;
        background: var(--primary);
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        color: white;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
    }

    /* Rating Stars */
    .rating {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .rating i {
        color: #ffc107;
        font-size: 14px;
    }

    .rating-value {
        font-weight: 600;
        margin-right: 4px;
    }

    /* Loading & Empty States */
    .loading-state, .empty-state {
        text-align: center;
        padding: 60px;
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 20px;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 3px solid var(--border);
        border-top-color: var(--primary);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto 16px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .empty-state i {
        font-size: 48px;
        color: var(--text-secondary);
        margin-bottom: 16px;
    }

    .empty-state h3 {
        font-size: 20px;
        margin-bottom: 8px;
    }

    @media (max-width: 768px) {
        .projects-tabs {
            flex-wrap: wrap;
        }
        
        .tab-btn {
            flex: auto;
            padding: 10px 16px;
            font-size: 12px;
        }
        
        .project-details {
            grid-template-columns: 1fr;
        }
        
        .project-actions {
            flex-wrap: wrap;
        }
        
        .project-header {
            flex-direction: column;
            gap: 12px;
        }
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
            entity_location: "Casablanca",
            status: "active",
            progress: 65,
            applied_date: "2026-05-01",
            start_date: "2026-05-15",
            deadline: "2026-06-15",
            category: "Healthcare",
            category_icon: "fa-heartbeat",
            skills: ["Python", "Pandas", "Data Viz"],
            has_rating: false,
            rating: null
        },
        {
            id: 2,
            title: "Sales Analysis Dashboard",
            entity: "Fashion Store",
            entity_location: "Rabat",
            status: "in_progress",
            progress: 40,
            applied_date: "2026-05-10",
            start_date: "2026-05-20",
            deadline: "2026-06-20",
            category: "Business",
            category_icon: "fa-chart-bar",
            skills: ["Power BI", "Excel", "SQL"],
            has_rating: false,
            rating: null
        },
        {
            id: 3,
            title: "Apple Rot Detection AI",
            entity: "Azilal Cooperative",
            entity_location: "Azilal",
            status: "pending",
            progress: 0,
            applied_date: "2026-05-25",
            start_date: null,
            deadline: "2026-07-01",
            category: "Agriculture",
            category_icon: "fa-seedling",
            skills: ["Deep Learning", "CNN", "Python"],
            has_rating: false,
            rating: null
        },
        {
            id: 4,
            title: "Student Management System",
            entity: "Al-Nahda School",
            entity_location: "Fes",
            status: "completed",
            progress: 100,
            applied_date: "2026-03-01",
            start_date: "2026-03-15",
            deadline: "2026-05-30",
            completed_date: "2026-05-28",
            category: "Education",
            category_icon: "fa-graduation-cap",
            skills: ["Laravel", "MySQL", "HTML/CSS"],
            has_rating: true,
            rating: 4.9,
            entity_review: "Excellent work! The system exceeded our expectations and has been fully implemented.",
            academic_rating: 18.5
        },
        {
            id: 5,
            title: "Customer Churn Prediction",
            entity: "Telecom Company",
            entity_location: "Casablanca",
            status: "completed",
            progress: 100,
            applied_date: "2026-02-15",
            start_date: "2026-03-01",
            deadline: "2026-04-30",
            completed_date: "2026-04-25",
            category: "Data Science",
            category_icon: "fa-chart-line",
            skills: ["Python", "Scikit-learn", "Pandas"],
            has_rating: true,
            rating: 4.7,
            entity_review: "Great analysis! The model is now in production and helping us retain customers.",
            academic_rating: 17.8
        }
    ];

    let currentTab = 'active';
    let searchTerm = '';

    // DOM Elements
    const projectsList = document.getElementById('projectsList');
    const loadingState = document.getElementById('loadingState');
    const emptyState = document.getElementById('emptyState');
    const searchInput = document.getElementById('searchInput');

    // Update tab counts
    function updateCounts() {
        document.getElementById('activeCount').textContent = projectsData.filter(p => p.status === 'active' || p.status === 'in_progress').length;
        document.getElementById('pendingCount').textContent = projectsData.filter(p => p.status === 'pending').length;
        document.getElementById('completedCount').textContent = projectsData.filter(p => p.status === 'completed').length;
        document.getElementById('allCount').textContent = projectsData.length;
    }

    // Filter projects based on current tab and search
    function getFilteredProjects() {
        let filtered = [...projectsData];
        
        // Filter by tab
        if (currentTab === 'active') {
            filtered = filtered.filter(p => p.status === 'active' || p.status === 'in_progress');
        } else if (currentTab !== 'all') {
            filtered = filtered.filter(p => p.status === currentTab);
        }
        
        // Filter by search
        if (searchTerm) {
            filtered = filtered.filter(p => 
                p.title.toLowerCase().includes(searchTerm) ||
                p.entity.toLowerCase().includes(searchTerm)
            );
        }
        
        return filtered;
    }

    // Get status badge HTML
    function getStatusBadge(status) {
        const badges = {
            'active': { class: 'status-active', icon: 'fa-play-circle', text: 'Active' },
            'in_progress': { class: 'status-in_progress', icon: 'fa-spinner', text: 'In Progress' },
            'pending': { class: 'status-pending', icon: 'fa-clock', text: 'Pending Review' },
            'completed': { class: 'status-completed', icon: 'fa-check-circle', text: 'Completed' },
            'rejected': { class: 'status-rejected', icon: 'fa-times-circle', text: 'Not Selected' }
        };
        const badge = badges[status] || badges.pending;
        return `<span class="project-status ${badge.class}"><i class="fas ${badge.icon}"></i> ${badge.text}</span>`;
    }

    // Format date
    function formatDate(dateString) {
        if (!dateString) return 'Not set';
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }

    // Get progress color
    function getProgressColor(progress) {
        if (progress < 30) return '#ef476f';
        if (progress < 70) return '#ff9e00';
        return '#06d6a0';
    }

    // Render projects
    function renderProjects() {
        loadingState.style.display = 'block';
        projectsList.style.display = 'none';
        emptyState.style.display = 'none';
        
        setTimeout(() => {
            const filtered = getFilteredProjects();
            loadingState.style.display = 'none';
            
            if (filtered.length === 0) {
                projectsList.style.display = 'none';
                emptyState.style.display = 'block';
                return;
            }
            
            projectsList.style.display = 'flex';
            emptyState.style.display = 'none';
            
            projectsList.innerHTML = filtered.map(project => `
                <div class="project-card">
                    <div class="project-header">
                        <div class="project-title-section">
                            <h3>${project.title}</h3>
                            <div class="project-entity">
                                <i class="fas ${project.category_icon}"></i>
                                <span>${project.category}</span>
                                <span>•</span>
                                <i class="fas fa-building"></i>
                                <span>${project.entity}</span>
                                <span>•</span>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>${project.entity_location}</span>
                            </div>
                        </div>
                        ${getStatusBadge(project.status)}
                    </div>
                    
                    <div class="project-details">
                        <div class="detail-item">
                            <i class="fas fa-calendar-alt"></i>
                            <div class="detail-info">
                                <span class="detail-label">Applied On</span>
                                <span class="detail-value">${formatDate(project.applied_date)}</span>
                            </div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-play-circle"></i>
                            <div class="detail-info">
                                <span class="detail-label">Started</span>
                                <span class="detail-value">${formatDate(project.start_date)}</span>
                            </div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-flag-checkered"></i>
                            <div class="detail-info">
                                <span class="detail-label">Deadline</span>
                                <span class="detail-value">${formatDate(project.deadline)}</span>
                            </div>
                        </div>
                        ${project.completed_date ? `
                        <div class="detail-item">
                            <i class="fas fa-check-circle"></i>
                            <div class="detail-info">
                                <span class="detail-label">Completed</span>
                                <span class="detail-value">${formatDate(project.completed_date)}</span>
                            </div>
                        </div>
                        ` : ''}
                    </div>
                    
                    <div class="project-skills" style="margin-bottom: 16px;">
                        <div class="detail-label" style="margin-bottom: 6px;">Required Skills</div>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            ${project.skills.map(skill => `<span class="skill-tag" style="background: var(--bg-primary); padding: 4px 10px; border-radius: 16px; font-size: 12px;">${skill}</span>`).join('')}
                        </div>
                    </div>
                    
                    ${project.status !== 'pending' ? `
                    <div class="project-progress">
                        <div class="progress-header">
                            <span>Project Progress</span>
                            <span>${project.progress}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: ${project.progress}%; background: linear-gradient(90deg, var(--primary), ${getProgressColor(project.progress)});"></div>
                        </div>
                    </div>
                    ` : ''}
                    
                    ${project.has_rating ? `
                    <div style="margin-bottom: 20px; padding: 16px; background: var(--bg-primary); border-radius: 12px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                            <div>
                                <div class="detail-label">Entity Rating</div>
                                <div class="rating">
                                    <span class="rating-value">${project.rating}</span>
                                    ${Array(5).fill().map((_, i) => `<i class="fas fa-star"></i>`).join('')}
                                </div>
                            </div>
                            <div>
                                <div class="detail-label">Academic Rating</div>
                                <div style="font-weight: 600; color: var(--text-primary);">${project.academic_rating}/20</div>
                            </div>
                            <div>
                                <i class="fas fa-quote-left" style="color: var(--text-secondary); opacity: 0.5;"></i>
                                <span style="font-size: 13px; color: var(--text-secondary);">${project.entity_review.substring(0, 80)}...</span>
                            </div>
                        </div>
                    </div>
                    ` : ''}
                    
                    <div class="project-actions">
                        ${project.status === 'pending' ? `
                            <button class="btn-outline" onclick="viewDetails(${project.id})">
                                <i class="fas fa-eye"></i> View Application
                            </button>
                            <button class="btn-outline" onclick="cancelApplication(${project.id})">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        ` : project.status === 'completed' ? `
                            <button class="btn-outline" onclick="viewCertificate(${project.id})">
                                <i class="fas fa-certificate"></i> Certificate
                            </button>
                            <button class="btn-outline" onclick="downloadReport(${project.id})">
                                <i class="fas fa-download"></i> Report
                            </button>
                        ` : `
                            <button class="btn-outline" onclick="viewDetails(${project.id})">
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button class="btn-outline" onclick="submitWork(${project.id})">
                                <i class="fas fa-upload"></i> Submit Work
                            </button>
                            <button class="btn-outline" onclick="messageEntity(${project.id})">
                                <i class="fas fa-comment"></i> Message
                            </button>
                        `}
                    </div>
                </div>
            `).join('');
        }, 300);
    }

    // Filter and render
    function filterAndRender() {
        renderProjects();
    }

    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentTab = btn.dataset.tab;
            filterAndRender();
        });
    });

    // Search input
    searchInput.addEventListener('input', (e) => {
        searchTerm = e.target.value.toLowerCase();
        filterAndRender();
    });

    // Action functions (to be implemented)
    function viewDetails(projectId) {
        const project = projectsData.find(p => p.id === projectId);
        alert(`Viewing details for:\n${project.title}\n\nThis feature will be implemented soon!`);
    }

    function submitWork(projectId) {
        const project = projectsData.find(p => p.id === projectId);
        alert(`Submit work for:\n${project.title}\n\nThis feature will be implemented soon!`);
    }

    function messageEntity(projectId) {
        const project = projectsData.find(p => p.id === projectId);
        alert(`Message ${project.entity} about:\n${project.title}\n\nThis feature will be implemented soon!`);
    }

    function cancelApplication(projectId) {
        if (confirm('Are you sure you want to cancel this application?')) {
            alert('Application cancelled!');
        }
    }

    function viewCertificate(projectId) {
        alert('Certificate will be generated soon!');
    }

    function downloadReport(projectId) {
        alert('Report download started!');
    }

    // Initialize
    updateCounts();
    renderProjects();
</script>
@endpush