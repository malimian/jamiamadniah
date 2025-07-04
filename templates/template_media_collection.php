<?php
// Get current page ID
$pid = $content['pid'];

// Pagination variables
$items_per_page = 10; // Number of items per page
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($current_page - 1) * $items_per_page;

// Section filter
$section_filter = isset($_GET['section']) ? clean($_GET['section']) : '';

// Fetch data from all tables with pagination and filtering
$files_where = "isactive = 1 AND soft_delete = 0 AND pid = $pid";
$videos_where = "isactive = 1 AND soft_delete = 0 AND pid = $pid";
$images_where = "isactive = 1 AND soft_delete = 0 AND pid = $pid";

if (!empty($section_filter)) {
    $files_where .= " AND section_name = '" . escape($section_filter) . "'";
    $videos_where .= " AND section_name = '" . escape($section_filter) . "'";
    $images_where .= " AND section_name = '" . escape($section_filter) . "'";
}

// Get total counts for pagination
$total_files = return_single_ans("SELECT COUNT(*) FROM page_files WHERE $files_where");
$total_videos = return_single_ans("SELECT COUNT(*) FROM videos WHERE $videos_where");
$total_images = return_single_ans("SELECT COUNT(*) FROM images WHERE $images_where");

// Fetch data with pagination
$files = return_multiple_rows("SELECT * FROM page_files WHERE $files_where ORDER BY f_sequence LIMIT $offset, $items_per_page");
$videos = return_multiple_rows("SELECT * FROM videos WHERE $videos_where ORDER BY v_sequence LIMIT $offset, $items_per_page");
$images = return_multiple_rows("SELECT * FROM images WHERE $images_where ORDER BY i_sequence LIMIT $offset, $items_per_page");

// Get unique sections for filter dropdown
$all_sections = array_merge(
    return_multiple_rows("SELECT DISTINCT section_name FROM page_files WHERE pid = $pid AND section_name IS NOT NULL AND section_name != ''"),
    return_multiple_rows("SELECT DISTINCT section_name FROM videos WHERE pid = $pid AND section_name IS NOT NULL AND section_name != ''"),
    return_multiple_rows("SELECT DISTINCT section_name FROM images WHERE pid = $pid AND section_name IS NOT NULL AND section_name != ''")
);

?>
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
        height: auto;
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
    
    /* Filter and pagination styles */
    .section-filter {
        max-width: 300px;
        margin: 0 auto 30px;
    }
    
    .section-filter select {
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #ced4da;
        font-size: 14px;
        width: 100%;
    }
    
    .pagination {
        justify-content: center;
        margin-top: 30px;
    }
    
    .page-item.active .page-link {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }
    
    .page-link {
        color: var(--bs-primary);
    }
    
    /* Video container */
    .video-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
        margin-top: 0 !important; /* Add this line to ensure no top margin */
    }
    
    .video-container video {
            width: 100%;
            height: auto;
            display: block;
        }
        .video-card img {
            border: 1px solid #ddd;
            border-radius: 8px;
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
        
        .section-filter {
            max-width: 100%;
        }
    }

      /* Improved Video Container Styles */
    .video-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
        margin-top: 0;
        background: #000;
    }
    
    .video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
        border-radius: 0;
    }
    
    /* Custom video controls */
    .video-container video::-webkit-media-controls {
        display: flex !important;
    }
    
    .video-container video::-webkit-media-controls-panel {
        background: rgba(0,0,0,0.7);
        color: white;
    }
    
    .video-container video::-webkit-media-controls-play-button,
    .video-container video::-webkit-media-controls-volume-slider,
    .video-container video::-webkit-media-controls-mute-button {
        color: white;
        filter: brightness(0) invert(1);
    }
    
    .video-container video::-webkit-media-controls-current-time-display,
    .video-container video::-webkit-media-controls-time-remaining-display {
        color: white;
        font-size: 12px;
    }
    
    /* Video card adjustments */
    .video-card {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        background: white;
    }
    
    .video-card img {
        width: 100%;
        height: auto;
        display: block;
        border: none;
        border-radius: 0;
        border-bottom: 1px solid #eee;
    }
