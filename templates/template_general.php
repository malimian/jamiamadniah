<section>
    <!-- Hero Header with Parallax Effect -->
    <div class="container-fluid hero-header py-5 mb-5 bg-dark position-relative">
        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-75" 
             style="background: url('<?= $content['featured_image'] ?? 'https://via.placeholder.com/1920x500' ?>') center center no-repeat; background-size: cover; background-attachment: fixed;"></div>
        <div class="container py-5 position-relative z-index-1">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white mb-4 animate__animated animate__fadeInDown"><?= htmlspecialchars($content['page_title']) ?></h1>
                    
                    <nav aria-label="breadcrumb" class="animate__animated animate__fadeInUp">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item">
                                <a class="text-white-50" href="<?= BASE_URL ?>">
                                    <i class="fas fa-home me-1"></i> Home
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-white-50" href="<?= replace_sysvari($content['cat_url']) ?>">
                                    <?= htmlspecialchars(replace_sysvari($content['catname'])) ?>
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-white" aria-current="page">
                                <?= htmlspecialchars($content['page_title']) ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <article class="card border-1 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                            <div class="article-content">
                                <?= replace_sysvari(remove_non_utf($content['page_desc']), getcwd()."/") ?>
                            </div>
                    </div>
                    
                    <!-- Article Footer Meta -->
                    <div class="card-footer bg-transparent border-top">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <div class="d-flex align-items-center me-3">
                                    <i class="far fa-eye me-2 text-muted"></i>
                                    <span class="text-muted"><?= $content['views'] ?? 0 ?> views</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="far fa-clock me-2 text-muted"></i>
                                    <span class="text-muted"><?= date('F j, Y', strtotime($content['createdon'])) ?></span>
                                </div>
                            </div>
                            
                            <div class="social-share">
                                <span class="me-2 text-muted">Share:</span>
                                <a href="{FACEBOOK}" class="btn btn-sm btn-outline-secondary me-2">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{TWITTER}" class="btn btn-sm btn-outline-secondary me-2">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{LINKEDIN}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<style>
    .hero-header {
        min-height: 400px;
        display: flex;
        align-items: center;
    }
    .z-index-1 {
        z-index: 1;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        margin: 1.5rem 0;
        border-radius: 0.375rem;
    }
    .article-content iframe {
        max-width: 100%;
        margin: 1.5rem 0;
    }
</style>