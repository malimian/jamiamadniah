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

print_r($content);

// 4. Fetch product variations
$page_attributes = return_multiple_rows("SELECT * from page_attributes Where template_id = " . $content['template_id'] . " and isactive = 1 and soft_delete = 0");

print_r($page_attributes);


$page_attribute_values = return_multiple_rows("SELECT * from page_attribute_values Where page_id = " . $content['pid'] . " and isactive = 1 and soft_delete = 0");

print_r($page_attribute_values);


// 5. Fetch images
$photogallery = return_multiple_rows("Select * from images Where pid = " . $content['pid'] . " and isactive = 1 and soft_delete = 0");

print_r($photogallery);

$videos = return_multiple_rows("Select * from videos Where pid = " . $content['pid'] . " and isactive = 1 and soft_delete = 0");


print_r($videos);

?>
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

// Helper function to get attribute value
function get_attribute_value($attribute_id, $page_attribute_values) {
    foreach ($page_attribute_values as $value) {
        if ($value['attribute_id'] == $attribute_id) {
            return $value['attribute_value'];
        }
    }
    return null;
}

// Extract all data
$person_name = $content['page_title'];
$person_title = get_attribute_value(53, $page_attribute_values);
$profile_image = get_attribute_value(54, $page_attribute_values) ?: 'https://placehold.co/800x600/EEE/31343C';
$short_bio = get_attribute_value(55, $page_attribute_values);
$long_bio = get_attribute_value(56, $page_attribute_values);
$video_url = get_attribute_value(57, $page_attribute_values);
$achievements_json = get_attribute_value(58, $page_attribute_values);
$social_links_json = get_attribute_value(59, $page_attribute_values);
$quote = get_attribute_value(60, $page_attribute_values);
$quote_source = get_attribute_value(61, $page_attribute_values);

// Decode JSON data
$achievements = json_decode($achievements_json, true) ?: [];
$social_links = json_decode($social_links_json, true) ?: [];

// Process featured image
$featured_image = !empty($content['featured_image']) ? BASE_URL . ABSOLUTE_IMAGEPATH . $content['featured_image'] : 'https://source.unsplash.com/random/1600x900/?success';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($person_name); ?> | Achievement Spotlight</title>
    <?php echo header_t(); ?>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?php echo $featured_image; ?>') no-repeat center center;
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
        
        .quote-section {
            background-color: #f8f9fa;
            border-left: 5px solid #0d6efd;
            padding: 2rem;
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#"><?php echo htmlspecialchars($person_name); ?></a>
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
                    <?php if ($video_url): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#interview">Interview</a>
                    </li>
                    <?php endif; ?>
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
            <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="<?php echo htmlspecialchars($person_name); ?>" class="profile-img rounded-circle mb-4">
            <h1 class="display-4 fw-bold"><?php echo htmlspecialchars($person_name); ?></h1>
            <p class="lead"><?php echo htmlspecialchars($person_title); ?></p>
            <?php if (!empty($social_links)): ?>
            <div class="social-icons mt-4">
                <?php foreach ($social_links as $social): ?>
                <a href="<?php echo htmlspecialchars($social['url']); ?>" class="text-white mx-2" target="_blank" rel="noopener noreferrer">
                    <i class="<?php echo strpos($social['icon'], 'bi-') === 0 ? 'bi ' . htmlspecialchars($social['icon']) : 'fab fa-' . htmlspecialchars($social['icon']); ?> fa-2x"></i>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </header>

    <!-- Quote Section -->
    <?php if ($quote): ?>
    <section class="container my-5">
        <div class="quote-section">
            <blockquote class="blockquote mb-0">
                <p><?php echo htmlspecialchars($quote); ?></p>
                <?php if ($quote_source): ?>
                <footer class="blockquote-footer mt-2"><?php echo htmlspecialchars($quote_source); ?></footer>
                <?php endif; ?>
            </blockquote>
        </div>
    </section>
    <?php endif; ?>

    <!-- Achievements Section -->
    <?php if (!empty($achievements)): ?>
    <section id="achievements" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Notable Achievements</h2>
            <div class="row mt-5">
                <?php foreach ($achievements as $achievement): ?>
                <div class="col-md-4">
                    <div class="card achievement-card">
                        <div class="card-body text-center">
                            <i class="fas fa-award fa-3x text-warning mb-3"></i>
                            <h4 class="card-title"><?php echo htmlspecialchars($achievement['title']); ?></h4>
                            <p class="card-text"><?php echo htmlspecialchars($achievement['description']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Spotlight Section -->
    <section id="spotlight" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Professional Spotlight</h2>
            <div class="row align-items-center mt-5">
                <div class="col-lg-6">
                    <h3 class="mb-4">About <?php echo htmlspecialchars($person_name); ?></h3>
                    <?php if ($short_bio): ?>
                    <p class="lead"><?php echo htmlspecialchars($short_bio); ?></p>
                    <?php endif; ?>
                    <?php if ($long_bio): ?>
                    <p><?php echo nl2br(htmlspecialchars($long_bio)); ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <?php if (!empty($photogallery)): ?>
                    <div id="profileCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($photogallery as $index => $photo): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img src="<?php echo BASE_URL . ABSOLUTE_IMAGEPATH . $photo['image_path']; ?>" class="d-block w-100 rounded" alt="<?php echo htmlspecialchars($photo['caption'] ?: $person_name); ?>">
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#profileCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#profileCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <?php else: ?>
                    <img src="<?php echo htmlspecialchars($profile_image); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($person_name); ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Interview Section -->
    <?php if ($video_url): ?>
    <section id="interview" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Featured Interview</h2>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8">
                    <div class="ratio ratio-16x9">
                        <iframe src="<?php echo htmlspecialchars($video_url); ?>" title="<?php echo htmlspecialchars($person_name); ?> Interview" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title mb-5">Get In Touch</h2>
                    <?php if (!empty($social_links)): ?>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <?php foreach ($social_links as $social): ?>
                        <a href="<?php echo htmlspecialchars($social['url']); ?>" class="btn btn-outline-primary btn-lg" target="_blank" rel="noopener noreferrer">
                            <i class="<?php echo strpos($social['icon'], 'bi-') === 0 ? 'bi ' . htmlspecialchars($social['icon']) : 'fab fa-' . htmlspecialchars($social['icon']); ?> me-2"></i>
                            <?php echo htmlspecialchars($social['name']); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($person_name); ?>. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo footer_t(); ?>