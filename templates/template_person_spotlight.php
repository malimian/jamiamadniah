

    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
        }
        
        .section-title {
            color: var(--secondary-color);
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
        }
        
        .achievement-card {
            border-left: 4px solid var(--primary-color);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }
        
        .achievement-card:hover {
            transform: translateY(-5px);
        }
        
        .milestone-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 25px;
        }
        
        .milestone-item:before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: var(--accent-color);
        }
        
        .milestone-date {
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .certification-badge {
            background-color: var(--light-bg);
            border-radius: 20px;
            padding: 8px 15px;
            margin-right: 10px;
            margin-bottom: 10px;
            display: inline-block;
        }
        
        footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <img src="https://via.placeholder.com/150" alt="Profile Photo" class="rounded-circle mb-4" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid white;">
                    <h1 class="display-4 fw-bold mb-3" id="professional-name">John D. Professional</h1>
                    <h2 class="h4 mb-4" id="professional-title">Senior Executive | Industry Leader | Innovator</h2>
                    <p class="lead mb-4" id="professional-tagline">Transforming visions into reality through strategic leadership and innovative solutions</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="btn btn-light btn-lg px-4">Contact Me</a>
                        <a href="#" class="btn btn-outline-light btn-lg px-4">Download CV</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Personal Background Section -->
        <section class="mb-5" id="personal-background">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title text-center">Personal Background</h2>
                    
                    <div class="card achievement-card mb-4">
                        <div class="card-body">
                            <h3 class="h4 card-title">Professional Profile</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Full Name:</strong> <span id="full-name">John Doe Professional</span></p>
                                    <p><strong>Current Role:</strong> <span id="current-role">Chief Executive Officer</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Company:</strong> <span id="current-company">InnovateTech Solutions</span></p>
                                    <p><strong>Industry:</strong> <span id="current-industry">Technology & Consulting</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card achievement-card mb-4">
                        <div class="card-body">
                            <h3 class="h4 card-title">Education</h3>
                            <div class="education-item mb-3">
                                <h4 class="h5">MBA in Business Administration</h4>
                                <p class="mb-1">Harvard Business School</p>
                                <p class="text-muted">Graduated: 2010</p>
                            </div>
                            <div class="education-item">
                                <h4 class="h5">BSc in Computer Science</h4>
                                <p class="mb-1">Stanford University</p>
                                <p class="text-muted">Graduated: 2005</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card achievement-card mb-4">
                        <div class="card-body">
                            <h3 class="h4 card-title">Certifications & Licenses</h3>
                            <div>
                                <span class="certification-badge"><i class="fas fa-certificate me-2"></i>PMP Certified</span>
                                <span class="certification-badge"><i class="fas fa-certificate me-2"></i>Six Sigma Black Belt</span>
                                <span class="certification-badge"><i class="fas fa-certificate me-2"></i>AWS Solutions Architect</span>
                                <span class="certification-badge"><i class="fas fa-certificate me-2"></i>Google Cloud Professional</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Career Milestones Section -->
        <section class="mb-5" id="career-milestones">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title text-center">Career Milestones</h2>
                    
                    <div class="timeline">
                        <div class="milestone-item">
                            <span class="milestone-date">2020 - Present</span>
                            <h3 class="h4">Founded InnovateTech Solutions</h3>
                            <p>Launched a successful tech consulting firm that grew from 5 to 150 employees in three years, serving Fortune 500 clients across multiple industries.</p>
                        </div>
                        
                        <div class="milestone-item">
                            <span class="milestone-date">2018 - 2020</span>
                            <h3 class="h4">VP of Product Development at TechGlobal</h3>
                            <p>Led the product team that developed the award-winning EnterpriseX platform, resulting in 200% revenue growth for the division.</p>
                        </div>
                        
                        <div class="milestone-item">
                            <span class="milestone-date">2015</span>
                            <h3 class="h4">First Executive Promotion</h3>
                            <p>Became the youngest Director in company history at age 32, overseeing a $50M product portfolio.</p>
                        </div>
                        
                        <div class="milestone-item">
                            <span class="milestone-date">2010</span>
                            <h3 class="h4">Industry Breakthrough</h3>
                            <p>Developed the patented ProcessOptimizer algorithm that became industry standard in supply chain management systems.</p>
                        </div>
                        
                        <div class="milestone-item">
                            <span class="milestone-date">2005</span>
                            <h3 class="h4">First Major Role</h3>
                            <p>Joined TechStart Inc. as a junior developer and within 18 months led the team that built their flagship product.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Key Achievements Section -->
        <section class="mb-5" id="key-achievements">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title text-center">Key Achievements</h2>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 achievement-card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                            <i class="fas fa-trophy fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <h3 class="h5 card-title">Industry Recognition</h3>
                                            <p class="card-text">Named "Tech Leader of the Year" by Industry Magazine for three consecutive years.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 achievement-card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                            <i class="fas fa-chart-line fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <h3 class="h5 card-title">Revenue Growth</h3>
                                            <p class="card-text">Grew division revenue from $10M to $75M in 5 years through strategic initiatives.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 achievement-card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                            <i class="fas fa-users fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <h3 class="h5 card-title">Team Leadership</h3>
                                            <p class="card-text">Built and mentored 5 teams that produced 3 successful product launches.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 achievement-card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                            <i class="fas fa-lightbulb fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <h3 class="h5 card-title">Innovation</h3>
                                            <p class="card-text">Holds 7 patents in process optimization and machine learning applications.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>



    <!-- Professional Journey Section -->
<section class="py-5" id="professional-journey">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title text-center mb-5">Professional Journey</h2>
                
                <!-- Career Progression Timeline -->
                <div class="mb-5">
                    <h3 class="h4 mb-4 text-primary"><i class="fas fa-timeline me-2"></i>Career Progression Timeline</h3>
                    <div class="timeline-wrapper">
                        <div class="timeline">
                            <!-- Timeline Item 1 -->
                            <div class="timeline-item">
                                <div class="timeline-date">2018 - Present</div>
                                <div class="timeline-content card">
                                    <div class="card-body">
                                        <h4 class="card-title">Chief Technology Officer</h4>
                                        <h5 class="card-subtitle mb-2 text-muted">InnovateTech Solutions</h5>
                                        <p class="card-text">Leading technology strategy and digital transformation for a 300-employee SaaS company. Grev annual recurring revenue from $5M to $50M in 4 years.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Timeline Item 2 -->
                            <div class="timeline-item">
                                <div class="timeline-date">2015 - 2018</div>
                                <div class="timeline-content card">
                                    <div class="card-body">
                                        <h4 class="card-title">Director of Product Development</h4>
                                        <h5 class="card-subtitle mb-2 text-muted">TechGlobal Inc.</h5>
                                        <p class="card-text">Managed cross-functional teams to deliver 5 major product releases that captured 30% market share in our vertical.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Timeline Item 3 -->
                            <div class="timeline-item">
                                <div class="timeline-date">2012 - 2015</div>
                                <div class="timeline-content card">
                                    <div class="card-body">
                                        <h4 class="card-title">Senior Product Manager</h4>
                                        <h5 class="card-subtitle mb-2 text-muted">Digital Solutions Co.</h5>
                                        <p class="card-text">Led the product team that developed the industry-leading EnterpriseX platform with 95% customer satisfaction.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Key Achievements & Breakthroughs -->
                <div class="mb-5">
                    <h3 class="h4 mb-4 text-primary"><i class="fas fa-trophy me-2"></i>Key Achievements & Breakthroughs</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card h-100 achievement-card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                            <i class="fas fa-lightbulb text-primary"></i>
                                        </div>
                                        <div>
                                            <h4 class="h5">Product Innovation</h4>
                                            <p class="mb-0">Developed patented AI algorithm that reduced processing time by 80% for enterprise clients.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 achievement-card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                            <i class="fas fa-chart-line text-primary"></i>
                                        </div>
                                        <div>
                                            <h4 class="h5">Revenue Growth</h4>
                                            <p class="mb-0">Spearheaded initiative that increased upsell revenue by 240% in 18 months.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 achievement-card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                            <i class="fas fa-users text-primary"></i>
                                        </div>
                                        <div>
                                            <h4 class="h5">Team Building</h4>
                                            <p class="mb-0">Built and scaled engineering team from 5 to 50 while maintaining 92% retention rate.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 achievement-card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                            <i class="fas fa-globe text-primary"></i>
                                        </div>
                                        <div>
                                            <h4 class="h5">Market Expansion</h4>
                                            <p class="mb-0">Led successful expansion into 3 new international markets within 2 years.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Challenges Overcome & Lessons Learned -->
                <div class="mb-5">
                    <h3 class="h4 mb-4 text-primary"><i class="fas fa-mountain me-2"></i>Challenges Overcome & Lessons Learned</h3>
                    <div class="accordion" id="challengesAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#challenge1">
                                    Digital Transformation Resistance
                                </button>
                            </h2>
                            <div id="challenge1" class="accordion-collapse collapse" data-bs-parent="#challengesAccordion">
                                <div class="accordion-body">
                                    <p>Overcame organizational resistance to digital transformation by implementing change management strategies that resulted in 85% adoption rate across departments.</p>
                                    <p class="mb-0 fst-italic"><strong>Lesson:</strong> Cultural change requires equal parts technology, communication, and empathy.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#challenge2">
                                    Market Downturn Recovery
                                </button>
                            </h2>
                            <div id="challenge2" class="accordion-collapse collapse" data-bs-parent="#challengesAccordion">
                                <div class="accordion-body">
                                    <p>Navigated company through 2020 market downturn by pivoting product strategy, resulting in record revenue year despite economic conditions.</p>
                                    <p class="mb-0 fst-italic"><strong>Lesson:</strong> Agile decision-making and scenario planning are critical in volatile markets.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Notable Projects or Innovations -->
                <div class="mb-5">
                    <h3 class="h4 mb-4 text-primary"><i class="fas fa-flask me-2"></i>Notable Projects & Innovations</h3>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card h-100">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Project Image">
                                <div class="card-body">
                                    <h4 class="h5">Enterprise AI Platform</h4>
                                    <p class="card-text">Led development of award-winning AI platform now used by Fortune 500 companies.</p>
                                    <div class="badge bg-primary">Patent #US1234567</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Project Image">
                                <div class="card-body">
                                    <h4 class="h5">Global Payment System</h4>
                                    <p class="card-text">Architected scalable payment processing system handling $1B+ annually.</p>
                                    <div class="badge bg-primary">Industry Award 2021</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Project Image">
                                <div class="card-body">
                                    <h4 class="h5">Sustainability Initiative</h4>
                                    <p class="card-text">Pioneered green computing practices reducing company carbon footprint by 40%.</p>
                                    <div class="badge bg-primary">Featured in TechToday</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Industry Recognition & Awards -->
                <div class="mb-5">
                    <h3 class="h4 mb-4 text-primary"><i class="fas fa-award me-2"></i>Industry Recognition & Awards</h3>
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-4">
                            <div class="card award-card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="award-icon me-3">
                                            <i class="fas fa-medal text-warning fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="h5 mb-1">Tech Leader of the Year</h4>
                                            <p class="mb-0 text-muted">Global Tech Awards, 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card award-card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="award-icon me-3">
                                            <i class="fas fa-trophy text-warning fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="h5 mb-1">Top 40 Under 40</h4>
                                            <p class="mb-0 text-muted">Business Innovators, 2021</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card award-card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="award-icon me-3">
                                            <i class="fas fa-star text-warning fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="h5 mb-1">Best AI Implementation</h4>
                                            <p class="mb-0 text-muted">AI & Tech Summit, 2020</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Timeline Styles */
    .timeline {
        position: relative;
        padding-left: 50px;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--primary-color);
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }
    
    .timeline-date {
        position: absolute;
        left: -50px;
        top: 0;
        width: 40px;
        padding: 5px;
        text-align: center;
        background: var(--primary-color);
        color: white;
        border-radius: 4px;
        font-weight: bold;
        font-size: 0.9rem;
    }
    
    .timeline-content {
        position: relative;
        padding-left: 20px;
    }
    
    .timeline-content:before {
        content: '';
        position: absolute;
        left: 0;
        top: 15px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: white;
        border: 3px solid var(--primary-color);
        z-index: 1;
    }
    
    /* Award Cards */
    .award-card {
        transition: transform 0.3s ease;
        border-left: 3px solid var(--primary-color);
    }
    
    .award-card:hover {
        transform: translateY(-5px);
    }
    
    .award-icon {
        color: var(--primary-color);
    }
    
    /* Accordion Customization */
    .accordion-button:not(.collapsed) {
        background-color: rgba(52, 152, 219, 0.1);
        color: var(--primary-color);
    }
