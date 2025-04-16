<?php
$GLOBALS['content'] = $content;

if (!function_exists("header_t")) {
    function header_t()
    {
        return '
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
            <link href="css/templates/template_general.css" rel="stylesheet">
            <meta property="og:site_name" content="' . SITE_TITLE . '">
            <meta property="og:title" content="' . replace_sysvari($GLOBALS['content']['page_title']) . '" />
            <meta property="og:description" content="' . replace_sysvari($GLOBALS['content']['page_title']) . '" />
            <meta property="og:image" itemprop="image" content="' . BASE_URL . ABSOLUTE_IMAGEPATH . $GLOBALS['content']['featured_image'] . '">           
        ';
    }
}

if (!function_exists("footer_t")) {
    function footer_t()
    {
        return '
        ';
    }
}




$GLOBALS['content'] = $content;

// print_r($content);

// 4. Fetch product variations
$page_attributes = return_multiple_rows("SELECT * from page_attributes Where template_id = " . $content['template_id'] . " and isactive = 1 and soft_delete = 0");

// print_r($page_attributes);


$page_attribute_values = return_multiple_rows("SELECT * from page_attribute_values Where page_id = " . $content['pid'] . " and isactive = 1 and soft_delete = 0");

// print_r($page_attribute_values);


// 5. Fetch images
$photogallery = return_multiple_rows("Select * from images Where pid = " . $content['pid'] . " and isactive = 1 and soft_delete = 0");

// print_r($photogallery);

$videos = return_multiple_rows("Select * from videos Where pid = " . $content['pid'] . " and isactive = 1 and soft_delete = 0");


// print_r($videos);

