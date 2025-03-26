<?php
include 'front_connect.php';

$url = "index.php";

$not_show_more_then_once = [];

// Fetch page data
$content = return_single_row("SELECT page_meta_title, site_template_id, page_meta_keywords, page_meta_desc, page_title, featured_image, pages.createdon, pid, catname, cat_url, page_url FROM pages LEFT JOIN category ON pages.catid = category.catid WHERE pages.soft_delete = 0 AND category.soft_delete = 0 AND page_url = '$url' AND pages.isactive = 1");

$template_id = $content['site_template_id'];

echo Baseheader(
    $content['page_meta_title'],
    $content['page_meta_keywords'],
    $content['page_meta_desc'],
    '<link href="css/checkout.css" rel="stylesheet">',
    $template_id,
    $content
);

echo replace_sysvari(BaseNavBar($template_id), getcwd() . "/");

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
    </style>
</head>
<body>
    <section class="people-slider">
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

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
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
                // Update active slide
                slides.forEach((slide, index) => {
                    slide.classList.toggle('active', index === currentIndex);
                });
                
                // Update indicators
                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === currentIndex);
                });
                
                // Calculate transform value
                const offset = -currentIndex * 25;
                track.style.transform = `translateX(${offset}%)`;
            }
        });
    </script>
  


<?php
echo replace_sysvari(Basefooter(null, $template_id), getcwd() . "/");
echo replace_sysvari(BaseScript(null, $template_id), getcwd() . "/");
?>