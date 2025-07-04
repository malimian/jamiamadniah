<?php
include 'front_connect.php';

$url = basename($_SERVER['PHP_SELF']);

// Fetch page data using proper URL sanitization
$safe_url = addslashes($url); // Basic sanitization for SQL
$content = return_single_row(
    "SELECT page_meta_title, site_template_id, page_meta_keywords, page_meta_desc, page_desc, 
    page_title, featured_image, pages.createdon, pid, catname, cat_url, page_url 
    FROM pages 
    LEFT JOIN category ON pages.catid = category.catid 
    WHERE pages.soft_delete = 0 
    AND category.soft_delete = 0 
    AND page_url = '$safe_url' 
    AND pages.isactive = 1"
);

// Initialize template ID with default if not found
$template_id = !empty($content['site_template_id']) ? (int)$content['site_template_id'] : 0;

// Prepare additional CSS/JS libraries
$additional_libs = [
    '<link href="css/checkout.css" rel="stylesheet">',
    '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">',
    '<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>',
    '<style>
        .gallery-section {
            padding: 60px 0;
        }
        .filter-buttons {
            margin-bottom: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        .filter-btn {
            padding: 8px 20px;
            border: 2px solid var(--bs-primary);
            background: transparent;
            color: var(--bs-primary);
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 5px;
        }
        .filter-btn:hover, .filter-btn.active {
            background: var(--bs-primary);
            color: white;
        }
        .gallery-item {
            margin-bottom: 30px;
            transition: all 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.05);
        }
        .gallery-caption {
            padding: 15px;
            background: white;
        }
        .gallery-caption h5 {
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }
        .gallery-caption .badge {
            background: var(--bs-primary);
            font-weight: normal;
        }
        .no-results {
            text-align: center;
            padding: 50px;
            font-size: 18px;
            color: #666;
            display: none;
        }
        @media (max-width: 768px) {
            .filter-buttons {
                flex-direction: column;
                align-items: center;
            }
            .gallery-item img {
                height: 200px;
            }
        }
    </style>'
];

// Output the header with all meta information
echo front_header(
    htmlspecialchars($content['page_meta_title'] ?? 'Home Page'),
    htmlspecialchars($content['page_meta_keywords'] ?? ''),
    htmlspecialchars($content['page_meta_desc'] ?? ''),
    $additional_libs,
    $template_id,
    $content
);

// Output the navbar with path replacement
$navbar_content = front_menu(null, $template_id);
if (!empty($navbar_content)) {
    echo replace_sysvari($navbar_content, getcwd() . "/");
}
?>

<!-- Hero Start -->
<div class="container-fluid hero-header bg-light position-relative">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25"></div>
    <div class="container position-relative z-index-1">
        <div class="row">
            <div class="col-lg-7">
                <div class="hero-header-inner animated zoomIn">
                    <h1 class="display-1 text-dark"><?= htmlspecialchars($content['page_title']) ?></h1>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= replace_sysvari($content['cat_url']) ?>"><?= htmlspecialchars(replace_sysvari($content['catname'])) ?></a></li>
                        <li class="breadcrumb-item text-dark" aria-current="page"><?= htmlspecialchars($content['page_title']) ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Gallery Section -->
<section class="gallery-section">
    <div class="container">
        <?php if (!empty($content['page_desc'])): ?>
        <div class="row mb-5">
            <div class="col-12">
                <div class="article-content">
                    <?= replace_sysvari($content['page_desc']) ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <?php 
        $photogallery = return_multiple_rows("Select * from images Where isactive = 1 and soft_delete = 0 and pid=".$content['pid']." ORDER BY section_name, i_sequence");
        
        if (!empty($photogallery)): 
            // Get unique sections for filter buttons
            $sections = array_unique(array_column($photogallery, 'section_name'));
        ?>
        
        <div class="row">
            <div class="col-12">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">All</button>
                    <?php foreach ($sections as $section): ?>
                        <button class="filter-btn" data-filter="<?= htmlspecialchars(str_replace(' ', '-', $section)) ?>"><?= htmlspecialchars($section) ?></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <div class="row gallery-container">
            <?php foreach ($photogallery as $image): 
                $image_path = BASE_URL . ABSOLUTE_IMAGEPATH . $image['i_name'];
                $filter_class = str_replace(' ', '-', $image['section_name']);
            ?>
            <div class="col-lg-4 col-md-6 gallery-item" data-filter="<?= htmlspecialchars($filter_class) ?>">
                <a href="<?= $image_path ?>" data-lightbox="gallery" data-title="<?= htmlspecialchars($image['section_name']) ?>">
                    <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($image['i_alttext'] ?: $image['section_name']) ?>" class="img-fluid">
                </a>
                <div class="gallery-caption">
                    <h5><?= htmlspecialchars($image['i_title'] ?: 'Image') ?></h5>
                    <span class="badge bg-primary"><?= htmlspecialchars($image['section_name']) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="no-results">
            <i class="fas fa-image fa-3x mb-3"></i>
            <p>No images found in this category</p>
        </div>
        
        <?php else: ?>
        <div class="row">
            <div class="col-12 text-center py-5">
                <i class="fas fa-image fa-3x text-muted mb-3"></i>
                <h4>No images found in the gallery</h4>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter gallery items
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const noResults = document.querySelector('.no-results');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            let visibleItems = 0;
            
            // Filter items
            galleryItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-filter') === filterValue) {
                    item.style.display = 'block';
                    visibleItems++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show/hide no results message
            if (visibleItems === 0) {
                noResults.style.display = 'block';
            } else {
                noResults.style.display = 'none';
            }
            
            // Smooth scroll to gallery
            document.querySelector('.gallery-container').scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Initialize lightbox with caption from title attribute
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'showImageNumberLabel': true,
        'alwaysShowNavOnTouchDevices': true
    });
});
</script>

<?php 
echo replace_sysvari(front_script(null, $template_id), getcwd() . "/");
?>

<?php
echo replace_sysvari(front_footer(null, $template_id), getcwd() . "/");
?>