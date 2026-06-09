{{-- resources/views/student/portfolio.blade.php --}}
@extends('layouts.app')

@section('title', 'My Portfolio - GradProject')
@section('page_title', 'My Portfolio')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Profile Header -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row gap-6 md:gap-8">
        <div class="text-center">
            <div class="w-28 h-28 md:w-32 md:h-32 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-full flex items-center justify-center text-white text-4xl md:text-5xl font-bold mx-auto mb-4">
                AB
            </div>
            <button onclick="sharePortfolio()" class="w-full bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg px-4 py-2 text-sm cursor-pointer transition-all hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:border-indigo-400 dark:hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400">
                <i class="fas fa-share-alt mr-2"></i> Share
            </button>
        </div>
        
        <div class="flex-1 text-center md:text-left">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">Ahmed Benani</h1>
            <p class="text-indigo-600 dark:text-indigo-400 mb-1">Master's Student in Data Science</p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Hassan II University · Casablanca</p>
            
            <div class="flex justify-center md:justify-start gap-6 md:gap-8">
                <div class="text-center">
                    <span class="block text-2xl font-bold text-gray-900 dark:text-white">8</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Projects Completed</span>
                </div>
                <div class="text-center">
                    <span class="block text-2xl font-bold text-gray-900 dark:text-white">4.8</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Average Rating</span>
                </div>
                <div class="text-center">
                    <span class="block text-2xl font-bold text-gray-900 dark:text-white">1,250</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Trust Points</span>
                </div>
                <div class="text-center">
                    <span class="block text-2xl font-bold text-gray-900 dark:text-white">4</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Certifications</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Social Links -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 flex flex-wrap gap-4">
        <a href="#" class="flex items-center gap-2 text-gray-500 dark:text-gray-400 text-sm hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
            <i class="fab fa-github"></i> github.com/ahmedbenani
        </a>
        <a href="#" class="flex items-center gap-2 text-gray-500 dark:text-gray-400 text-sm hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
            <i class="fab fa-linkedin"></i> linkedin.com/in/ahmedbenani
        </a>
        <a href="#" class="flex items-center gap-2 text-gray-500 dark:text-gray-400 text-sm hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
            <i class="fas fa-envelope"></i> ahmed.benani@university.ma
        </a>
    </div>

    <!-- Skills Section -->
    <div>
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <i class="fas fa-code text-indigo-600"></i> Technical Skills
        </h2>
        <div class="flex flex-wrap gap-3" id="skillsGrid"></div>
    </div>

    <!-- Certifications Section -->
    <div>
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <i class="fas fa-certificate text-indigo-600"></i> Certifications
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="certificationsGrid"></div>
    </div>

    <!-- Projects Section -->
    <div>
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <i class="fas fa-folder-open text-indigo-600"></i> Completed Projects
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6" id="projectsGrid"></div>
    </div>

    <!-- Share Modal -->
    <div id="shareModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-2xl w-[90%] max-w-md border border-gray-200 dark:border-gray-700">
            <div class="flex justify-between items-center p-5 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Share Your Portfolio</h3>
                <button onclick="closeShareModal()" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 text-2xl">&times;</button>
            </div>
            <div class="p-5">
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">Share this link with employers or collaborators:</p>
                <div class="flex gap-2 mb-4">
                    <input type="text" id="shareLink" value="https://gradproject.com/portfolio/ahmed-benani" readonly class="flex-1 p-2 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white">
                    <button onclick="copyLink()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700 transition-colors">
                        <i class="fas fa-copy"></i> Copy
                    </button>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">Or share directly:</p>
                <div class="flex gap-3">
                    <button onclick="shareOnLinkedIn()" class="flex-1 py-2 bg-[#0077b5] text-white rounded-lg text-sm flex items-center justify-center gap-2 hover:opacity-90 transition-opacity">
                        <i class="fab fa-linkedin"></i> LinkedIn
                    </button>
                    <button onclick="shareOnTwitter()" class="flex-1 py-2 bg-[#1da1f2] text-white rounded-lg text-sm flex items-center justify-center gap-2 hover:opacity-90 transition-opacity">
                        <i class="fab fa-twitter"></i> Twitter
                    </button>
                    <button onclick="downloadPDF()" class="flex-1 py-2 bg-red-600 text-white rounded-lg text-sm flex items-center justify-center gap-2 hover:bg-red-700 transition-colors">
                        <i class="fas fa-file-pdf"></i> PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Mock Skills Data
    const skillsData = [
        { name: "Python", level: "expert", text: "Expert" },
        { name: "SQL", level: "proficient", text: "Proficient" },
        { name: "Excel", level: "expert", text: "Expert" },
        { name: "Power BI", level: "proficient", text: "Proficient" },
        { name: "Machine Learning", level: "practitioner", text: "Practitioner" },
        { name: "Laravel", level: "practitioner", text: "Practitioner" },
        { name: "Data Visualization", level: "expert", text: "Expert" },
        { name: "Project Management", level: "learner", text: "Learner" }
    ];

    // Mock Certifications Data
    const certificationsData = [
        { name: "Google Data Analytics", issuer: "Google", date: "2025", icon: "fa-google", brand: true },
        { name: "IBM Machine Learning", issuer: "IBM", date: "2025", icon: "fa-ibm", brand: true },
        { name: "Microsoft Power BI", issuer: "Microsoft", date: "2024", icon: "fa-microsoft", brand: true },
        { name: "Deep Learning Specialization", issuer: "DeepLearning.AI", date: "2025", icon: "fa-brain", brand: false }
    ];

    // Mock Projects Data
    const portfolioProjectsData = [
        {
            id: 1,
            title: "Clinic Appointment Optimization",
            description: "Developed an AI-powered scheduling system that reduced patient waiting time by 67% and increased daily patient capacity by 22%.",
            category: "Healthcare",
            category_icon: "fa-heartbeat",
            entity: "Dr. Filali Clinic",
            rating: 4.9,
            review: "Excellent work! The system has transformed our clinic operations.",
            date: "May 2026",
            badges: ["🏅 High Impact", "⚡ Fast Solver", "🤝 Collaborative"]
        },
        {
            id: 2,
            title: "Sales Performance Dashboard",
            description: "Created an interactive Power BI dashboard that identified key sales trends, leading to a 35% increase in quarterly revenue.",
            category: "Business",
            category_icon: "fa-chart-line",
            entity: "Fashion Store",
            rating: 4.7,
            review: "Great insights! The dashboard is now used for weekly management meetings.",
            date: "April 2026",
            badges: ["📊 Data Storyteller", "💡 Innovative Solution"]
        },
        {
            id: 3,
            title: "Apple Rot Detection AI",
            description: "Built a CNN model achieving 95% accuracy in detecting apple rot, helping farmers reduce crop loss by 40%.",
            category: "Agriculture",
            category_icon: "fa-seedling",
            entity: "Azilal Cooperative",
            rating: 4.8,
            review: "Outstanding research! The model is being deployed across the region.",
            date: "March 2026",
            badges: ["🤖 AI Innovator", "🌱 Social Impact", "📄 Publication Ready"]
        },
        {
            id: 4,
            title: "Student Management System",
            description: "Developed a full-stack web application for a local school to manage student records, grades, and parent communication.",
            category: "Education",
            category_icon: "fa-graduation-cap",
            entity: "Al-Nahda School",
            rating: 4.9,
            review: "Beyond expectations! The system has saved us countless hours.",
            date: "February 2026",
            badges: ["💻 Full Stack", "🎓 Educational Impact"]
        },
        {
            id: 5,
            title: "Customer Churn Predictor",
            description: "Built a machine learning model with 88% accuracy to predict customer churn, enabling proactive retention strategies.",
            category: "Data Science",
            category_icon: "fa-chart-pie",
            entity: "Telecom Company",
            rating: 4.6,
            review: "Excellent analysis! The model is now in production.",
            date: "January 2026",
            badges: ["📈 Business Impact", "🔮 Predictive Analytics"]
        }
    ];

    // Get level classes
    function getLevelClass(level) {
        const classes = {
            expert: 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400',
            proficient: 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
            practitioner: 'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400',
            learner: 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400'
        };
        return classes[level] || classes.learner;
    }

    // Get badge class
    function getBadgeClass(badge) {
        if (badge.includes('AI') || badge.includes('🤖')) return 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300';
        if (badge.includes('Impact') || badge.includes('🏅')) return 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300';
        if (badge.includes('Fast') || badge.includes('⚡')) return 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300';
        if (badge.includes('Collaborative') || badge.includes('🤝')) return 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300';
        return 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300';
    }

    // Render Skills
    function renderSkills() {
        const skillsGrid = document.getElementById('skillsGrid');
        skillsGrid.innerHTML = skillsData.map(skill => `
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-5 py-3 text-center hover:border-indigo-400 dark:hover:border-indigo-500 transition-all hover:-translate-y-0.5">
                <div class="font-semibold text-gray-900 dark:text-white">${skill.name}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">${skill.text}</div>
                <span class="inline-block text-[10px] font-medium px-2 py-0.5 rounded ${getLevelClass(skill.level)}">${skill.text}</span>
            </div>
        `).join('');
    }

    // Render Certifications
    function renderCertifications() {
        const certsGrid = document.getElementById('certificationsGrid');
        certsGrid.innerHTML = certificationsData.map(cert => `
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 flex gap-4 hover:border-indigo-400 dark:hover:border-indigo-500 transition-all hover:-translate-y-0.5">
                <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-2xl">
                    <i class="${cert.brand ? 'fab' : 'fas'} ${cert.icon}"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">${cert.name}</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400">${cert.issuer} • ${cert.date}</p>
                </div>
            </div>
        `).join('');
    }

    // Render Projects
    function renderProjects() {
        const projectsGrid = document.getElementById('projectsGrid');
        projectsGrid.innerHTML = portfolioProjectsData.map(project => `
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden hover:shadow-lg transition-all hover:-translate-y-1">
                <div class="px-5 py-3 bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                    <span class="inline-flex items-center gap-1.5 px-2 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-[11px] font-semibold">
                        <i class="fas ${project.category_icon} text-xs"></i> ${project.category}
                    </span>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">${project.title}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2">${project.description}</p>
                    
                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-xs text-gray-500 dark:text-gray-400"><i class="fas fa-building mr-1"></i> ${project.entity}</span>
                        <span class="flex items-center gap-1 bg-yellow-100/50 dark:bg-yellow-900/30 px-2 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-500 text-xs"></i>
                            <span class="font-semibold text-sm">${project.rating}</span>
                        </span>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 mb-4">
                        ${project.badges.map(badge => `<span class="text-[11px] font-medium px-2 py-1 rounded-full ${getBadgeClass(badge)}">${badge}</span>`).join('')}
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-3 rounded-xl mb-4">
                        <i class="fas fa-quote-left text-gray-400 text-xs mr-1"></i>
                        <span class="text-xs text-gray-500 dark:text-gray-400 italic">${project.review}</span>
                    </div>
                    
                    <button onclick="viewProject(${project.id})" class="w-full py-2 border border-gray-200 dark:border-gray-700 rounded-xl text-indigo-600 dark:text-indigo-400 font-medium text-sm hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:border-indigo-400 transition-all">
                        View Details <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </button>
                </div>
            </div>
        `).join('');
    }

    // Action Functions
    function viewProject(projectId) {
        const project = portfolioProjectsData.find(p => p.id === projectId);
        alert(`Viewing details for: ${project.title}\n\nThis feature will show full project details, including methodology, code, and results.`);
    }

    function sharePortfolio() {
        document.getElementById('shareModal').classList.remove('hidden');
    }

    function closeShareModal() {
        document.getElementById('shareModal').classList.add('hidden');
    }

    function copyLink() {
        const linkInput = document.getElementById('shareLink');
        linkInput.select();
        document.execCommand('copy');
        alert('Link copied to clipboard!');
    }

    function shareOnLinkedIn() {
        window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent('https://gradproject.com/portfolio/ahmed-benani'), '_blank');
    }

    function shareOnTwitter() {
        window.open('https://twitter.com/intent/tweet?text=Check out my portfolio!&url=' + encodeURIComponent('https://gradproject.com/portfolio/ahmed-benani'), '_blank');
    }

    function downloadPDF() {
        alert('PDF download will be available soon!');
    }

    // Close modal on outside click
    window.onclick = function(event) {
        const modal = document.getElementById('shareModal');
        if (event.target === modal) {
            closeShareModal();
        }
    }

    // Initialize
    renderSkills();
    renderCertifications();
    renderProjects();
</script>
@endpush