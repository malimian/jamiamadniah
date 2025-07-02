<?php

// Get current page ID
$pid = $content['pid'];

// Fetch data from all tables
$files = return_multiple_rows("SELECT * FROM page_files WHERE isactive = 1 AND soft_delete = 0 AND pid = $pid ORDER BY f_sequence");
$videos = return_multiple_rows("SELECT * FROM videos WHERE isactive = 1 AND soft_delete = 0 AND pid = $pid ORDER BY v_sequence");
$images = return_multiple_rows("SELECT * FROM images WHERE isactive = 1 AND soft_delete = 0 AND pid = $pid ORDER BY i_sequence");

// Additional CSS for this page
$additional_css = <<<CSS
<style>
    /* Gallery Section */
    .gallery-container {
        column-count: 3;
        column-gap: 1rem;
    }
    
    .gallery-item {
        break-inside: avoid;
        margin-bottom: 1rem;
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    
    .gallery-item img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }
    
    .gallery-item:hover img {
        transform: scale(1.05);
    }
    
    .gallery-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 1rem;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover .gallery-caption {
        transform: translateY(0);
    }
    
    /* Files Section */
    .file-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .file-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .file-card .card-img-top {
        height: 180px;
        object-fit: cover;
    }
    
    .file-card .badge {
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    /* Videos Section */
    .video-card {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .video-play-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(5px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        transition: all 0.3s ease;
    }
    
    .video-play-btn:hover {
        background: var(--bs-primary);
        transform: translate(-50%, -50%) scale(1.1);
    }
    
    @media (max-width: 767.98px) {
        .gallery-container {
            column-count: 2;
        }
    }
    
    @media (max-width: 575.98px) {
        .gallery-container {
            column-count: 1;
        }
    }
</style>
CSS;

// Add lightbox CSS/JS if we have images
if (!empty($images)) {
    $additional_css .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">';
    $additional_js = '<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>';
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

<!-- Files Section -->
<?php if (!empty($files)): ?>
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="text-uppercase text-primary">دستاویزات</h5>
            <h1 class="display-5 mb-0">جامعہ مدنیہ کی فائلیں</h1>
            <p class="fs-5 text-muted">ہماری دستاویزات اور رسائل ڈاؤن لوڈ کریں</p>
        </div>
        
        <div class="row g-4">
            <?php foreach ($files as $file): 
                $thumbnail = !empty($file['f_thumbnail']) ? BASE_URL . ABSOLUTE_IMAGEPATH . $file['f_thumbnail'] : 'img/default-file.jpg';
                $download_url = !empty($file['f_download_link']) ? $file['f_download_link'] : (BASE_URL . ABSOLUTE_FILEPATH . $file['f_name']);
            ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.<?= ($index%3)+1 ?>s">
                <div class="file-card h-100">
                    <img src="<?= $thumbnail ?>" class="card-img-top" alt="<?= htmlspecialchars($file['f_title']) ?>">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0"><?= htmlspecialchars($file['f_title']) ?></h5>
                            <span class="badge bg-primary"><?= pathinfo($file['f_name'], PATHINFO_EXTENSION) ?></span>
                        </div>
                        <?php if (!empty($file['f_description'])): ?>
                        <p class="card-text text-muted small"><?= html_entity_decode($file['f_description']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="<?= $download_url ?>" class="btn btn-primary w-100" <?= empty($file['f_download_link']) ? 'download' : 'target="_blank"' ?>>
                            <i class="fas fa-download me-2"></i> ڈاؤن لوڈ کریں
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Videos Section -->
<?php if (!empty($videos)): ?>
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="text-uppercase text-primary">ویڈیوز</h5>
            <h1 class="display-5 mb-0">جامعہ مدنیہ کی ویڈیوز</h1>
            <p class="fs-5 text-muted">ہماری تقریبات اور پروگرامز کی ویڈیوز</p>
        </div>
        
        <div class="row g-4">
            <?php foreach ($videos as $video): 
                $thumbnail = !empty($video['v_thumbnail']) ? BASE_URL . ABSOLUTE_IMAGEPATH . $video['v_thumbnail'] : 'img/default-video.jpg';
            ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.<?= ($index%3)+1 ?>s">
                <div class="video-card position-relative">
                    <img src="<?= $thumbnail ?>" class="img-fluid w-100 rounded" alt="<?= htmlspecialchars($video['v_title']) ?>">
                    <a href="<?= BASE_URL . ABSOLUTE_FILEPATH . $video['v_name'] ?>" class="video-play-btn" data-fancybox="video-gallery">
                        <i class="fas fa-play"></i>
                    </a>
                    <div class="p-3 bg-white">
                        <h5 class="mb-1"><?= htmlspecialchars($video['v_title']) ?></h5>
                        <?php if (!empty($video['v_description'])): ?>
                        <p class="small text-muted mb-0"><?= htmlspecialchars($video['v_description']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Gallery Section -->
<?php if (!empty($images)): ?>
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="text-uppercase text-primary">تصاویر</h5>
            <h1 class="display-5 mb-0">جامعہ مدنیہ کی گیلری</h1>
            <p class="fs-5 text-muted">ہماری تقریبات اور سرگرمیوں کی تصاویر</p>
        </div>
        
        <div class="gallery-container wow fadeIn" data-wow-delay="0.2s">
            <?php foreach ($images as $image): 
                $image_path = BASE_URL . ABSOLUTE_IMAGEPATH . $image['i_name'];
                $caption = !empty($image['i_caption']) ? $image['i_caption'] : $image['i_title'];
            ?>
            <div class="gallery-item">
                <a href="<?= $image_path ?>" data-lightbox="gallery" data-title="<?= htmlspecialchars($caption) ?>">
                    <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($image['i_alttext'] ?? $caption) ?>">
                </a>
                <?php if (!empty($caption)): ?>
                <div class="gallery-caption">
                    <h6 class="mb-0"><?= htmlspecialchars($caption) ?></h6>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// Include the additional JS if we have images
if (!empty($images) && isset($additional_js)) {
    echo $additional_js;
}
?>

<script>
// Initialize lightbox if we have images
<?php if (!empty($images)): ?>
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true,
    'showImageNumberLabel': true,
    'alwaysShowNavOnTouchDevices': true,
    'albumLabel': "تصویر %1 از %2"
});
<?php endif; ?>

// Initialize video fancybox
$('[data-fancybox="video-gallery"]').fancybox({
    type: 'iframe',
    iframe: {
        preload: false
    }
});
</script>