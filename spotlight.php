<?php
include 'front_connect.php';

$url = "spotlight.php";

$not_show_more_then_once = []; 

// Fetch page data
$content = return_single_row("SELECT page_meta_title, site_template_id, page_meta_keywords, page_meta_desc, page_title, featured_image, pages.createdon, pid, catname, cat_url, page_url FROM pages LEFT JOIN category ON pages.catid = category.catid WHERE pages.soft_delete = 0 AND category.soft_delete = 0 AND page_url = '$url' AND pages.isactive = 1");

$template_id = $content['site_template_id'];

echo front_header(
    $content['page_meta_title'],
    $content['page_meta_keywords'],
    $content['page_meta_desc'],
    '<link href="css/checkout.css" rel="stylesheet">',
    $template_id,
    $content
);

// Output the navbar with path replacement
$navbar_content = front_menu( null ,$template_id);
if (!empty($navbar_content)) {
    echo replace_sysvari($navbar_content, getcwd() . "/");
}

?>


    <style>
        .people-slider {
            padding: 60px 0;
            position: relative;
        }
        
        .slider-container {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 60px;
        }
        
        .slider-track {
            display: flex;
            transition: transform 0.5s ease;
            padding: 40px 0;
        }
        
        .slide {
            flex: 0 0 25%;
            padding: 0 15px;
            transition: all 0.5s ease;
            position: relative;
        }
        
        .slide.active {
            transform: scale(1.2);
            z-index: 10;
        }
        
        .portrait-frame {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.5s ease;
            height: 350px;
            display: flex;
            align-items: center;
            background: #f8f9fa;
        }
        
        .slide.active .portrait-frame {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            border: 8px solid #fff;
        }
        
        .portrait-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }
        
        .slide.active .portrait-frame img {
            transform: scale(1.05);
        }
        
      .spotlight {
		    position: absolute;
		    top: -50px;
		    left: 50%;
		    transform: translateX(-50%);
		    width: 200px;
		    height: 200px;
		    background: radial-gradient(circle, rgba(255, 235, 59, 0.8) 0%, rgba(255, 235, 59, 0) 70%);
		    opacity: 0;
		    transition: opacity 0.5s ease;
		    z-index: 5;
		    pointer-events: none;
		}
        
        .slide.active .spotlight {
            opacity: 1;
        }
        
        .light-bulb {
            position: absolute;
            top: -70px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 40px;
            color: #ffeb3b;
            text-shadow: 0 0 20px #ffeb3b;
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 15;
        }
        
        .slide.active .light-bulb {
            opacity: 1;
            animation: bulb-flicker 2s infinite alternate;
        }
        
        @keyframes bulb-flicker {
            0% { opacity: 0.8; text-shadow: 0 0 15px #ffeb3b; }
            100% { opacity: 1; text-shadow: 0 0 25px #ffeb3b; }
        }
        
        .slide-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 15px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
            text-align: center;
        }
        
        .slide.active .slide-info {
            transform: translateY(0);
        }
        
        .slider-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            z-index: 20;
        }
        
        .slider-nav button {
            background: rgba(255, 255, 255, 0.7);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #333;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .slider-nav button:hover {
            background: white;
            transform: scale(1.1);
        }
        
        .slide-indicators {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        
        .indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ddd;
            margin: 0 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .indicator.active {
            background: #333;
            transform: scale(1.3);
        } 


        @media (max-width: 1024px) {
          .slide {
            flex: 0 0 33.33%;
          }
        }

        @media (max-width: 768px) {
          .slider-container {
            padding: 0 20px;
          }

          .slide {
            flex: 0 0 50%;
            padding: 0 10px;
          }

          .portrait-frame {
            height: 300px;
          }
        }

        @media (max-width: 480px) {
          .slide {
            flex: 0 0 100%;
            padding: 0 10px;
          }

          .portrait-frame {
            height: 250px;
          }

          .slider-nav button {
            width: 40px;
            height: 40px;
            font-size: 16px;
          }
        }
        /*  Slider ends       */

         .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #0d6efd;
        }
        
        .testimonial-card {
            transition: transform 0.3s;
        }
        
        .testimonial-card:hover {
            transform: translateY(-10px);
        }
        
        .interview-showcase {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 30px;
        }

    </style>