</style>


<!-- My Story Section -->
<section class="py-5 bg-light" id="my-story">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="section-title text-center mb-5">My Story</h2>
                
                <div class="story-content">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex mb-4">
                                <div class="me-3">
                                    <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="lead fst-italic">My journey in technology began unexpectedly when I built my first computer from spare parts at age 12. That moment of triumph when the screen flickered to life sparked a lifelong passion for solving complex problems through innovation.</p>
                                </div>
                            </div>
                            
                            <p>Growing up in a small town with limited resources, I learned early that creativity often trumps budget. When our high school couldn't afford new computers, I led a team of classmates to refurbish donated machines, giving our community its first computer lab.</p>
                            
                            <p class="mb-4">My professional turning point came during my first year at TechStart Inc. Challenged with an impossible deadline for a client project, I developed a rapid prototyping method that cut development time by 60%. This became the foundation for my "fail fast, learn faster" philosophy that I've applied throughout my career.</p>
                            
                            <div class="story-highlight bg-primary bg-opacity-10 p-4 rounded mb-4">
                                <h4 class="h5"><i class="fas fa-lightbulb me-2 text-primary"></i>Defining Moment</h4>
                                <p class="mb-0">The 2018 industry conference where I presented my "Human-Centered AI" framework changed everything. What began as a hallway conversation with skeptical peers evolved into an industry standard adopted by three Fortune 100 companies.</p>
                            </div>
                            
                            <p>What motivates me most is seeing technology create real human impact. Whether it's watching a nurse use our software to save critical time in emergencies, or receiving letters from students who used our educational tools to discover STEM careers—these moments fuel my work.</p>
                            
                            <p class="mb-0">Behind every line of code, every product launch, there's a simple truth that guides me: Technology at its best doesn't just solve problems—it creates possibilities people never imagined. That's the legacy I want to build.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Personal Statement Section -->