</style>

<?php
$additional_js = "";
$additional_css = "";
// Add lightbox CSS/JS if we have images
if (!empty($images)) {
    $additional_css .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">';
    $additional_js .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>';
}

echo $additional_css;
echo $additional_js;

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

<!-- Section Filter -->
<?php if (!empty($all_sections)): ?>
<div class="container mt-4 py-5">
    <div class="section-filter">
        <form method="get">
            <select name="section" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">All Sections</option>
                <?php foreach ($all_sections as $section): 
                    if (!empty($section['section_name'])): ?>
                    <option value="<?= htmlspecialchars($section['section_name']) ?>" <?= $section_filter == $section['section_name'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($section['section_name']) ?>
                    </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
</div>
<?php endif; ?>

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
<!-- Main Featured Video Section -->
<section class="py-5 bg-light" id="intro-video">
    <div class="container py-5">
        <div class="row align-items-center">
            <?php 
            // Get the first video as featured video
            $main_video = $videos[0];
            $video_path = BASE_URL . ABSOLUTE_VIDEOPATH . $main_video['v_name'];
            $is_mp4 = strtolower(pathinfo($main_video['v_name'], PATHINFO_EXTENSION)) === 'mp4';
            ?>
            
            <div class="col-lg-6 mb-5 mb-lg-0 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative rounded overflow-hidden">
                    <?php if (!empty($main_video['v_thumbnail'])): ?>
                        <!-- Video Thumbnail with Play Button -->
                        <img src="<?= BASE_URL . ABSOLUTE_IMAGEPATH . $main_video['v_thumbnail'] ?>" class="img-fluid w-100 rounded shadow" alt="<?= htmlspecialchars($main_video['v_title']) ?>">
                    <?php else: ?>
                        <!-- Default thumbnail if no thumbnail exists -->
                        <div class="img-fluid w-100 rounded shadow bg-secondary d-flex align-items-center justify-content-center" style="height: 350px;">
                            <i class="fas fa-video fa-5x text-white"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="video-play-button">
                        <a href="#" class="video-popup-btn" data-bs-toggle="modal" data-bs-target="#videoModal">
                            <i class="fas fa-play"></i>
                        </a>
                    </div>
                    
                    <!-- Video Stats -->
                    <div class="video-stats bg-primary text-white p-3 rounded-bottom">
                        <div class="row text-center">
                            <div class="col-4 border-end border-white">
                                <h4 class="mb-0"><?= isset($main_video['views']) ? $main_video['views'] : '1.2K' ?></h4>
                                <small>Views</small>
                            </div>
                            <div class="col-4 border-end border-white">
                                <h4 class="mb-0"><?= isset($main_video['likes']) ? $main_video['likes'] : '95' ?></h4>
                                <small>Likes</small>
                            </div>
                            <div class="col-4">
                                <h4 class="mb-0"><?= isset($main_video['shares']) ? $main_video['shares'] : '24' ?></h4>
                                <small>Shares</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="ps-lg-5">
                    <?php if (!empty($main_video['section_name'])): ?>
                        <h5 class="text-uppercase text-primary mb-3"><?= htmlspecialchars($main_video['section_name']) ?></h5>
                    <?php endif; ?>
                    
                    <h1 class="display-5 mb-4"><?= htmlspecialchars($main_video['v_title']) ?></h1>
                    
                    <?php if (!empty($main_video['v_description'])): ?>
                        <p class="mb-4"><?= htmlspecialchars($main_video['v_description']) ?></p>
                    <?php endif; ?>
                    
                    <a href="<?= $video_path ?>" class="btn btn-primary py-3 px-4 me-2" download>
                        <i class="fas fa-download me-2"></i> Download Video
                    </a>
                    <a href="#" class="btn btn-outline-primary py-3 px-4">
                        <i class="fas fa-share-alt me-2"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel"><?= htmlspecialchars($main_video['v_title']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-16x9">
                    <?php if ($is_mp4): ?>
                        <video id="introVideo" controls class="w-100">
                            <source src="<?= $video_path ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php else: ?>
                        <!-- For non-MP4 videos, you might want to use an iframe or other player -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?= $video_path ?>" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- All Videos Section -->
<section class="py-5">
    <div class="container py-5">
        <?php 
        // Group videos by section
        $grouped_videos = [];
        foreach ($videos as $video) {
            $section = !empty($video['section_name']) ? $video['section_name'] : 'Other Videos';
            $grouped_videos[$section][] = $video;
        }
        
        // Remove the featured video from the grouped array
        $featured_section = !empty($main_video['section_name']) ? $main_video['section_name'] : 'Other Videos';
        if (isset($grouped_videos[$featured_section])) {
            $grouped_videos[$featured_section] = array_filter($grouped_videos[$featured_section], function($v) use ($main_video) {
                return $v['v_id'] !== $main_video['v_id'];
            });
            
            // Remove section if empty
            if (empty($grouped_videos[$featured_section])) {
                unset($grouped_videos[$featured_section]);
            }
        }
        ?>
        
        <?php foreach ($grouped_videos as $section_name => $section_videos): ?>
            <?php if (!empty($section_videos)): ?>
                <div class="mb-5 wow fadeInUp">
                    <h2 class="text-primary mb-4"><?= htmlspecialchars($section_name) ?></h2>
                    <div class="row g-4">
                        <?php foreach ($section_videos as $index => $video): 
                            $video_path = BASE_URL . ABSOLUTE_VIDEOPATH . $video['v_name'];
                            $is_mp4 = strtolower(pathinfo($video['v_name'], PATHINFO_EXTENSION)) === 'mp4';
                        ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.<?= ($index%3)+1 ?>s">
                            <div class="video-card h-100">
                                <?php if (!empty($video['v_thumbnail'])): ?>
                                    <img src="<?= BASE_URL . ABSOLUTE_IMAGEPATH . $video['v_thumbnail'] ?>" class="img-fluid w-100 rounded-top" alt="<?= htmlspecialchars($video['v_title']) ?>">
                                <?php else: ?>
                                    <div style="height: 200px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                        <div class="text-center p-3">
                                            <i class="fa fa-video-camera fa-3x text-muted"></i>
                                            <p class="mt-2">No thumbnail</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="p-3">
                                    <h5 class="mb-1"><?= htmlspecialchars($video['v_title']) ?></h5>
                                    <?php if (!empty($video['v_description'])): ?>
                                    <p class="small text-muted mb-2"><?= htmlspecialchars($video['v_description']) ?></p>
                                    <?php endif; ?>
                                    
                                    <div class="text-center mt-2">
                                        <?php if ($is_mp4): ?>
                                            <a href="<?= $video_path ?>" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#videoModal<?= $video['v_id'] ?>">
                                                <i class="fas fa-play me-1"></i> Play Video
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= $video_path ?>" data-fancybox="video-gallery" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-play me-1"></i> Play Video
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Individual Video Modal for MP4 videos -->
                            <?php if ($is_mp4): ?>
                            <div class="modal fade" id="videoModal<?= $video['v_id'] ?>" tabindex="-1" aria-labelledby="videoModalLabel<?= $video['v_id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="videoModalLabel<?= $video['v_id'] ?>"><?= htmlspecialchars($video['v_title']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ratio ratio-16x9">
                                                <video controls class="w-100">
                                                    <source src="<?= $video_path ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        
        <!-- Pagination -->
        <?php if ($total_videos > $items_per_page): ?>
        <nav aria-label="Videos pagination">
            <ul class="pagination">
                <?php if ($current_page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $current_page-1 ?><?= !empty($section_filter) ? '&section='.urlencode($section_filter) : '' ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= ceil($total_videos / $items_per_page); $i++): ?>
                <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?><?= !empty($section_filter) ? '&section='.urlencode($section_filter) : '' ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                
                <?php if ($current_page < ceil($total_videos / $items_per_page)): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $current_page+1 ?><?= !empty($section_filter) ? '&section='.urlencode($section_filter) : '' ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</section>

<style>
/* Custom CSS for Video Section */
.video-play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 10;
}

