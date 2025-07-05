<?php
if(!function_exists("header_t")) {
    function header_t(){
        return '
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <style>
            .blog-single {
                padding: 80px 0;
            }
            .article-img img {
                width: 100%;
                border-radius: 8px;
                margin-bottom: 20px;
            }
            .article-title h2 {
                font-size: 2.2rem;
                margin-bottom: 20px;
                font-weight: 700;
            }
            .media .avatar img {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                object-fit: cover;
                margin-right: 15px;
            }
            .media-body label {
                font-weight: 600;
                margin-bottom: 0;
            }
            .media-body span {
                color: #6c757d;
                font-size: 0.9rem;
            }
            .article-content {
                line-height: 1.8;
                font-size: 1.1rem;
                color: #495057;
                margin: 30px 0;
            }
             .article-content img {
                  max-width: 100%;
                  height: auto;
                  display: block;
                }
            .nav.tag-cloud {
                margin: 30px 0;
            }
            .nav.tag-cloud a {
                display: inline-block;
                padding: 5px 15px;
                background: #f8f9fa;
                border-radius: 30px;
                margin: 0 5px 10px 0;
                color: #495057;
                text-decoration: none;
                transition: all 0.3s;
            }
            .nav.tag-cloud a:hover {
                background: #0d6efd;
                color: white;
            }
            .blog-aside {
                position: sticky;
                top: 20px;
            }
            .widget {
                background: #fff;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 30px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            }
            .widget-title {
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
            }
            .widget-title h3 {
                font-size: 1.3rem;
                font-weight: 600;
            }
            .latest-post-aside {
                margin-bottom: 15px;
                padding-bottom: 15px;
                border-bottom: 1px solid #eee;
            }
            .latest-post-aside:last-child {
                margin-bottom: 0;
                padding-bottom: 0;
                border-bottom: 0;
            }
            .lpa-title h5 {
                font-size: 1rem;
                margin-bottom: 5px;
            }
            .lpa-meta {
                font-size: 0.8rem;
                color: #6c757d;
            }
            .lpa-right img {
                width: 80px;
                height: 60px;
                object-fit: cover;
                border-radius: 4px;
            }
            .contact-form {
                background: #fff;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
                margin-top: 40px;
            }
            .contact-form h4 {
                margin-bottom: 20px;
                font-weight: 600;
            }
            .img-thumbnail {
                margin-bottom: 15px;
                transition: transform 0.3s;
            }
            .img-thumbnail:hover {
                transform: scale(1.03);
            }
            .modal-lg .modal-content {
                border-radius: 0;
                border: none;
            }
            #image-gallery-image {
                width: 100%;
                height: auto;
            }
            .author-card {
                background: #f8f9fa;
                border-radius: 8px;
                padding: 20px;
                margin: 30px 0;
            }
            .author-avatar {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                object-fit: cover;
                margin-right: 20px;
            }
            .author-meta {
                margin-top: 15px;
            }
            .author-meta a {
                color: #495057;
                margin-right: 15px;
                text-decoration: none;
            }
            .author-meta a:hover {
                color: #0d6efd;
            }
            @media (max-width: 768px) {
                .blog-single {
                    padding: 40px 0;
                }
                .article-title h2 {
                    font-size: 1.8rem;
                }
                .media .avatar img {
                    width: 50px;
                    height: 50px;
                }
            }
        </style>';
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

<?php 
$user = return_single_row("Select username, fullname, profile_pic, details, emailaddress, website, company, company_title, country, city, state, address, phonenumber, mobile_phone from loginuser Where soft_delete = 0 and isactive = 1 and id = ".$content['createdby']);
$news_categories = return_multiple_rows("SELECT * FROM category WHERE catid = ".$content['catid']);
?>

<div class="blog-single bg-light" style=" padding-top: 17rem">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
                <?php if (!empty($news_categories)) { ?>
                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL . $news_categories[0]['cat_url']; ?>"><?php echo $news_categories[0]['catname']; ?></a></li>
                <?php } ?>
                <li class="breadcrumb-item active"><?php echo replace_sysvari($content['page_title']); ?></li>
            </ol>
        </nav>
        
        <div class="row g-4">
            <div class="col-lg-8">
                <article class="article bg-white p-4 rounded shadow-sm">
                    <?php if(!empty($content['featured_image'])): ?>
                    <div class="article-img">
                        <img class="img-fluid" src="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image'];?>" title="<?php echo $content['page_title'];?>" alt="<?php echo $content['page_title'];?>">
                        <?php if(!empty($news_categories)): ?>
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3"><?php echo $news_categories[0]['catname']; ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="article-title">
                        <h1 class="mb-3"><?php echo replace_sysvari($content['page_title']);?></h1>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <?php if(!empty($user['profile_pic'])): ?>
                                <img src="<?php echo ABSOLUTE_IMAGEPATH.$user['profile_pic'];?>" class="author-avatar me-3" alt="<?php echo $user['fullname'] ?? $user['username']; ?>">
                                <?php endif; ?>
                                <div>
                                    <h6 class="mb-0 fw-bold"><?php echo $user['fullname'] ?? $user['username']; ?></h6>
                                    <small class="text-muted">
                                        <?php 
                                        $dt = new DateTime($content['createdon']);
                                        $date = $dt->format('d F Y');
                                        echo $date;
                                        ?>
                                        <span class="mx-2">•</span>
                                        <i class="far fa-clock me-1"></i> <?php echo $content['article_read'] ?? '5 min read'; ?>
                                        <span class="mx-2">•</span>
                                        <i class="far fa-eye me-1"></i> <?php echo $content['views'] ?? '0'; ?> views
                                    </small>
                                </div>
                            </div>
                            
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="shareDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-share-alt me-1"></i> Share
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="shareDropdown">
                                    <li><a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u=<?=BASE_URL?><?php echo $content['page_url']?>" target="_blank"><i class="fab fa-facebook-f me-2"></i> Facebook</a></li>
                                    <li><a class="dropdown-item" href="https://twitter.com/intent/tweet?url=<?=BASE_URL?><?php echo $content['page_url']?>&text=<?php echo urlencode($content['page_title']); ?>" target="_blank"><i class="fab fa-twitter me-2"></i> Twitter</a></li>
                                    <li><a class="dropdown-item" href="https://www.linkedin.com/shareArticle?mini=true&url=<?=BASE_URL?><?php echo $content['page_url']?>" target="_blank"><i class="fab fa-linkedin-in me-2"></i> LinkedIn</a></li>
                                    <li><a class="dropdown-item" href="https://api.whatsapp.com/send?text=<?=BASE_URL?><?php echo $content['page_url']?>" target="_blank"><i class="fab fa-whatsapp me-2"></i> WhatsApp</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="article-content">
                        <?php if($PAGE_LOADER == 1): ?>
                            <div id="div_content"></div>
                        <?php else: ?>
                            <?php echo replace_sysvari($content['page_desc'], getcwd()."/"); ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Gallery Section -->
                    <?php
                        $photogallery = return_multiple_rows("Select * from images Where pid = ".$content['pid']." and isactive = 1 and soft_delete = 0");
                        if(!empty($photogallery)):
                    ?>
                    <div class="mt-5">
                        <h4 class="mb-4">Gallery</h4>
                        <div class="row g-3">
                            <?php foreach($photogallery as $index => $photogallery_): ?>
                            <div class="col-md-4 col-6">
                                <a href="#" class="gallery-item" data-bs-toggle="modal" data-bs-target="#imageGalleryModal" 
                                   data-image="<?php echo ABSOLUTE_IMAGEPATH.$photogallery_['i_name']; ?>"
                                   data-title="<?php echo $content['page_title']; ?>"
                                   data-index="<?php echo $index; ?>">
                                    <img class="img-thumbnail" 
                                         src="<?php echo ABSOLUTE_IMAGEPATH.$photogallery_['i_name']; ?>"
                                         alt="<?php echo $photogallery_['i_name']; ?>">
                                </a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Tags Section -->
                    <?php 
                        $keywords = return_single_ans("Select page_meta_keywords from pages Where pid = ".$content['pid']);
                        $keywords = explode(',', $keywords);
                        $hasKeywords = false;
                        foreach ($keywords as $keyword) {
                            if(!empty(trim($keyword))) {
                                $hasKeywords = true;
                                break;
                            }
                        }
                    ?>
                    <?php if($hasKeywords): ?>
                    <div class="nav tag-cloud mt-5">
                        <h5 class="mb-3">Tags:</h5>
                        <?php 
                            foreach ($keywords as $keyword) {
                                if(!empty(trim($keyword))) {
                                    echo '<a href="'.BASE_URL.'search.php?q='.urlencode(trim($keyword)).'">'.trim($keyword).'</a>';
                                }
                            }
                        ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Author Card -->
                    <div class="author-card mt-5">
                        <div class="row align-items-center">
                            <?php if(!empty($user['profile_pic'])): ?>
                            <div class="col-md-2 col-3">
                                <img src="<?php echo ABSOLUTE_IMAGEPATH.$user['profile_pic']; ?>" class="author-avatar img-fluid" alt="<?php echo $user['fullname'] ?? $user['username']; ?>">
                            </div>
                            <?php endif; ?>
                            <div class="<?php echo !empty($user['profile_pic']) ? 'col-md-10 col-9' : 'col-12'; ?>">
                                <h4 class="mb-2"><?php echo $user['fullname'] ?? $user['username']; ?></h4>
                                <?php if(!empty($user['company_title']) || !empty($user['company'])): ?>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-briefcase me-1"></i>
                                    <?php echo $user['company_title'] ?? ''; ?>
                                    <?php if(!empty($user['company'])): ?>
                                        at <?php echo $user['company']; ?>
                                    <?php endif; ?>
                                </p>
                                <?php endif; ?>
                                
                                <?php if(!empty($user['details'])): ?>
                                <p class="mb-3"><?php echo nl2br($user['details']); ?></p>
                                <?php endif; ?>
                                
                                <div class="author-meta">
                                    <?php if(!empty($user['emailaddress'])): ?>
                                    <a href="mailto:<?php echo $user['emailaddress']; ?>"><i class="fas fa-envelope me-1"></i> Email</a>
                                    <?php endif; ?>
                                    <?php if(!empty($user['website'])): ?>
                                    <a href="<?php echo $user['website']; ?>" target="_blank"><i class="fas fa-globe me-1"></i> Website</a>
                                    <?php endif; ?>
                                    <?php if(!empty($user['phonenumber'])): ?>
                                    <a href="tel:<?php echo $user['phonenumber']; ?>"><i class="fas fa-phone me-1"></i> <?php echo $user['phonenumber']; ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related Posts -->
                    <div class="mt-5">
                        <h4 class="mb-4">You May Also Like</h4>
                        <div class="row g-4">
                            <?php
                            $similar_articles = return_multiple_rows("
                                SELECT p.*, c.catname, c.cat_url
                                FROM pages p
                                LEFT JOIN category c ON p.catid = c.catid
                                WHERE p.template_id = ".$content['template_id']." 
                                  AND p.isactive = 1 
                                  AND p.soft_delete = 0 
                                  AND p.pid != ".$content['pid']."
                                ORDER BY RAND()
                                LIMIT 3
                            ");
                            
                            foreach ($similar_articles as $article):
                                $article_image = !empty($article['featured_image']) ? ABSOLUTE_IMAGEPATH.$article['featured_image'] : ABSOLUTE_IMAGEPATH.'default-article-image.jpg';
                            ?>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <img src="<?php echo $article_image; ?>" class="card-img-top" alt="<?php echo $article['page_title']; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="<?php echo BASE_URL.$article['page_url']; ?>" class="text-decoration-none"><?php echo mb_strimwidth($article['page_title'], 0, 60, '...'); ?></a></h5>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i> <?php echo timeAgo($article['createdon']); ?></small>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Comments Section -->
                    <div class="contact-form mt-5">
                        <h4>Leave a Reply</h4>
                        {comments}
                    </div>
                </article>
  <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Search Widget -->
                <div class="widget">
                    <form action="search.php" method="get">
                        <div class="input-group mb-3">
                            <input type="text" name="q" class="form-control" placeholder="Search..." required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                
                <!-- Latest Posts Widget -->
                <div class="widget">
                    <div class="widget-title">
                        <h3>Latest Posts</h3>
                    </div>
                    <div class="widget-body">
                        <?php 
                        $latest_posts = return_multiple_rows("
                            SELECT p.*, c.catname 
                            FROM pages p
                            LEFT JOIN category c ON p.catid = c.catid
                            WHERE p.soft_delete = 0 AND p.isactive = 1 AND p.template_id = ".$content['template_id']." 
                            ORDER BY p.createdon DESC LIMIT 5
                        ");
                        
                        foreach ($latest_posts as $post): 
                            $post_image = !empty($post['featured_image']) ? ABSOLUTE_IMAGEPATH.$post['featured_image'] : ABSOLUTE_IMAGEPATH.'default-article-image.jpg';
                        ?>
                        <div class="latest-post-aside d-flex mb-3">
                            <div class="flex-shrink-0">
                                <img src="<?php echo $post_image; ?>" alt="<?php echo $post['page_title']; ?>" width="80" class="rounded">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1"><a href="<?php echo $post['page_url']; ?>" class="text-decoration-none"><?php echo mb_strimwidth($post['page_title'], 0, 50, '...'); ?></a></h6>
                                <small class="text-muted">
                                    <?php 
                                    $dt = new DateTime($post['createdon']);
                                    echo $dt->format('M d, Y');
                                    ?>
                                </small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Tags Widget -->
                <div class="widget">
                    <div class="widget-title">
                        <h3>Popular Tags</h3>
                    </div>
                    <div class="widget-body">
                        <div class="d-flex flex-wrap gap-2">
                            <?php
                            $keyword_rows = return_multiple_rows("
                                SELECT page_meta_keywords 
                                FROM pages 
                                WHERE page_meta_keywords IS NOT NULL 
                                  AND page_meta_keywords != ''
                                  AND catid = ".$content['catid']."
                                LIMIT 30
                            ");
                            
                            $all_tags = [];
                            foreach ($keyword_rows as $row) {
                                $tags = explode(',', $row['page_meta_keywords']);
                                foreach ($tags as $tag) {
                                    $tag = trim($tag);
                                    if (!empty($tag)) {
                                        if (!isset($all_tags[$tag])) {
                                            $all_tags[$tag] = 0;
                                        }
                                        $all_tags[$tag]++;
                                    }
                                }
                            }
                            
                            // Sort tags by frequency
                            arsort($all_tags);
                            
                            // Display top 20 tags
                            $count = 0;
                            foreach ($all_tags as $tag => $frequency) {
                                if ($count >= 20) break;
                                echo '<a href="'.BASE_URL.'search.php?q='.urlencode($tag).'" class="btn btn-sm btn-outline-secondary">'.$tag.'</a>';
                                $count++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media Widget -->
                <div class="widget">
                    <div class="widget-title">
                        <h3>Follow Us</h3>
                    </div>
                    <div class="widget-body">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{FACEBOOK}" class="btn btn-primary btn-sm"><i class="fab fa-facebook-f"></i></a>
                            <a href="{TWITTER}" class="btn btn-info btn-sm"><i class="fab fa-twitter"></i></a>
                            <a href="{INSTAGRAM}" class="btn btn-danger btn-sm"><i class="fab fa-instagram"></i></a>
                            <a href="{LINKEDIN}" class="btn btn-primary btn-sm"><i class="fab fa-linkedin-in"></i></a>
                            <a href="{YOUTUBE}" class="btn btn-danger btn-sm"><i class="fab fa-youtube"></i></a>
                            <a href="{PINTEREST}" class="btn btn-danger btn-sm"><i class="fab fa-pinterest-p"></i></a>
                        </div>
                    </div>
                </div>
            </div>        </div>
    </div>
</div>

<!-- Image Gallery Modal -->
<div class="modal fade" id="imageGalleryModal" tabindex="-1" aria-labelledby="imageGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageGalleryModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" id="prevImage"><i class="fas fa-chevron-left me-2"></i> Previous</button>
                <button type="button" class="btn btn-secondary" id="nextImage">Next <i class="fas fa-chevron-right ms-2"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
    // Image Gallery Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const galleryItems = document.querySelectorAll('.gallery-item');
        const modal = new bootstrap.Modal(document.getElementById('imageGalleryModal'));
        const modalTitle = document.getElementById('imageGalleryModalLabel');
        const modalImage = document.getElementById('modalImage');
        const prevBtn = document.getElementById('prevImage');
        const nextBtn = document.getElementById('nextImage');
        
        let currentIndex = 0;
        const images = [];
        
        // Collect all gallery images
        galleryItems.forEach((item, index) => {
            images.push({
                src: item.dataset.image,
                title: item.dataset.title
            });
            
            item.addEventListener('click', function(e) {
                e.preventDefault();
                currentIndex = parseInt(item.dataset.index);
                updateModal(currentIndex);
                modal.show();
            });
        });
        
        // Update modal content
        function updateModal(index) {
            modalImage.src = images[index].src;
            modalTitle.textContent = images[index].title;
            
            // Update button states
            prevBtn.disabled = index === 0;
            nextBtn.disabled = index === images.length - 1;
        }
        
        // Navigation buttons
        prevBtn.addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateModal(currentIndex);
            }
        });
        
        nextBtn.addEventListener('click', function() {
            if (currentIndex < images.length - 1) {
                currentIndex++;
                updateModal(currentIndex);
            }
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!modal._element.classList.contains('show')) return;
            
            if (e.key === 'ArrowLeft' && currentIndex > 0) {
                currentIndex--;
                updateModal(currentIndex);
            } else if (e.key === 'ArrowRight' && currentIndex < images.length - 1) {
                currentIndex++;
                updateModal(currentIndex);
            }
        });
    });
</script>