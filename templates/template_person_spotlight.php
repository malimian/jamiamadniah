<?php 
$current_page_id = 8310; // Replace with the actual page ID
?>
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
                    <img src="https://placehold.co/150" alt="Profile Photo" class="rounded-circle mb-4" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid white;">
                    <h1 class="display-4 fw-bold mb-3" id="professional-name">John D. Professional</h1>
                    <?php
                        // Hero Section - Professional Title and Tagline
                        $professional_title = get_attribute_value('professional_title', $current_page_id);
                        $professional_tagline = get_attribute_value('professional_tagline', $current_page_id);
                    ?>

<h2 class="h4 mb-4" id="professional-title"><?php echo htmlspecialchars($professional_title ?: 'Senior Executive | Industry Leader | Innovator'); ?></h2>
<p class="lead mb-4" id="professional-tagline"><?php echo htmlspecialchars($professional_tagline ?: 'Transforming visions into reality through strategic leadership and innovative solutions'); ?></p>

                </div>
            </div>
        </div>
    </header>

  <?php
// Personal Background Section
$personal_background_title = get_attribute_value('personal_background_title', $current_page_id);

// Professional Profile
$professional_profile_title = get_attribute_value('professional_profile_title', $current_page_id);
$full_name = get_attribute_value('full_name', $current_page_id);
$current_role = get_attribute_value('current_role', $current_page_id);
$current_company = get_attribute_value('current_company', $current_page_id);
$current_industry = get_attribute_value('current_industry', $current_page_id);

// Education
$education_title = get_attribute_value('education_title', $current_page_id);

$education_1_degree = get_attribute_value('education_1_degree', $current_page_id);
$education_1_institution = get_attribute_value('education_1_institution', $current_page_id);
$education_1_graduation_year = get_attribute_value('education_1_graduation_year', $current_page_id);

$education_2_degree = get_attribute_value('education_2_degree', $current_page_id);
$education_2_institution = get_attribute_value('education_2_institution', $current_page_id);
$education_2_graduation_year = get_attribute_value('education_2_graduation_year', $current_page_id);

// Certifications & Licenses
$certifications_title = get_attribute_value('certifications_title', $current_page_id);
$certifications = get_attribute_value('certifications', $current_page_id); // Assuming this returns an array of certification names

?>

