{{-- resources/views/student/portfolio.blade.php --}}
@extends('layouts.app')

@section('title', 'My Portfolio - GradProject')
@section('page_title', 'My Portfolio')

@section('content')
<div class="portfolio-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-avatar">
            <div class="avatar-large">AB</div>
            <button class="btn-share" onclick="sharePortfolio()">
                <i class="fas fa-share-alt"></i> Share
            </button>
        </div>
        <div class="profile-info">
            <h1>Ahmed Benani</h1>
            <p class="student-title">Master's Student in Data Science</p>
            <p class="student-university">Hassan II University · Casablanca</p>
            <div class="profile-stats">
                <div class="stat">
                    <span class="stat-number" id="totalProjects">8</span>
                    <span class="stat-label">Projects Completed</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="avgRating">4.8</span>
                    <span class="stat-label">Average Rating</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="trustPoints">1,250</span>
                    <span class="stat-label">Trust Points</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="certifications">4</span>
                    <span class="stat-label">Certifications</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Social Links -->
    <div class="social-links">
        <a href="#" class="social-link"><i class="fab fa-github"></i> github.com/ahmedbenani</a>
        <a href="#" class="social-link"><i class="fab fa-linkedin"></i> linkedin.com/in/ahmedbenani</a>
        <a href="#" class="social-link"><i class="fas fa-envelope"></i> ahmed.benani@university.ma</a>
    </div>

    <!-- Skills Section -->
    <div class="skills-section">
        <h2><i class="fas fa-code"></i> Technical Skills</h2>
        <div class="skills-grid" id="skillsGrid">
            <!-- Skills loaded dynamically -->
        </div>
    </div>

    <!-- Certifications Section -->
    <div class="certifications-section">
        <h2><i class="fas fa-certificate"></i> Certifications</h2>
        <div class="certifications-grid" id="certificationsGrid">
            <!-- Certifications loaded dynamically -->
        </div>
    </div>

    <!-- Projects Section -->
    <div class="projects-section">
        <h2><i class="fas fa-folder-open"></i> Completed Projects</h2>
        <div class="projects-grid" id="projectsGrid">
            <!-- Projects loaded dynamically -->
        </div>
    </div>

    <!-- Share Portfolio Modal -->
    <div id="shareModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Share Your Portfolio</h3>
                <button class="modal-close" onclick="closeShareModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p>Share this link with employers or collaborators:</p>
                <div class="share-link">
                    <input type="text" id="shareLink" value="https://gradproject.com/portfolio/ahmed-benani" readonly>
                    <button onclick="copyLink()"><i class="fas fa-copy"></i> Copy</button>
                </div>
                <div class="share-options">
                    <p>Or share directly:</p>
                    <div class="social-share">
                        <button onclick="shareOnLinkedIn()" class="share-btn linkedin"><i class="fab fa-linkedin"></i> LinkedIn</button>
                        <button onclick="shareOnTwitter()" class="share-btn twitter"><i class="fab fa-twitter"></i> Twitter</button>
                        <button onclick="downloadPDF()" class="share-btn pdf"><i class="fas fa-file-pdf"></i> Download PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .portfolio-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Profile Header */
    .profile-header {
        display: flex;
        gap: 32px;
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 32px;
        margin-bottom: 24px;
    }

    .profile-avatar {
        text-align: center;
    }

    .avatar-large {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, var(--primary), #7209b7);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        font-weight: 600;
        color: white;
        margin-bottom: 16px;
    }

    .btn-share {
        background: var(--bg-primary);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
    }

    .btn-share:hover {
        background: var(--primary-light);
        border-color: var(--primary);
        color: var(--primary);
    }

    .profile-info h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .student-title {
        font-size: 16px;
        color: var(--primary);
        margin-bottom: 4px;
    }

    .student-university {
        font-size: 14px;
        color: var(--text-secondary);
        margin-bottom: 20px;
    }

    .profile-stats {
        display: flex;
        gap: 32px;
    }

    .stat {
        text-align: center;
    }

    .stat-number {
        display: block;
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
    }

    .stat-label {
        font-size: 12px;
        color: var(--text-secondary);
    }

    /* Social Links */
    .social-links {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 32px;
        padding: 16px 24px;
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 16px;
    }

    .social-link {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 13px;
        transition: color 0.2s;
    }

    .social-link:hover {
        color: var(--primary);
    }

    /* Skills Section */
    .skills-section, .certifications-section, .projects-section {
        margin-bottom: 40px;
    }

    .skills-section h2, .certifications-section h2, .projects-section h2 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .skills-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .skill-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 12px 20px;
        text-align: center;
        transition: all 0.2s;
    }

    .skill-card:hover {
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .skill-name {
        font-weight: 600;
        margin-bottom: 4px;
    }

    .skill-level {
        font-size: 11px;
        color: var(--text-secondary);
    }

    .skill-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 500;
        margin-top: 6px;
    }

    .level-expert { background: #e8f5e9; color: #2e7d32; }
    .level-proficient { background: #e3f2fd; color: #1565c0; }
    .level-practitioner { background: #fff3e0; color: #ed6c02; }
    .level-learner { background: #f3e5f5; color: #7b1fa2; }

    [data-theme="dark"] .level-expert { background: #1a3a1a; color: #4caf50; }
    [data-theme="dark"] .level-proficient { background: #0d2b3e; color: #42a5f5; }
    [data-theme="dark"] .level-practitioner { background: #3a2a1a; color: #ffa726; }
    [data-theme="dark"] .level-learner { background: #2a1a3e; color: #ce93d8; }

    /* Certifications Grid */
    .certifications-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 16px;
    }

    .cert-card {
        display: flex;
        gap: 16px;
        padding: 16px;
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 16px;
        transition: all 0.2s;
    }

    .cert-card:hover {
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .cert-icon {
        width: 48px;
        height: 48px;
        background: var(--primary-light);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .cert-info h4 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .cert-info p {
        font-size: 12px;
        color: var(--text-secondary);
    }

    /* Projects Grid */
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
    }

    .project-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s;
    }

    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--card-shadow);
        border-color: var(--primary-light);
    }

    .project-header {
        padding: 16px 20px;
        background: var(--bg-primary);
        border-bottom: 1px solid var(--border);
    }

    .project-category {
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

    .project-body {
        padding: 20px;
    }

    .project-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--text-primary);
    }

    .project-description {
        font-size: 13px;
        color: var(--text-secondary);
        line-height: 1.5;
        margin-bottom: 16px;
    }

    .project-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border);
    }

    .project-entity {
        font-size: 12px;
        color: var(--text-secondary);
    }

    .project-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        background: #ffc10720;
        padding: 4px 8px;
        border-radius: 20px;
    }

    .project-rating i {
        color: #ffc107;
        font-size: 12px;
    }

    .rating-value {
        font-weight: 600;
        font-size: 13px;
    }

    .project-review {
        background: var(--bg-primary);
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 16px;
        font-size: 12px;
        color: var(--text-secondary);
        font-style: italic;
    }

    .badges {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
    }

    .badge-ai { background: #e8eaf6; color: #3949ab; }
    .badge-impact { background: #e0f2fe; color: #0284c7; }
    .badge-fast { background: #ecfdf5; color: #059669; }
    .badge-collab { background: #fef3c7; color: #d97706; }

    [data-theme="dark"] .badge-ai { background: #1a237e20; color: #7986cb; }
    [data-theme="dark"] .badge-impact { background: #0c4a6e20; color: #38bdf8; }
    [data-theme="dark"] .badge-fast { background: #064e3b20; color: #34d399; }
    [data-theme="dark"] .badge-collab { background: #78350f20; color: #fbbf24; }

    .btn-view-project {
        width: 100%;
        padding: 10px;
        background: transparent;
        border: 1px solid var(--border);
        border-radius: 12px;
        color: var(--primary);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-view-project:hover {
        background: var(--primary-light);
        border-color: var(--primary);
    }

    /* Modal */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal-content {
        background: var(--bg-secondary);
        border-radius: 20px;
        width: 90%;
        max-width: 500px;
        border: 1px solid var(--border);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid var(--border);
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--text-secondary);
    }

    .modal-body {
        padding: 20px;
    }

    .share-link {
        display: flex;
        gap: 8px;
        margin: 16px 0;
    }

    .share-link input {
        flex: 1;
        padding: 10px;
        background: var(--bg-primary);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--text-primary);
    }

    .share-link button {
        padding: 10px 20px;
        background: var(--primary);
        border: none;
        border-radius: 8px;
        color: white;
        cursor: pointer;
    }

    .social-share {
        display: flex;
        gap: 12px;
        margin-top: 16px;
    }

    .share-btn {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .share-btn.linkedin { background: #0077b5; color: white; }
    .share-btn.twitter { background: #1da1f2; color: white; }
    .share-btn.pdf { background: #dc3545; color: white; }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .profile-stats {
            justify-content: center;
        }
        
        .projects-grid {
            grid-template-columns: 1fr;
        }
        
        .certifications-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

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
        { name: "Google Data Analytics", issuer: "Google", date: "2025", icon: "fa-google" },
        { name: "IBM Machine Learning", issuer: "IBM", date: "2025", icon: "fa-brands fa-ibm" },
        { name: "Microsoft Power BI", issuer: "Microsoft", date: "2024", icon: "fa-microsoft" },
        { name: "Deep Learning Specialization", issuer: "DeepLearning.AI", date: "2025", icon: "fa-brain" }
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

    // Render Skills
    function renderSkills() {
        const skillsGrid = document.getElementById('skillsGrid');
        skillsGrid.innerHTML = skillsData.map(skill => `
            <div class="skill-card">
                <div class="skill-name">${skill.name}</div>
                <div class="skill-level">${skill.text}</div>
                <span class="skill-badge level-${skill.level}">${skill.text}</span>
            </div>
        `).join('');
    }

    // Render Certifications
    function renderCertifications() {
        const certsGrid = document.getElementById('certificationsGrid');
        certsGrid.innerHTML = certificationsData.map(cert => `
            <div class="cert-card">
                <div class="cert-icon">
                    <i class="fab ${cert.icon}"></i>
                </div>
                <div class="cert-info">
                    <h4>${cert.name}</h4>
                    <p>${cert.issuer} • ${cert.date}</p>
                </div>
            </div>
        `).join('');
    }

    // Render Projects
    function renderProjects() {
        const projectsGrid = document.getElementById('projectsGrid');
        projectsGrid.innerHTML = portfolioProjectsData.map(project => `
            <div class="project-card">
                <div class="project-header">
                    <span class="project-category">
                        <i class="fas ${project.category_icon}"></i>
                        ${project.category}
                    </span>
                </div>
                <div class="project-body">
                    <h3 class="project-title">${project.title}</h3>
                    <p class="project-description">${project.description}</p>
                    <div class="project-meta">
                        <span class="project-entity"><i class="fas fa-building"></i> ${project.entity}</span>
                        <span class="project-rating">
                            <i class="fas fa-star"></i>
                            <span class="rating-value">${project.rating}</span>
                        </span>
                    </div>
                    <div class="badges">
                        ${project.badges.map(badge => `<span class="badge">${badge}</span>`).join('')}
                    </div>
                    <div class="project-review">
                        <i class="fas fa-quote-left"></i> ${project.review}
                    </div>
                    <button class="btn-view-project" onclick="viewProject(${project.id})">
                        View Details <i class="fas fa-arrow-right"></i>
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
        document.getElementById('shareModal').style.display = 'flex';
    }

    function closeShareModal() {
        document.getElementById('shareModal').style.display = 'none';
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