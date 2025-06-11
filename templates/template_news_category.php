<?php
$catid = $content['catid'];
$catname = $content['catname'];

if (!function_exists("header_t")) {
    function header_t() {
        global $catid;

        $style = '

<style>
    .owl-carousel img {
        height: 250px;
        object-fit: cover;
    }
    .category-highlight {
        background-color: #f8f9fa;
        border-left: 4px solid #007bff;
        padding: 15px;
        margin-bottom: 20px;
    }
    .category-data {
        background-color: #fff;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    ';

        // Conditionally append business-specific styles
        if ($catid == 119) {
            $style .= '
    .stock-ticker {
        background-color: #343a40;
        color: white;
        padding: 10px 0;
        overflow: hidden;
    }';
        }

        $style .= '
    /* Custom CSS */
    .row.g-0 .col-md-4 {
        position: relative;
        overflow: hidden;
    }

    .row.g-0 .col-md-4 img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .row.g-0 .col-md-8 .card-body {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .row.g-0 .col-md-8 .card-body a {
        margin-top: auto;
    }
</style>';

        return $style;
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

// print_r($content);

?>



<!-- Category Highlights Section -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4"><?php echo $catname; ?> Highlights</h2>
                <div class="category-highlight">
                    <?php
                    $category_highlight = return_single_row("SELECT * FROM pages WHERE catid = $catid AND isactive = 1 AND soft_delete = 0 and template_id = 7 ORDER BY createdon DESC LIMIT 1");
                    if ($category_highlight) {
                        $not_show_more_then_once[] = $category_highlight['pid'];
                    ?>
                    <h3><?php echo $category_highlight['page_title']; ?></h3>
                    <p><?php echo mb_strimwidth(cleanContent($category_highlight['page_desc']), 0, 300, "..."); ?></p>
                    <a href="<?php echo $category_highlight['page_url']; ?>" class="link-hover btn border border-primary rounded-pill text-dark">Read More</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($catid == 119) { /* Business-specific stock ticker */ ?>
<!-- Stock Market Ticker -->
<div class="container-fluid stock-ticker py-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                    {
                        "symbols": [
                            { "proName": "NASDAQ:AAPL", "title": "Apple" },
                            { "proName": "NASDAQ:GOOGL", "title": "Google" },
                            { "proName": "NASDAQ:TSLA", "title": "Tesla" },
                            { "proName": "NYSE:MSFT", "title": "Microsoft" },
                            { "proName": "NASDAQ:AMZN", "title": "Amazon" }
                        ],
                        "colorTheme": "light",
                        "isTransparent": false,
                        "displayMode": "adaptive",
                        "locale": "en"
                    }
                    </script>
                </div>
                <!-- TradingView Widget END -->
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Main Category News Section -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Latest Category News -->
                <div class="mb-5">
                    <h2 class="mb-4">Latest <?php echo $catname; ?> News</h2>
                    <div class="row">
                        <?php
                        $latest_category_news = return_multiple_rows("SELECT * FROM pages WHERE catid = $catid AND isactive = 1 AND soft_delete = 0 AND template_id = 7 AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") ORDER BY createdon DESC LIMIT 6");
                        
                        foreach ($latest_category_news as $news) {
                            $not_show_more_then_once[] = $news['pid'];
                        ?>
                        <div class="col-md-4 mb-4 img-zoomin">
                            <div class="card h-100">
                                <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="card-img-top" alt="<?php echo $news['page_title']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo mb_strimwidth($news['page_title'], 0, 60, "..."); ?></h5>
                                    <p class="card-text"><?php echo mb_strimwidth(cleanContent($news['page_desc']), 0, 100, "..."); ?></p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <small class="text-muted"><?php echo timeAgo($news['createdon']); ?></small>
                                    <a href="<?php echo $news['page_url']; ?>" class="btn btn-sm btn-outline-primary float-end">Read More</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
                <!-- Category Analysis -->
                <div class="mb-5">
                    <h2 class="mb-4"><?php echo $catname; ?> Analysis</h2>
                    <div id="analysis-container">
                        <?php
                        $analysis_news = return_multiple_rows("SELECT * FROM pages WHERE catid = $catid AND isactive = 1 AND soft_delete = 0 AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") AND template_id = 7 ORDER BY createdon DESC LIMIT 5");
                        
                        foreach ($analysis_news as $news) {
                            $not_show_more_then_once[] = $news['pid'];
                        ?>
                        <div class="card mb-3 analysis-item">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-fluid rounded-start img-zoomin" alt="<?php echo $news['page_title']; ?>">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $news['page_title']; ?></h5>
                                        <p class="card-text"><?php echo mb_strimwidth(cleanContent($news['page_desc']), 0, 200, "..."); ?></p>
                                        <p class="card-text"><small class="text-muted">Analysis by <?php echo $news['article_author']; ?></small></p>
                                        <a href="<?php echo $news['page_url']; ?>" class="link-hover btn border border-primary rounded-pill text-dark">Read Analysis</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button class="btn btn-outline-primary" id="load-more-btn"
                            data-offset="5"
                            data-catid="<?php echo $catid; ?>"
                            onclick="handleLoadMore(this)">
                            Load More Analysis
                        </button>

                        <div id="loading-spinner" class="spinner-border text-primary d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Trending Category News -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Trending <?php echo $catname; ?> News</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $trending_news = return_multiple_rows("SELECT * FROM pages WHERE catid = $catid AND isactive = 1 AND soft_delete = 0 AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") and template_id = 7 ORDER BY views DESC LIMIT 5");
                        
                        foreach ($trending_news as $news) {
                            $not_show_more_then_once[] = $news['pid'];
                            // Extract keywords from title and content
                            $keywords = extractKeywords($news['page_title'] . ' ' . $news['page_desc'], 3);
                        ?>
                        <div class="mb-3 pb-3 border-bottom">
                            <h6><a href="<?php echo $news['page_url']; ?>"><?php echo mb_strimwidth($news['page_title'], 0, 70, "..."); ?></a></h6>
                            <small class="text-muted"><?php echo timeAgo($news['createdon']); ?> | <?php echo $news['views']; ?> views</small>
                            <div class="mt-2">
                                <?php foreach ($keywords as $keyword) { ?>
                                    <a href="https://ibspotlight.com/search.php?q=<?php echo urlencode($keyword); ?>" class="badge bg-secondary text-decoration-none me-1"><?php echo htmlspecialchars($keyword); ?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
                <!-- News from ibspotlight.com -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Related News from IB Spotlight</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        // Fetch related news from ibspotlight.com API or RSS feed
                        $ibspotlight_news = fetchIbSpotlightNews($catname, 5);
                        
                        if (!empty($ibspotlight_news)) {
                            foreach ($ibspotlight_news as $news) {
                        ?>
                        <div class="mb-3 pb-3 border-bottom">
                            <?php if (!empty($news['image'])) { ?>
                                <img src="<?php echo htmlspecialchars($news['image']); ?>" class="img-fluid mb-2" alt="<?php echo htmlspecialchars($news['title']); ?>">
                            <?php } ?>
                            <h6><a href="<?php echo htmlspecialchars($news['url']); ?>" target="_blank"><?php echo mb_strimwidth(htmlspecialchars($news['title']), 0, 70, "..."); ?></a></h6>
                            <small class="text-muted"><?php echo htmlspecialchars($news['date']); ?></small>
                            <?php if (!empty($news['keywords'])) { ?>
                                <div class="mt-2">
                                    <?php foreach ($news['keywords'] as $keyword) { ?>
                                        <a href="https://ibspotlight.com/search.php?q=<?php echo urlencode($keyword); ?>" class="badge bg-secondary text-decoration-none me-1"><?php echo htmlspecialchars($keyword); ?></a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                            }
                        } else {
                            echo '<p>No related news found.</p>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Category Resources with keyword links -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><?php echo $catname; ?> Resources</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $popular_keywords = getPopularKeywords($catid, 8);
                        if (!empty($popular_keywords)) {
                            echo '<div class="mb-3">';
                            echo '<h6>Popular Keywords</h6>';
                            foreach (array_chunk($popular_keywords, 4) as $keyword_group) {
                                echo '<div class="d-flex flex-wrap mb-2">';
                                foreach ($keyword_group as $keyword) {
                                    echo '<a href="https://ibspotlight.com/search.php?q=' . urlencode($keyword['keyword']) . '" class="badge bg-light text-dark text-decoration-none me-1 mb-1">' . htmlspecialchars($keyword['keyword']) . '</a>';
                                }
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                        ?>
                        <div class="list-group">
                            <a href="https://ibspotlight.com/search.php?q=<?php echo urlencode($catname . ' guides'); ?>" class="list-group-item list-group-item-action"><?php echo $catname; ?> Guides</a>
                            <a href="https://ibspotlight.com/search.php?q=<?php echo urlencode($catname . ' research'); ?>" class="list-group-item list-group-item-action">Latest Research</a>
                            <a href="https://ibspotlight.com/search.php?q=<?php echo urlencode($catname . ' trends'); ?>" class="list-group-item list-group-item-action">Trending Topics</a>
                            <a href="https://ibspotlight.com/search.php?q=<?php echo urlencode($catname . ' experts'); ?>" class="list-group-item list-group-item-action">Expert Interviews</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            // Helper function to extract keywords from text
            function extractKeywords($text, $count = 3) {
                // Remove stop words and extract meaningful keywords
                $stopWords = ['the', 'and', 'for', 'with', 'that', 'this', 'are', 'was', 'were', 'has', 'have'];
                $words = str_word_count(strtolower($text), 1);
                $words = array_diff($words, $stopWords);
                $wordCounts = array_count_values($words);
                arsort($wordCounts);
                return array_slice(array_keys($wordCounts), 0, $count);
            }

            // Helper function to fetch news from IB Spotlight (mock implementation)
            function fetchIbSpotlightNews($category, $limit = 5) {
                // In a real implementation, you would call IB Spotlight's API or parse their RSS feed
                // Here's a mock implementation for demonstration
                
                $mockNews = [
                    [
                        'title' => 'Latest developments in ' . $category,
                        'url' => 'https://ibspotlight.com/article/123',
                        'image' => 'https://ibspotlight.com/images/news1.jpg',
                        'date' => '2 days ago',
                        'keywords' => [$category, 'trends', 'update']
                    ],
                    [
                        'title' => 'Expert analysis on ' . $category . ' market',
                        'url' => 'https://ibspotlight.com/article/124',
                        'image' => 'https://ibspotlight.com/images/news2.jpg',
                        'date' => '3 days ago',
                        'keywords' => [$category, 'analysis', 'market']
                    ],
                    // Add more mock news items as needed
                ];
                
                return array_slice($mockNews, 0, $limit);
            }

            // Helper function to get popular keywords for a category
            function getPopularKeywords($catid, $limit = 5) {
                // In a real implementation, query your database for popular keywords
                // Here's a mock implementation
                
                $commonKeywords = [
                    ['keyword' => 'trends', 'count' => 42],
                    ['keyword' => 'analysis', 'count' => 35],
                    ['keyword' => 'market', 'count' => 28],
                    ['keyword' => 'report', 'count' => 25],
                    ['keyword' => 'update', 'count' => 22],
                ];
                
                return array_slice($commonKeywords, 0, $limit);
            }
            ?>
            <!-- Sidebar -->
        </div>
    </div>
</div>