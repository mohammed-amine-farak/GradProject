{{-- resources/views/student/problems.blade.php --}}
@extends('layouts.app')

@section('title', 'Browse Problems - GradProject')
@section('page_title', 'Browse Problems')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Filter Section -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6">
        <!-- Search Bar -->
        <div class="relative mb-6">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
            <input type="text" id="searchInput" placeholder="Search by title, description, or entity..." 
                   class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-all">
        </div>

        <!-- Filters Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div>
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">
                    <i class="fas fa-layer-group mr-1"></i> Category
                </label>
                <select id="categoryFilter" class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500">
                    <option value="all">All Categories</option>
                    <option value="data-science">📊 Data Science</option>
                    <option value="healthcare">🏥 Healthcare</option>
                    <option value="education">📚 Education</option>
                    <option value="business">💼 Business</option>
                    <option value="agriculture">🌾 Agriculture</option>
                    <option value="technology">💻 Technology</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">
                    <i class="fas fa-chart-line mr-1"></i> Difficulty
                </label>
                <select id="difficultyFilter" class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500">
                    <option value="all">All Levels</option>
                    <option value="beginner">🌱 Beginner</option>
                    <option value="intermediate">📈 Intermediate</option>
                    <option value="advanced">🚀 Advanced</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">
                    <i class="fas fa-clock mr-1"></i> Duration
                </label>
                <select id="durationFilter" class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500">
                    <option value="all">Any Duration</option>
                    <option value="1-2">1-2 weeks</option>
                    <option value="2-3">2-3 weeks</option>
                    <option value="3-4">3-4 weeks</option>
                    <option value="4+">4+ weeks</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">
                    <i class="fas fa-briefcase mr-1"></i> Project Type
                </label>
                <select id="typeFilter" class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500">
                    <option value="all">All Types</option>
                    <option value="portfolio">📁 Portfolio</option>
                    <option value="pfe">🎓 PFE (Graduation)</option>
                </select>
            </div>
        </div>

        <!-- Filter Actions -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
            <button id="resetFilters" class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                <i class="fas fa-undo-alt"></i> Reset Filters
            </button>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                <span id="problemCount" class="font-semibold text-indigo-600 dark:text-indigo-400">0</span> problems found
            </div>
        </div>
    </div>

    <!-- Problems Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6" id="problemsGrid"></div>

    <!-- Loading Spinner -->
    <div id="loadingSpinner" class="hidden text-center py-16">
        <div class="inline-block w-10 h-10 border-4 border-gray-200 dark:border-gray-700 border-t-indigo-600 rounded-full animate-spin"></div>
        <p class="mt-4 text-gray-500 dark:text-gray-400">Loading problems...</p>
    </div>

    <!-- No Results -->
    <div id="noResults" class="hidden text-center py-16 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl">
        <i class="fas fa-search text-5xl text-gray-400 dark:text-gray-500 mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No problems found</h3>
        <p class="text-gray-500 dark:text-gray-400 mb-4">Try adjusting your filters or search terms</p>
        <button id="clearFiltersBtn" class="px-5 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors">
            Clear Filters
        </button>
    </div>
</div>
@endsection

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

    // Helper Functions
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

    function getDifficultyClass(difficulty) {
        const classes = {
            'beginner': 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400',
            'intermediate': 'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400',
            'advanced': 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400'
        };
        return classes[difficulty] || classes.intermediate;
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

    // Render Problems
    function renderProblems() {
        loadingSpinner.classList.remove('hidden');
        problemsGrid.classList.add('hidden');
        noResultsDiv.classList.add('hidden');

        setTimeout(() => {
            loadingSpinner.classList.add('hidden');

            if (currentProblems.length === 0) {
                problemsGrid.classList.add('hidden');
                noResultsDiv.classList.remove('hidden');
                resultsCountSpan.textContent = '0';
                return;
            }

            problemsGrid.classList.remove('hidden');
            noResultsDiv.classList.add('hidden');
            resultsCountSpan.textContent = currentProblems.length;

            problemsGrid.innerHTML = currentProblems.map(problem => `
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden hover:shadow-lg transition-all hover:-translate-y-1 cursor-pointer">
                    <div class="px-5 py-3 bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-[11px] font-semibold">
                            <i class="fas ${getCategoryIcon(problem.category)} text-xs"></i> ${problem.category_name}
                        </span>
                        <span class="text-[11px] font-medium px-2 py-1 rounded-full ${getDifficultyClass(problem.difficulty)}">
                            ${getDifficultyText(problem.difficulty)}
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">${problem.title}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2">${problem.description}</p>
                        
                        <div class="flex flex-wrap gap-4 text-xs text-gray-500 dark:text-gray-400 mb-4">
                            <span><i class="fas fa-building w-4 mr-1"></i> ${problem.entity}</span>
                            <span><i class="fas fa-map-marker-alt w-4 mr-1"></i> ${problem.entity_location}</span>
                            <span><i class="fas fa-calendar w-4 mr-1"></i> ${formatDate(problem.deadline)}</span>
                        </div>
                        
                        <div class="flex flex-wrap gap-4 text-xs text-gray-500 dark:text-gray-400 mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                            <span><i class="fas fa-clock w-4 mr-1"></i> ${getDurationText(problem.duration)}</span>
                            <span><i class="fas fa-users w-4 mr-1"></i> ${problem.applicants_count} applicants</span>
                            <span><i class="fas fa-tag w-4 mr-1"></i> ${problem.project_type === 'pfe' ? '🎓 PFE' : '📁 Portfolio'}</span>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            ${problem.skills.map(skill => `<span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded-full text-xs text-gray-600 dark:text-gray-400">${skill}</span>`).join('')}
                        </div>
                        
                        <button onclick="applyToProblem(${problem.id})" class="w-full py-2.5 bg-indigo-600 text-white rounded-lg font-medium text-sm hover:bg-indigo-700 transition-colors">
                            Apply Now →
                        </button>
                    </div>
                </div>
            `).join('');
        }, 300);
    }

    // Filter Problems
    function filterProblems() {
        const searchTerm = searchInput.value.toLowerCase();
        const category = categoryFilter.value;
        const difficulty = difficultyFilter.value;
        const duration = durationFilter.value;
        const projectType = typeFilter.value;

        currentProblems = problemsData.filter(problem => {
            if (searchTerm && !problem.title.toLowerCase().includes(searchTerm) && 
                !problem.description.toLowerCase().includes(searchTerm) &&
                !problem.entity.toLowerCase().includes(searchTerm)) {
                return false;
            }
            if (category !== 'all' && problem.category !== category) return false;
            if (difficulty !== 'all' && problem.difficulty !== difficulty) return false;
            if (duration !== 'all' && problem.duration !== duration) return false;
            if (projectType !== 'all' && problem.project_type !== projectType) return false;
            return true;
        });

        renderProblems();
    }

    // Reset Filters
    function resetFilters() {
        searchInput.value = '';
        categoryFilter.value = 'all';
        difficultyFilter.value = 'all';
        durationFilter.value = 'all';
        typeFilter.value = 'all';
        filterProblems();
    }

    // Apply to Problem
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
    if (clearFiltersBtn) clearFiltersBtn.addEventListener('click', resetFilters);

    // Initial Render
    renderProblems();
</script>
@endpush