?>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://source.unsplash.com/random/1600x900/?success') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
            margin-bottom: 50px;
        }
        
        .achievement-card {
            transition: transform 0.3s;
            margin-bottom: 30px;
            height: 100%;
        }
        
        .achievement-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .interview-card {
            border-left: 5px solid #0d6efd;
        }
        
        .profile-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 5px solid white;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 40px;
        }
        
        .section-title:after {
            content: "";
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: #0d6efd;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">John Doe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#achievements">Achievements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#spotlight">Spotlight</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#interviews">Interviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <img src="https://source.unsplash.com/random/300x300/?portrait" alt="John Doe" class="profile-img rounded-circle mb-4">
            <h1 class="display-4 fw-bold">John Doe</h1>
            <p class="lead">Award-winning Innovator | Tech Visionary | Industry Leader</p>
            <div class="social-icons mt-4">
                <a href="#" class="text-white mx-2"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-linkedin fa-2x"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-github fa-2x"></i></a>
            </div>
        </div>
    </header>

    <!-- Achievements Section -->
    <section id="achievements" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Notable Achievements</h2>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card achievement-card">
                        <div class="card-body text-center">
                            <i class="fas fa-trophy fa-3x text-warning mb-3"></i>
                            <h4 class="card-title">Global Innovation Award 2023</h4>
                            <p class="card-text">Recognized for groundbreaking work in AI technology that revolutionized the healthcare industry.</p>
                            <small class="text-muted">Presented by TechGlobal Foundation</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card achievement-card">
                        <div class="card-body text-center">
                            <i class="fas fa-medal fa-3x text-primary mb-3"></i>
                            <h4 class="card-title">40 Under 40 Leaders</h4>
                            <p class="card-text">Named among the top 40 influential leaders under 40 years old by Business Today magazine.</p>
                            <small class="text-muted">Business Today, 2022</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card achievement-card">
                        <div class="card-body text-center">
                            <i class="fas fa-lightbulb fa-3x text-success mb-3"></i>
                            <h4 class="card-title">Patent Holder</h4>
                            <p class="card-text">Holds 12 patents in machine learning algorithms with applications in financial forecasting.</p>
                            <small class="text-muted">USPTO, 2018-2023</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Spotlight Section -->
    <section id="spotlight" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Work Spotlight</h2>
            <div class="row align-items-center mt-5">
                <div class="col-lg-6">
                    <h3 class="mb-4">Revolutionizing AI in Healthcare</h3>
                    <p class="lead">John's innovative approach to applying machine learning in medical diagnostics has saved countless lives and reduced healthcare costs by 30% in pilot programs.</p>
                    <p>His team developed the first FDA-approved AI system for early detection of pancreatic cancer, achieving 94% accuracy in clinical trials. This breakthrough came after 5 years of dedicated research and collaboration with leading medical institutions.</p>
                    <div class="mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle text-success me-3 fa-lg"></i>
                            <span>Reduced diagnostic time from weeks to minutes</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle text-success me-3 fa-lg"></i>
                            <span>Increased early detection rates by 40%</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-3 fa-lg"></i>
                            <span>Scaled to 200+ hospitals worldwide</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/example" title="John Doe's TED Talk" allowfullscreen></iframe>
                    </div>
                    <div class="text-center mt-3">
                        <small class="text-muted">John's TED Talk on "The Future of AI in Medicine" (2.5M views)</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interviews Section -->
    <section id="interviews" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Featured Interviews</h2>
            <div class="row mt-5">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 interview-card">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <img src="https://source.unsplash.com/random/100x100/?magazine" alt="Tech Today" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <h5 class="mb-0">Tech Today</h5>
                                    <small class="text-muted">March 15, 2023</small>
                                </div>
                            </div>
                            <h4 class="card-title">"The Ethical Future of AI"</h4>
                            <p class="card-text">John discusses the moral implications of artificial intelligence and his framework for responsible innovation.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Read Interview</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 interview-card">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <img src="https://source.unsplash.com/random/100x100/?news" alt="Business Weekly" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <h5 class="mb-0">Business Weekly</h5>
                                    <small class="text-muted">January 8, 2023</small>
                                </div>
                            </div>
                            <h4 class="card-title">"From Garage to Global Impact"</h4>
                            <p class="card-text">The inspiring story of how John built his first AI prototype with just $500 and turned it into a billion-dollar solution.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Read Interview</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 interview-card">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <img src="https://source.unsplash.com/random/100x100/?podcast" alt="Future Forward" class="rounded-circle me-3" width="50" height="50">
                                <div>
                                    <h5 class="mb-0">Future Forward Podcast</h5>
                                    <small class="text-muted">November 22, 2022</small>
                                </div>
                            </div>
                            <h4 class="card-title">Episode 42: "Failure as Fuel"</h4>
                            <p class="card-text">John shares his most spectacular failures and how each one propelled him to greater success.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Listen Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-primary">View All Media Appearances</a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Recognitions</h2>
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="text-center px-5">
                                    <img src="https://source.unsplash.com/random/100x100/?executive" alt="Dr. Sarah Chen" class="rounded-circle mb-3" width="80" height="80">
                                    <blockquote class="blockquote">
                                        <p>"John's work has fundamentally changed how we approach early disease detection. His contributions to medical AI will impact generations to come."</p>
                                    </blockquote>
                                    <footer class="blockquote-footer">Dr. Sarah Chen, <cite>Director of NIH</cite></footer>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="text-center px-5">
                                    <img src="https://source.unsplash.com/random/100x100/?business" alt="Michael Johnson" class="rounded-circle mb-3" width="80" height="80">
                                    <blockquote class="blockquote">
                                        <p>"In my 20 years covering tech innovations, I've rarely seen someone with John's combination of technical brilliance and practical vision."</p>
                                    </blockquote>
                                    <footer class="blockquote-footer">Michael Johnson, <cite>Editor-in-Chief, Tech Review</cite></footer>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title mb-5">Get In Touch</h2>
                    <p class="lead mb-5">For speaking engagements, collaboration opportunities, or media inquiries</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="mailto:john@example.com" class="btn btn-primary btn-lg">
                            <i class="fas fa-envelope me-2"></i> Email
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-lg">
                            <i class="fab fa-linkedin me-2"></i> LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>