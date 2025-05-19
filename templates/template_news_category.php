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

// print_r($content);

$catid = $content['catid'];
$catname = $content['catname'];
?>

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
    }
    <?php if ($catid == 119) { /* Business-specific styles */ ?>
    .stock-ticker {
        background-color: #343a40;
        color: white;
        padding: 10px 0;
        overflow: hidden;
    }
    <?php } ?>

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
    
    /* Optional: Ensure the card body takes full height */
    .row.g-0 .col-md-8 .card-body {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    /* Push the button to the bottom */
    .row.g-0 .col-md-8 .card-body a {
        margin-top: auto;
    }
</style>

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
                                <img src="<?php echo $news['featured_image']; ?>" class="card-img-top" alt="<?php echo $news['page_title']; ?>">
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
                                    <img src="<?php echo $news['featured_image']; ?>" class="img-fluid rounded-start img-zoomin" alt="<?php echo $news['page_title']; ?>">
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
                        <button id="load-more-btn" class="btn btn-outline-primary" data-offset="5" data-catid="<?php echo $catid; ?>">
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
                        ?>
                        <div class="mb-3 pb-3 border-bottom">
                            <h6><a href="<?php echo $news['page_url']; ?>"><?php echo mb_strimwidth($news['page_title'], 0, 70, "..."); ?></a></h6>
                            <small class="text-muted"><?php echo timeAgo($news['createdon']); ?> | <?php echo $news['views']; ?> views</small>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
                <?php if ($catid == 119) { /* Business-specific sidebar items */ ?>
                <!-- Business Events Calendar -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Upcoming Business Events</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 pb-3 border-bottom">
                            <h6>Federal Reserve Meeting</h6>
                            <small class="text-muted">June 14, 2023 | Interest Rate Decision</small>
                        </div>
                        <div class="mb-3 pb-3 border-bottom">
                            <h6>Apple Product Launch</h6>
                            <small class="text-muted">June 20, 2023 | WWDC Conference</small>
                        </div>
                        <div class="mb-3">
                            <h6>Earnings Report: Amazon</h6>
                            <small class="text-muted">July 27, 2023 | Q2 Results</small>
                        </div>
                    </div>
                </div>
                
                <!-- Business Leaders -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Business Leaders</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-center mb-3">
                                <img src="https://via.placeholder.com/80" class="rounded-circle mb-2" alt="CEO">
                                <h6 class="mb-0">Elon Musk</h6>
                                <small>Tesla</small>
                            </div>
                            <div class="col-4 text-center mb-3">
                                <img src="https://via.placeholder.com/80" class="rounded-circle mb-2" alt="CEO">
                                <h6 class="mb-0">Tim Cook</h6>
                                <small>Apple</small>
                            </div>
                            <div class="col-4 text-center mb-3">
                                <img src="https://via.placeholder.com/80" class="rounded-circle mb-2" alt="CEO">
                                <h6 class="mb-0">Satya Nadella</h6>
                                <small>Microsoft</small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } elseif ($catid == 120) { /* Health-specific sidebar items */ ?>
                <!-- Health Resources -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Health Resources</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">Health Tips</a>
                            <a href="#" class="list-group-item list-group-item-action">Doctor Finder</a>
                            <a href="#" class="list-group-item list-group-item-action">Symptom Checker</a>
                            <a href="#" class="list-group-item list-group-item-action">Nutrition Guide</a>
                        </div>
                    </div>
                </div>
                <?php } elseif ($catid == 121) { /* Sports-specific sidebar items */ ?>
                <!-- Sports Scores -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Live Scores</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 pb-3 border-bottom">
                            <h6>NBA: Lakers vs. Warriors</h6>
                            <small class="text-muted">Q3: 89-85 (Lakers lead)</small>
                        </div>
                        <div class="mb-3 pb-3 border-bottom">
                            <h6>NFL: Patriots vs. Dolphins</h6>
                            <small class="text-muted">3rd Quarter: 21-14</small>
                        </div>
                        <div class="mb-3">
                            <h6>Soccer: Premier League</h6>
                            <small class="text-muted">Man Utd 2 - 1 Chelsea (FT)</small>
                        </div>
                    </div>
                </div>
                <?php } elseif ($catid == 122) { /* Technology-specific sidebar items */ ?>
                <!-- Tech Updates -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Tech Updates</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 pb-3 border-bottom">
                            <h6>New iPhone Release</h6>
                            <small class="text-muted">Coming September 2023</small>
                        </div>
                        <div class="mb-3 pb-3 border-bottom">
                            <h6>Windows 12 Preview</h6>
                            <small class="text-muted">Available for developers</small>
                        </div>
                        <div class="mb-3">
                            <h6>AI Breakthrough</h6>
                            <small class="text-muted">New model beats human performance</small>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <!-- Category Resources -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><?php echo $catname; ?> Resources</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action"><?php echo $catname; ?> Guides</a>
                            <a href="#" class="list-group-item list-group-item-action">Latest Research</a>
                            <a href="#" class="list-group-item list-group-item-action">Trending Topics</a>
                            <a href="#" class="list-group-item list-group-item-action">Expert Interviews</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>