<section class="py-5" id="personal-statement">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <h2 class="section-title text-center mb-5">Personal Statement</h2>
                
                <div class="card statement-card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5 text-center">
                        <img src="https://via.placeholder.com/100" alt="Signature" class="mb-4" style="height: 50px;">
                        <p class="lead mb-4">I am a technology leader driven by the belief that innovation should serve human potential. With 15 years at the intersection of product development and strategic leadership, I specialize in transforming complex technical concepts into solutions that deliver measurable business value while improving lives.</p>
                        <p class="mb-0">My approach combines analytical rigor with creative problem-solving, always grounded in ethical considerations. I stand for technology that empowers rather than replaces, that bridges divides rather than creates them. Whether building teams, products, or companies, I bring a unique blend of technical depth, business acumen, and unwavering commitment to positive impact.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Unique Value Proposition Section -->
<section class="py-5 bg-light" id="unique-value">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title text-center mb-5">Unique Value Proposition</h2>
                
                <div class="row g-4">
                    <!-- Specialized Skills -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper bg-primary bg-opacity-10 mx-auto mb-4">
                                    <i class="fas fa-tools text-primary fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-3">Specialized Skills</h3>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">AI/ML Product Strategy</li>
                                    <li class="mb-2">Enterprise Architecture</li>
                                    <li class="mb-2">Digital Transformation</li>
                                    <li class="mb-2">Cross-Functional Leadership</li>
                                    <li>Technical Due Diligence</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Methodologies -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper bg-primary bg-opacity-10 mx-auto mb-4">
                                    <i class="fas fa-project-diagram text-primary fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-3">Methodologies</h3>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">Human-Centered AI Framework</li>
                                    <li class="mb-2">Rapid Value Prototyping</li>
                                    <li class="mb-2">Growth Architecture</li>
                                    <li class="mb-2">Inclusive Design Sprints</li>
                                    <li>Ethical Tech Assessment</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Thought Leadership -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper bg-primary bg-opacity-10 mx-auto mb-4">
                                    <i class="fas fa-bullhorn text-primary fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-3">Thought Leadership</h3>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">Keynote Speaker (30+ events)</li>
                                    <li class="mb-2">Forbes Tech Council</li>
                                    <li class="mb-2">Advisor to 3 Startups</li>
                                    <li class="mb-2">Industry White Papers</li>
                                    <li>Mentor to Women in Tech</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Publications -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper bg-primary bg-opacity-10 mx-auto mb-4">
                                    <i class="fas fa-file-alt text-primary fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-3">Publications</h3>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">7 Patents in AI Applications</li>
                                    <li class="mb-2">"Ethical AI in Practice" (2022)</li>
                                    <li class="mb-2">TechReview Contributor</li>
                                    <li class="mb-2">3 Peer-Reviewed Papers</li>
                                    <li>Monthly Industry Blog</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Value Proposition Summary -->
                <div class="card mt-5 border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center mb-4 mb-md-0">
                                <div class="icon-wrapper-lg bg-primary bg-opacity-10 mx-auto">
                                    <i class="fas fa-chess-queen text-primary fa-3x"></i>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h3 class="h4">What Sets Me Apart</h3>
                                <p class="mb-0">I combine rare technical depth with executive business perspective, having led projects from initial code to IPO. My value lies in bridging the gap between engineering teams and C-suite objectives, translating complex technologies into strategic advantages. Unlike pure technologists or general managers, I speak both languages fluently—a skill honed through 5 successful product launches and 3 company turnarounds. My published frameworks are used industry-wide because they address not just technical challenges, but human and organizational factors critical for adoption.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* My Story Styles */
    .story-highlight {
        border-left: 3px solid var(--primary-color);
    }
    
    /* Personal Statement Styles */
    .statement-card {
        background-color: white;
        border-radius: 8px;
    }
    
    /* Unique Value Styles */
    .icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .icon-wrapper-lg {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Section-specific spacing */
    #my-story {
        background-color: rgba(52, 152, 219, 0.05);
    }
    
    #unique-value .card {
        transition: transform 0.3s ease;
    }
    
    #unique-value .card:hover {
        transform: translateY(-5px);
    }
