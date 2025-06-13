<?php
if(!function_exists("header_t")) {
    function header_t(){
        return '
        <style>

                .author-avatar {
                    width: 100%;
                    max-width: 100px;
                    height: auto;
                    object-fit: cover;
                }
                    @media (max-width: 576px) {
                        .author-card .card-body {
                            padding: 1rem !important;
                        }

                        .author-card h2 {
                            font-size: 1.25rem;
                        }

                        .author-meta {
                            flex-direction: column;
                            gap: 0.5rem !important;
                        }

                        .author-meta div {
                            width: 100%;
                        }
                    }
                .author-bio {
                    font-size: 0.95rem;
                    line-height: 1.7;
                    color: #495057;
                }
                .author-card {
                    transition: transform 0.3s ease;
                }
                .author-card:hover {
                     transform: translateY(-5px);
                }
                .author-meta a {
                    color: #495057;
                    transition: color 0.2s;
                }
                    .author-meta a:hover {
                    color: #0d6efd;
                }
                .news-article img {
                  max-width: 100%;
                  height: auto;
                  display: block;
                }

                .avatar-circle {
                    width: 100%;
                    max-width: 100px;
                    aspect-ratio: 1 / 1;
                    border-radius: 50%;
                    object-fit: cover;
                    overflow: hidden;
                }

                iframe[src*="youtube.com"] {
                  width: 100% !important;
                  height: auto !important;
                  aspect-ratio: 16 / 9;
                  border: 0;
                  max-width: 100%;
                  border-radius: 0.5rem; /* optional */
                  display: block;
                }
                .wp-post-image{
                    display:none !important;
                } 
        </style>
        ';
    }
}
?>