<main class="container">
    <section class="mb-5" id="personal-background">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title text-center"><?php echo htmlspecialchars($personal_background_title ?: 'Personal Background'); ?></h2>

                <div class="card achievement-card mb-4">
                    <div class="card-body">
                        <h3 class="h4 card-title"><?php echo htmlspecialchars($professional_profile_title ?: 'Professional Profile'); ?></h3>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Full Name:</strong> <span id="full-name"><?php echo htmlspecialchars($full_name ?: 'John Doe Professional'); ?></span></p>
                                <p><strong>Current Role:</strong> <span id="current-role"><?php echo htmlspecialchars($current_role ?: 'Chief Executive Officer'); ?></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Company:</strong> <span id="current-company"><?php echo htmlspecialchars($current_company ?: 'InnovateTech Solutions'); ?></span></p>
                                <p><strong>Industry:</strong> <span id="current-industry"><?php echo htmlspecialchars($current_industry ?: 'Technology & Consulting'); ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card achievement-card mb-4">
                    <div class="card-body">
                        <h3 class="h4 card-title"><?php echo htmlspecialchars($education_title ?: 'Education'); ?></h3>
                        <div class="education-item mb-3">
                            <h4 class="h5"><?php echo htmlspecialchars($education_1_degree ?: 'MBA in Business Administration'); ?></h4>
                            <p class="mb-1"><?php echo htmlspecialchars($education_1_institution ?: 'Harvard Business School'); ?></p>
                            <p class="text-muted">Graduated: <?php echo htmlspecialchars($education_1_graduation_year ?: '2010'); ?></p>
                        </div>
                        <div class="education-item">
                            <h4 class="h5"><?php echo htmlspecialchars($education_2_degree ?: 'BSc in Computer Science'); ?></h4>
                            <p class="mb-1"><?php echo htmlspecialchars($education_2_institution ?: 'Stanford University'); ?></p>
                            <p class="text-muted">Graduated: <?php echo htmlspecialchars($education_2_graduation_year ?: '2005'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="card achievement-card mb-4">
                    <div class="card-body">
                        <h3 class="h4 card-title"><?php echo htmlspecialchars($certifications_title ?: 'Certifications & Licenses'); ?></h3>
                        <div>
                            <?php if (!empty($certifications)): ?>
                                <?php foreach ($certifications as $certification): ?>
                                    <span class="certification-badge"><i class="fas fa-certificate me-2"></i><?php echo htmlspecialchars($certification); ?></span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span class="certification-badge"><i class="fas fa-certificate me-2"></i>PMP Certified</span>
                                <span class="certification-badge"><i class="fas fa-certificate me-2"></i>Six Sigma Black Belt</span>
                                <span class="certification-badge"><i class="fas fa-certificate me-2"></i>AWS Solutions Architect</span>
                                <span class="certification-badge"><i class="fas fa-certificate me-2"></i>Google Cloud Professional</span>
                            <?php endif; ?>
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
                <?php
                // Assuming $conn is your established database connection
                // Assuming you have included the get_attribute_value and get_multiple_attribute_values functions

                // Assuming you have a $current_page_id available in the current scope

                // Career Progression Timeline
                $timeline_title = get_attribute_value('timeline_title', $current_page_id);

                $timeline_item_1_date = get_attribute_value('timeline_item_1_date', $current_page_id);
                $timeline_item_1_title = get_attribute_value('timeline_item_1_title', $current_page_id);
                $timeline_item_1_subtitle = get_attribute_value('timeline_item_1_subtitle', $current_page_id);
                $timeline_item_1_description = get_attribute_value('timeline_item_1_description', $current_page_id);

                $timeline_item_2_date = get_attribute_value('timeline_item_2_date', $current_page_id);
                $timeline_item_2_title = get_attribute_value('timeline_item_2_title', $current_page_id);
                $timeline_item_2_subtitle = get_attribute_value('timeline_item_2_subtitle', $current_page_id);
                $timeline_item_2_description = get_attribute_value('timeline_item_2_description', $current_page_id);

                $timeline_item_3_date = get_attribute_value('timeline_item_3_date', $current_page_id);
                $timeline_item_3_title = get_attribute_value('timeline_item_3_title', $current_page_id);
                $timeline_item_3_subtitle = get_attribute_value('timeline_item_3_subtitle', $current_page_id);
                $timeline_item_3_description = get_attribute_value('timeline_item_3_description', $current_page_id);
                ?>

                <div class="mb-5">
                    <h3 class="h4 mb-4 text-primary"><i class="fas fa-timeline me-2"></i><?php echo htmlspecialchars($timeline_title ?: 'Career Progression Timeline'); ?></h3>
                    <div class="timeline-wrapper">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-date"><?php echo htmlspecialchars($timeline_item_1_date ?: '2018 - Present'); ?></div>
                                <div class="timeline-content card">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo htmlspecialchars($timeline_item_1_title ?: 'Chief Technology Officer'); ?></h4>
                                        <h5 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($timeline_item_1_subtitle ?: 'InnovateTech Solutions'); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($timeline_item_1_description ?: 'Leading technology strategy and digital transformation for a 300-employee SaaS company. Grev annual recurring revenue from $5M to $50M in 4 years.'); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-date"><?php echo htmlspecialchars($timeline_item_2_date ?: '2015 - 2018'); ?></div>
                                <div class="timeline-content card">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo htmlspecialchars($timeline_item_2_title ?: 'Director of Product Development'); ?></h4>
                                        <h5 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($timeline_item_2_subtitle ?: 'TechGlobal Inc.'); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($timeline_item_2_description ?: 'Managed cross-functional teams to deliver 5 major product releases that captured 30% market share in our vertical.'); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-date"><?php echo htmlspecialchars($timeline_item_3_date ?: '2012 - 2015'); ?></div>
                                <div class="timeline-content card">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo htmlspecialchars($timeline_item_3_title ?: 'Senior Product Manager'); ?></h4>
                                        <h5 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($timeline_item_3_subtitle ?: 'Digital Solutions Co.'); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($timeline_item_3_description ?: 'Led the product team that developed the industry-leading EnterpriseX platform with 95% customer satisfaction.'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
<?php
// Assuming $conn is your established database connection
// Assuming you have included the get_attribute_value and get_multiple_attribute_values functions

// Assuming you have a $current_page_id available in the current scope

// Key Achievements & Breakthroughs
$achievements_title = get_attribute_value('achievements_title', $current_page_id);

$achievement_1_title = get_attribute_value('achievement_1_title', $current_page_id);
$achievement_1_description = get_attribute_value('achievement_1_description', $current_page_id);
$achievement_1_badge = get_attribute_value('achievement_1_badge', $current_page_id);

$achievement_2_title = get_attribute_value('achievement_2_title', $current_page_id);
$achievement_2_description = get_attribute_value('achievement_2_description', $current_page_id);
$achievement_2_badge = get_attribute_value('achievement_2_badge', $current_page_id);

$achievement_3_title = get_attribute_value('achievement_3_title', $current_page_id);
$achievement_3_description = get_attribute_value('achievement_3_description', $current_page_id);
$achievement_3_badge = get_attribute_value('achievement_3_badge', $current_page_id);

$achievement_4_title = get_attribute_value('achievement_4_title', $current_page_id);
$achievement_4_description = get_attribute_value('achievement_4_description', $current_page_id);
$achievement_4_badge = get_attribute_value('achievement_4_badge', $current_page_id);

?>

<div class="mb-5">
    <h3 class="h4 mb-4 text-primary"><i class="fas fa-trophy me-2"></i><?php echo htmlspecialchars($achievements_title ?: 'Key Achievements & Breakthroughs'); ?></h3>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 achievement-card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                            <i class="fas fa-lightbulb text-primary"></i>
                        </div>
                        <div>
                            <h4 class="h5"><?php echo htmlspecialchars($achievement_1_title ?: 'Product Innovation'); ?></h4>
                            <p class="mb-0"><?php echo htmlspecialchars($achievement_1_description ?: 'Developed patented AI algorithm that reduced processing time by 80% for enterprise clients.'); ?></p>
                            <?php if ($achievement_1_badge): ?>
                                <div class="badge bg-primary"><?php echo htmlspecialchars($achievement_1_badge); ?></div>
                            <?php endif; ?>
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
                            <h4 class="h5"><?php echo htmlspecialchars($achievement_2_title ?: 'Revenue Growth'); ?></h4>
                            <p class="mb-0"><?php echo htmlspecialchars($achievement_2_description ?: 'Spearheaded initiative that increased upsell revenue by 240% in 18 months.'); ?></p>
                            <?php if ($achievement_2_badge): ?>
                                <div class="badge bg-primary"><?php echo htmlspecialchars($achievement_2_badge); ?></div>
                            <?php endif; ?>
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
                            <h4 class="h5"><?php echo htmlspecialchars($achievement_3_title ?: 'Team Building'); ?></h4>
                            <p class="mb-0"><?php echo htmlspecialchars($achievement_3_description ?: 'Built and scaled engineering team from 5 to 50 while maintaining 92% retention rate.'); ?></p>
                            <?php if ($achievement_3_badge): ?>
                                <div class="badge bg-primary"><?php echo htmlspecialchars($achievement_3_badge); ?></div>
                            <?php endif; ?>
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
                            <h4 class="h5"><?php echo htmlspecialchars($achievement_4_title ?: 'Market Expansion'); ?></h4>
                            <p class="mb-0"><?php echo htmlspecialchars($achievement_4_description ?: 'Led successful expansion into 3 new international markets within 2 years.'); ?></p>
                            <?php if ($achievement_4_badge): ?>
                                <div class="badge bg-primary"><?php echo htmlspecialchars($achievement_4_badge); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
                <!-- Challenges Overcome & Lessons Learned -->
<?php
// Assuming $conn is your established database connection
// Assuming you have included the get_attribute_value and get_multiple_attribute_values functions

// Assuming you have a $current_page_id available in the current scope

// Challenges Overcome & Lessons Learned
$challenges_title = get_attribute_value('challenges_title', $current_page_id);

$challenge_1_title = get_attribute_value('challenge_1_title', $current_page_id);
$challenge_1_description = get_attribute_value('challenge_1_description', $current_page_id);
$challenge_1_lesson = get_attribute_value('challenge_1_lesson', $current_page_id);

$challenge_2_title = get_attribute_value('challenge_2_title', $current_page_id);
$challenge_2_description = get_attribute_value('challenge_2_description', $current_page_id);
$challenge_2_lesson = get_attribute_value('challenge_2_lesson', $current_page_id);

?>

<div class="mb-5">
    <h3 class="h4 mb-4 text-primary"><i class="fas fa-mountain me-2"></i><?php echo htmlspecialchars($challenges_title ?: 'Challenges Overcome & Lessons Learned'); ?></h3>
    <div class="accordion" id="challengesAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#challenge1">
                    <?php echo htmlspecialchars($challenge_1_title ?: 'Digital Transformation Resistance'); ?>
                </button>
            </h2>
            <div id="challenge1" class="accordion-collapse collapse" data-bs-parent="#challengesAccordion">
                <div class="accordion-body">
                    <p><?php echo htmlspecialchars($challenge_1_description ?: 'Overcame organizational resistance to digital transformation by implementing change management strategies that resulted in 85% adoption rate across departments.'); ?></p>
                    <p class="mb-0 fst-italic"><strong>Lesson:</strong> <?php echo htmlspecialchars($challenge_1_lesson ?: 'Cultural change requires equal parts technology, communication, and empathy.'); ?></p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#challenge2">
                    <?php echo htmlspecialchars($challenge_2_title ?: 'Market Downturn Recovery'); ?>
                </button>
            </h2>
            <div id="challenge2" class="accordion-collapse collapse" data-bs-parent="#challengesAccordion">
                <div class="accordion-body">
                    <p><?php echo htmlspecialchars($challenge_2_description ?: 'Navigated company through 2020 market downturn by pivoting product strategy, resulting in record revenue year despite economic conditions.'); ?></p>
                    <p class="mb-0 fst-italic"><strong>Lesson:</strong> <?php echo htmlspecialchars($challenge_2_lesson ?: 'Agile decision-making and scenario planning are critical in volatile markets.'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
                
<!-- Notable Projects or Innovations -->
<?php
// Assuming $conn is your established database connection
// Assuming you have included the get_attribute_value and get_multiple_attribute_values functions

// Assuming you have a $current_page_id available in the current scope

// Notable Projects or Innovations
$notable_projects_title = get_attribute_value('notable_projects_title', $current_page_id);

$project_1_image_url = get_attribute_value('project_1_image_url', $current_page_id);
$project_1_title = get_attribute_value('project_1_title', $current_page_id);
$project_1_description = get_attribute_value('project_1_description', $current_page_id);
$project_1_badge = get_attribute_value('project_1_badge', $current_page_id);

$project_2_image_url = get_attribute_value('project_2_image_url', $current_page_id);
$project_2_title = get_attribute_value('project_2_title', $current_page_id);
$project_2_description = get_attribute_value('project_2_description', $current_page_id);
$project_2_badge = get_attribute_value('project_2_badge', $current_page_id);

$project_3_image_url = get_attribute_value('project_3_image_url', $current_page_id);
$project_3_title = get_attribute_value('project_3_title', $current_page_id);
$project_3_description = get_attribute_value('project_3_description', $current_page_id);
$project_3_badge = get_attribute_value('project_3_badge', $current_page_id);

?>

<div class="mb-5">
    <h3 class="h4 mb-4 text-primary"><i class="fas fa-flask me-2"></i><?php echo htmlspecialchars($notable_projects_title ?: 'Notable Projects & Innovations'); ?></h3>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100">
                <img src="<?php echo check_image_url($project_1_image_url ?: 'https://placehold.co/300x200'); ?>" class="card-img-top" alt="Project Image">
                <div class="card-body">
                    <h4 class="h5"><?php echo htmlspecialchars($project_1_title ?: 'Enterprise AI Platform'); ?></h4>
                    <p class="card-text"><?php echo htmlspecialchars($project_1_description ?: 'Led development of award-winning AI platform now used by Fortune 500 companies.'); ?></p>
                    <?php if ($project_1_badge): ?>
                        <div class="badge bg-primary"><?php echo htmlspecialchars($project_1_badge); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <img src="<?php echo check_image_url($project_2_image_url ?: 'https://placehold.co/300x200'); ?>" class="card-img-top" alt="Project Image">
                <div class="card-body">
                    <h4 class="h5"><?php echo htmlspecialchars($project_2_title ?: 'Global Payment System'); ?></h4>
                    <p class="card-text"><?php echo htmlspecialchars($project_2_description ?: 'Architected scalable payment processing system handling $1B+ annually.'); ?></p>
                    <?php if ($project_2_badge): ?>
                        <div class="badge bg-primary"><?php echo htmlspecialchars($project_2_badge); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <img src="<?php echo check_image_url($project_3_image_url ?: 'https://placehold.co/300x200'); ?>" class="card-img-top" alt="Project Image">
                <div class="card-body">
                    <h4 class="h5"><?php echo htmlspecialchars($project_3_title ?: 'Sustainability Initiative'); ?></h4>
                    <p class="card-text"><?php echo htmlspecialchars($project_3_description ?: 'Pioneered green computing practices reducing company carbon footprint by 40%.'); ?></p>
                    <?php if ($project_3_badge): ?>
                        <div class="badge bg-primary"><?php echo htmlspecialchars($project_3_badge); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
                
<!-- Industry Recognition & Awards -->

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


<?php
// Fetch attribute values for the My Story section
$my_story_title = get_attribute_value('my_story_title', $current_page_id);
$story_paragraph_1 = get_attribute_value('story_paragraph_1', $current_page_id);
$story_paragraph_2 = get_attribute_value('story_paragraph_2', $current_page_id);
$story_paragraph_3 = get_attribute_value('story_paragraph_3', $current_page_id);
$highlight_title = get_attribute_value('highlight_title', $current_page_id);
$highlight_paragraph = get_attribute_value('highlight_paragraph', $current_page_id);
$story_paragraph_4 = get_attribute_value('story_paragraph_4', $current_page_id);
$story_paragraph_5 = get_attribute_value('story_paragraph_5', $current_page_id);

?>

<section class="py-5 bg-light" id="my-story">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="section-title text-center mb-5"><?php echo htmlspecialchars($my_story_title ?: 'My Story'); ?></h2>

                <div class="story-content">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex mb-4">
                                <div class="me-3">
                                    <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="lead fst-italic"><?php echo htmlspecialchars($story_paragraph_1 ?: 'My journey in technology began unexpectedly when I built my first computer from spare parts at age 12. That moment of triumph when the screen flickered to life sparked a lifelong passion for solving complex problems through innovation.'); ?></p>
                                </div>
                            </div>

                            <p><?php echo htmlspecialchars($story_paragraph_2 ?: 'Growing up in a small town with limited resources, I learned early that creativity often trumps budget. When our high school couldn\'t afford new computers, I led a team of classmates to refurbish donated machines, giving our community its first computer lab.'); ?></p>

                            <p class="mb-4"><?php echo htmlspecialchars($story_paragraph_3 ?: 'My professional turning point came during my first year at TechStart Inc. Challenged with an impossible deadline for a client project, I developed a rapid prototyping method that cut development time by 60%. This became the foundation for my "fail fast, learn faster" philosophy that I\'ve applied throughout my career.'); ?></p>

                            <div class="story-highlight bg-primary bg-opacity-10 p-4 rounded mb-4">
                                <h4 class="h5"><i class="fas fa-lightbulb me-2 text-primary"></i><?php echo htmlspecialchars($highlight_title ?: 'Defining Moment'); ?></h4>
                                <p class="mb-0"><?php echo htmlspecialchars($highlight_paragraph ?: 'The 2018 industry conference where I presented my "Human-Centered AI" framework changed everything. What began as a hallway conversation with skeptical peers evolved into an industry standard adopted by three Fortune 100 companies.'); ?></p>
                            </div>

                            <p><?php echo htmlspecialchars($story_paragraph_4 ?: 'What motivates me most is seeing technology create real human impact. Whether it\'s watching a nurse use our software to save critical time in emergencies, or receiving letters from students who used our educational tools to discover STEM careers—these moments fuel my work.'); ?></p>

                            <p class="mb-0"><?php echo htmlspecialchars($story_paragraph_5 ?: 'Behind every line of code, every product launch, there\'s a simple truth that guides me: Technology at its best doesn\'t just solve problems—it creates possibilities people never imagined. That\'s the legacy I want to build.'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Personal Statement Section -->
<?php
// Fetch attribute values for the Personal Statement section
$personal_statement_title = get_attribute_value('personal_statement_title', $current_page_id);
$signature_image_url = get_attribute_value('signature_image_url', $current_page_id);
$personal_statement_lead = get_attribute_value('personal_statement_lead', $current_page_id);
$personal_statement_body = get_attribute_value('personal_statement_body', $current_page_id);

?>

<section class="py-5" id="personal-statement">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <h2 class="section-title text-center mb-5"><?php echo htmlspecialchars($personal_statement_title ?: 'Personal Statement'); ?></h2>

                <div class="card statement-card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5 text-center">
                        <img src="<?php echo check_image_url($signature_image_url ?: 'https://placehold.co/100'); ?>" alt="Signature" class="mb-4" style="height: 50px;">
                        <p class="lead mb-4"><?php echo htmlspecialchars($personal_statement_lead ?: 'I am a technology leader driven by the belief that innovation should serve human potential. With 15 years at the intersection of product development and strategic leadership, I specialize in transforming complex technical concepts into solutions that deliver measurable business value while improving lives.'); ?></p>
                        <p class="mb-0"><?php echo htmlspecialchars($personal_statement_body ?: 'My approach combines analytical rigor with creative problem-solving, always grounded in ethical considerations. I stand for technology that empowers rather than replaces, that bridges divides rather than creates them. Whether building teams, products, or companies, I bring a unique blend of technical depth, business acumen, and unwavering commitment to positive impact.'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Fetch attribute values for the Unique Value Proposition section
$unique_value_title = get_attribute_value('unique_value_title', $current_page_id);

// Specialized Skills
$skills_title = get_attribute_value('skills_title', $current_page_id);
$skill_1 = get_attribute_value('skill_1', $current_page_id);
$skill_2 = get_attribute_value('skill_2', $current_page_id);
$skill_3 = get_attribute_value('skill_3', $current_page_id);
$skill_4 = get_attribute_value('skill_4', $current_page_id);
$skill_5 = get_attribute_value('skill_5', $current_page_id);

// Methodologies
$methodologies_title = get_attribute_value('methodologies_title', $current_page_id);
$methodology_1 = get_attribute_value('methodology_1', $current_page_id);
$methodology_2 = get_attribute_value('methodology_2', $current_page_id);
$methodology_3 = get_attribute_value('methodology_3', $current_page_id);
$methodology_4 = get_attribute_value('methodology_4', $current_page_id);
$methodology_5 = get_attribute_value('methodology_5', $current_page_id);

// Thought Leadership
$thought_leadership_title = get_attribute_value('thought_leadership_title', $current_page_id);
$leadership_point_1 = get_attribute_value('leadership_point_1', $current_page_id);
$leadership_point_2 = get_attribute_value('leadership_point_2', $current_page_id);
$leadership_point_3 = get_attribute_value('leadership_point_3', $current_page_id);
$leadership_point_4 = get_attribute_value('leadership_point_4', $current_page_id);
$leadership_point_5 = get_attribute_value('leadership_point_5', $current_page_id);

// Publications
$publications_title = get_attribute_value('publications_title', $current_page_id);
$publication_1 = get_attribute_value('publication_1', $current_page_id);
$publication_2 = get_attribute_value('publication_2', $current_page_id);
$publication_3 = get_attribute_value('publication_3', $current_page_id);
$publication_4 = get_attribute_value('publication_4', $current_page_id);
$publication_5 = get_attribute_value('publication_5', $current_page_id);

// Value Proposition Summary
$value_prop_summary_title = get_attribute_value('value_prop_summary_title', $current_page_id);
$value_prop_summary_text = get_attribute_value('value_prop_summary_text', $current_page_id);

?>

<section class="py-5 bg-light" id="unique-value">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title text-center mb-5"><?php echo htmlspecialchars($unique_value_title ?: 'Unique Value Proposition'); ?></h2>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper bg-primary bg-opacity-10 mx-auto mb-4">
                                    <i class="fas fa-tools text-primary fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-3"><?php echo htmlspecialchars($skills_title ?: 'Specialized Skills'); ?></h3>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><?php echo htmlspecialchars($skill_1 ?: 'AI/ML Product Strategy'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($skill_2 ?: 'Enterprise Architecture'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($skill_3 ?: 'Digital Transformation'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($skill_4 ?: 'Cross-Functional Leadership'); ?></li>
                                    <li><?php echo htmlspecialchars($skill_5 ?: 'Technical Due Diligence'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper bg-primary bg-opacity-10 mx-auto mb-4">
                                    <i class="fas fa-project-diagram text-primary fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-3"><?php echo htmlspecialchars($methodologies_title ?: 'Methodologies'); ?></h3>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><?php echo htmlspecialchars($methodology_1 ?: 'Human-Centered AI Framework'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($methodology_2 ?: 'Rapid Value Prototyping'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($methodology_3 ?: 'Growth Architecture'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($methodology_4 ?: 'Inclusive Design Sprints'); ?></li>
                                    <li><?php echo htmlspecialchars($methodology_5 ?: 'Ethical Tech Assessment'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper bg-primary bg-opacity-10 mx-auto mb-4">
                                    <i class="fas fa-bullhorn text-primary fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-3"><?php echo htmlspecialchars($thought_leadership_title ?: 'Thought Leadership'); ?></h3>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><?php echo htmlspecialchars($leadership_point_1 ?: 'Keynote Speaker (30+ events)'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($leadership_point_2 ?: 'Forbes Tech Council'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($leadership_point_3 ?: 'Advisor to 3 Startups'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($leadership_point_4 ?: 'Industry White Papers'); ?></li>
                                    <li><?php echo htmlspecialchars($leadership_point_5 ?: 'Mentor to Women in Tech'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper bg-primary bg-opacity-10 mx-auto mb-4">
                                    <i class="fas fa-file-alt text-primary fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-3"><?php echo htmlspecialchars($publications_title ?: 'Publications'); ?></h3>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><?php echo htmlspecialchars($publication_1 ?: '7 Patents in AI Applications'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($publication_2 ?: '"Ethical AI in Practice" (2022)'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($publication_3 ?: 'TechReview Contributor'); ?></li>
                                    <li class="mb-2"><?php echo htmlspecialchars($publication_4 ?: '3 Peer-Reviewed Papers'); ?></li>
                                    <li><?php echo htmlspecialchars($publication_5 ?: 'Monthly Industry Blog'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-5 border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center mb-4 mb-md-0">
                                <div class="icon-wrapper-lg bg-primary bg-opacity-10 mx-auto">
                                    <i class="fas fa-chess-queen text-primary fa-3x"></i>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h3 class="h4"><?php echo htmlspecialchars($value_prop_summary_title ?: 'What Sets Me Apart'); ?></h3>
                                <p class="mb-0"><?php echo htmlspecialchars($value_prop_summary_text ?: 'I combine rare technical depth with executive business perspective, having led projects from initial code to IPO. My value lies in bridging the gap between engineering teams and C-suite objectives, translating complex technologies into strategic advantages. Unlike pure technologists or general managers, I speak both languages fluently—a skill honed through 5 successful product launches and 3 company turnarounds. My published frameworks are used industry-wide because they address not just technical challenges, but human and organizational factors critical for adoption.'); ?></p>
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
<?php
// Fetch attribute values for the Personal Brand Elements section
$brand_elements_title = get_attribute_value('brand_elements_title', $current_page_id);

// Professional Philosophy
$philosophy_title = get_attribute_value('philosophy_title', $current_page_id);
$philosophy_subtitle = get_attribute_value('philosophy_subtitle', $current_page_id);
$philosophy_point_1 = get_attribute_value('philosophy_point_1', $current_page_id);
$philosophy_point_2 = get_attribute_value('philosophy_point_2', $current_page_id);
$philosophy_point_3 = get_attribute_value('philosophy_point_3', $current_page_id);
$philosophy_point_4 = get_attribute_value('philosophy_point_4', $current_page_id);

// Leadership Style
$leadership_title = get_attribute_value('leadership_title', $current_page_id);
$leadership_subtitle = get_attribute_value('leadership_subtitle', $current_page_id);
$leadership_trait_1 = get_attribute_value('leadership_trait_1', $current_page_id);
$leadership_trait_2 = get_attribute_value('leadership_trait_2', $current_page_id);
$leadership_trait_3 = get_attribute_value('leadership_trait_3', $current_page_id);
$leadership_trait_4 = get_attribute_value('leadership_trait_4', $current_page_id);

// Vision & Future
$vision_title = get_attribute_value('vision_title', $current_page_id);
$vision_subtitle = get_attribute_value('vision_subtitle', $current_page_id);
$vision_goal_title = get_attribute_value('vision_goal_title', $current_page_id);
$vision_goal_description = get_attribute_value('vision_goal_description', $current_page_id);
$vision_change_title = get_attribute_value('vision_change_title', $current_page_id);
$vision_change_description = get_attribute_value('vision_change_description', $current_page_id);
$vision_legacy_title = get_attribute_value('vision_legacy_title', $current_page_id);
$vision_legacy_description = get_attribute_value('vision_legacy_description', $current_page_id);

// Community Impact
$community_title = get_attribute_value('community_title', $current_page_id);
$community_subtitle = get_attribute_value('community_subtitle', $current_page_id);
$impact_item_1 = get_attribute_value('impact_item_1', $current_page_id);
$impact_item_2 = get_attribute_value('impact_item_2', $current_page_id);
$impact_item_3 = get_attribute_value('impact_item_3', $current_page_id);

?>

<section class="py-5" id="brand-elements">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title text-center mb-5"><?php echo ($brand_elements_title ?: 'Personal Brand Elements'); ?></h2>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex mb-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                        <i class="fas fa-atom text-primary fa-2x"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-0"><?php echo ($philosophy_title ?: 'Professional Philosophy'); ?></h3>
                                        <p class="text-muted mb-0"><?php echo ($philosophy_subtitle ?: 'My guiding principles'); ?></p>
                                    </div>
                                </div>
                                <ul class="list-unstyled ps-4">
                                    <li class="mb-2 position-relative ps-3">
                                        <i class="fas fa-circle text-primary small position-absolute" style="left: 0; top: 8px;"></i>
                                        <strong><?php echo (explode(':', $philosophy_point_1 ?: 'Human-Centered Technology: Tools should amplify human potential')[0]); ?>:</strong> <?php echo (explode(':', $philosophy_point_1 ?: 'Human-Centered Technology: Tools should amplify human potential')[1]); ?>
                                    </li>
                                    <li class="mb-2 position-relative ps-3">
                                        <i class="fas fa-circle text-primary small position-absolute" style="left: 0; top: 8px;"></i>
                                        <strong><?php echo (explode(':', $philosophy_point_2 ?: 'Ethical By Design: Build integrity into every system')[0]); ?>:</strong> <?php echo (explode(':', $philosophy_point_2 ?: 'Ethical By Design: Build integrity into every system')[1]); ?>
                                    </li>
                                    <li class="mb-2 position-relative ps-3">
                                        <i class="fas fa-circle text-primary small position-absolute" style="left: 0; top: 8px;"></i>
                                        <strong><?php echo (explode(':', $philosophy_point_3 ?: 'Growth Through Challenge: Comfort zones are innovation dead zones')[0]); ?>:</strong> <?php echo (explode(':', $philosophy_point_3 ?: 'Growth Through Challenge: Comfort zones are innovation dead zones')[1]); ?>
                                    </li>
                                    <li class="position-relative ps-3">
                                        <i class="fas fa-circle text-primary small position-absolute" style="left: 0; top: 8px;"></i>
                                        <strong><?php echo (explode(':', $philosophy_point_4 ?: 'Collaborative Excellence: The best solutions emerge from diverse minds')[0]); ?>:</strong> <?php echo (explode(':', $philosophy_point_4 ?: 'Collaborative Excellence: The best solutions emerge from diverse minds')[1]); ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex mb-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                        <i class="fas fa-chess-king text-primary fa-2x"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-0"><?php echo ($leadership_title ?: 'Leadership Style'); ?></h3>
                                        <p class="text-muted mb-0"><?php echo ($leadership_subtitle ?: 'How I build and guide teams'); ?></p>
                                    </div>
                                </div>
                                <div class="leadership-traits">
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-primary rounded-pill me-2">1</span>
                                        </div>
                                        <div>
                                            <strong><?php echo (explode(':', $leadership_trait_1 ?: 'Servant Leadership: Clear vision with hands-on support')[0]); ?>:</strong> <?php echo (explode(':', $leadership_trait_1 ?: 'Servant Leadership: Clear vision with hands-on support')[1]); ?>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-primary rounded-pill me-2">2</span>
                                        </div>
                                        <div>
                                            <strong><?php echo (explode(':', $leadership_trait_2 ?: 'Radical Transparency: Information sharing builds trust')[0]); ?>:</strong> <?php echo (explode(':', $leadership_trait_2 ?: 'Radical Transparency: Information sharing builds trust')[1]); ?>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-primary rounded-pill me-2">3</span>
                                        </div>
                                        <div>
                                            <strong><?php echo (explode(':', $leadership_trait_3 ?: 'Fail Forward Culture: Celebrate lessons from setbacks')[0]); ?>:</strong> <?php echo (explode(':', $leadership_trait_3 ?: 'Fail Forward Culture: Celebrate lessons from setbacks')[1]); ?>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-primary rounded-pill me-2">4</span>
                                        </div>
                                        <div>
                                            <strong><?php echo (explode(':', $leadership_trait_4 ?: 'Talent Multiplier: Grow team capabilities exponentially')[0]); ?>:</strong> <?php echo (explode(':', $leadership_trait_4 ?: 'Talent Multiplier: Grow team capabilities exponentially')[1]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex mb-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                        <i class="fas fa-binoculars text-primary fa-2x"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-0"><?php echo ($vision_title ?: 'Vision & Future'); ?></h3>
                                        <p class="text-muted mb-0"><?php echo ($vision_subtitle ?: 'Where I\'m headed'); ?></p>
                                    </div>
                                </div>
                                <div class="vision-item mb-3">
                                    <h4 class="h6 mb-1"><?php echo ($vision_goal_title ?: '5-Year Goal'); ?></h4>
                                    <p class="mb-0"><?php echo ($vision_goal_description ?: 'Establish an innovation lab bridging tech and social impact sectors'); ?></p>
                                </div>
                                <div class="vision-item mb-3">
                                    <h4 class="h6 mb-1"><?php echo ($vision_change_title ?: 'Industry Change'); ?></h4>
                                    <p class="mb-0"><?php echo ($vision_change_description ?: 'Make ethical AI assessment standard practice by 2027'); ?></p>
                                </div>
                                <div class="vision-item">
                                    <h4 class="h6 mb-1"><?php echo ($vision_legacy_title ?: 'Legacy'); ?></h4>
                                    <p class="mb-0"><?php echo ($vision_legacy_description ?: 'Mentor 100+ underrepresented technologists'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex mb-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                        <i class="fas fa-hands-helping text-primary fa-2x"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-0"><?php echo ($community_title ?: 'Community Impact'); ?></h3>
                                        <p class="text-muted mb-0"><?php echo ($community_subtitle ?: 'Beyond professional achievements'); ?></p>
                                    </div>
                                </div>
                                <div class="impact-item d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary me-2"></i>
                                    </div>
                                    <div>
                                        <?php echo ($impact_item_1 ?: '<strong>TechBridge Nonprofit:</strong> Board member since 2018'); ?>
                                    </div>
                                </div>
                                <div class="impact-item d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary me-2"></i>
                                    </div>
                                    <div>
                                        <?php echo ($impact_item_2 ?: '<strong>Coding for Seniors:</strong> Monthly workshop leader'); ?>
                                    </div>
                                </div>
                                <div class="impact-item d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary me-2"></i>
                                    </div>
                                    <div>
                                        <?php echo ($impact_item_3 ?: '<strong>STEM Scholarships:</strong> Funded 3 annual awards'); ?>
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

<!-- Media Assets Section -->
<section class="py-5 bg-light" id="media-assets">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title text-center mb-5">Media Assets</h2>
                
                <div class="row g-4">
                    <!-- Photos -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="h5 mb-3"><i class="fas fa-camera me-2 text-primary"></i> Photos</h3>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="https://placehold.co/800x1200">
                                            <img src="https://placehold.co/300x300" alt="Headshot" class="img-fluid rounded">
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="https://placehold.co/1200x800">
                                            <img src="https://placehold.co/300x300" alt="Speaking" class="img-fluid rounded">
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="https://placehold.co/800x800">
                                            <img src="https://placehold.co/300x300" alt="Team" class="img-fluid rounded">
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="https://placehold.co/1200x600">
                                            <img src="https://placehold.co/300x300" alt="Workshop" class="img-fluid rounded">
                                        </a>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-primary">Download All Headshots</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Videos -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="h5 mb-3"><i class="fas fa-video me-2 text-primary"></i> Videos</h3>
                                <div class="ratio ratio-16x9 mb-3">
                                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Sample Video" allowfullscreen></iframe>
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
                            </div>
                        </div>
                    </div>
                    
                    <!-- Portfolio & Speaking -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="h5 mb-3"><i class="fas fa-briefcase me-2 text-primary"></i> Portfolio</h3>
                                <div class="mb-4">
                                    <h4 class="h6 mb-2">Featured Case Studies:</h4>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-file-pdf text-danger me-2"></i>
                                            <a href="#" class="text-decoration-none">Enterprise AI Transformation</a>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-file-pdf text-danger me-2"></i>
                                            <a href="#" class="text-decoration-none">Global Payment System</a>
                                        </li>
                                        <li>
                                            <i class="fas fa-file-pdf text-danger me-2"></i>
                                            <a href="#" class="text-decoration-none">Nonprofit Tech Overhaul</a>
                                        </li>
                                    </ul>
                                </div>
                                
                                <h3 class="h5 mb-3"><i class="fas fa-microphone me-2 text-primary"></i> Speaking</h3>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                                        <strong>2023:</strong> "Future of Ethical AI" - TechGlobal Summit
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                                        <strong>2022:</strong> "Leading Through Disruption" - ExecForum
                                    </li>
                                    <li>
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                                        <strong>2021:</strong> "Human-Centered Design" - InnovateConf
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Publications & Social -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="h5 mb-3"><i class="fas fa-newspaper me-2 text-primary"></i> Publications</h3>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-book text-primary me-2"></i>
                                        <a href="#" class="text-decoration-none">"Ethical AI in Practice" - TechReview (2023)</a>
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-book text-primary me-2"></i>
                                        <a href="#" class="text-decoration-none">"Leading Digital Transformation" - Harvard Biz (2022)</a>
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-podcast text-primary me-2"></i>
                                        <a href="#" class="text-decoration-none">FutureTech Podcast - Episode 45</a>
                                    </li>
                                    <li>
                                        <i class="fas fa-tv text-primary me-2"></i>
                                        <a href="#" class="text-decoration-none">CNBC Tech Interview - May 2023</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="h5 mb-3"><i class="fas fa-hashtag me-2 text-primary"></i> Social Media</h3>
                                <div class="social-links">
                                    <a href="#" class="btn btn-outline-primary btn-sm mb-2 me-2">
                                        <i class="fab fa-linkedin-in me-1"></i> LinkedIn
                                    </a>
                                    <a href="#" class="btn btn-outline-info btn-sm mb-2 me-2">
                                        <i class="fab fa-twitter me-1"></i> Twitter
                                    </a>
                                    <a href="#" class="btn btn-outline-danger btn-sm mb-2 me-2">
                                        <i class="fab fa-youtube me-1"></i> YouTube
                                    </a>
                                    <a href="#" class="btn btn-outline-dark btn-sm mb-2">
                                        <i class="fab fa-github me-1"></i> GitHub
                                    </a>
                                </div>
                                <div class="mt-3">
                                    <h4 class="h6 mb-2">Professional Hashtags:</h4>
                                    <div class="d-flex flex-wrap">
                                        <span class="badge bg-light text-dark me-2 mb-2">#TechLeadership</span>
                                        <span class="badge bg-light text-dark me-2 mb-2">#EthicalAI</span>
                                        <span class="badge bg-light text-dark me-2 mb-2">#DigitalTransformation</span>
                                        <span class="badge bg-light text-dark mb-2">#InnovationCulture</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Image Modal -->
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
                    <a href="#" id="downloadImage" class="btn btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Client Impact Stories Section -->
<?php
// Fetch attribute values for the Client Impact Stories section
$client_stories_title = get_attribute_value('client_stories_title', $current_page_id);

// Fetch data for the first client story
$client_1_title = get_attribute_value('client_1_title', $current_page_id);
$client_1_logo_url = get_attribute_value('client_1_logo_url', $current_page_id);
$client_1_sector = get_attribute_value('client_1_sector', $current_page_id);
$client_1_duration = get_attribute_value('client_1_duration', $current_page_id);
$client_1_challenge = get_attribute_value('client_1_challenge', $current_page_id);
$client_1_solution = get_attribute_value('client_1_solution', $current_page_id);
$client_1_result_1 = get_attribute_value('client_1_result_1', $current_page_id);
$client_1_result_2 = get_attribute_value('client_1_result_2', $current_page_id);
$client_1_result_3 = get_attribute_value('client_1_result_3', $current_page_id);
$client_1_testimonial = get_attribute_value('client_1_testimonial', $current_page_id);
$client_1_testimonial_author = get_attribute_value('client_1_testimonial_author', $current_page_id);

// Fetch data for the second client story
$client_2_title = get_attribute_value('client_2_title', $current_page_id);
$client_2_logo_url = get_attribute_value('client_2_logo_url', $current_page_id);
$client_2_sector = get_attribute_value('client_2_sector', $current_page_id);
$client_2_duration = get_attribute_value('client_2_duration', $current_page_id);
$client_2_challenge = get_attribute_value('client_2_challenge', $current_page_id);
$client_2_solution = get_attribute_value('client_2_solution', $current_page_id);
$client_2_result_1 = get_attribute_value('client_2_result_1', $current_page_id);
$client_2_result_2 = get_attribute_value('client_2_result_2', $current_page_id);
$client_2_result_3 = get_attribute_value('client_2_result_3', $current_page_id);
$client_2_testimonial = get_attribute_value('client_2_testimonial', $current_page_id);
$client_2_testimonial_author = get_attribute_value('client_2_testimonial_author', $current_page_id);

// Fetch data for the third client story
$client_3_title = get_attribute_value('client_3_title', $current_page_id);
$client_3_logo_url = get_attribute_value('client_3_logo_url', $current_page_id);
$client_3_sector = get_attribute_value('client_3_sector', $current_page_id);
$client_3_duration = get_attribute_value('client_3_duration', $current_page_id);
$client_3_challenge = get_attribute_value('client_3_challenge', $current_page_id);
$client_3_solution = get_attribute_value('client_3_solution', $current_page_id);
$client_3_result_1 = get_attribute_value('client_3_result_1', $current_page_id);
$client_3_result_2 = get_attribute_value('client_3_result_2', $current_page_id);
$client_3_result_3 = get_attribute_value('client_3_result_3', $current_page_id);
$client_3_testimonial = get_attribute_value('client_3_testimonial', $current_page_id);
$client_3_testimonial_author = get_attribute_value('client_3_testimonial_author', $current_page_id);

?>

<section class="py-5" id="client-stories">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title text-center mb-5"><?php echo ($client_stories_title ?: 'Client Impact Stories'); ?></h2>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <h3 class="h4"><?php echo ($client_1_title ?: 'Enterprise AI Transformation'); ?></h3>
                                <div class="client-logo mb-3">
                                    <img src="<?php echo ($client_1_logo_url ?: 'https://placehold.co/150x50'); ?>" alt="Client Logo" class="img-fluid">
                                </div>
                                <div class="badge bg-primary mb-2"><?php echo ($client_1_sector ?: 'Manufacturing Sector'); ?></div>
                                <p class="mb-0"><strong>Duration:</strong> <?php echo ($client_1_duration ?: '18 months'); ?></p>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Challenge</h4>
                                        <p><?php echo ($client_1_challenge ?: '$1B manufacturer struggling with 30% defect rate and $12M annual quality costs'); ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-lightbulb text-primary me-2"></i> Solution</h4>
                                        <p><?php echo ($client_1_solution ?: 'Led development of custom AI quality control system integrated with production lines'); ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-chart-line text-success me-2"></i> Results</h4>
                                        <ul class="mb-0">
                                            <li><?php echo ($client_1_result_1 ?: '62% reduction in defects'); ?></li>
                                            <li><?php echo ($client_1_result_2 ?: '$8.7M first-year savings'); ?></li>
                                            <li><?php echo ($client_1_result_3 ?: 'ROI in 7 months'); ?></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-quote-left text-info me-2"></i> Testimonial</h4>
                                        <div class="bg-light p-3 rounded">
                                            <p class="fst-italic mb-0"><?php echo ($client_1_testimonial ?: '"The solution transformed our quality process and became a competitive advantage in our RFP responses."'); ?></p>
                                            <p class="mb-0 text-end"><strong>— <?php echo ($client_1_testimonial_author ?: 'COO, ManufacturingCo'); ?></strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <h3 class="h4"><?php echo ($client_2_title ?: 'Global Payment System'); ?></h3>
                                <div class="client-logo mb-3">
                                    <img src="<?php echo ($client_2_logo_url ?: 'https://placehold.co/150x50'); ?>" alt="Client Logo" class="img-fluid">
                                </div>
                                <div class="badge bg-primary mb-2"><?php echo ($client_2_sector ?: 'Financial Services'); ?></div>
                                <p class="mb-0"><strong>Duration:</strong> <?php echo ($client_2_duration ?: '2 years'); ?></p>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Challenge</h4>
                                        <p><?php echo ($client_2_challenge ?: 'Legacy system couldn\'t handle 300% transaction volume growth, causing outages'); ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-lightbulb text-primary me-2"></i> Solution</h4>
                                        <p><?php echo ($client_2_solution ?: 'Architected cloud-native payment platform with 99.999% availability SLA'); ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-chart-line text-success me-2"></i> Results</h4>
                                        <ul class="mb-0">
                                            <li><?php echo ($client_2_result_1 ?: 'Handles 15,000 TPS (up from 2,500)'); ?></li>
                                            <li><?php echo ($client_2_result_2 ?: 'Zero downtime in 18 months'); ?></li>
                                            <li><?php echo ($client_2_result_3 ?: 'Enabled expansion to 12 new markets'); ?></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-quote-left text-info me-2"></i> Testimonial</h4>
                                        <div class="bg-light p-3 rounded">
                                            <p class="fst-italic mb-0"><?php echo ($client_2_testimonial ?: '"The system became the backbone of our international growth strategy, delivering flawless performance."'); ?></p>
                                            <p class="mb-0 text-end"><strong>— <?php echo ($client_2_testimonial_author ?: 'CTO, FinTechGlobal'); ?></strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <h3 class="h4"><?php echo ($client_3_title ?: 'Nonprofit Tech Overhaul'); ?></h3>
                                <div class="client-logo mb-3">
                                    <img src="<?php echo ($client_3_logo_url ?: 'https://placehold.co/150x50'); ?>" alt="Client Logo" class="img-fluid">
                                </div>
                                <div class="badge bg-primary mb-2"><?php echo ($client_3_sector ?: 'Social Sector'); ?></div>
                                <p class="mb-0"><strong>Duration:</strong> <?php echo ($client_3_duration ?: '9 months'); ?></p>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Challenge</h4>
                                        <p><?php echo ($client_3_challenge ?: 'Manual processes limited service reach to only 15% of target population'); ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-lightbulb text-primary me-2"></i> Solution</h4>
                                        <p><?php echo ($client_3_solution ?: 'Pro bono development of mobile platform with automated eligibility screening'); ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-chart-line text-success me-2"></i> Results</h4>
                                        <ul class="mb-0">
                                            <li><?php echo ($client_3_result_1 ?: '400% increase in clients served'); ?></li>
                                            <li><?php echo ($client_3_result_2 ?: '80% reduction in processing time'); ?></li>
                                            <li><?php echo ($client_3_result_3 ?: '$2.3M additional funding secured'); ?></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="h5"><i class="fas fa-quote-left text-info me-2"></i> Testimonial</h4>
                                        <div class="bg-light p-3 rounded">
                                            <p class="fst-italic mb-0"><?php echo ($client_3_testimonial ?: '"This transformation allowed us to help thousands more families in need with the same resources."'); ?></p>
                                            <p class="mb-0 text-end"><strong>— <?php echo ($client_3_testimonial_author ?: 'Executive Director, CommunityFirst'); ?></strong></p>
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
                                        <img src="https://placehold.co/800x450" alt="Website screenshot" class="img-fluid rounded">
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
<?php

// Fetch attribute values
$associations_title = get_attribute_value('associations_title', $current_page_id);
$associations = get_multiple_attribute_values('association', 4, $current_page_id);

$collaborations_title = get_attribute_value('collaborations_title', $current_page_id);
$collaborations = get_multiple_attribute_values('collaboration', 4, $current_page_id);

$mentorship_leadership_title = get_attribute_value('mentorship_leadership_title', $current_page_id);
$mentorships = get_multiple_attribute_values('mentorship', 3, $current_page_id);

$media_influence_title = get_attribute_value('media_influence_title', $current_page_id);
$media_mentions = get_multiple_attribute_values('media_mention', 4, $current_page_id);


?>

<section class="py-5" id="network-influence">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="section-title text-center mb-5"><?php echo ($associations_title ?: 'Network & Influence'); ?></h2>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-users fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0"><?php echo ($associations_title ?: 'Professional Associations'); ?></h3>
                                </div>
                                <ul class="list-unstyled">
                                    <?php if (!empty($associations)): ?>
                                        <?php foreach ($associations as $association): ?>
                                            <?php if (!empty($association['name'])): ?>
                                                <li class="mb-3">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0">
                                                            <i class="fas fa-star text-warning me-3"></i>
                                                        </div>
                                                        <div>
                                                            <h4 class="h6 mb-1"><?php echo ($association['name']); ?></h4>
                                                            <p class="small text-muted mb-0"><?php echo ($association['details']); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li class="mb-3">No professional associations listed.</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-handshake fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0"><?php echo ($collaborations_title ?: 'Key Collaborations'); ?></h3>
                                </div>
                                <div class="row g-3">
                                    <?php if (!empty($collaborations)): ?>
                                        <?php foreach ($collaborations as $collaboration): ?>
                                            <?php if (!empty($collaboration['name'])): ?>
                                                <div class="col-6">
                                                    <div class="p-3 border rounded text-center h-100">
                                                        <img src="<?php echo ($collaboration['logo_url'] ?: 'https://placehold.co/80x40'); ?>" alt="Partner Logo" class="img-fluid mb-2">
                                                        <h4 class="h6 mb-1"><?php echo ($collaboration['name']); ?></h4>
                                                        <p class="small text-muted mb-0"><?php echo ($collaboration['details']); ?></p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="col-12">No key collaborations listed.</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-user-graduate fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0"><?php echo ($mentorship_leadership_title ?: 'Mentorship & Leadership'); ?></h3>
                                </div>
                                <div class="row g-3">
                                    <?php if (!empty($mentorships)): ?>
                                        <?php foreach ($mentorships as $mentorship): ?>
                                            <?php if (!empty($mentorship['name'])): ?>
                                                <div class="col-12">
                                                    <div class="p-3 border rounded">
                                                        <h4 class="h6 mb-2"><?php echo ($mentorship['name']); ?></h4>
                                                        <p class="small mb-2"><?php echo ($mentorship['details']); ?></p>
                                                        <?php if (!empty($mentorship['timeframe'])): ?>
                                                            <span class="badge bg-light text-dark"><?php echo ($mentorship['timeframe']); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="col-12">No mentorship or leadership roles listed.</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-bullhorn fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h5 mb-0"><?php echo ($media_influence_title ?: 'Media & Influence'); ?></h3>
                                </div>
                                <ul class="list-unstyled">
                                    <?php if (!empty($media_mentions)): ?>
                                        <?php foreach ($media_mentions as $mention): ?>
                                            <?php if (!empty($mention['name'])): ?>
                                                <li class="mb-3">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0">
                                                            <i class="fas fa-newspaper text-primary me-3"></i>
                                                        </div>
                                                        <div>
                                                            <h4 class="h6 mb-1"><?php echo ($mention['name']); ?></h4>
                                                            <p class="small text-muted mb-0"><?php echo ($mention['details']); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li class="mb-3">No media mentions listed.</li>
                                    <?php endif; ?>
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

    <script>
        // Set current year in footer
        document.getElementById('current-year').textContent = new Date().getFullYear();
        
        // You can add more dynamic functionality here as needed
    </script>

<?php 

// Function to safely get attribute values
function get_attribute_value($attribute_name, $current_page_id) {
    $sql = "SELECT pav.attribute_value
            FROM page_attribute_values pav
            JOIN page_attributes pa ON pav.attribute_id = pa.id
            WHERE pa.attribute_name = '" . escape($attribute_name) . "'
              AND pav.page_id = " . intval($current_page_id);
    return return_single_ans($sql);
}



// Function to safely get multiple attribute values as an associative array
function get_multiple_attribute_values($attribute_prefix, $count, $current_page_id) {
    $values = [];
    for ($i = 1; $i <= $count; $i++) {
        $name_key = $attribute_prefix . '_' . $i . '_name';
        $details_key = $attribute_prefix . '_' . $i . '_details';
        $logo_url_key = $attribute_prefix . '_' . $i . '_logo_url';
        $timeframe_key = $attribute_prefix . '_' . $i . '_timeframe'; // For mentorship

        $values[$i]['name'] = html_entity_decode( get_attribute_value($name_key, $current_page_id));
        $values[$i]['details'] = html_entity_decode(get_attribute_value($details_key, $current_page_id));
        if (isset($logo_url_key)) {
            $values[$i]['logo_url'] = html_entity_decode(get_attribute_value($logo_url_key, $current_page_id));
        }
        if (isset($timeframe_key)) {
            $values[$i]['timeframe'] = html_entity_decode(get_attribute_value($timeframe_key, $current_page_id));
        }
    }
    return $values;
}


function check_image_url($image_url){

   if (!filter_var($image_url, FILTER_VALIDATE_URL)) {
        return  BASE_URL . ABSOLUTE_IMAGEPATH . $image_url;
    }
    return $image_url;

}

?>