</style>



<!-- Personal Brand Elements Section -->
<section class="py-5" id="brand-elements">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title text-center mb-5">Personal Brand Elements</h2>
                
                <div class="row g-4">
                    <!-- Professional Philosophy -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex mb-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                        <i class="fas fa-atom text-primary fa-2x"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-0">Professional Philosophy</h3>
                                        <p class="text-muted mb-0">My guiding principles</p>
                                    </div>
                                </div>
                                <ul class="list-unstyled ps-4">
                                    <li class="mb-2 position-relative ps-3">
                                        <i class="fas fa-circle text-primary small position-absolute" style="left: 0; top: 8px;"></i>
                                        <strong>Human-Centered Technology:</strong> Tools should amplify human potential
                                    </li>
                                    <li class="mb-2 position-relative ps-3">
                                        <i class="fas fa-circle text-primary small position-absolute" style="left: 0; top: 8px;"></i>
                                        <strong>Ethical By Design:</strong> Build integrity into every system
                                    </li>
                                    <li class="mb-2 position-relative ps-3">
                                        <i class="fas fa-circle text-primary small position-absolute" style="left: 0; top: 8px;"></i>
                                        <strong>Growth Through Challenge:</strong> Comfort zones are innovation dead zones
                                    </li>
                                    <li class="position-relative ps-3">
                                        <i class="fas fa-circle text-primary small position-absolute" style="left: 0; top: 8px;"></i>
                                        <strong>Collaborative Excellence:</strong> The best solutions emerge from diverse minds
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Leadership Style -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex mb-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                        <i class="fas fa-chess-king text-primary fa-2x"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-0">Leadership Style</h3>
                                        <p class="text-muted mb-0">How I build and guide teams</p>
                                    </div>
                                </div>
                                <div class="leadership-traits">
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-primary rounded-pill me-2">1</span>
                                        </div>
                                        <div>
                                            <strong>Servant Leadership:</strong> Clear vision with hands-on support
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-primary rounded-pill me-2">2</span>
                                        </div>
                                        <div>
                                            <strong>Radical Transparency:</strong> Information sharing builds trust
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-primary rounded-pill me-2">3</span>
                                        </div>
                                        <div>
                                            <strong>Fail Forward Culture:</strong> Celebrate lessons from setbacks
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-primary rounded-pill me-2">4</span>
                                        </div>
                                        <div>
                                            <strong>Talent Multiplier:</strong> Grow team capabilities exponentially
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Vision & Future -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex mb-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                        <i class="fas fa-binoculars text-primary fa-2x"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-0">Vision & Future</h3>
                                        <p class="text-muted mb-0">Where I'm headed</p>
                                    </div>
                                </div>
                                <div class="vision-item mb-3">
                                    <h4 class="h6 mb-1">5-Year Goal</h4>
                                    <p class="mb-0">Establish an innovation lab bridging tech and social impact sectors</p>
                                </div>
                                <div class="vision-item mb-3">
                                    <h4 class="h6 mb-1">Industry Change</h4>
                                    <p class="mb-0">Make ethical AI assessment standard practice by 2027</p>
                                </div>
                                <div class="vision-item">
                                    <h4 class="h6 mb-1">Legacy</h4>
                                    <p class="mb-0">Mentor 100+ underrepresented technologists</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Community Impact -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex mb-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                        <i class="fas fa-hands-helping text-primary fa-2x"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-0">Community Impact</h3>
                                        <p class="text-muted mb-0">Beyond professional achievements</p>
                                    </div>
                                </div>
                                <div class="impact-item d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary me-2"></i>
                                    </div>
                                    <div>
                                        <strong>TechBridge Nonprofit:</strong> Board member since 2018
                                    </div>
                                </div>
                                <div class="impact-item d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary me-2"></i>
                                    </div>
                                    <div>
                                        <strong>Coding for Seniors:</strong> Monthly workshop leader
                                    </div>
                                </div>
                                <div class="impact-item d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary me-2"></i>
                                    </div>
                                    <div>
                                        <strong>STEM Scholarships:</strong> Funded 3 annual awards
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="media-assets">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gallery" type="button" role="tab" aria-controls="v-pills-gallery" aria-selected="true">
                        <i class="fas fa-images me-2"></i> Gallery
                    </button>
                    <button class="nav-link" id="v-pills-portfolio-tab" data-bs-toggle="pill" data-bs-target="#v-pills-portfolio" type="button" role="tab" aria-controls="v-pills-portfolio" aria-selected="false">
                        <i class="fas fa-briefcase me-2"></i> Portfolio
                    </button>
                    <button class="nav-link" id="v-pills-videos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-videos" type="button" role="tab" aria-controls="v-pills-videos" aria-selected="false">
                        <i class="fas fa-video me-2"></i> Videos
                    </button>
                    <button class="nav-link" id="v-pills-publications-tab" data-bs-toggle="pill" data-bs-target="#v-pills-publications" type="button" role="tab" aria-controls="v-pills-publications" aria-selected="false">
                        <i class="fas fa-newspaper me-2"></i> Publications
                    </button>
                    <button class="nav-link" id="v-pills-social-tab" data-bs-toggle="pill" data-bs-target="#v-pills-social" type="button" role="tab" aria-controls="v-pills-social" aria-selected="false">
                        <i class="fas fa-share-alt me-2"></i> Social Media
                    </button>
                </div>
            </div>
            <div class="col-lg-9">
                <h2 class="section-title mb-4 d-lg-none">Media Assets</h2>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-gallery" role="tabpanel" aria-labelledby="v-pills-gallery-tab">
                        <h3 class="mb-4"><i class="fas fa-camera me-2 text-primary"></i> Image Gallery</h3>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="https://via.placeholder.com/800x1200">
                                    <img src="https://via.placeholder.com/300x300" alt="Headshot" class="img-fluid rounded shadow-sm">
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="https://via.placeholder.com/1200x800">
                                    <img src="https://via.placeholder.com/300x300" alt="Speaking" class="img-fluid rounded shadow-sm">
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="https://via.placeholder.com/800x800">
                                    <img src="https://via.placeholder.com/300x300" alt="Team" class="img-fluid rounded shadow-sm">
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="https://via.placeholder.com/1200x600">
                                    <img src="https://via.placeholder.com/300x300" alt="Workshop" class="img-fluid rounded shadow-sm">
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="https://via.placeholder.com/600x900">
                                    <img src="https://via.placeholder.com/300x300" alt="Event" class="img-fluid rounded shadow-sm">
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="https://via.placeholder.com/900x600">
                                    <img src="https://via.placeholder.com/300x300" alt="Collaboration" class="img-fluid rounded shadow-sm">
                                </a>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="btn btn-primary">View All Photos</a>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-portfolio" role="tabpanel" aria-labelledby="v-pills-portfolio-tab">
                        <h3 class="mb-4"><i class="fas fa-briefcase me-2 text-primary"></i> Portfolio</h3>
                        <div class="mb-4">
                            <h4 class="h6 mb-2">Featured Case Studies:</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                    <a href="#" class="text-decoration-none">Enterprise AI Transformation (PDF)</a>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                    <a href="#" class="text-decoration-none">Global Payment System Implementation (PDF)</a>
                                </li>
                                <li>
                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                    <a href="#" class="text-decoration-none">Nonprofit Tech Overhaul Strategy (PDF)</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="h6 mb-2">Key Projects:</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-code text-success me-2"></i> <a href="#" class="text-decoration-none">AI-Powered Analytics Platform</a></li>
                                <li class="mb-2"><i class="fas fa-rocket text-success me-2"></i> <a href="#" class="text-decoration-none">New Product Launch Strategy</a></li>
                                <li><i class="fas fa-users text-success me-2"></i> <a href="#" class="text-decoration-none">Team Collaboration Framework</a></li>
                            </ul>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="btn btn-primary">View Full Portfolio</a>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-videos" role="tabpanel" aria-labelledby="v-pills-videos-tab">
                        <h3 class="mb-4"><i class="fas fa-video me-2 text-primary"></i> Videos</h3>
                        <div class="ratio ratio-16x9 mb-4">
                            <iframe src="https://www.youtube.com/embed/your_video_id_1" title="Sample Video 1" allowfullscreen></iframe>
                        </div>
                        <div class="ratio ratio-16x9 mb-4">
                            <iframe src="https://www.youtube.com/embed/your_video_id_2" title="Sample Video 2" allowfullscreen></iframe>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-play-circle text-primary me-2"></i>
                                <a href="#" class="text-decoration-none">TechForward 2023 Keynote</a>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-play-circle text-primary me-2"></i>
                                <a href="#" class="text-decoration-none">AI Ethics Panel Discussion</a>
                            </li>
                            <li>
                                <i class="fas fa-play-circle text-primary me-2"></i>
                                <a href="#" class="text-decoration-none">Client Success Stories</a>
                            </li>
                        </ul>
                        <div class="mt-4">
                            <a href="#" class="btn btn-primary">View All Videos</a>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-publications" role="tabpanel" aria-labelledby="v-pills-publications-tab">
                        <h3 class="mb-4"><i class="fas fa-newspaper me-2 text-primary"></i> Publications</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-book text-primary me-2"></i>
                                <a href="#" class="text-decoration-none">"Ethical AI in Practice" - TechReview (2023) <span class="badge bg-secondary ms-2">Article</span></a>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-book text-primary me-2"></i>
                                <a href="#" class="text-decoration-none">"Leading Digital Transformation" - Harvard Biz (2022) <span class="badge bg-secondary ms-2">Article</span></a>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-podcast text-primary me-2"></i>
                                <a href="#" class="text-decoration-none">FutureTech Podcast - Episode 45 <span class="badge bg-success ms-2">Podcast</span></a>
                            </li>
                            <li>
                                <i class="fas fa-tv text-primary me-2"></i>
                                <a href="#" class="text-decoration-none">CNBC Tech Interview - May 2023 <span class="badge bg-info ms-2">Interview</span></a>
                            </li>
                            <li>
                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                <a href="#" class="text-decoration-none">White Paper: The Future of Quantum Computing <span class="badge bg-danger ms-2">White Paper</span></a>
                            </li>
                        </ul>
                        <div class="mt-4">
                            <a href="#" class="btn btn-primary">View All Publications</a>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
                        <h3 class="mb-4"><i class="fas fa-share-alt me-2 text-primary"></i> Social Media</h3>
                        <div class="social-links">
                            <a href="#" class="btn btn-outline-primary btn-lg mb-2 me-2">
                                <i class="fab fa-linkedin-in me-2"></i> LinkedIn
                            </a>
                            <a href="#" class="btn btn-outline-info btn-lg mb-2 me-2">
                                <i class="fab fa-twitter me-2"></i> Twitter
                            </a>
                            <a href="#" class="btn btn-outline-danger btn-lg mb-2 me-2">
                                <i class="fab fa-youtube me-2"></i> YouTube
                            </a>
                            <a href="#" class="btn btn-outline-dark btn-lg mb-2">
                                <i class="fab fa-github me-2"></i> GitHub
                            </a>
                        </div>
                        <div class="mt-4">
                            <h4 class="h6 mb-2">Professional Hashtags:</h4>
                            <div class="d-flex flex-wrap">
                                <span class="badge bg-light text-dark me-2 mb-2">#TechLeadership</span>
                                <span class="badge bg-light text-dark me-2 mb-2">#EthicalAI</span>
                                <span class="badge bg-light text-dark me-2 mb-2">#DigitalTransformation</span>
                                <span class="badge bg-light text-dark mb-2">#InnovationCulture</span>
                                <span class="badge bg-light text-dark me-2 mb-2">#FutureofWork</span>
                                <span class="badge bg-light text-dark mb-2">#StrategicThinking</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="" id="modalImage" class="img-fluid" alt="Enlarged view">
                </div>
                <div class="modal-footer">
                    <a href="#" id="downloadImage" class="btn btn-primary" target="_blank" download>Download</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Adjust styles as needed */
    .nav-pills .nav-link {
        color: #333;
        margin-bottom: 5px;
        border-radius: 0.25rem;
    }

    .nav-pills .nav-link.active {
        background-color: #007bff;
        color: white;
    }

    .nav-pills .nav-link i {
        width: 1.2em; /* Ensure icons align properly */
        text-align: center;
    }

    @media (max-width: 991.98px) {
        .section-title.d-lg-none {
            margin-bottom: 30px;
        }
        .nav-pills {
            flex-direction: row;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .nav-pills .nav-link {
            margin-right: 10px;
            margin-bottom: 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageModal = document.getElementById('imageModal');
        if (imageModal) {
            imageModal.addEventListener('show.bs.modal', event => {
                const imgLink = event.relatedTarget.getAttribute('data-img');
                const modalImage = imageModal.querySelector('#modalImage');
                const downloadLink = imageModal.querySelector('#downloadImage');

                modalImage.src = imgLink;
                downloadLink.href = imgLink;
            });
        }
    });
</script>

<!-- Client Impact Stories Section -->
<section class="py-5" id="client-stories">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title text-center mb-5">Client Impact Stories</h2>
                
                <!-- Story 1 -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <h3 class="h4">Enterprise AI Transformation</h3>
                                <div class="client-logo mb-3">
                                    <img src="https://via.placeholder.com/150x50" alt="Client Logo" class="img-fluid">
                                </div>
                                <div class="badge bg-primary mb-2">Manufacturing Sector</div>
                                <p class="mb-0"><strong>Duration:</strong> 18 months</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Challenge</h4>
                                        <p>$1B manufacturer struggling with 30% defect rate and $12M annual quality costs</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-lightbulb text-primary me-2"></i> Solution</h4>
                                        <p>Led development of custom AI quality control system integrated with production lines</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-chart-line text-success me-2"></i> Results</h4>
                                        <ul class="mb-0">
                                            <li>62% reduction in defects</li>
                                            <li>$8.7M first-year savings</li>
                                            <li>ROI in 7 months</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-quote-left text-info me-2"></i> Testimonial</h4>
                                        <div class="bg-light p-3 rounded">
                                            <p class="fst-italic mb-0">"The solution transformed our quality process and became a competitive advantage in our RFP responses."</p>
                                            <p class="mb-0 text-end"><strong>— COO, ManufacturingCo</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Story 2 -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <h3 class="h4">Global Payment System</h3>
                                <div class="client-logo mb-3">
                                    <img src="https://via.placeholder.com/150x50" alt="Client Logo" class="img-fluid">
                                </div>
                                <div class="badge bg-primary mb-2">Financial Services</div>
                                <p class="mb-0"><strong>Duration:</strong> 2 years</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Challenge</h4>
                                        <p>Legacy system couldn't handle 300% transaction volume growth, causing outages</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-lightbulb text-primary me-2"></i> Solution</h4>
                                        <p>Architected cloud-native payment platform with 99.999% availability SLA</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-chart-line text-success me-2"></i> Results</h4>
                                        <ul class="mb-0">
                                            <li>Handles 15,000 TPS (up from 2,500)</li>
                                            <li>Zero downtime in 18 months</li>
                                            <li>Enabled expansion to 12 new markets</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-quote-left text-info me-2"></i> Testimonial</h4>
                                        <div class="bg-light p-3 rounded">
                                            <p class="fst-italic mb-0">"The system became the backbone of our international growth strategy, delivering flawless performance."</p>
                                            <p class="mb-0 text-end"><strong>— CTO, FinTechGlobal</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Story 3 -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <h3 class="h4">Nonprofit Tech Overhaul</h3>
                                <div class="client-logo mb-3">
                                    <img src="https://via.placeholder.com/150x50" alt="Client Logo" class="img-fluid">
                                </div>
                                <div class="badge bg-primary mb-2">Social Sector</div>
                                <p class="mb-0"><strong>Duration:</strong> 9 months</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Challenge</h4>
                                        <p>Manual processes limited service reach to only 15% of target population</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-lightbulb text-primary me-2"></i> Solution</h4>
                                        <p>Pro bono development of mobile platform with automated eligibility screening</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-chart-line text-success me-2"></i> Results</h4>
                                        <ul class="mb-0">
                                            <li>400% increase in clients served</li>
                                            <li>80% reduction in processing time</li>
                                            <li>$2.3M additional funding secured</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-quote-left text-info me-2"></i> Testimonial</h4>
                                        <div class="bg-light p-3 rounded">
                                            <p class="fst-italic mb-0">"This transformation allowed us to help thousands more families in need with the same resources."</p>
                                            <p class="mb-0 text-end"><strong>— Executive Director, CommunityFirst</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Brand Elements Styles */
    .leadership-traits .badge {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
    }
    
    /* Media Assets Styles */
    #media-assets .card {
        transition: all 0.3s ease;
    }
    
    #media-assets .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .social-links .btn {
        width: 110px;
        text-align: left;
    }
    
    /* Client Stories Styles */
    .client-logo {
        height: 50px;
        display: flex;
        align-items: center;
    }
    
    #client-stories .card {
        transition: transform 0.3s ease;
    }
    
    #client-stories .card:hover {
        transform: translateY(-5px);
    }
