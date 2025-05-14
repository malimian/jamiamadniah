<?php 
 print_r($content['attributes']);
?>

<?php
if(!function_exists("header_t")) {
    function header_t(){
        return '
            <link href="css/templates/template_person_spotlight2.css" rel="stylesheet">';
    }
}
?>

<?php
if(!function_exists("footer_t")) {
    function footer_t(){
        return '
        ';
    }
}
?>

<?php
if(!function_exists("script_t")) {
    function script_t(){
        return '
        ';
    }
}
?>
<!-- Section 1: Hero Banner with Carousel -->
<section id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
       <?php
            $items = $content['attributes']['15']['sections']['carousel section'];

            $captions = [];
            $images = [];
            $leads = [];

            // Separate items into arrays based on attribute_name
            foreach ($items as $item) {
                switch ($item['attribute_name']) {
                    case 'carousel-caption':
                        $captions[] = $item['attribute_value'];
                        break;
                    case 'carousel-image':
                        $images[] = $item['attribute_value'];
                        break;
                    case 'carousel-lead':
                        $leads[] = $item['attribute_value'];
                        break;
                }
            }

            // Map by index
            $carouselCount = min(count($captions), count($images), count($leads)); // prevent index out of bounds
            for ($i = 0; $i < $carouselCount; $i++) {
                ?>
                <div class="carousel-item<?= $i === 0 ? ' active' : '' ?>">
                    <img src="<?= htmlspecialchars($images[$i]) ?>" class="d-block w-100" alt="Banner <?= $i + 1 ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="display-3 fw-bold"><?= htmlspecialchars($captions[$i]) ?></h1>
                        <p class="lead"><?= htmlspecialchars($leads[$i]) ?></p>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</section>

    <div class="container mb-5">

<!-- Section 2: Profile Snapshot -->
<?php
$profile_section = $content['attributes']['16']['sections']['profile section'];

// Extract values safely
$image = $profile_section[0]['attribute_value'] ?? '';
$name = $profile_section[1]['attribute_value'] ?? '';
$titles = explode(',', $profile_section[2]['default_value'] ?? '');
$location = $profile_section[3]['attribute_value'] ?? '';
$email = $profile_section[4]['attribute_value'] ?? '';
$phone = $profile_section[5]['attribute_value'] ?? '';

$social_media = $content['attributes']['26']['sections']['SocialMedia'];

print_r($social_media);
?>

<section class="container my-5">
    <div class="row align-items-center">
        <!-- Left Column - Profile Image -->
        <div class="col-md-4 text-center mb-4 mb-md-0">
            <img src="<?= ABSOLUTE_IMAGEPATH.htmlspecialchars($image) ?>" 
                 alt="Profile Image of <?= htmlspecialchars($name) ?>" 
                 class="img-fluid rounded-circle shadow"
                 style="width: 300px; height: 300px; object-fit: cover;">
        </div>
        
        <!-- Right Column - Profile Details -->
        <div class="col-md-8">
            <div class="profile-card p-4 shadow-sm rounded-4">
                <h2 class="mb-4 text-gradient">Profile Snapshot</h2>
                
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-4">
                            <div class="me-3 text-primary">
                                <i class="bi bi-person-badge fs-3"></i>
                            </div>
                            <div>
                                <h3 class="h5 mb-1">Name & Titles</h3>
                                <p class="mb-0 fw-bold fs-5"><?= htmlspecialchars($name) ?></p>
                                <?php foreach ($titles as $i => $title): ?>
                                    <?php
                                        $badgeClasses = ['primary', 'success', 'info', 'warning', 'danger'];
                                        $class = $badgeClasses[$i % count($badgeClasses)];
                                    ?>
                                    <span class="badge bg-<?= $class ?> bg-opacity-10 text-<?= $class ?> mt-1"><?= htmlspecialchars(trim($title)) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start">
                            <div class="me-3 text-primary">
                                <i class="bi bi-geo-alt fs-3"></i>
                            </div>
                            <div>
                                <h3 class="h5 mb-1">Location</h3>
                                <p class="mb-0">
                                    <span class="d-block"><?= htmlspecialchars($location) ?></span>
                                    <small class="text-muted">Based in <?= htmlspecialchars(explode(',', $location)[0]) ?></small>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-4">
                            <div class="me-3 text-primary">
                                <i class="bi bi-envelope-at fs-3"></i>
                            </div>
                            <div>
                                <h3 class="h5 mb-1">Contact</h3>
                                <p class="mb-1">
                                    <a href="mailto:<?= htmlspecialchars($email) ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($email) ?>
                                    </a>
                                </p>
                                <p class="mb-0">
                                    <a href="tel:<?= preg_replace('/[^+\d]/', '', $phone) ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($phone) ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <a href="#contact" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">
                                <i class="bi bi-calendar-check me-2"></i> Book a Spotlight Session
                            </a>
                            <div class="d-flex justify-content-center mt-2">
                                <small class="text-muted">
                                    <i class="bi bi-clock-history me-1"></i> Typically replies within 24 hours
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Social Links -->
                <div class="mt-4 pt-3 border-top">
                    <h4 class="h6 text-uppercase text-muted mb-3">Connect With Me</h4>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-outline-primary p-2"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="btn btn-outline-primary p-2"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="btn btn-outline-primary p-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-outline-primary p-2"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        <div class="section-divider"></div>

       <!-- Section 3: Personal Background -->
<section class="mb-5 py-4">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-gradient mb-3">Personal Journey</h2>
            <div class="section-divider mx-auto"></div>
            <p class="lead text-muted">A life dedicated to faith, community, and service</p>
        </div>

        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-4 h-100 hover-effect">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                                <i class="bi bi-person-vcard fs-3"></i>
                            </div>
                            <div>
                                <h3 class="h4 mb-2">Professional Identity</h3>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&h=100&fit=facearea&facepad=3" 
                                             class="rounded-circle shadow-sm" 
                                             width="60" 
                                             alt="Jacob Oroks">
                                    </div>
                                    <div>
                                        <h4 class="h5 mb-0">Jacob Etim Oroks</h4>
                                        <small class="text-muted">Full Professional Name</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle Column -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-4 h-100 hover-effect">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                                <i class="bi bi-journal-bookmark fs-3"></i>
                            </div>
                            <div>
                                <h3 class="h4 mb-2">Faith & Ministry</h3>
                                <p class="mb-0">Ordained Pastor with over 15 years of spiritual leadership, guiding congregations through transformative teachings that blend faith with practical living.</p>
                                <div class="mt-3">
                                    <span class="badge bg-success bg-opacity-10 text-success me-2">Spiritual Guidance</span>
                                    <span class="badge bg-success bg-opacity-10 text-success me-2">Transformative Teachings</span>
                                    <span class="badge bg-success bg-opacity-10 text-success">Practical Christianity</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Full Width Bottom Card -->
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4 hover-effect bg-light">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="icon-box bg-info bg-opacity-10 text-info me-3">
                                <i class="bi bi-people fs-3"></i>
                            </div>
                            <div>
                                <h3 class="h4 mb-2">Community Leadership</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-3">Champion for diaspora engagement and cultural preservation, serving as a bridge between the Efik community in the U.S. and their homeland.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-info me-2"></i> Cultural preservation advocate</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-info me-2"></i> Diaspora community leader</li>
                                            <li><i class="bi bi-check-circle-fill text-info me-2"></i> Cross-cultural bridge builder</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="#community-work" class="btn btn-outline-info rounded-pill">
                                        <i class="bi bi-arrow-right-circle me-2"></i> View Community Projects
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


        <div class="section-divider"></div>

       <!-- Section 4: Education & Certifications -->
       <!-- Section 4: Education & Certifications -->
<section class="py-6 mb-6 bg-light position-relative overflow-hidden">
    <!-- Animated background elements -->
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <div class="position-absolute top-0 end-0 bg-primary bg-opacity-5 rounded-circle" style="width: 300px; height: 300px; transform: translate(50%, -50%);"></div>
        <div class="position-absolute bottom-0 start-0 bg-success bg-opacity-5 rounded-circle" style="width: 400px; height: 400px; transform: translate(-50%, 50%);"></div>
    </div>

    <div class="container position-relative">
        <!-- Section Header -->
        <div class="text-center mb-6" data-aos="fade-up">
            <span class="badge bg-primary bg-opacity-10 text-primary mb-3 rounded-pill px-3 py-2">
                <i class="bi bi-mortarboard me-2"></i> Academic Journey
            </span>
            <h2 class="display-4 fw-bold mb-3 text-gradient">Education & Certifications</h2>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                Building expertise through formal education and continuous professional development
            </p>
        </div>

        <div class="row g-4">
            <!-- Education Timeline -->
            <div class="col-lg-5" data-aos="fade-right">
                <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-4 border-0">
                        <h3 class="h4 mb-0 d-flex align-items-center">
                            <span class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                                <i class="bi bi-mortarboard fs-2"></i>
                            </span>
                            <span>Academic Background</span>
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="timeline-steps">
                            <div class="timeline-step">
                                <div class="timeline-content" data-aos="fade-up" data-aos-delay="100">
                                    <div class="inner-circle bg-primary text-white">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <h4 class="h5 mb-1">Bachelor of Science</h4>
                                    <p class="mb-1 text-primary fw-bold">Computer Science</p>
                                    <p class="small text-muted mb-2">University of Maryland Global Campus</p>
                                    <div class="d-flex gap-2">
                                        <span class="badge bg-primary bg-opacity-10 text-primary">2015-2019</span>
                                        <span class="badge bg-success bg-opacity-10 text-success">Summa Cum Laude</span>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-content" data-aos="fade-up" data-aos-delay="200">
                                    <div class="inner-circle bg-success text-white">
                                        <i class="bi bi-award"></i>
                                    </div>
                                    <h4 class="h5 mb-1">Academic Honors</h4>
                                    <ul class="list-unstyled small">
                                        <li class="mb-1"><i class="bi bi-check-circle-fill text-success me-2"></i> National Dean's List</li>
                                        <li class="mb-1"><i class="bi bi-check-circle-fill text-success me-2"></i> Google Developer Scholarship</li>
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> President's Honor Roll</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Certifications Showcase -->
            <div class="col-lg-7" data-aos="fade-left">
                <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-4 border-0">
                        <h3 class="h4 mb-0 d-flex align-items-center">
                            <span class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3">
                                <i class="bi bi-award fs-2"></i>
                            </span>
                            <span>Professional Certifications</span>
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- CSM -->
                            <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
                                <div class="certification-card bg-white rounded-3 p-4 h-100 shadow-sm border-start border-4 border-primary">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://badgecert.com/bc/html/img/badges/generated/badge-7227.png" 
                                             alt="CSM" 
                                             class="img-fluid rounded-3 me-3" 
                                             width="60">
                                        <div>
                                            <h4 class="h6 mb-0">Certified Scrum Master</h4>
                                            <small class="text-muted">Scrum Alliance</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary bg-opacity-10 text-primary">2020</span>
                                        <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Verify</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- PMP -->
                            <div class="col-md-6" data-aos="zoom-in" data-aos-delay="200">
                                <div class="certification-card bg-white rounded-3 p-4 h-100 shadow-sm border-start border-4 border-success">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://www.ltcillinois.org/wp-content/uploads/2022/09/Untitled-design-13.png" 
                                             alt="PMP" 
                                             class="img-fluid rounded-3 me-3" 
                                             width="60">
                                        <div>
                                            <h4 class="h6 mb-0">Project Management Professional</h4>
                                            <small class="text-muted">PMI</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-success bg-opacity-10 text-success">2019</span>
                                        <a href="#" class="btn btn-sm btn-outline-success rounded-pill">Verify</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- AWS -->
                            <div class="col-md-6" data-aos="zoom-in" data-aos-delay="300">
                                <div class="certification-card bg-white rounded-3 p-4 h-100 shadow-sm border-start border-4 border-warning">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/93/Amazon_Web_Services_Logo.svg" 
                                             alt="AWS" 
                                             class="img-fluid rounded-3 me-3" 
                                             width="60">
                                        <div>
                                            <h4 class="h6 mb-0">AWS Solutions Architect</h4>
                                            <small class="text-muted">Amazon Web Services</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-warning bg-opacity-10 text-warning">2021</span>
                                        <a href="#" class="btn btn-sm btn-outline-warning rounded-pill">Verify</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- More Certifications -->
                            <div class="col-md-6" data-aos="zoom-in" data-aos-delay="400">
                                <div class="certification-card bg-white rounded-3 p-4 h-100 shadow-sm border-start border-4 border-info">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-info bg-opacity-10 text-info p-3 rounded-3 me-3">
                                            <i class="bi bi-patch-check fs-4"></i>
                                        </div>
                                        <div>
                                            <h4 class="h6 mb-0">Additional Certifications</h4>
                                            <small class="text-muted">Ongoing Learning</small>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled small mb-0">
                                        <li class="mb-1"><i class="bi bi-check-circle-fill text-info me-2"></i> Google Cloud Certified</li>
                                        <li class="mb-1"><i class="bi bi-check-circle-fill text-info me-2"></i> Microsoft Certified</li>
                                        <li><i class="bi bi-check-circle-fill text-info me-2"></i> ITIL Foundation</li>
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

<style>
    /* Custom Styles */
    .text-gradient {
        background: linear-gradient(90deg, #0d6efd, #6610f2);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .timeline-steps {
        position: relative;
        padding-left: 2rem;
    }
    
    .timeline-step:not(:last-child) {
        padding-bottom: 2rem;
    }
    
    .timeline-step::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(to bottom, #0d6efd, #6610f2);
    }
    
    .inner-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        left: -25px;
        top: 0;
        font-size: 1.25rem;
    }
    
    .timeline-content {
        padding-left: 2.5rem;
        position: relative;
    }
    
    .certification-card {
        transition: all 0.3s ease;
    }
    
    .certification-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .py-6 {
        padding-top: 5rem !important;
        padding-bottom: 5rem !important;
    }
    
    .mb-6 {
        margin-bottom: 5rem !important;
    }
</style>

<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });
</script>