.video-play-button a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(5px);
    border-radius: 50%;
    color: white;
    font-size: 30px;
    transition: all 0.3s ease;
}

.video-play-button a:hover {
    background: var(--bs-primary);
    transform: scale(1.1);
}

.video-stats {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.7);
    transition: all 0.3s ease;
}

.video-popup-btn:hover + .video-stats {
    opacity: 0;
}

.video-card {
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
}

.video-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

@media (max-width: 767.98px) {
    .video-play-button a {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }
}

/* Video player styling */
#introVideo {
    background-color: #000;
    border-radius: 8px;
    overflow: hidden;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Main featured video modal
    var videoModal = document.getElementById('videoModal');
    var video = document.getElementById('introVideo');
    
    if (video) {
        videoModal.addEventListener('show.bs.modal', function () {
            // Play video when modal opens
            video.play();
        });
        
        videoModal.addEventListener('hide.bs.modal', function () {
            // Pause video when modal closes
            video.pause();
            // Reset video to beginning
            video.currentTime = 0;
        });
    }
    
    // Handle download button
    document.querySelector('[download]').addEventListener('click', function(e) {
        // You can add download tracking here if needed
        console.log('Video download initiated');
    });
    
    // Initialize all video modals
    var videoModals = document.querySelectorAll('.modal video');
    videoModals.forEach(function(videoEl) {
        var modalId = videoEl.closest('.modal').id;
        var modal = document.getElementById(modalId);
        
        modal.addEventListener('show.bs.modal', function() {
            videoEl.play();
        });
        
        modal.addEventListener('hide.bs.modal', function() {
            videoEl.pause();
            videoEl.currentTime = 0;
        });
    });
});
</script>
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
                    <?php if (!empty($image['section_name'])): ?>
                    <p class="small mb-0"><?= htmlspecialchars($image['section_name']) ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination -->
        <?php if ($total_images > $items_per_page): ?>
        <nav aria-label="Images pagination">
            <ul class="pagination">
                <?php if ($current_page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $current_page-1 ?><?= !empty($section_filter) ? '&section='.urlencode($section_filter) : '' ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= ceil($total_images / $items_per_page); $i++): ?>
                <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?><?= !empty($section_filter) ? '&section='.urlencode($section_filter) : '' ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                
                <?php if ($current_page < ceil($total_images / $items_per_page)): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $current_page+1 ?><?= !empty($section_filter) ? '&section='.urlencode($section_filter) : '' ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>
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
$(document).ready(function() {
    $('[data-fancybox="video-gallery"]').fancybox({
        type: 'iframe',
        iframe: {
            preload: false,
            // For MP4 videos, we'll use HTML5 video player
            tpl: '<div class="fancybox-container"><div class="fancybox-inner"><div class="fancybox-content"></div></div></div>'
        },
        beforeLoad: function(instance, slide) {
            var url = slide.src;
            var ext = url.split('.').pop().toLowerCase();
            
            // If it's an MP4 video, use HTML5 video tag
            if (ext === 'mp4') {
                slide.type = 'html';
                slide.content = '<video class="fancybox-video" controls autoplay>' +
                               '<source src="' + url + '" type="video/mp4">' +
                               'Your browser does not support the video tag.' +
                               '</video>';
            }
        },
        afterShow: function(instance, slide) {
            // Autoplay videos when opened
            if (slide.type === 'html') {
                var video = $('.fancybox-video')[0];
                if (video) video.play();
            }
        }
    });
});
</script>