</style>

<script>
    // Image Modal Handler
    document.addEventListener('DOMContentLoaded', function() {
        var imageModal = document.getElementById('imageModal');
        imageModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var imgSrc = button.getAttribute('data-img');
            var modalImg = document.getElementById('modalImage');
            var downloadLink = document.getElementById('downloadImage');
            
            modalImg.src = imgSrc;
            downloadLink.href = imgSrc;
        });
    });
</script>



<!-- Digital Presence Section -->
<section class="py-5 bg-light" id="digital-presence">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title text-center mb-5">Digital Presence</h2>
                
                <div class="row g-4">
                    <!-- Professional Profiles -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-id-card fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0">Professional Profiles</h3>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fab fa-linkedin fa-fw fa-lg text-linkedin me-3"></i>
                                        </div>
                                        <div>
                                            <h4 class="h6 mb-1">LinkedIn</h4>
                                            <a href="#" class="text-decoration-none">linkedin.com/in/professionalname</a>
                                            <p class="small text-muted mt-1">5000+ connections, regular industry insights</p>
                                        </div>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fab fa-twitter fa-fw fa-lg text-twitter me-3"></i>
                                        </div>
                                        <div>
                                            <h4 class="h6 mb-1">Twitter (X)</h4>
                                            <a href="#" class="text-decoration-none">twitter.com/professionalhandle</a>
                                            <p class="small text-muted mt-1">10K+ followers, daily tech commentary</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fab fa-angellist fa-fw fa-lg text-dark me-3"></i>
                                        </div>
                                        <div>
                                            <h4 class="h6 mb-1">Other Platforms</h4>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="#" class="badge bg-light text-dark text-decoration-none">Behance</a>
                                                <a href="#" class="badge bg-light text-dark text-decoration-none">Dribbble</a>
                                                <a href="#" class="badge bg-light text-dark text-decoration-none">StackOverflow</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Website & Blog -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-globe fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0">Website & Blog</h3>
                                </div>
                                <div class="mb-4">
                                    <h4 class="h6 mb-2">Personal Website:</h4>
                                    <a href="#" class="d-block mb-3 text-decoration-none">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-external-link-alt fa-fw me-2 text-primary"></i>
                                            <span>professionalname.com</span>
                                        </div>
                                    </a>
                                    <div class="ratio ratio-16x9 mb-2">
                                        <img src="https://via.placeholder.com/800x450" alt="Website screenshot" class="img-fluid rounded">
                                    </div>
                                </div>
                                <div>
                                    <h4 class="h6 mb-2">Featured Blog Posts:</h4>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-pen-fancy text-primary me-2"></i>
                                            <a href="#" class="text-decoration-none">"The Future of Human-Centered AI"</a>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-pen-fancy text-primary me-2"></i>
                                            <a href="#" class="text-decoration-none">"Lessons from Scaling Tech Teams"</a>
                                        </li>
                                        <li>
                                            <i class="fas fa-pen-fancy text-primary me-2"></i>
                                            <a href="#" class="text-decoration-none">"Ethics in Digital Transformation"</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Industry Platforms -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-laptop-code fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0">Industry Platforms</h3>
                                </div>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="p-3 border rounded text-center h-100">
                                            <i class="fab fa-github fa-2x mb-2 text-dark"></i>
                                            <h4 class="h6 mb-1">GitHub</h4>
                                            <a href="#" class="small text-decoration-none">github.com/prohandle</a>
                                            <p class="small text-muted mt-1 mb-0">12 repositories, 5 open-source contributions</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 border rounded text-center h-100">
                                            <i class="fab fa-medium fa-2x mb-2 text-dark"></i>
                                            <h4 class="h6 mb-1">Medium</h4>
                                            <a href="#" class="small text-decoration-none">medium.com/@prohandle</a>
                                            <p class="small text-muted mt-1 mb-0">25 articles, 50K+ reads</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 border rounded text-center h-100">
                                            <i class="fas fa-book-open fa-2x mb-2 text-dark"></i>
                                            <h4 class="h6 mb-1">ResearchGate</h4>
                                            <a href="#" class="small text-decoration-none">researchgate.net/profile</a>
                                            <p class="small text-muted mt-1 mb-0">7 publications, 200+ citations</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 border rounded text-center h-100">
                                            <i class="fab fa-stack-overflow fa-2x mb-2 text-dark"></i>
                                            <h4 class="h6 mb-1">Stack Overflow</h4>
                                            <a href="#" class="small text-decoration-none">stackoverflow.com/users</a>
                                            <p class="small text-muted mt-1 mb-0">Top 5% contributor</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recorded Talks -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-video fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0">Recorded Talks & Webinars</h3>
                                </div>
                                <div class="mb-4">
                                    <div class="ratio ratio-16x9 mb-3">
                                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Featured Talk" allowfullscreen></iframe>
                                    </div>
                                    <h4 class="h6 mb-2">Featured Presentation:</h4>
                                    <p>"Ethical AI in Enterprise Applications" - TechForward 2023</p>
                                </div>
                                <div>
                                    <h4 class="h6 mb-2">Additional Talks:</h4>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-play-circle text-primary me-2"></i>
                                            <a href="#" class="text-decoration-none">"Leading Digital Transformation" - ExecSummit 2022</a>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-play-circle text-primary me-2"></i>
                                            <a href="#" class="text-decoration-none">Webinar: "Future of Work Tech" - 2023</a>
                                        </li>
                                        <li>
                                            <i class="fas fa-play-circle text-primary me-2"></i>
                                            <a href="#" class="text-decoration-none">Panel: "Women in Tech Leadership" - 2023</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Network & Influence Section -->
