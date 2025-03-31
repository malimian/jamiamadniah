<?php
if(!function_exists("header_t")) {
    function header_t(){
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
$user = return_single_row("Select username , fullname , profile_pic , details from loginuser Where soft_delete = 0 and isactive = 1  and id = ".$content['createdby']);



$news_categories = return_multiple_rows("SELECT * FROM category WHERE catid = ".$content['catid']);

?>

<style type="text/css">
    .wp-post-image {
    display: none;
}
</style>
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
                    <img src="<?php echo $content['featured_image']; ?>" title="<?php echo $content['page_title']; ?>" alt="<?php echo $content['page_title']; ?>" class="img-zoomin img-fluid rounded w-100" alt="">
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
                <p class="my-4">
                    <?php if ($PAGE_LOADER == 1) { ?>
                        <div id="div_content"></div>
                    <?php } else {
                        echo replace_sysvari($content['page_desc'], getcwd() . "/");
                    } ?>
                </p>

                <div class="tab-class">
                    <div class="d-flex justify-content-between border-bottom mb-4">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 me-3">Share:</h5>
                            <i class="fab fa-facebook-f link-hover btn btn-square rounded-circle border-primary text-dark me-2"></i>
                            <i class="btn fab bi-twitter link-hover btn btn-square rounded-circle border-primary text-dark me-2"></i>
                            <i class="btn fab fa-instagram link-hover btn btn-square rounded-circle border-primary text-dark me-2"></i>
                            <i class="btn fab fa-linkedin-in link-hover btn btn-square rounded-circle border-primary text-dark"></i>
                        </div>
                    </div>
                    <div class="row g-4 align-items-center">
                        <div class="col-9">
                            <h3><i class="fas fa-user"></i> Author <?php echo $content['article_author']; ?></h3>
                        </div>
                         <div class="col-lg-12">
                            <a href="<?php echo $content['article_url']; ?>" target="_blank" class="link-hover btn border border-primary rounded-pill text-dark w-100 py-3 mb-4">Read Full Article</a>
                         </div>
                    </div>
                </div>

                <div class="bg-light rounded my-4 p-4">
                    <h4 class="mb-4">You Might Also Like</h4>
                    <div class="row g-4">
                        <?php foreach ($news_categories as $category) { ?>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center p-3 bg-white rounded">
                                    <img src="img/chatGPT.jpg" class="img-fluid rounded" alt="<?php echo $category['catname']; ?>">
                                    <div class="ms-3">
                                        <a href="<?php echo $category['cat_url']; ?>" class="h5 mb-2"><?php echo $category['catname']; ?></a>
                                        <p class="text-dark mt-3 mb-0 me-3"><i class="fa fa-clock"></i> 06 minute read</p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="bg-light rounded p-4">
                    <h4 class="mb-4">Comments</h4>
                    <div class="p-4 bg-white rounded mb-4">
                        {comments}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="p-3 rounded border">
                            <div class="input-group w-100 mx-auto d-flex mb-4">
                                <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="btn btn-primary input-group-text p-3"><i class="fa fa-search text-white"></i></span>
                            </div>
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
                                <!-- Popular News Start -->
                                <h4 class="my-4">Popular News</h4>
                                <div class="row g-4">
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
                                    ) AS p
                                    LEFT JOIN category c ON p.catid = c.catid
                                    WHERE p.rn = 1 
                                    ORDER BY p.views DESC 
                                    LIMIT 5
                                ");

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
                                                // Fetch trending tags from page_meta_keywords
                                                $tags = [];
                                                $all_keywords = return_multiple_rows("
                                                    SELECT page_meta_keywords 
                                                    FROM pages 
                                                    WHERE page_meta_keywords IS NOT NULL 
                                                      AND page_meta_keywords != ''
                                                ");

                                                // Process keywords and count their frequency
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

                                                // Get top 10 tags
                                                $trending_tags = array_slice(array_keys($tags), 0, 9);

                                                // Loop through the trending tags and display them
                                                if (!empty($trending_tags)) {
                                                    foreach ($trending_tags as $tag) {
                                                        echo '
                                                        <li class="nav-item mb-3">
                                                            <a class="d-flex py-2 bg-light rounded-pill me-2" href="' . BASE_URL . 'tags/' . urlencode($tag) . '">
                                                                <span class="text-dark link-hover" style="width: 90px;">' . htmlspecialchars($tag) . '</span>
                                                            </a>
                                                        </li>';
                                                    }
                                                } else {
                                                    echo '<p>No tags found.</p>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Single Product End -->


        