<?php
if(!function_exists("menu_t")) {
    function menu_t(){
        return '
        ';
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
$user = return_single_row("SELECT username, fullname, profile_pic, details, emailaddress, website, company, company_title, country, city, state, address, phonenumber, mobile_phone FROM loginuser WHERE soft_delete = 0 AND isactive = 1 AND id = ".$content['pages_createdby'] );

$news_categories = return_multiple_rows("SELECT * FROM category WHERE catid = ".$content['catid']);

?>

<!-- Single Product Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <ol class="breadcrumb justify-content-start mb-4">
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
            <?php if (!empty($news_categories)) { ?>
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL . $news_categories[0]['cat_url']; ?>"><?php echo $news_categories[0]['catname']; ?></a></li>
            <?php } ?>
            <li class="breadcrumb-item active text-dark"><?php echo replace_sysvari($content['page_title']); ?></li>
        </ol>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="mb-4">
                    <a href="#" class="h1 display-5"><?php echo replace_sysvari($content['page_title']); ?></a>
                </div>
                <div class="position-relative rounded overflow-hidden mb-3">
                        <?php
                        $imageUrl = getFullImageUrl($content['featured_image']);
                        ?>

                        <img src="<?php echo $imageUrl; ?>" 
                             title="<?php echo htmlspecialchars($content['page_title']); ?>" 
                             alt="<?php echo htmlspecialchars($content['page_title']); ?>" 
                             class="img-zoomin img-fluid rounded w-100">

                    <div class="position-absolute text-white px-4 py-2 bg-primary rounded" style="top: 20px; right: 20px;">
                        <?php echo $news_categories[0]['catname']; ?> <!-- Dynamic Category Name -->
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="#" class="text-dark link-hover me-3"><i class="fa fa-clock"></i> <?php echo $content['article_read']; ?></a>
                    <a href="#" class="text-dark link-hover me-3"><i class="fa fa-eye"></i> <?php echo $content['views']; ?> Views</a>
                    <a href="#" class="text-dark link-hover me-3"><i class="fa fa-comment-dots"></i> 05 Comment</a>
                    <a href="#" class="text-dark link-hover"><i class="fa fa-arrow-up"></i> 1.5k Share</a>
                </div>
                <div class="my-4 news-article">
                    <?php
                        echo replace_sysvari($content['page_desc'], getcwd() . "/");
                     ?>
                </div>

                <div class="tab-class">
                    <div class="d-flex justify-content-between border-bottom mb-4">
                       <div class="d-flex align-items-center flex-wrap">
        <h5 class="mb-0 me-3">Share:</h5>

        <!-- Facebook -->
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?=BASE_URL?><?php echo $content['page_url']?>"
           target="_blank"
           class="btn btn-square rounded-circle border-primary text-dark me-2 mb-2">
            <i class="fab fa-facebook-f link-hover"></i>
        </a>

        <!-- Twitter -->
        <a href="https://twitter.com/intent/tweet?url=<?=BASE_URL?><?php echo $content['page_url']?>&text=<?php echo urlencode($content['page_title']); ?>"
           target="_blank"
           class="btn btn-square rounded-circle border-primary text-dark me-2 mb-2">
            <i class="fab fa-twitter link-hover"></i>
        </a>

        <!-- Instagram (link to profile, no sharing support) -->
        <a href="{INSTAGRAM}"
           target="_blank"
           class="btn btn-square rounded-circle border-primary text-dark me-2 mb-2">
            <i class="fab fa-instagram link-hover"></i>
        </a>

        <!-- LinkedIn -->
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=BASE_URL?><?php echo $content['page_url']?>"
           target="_blank"
           class="btn btn-square rounded-circle border-primary text-dark me-2 mb-2">
            <i class="fab fa-linkedin-in link-hover"></i>
        </a>

        <!-- WhatsApp -->
        <a href="https://api.whatsapp.com/send?text=<?=BASE_URL?><?php echo $content['page_url']?>"
           target="_blank"
           class="btn btn-square rounded-circle border-primary text-dark me-2 mb-2">
            <i class="fab fa-whatsapp link-hover"></i>
        </a>

        <!-- Telegram -->
        <a href="https://t.me/share/url?url=<?=BASE_URL?><?php echo $content['page_url']?>&text=<?php echo urlencode($content['page_title']); ?>"
           target="_blank"
           class="btn btn-square rounded-circle border-primary text-dark me-2 mb-2">
            <i class="fab fa-telegram-plane link-hover"></i>
        </a>

        <!-- Pinterest -->
        <a href="https://pinterest.com/pin/create/button/?url=<?=BASE_URL?><?php echo $content['page_url']?>"
           target="_blank"
           class="btn btn-square rounded-circle border-primary text-dark me-2 mb-2">
            <i class="fab fa-pinterest-p link-hover"></i>
        </a>

        <!-- Reddit -->
        <a href="https://www.reddit.com/submit?url=<?=BASE_URL?><?php echo $content['page_url']?>&title=<?php echo urlencode($content['page_title']); ?>"
           target="_blank"
           class="btn btn-square rounded-circle border-primary text-dark mb-2">
            <i class="fab fa-reddit-alien link-hover"></i>
        </a>
    </div>

                    </div>
                    <div class="author-card card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <?php if(!empty($user['profile_pic'])): ?>
                                <div class="col-md-3 col-4 mb-3 mb-md-0">
                                    <img src="<?= ABSOLUTE_IMAGEPATH.htmlspecialchars($user['profile_pic']) ?>" 
                                         class="img-fluid avatar-circle author-avatar shadow"
                                         alt="<?= htmlspecialchars($user['fullname'] ?? 'Author') ?>">
                                </div>
                                <?php endif; ?>
                                
                                <div class="<?= !empty($user['profile_pic']) ? 'col-md-9 col-8' : 'col-12' ?>">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="fas fa-user-circle text-primary fs-4"></i>
                                        <h2 class="h4 mb-0 fw-bold">
                                            <?= htmlspecialchars($user['fullname'] ?? $content['article_author'] ?? 'Author') ?>
                                        </h2>
                                    </div>
                                    
                                    <?php if(!empty($user['company_title']) || !empty($user['company'])): ?>
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-briefcase me-1"></i>
                                        <?= htmlspecialchars($user['company_title'] ?? '') ?>
                                        <?php if(!empty($user['company'])): ?>
                                            at <?= htmlspecialchars($user['company']) ?>
                                        <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                                    
                                    <?php if(!empty($user['details'])): ?>
                                    <div class="author-bio mb-1">
                                        <?= nl2br(($user['details'])) ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <div class="author-meta d-flex flex-wrap gap-3">
                                        <?php if(!empty($user['emailaddress'])): ?>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-envelope me-2 text-muted"></i>
                                            <a href="mailto:<?= htmlspecialchars($user['emailaddress']) ?>" class="text-decoration-none">
                                                <?= htmlspecialchars($user['emailaddress']) ?>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if(!empty($user['website'])): ?>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-globe me-2 text-muted"></i>
                                            <a href="<?= htmlspecialchars($user['website']) ?>" target="_blank" class="text-decoration-none">
                                                Website
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if(!empty($user['country']) || !empty($user['city'])): ?>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                            <span>
                                                <?= !empty($user['city']) ? htmlspecialchars($user['city']) . ', ' : '' ?>
                                                <?= htmlspecialchars($user['country'] ?? '') ?>
                                            </span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <?php if($content['pages_createdby'] == 0 && !empty($content['article_url'])): ?>
                                    <div class="mt-3">
                                        <a href="<?= htmlspecialchars($content['article_url']) ?>" 
                                           target="_blank" 
                                           class="btn btn-primary rounded-pill px-4">
                                           <i class="fas fa-external-link-alt me-2"></i>Read Full Article
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Author card ends -->

                </div>

                <!-- You May Also Like Section -->
                    <div id="you-may-also-like"></div>

                    <script type="text/javascript">
                        // Get current article data (you can pass this from PHP)
                        const articleData = {
                            page_title: '<?= addslashes($content["page_title"]) ?>',
                            catid: <?= (int)$content["catid"] ?>,
                            pid: <?= (int)$content["pid"] ?>
                        };
                        
                        // Load the module
                        try {
                            loadModule(
                                'modules/module_you_may_like.php', 
                                articleData, 
                                '#you-may-also-like'
                            );
                        } catch (error) {
                            console.error('Failed to load module:', error);
                            document.querySelector('#you-may-also-like').innerHTML = 'Module failed to load';
                        }
                    </script>
                    <!-- You may also like -->

                {comments}
            </div>

            <div class="col-lg-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="p-3 rounded border">
                            <form action="search.php" method="get">
                                <div class="input-group w-100 mx-auto d-flex mb-4">
                                    <input type="search" name="q" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1" required>
                                    <button type="submit" id="search-icon-1" class="btn btn-primary input-group-text p-3">
                                        <i class="fa fa-search text-white"></i>
                                    </button>
                                </div>
                            </form>

                            <h4 class="mb-4">Popular Categories</h4>
                            <div class="row g-2">
                                <?php foreach ($news_categories as $category) { ?>
                                    <div class="col-12">
                                        <a href="<?php echo $category['cat_url']; ?>" class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">
                                            <?php echo $category['catname']; ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- Other sections like "Stay Connected" and "Popular News" can be similarly updated -->
                              <h4 class="my-4">Stay Connected</h4>
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <a href="{FACEBOOK}" class="w-100 rounded btn btn-primary d-flex align-items-center p-3 mb-2">
                                                <i class="fab fa-facebook-f btn btn-light btn-square rounded-circle me-3"></i>
                                                <span class="text-white">13,977 Fans</span>
                                            </a>
                                            <a href="{TWITTER}" class="w-100 rounded btn btn-danger d-flex align-items-center p-3 mb-2">
                                                <i class="fab fa-twitter btn btn-light btn-square rounded-circle me-3"></i>
                                                <span class="text-white">21,798 Followers</span>
                                            </a>
                                            <a href="{YOUTUBE}" class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-2">
                                                <i class="fab fa-youtube btn btn-light btn-square rounded-circle me-3"></i>
                                                <span class="text-white">7,999 Subscribers</span>
                                            </a>
                                            <a href="{INSTAGRAM}" class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-2">
                                                <i class="fab fa-instagram btn btn-light btn-square rounded-circle me-3"></i>
                                                <span class="text-white">19,764 Followers</span>
                                            </a>
                                            <a href="{LINKEDIN}" class="w-100 rounded btn btn-secondary d-flex align-items-center p-3 mb-2">
                                                <i class="fab fa-linkedin-in btn btn-light btn-square rounded-circle me-3"></i>
                                                <span class="text-white">31,999 Connections</span>
                                            </a>
                                            <a href="{PINTEREST}" class="w-100 rounded btn btn-danger d-flex align-items-center p-3 mb-2">
                                                <i class="fab fa-pinterest-p btn btn-light btn-square rounded-circle me-3"></i>
                                                <span class="text-white">5,000 Followers</span>
                                            </a>
                                            <a href="{SNAPCHAT}" class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-2">
                                                <i class="fab fa-snapchat-ghost btn btn-light btn-square rounded-circle me-3"></i>
                                                <span class="text-white">9,000 Subscribers</span>
                                            </a>
                                            <a href="{TIKTOK}" class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-2">
                                                <i class="fab fa-tiktok btn btn-light btn-square rounded-circle me-3"></i>
                                                <span class="text-white">18,000 Followers</span>
                                            </a>
                                            <a href="{REDDIT}" class="w-100 rounded btn btn-secondary d-flex align-items-center p-3 mb-2">
                                                <i class="fab fa-reddit-alien btn btn-light btn-square rounded-circle me-3"></i>
                                                <span class="text-white">2,500 Karma</span>
                                            </a>
                                            <a href="{WHATSAPP}" class="w-100 rounded btn btn-success d-flex align-items-center p-3 mb-2">
                                                <i class="fab fa-whatsapp btn btn-light btn-square rounded-circle me-3"></i>
                                                <span class="text-white">Join Chat</span>
                                            </a>
                                            <a href="{TELEGRAM}" class="w-100 rounded btn btn-info d-flex align-items-center p-3 mb-4">
                                                <i class="fab fa-telegram-plane btn btn-light btn-square rounded-circle me-3"></i>
                                                <span class="text-white">Join Channel</span>
                                            </a>
                                        </div>
                                    </div>

                                <!-- Tags and Popular_news -->
                                <div id="popular_news_and_tags"></div>
                                <script type="text/javascript">
                                    try {
                                    
                                         loadModule('modules/module_popularnews_and_tags.php', {}, '#popular_news_and_tags');
                                    
                                    } catch (error) {
                                    
                                        console.error('Failed to load module:', error);
                                    
                                        document.querySelector('#popular_news_and_tags').innerHTML = 'Module failed to load';
                                    
                                    }
                              </script>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
<!-- Single Product End -->
</div>

        