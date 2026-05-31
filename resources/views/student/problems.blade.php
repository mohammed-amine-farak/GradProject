{{-- resources/views/student/problems.blade.php --}}
@extends('layouts.app')

@section('title', 'Browse Problems - GradProject')
@section('page_title', 'Browse Problems')

@section('content')
<div class="browse-container">
    <!-- Search & Filter Section -->
    <div class="filter-section">
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Search by title, description, or entity..." class="search-input">
        </div>
        
        <div class="filters-grid">
            <div class="filter-group">
                <label><i class="fas fa-layer-group"></i> Category</label>
                <select id="categoryFilter" class="filter-select">
                    <option value="all">All Categories</option>
                    <option value="data-science">📊 Data Science</option>
                    <option value="healthcare">🏥 Healthcare</option>
                    <option value="education">📚 Education</option>
                    <option value="business">💼 Business</option>
                    <option value="agriculture">🌾 Agriculture</option>
                    <option value="technology">💻 Technology</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label><i class="fas fa-chart-line"></i> Difficulty</label>
                <select id="difficultyFilter" class="filter-select">
                    <option value="all">All Levels</option>
                    <option value="beginner">🌱 Beginner</option>
                    <option value="intermediate">📈 Intermediate</option>
                    <option value="advanced">🚀 Advanced</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label><i class="fas fa-clock"></i> Duration</label>
                <select id="durationFilter" class="filter-select">
                    <option value="all">Any Duration</option>
                    <option value="1-2">1-2 weeks</option>
                    <option value="2-3">2-3 weeks</option>
                    <option value="3-4">3-4 weeks</option>
                    <option value="4+">4+ weeks</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label><i class="fas fa-briefcase"></i> Project Type</label>
                <select id="typeFilter" class="filter-select">
                    <option value="all">All Types</option>
                    <option value="portfolio">📁 Portfolio</option>
                    <option value="pfe">🎓 PFE (Graduation)</option>
                </select>
            </div>
        </div>
        
        <div class="filter-actions">
            <button id="resetFilters" class="btn-reset">
                <i class="fas fa-undo-alt"></i> Reset Filters
            </button>
            <div class="results-count" id="resultsCount">
                <span id="problemCount">0</span> problems found
            </div>
        </div>
    </div>
    
    <!-- Problems Grid -->
    <div class="problems-grid" id="problemsGrid">
        <!-- Problems will be loaded here dynamically -->
    </div>
    
    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner" style="display: none;">
        <div class="spinner"></div>
        <p>Loading problems...</p>
    </div>
    
    <!-- No Results -->
    <div class="no-results" id="noResults" style="display: none;">
        <i class="fas fa-search"></i>
        <h3>No problems found</h3>
        <p>Try adjusting your filters or search terms</p>
        <button id="clearFiltersBtn" class="btn-primary">Clear Filters</button>
    </div>
</div>