<section class="py-5" id="network-influence">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title text-center mb-5">Network & Influence</h2>
                
                <div class="row g-4">
                    <!-- Associations -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-users fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0">Professional Associations</h3>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-star text-warning me-3"></i>
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-1">IEEE Senior Member</h4>
                                                <p class="small text-muted mb-0">Since 2018, Committee Chair 2020-2022</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-star text-warning me-3"></i>
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-1">Forbes Technology Council</h4>
                                                <p class="small text-muted mb-0">Official Member since 2021</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-star text-warning me-3"></i>
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-1">AI Ethics Alliance</h4>
                                                <p class="small text-muted mb-0">Founding Member, Working Group Lead</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-star text-warning me-3"></i>
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-1">TechWomen Mentorship Program</h4>
                                                <p class="small text-muted mb-0">Mentor since 2019</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Collaborations -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-handshake fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0">Key Collaborations</h3>
                                </div>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="p-3 border rounded text-center h-100">
                                            <img src="https://via.placeholder.com/80x40" alt="Partner Logo" class="img-fluid mb-2">
                                            <h4 class="h6 mb-1">Microsoft</h4>
                                            <p class="small text-muted mb-0">AI Partner Program</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 border rounded text-center h-100">
                                            <img src="https://via.placeholder.com/80x40" alt="Partner Logo" class="img-fluid mb-2">
                                            <h4 class="h6 mb-1">Stanford</h4>
                                            <p class="small text-muted mb-0">Research Initiative</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 border rounded text-center h-100">
                                            <img src="https://via.placeholder.com/80x40" alt="Partner Logo" class="img-fluid mb-2">
                                            <h4 class="h6 mb-1">TechNonprofit</h4>
                                            <p class="small text-muted mb-0">Board Advisor</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 border rounded text-center h-100">
                                            <img src="https://via.placeholder.com/80x40" alt="Partner Logo" class="img-fluid mb-2">
                                            <h4 class="h6 mb-1">StartupIncubator</h4>
                                            <p class="small text-muted mb-0">Mentor Network</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mentorship -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-user-graduate fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0">Mentorship & Leadership</h3>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="p-3 border rounded">
                                            <h4 class="h6 mb-2">TechWomen Rising</h4>
                                            <p class="small mb-2">Mentored 15 early-career women in tech through 6-month program</p>
                                            <span class="badge bg-light text-dark">2019-Present</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-3 border rounded">
                                            <h4 class="h6 mb-2">University Advisor</h4>
                                            <p class="small mb-2">Advisory board for Stanford Computer Science Department</p>
                                            <span class="badge bg-light text-dark">2020-2023</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-3 border rounded">
                                            <h4 class="h6 mb-2">Founder Circles</h4>
                                            <p class="small mb-2">Lead monthly peer advisory group for tech startup founders</p>
                                            <span class="badge bg-light text-dark">2022-Present</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Media Mentions -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-bullhorn fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0">Media & Influence</h3>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-newspaper text-primary me-3"></i>
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-1">Featured in TechCrunch</h4>
                                                <p class="small text-muted mb-0">"How Ethical AI is Shaping the Future of Business" - March 2023</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-podcast text-primary me-3"></i>
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-1">FutureTech Podcast</h4>
                                                <p class="small text-muted mb-0">Episode 45: Leadership in Digital Transformation</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-tv text-primary me-3"></i>
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-1">CNBC Interview</h4>
                                                <p class="small text-muted mb-0">Market Trends in Enterprise Technology</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-award text-primary me-3"></i>
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-1">Top 100 Influencers</h4>
                                                <p class="small text-muted mb-0">TechLeader Magazine 2022, 2023</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Digital Presence Styles */
    .text-linkedin { color: #0a66c2; }
    .text-twitter { color: #1da1f2; }
    
    #digital-presence .platform-card {
        transition: all 0.3s ease;
    }
    
    #digital-presence .platform-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    /* Network & Influence Styles */
    #network-influence .card {
        transition: transform 0.3s ease;
    }
    
    #network-influence .card:hover {
        transform: translateY(-5px);
    }
    
    .partner-logo {
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }
</style>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h3 class="h4 mb-4">Connect With Me</h3>
                    <div class="d-flex justify-content-center gap-3 mb-4">
                        <a href="#" class="text-white fs-3"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-white fs-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white fs-3"><i class="fab fa-github"></i></a>
                        <a href="#" class="text-white fs-3"><i class="fas fa-envelope"></i></a>
                    </div>
                    <p class="mb-0">&copy; <span id="current-year"></span> Professional Achievements Portfolio. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set current year in footer
        document.getElementById('current-year').textContent = new Date().getFullYear();
        
        // You can add more dynamic functionality here as needed
    </script>