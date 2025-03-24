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

<!-- Features Start -->
<div class="container-fluid features mb-5">
    <div class="container py-5">
        <div class="row g-4">
            <?php
            $news_categories = return_multiple_rows("SELECT * FROM category WHERE ParentCategory = 118");
            foreach ($news_categories as $new_category) {
            
                $latest_news = return_single_row("SELECT * FROM pages WHERE catid = " . $new_category['catid'] . " AND isactive = 1 AND soft_delete = 0 AND views = 0 ORDER BY pages.createdon DESC LIMIT 0,1");
            ?>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="row g-4 align-items-center features-item">
                        <div class="col-4">
                            <div class="rounded-circle position-relative">
                                <div class="overflow-hidden rounded-circle overflow-hidden">
                                    <img src="<?php echo $latest_news['featured_image']; ?>" class="img-zoomin img-fluid rounded-circle w-100 circle-clss" alt="<?php echo $latest_news['page_title']; ?>">
                                </div>
                                <span class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute" style="top: 10%; right: -10px;"><?php echo return_single_ans("SELECT COUNT(pid) FROM pages WHERE views = 0 AND catid = " . $new_category['catid'] . " AND DATE(createdon) = CURDATE();"); ?></span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="features-content d-flex flex-column">
                                <p class="text-uppercase mb-2"><?php echo $new_category['catname']; ?></p>
                                <a href="<?php echo $latest_news['page_url']; ?>" class="h6">
                                    <?php echo mb_strimwidth($latest_news['page_title'], 0, 50, "..."); ?>
                                </a>
                                <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($latest_news['createdon']); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                    $not_show_more_then_once[] = $latest_news['pid'];
        } ?>
        </div>
    </div>
</div>
<!-- Features End -->