@push('styles')
<style>
    .browse-container {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Filter Section */
    .filter-section {
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 32px;
    }
    
    .search-bar {
        position: relative;
        margin-bottom: 24px;
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
        background: var(--bg-primary);
        border: 1px solid var(--border);
        border-radius: 12px;
        font-size: 14px;
        color: var(--text-primary);
        transition: all 0.2s;
    }
    
    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }
    
    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }
    
    .filter-group label {
        display: block;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 6px;
        color: var(--text-secondary);
    }
    
    .filter-group label i {
        margin-right: 6px;
        font-size: 11px;
    }
    
    .filter-select {
        width: 100%;
        padding: 10px 12px;
        background: var(--bg-primary);
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 13px;
        color: var(--text-primary);
        cursor: pointer;
    }
    
    .filter-select:focus {
        outline: none;
        border-color: var(--primary);
    }
    
    .filter-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 1px solid var(--border);
    }
    
    .btn-reset {
        background: none;
        border: none;
        color: var(--text-secondary);
        cursor: pointer;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: color 0.2s;
    }
    
    .btn-reset:hover {
        color: var(--primary);
    }
    
    .results-count {
        font-size: 13px;
        color: var(--text-secondary);
    }
    
    #problemCount {
        font-weight: 600;
        color: var(--primary);
    }
    
    /* Problems Grid */
    .problems-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 24px;
    }
    
    .problem-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .problem-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--card-shadow);
        border-color: var(--primary-light);
    }
    
    .problem-header {
        padding: 16px 20px;
        background: var(--bg-primary);
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .problem-category {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .difficulty-badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
    }
    
    .difficulty-beginner {
        background: #e6f7e6;
        color: #2e7d32;
    }
    
    .difficulty-intermediate {
        background: #fff3e0;
        color: #ed6c02;
    }
    
    .difficulty-advanced {
        background: #ffebee;
        color: #d32f2f;
    }
    
    [data-theme="dark"] .difficulty-beginner {
        background: #1a3a1a;
        color: #4caf50;
    }
    
    [data-theme="dark"] .difficulty-intermediate {
        background: #3a2a1a;
        color: #ffa726;
    }
    
    [data-theme="dark"] .difficulty-advanced {
        background: #3a1a1a;
        color: #ef5350;
    }
    
    .problem-body {
        padding: 20px;
    }
    
    .problem-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--text-primary);
    }
    
    .problem-description {
        font-size: 13px;
        color: var(--text-secondary);
        line-height: 1.5;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .problem-meta {
        display: flex;
        gap: 16px;
        margin-bottom: 16px;
        font-size: 12px;
        color: var(--text-secondary);
    }
    
    .problem-meta i {
        width: 16px;
        margin-right: 4px;
    }
    
    .problem-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }
    
    .skill-tag {
        background: var(--bg-primary);
        padding: 4px 10px;
        border-radius: 16px;
        font-size: 11px;
        color: var(--text-secondary);
    }
    
    .btn-apply {
        width: 100%;
        padding: 10px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .btn-apply:hover {
        background: var(--primary-dark);
    }
    
    .btn-view-details {
        width: 100%;
        padding: 10px;
        background: transparent;
        color: var(--primary);
        border: 1px solid var(--border);
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-view-details:hover {
        background: var(--primary-light);
        border-color: var(--primary);
    }
    
    /* Loading Spinner */
    .loading-spinner {
        text-align: center;
        padding: 60px;
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
    
    /* No Results */
    .no-results {
        text-align: center;
        padding: 60px;
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 20px;
    }
    
    .no-results i {
        font-size: 48px;
        color: var(--text-secondary);
        margin-bottom: 16px;
    }
    
    .no-results h3 {
        font-size: 20px;
        margin-bottom: 8px;
    }
    
    .btn-primary {
        margin-top: 16px;
        padding: 10px 24px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        cursor: pointer;
    }
    
    @media (max-width: 768px) {
        .problems-grid {
            grid-template-columns: 1fr;
        }
        
        .filters-grid {
            grid-template-columns: 1fr;
        }
        
        .filter-actions {
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Mock Problems Data
    const problemsData = [
        {
            id: 1,
            title: "Patient Wait Time Analysis & Prediction",
            description: "Analyze clinic data to identify peak hours, predict wait times, and propose an optimized scheduling system that reduces patient waiting time by 50%.",
            category: "healthcare",
            category_name: "🏥 Healthcare",
            difficulty: "intermediate",
            duration: "3-4",
            project_type: "portfolio",
            skills: ["Python", "Pandas", "Data Viz"],
            entity: "Dr. Filali Clinic",
            entity_location: "Casablanca",
            deadline: "2026-06-15",
            applicants_count: 5
        },
        {
            id: 2,
            title: "Sales Performance Dashboard",
            description: "Build an interactive dashboard to track sales performance, identify trends, and provide actionable insights for a retail store experiencing sales decline.",
            category: "business",
            category_name: "💼 Business",
            difficulty: "beginner",
            duration: "2-3",
            project_type: "portfolio",
            skills: ["Power BI", "Excel", "SQL"],
            entity: "Fashion Store",
            entity_location: "Rabat",
            deadline: "2026-06-20",
            applicants_count: 3
        },
        {
            id: 3,
            title: "Apple Rot Detection Using AI",
            description: "Develop a computer vision model to detect and classify apple rot from leaf and fruit images. Help farmers reduce crop loss by early detection.",
            category: "agriculture",
            category_name: "🌾 Agriculture",
            difficulty: "advanced",
            duration: "4+",
            project_type: "pfe",
            skills: ["Deep Learning", "CNN", "Python"],
            entity: "Azilal Cooperative",
            entity_location: "Azilal",
            deadline: "2026-07-01",
            applicants_count: 8
        },
        {
            id: 4,
            title: "Student Management System",
            description: "Create a simple web-based system for a small school to manage student records, grades, attendance, and parent communication.",
            category: "education",
            category_name: "📚 Education",
            difficulty: "beginner",
            duration: "3-4",
            project_type: "portfolio",
            skills: ["Laravel", "MySQL", "HTML/CSS"],
            entity: "Al-Nahda School",
            entity_location: "Fes",
            deadline: "2026-06-30",
            applicants_count: 6
        },
        {
            id: 5,
            title: "Customer Churn Prediction",
            description: "Build a machine learning model to predict which customers are likely to churn, allowing proactive retention strategies for a telecom company.",
            category: "data-science",
            category_name: "📊 Data Science",
            difficulty: "intermediate",
            duration: "3-4",
            project_type: "portfolio",
            skills: ["Python", "Scikit-learn", "Pandas"],
            entity: "Telecom Company",
            entity_location: "Casablanca",
            deadline: "2026-06-25",
            applicants_count: 12
        },
        {
            id: 6,
            title: "Employee Attendance System",
            description: "Design and implement an automated attendance tracking system for a small business with facial recognition or QR code scanning.",
            category: "technology",
            category_name: "💻 Technology",
            difficulty: "intermediate",
            duration: "4+",
            project_type: "pfe",
            skills: ["PHP", "MySQL", "JavaScript"],
            entity: "Tech Solutions SARL",
            entity_location: "Tangier",
            deadline: "2026-07-15",
            applicants_count: 4
        },
        {
            id: 7,
            title: "Medical Image Classification",
            description: "Develop a deep learning model to classify X-ray images for detecting pneumonia and other respiratory conditions.",
            category: "healthcare",
            category_name: "🏥 Healthcare",
            difficulty: "advanced",
            duration: "4+",
            project_type: "pfe",
            skills: ["TensorFlow", "CNN", "Medical Imaging"],
            entity: "Ibn Sina Hospital",
            entity_location: "Rabat",
            deadline: "2026-08-01",
            applicants_count: 9
        },
        {
            id: 8,
            title: "E-commerce Recommendation System",
            description: "Build a personalized product recommendation system for an online store using collaborative and content-based filtering.",
            category: "business",
            category_name: "💼 Business",
            difficulty: "intermediate",
            duration: "3-4",
            project_type: "portfolio",
            skills: ["Python", "Recommendation Systems", "Pandas"],
            entity: "ShopOnline.ma",
            entity_location: "Casablanca",
            deadline: "2026-06-28",
            applicants_count: 7
        }
    ];
    
    // DOM Elements
    const problemsGrid = document.getElementById('problemsGrid');
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const difficultyFilter = document.getElementById('difficultyFilter');
    const durationFilter = document.getElementById('durationFilter');
    const typeFilter = document.getElementById('typeFilter');
    const resetFiltersBtn = document.getElementById('resetFilters');
    const clearFiltersBtn = document.getElementById('clearFiltersBtn');
    const resultsCountSpan = document.getElementById('problemCount');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const noResultsDiv = document.getElementById('noResults');
    
    let currentProblems = [...problemsData];
    
    // Render problems
    function renderProblems() {
        // Show loading
        loadingSpinner.style.display = 'block';
        problemsGrid.style.display = 'none';
        noResultsDiv.style.display = 'none';
        
        setTimeout(() => {
            loadingSpinner.style.display = 'none';
            
            if (currentProblems.length === 0) {
                problemsGrid.style.display = 'none';
                noResultsDiv.style.display = 'block';
                resultsCountSpan.textContent = '0';
                return;
            }
            
            problemsGrid.style.display = 'grid';
            noResultsDiv.style.display = 'none';
            resultsCountSpan.textContent = currentProblems.length;
            
            problemsGrid.innerHTML = currentProblems.map(problem => `
                <div class="problem-card" data-id="${problem.id}">
                    <div class="problem-header">
                        <span class="problem-category">
                            <i class="fas ${getCategoryIcon(problem.category)}"></i>
                            ${problem.category_name}
                        </span>
                        <span class="difficulty-badge difficulty-${problem.difficulty}">
                            ${getDifficultyText(problem.difficulty)}
                        </span>
                    </div>
                    <div class="problem-body">
                        <h3 class="problem-title">${problem.title}</h3>
                        <p class="problem-description">${problem.description}</p>
                        <div class="problem-meta">
                            <span><i class="fas fa-building"></i> ${problem.entity}</span>
                            <span><i class="fas fa-map-marker-alt"></i> ${problem.entity_location}</span>
                            <span><i class="fas fa-calendar"></i> Due: ${formatDate(problem.deadline)}</span>
                        </div>
                        <div class="problem-meta">
                            <span><i class="fas fa-clock"></i> ${getDurationText(problem.duration)}</span>
                            <span><i class="fas fa-users"></i> ${problem.applicants_count} applicants</span>
                            <span><i class="fas fa-tag"></i> ${problem.project_type === 'pfe' ? '🎓 PFE' : '📁 Portfolio'}</span>
                        </div>
                        <div class="problem-skills">
                            ${problem.skills.map(skill => `<span class="skill-tag">${skill}</span>`).join('')}
                        </div>
                        <button class="btn-apply" onclick="applyToProblem(${problem.id})">
                            Apply Now →
                        </button>
                    </div>
                </div>
            `).join('');
        }, 300);
    }
    
    // Filter problems
    function filterProblems() {
        const searchTerm = searchInput.value.toLowerCase();
        const category = categoryFilter.value;
        const difficulty = difficultyFilter.value;
        const duration = durationFilter.value;
        const projectType = typeFilter.value;
        
        currentProblems = problemsData.filter(problem => {
            // Search filter
            if (searchTerm && !problem.title.toLowerCase().includes(searchTerm) && 
                !problem.description.toLowerCase().includes(searchTerm) &&
                !problem.entity.toLowerCase().includes(searchTerm)) {
                return false;
            }
            
            // Category filter
            if (category !== 'all' && problem.category !== category) {
                return false;
            }
            
            // Difficulty filter
            if (difficulty !== 'all' && problem.difficulty !== difficulty) {
                return false;
            }
            
            // Duration filter
            if (duration !== 'all') {
                if (duration === '1-2' && problem.duration !== '1-2') return false;
                if (duration === '2-3' && problem.duration !== '2-3') return false;
                if (duration === '3-4' && problem.duration !== '3-4') return false;
                if (duration === '4+' && problem.duration !== '4+') return false;
            }
            
            // Project type filter
            if (projectType !== 'all' && problem.project_type !== projectType) {
                return false;
            }
            
            return true;
        });
        
        renderProblems();
    }
    
    // Reset all filters
    function resetFilters() {
        searchInput.value = '';
        categoryFilter.value = 'all';
        difficultyFilter.value = 'all';
        durationFilter.value = 'all';
        typeFilter.value = 'all';
        filterProblems();
    }
    
    // Helper functions
    function getCategoryIcon(category) {
        const icons = {
            'data-science': 'fa-chart-line',
            'healthcare': 'fa-heartbeat',
            'education': 'fa-graduation-cap',
            'business': 'fa-chart-bar',
            'agriculture': 'fa-seedling',
            'technology': 'fa-microchip'
        };
        return icons[category] || 'fa-tag';
    }
    
    function getDifficultyText(difficulty) {
        const texts = {
            'beginner': '🌱 Beginner',
            'intermediate': '📈 Intermediate',
            'advanced': '🚀 Advanced'
        };
        return texts[difficulty] || difficulty;
    }
    
    function getDurationText(duration) {
        const texts = {
            '1-2': '1-2 weeks',
            '2-3': '2-3 weeks',
            '3-4': '3-4 weeks',
            '4+': '4+ weeks'
        };
        return texts[duration] || duration;
    }
    
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }
    
    // Apply to problem function
    function applyToProblem(problemId) {
        const problem = problemsData.find(p => p.id === problemId);
        if (problem) {
            alert(`You are applying to:\n\n${problem.title}\n\nThis feature will be implemented soon!\n\nThe entity will review your application.`);
        }
    }
    
    // Event Listeners
    searchInput.addEventListener('input', filterProblems);
    categoryFilter.addEventListener('change', filterProblems);
    difficultyFilter.addEventListener('change', filterProblems);
    durationFilter.addEventListener('change', filterProblems);
    typeFilter.addEventListener('change', filterProblems);
    resetFiltersBtn.addEventListener('click', resetFilters);
    
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', resetFilters);
    }
    
    // Initial render
    renderProblems();
</script>
@endpush