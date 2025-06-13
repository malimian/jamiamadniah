<!-- Blog Section Start -->
<div class="blog-section py-5 bg-light">
    <div class="container">
        <div class="blog-section-header d-flex justify-content-between align-items-center mb-5">
            <h2 class="display-5 fw-bold text-dark mb-0">Latest Blog Posts</h2>
            <a href="<?php echo BASE_URL; ?>blogs.html" class="btn btn-primary rounded-pill px-4">
                View All <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        
        <div class="row g-4">
            <?php
            $blog_posts = return_multiple_rows("SELECT * FROM pages WHERE isactive = 1 AND soft_delete = 0 
                AND template_id = 3 ORDER BY createdon DESC LIMIT 5");
            
            if (!empty($blog_posts)) {
                $featured_post = array_shift($blog_posts);
            ?>
            <!-- Featured Blog Post -->
            <div class="col-lg-12 mb-4">
                <div class="featured-blog-post card border-0 shadow-lg overflow-hidden h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <div class="position-relative h-100">
                                <img src="<?php echo getFullImageUrl($featured_post['featured_image']); ?>" 
                                     class="img-fluid h-100 w-100 object-cover" 
                                     alt="<?php echo htmlspecialchars($featured_post['page_title']); ?>">
                                <div class="position-absolute top-0 start-0 bg-primary text-white px-3 py-2">
                                    Featured Post
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body d-flex flex-column h-100 p-4 p-lg-5">
                                <div class="mb-3">
                                    <span class="badge bg-opacity-10 text-primary me-2">Blog</span>
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i>
                                        <?php echo timeAgo($featured_post['createdon']); ?>
                                    </small>
                                </div>
                                <h2 class="card-title mb-3">
                                    <a href="<?php echo $featured_post['page_url']; ?>" 
                                       class="text-dark text-decoration-none stretched-link">
                                        <?php echo $featured_post['page_title']; ?>
                                    </a>
                                </h2>
                                <p class="card-text flex-grow-1">
                                    <?php echo mb_strimwidth(strip_tags($featured_post['page_desc']), 0, 200, "..."); ?>
                                </p>
                               <?php
                                $user = return_single_row("SELECT username, fullname, profile_pic FROM loginuser WHERE soft_delete = 0 AND isactive = 1 AND id = " . intval($featured_post['createdby']));
                                ?>

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="<?php echo getFullImageUrl($user['profile_pic']); ?>" 
                                             alt="<?php echo htmlspecialchars($user['fullname']); ?>" 
                                             class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <small class="text-muted">By <?php echo htmlspecialchars($user['fullname']); ?></small>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="<?php echo $post['page_url']; ?>" class="text-primary small">
                                            Read <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <!-- Regular Blog Posts Grid -->
            <?php foreach (array_chunk($blog_posts, 2) as $post_group): ?>
            <div class="col-lg-6">
                <div class="row g-4">
                    <?php foreach ($post_group as $post): ?>
                    <div class="col-md-6">
                        <div class="blog-post-card card border-0 shadow-sm h-100">
                            <div class="position-relative">
                                <img src="<?php echo getFullImageUrl($post['featured_image']); ?>" 
                                     class="card-img-top img-fluid" 
                                     alt="<?php echo htmlspecialchars($post['page_title']); ?>">
                                <div class="card-img-overlay d-flex align-items-start justify-content-end">
                                    <span class="badge bg-opacity-10 text-primary">
                                        <small>Blog</small>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <small class="text-muted d-block mb-2">
                                    <i class="far fa-clock me-1"></i>
                                    <?php echo timeAgo($post['createdon']); ?>
                                </small>
                                <h3 class="h5 card-title mb-3">
                                    <a href="<?php echo $post['page_url']; ?>" 
                                       class="text-dark text-decoration-none stretched-link">
                                        <?php echo mb_strimwidth($post['page_title'], 0, 70, "..."); ?>
                                    </a>
                                </h3>
                                <p class="card-text text-muted small">
                                    <?php echo mb_strimwidth(strip_tags($post['page_desc']), 0, 100, "..."); ?>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0 pt-0">
                                <?php
                                $user = return_single_row("SELECT username, fullname, profile_pic FROM loginuser WHERE soft_delete = 0 AND isactive = 1 AND id = " . intval($post['createdby']));
                                ?>

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="<?php echo getFullImageUrl($user['profile_pic']); ?>" 
                                             alt="<?php echo htmlspecialchars($user['fullname']); ?>" 
                                             class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <small class="text-muted">By <?php echo htmlspecialchars($user['fullname']); ?></small>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="<?php echo $post['page_url']; ?>" class="text-primary small">
                                            Read <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
    .blog-section {
        background-color: #f8f9fa;
    }
    
    .featured-blog-post {
        transition: transform 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .featured-blog-post:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
    }
    
    .featured-blog-post .card-body {
        background: white;
    }
    
    .blog-post-card {
        transition: all 0.3s ease;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .blog-post-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;
    }
    
    .blog-post-card .card-img-top {
        height: 180px;
        object-fit: cover;
    }
    
    .object-cover {
        object-fit: cover;
    }
    
    @media (max-width: 992px) {
        .featured-blog-post .row {
            flex-direction: column;
            height: auto !important;
        }
        
        .featured-blog-post .col-md-6 {
            width: 100%;
        }
        
        .featured-blog-post .card-body {
            padding: 2rem;
        }
    }
    
    @media (max-width: 768px) {
        .blog-post-card .card-img-top {
            height: 150px;
        }
        
        .blog-section-header h2 {
            font-size: 1.8rem;
        }
    }
</style>
<!-- Blog Section End -->