</head>
<body>

	<!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4">Share Your Story With The World</h1>
            <p class="lead mb-5">Get featured in our spotlight interviews and showcase your professional background to a global audience.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#people-slider" class="btn btn-primary btn-lg px-4">Spotlight</a>
                <a href="#signup" class="btn btn-outline-light btn-lg px-4">Get Started</a>
            </div>
        </div>
    </section>


    <section id="people-slider" class="people-slider">
        <div class="slider-container">
            <div class="slider-track" id="sliderTrack">
                <!-- Slide 1 -->
                <div class="slide active">
                    <div class="portrait-frame">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" alt="Person 1">
                        <div class="spotlight"></div>
                        <i class="fas fa-lightbulb light-bulb"></i>
                        <div class="slide-info">
                            <h5>John Doe</h5>
                            <p>CEO & Founder</p>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 2 -->
                <div class="slide">
                    <div class="portrait-frame">
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" alt="Person 2">
                        <div class="spotlight"></div>
                        <i class="fas fa-lightbulb light-bulb"></i>
                        <div class="slide-info">
                            <h5>Jane Smith</h5>
                            <p>Marketing Director</p>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 3 -->
                <div class="slide">
                    <div class="portrait-frame">
                        <img src="https://t3.ftcdn.net/jpg/02/99/04/20/360_F_299042079_vGBD7wIlSeNl7vOevWHiL93G4koMM967.jpg" alt="Person 3">
                        <div class="spotlight"></div>
                        <i class="fas fa-lightbulb light-bulb"></i>
                        <div class="slide-info">
                            <h5>Michael Johnson</h5>
                            <p>Lead Developer</p>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 4 -->
                <div class="slide">
                    <div class="portrait-frame">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" alt="Person 4">
                        <div class="spotlight"></div>
                        <i class="fas fa-lightbulb light-bulb"></i>
                        <div class="slide-info">
                            <h5>Sarah Williams</h5>
                            <p>UX Designer</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="slider-nav">
                <button id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                <button id="nextBtn"><i class="fas fa-chevron-right"></i></button>
            </div>
            
            <div class="slide-indicators" id="indicators">
                <div class="indicator active"></div>
                <div class="indicator"></div>
                <div class="indicator"></div>
                <div class="indicator"></div>
            </div>
        </div>
    </section>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.getElementById('sliderTrack');
            const slides = Array.from(document.querySelectorAll('.slide'));
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const indicators = Array.from(document.getElementById('indicators').children);
            
            let currentIndex = 0;
            const slideCount = slides.length;
            
            // Set initial positions
            updateSlider();
            
            // Next button click
            nextBtn.addEventListener('click', function() {
                currentIndex = (currentIndex + 1) % slideCount;
                updateSlider();
            });
            
            // Previous button click
            prevBtn.addEventListener('click', function() {
                currentIndex = (currentIndex - 1 + slideCount) % slideCount;
                updateSlider();
            });
            
            // Indicator click
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', function() {
                    currentIndex = index;
                    updateSlider();
                });
            });
            
            // Auto-rotate every 5 seconds
            let autoSlide = setInterval(() => {
                currentIndex = (currentIndex + 1) % slideCount;
                updateSlider();
            }, 5000);
            
            // Pause auto-rotate on hover
            track.addEventListener('mouseenter', () => {
                clearInterval(autoSlide);
            });
            
            track.addEventListener('mouseleave', () => {
                autoSlide = setInterval(() => {
                    currentIndex = (currentIndex + 1) % slideCount;
                    updateSlider();
                }, 5000);
            });
            
            function updateSlider() {
            const slidesPerView = getSlidesPerView();
            const slideWidthPercent = 100 / slidesPerView;
            const offset = -currentIndex * slideWidthPercent;

            // Update active slide
            slides.forEach((slide, index) => {
                slide.classList.toggle('active', index === currentIndex);
            });

            // Update indicators
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentIndex);
            });

            // Translate the track
            track.style.transform = `translateX(${offset}%)`;
        }

            function getSlidesPerView() {
                const width = window.innerWidth;
                if (width <= 480) return 1;
                if (width <= 768) return 2;
                if (width <= 1024) return 3;
                return 4; // default for desktop
            }

        });
    </script>
  

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Amplify Your Professional Presence</h2>
                <p class="lead text-muted">Our platform helps you highlight your achievements and expertise</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3>Professional Profile</h3>
                        <p>Showcase your career journey, education, and accomplishments in a professionally designed format that stands out.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-microphone"></i>
                        </div>
                        <h3>Featured Interviews</h3>
                        <p>Get interviewed by our team and have your story published across our media channels and partner networks.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Increased Visibility</h3>
                        <p>Reach thousands of potential clients, employers, or collaborators through our targeted distribution.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Showcase Section -->
     <style>
        .showcase-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
        }
        .highlight-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            height: 100%;
        }
        .highlight-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .icon-wrapper {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .gradient-text {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>
<body>
    <!-- Showcase Section -->
    <section class="py-5">
        <div class="container">
            <div class="showcase-section p-4 p-md-5 mb-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h2 class="display-5 fw-bold mb-3">Showcase Your Background <span class="gradient-text">With Us</span></h2>
                        <p class="lead mb-4">Whether you're an entrepreneur, executive, or creative professional, our spotlight features help you present your background in the best possible light.</p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#featured-spotlights" class="btn btn-primary px-4 py-2">View Examples</a>
                            <a href="#get-featured" class="btn btn-outline-primary px-4 py-2">Get Featured</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="https://images.unsplash.com/photo-1579389083078-4e7018379f7e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Professional showcasing work" class="img-fluid rounded-3 shadow">
                    </div>
                </div>
            </div>

            <!-- What We Highlight Section -->
            <div class="row mb-5">
                <div class="col-12 text-center mb-5">
                    <h2 class="fw-bold">What We Highlight</h2>
                    <p class="lead text-muted">We showcase the complete professional profile that makes you unique</p>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="highlight-card p-4 bg-white">
                        <div class="icon-wrapper bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-trophy fa-lg"></i>
                        </div>
                        <h4 class="mb-3">Career Milestones</h4>
                        <p class="text-muted">Highlight your professional achievements, promotions, and career-defining moments that showcase your growth.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="highlight-card p-4 bg-white">
                        <div class="icon-wrapper bg-success bg-opacity-10 text-success">
                            <i class="fas fa-graduation-cap fa-lg"></i>
                        </div>
                        <h4 class="mb-3">Education</h4>
                        <p class="text-muted">Showcase your academic background, certifications, and continuous learning efforts that contribute to your expertise.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="highlight-card p-4 bg-white">
                        <div class="icon-wrapper bg-info bg-opacity-10 text-info">
                            <i class="fas fa-lightbulb fa-lg"></i>
                        </div>
                        <h4 class="mb-3">Skills & Expertise</h4>
                        <p class="text-muted">Present your professional skills, technical competencies, and unique abilities that set you apart in your field.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="highlight-card p-4 bg-white">
                        <div class="icon-wrapper bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-project-diagram fa-lg"></i>
                        </div>
                        <h4 class="mb-3">Projects & Portfolio</h4>
                        <p class="text-muted">Feature your best work, case studies, and portfolio pieces that demonstrate your capabilities and achievements.</p>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center py-5">
                <h3 class="fw-bold mb-4">Ready to showcase your professional journey?</h3>
                <p class="lead mb-4">Join our community of featured professionals and gain visibility in your industry.</p>
                <a href="#" class="btn btn-primary btn-lg px-5 py-3">Apply to Be Featured <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section>


    <!-- Testimonials -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Success Stories</h2>
                <p class="lead text-muted">Hear from professionals who've boosted their visibility with us</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card testimonial-card h-100">
                        <div class="card-body text-center p-4">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle mb-3" width="80" alt="Testimonial">
                            <h5 class="card-title">Sarah Johnson</h5>
                            <h6 class="card-subtitle mb-3 text-muted">Marketing Director</h6>
                            <p class="card-text">"After my spotlight feature, I received three job offers and multiple speaking invitations. It perfectly showcased my 15-year career journey."</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card testimonial-card h-100">
                        <div class="card-body text-center p-4">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle mb-3" width="80" alt="Testimonial">
                            <h5 class="card-title">Michael Chen</h5>
                            <h6 class="card-subtitle mb-3 text-muted">Tech Entrepreneur</h6>
                            <p class="card-text">"The interview helped me present my startup background to investors. We secured funding within weeks of the feature going live."</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card testimonial-card h-100">
                        <div class="card-body text-center p-4">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle mb-3" width="80" alt="Testimonial">
                            <h5 class="card-title">David Rodriguez</h5>
                            <h6 class="card-subtitle mb-3 text-muted">Creative Director</h6>
                            <p class="card-text">"As a designer, I needed a way to showcase both my portfolio and career path. This service provided the perfect platform."</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-5 bg-light">
      	<?php echo include_module('modules/module_packages.php' , array('packages_category' => 41));?>	
    </section>

    <!-- Signup CTA -->
    <section id="signup" class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Ready to Showcase Your Background?</h2>
                    <p class="lead mb-5">Join hundreds of professionals who've elevated their visibility with our spotlight features.</p>
                    <form class="row g-3 justify-content-center">
                        <div class="col-md-8">
                            <input type="email" class="form-control form-control-lg" placeholder="Your email address">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-light btn-lg w-100">Get Started</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


<?php
echo replace_sysvari(front_footer(null, $template_id), getcwd() . "/");
?>

<?php 
echo replace_sysvari(front_script(null, $template_id), getcwd() . "/");
?>