<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jacob Oroks - Visionary Leader | IB Spotlight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
    /* Hero Carousel Styling */
    #hero-carousel {
        margin-bottom: 3rem;
    }
    #hero-carousel .carousel-item {
        height: 70vh;
        min-height: 400px;
    }
    #hero-carousel .carousel-item img {
        object-fit: cover;
        height: 100%;
    }
    #hero-carousel .carousel-caption {
        bottom: 30%;
        background: rgba(0, 0, 0, 0.5);
        padding: 2rem;
        border-radius: 0.5rem;
    }
    
    /* Profile Snapshot Styling */
    .profile-snapshot {
        border: none !important;
    }
    .profile-snapshot p {
        margin-bottom: 1.2rem;
    }
    .profile-snapshot strong {
        color: #0d6efd;
    }

/*   Right Section */
.profile-card {
    background: white;
    border: 1px solid rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.profile-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.text-gradient {
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    display: inline-block;
}


 /*  Personal Background */
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
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .hover-effect {
        transition: all 0.3s ease;
    }
    
    .hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }



</style>
</head>
<body>
    <!-- Section 1: Hero Banner with Carousel -->
<section id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
         <div class="carousel-item">
            <img src="https://picsum.photos/1956/600?greyscale" class="d-block w-100" alt="Jacob Oroks Banner 3">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-3 fw-bold">Community Builder</h1>
                <p class="lead">Championing Efik Heritage in the Diaspora</p>
            </div>
        </div>
        <div class="carousel-item active">
            <img src="https://picsum.photos/1921/600?blackscale" class="d-block w-100" alt="Jacob Oroks Banner 2">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-3 fw-bold">Innovative Thinker</h1>
                <p class="lead">Bridging Technology and Spiritual Wisdom</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://picsum.photos/1920/600?whitescale" class="d-block w-100" alt="Jacob Oroks Banner 3">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-3 fw-bold">Community Builder</h1>
                <p class="lead">Championing Efik Heritage in the Diaspora</p>
            </div>
        </div>
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
<section class="container my-5">
    <div class="row align-items-center">
        <!-- Left Column - Profile Image -->
        <div class="col-md-4 text-center mb-4 mb-md-0">
            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&h=600&fit=facearea&facepad=3" 
                 alt="Professional Headshot of Jacob Oroks" 
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
                        <p class="mb-0 fw-bold fs-5">Jacob Etim Oroks</p>
                        <span class="badge bg-primary bg-opacity-10 text-primary mt-1">CEO</span>
                        <span class="badge bg-success bg-opacity-10 text-success mt-1">Pastor</span>
                        <span class="badge bg-info bg-opacity-10 text-info mt-1">Community Leader</span>
                    </div>
                </div>
                
                <div class="d-flex align-items-start">
                    <div class="me-3 text-primary">
                        <i class="bi bi-geo-alt fs-3"></i>
                    </div>
                    <div>
                        <h3 class="h5 mb-1">Location</h3>
                        <p class="mb-0">
                            <span class="d-block">United States</span>
                            <small class="text-muted">Based in Maryland</small>
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
                            <a href="mailto:contact@ibspotlight.com" class="text-decoration-none">
                                contact@ibspotlight.com
                            </a>
                        </p>
                        <p class="mb-0">
                            <a href="tel:+11234567890" class="text-decoration-none">
                                +1 (123) 456-7890
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
                    <a href="#" class="btn btn-outline-primary p-2">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="#" class="btn btn-outline-primary p-2">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-outline-primary p-2">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="btn btn-outline-primary p-2">
                        <i class="bi bi-instagram"></i>
                    </a>
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
<section class="mb-5 professional-journey">
    <div class="container">
        <h2 class="section-title mb-5 text-center">Professional Journey & Milestones</h2>
        
        <div class="timeline-wrapper">
            <div class="timeline-line"></div>
            
            <div class="timeline-items">
                <!-- Timeline Item 1 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">2020 - Present</div>
                        <h3 class="timeline-position">CEO & Founder</h3>
                        <h4 class="timeline-company">Iboto Empire USA</h4>
                        <div class="timeline-description">
                            <p>Leading a technology consulting firm specializing in digital transformation for faith-based organizations and non-profits. Spearheaded initiatives that:</p>
                            <ul>
                                <li>Increased operational efficiency by 40% through custom CRM solutions</li>
                                <li>Developed secure donation platforms processing $2M+ annually</li>
                                <li>Built cross-platform mobile apps reaching 50,000+ users</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Timeline Item 2 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">2018 - 2020</div>
                        <h3 class="timeline-position">Senior Solutions Architect</h3>
                        <h4 class="timeline-company">TechFaith Inc.</h4>
                        <div class="timeline-description">
                            <p>Designed and implemented cloud-native solutions for Fortune 500 clients while maintaining ethical technology practices:</p>
                            <ul>
                                <li>Led migration of legacy systems to AWS, reducing costs by 35%</li>
                                <li>Developed AI-powered analytics tools for faith-based metrics</li>
                                <li>Mentored junior developers in ethical coding practices</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Timeline Item 3 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">2015 - 2018</div>
                        <h3 class="timeline-position">Founder & Technical Lead</h3>
                        <h4 class="timeline-company">FaithTech Collective</h4>
                        <div class="timeline-description">
                            <p>Created an innovative platform connecting technologists and faith leaders for social impact projects:</p>
                            <ul>
                                <li>Built community of 500+ developers and ministry leaders</li>
                                <li>Launched 12 successful collaborative projects</li>
                                <li>Developed open-source tools for small congregations</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.professional-journey {
    background-color: #f8f9fa;
    padding: 4rem 0;
}

.section-title {
    font-size: 2.5rem;
    color: #2c3e50;
    position: relative;
    padding-bottom: 1rem;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #3498db, #9b59b6);
}

.timeline-wrapper {
    position: relative;
    max-width: 1000px;
    margin: 0 auto;
}

.timeline-line {
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(to bottom, #3498db, #9b59b6);
    transform: translateX(-50%);
    z-index: 1;
}

.timeline-items {
    position: relative;
    z-index: 2;
}

.timeline-item {
    display: flex;
    justify-content: flex-end;
    padding: 2rem 0;
    position: relative;
    margin: 0 2rem;
}

.timeline-item:nth-child(odd) {
    justify-content: flex-start;
}

.timeline-dot {
    width: 20px;
    height: 20px;
    background: #3498db;
    border-radius: 50%;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    border: 4px solid white;
    box-shadow: 0 0 0 2px #3498db;
    z-index: 3;
}

.timeline-content {
    width: calc(50% - 4rem);
    padding: 2rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.timeline-item:nth-child(odd) .timeline-content {
    margin-right: auto;
}

.timeline-item:nth-child(even) .timeline-content {
    margin-left: auto;
}

.timeline-content:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.timeline-date {
    color: #7f8c8d;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.timeline-position {
    color: #2c3e50;
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.timeline-company {
    color: #3498db;
    font-size: 1.2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.timeline-description {
    color: #34495e;
    line-height: 1.6;
}

.timeline-description ul {
    padding-left: 1.5rem;
    margin-top: 0.5rem;
}

.timeline-description li {
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .timeline-line,
    .timeline-dot {
        left: 2rem;
    }
    
    .timeline-item {
        justify-content: flex-start !important;
        padding-left: 4rem;
    }
    
    .timeline-content {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    // Animate timeline items on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    timelineItems.forEach((item, index) => {
        item.style.opacity = 0;
        item.style.transform = 'translateY(20px)';
        item.style.transition = `all 0.5s ease ${index * 0.1}s`;
        observer.observe(item);
    });
});
</script>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>