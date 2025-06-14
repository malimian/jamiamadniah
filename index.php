<?php
include 'front_connect.php';

$url = "index.php";
$not_show_more_then_once = [];

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
    // Add any other CSS/JS files needed
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
$navbar_content = front_menu( null ,$template_id);
if (!empty($navbar_content)) {
    echo replace_sysvari($navbar_content, getcwd() . "/");
}

?>

<style>

    .owl-carousel img {
        height: 250px; /* Adjust height as needed */
        object-fit: cover; /* Ensures the image covers the area without stretching */
    }
</style>

<!-- Features Start -->
<div class="container-fluid features mb-5">
    <div class="container py-5">
        <div class="row g-4">
            <?php
            $news_categories = return_multiple_rows("SELECT * FROM category WHERE ParentCategory = 118");
            foreach ($news_categories as $new_category) {
            
                $latest_news = return_single_row("SELECT * FROM pages WHERE catid = " . $new_category['catid'] . " AND isactive = 1 AND soft_delete = 0 AND template_id = 7 AND views = 0 ORDER BY pages.createdon DESC LIMIT 0,1");
            ?>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="row g-4 align-items-center features-item">
                        <div class="col-4">
                            <div class="rounded-circle position-relative">
                                <div class="overflow-hidden rounded-circle overflow-hidden">
                                    <img src="<?php echo getFullImageUrl($latest_news['featured_image']); ?>" class="img-zoomin img-fluid rounded-circle w-100 circle-clss" alt="<?php echo $latest_news['page_title']; ?>">
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
                      AND template_id = 7
                      AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") 
                    ORDER BY createdon DESC 
                    LIMIT 1
                ");
                    $not_show_more_then_once[] = $main_news['pid'];
                ?>
                <div class="position-relative overflow-hidden rounded">
                    <img src="<?php echo getFullImageUrl($main_news['featured_image']); ?>" class="img-fluid rounded img-zoomin w-100" alt="<?php echo $main_news['page_title']; ?>">
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
                <p class="mt-3 mb-4"><?php echo mb_strimwidth(cleanContent($main_news['page_desc']), 0, 200, "..."); ?></p>

                <!-- Top Story Section -->
                <div class="bg-light p-4 rounded">
                    <div class="news-2">
                        <h3 class="mb-4">Top Stories</h3>
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
                                <img src="<?php echo getFullImageUrl($top_story['featured_image']); ?>" class="img-fluid rounded img-zoomin w-100" alt="<?php echo $top_story['page_title']; ?>">
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
                         ORDER BY createdon DESC LIMIT 5");
                        foreach ($sidebar_news as $news) {
                        ?>
                            <div class="col-12">
                                <div class="row g-4 align-items-center">
                                    <div class="col-5">
                                        <div class="overflow-hidden rounded">
                                            <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-zoomin img-fluid rounded w-100" alt="<?php echo $news['page_title']; ?>">
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

        echo $content['page_desc'];
 } ?>
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
                            <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-zoomin img-fluid rounded-top w-100" alt="<?php echo $news['page_title']; ?>">
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
                             AND template_id = 7
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
                                            <img src="<?php echo getFullImageUrl($main_category_news['featured_image']); ?>" class="img-zoomin img-fluid rounded w-100" alt="<?php echo $main_category_news['page_title']; ?>">
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
                                        <p class="my-4"><?php echo mb_strimwidth(cleanContent($main_category_news['page_desc']), 0, 200, "..."); ?></p>
                                    </div>
                                    <div class="col-lg-4">
                                        <?php
                                        foreach (array_slice($category_news, 1) as $news) {
                                            $not_show_more_then_once[] = $news['pid'];
                                        ?>
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-zoomin img-fluid rounded w-100" alt="<?php echo $news['page_title']; ?>">
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
                                <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-fluid rounded-top w-100" alt="<?php echo $news['page_title']; ?>">
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
                    <h1 class="mb-4">Trending Stories</h1>
                </div>
                <div class="row g-4">
                    <?php
                       // Fetch lifestyle news articles
                    $lifestyle_news = return_multiple_rows("SELECT * FROM pages WHERE template_id = 7 AND isactive = 1 AND soft_delete = 0 
                            AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") 
                            ORDER BY createdon DESC LIMIT 2");

                    foreach ($lifestyle_news as $news) {
                    ?>
                        <div class="col-lg-6">
                            <div class="lifestyle-item rounded">
                                <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-fluid w-100 rounded" alt="<?php echo $news['page_title']; ?>">
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

                <!-- Editor Choice Start -->
                    <div class="border-bottom mb-4">
                        <h2 class="my-4">Editors Top News</h2>
                    </div>
                    <div class="whats-carousel owl-carousel most-views-news">
                    <?php
                        // Fetch most viewed news articles
                        $editor_news = return_multiple_rows("SELECT * FROM pages WHERE template_id = 7 AND isactive = 1 AND soft_delete = 0 AND createdby != 0
                            ORDER BY views DESC LIMIT 5");

                        foreach ($editor_news as $news) {

                            $user = return_single_row("Select username , fullname , profile_pic , details from loginuser Where soft_delete = 0 and isactive = 1  and id = ".$news['createdby']);
                        ?>
                            <div class="latest-news-item">
                                <div class="bg-light rounded">
                                    <div class="rounded-top overflow-hidden">
                                        <?php
                                        $imageUrl = getFullImageUrl($news['featured_image']);
                                        ?>

                                        <img src="<?php echo $imageUrl; ?>" 
                                             class="img-fluid rounded-top w-100" 
                                             alt="<?php echo htmlspecialchars($news['page_title']); ?>">

                                    </div>
                                    <div class="d-flex flex-column p-4">
                                        <a href="<?php echo $news['page_url']; ?>" class="h4"><?php echo mb_strimwidth($news['page_title'], 0, 50, "..."); ?></a>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="small text-body link-hover">by <?php echo $user['fullname']; ?></a>
                                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($news['createdon']); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                           $not_show_more_then_once[] = $news['pid'];
                        } ?>
                    </div>
                <!-- Editor Choice End -->
                </div>
                <style type="text/css">
                    /* Latest News Sidebar Styles */
                    .latest-news-sidebar .news-item {
                    transition: all 0.3s ease;
                    padding-left: 5px;
                    }

                    .latest-news-sidebar .news-item:hover {
                    background-color: #f8f9fa;
                    border-radius: 5px;
                    }

                    .latest-news-sidebar h6 {
                    font-size: 0.95rem;
                    font-weight: 600;
                    line-height: 1.4;
                    transition: color 0.3s ease;
                    margin-left: 18px;
                    }

                    .latest-news-sidebar h6:hover {
                    color: #dc3545;
                    cursor: pointer;
                    }

                    /* Blinking dot for latest news */
                    .blinking-dot {
                    display: inline-block;
                    width: 8px;
                    height: 8px;
                    background-color: #dc3545;
                    border-radius: 50%;
                    animation: blink 1.5s infinite;
                    }

                    @keyframes blink {
                    0% { opacity: 1; }
                    50% { opacity: 0.3; }
                    100% { opacity: 1; }
                    }

                    /* Red timestamp */
                    .text-danger.fw-bold {
                    font-weight: 700 !important;
                    }
                </style>
               <!-- Sidebar Section Latest News Section -->
                <div class="col-lg-4 col-xl-3">
                    <div class="bg-light rounded p-4 pt-0">
                        <!-- Latest News Section -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3 pb-2">
                                <h4 class="mb-0 text-uppercase fw-bold">Latest News</h4>
                                <span class="badge bg-danger">Live</span>
                            </div>
                            
                            <!-- Latest News Items -->
                            <div class="latest-news-sidebar">
                                <?php
                                $latest_sidebar_news = return_multiple_rows("SELECT * FROM pages WHERE template_id = 7 AND isactive = 1 AND soft_delete = 0
                                    AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") 
                                    ORDER BY createdon DESC LIMIT 6");

                                foreach ($latest_sidebar_news as $index => $news) {
                                    $time = date("h:i a", strtotime($news['createdon']));
                                    $is_latest = $index === 0; // First item is the latest
                                    $not_show_more_then_once[] = $news['pid'];
                                ?>
                                <div class="col-12 mb-3">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-5">
                                            <div class="overflow-hidden rounded">
                                                <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-zoomin img-fluid rounded w-100" alt="<?php echo htmlspecialchars($news['page_title']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="features-content d-flex flex-column">
                                                <div class="d-flex align-items-center mb-1">
                                                        <span class="blinking-dot me-2"></span>
                                                    <small class="text-danger fw-bold"><?php echo $time; ?></small>
                                                </div>
                                                <a href="<?php echo $news['page_url']; ?>" class="h6">
                                                    <?php echo mb_strimwidth($news['page_title'], 0, 50, "..."); ?>
                                                </a>
                                                <small><i class="fa fa-eye"></i> <?php echo $news['views']; ?> Views</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>


                        <!-- Existing Sidebar Content -->
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
                             ORDER BY createdon DESC LIMIT 5 OFFSET 3"); // Skip first 3 we already showed
                            foreach ($sidebar_news as $news) {
                            ?>
                                <div class="col-12">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-5">
                                            <div class="overflow-hidden rounded">
                                                <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-zoomin img-fluid rounded w-100" alt="<?php echo $news['page_title']; ?>">
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
</div>
<!-- Most Popular News End -->

    <div id="module-news-carousel"></div>

       <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            loadModule('modules/index/module_news_carousel.php', {}, '#module-news-carousel')
                .then(() => {
                    if (typeof $ === 'function' && typeof $.fn.owlCarousel === 'function') {
                        $('.business-carousel, .health-carousel, .sports-carousel, .tech-carousel').owlCarousel({
                            loop: true,
                            margin: 20,
                            nav: true,
                            dots: false,
                            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                            responsive: {
                                0: { items: 1 },
                                576: { items: 2 },
                                768: { items: 3 },
                                992: { items: 4 }
                            }
                        });
                    } else {
                        console.warn('jQuery or Owl Carousel is not available.');
                    }
                })
                .catch((error) => {
                    console.error('Failed to load module:', error);
                    const el = document.querySelector('#module-news-carousel');
                    if (el) el.innerHTML = 'Module failed to load';
                });
        });
</script>


    <div id="blog_section"></div>
   <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        try {
            loadModule('modules/index/module_blog_section.php', {}, '#blog_section');
        } catch (error) {
            console.error('Failed to load module:', error);
            const blogSection = document.querySelector('#blog_section');
            if (blogSection) {
                blogSection.innerHTML = 'Module failed to load';
            }
        }
    });
</script>



    </div>
</div>

<!-- Category News Carousels Ends -->

<?php 
echo replace_sysvari(front_script(null, $template_id), getcwd() . "/");
?>

<?php
echo replace_sysvari(front_footer(null, $template_id), getcwd() . "/");
?>