<!-- Main Post Section Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-7 col-xl-8 mt-0">
                <!-- Main News Article -->
                <?php
                $main_news = return_single_row("
                    SELECT * 
                    FROM pages 
                    WHERE isactive = 1 
                      AND soft_delete = 0 
                      AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") 
                    ORDER BY createdon DESC 
                    LIMIT 1
                ");
                    $not_show_more_then_once[] = $main_news['pid'];
                ?>
                <div class="position-relative overflow-hidden rounded">
                    <img src="<?php echo $main_news['featured_image']; ?>" class="img-fluid rounded img-zoomin w-100" alt="<?php echo $main_news['page_title']; ?>">
                    <div class="d-flex justify-content-center px-4 position-absolute flex-wrap" style="bottom: 10px; left: 0;">
                        <a href="#" class="text-white me-3 link-hover"><i class="fa fa-clock"></i> <?php echo $main_news['article_read']; ?></a>
                        <a href="#" class="text-white me-3 link-hover"><i class="fa fa-eye"></i> <?php echo $main_news['views']; ?> Views</a>
                        <a href="#" class="text-white me-3 link-hover"><i class="fa fa-comment-dots"></i> 05 Comments</a>
                        <a href="#" class="text-white link-hover"><i class="fa fa-arrow-up"></i> 1.5k Shares</a>
                    </div>
                </div>
                <div class="border-bottom py-3">
                    <a href="<?php echo $main_news['page_url']; ?>" class="display-4 text-dark mb-0 link-hover"><?php echo $main_news['page_title']; ?></a>
                </div>
                <p class="mt-3 mb-4"><?php echo mb_strimwidth($main_news['page_desc'], 0, 200, "..."); ?></p>

                <!-- Top Story Section -->
                <div class="bg-light p-4 rounded">
                    <div class="news-2">
                        <h3 class="mb-4">Top Story</h3>
                    </div>
                    <?php
                    $top_story = return_single_row("SELECT * FROM pages WHERE template_id = 7 AND isactive = 1 AND soft_delete = 0 
                      AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") 
                        ORDER BY views DESC LIMIT 1");

                         $not_show_more_then_once[] = $top_story['pid'];
                    ?>
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6">
                            <div class="rounded overflow-hidden">
                                <img src="<?php echo $top_story['featured_image']; ?>" class="img-fluid rounded img-zoomin w-100" alt="<?php echo $top_story['page_title']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <a href="<?php echo $top_story['page_url']; ?>" class="h3"><?php echo $top_story['page_title']; ?></a>
                                <p class="mb-0 fs-5"><i class="fa fa-clock"></i> <?php echo $top_story['article_read']; ?></p>
                                <p class="mb-0 fs-5"><i class="fa fa-eye"></i> <?php echo $top_story['views']; ?> Views</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Section -->
            <div class="col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 pt-0">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="rounded overflow-hidden">
                                <img src="img/news-3.jpg" class="img-fluid rounded img-zoomin w-100" alt="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-column">
                                <a href="#" class="h4 mb-2">Get the best speak market, news.</a>
                                <p class="fs-5 mb-0"><i class="fa fa-clock"> 06 minute read</i> </p>
                                <p class="fs-5 mb-0"><i class="fa fa-eye"> 3.5k Views</i></p>
                            </div>
                        </div>

                        <?php
                        $sidebar_news = return_multiple_rows("SELECT * FROM pages WHERE template_id = 7 AND isactive = 1 AND soft_delete = 0
                         AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") 
                         ORDER BY createdon DESC LIMIT 6");
                        foreach ($sidebar_news as $news) {
                        ?>
                            <div class="col-12">
                                <div class="row g-4 align-items-center">
                                    <div class="col-5">
                                        <div class="overflow-hidden rounded">
                                            <img src="<?php echo $news['featured_image']; ?>" class="img-zoomin img-fluid rounded w-100" alt="<?php echo $news['page_title']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="features-content d-flex flex-column">
                                            <a href="<?php echo $news['page_url']; ?>" class="h6"><?php echo mb_strimwidth($news['page_title'], 0, 50, "..."); ?></a>
                                            <small><i class="fa fa-clock"></i> <?php echo $news['article_read']; ?></small>
                                            <small><i class="fa fa-eye"></i> <?php echo $news['views']; ?> Views</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            $not_show_more_then_once[] = $news['pid'];
                    } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Post Section End -->

<!-- Breaking News Live Section Start -->
<?php
$islive_streaming = return_single_ans("SELECT isactive FROM category WHERE catid = 124");
if ($islive_streaming == 1) {
    $islive_streaming_page = return_single_row("SELECT * FROM pages WHERE catid = 124 AND isactive = 1 AND soft_delete = 0 ORDER BY createdon ASC");
?>
    <div class="container-fluid py-5 my-5 live-streaming-section" style="background: linear-gradient(rgba(202, 203, 185, 1), rgba(202, 203, 185, 1));">
        <div class="container">
            <div class="row g-4 align-items-center">
                <!-- Left Column: Live Stream Info -->
                <div class="col-lg-7">
                    <span class="live-badge">LIVE</span>
                    <h1 class="mb-4 text-primary">Breaking News Live</h1>
                    <h2 class="mb-4 text-dark">Watch Latest Updates in Real-Time</h2>
                    <p class="text-dark mb-4 pb-2">Stay connected with 24/7 live news coverage. Get real-time updates on breaking news, trending topics, and exclusive reports.</p>
                    <a href="https://www.youtube.com/c/YourNewsChannel" class="btn btn-watch mt-3" target="_blank">
                        <i class="bi bi-play-circle"></i> Watch on YouTube
                    </a>
                </div>

                <!-- Right Column: Live Stream Video -->
                <div class="col-lg-5">
                    <div class="live-video rounded overflow-hidden">
                        <iframe class="w-100" height="300" src="https://www.youtube.com/embed/YDfiTGGPYCk?si=Z1M0lOmqFtiDQ9G3&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- Breaking News Live Section End -->

<?php
$news_categories = return_multiple_rows("SELECT * FROM category WHERE ParentCategory = 118");

$latest_news_items = [];

foreach ($news_categories as $new_category) {
    $latest_news = return_single_row("
        SELECT * 
        FROM pages 
        WHERE catid = " . $new_category['catid'] . " 
          AND isactive = 1 
          AND soft_delete = 0 
          AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ")
          AND views = 0 
        ORDER BY createdon DESC 
        LIMIT 1
    ");

    if ($latest_news) {
        $latest_news_items[] = $latest_news;
    }
}

?>
<!-- Latest News Start -->
<div class="container-fluid latest-news py-5">
    <div class="container py-5">
        <h2 class="mb-4">Latest News</h2>
        <div class="latest-news-carousel owl-carousel">
            <?php
            // Loop through the latest news items and display them
            foreach ($latest_news_items as $news) {
            ?>
                <div class="latest-news-item">
                    <div class="bg-light rounded">
                        <div class="rounded-top overflow-hidden">
                            <img src="<?php echo $news['featured_image']; ?>" class="img-zoomin img-fluid rounded-top w-100" alt="<?php echo $news['page_title']; ?>">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="<?php echo $news['page_url']; ?>" class="h4"><?php echo mb_strimwidth($news['page_title'], 0, 45, "..."); ?></a>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="small text-body link-hover">by <?php echo mb_strimwidth($news['article_author'], 0, 15, "..."); ?></a>
                                <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($news['createdon']); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                 $not_show_more_then_once[] = $news['pid'];
             } ?>
        </div>
    </div>
</div>
<!-- Latest News End -->

<!-- Most Popular News Start -->
<div class="container-fluid populer-news py-5">
    <div class="container py-5">
        <div class="tab-class mb-4">
            <div class="row g-4">
                <div class="col-lg-8 col-xl-9">
                    <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                        <h1 class="mb-4">What's New</h1>
                        <ul class="nav nav-pills d-inline-flex text-center">
                            <?php
                            $categories = return_multiple_rows("SELECT * FROM category WHERE ParentCategory = 118");
                            foreach ($categories as $index => $category) {
                            ?>
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill <?php echo $index === 0 ? 'active' : ''; ?> me-2" data-bs-toggle="pill" href="#tab-<?php echo $index + 1; ?>">
                                        <span class="text-dark" style="width: 100px;"><?php echo $category['catname']; ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="tab-content mb-4">
                        <?php
                        foreach ($categories as $index => $category) {
                            $category_news = return_multiple_rows("SELECT * FROM pages WHERE catid = " . $category['catid'] . " AND isactive = 1 AND soft_delete = 0
                             AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") 

                             ORDER BY createdon DESC LIMIT 5");
                        ?>
                            <div id="tab-<?php echo $index + 1; ?>" class="tab-pane fade show p-0 <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="row g-4">
                                    <div class="col-lg-8">
                                        <?php
                                        $main_category_news = $category_news[0];
                                        $not_show_more_then_once[] = $main_category_news['pid'];
                                        ?>
                                        <div class="position-relative rounded overflow-hidden">
                                            <img src="<?php echo $main_category_news['featured_image']; ?>" class="img-zoomin img-fluid rounded w-100" alt="<?php echo $main_category_news['page_title']; ?>">
                                            <div class="position-absolute text-white px-4 py-2 bg-primary rounded" style="top: 20px; right: 20px;">
                                                <?php echo $category['catname']; ?>
                                            </div>
                                        </div>
                                        <div class="my-4">
                                            <a href="<?php echo $main_category_news['page_url']; ?>" class="h4"><?php echo $main_category_news['page_title']; ?></a>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="text-dark link-hover me-3"><i class="fa fa-clock"></i> <?php echo $main_category_news['article_read']; ?></a>
                                            <a href="#" class="text-dark link-hover me-3"><i class="fa fa-eye"></i> <?php echo $main_category_news['views']; ?> Views</a>
                                            <a href="#" class="text-dark link-hover me-3"><i class="fa fa-comment-dots"></i> 05 Comments</a>
                                            <a href="#" class="text-dark link-hover"><i class="fa fa-arrow-up"></i> 1.5k Shares</a>
                                        </div>
                                        <p class="my-4"><?php echo mb_strimwidth($main_category_news['page_desc'], 0, 200, "..."); ?></p>
                                    </div>
                                    <div class="col-lg-4">
                                        <?php
                                        foreach (array_slice($category_news, 1) as $news) {
                                            $not_show_more_then_once[] = $news['pid'];
                                        ?>
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="<?php echo $news['featured_image']; ?>" class="img-zoomin img-fluid rounded w-100" alt="<?php echo $news['page_title']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2"><?php echo $category['catname']; ?></p>
                                                        <a href="<?php echo $news['page_url']; ?>" class="h6"><?php echo mb_strimwidth($news['page_title'], 0, 50, "..."); ?></a>
                                                        <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($news['createdon']); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                        <!-- Life Style and Most View Section Start -->
                        <?php
                        // Fetch most viewed news articles
                        $most_viewed_news = return_multiple_rows("SELECT * FROM pages WHERE template_id = 7 AND isactive = 1 AND soft_delete = 0 
                            AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") 
                            ORDER BY views DESC LIMIT 5");

                        // Fetch lifestyle news articles
                        $lifestyle_news = return_multiple_rows("SELECT * FROM pages WHERE template_id = 7 AND isactive = 1 AND soft_delete = 0 
                            AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") 
                            ORDER BY createdon DESC LIMIT 2");
                        ?>

            <!-- Most Views News Section -->
            <div class="border-bottom mb-4">
                <h2 class="my-4">Most Views News</h2>
            </div>
            <div class="whats-carousel owl-carousel most-views-news">
                <?php
                foreach ($most_viewed_news as $news) {
                ?>
                    <div class="latest-news-item">
                        <div class="bg-light rounded">
                            <div class="rounded-top overflow-hidden">
                                <img src="<?php echo $news['featured_image']; ?>" class="img-fluid rounded-top w-100" alt="<?php echo $news['page_title']; ?>">
                            </div>
                            <div class="d-flex flex-column p-4">
                                <a href="<?php echo $news['page_url']; ?>" class="h4"><?php echo mb_strimwidth($news['page_title'], 0, 50, "..."); ?></a>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="small text-body link-hover">by <?php echo $news['article_author']; ?></a>
                                    <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($news['createdon']); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                   $not_show_more_then_once[] = $news['pid'];
                } ?>
            </div>

            <!-- Life Style Section -->
            <div class="mt-5 lifestyle">
                <div class="border-bottom mb-4">
                    <h1 class="mb-4">Life Style</h1>
                </div>
                <div class="row g-4">
                    <?php
                    foreach ($lifestyle_news as $news) {
                    ?>
                        <div class="col-lg-6">
                            <div class="lifestyle-item rounded">
                                <img src="<?php echo $news['featured_image']; ?>" class="img-fluid w-100 rounded" alt="<?php echo $news['page_title']; ?>">
                                <div class="lifestyle-content">
                                    <div class="mt-auto">
                                        <a href="<?php echo $news['page_url']; ?>" class="h4 text-white link-hover"><?php echo mb_strimwidth($news['page_title'], 0, 50, "..."); ?></a>
                                        <div class="d-flex justify-content-between mt-4">
                                            <a href="#" class="small text-white link-hover">By <?php echo $news['article_author']; ?></a>
                                            <small class="text-white d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($news['createdon']); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                      $not_show_more_then_once[] = $news['pid'];
                } ?>
                </div>
            </div>
                        <!-- Life Style and Most View Section End -->
                </div>
                <div class="col-lg-4 col-xl-3">
                    <!-- Sidebar Content -->
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h4 class="mb-4">Stay Connected</h4>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <a href="#" class="w-100 rounded btn btn-primary d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-facebook-f btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">13,977 Fans</span>
                                        </a>
                                        <a href="#" class="w-100 rounded btn btn-danger d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-twitter btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">21,798 Follower</span>
                                        </a>
                                        <a href="#" class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-youtube btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">7,999 Subscriber</span>
                                        </a>
                                        <a href="#" class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-instagram btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">19,764 Follower</span>
                                        </a>
                                        <a href="#" class="w-100 rounded btn btn-secondary d-flex align-items-center p-3 mb-2">
                                            <i class="bi-cloud btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">31,999 Subscriber</span>
                                        </a>
                                        <a href="#" class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-4">
                                            <i class="fab fa-dribbble btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">37,999 Subscriber</span>
                                        </a>
                                    </div>
                                </div>
                              <?php
                                // Fetch popular news items
                                $popular_news = return_multiple_rows("
                                    SELECT p.*, c.catname AS catname 
                                    FROM (
                                        SELECT p.*, 
                                               ROW_NUMBER() OVER (PARTITION BY p.catid ORDER BY RAND()) AS rn 
                                        FROM pages p
                                        WHERE p.template_id = 7 
                                          AND p.isactive = 1 
                                          AND p.soft_delete = 0
                                          AND p.pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") 
                                    ) AS p
                                    LEFT JOIN category c ON p.catid = c.catid
                                    WHERE p.rn = 1 
                                    ORDER BY p.views DESC 
                                    LIMIT 5
                                ");

                                // Fetch trending tags from page_meta_keywords
                                $tags = [];
                                $all_keywords = return_multiple_rows("
                                    SELECT page_meta_keywords 
                                    FROM pages 
                                    WHERE page_meta_keywords IS NOT NULL 
                                      AND page_meta_keywords != ''
                                ");
                                foreach ($all_keywords as $keyword_row) {
                                    $keywords = explode(",", $keyword_row['page_meta_keywords']);
                                    foreach ($keywords as $keyword) {
                                        $keyword = trim($keyword); // Remove extra spaces
                                        if (!empty($keyword)) {
                                            if (isset($tags[$keyword])) {
                                                $tags[$keyword]++;
                                            } else {
                                                $tags[$keyword] = 1;
                                            }
                                        }
                                    }
                                }
                                // Sort tags by frequency in descending order
                                arsort($tags);
                                $trending_tags = array_slice(array_keys($tags), 0, 10); // Get top 10 tags
                                ?>

                                <h4 class="my-4">Popular News</h4>
                                <div class="row g-4">
                                    <?php
                                    foreach ($popular_news as $news) {
                                        $not_show_more_then_once[] = $news['pid'];
                                    ?>
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center features-item">
                                                <div class="col-4">
                                                    <div class="rounded-circle position-relative">
                                                        <div class="overflow-hidden rounded-circle">
                                                            <img src="<?php echo $news['featured_image']; ?>" class="img-zoomin img-fluid rounded-circle w-100 circle-clss" alt="<?php echo $news['page_title']; ?>">
                                                        </div>
                                                        <span class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute" style="top: 10%; right: -10px;"><?php echo $news['views']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2"><?php echo $news['catname']; ?></p>
                                                        <a href="<?php echo $news['page_url']; ?>" class="h6"><?php echo mb_strimwidth($news['page_title'], 0, 45, "..."); ?></a>
                                                        <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($news['createdon']); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-lg-12">
                                        <a href="#" class="link-hover btn border border-primary rounded-pill text-dark w-100 py-3 mb-4">View More</a>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-bottom my-3 pb-3">
                                            <h4 class="mb-0">Trending Tags</h4>
                                        </div>
                                        <ul class="nav nav-pills d-inline-flex text-center mb-4">
                                            <?php
                                            foreach ($trending_tags as $tag) {
                                            ?>
                                                <li class="nav-item mb-3">
                                                    <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                        <span class="text-dark link-hover" style="width: 90px;"><?php echo $tag; ?></span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Popular News End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Most Popular News End -->

<?php
echo replace_sysvari(Basefooter(null, $template_id), getcwd() . "/");
echo replace_sysvari(BaseScript(null, $template_id), getcwd() . "/");
?>
</body>
</html>