<style>
    /* Custom Styles */
    .text-gradient {
        background: linear-gradient(90deg, #0d6efd, #6610f2);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .section-divider {
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #0d6efd, #6610f2);
        margin: 1rem auto;
        border-radius: 2px;
    }
    
    .icon-box {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .timeline-item {
        position: relative;
        padding-left: 1.5rem;
    }
    
    .timeline-badge {
        position: absolute;
        left: -12px;
        top: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .certification-badge {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem;
        background: rgba(255,255,255,0.7);
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .certification-badge:hover {
        background: white;
        transform: scale(1.02);
    }
    
    .honor-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem;
        background: rgba(255,255,255,0.7);
        border-radius: 0.5rem;
    }
    
    .honor-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
</style>

        <div class="section-divider"></div>

        <!-- Section 5: Faith Led Leadership -->
        <section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <h2 class="display-5 fw-bold text-primary mb-3">Faith-Inspired Leadership</h2>
                <p class="lead text-muted">Guiding with conviction and serving with compassion, integrating spiritual values into professional endeavors.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-lightbulb fa-3x text-warning"></i>
                        </div>
                        <h3 class="h5 fw-semibold text-secondary mb-2">Professional Philosophy</h3>
                        <p class="text-muted">"Technology should serve humanity, not replace it. My work at the intersection of faith and innovation seeks to create solutions that uplift communities while honoring our spiritual values."</p>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-minus fa-3x text-info"></i>
                        </div>
                        <h3 class="h5 fw-semibold text-secondary mb-2">Pastoral Ministry</h3>
                        <p class="text-muted">Founding pastor of Iboto Empire Ministries, providing spiritual guidance to a growing congregation with a focus on practical Christianity in the digital age.</p>
                    </div>
                </div>
            </div> 
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-hands-helping fa-3x text-success"></i>
                        </div>
                        <h3 class="h5 fw-semibold text-secondary mb-2">Servant Leadership</h3>
                        <p class="text-muted">Committed to leadership that prioritizes the growth and well-being of team members and communities, demonstrated through mentorship programs and community initiatives.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        <div class="section-divider"></div>

        <!-- Section 6: Cultural Stewardship -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8 text-center">
                        <h2 class="display-5 fw-bold text-primary mb-3">Cultural Stewardship</h2>
                        <p class="lead text-muted">Celebrating and preserving heritage through community engagement and education.</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card shadow-sm h-100 border-0">
                            <div class="card-body p-4">
                                <div class="mb-3 text-center">
                                    <i class="fas fa-users fa-3x text-info"></i>
                                </div>
                                <h3 class="h5 fw-semibold text-secondary mb-2">Community Impact</h3>
                                <ul class="list-unstyled text-muted">
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Founded the Efik Cultural Preservation Initiative, reaching over 5,000 diaspora members</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Organized annual cultural festivals that celebrate Efik heritage in the U.S.</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Established scholarship programs for Efik youth pursuing higher education</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow-sm h-100 border-0">
                            <div class="card-body p-4">
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/example" title="Jacob Oroks Cultural Stewardship" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="section-divider"></div>

        <!-- Section 7: Professional Journey & Achievements -->
        <section class="mb-5">
            <h2 class="mb-4">Professional Journey & Achievements</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <h3>2020-Present</h3>
                    <h4>CEO, Iboto Empire USA</h4>
                    <p>Leading a technology consulting firm that delivers innovative solutions to faith-based organizations and non-profits.</p>
                </div>
                <div class="timeline-item">
                    <h3>2018-2020</h3>
                    <h4>Senior Solutions Architect, TechFaith Inc.</h4>
                    <p>Designed and implemented cloud solutions for Fortune 500 companies while maintaining ethical technology practices.</p>
                </div>
                <div class="timeline-item">
                    <h3>2015-2018</h3>
                    <h4>Founder, FaithTech Collective</h4>
                    <p>Created a platform connecting technologists and faith leaders to collaborate on projects with social impact.</p>
                </div>
            </div>
        </section>

        <div class="section-divider"></div>


<!-- Section 8: Unique Value Proposition & Leadership Philosophy -->
<section class="py-5 value-proposition" id="contact">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="display-4 mb-3">My Unique Value Proposition</h2>
            <div class="divider mx-auto"></div>
            <p class="lead">Bridging technology and faith to create meaningful impact</p>
        </div>

        <div class="row g-4">
            <!-- Leadership Philosophy Card -->
            <div class="col-lg-6">
                <div class="philosophy-card card h-100 border-0 shadow-lg hover-effect">
                    <div class="card-body p-4 p-lg-5">
                        <div class="icon-box mb-4">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="h2 mb-4">Leadership Philosophy</h3>
                        <blockquote class="blockquote mb-4">
                            <p class="font-italic">"True leadership emerges at the intersection of competence and character. My approach combines technical expertise with spiritual wisdom, creating organizations that excel while maintaining their soul."</p>
                        </blockquote>
                        
                        <h4 class="h5 mb-3 text-primary">Core Principles:</h4>
                        <ul class="value-list">
                            <li class="d-flex align-items-start mb-3">
                                <span class="badge bg-primary me-3">1</span>
                                <span>Ethical innovation that serves human dignity</span>
                            </li>
                            <li class="d-flex align-items-start mb-3">
                                <span class="badge bg-primary me-3">2</span>
                                <span>Cultural preservation through technological advancement</span>
                            </li>
                            <li class="d-flex align-items-start">
                                <span class="badge bg-primary me-3">3</span>
                                <span>Faith as the foundation for sustainable success</span>
                            </li>
                        </ul>
                        
                        <div class="signature mt-4">
                            <img src="https://via.placeholder.com/150x50" alt="Jacob's Signature" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form Card -->
            <div class="col-lg-6">
                <div class="contact-card card h-100 border-0 shadow-lg">
                    <div class="card-body p-4 p-lg-5">
                        <div class="icon-box mb-4">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <h3 class="h2 mb-4">Connect With Jacob</h3>
                        <p class="mb-4">Ready to discuss how we can collaborate? Schedule a Spotlight Session below.</p>
                        
                        <form class="needs-validation" novalidate>
                            <div class="mb-4">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control form-control-lg" id="name" placeholder="John Doe" required>
                                <div class="invalid-feedback">
                                    Please provide your name.
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control form-control-lg" id="email" placeholder="john@example.com" required>
                                <div class="invalid-feedback">
                                    Please provide a valid email.
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label">Your Message</label>
                                <textarea class="form-control form-control-lg" id="message" rows="4" placeholder="Tell me about your project..." required></textarea>
                                <div class="invalid-feedback">
                                    Please include a message.
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-calendar-check me-2"></i> Request Spotlight Session
                                </button>
                            </div>
                        </form>
                        
                        <div class="contact-info mt-4 pt-3 border-top">
                            <h5 class="h6 mb-3">Alternative Contact Methods:</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <a href="mailto:jacob@ibotoempire.com" class="text-decoration-none">
                                        <i class="fas fa-envelope me-2 text-primary"></i> jacob@ibotoempire.com
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="tel:+1234567890" class="text-decoration-none">
                                        <i class="fas fa-phone me-2 text-primary"></i> (123) 456-7890
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-decoration-none">
                                        <i class="fas fa-video me-2 text-primary"></i> Schedule Video Call
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.value-proposition {
    background-color: #f8f9fa;
}

.section-header h2 {
    font-weight: 700;
    color: #2c3e50;
}

.divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #3498db, #9b59b6);
    margin-bottom: 1.5rem;
}

.philosophy-card, .contact-card {
    transition: transform 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
}

.hover-effect:hover {
    transform: translateY(-5px);
}

.icon-box {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #3498db, #9b59b6);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
}

.value-list {
    list-style: none;
    padding-left: 0;
}

.value-list li .badge {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: normal;
    padding: 0;
}

.signature {
    max-width: 150px;
    opacity: 0.8;
}

.contact-info a {
    color: #495057;
    transition: color 0.2s;
}

.contact-info a:hover {
    color: #3498db;
}

.form-control-lg {
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    border: 1px solid #dee2e6;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
}

@media (max-width: 992px) {
    .philosophy-card, .contact-card {
        margin-bottom: 2rem;
    }
}
</style>

<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Animate cards on scroll
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.philosophy-card, .contact-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    cards.forEach((card, index) => {
        card.style.opacity = 0;
        card.style.transform = 'translateY(20px)';
        card.style.transition = `all 0.5s ease ${index * 0.1}s`;
        observer.observe(card);
    });
});
</script>

    </div>


 <!-- Section 8: Expertise & Unique Value Proposition -->
    <section id="expertise" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Expertise & Unique Value Proposition</h2>
            
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card value-card shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="fas fa-chart-line fa-3x text-primary"></i>
                            </div>
                            <h3 class="h4 text-center">Data Driven Decision Making</h3>
                            <p class="text-muted">Leveraging advanced analytics and business intelligence to drive strategic organizational decisions with measurable outcomes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card value-card shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="fas fa-handshake fa-3x text-primary"></i>
                            </div>
                            <h3 class="h4 text-center">M&A Integration</h3>
                            <p class="text-muted">Expertise in merging organizations with minimal disruption while maximizing synergies and cultural alignment.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card value-card shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="fas fa-tasks fa-3x text-primary"></i>
                            </div>
                            <h3 class="h4 text-center">Agile Product Delivery</h3>
                            <p class="text-muted">Implementing lean methodologies to accelerate product development cycles while maintaining quality standards.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <h3 class="h4 mb-3">Distinct Methodologies</h3>
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h4 class="h5">The Oroks Transformation Framework</h4>
                            <p>A proprietary 5-phase approach to organizational transformation that balances technological innovation with cultural preservation.</p>
                            <ol>
                                <li>Diagnostic Assessment</li>
                                <li>Vision Alignment</li>
                                <li>Capability Building</li>
                                <li>Pilot Implementation</li>
                                <li>Scale & Institutionalize</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 class="h4 mb-3">Thought Leadership</h3>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="h5">Speaking Topics</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-microphone text-primary me-2"></i> "Faith-Based Leadership in the Digital Age"</li>
                                <li class="mb-2"><i class="fas fa-microphone text-primary me-2"></i> "Bridging Cultural Heritage with Technological Innovation"</li>
                                <li class="mb-2"><i class="fas fa-microphone text-primary me-2"></i> "The Triple Bottom Line: Profit, People & Purpose"</li>
                                <li class="mb-2"><i class="fas fa-microphone text-primary me-2"></i> "Diaspora Engagement Strategies for Community Development"</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 9: Impact Stories & Case Studies -->
    <section id="impact" class="py-5">
        <div class="container">
            <h2 class="section-title">Impact Stories & Case Studies</h2>
            
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h4">Case Study - Efik Cultural Preservation Initiative</h3>
                            <h4 class="h5 text-muted mt-3">Challenge</h4>
                            <p>Declining engagement among younger generations with Efik cultural traditions and language in the diaspora community.</p>
                            
                            <h4 class="h5 text-muted mt-3">Approach</h4>
                            <p>Developed a hybrid digital-physical engagement platform combining mobile apps for language learning with community events that modernized traditional practices.</p>
                            
                            <h4 class="h5 text-muted mt-3">Results</h4>
                            <ul>
                                <li>+300% increase in youth participation in cultural events</li>
                                <li>15,000+ downloads of language learning app in first year</li>
                                <li>Formation of 12 new community chapters across the US</li>
                            </ul>
                            
                            <div class="testimonial-card bg-light p-3 mt-3">
                                <p class="fst-italic mb-2">"Jacob's innovative approach saved our cultural heritage from being lost to assimilation. He made our traditions accessible and relevant to our digital-native youth."</p>
                                <p class="fw-bold mb-0">— Chief Edet Okon, President, Efik Diaspora Council</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h4">Case Study - Faith-Based Tech Startup Accelerator</h3>
                            <h4 class="h5 text-muted mt-3">Challenge</h4>
                            <p>Lack of funding and mentorship for Christian entrepreneurs building technology solutions for ministry applications.</p>
                            
                            <h4 class="h5 text-muted mt-3">Approach</h4>
                            <p>Created a 12-week accelerator program pairing Silicon Valley methodologies with biblical business principles, including:</p>
                            <ul>
                                <li>Faith-integrated lean startup curriculum</li>
                                <li>Network of impact investors</li>
                                <li>Ministry-market fit validation framework</li>
                            </ul>
                            
                            <h4 class="h5 text-muted mt-3">Results</h4>
                            <ul>
                                <li>42 startups graduated in 3 cohorts</li>
                                <li>$5.2M in total funding raised by participants</li>
                                <li>85% of ventures still operational after 3 years (vs. industry avg. of 40%)</li>
                            </ul>
                            
                            <div class="testimonial-card bg-light p-3 mt-3">
                                <p class="fst-italic mb-2">"The accelerator gave us both the spiritual foundation and practical tools to build a sustainable business. Jacob's mentorship was transformative."</p>
                                <p class="fw-bold mb-0">— Sarah Johnson, Founder, FaithfulMetrics</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 10: Thought Leadership & Publications -->
    <section id="thought-leadership" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Thought Leadership & Publications</h2>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h4 mb-3"><i class="fas fa-newspaper text-primary me-2"></i> Articles & Whitepapers</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2">"Digital Discipleship: Leveraging Technology for Spiritual Growth", <em>FaithTech Journal</em>, 2022</li>
                                <li class="mb-2">"The Diaspora Dividend: Measuring the Economic Impact of Cultural Communities", <em>Harvard Business Review</em>, 2021</li>
                                <li class="mb-2">"When Silicon Valley Meets Solomon: Ancient Wisdom for Modern Entrepreneurs", <em>Forbes</em>, 2020</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h4 mb-3"><i class="fas fa-book text-primary me-2"></i> Books & E-Books</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>The Bilingual Leader</strong>: Navigating Between Sacred and Secular Leadership, Iboto Press, 2023</li>
                                <li class="mb-2"><strong>Code & Covenant</strong>: Building Technology With Kingdom Values, FaithTech Publishing, 2021</li>
                                <li class="mb-2"><strong>Diaspora 2.0</strong>: A Blueprint for Cultural Preservation in the Digital Age (e-book), 2020</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h4 mb-3"><i class="fas fa-video text-primary me-2"></i> Conference Talks & Webinars</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2">"Faith in the Algorithm" - TEDxSanFrancisco, 2022 <a href="#" class="text-decoration-none">[Watch]</a></li>
                                <li class="mb-2">"Building Bridges: Technology for Cultural Preservation" - UNESCO Digital Heritage Summit, 2021 <a href="#" class="text-decoration-none">[Watch]</a></li>
                                <li class="mb-2">"The Pastor-CEO: Leading at the Intersection of Faith and Business" - Global Leadership Network, 2020 <a href="#" class="text-decoration-none">[Watch]</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 11: Media Assets & Downloads -->
    <section id="media" class="py-5">
        <div class="container">
            <h2 class="section-title">Media Assets & Downloads</h2>
            
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <h3 class="h4 mb-3">Photo Gallery</h3>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="media-thumbnail">
                                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Team workshop" class="img-fluid">
                                <div class="overlay">Team Workshop</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="media-thumbnail">
                                <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Speaking engagement" class="img-fluid">
                                <div class="overlay">Keynote Speech</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="media-thumbnail">
                                <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Community event" class="img-fluid">
                                <div class="overlay">Community Event</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="media-thumbnail">
                                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Strategy session" class="img-fluid">
                                <div class="overlay">Strategy Session</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <h3 class="h4 mb-3">Video Clips</h3>
                    <div class="ratio ratio-16x9 mb-3">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Sample video" allowfullscreen></iframe>
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            TEDx Talk: Faith in the Algorithm
                            <span class="badge bg-primary rounded-pill">12:34</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            CNBC Interview: Faith-Based Entrepreneurship
                            <span class="badge bg-primary rounded-pill">8:45</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Leadership Webinar: The Pastor-CEO
                            <span class="badge bg-primary rounded-pill">45:21</span>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <h3 class="h4 mb-3">Downloads</h3>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                                <div>
                                    <h4 class="h6 mb-0">Cultural Preservation Framework</h4>
                                    <small class="text-muted">PDF • 2.4 MB</small>
                                </div>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary w-100">Download</a>
                        </div>
                    </div>
                    
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-file-powerpoint fa-2x text-warning me-3"></i>
                                <div>
                                    <h4 class="h6 mb-0">Faith-Tech Integration Deck</h4>
                                    <small class="text-muted">PPTX • 5.1 MB</small>
                                </div>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary w-100">Download</a>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-file-alt fa-2x text-info me-3"></i>
                                <div>
                                    <h4 class="h6 mb-0">Diaspora Engagement Playbook</h4>
                                    <small class="text-muted">DOCX • 1.8 MB</small>
                                </div>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary w-100">Download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 12: Digital Presence & Call to Action -->
    <section id="contact" class="py-5 bg-dark text-white">
        <div class="container">
            <h2 class="section-title text-white">Digital Presence & Call to Action</h2>
            
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h3 class="h4 mb-4">Connect With Jacob</h3>
                    
                    <div class="mb-4">
                        <h4 class="h5">Website & Blog</h4>
                        <a href="https://www.jacoboroks.com" class="text-white text-decoration-none">www.jacoboroks.com</a>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="h5">Social Media</h4>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white fs-3"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-white fs-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white fs-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white fs-3"><i class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="h5">Professional Associations</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Member, Forbes Technology Council</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Advisor, FaithTech Collective</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Board Member, Efik Diaspora Council</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Fellow, Royal Society of Arts</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <h3 class="h4 mb-4">Let's Collaborate</h3>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <h4 class="h5"><i class="fas fa-lightbulb me-2"></i> Entrepreneurs/Consultants</h4>
                                    <p>Schedule a Strategy Session to explore synergies and growth opportunities.</p>
                                    <a href="#" class="btn btn-light btn-sm">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-secondary text-white h-100">
                                <div class="card-body">
                                    <h4 class="h5"><i class="fas fa-chart-pie me-2"></i> Finance Leaders</h4>
                                    <p>Request a Financial Review to optimize your organization's stewardship.</p>
                                    <a href="#" class="btn btn-light btn-sm">Request Review</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body">
                                    <h4 class="h5"><i class="fas fa-road me-2"></i> Product/Project Managers</h4>
                                    <p>Download our proven Product Roadmap Template to accelerate your planning.</p>
                                    <a href="#" class="btn btn-light btn-sm">Download</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-info text-white h-100">
                                <div class="card-body">
                                    <h4 class="h5"><i class="fas fa-hands-helping me-2"></i> Administrators</h4>
                                    <p>Learn About Our Services that can streamline your operations.</p>
                                    <a href="#" class="btn btn-light btn-sm">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Section 12: Digital Presence & Call to Action -->
<section id="connect" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Connect & Collaborate</h2>
            <p class="lead text-muted">Let's work together to create meaningful impact</p>
        </div>

        <div class="row g-4">
            <!-- Digital Presence Column -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="h4 mb-4 pb-2 border-bottom"><i class="fas fa-globe text-primary me-2"></i> Digital Presence</h3>
                        
                        <!-- Website -->
                        <div class="d-flex align-items-start mb-4">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-2 rounded">
                                <i class="fas fa-link text-primary fs-5"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="h6 mb-1">Website & Blog</h4>
                                <a href="https://jacoboroks.com" class="text-decoration-none" target="_blank">jacoboroks.com</a>
                            </div>
                        </div>
                        
                        <!-- Social Media -->
                        <div class="d-flex align-items-start mb-4">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-2 rounded">
                                <i class="fas fa-hashtag text-primary fs-5"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="h6 mb-2">Social Media</h4>
                                <div class="d-flex gap-3">
                                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="fab fa-linkedin-in me-1"></i> LinkedIn
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-info rounded-pill">
                                        <i class="fab fa-twitter me-1"></i> Twitter
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-danger rounded-pill">
                                        <i class="fab fa-instagram me-1"></i> Instagram
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Professional Associations -->
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-2 rounded">
                                <i class="fas fa-award text-primary fs-5"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="h6 mb-2">Professional Associations</h4>
                                <ul class="list-unstyled">
                                    <li class="mb-1">
                                        <i class="fas fa-circle-check text-success me-2"></i>
                                        Forbes Technology Council
                                    </li>
                                    <li class="mb-1">
                                        <i class="fas fa-circle-check text-success me-2"></i>
                                        FaithTech Collective
                                    </li>
                                    <li class="mb-1">
                                        <i class="fas fa-circle-check text-success me-2"></i>
                                        Efik Diaspora Council
                                    </li>
                                    <li>
                                        <i class="fas fa-circle-check text-success me-2"></i>
                                        Royal Society of Arts
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Call to Action Column -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="h4 mb-4 pb-2 border-bottom"><i class="fas fa-handshake-angle text-primary me-2"></i> Let's Work Together</h3>
                        
                        <div class="row g-3">
                            <!-- Entrepreneurs/Consultants -->
                            <div class="col-md-6">
                                <div class="card bg-primary bg-opacity-10 border-primary border-opacity-25 h-100">
                                    <div class="card-body text-center p-3">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                                            <i class="fas fa-lightbulb text-primary fs-4"></i>
                                        </div>
                                        <h4 class="h6 mb-2">Entrepreneurs/Consultants</h4>
                                        <p class="small mb-3">Schedule a strategy session to explore synergies</p>
                                        <a href="#" class="btn btn-primary btn-sm stretched-link">
                                            Book Session <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Finance Leaders -->
                            <div class="col-md-6">
                                <div class="card bg-success bg-opacity-10 border-success border-opacity-25 h-100">
                                    <div class="card-body text-center p-3">
                                        <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                                            <i class="fas fa-chart-line text-success fs-4"></i>
                                        </div>
                                        <h4 class="h6 mb-2">Finance Leaders</h4>
                                        <p class="small mb-3">Request a comprehensive financial review</p>
                                        <a href="#" class="btn btn-success btn-sm stretched-link">
                                            Request Review <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Real Estate Pros -->
                            <div class="col-md-6">
                                <div class="card bg-warning bg-opacity-10 border-warning border-opacity-25 h-100">
                                    <div class="card-body text-center p-3">
                                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                                            <i class="fas fa-building text-warning fs-4"></i>
                                        </div>
                                        <h4 class="h6 mb-2">Real Estate Professionals</h4>
                                        <p class="small mb-3">View available investment listings</p>
                                        <a href="#" class="btn btn-warning btn-sm stretched-link">
                                            Browse Listings <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Product/Project Managers -->
                            <div class="col-md-6">
                                <div class="card bg-info bg-opacity-10 border-info border-opacity-25 h-100">
                                    <div class="card-body text-center p-3">
                                        <div class="bg-info bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                                            <i class="fas fa-road text-info fs-4"></i>
                                        </div>
                                        <h4 class="h6 mb-2">Product/Project Managers</h4>
                                        <p class="small mb-3">Download our roadmap template</p>
                                        <a href="#" class="btn btn-info btn-sm stretched-link">
                                            Download <i class="fas fa-arrow-down ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Administrators -->
                            <div class="col-md-12">
                                <div class="card bg-secondary bg-opacity-10 border-secondary border-opacity-25 h-100">
                                    <div class="card-body text-center p-3">
                                        <div class="bg-secondary bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                                            <i class="fas fa-cogs text-secondary fs-4"></i>
                                        </div>
                                        <h4 class="h6 mb-2">Administrators</h4>
                                        <p class="small mb-3">Learn about our operational services</p>
                                        <a href="#" class="btn btn-secondary btn-sm stretched-link">
                                            Explore Services <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>