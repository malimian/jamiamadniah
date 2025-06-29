<?php
include 'front_connect.php';

$url = "business.php";

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

<style>
    .owl-carousel img {
        height: 250px; /* Adjust height as needed */
        object-fit: cover; /* Ensures the image covers the area without stretching */
    }
    .business-highlight {
        background-color: #f8f9fa;
        border-left: 4px solid #007bff;
        padding: 15px;
        margin-bottom: 20px;
    }
    .market-data {
        background-color: #fff;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .stock-ticker {
        background-color: #343a40;
        color: white;
        padding: 10px 0;
        overflow: hidden;
    }
</style>

<!-- Business Highlights Section -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Business Highlights</h2>
                <div class="business-highlight">
                    <?php
                    $business_highlight = return_single_row("SELECT * FROM pages WHERE catid = 119 AND isactive = 1 AND soft_delete = 0 ORDER BY createdon DESC LIMIT 1");
                    $not_show_more_then_once[] = $business_highlight['pid'];
                    ?>
                    <h3><?php echo $business_highlight['page_title']; ?></h3>
                    <p><?php echo mb_strimwidth(cleanContent($business_highlight['page_desc']), 0, 300, "..."); ?></p>
                    <a href="<?php echo $business_highlight['page_url']; ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>

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
                              { "proName": "NASDAQ:AMZN", "title": "Amazon" },
                              { "proName": "NYSE:BRK.B", "title": "Berkshire Hathaway" },
                              { "proName": "NASDAQ:NVDA", "title": "NVIDIA" },
                              { "proName": "NASDAQ:FB", "title": "Meta (Facebook)" },
                              { "proName": "NASDAQ:NFLX", "title": "Netflix" },
                              { "proName": "NYSE:V", "title": "Visa" },
                              { "proName": "NYSE:JNJ", "title": "Johnson & Johnson" },
                              { "proName": "NYSE:JPM", "title": "JPMorgan Chase" },
                              { "proName": "NYSE:PG", "title": "Procter & Gamble" },
                              { "proName": "NYSE:KO", "title": "Coca-Cola" },
                              { "proName": "NYSE:PEP", "title": "PepsiCo" },
                              { "proName": "NASDAQ:INTC", "title": "Intel" },
                              { "proName": "NASDAQ:AMD", "title": "AMD" },
                              { "proName": "NYSE:XOM", "title": "ExxonMobil" },
                              { "proName": "NYSE:CVX", "title": "Chevron" },
                              { "proName": "NYSE:BABA", "title": "Alibaba" },
                              { "proName": "NASDAQ:PYPL", "title": "PayPal" },
                              { "proName": "NASDAQ:ADBE", "title": "Adobe" },
                              { "proName": "NYSE:DIS", "title": "Disney" },
                              { "proName": "NYSE:NKE", "title": "Nike" },
                              { "proName": "NYSE:WMT", "title": "Walmart" },
                              { "proName": "NASDAQ:CSCO", "title": "Cisco" },
                              { "proName": "NASDAQ:QCOM", "title": "Qualcomm" },
                              { "proName": "NYSE:MCD", "title": "McDonald's" },
                              { "proName": "NYSE:IBM", "title": "IBM" },
                              { "proName": "NYSE:UNH", "title": "UnitedHealth" },
                              { "proName": "NASDAQ:TXN", "title": "Texas Instruments" },
                              { "proName": "NYSE:MMM", "title": "3M" },
                              { "proName": "NYSE:HON", "title": "Honeywell" },
                              { "proName": "NASDAQ:SBUX", "title": "Starbucks" },
                              { "proName": "NYSE:GS", "title": "Goldman Sachs" },
                              { "proName": "NYSE:T", "title": "AT&T" },
                              { "proName": "NASDAQ:VZ", "title": "Verizon" },
                              { "proName": "NYSE:CAT", "title": "Caterpillar" },
                              { "proName": "NYSE:BA", "title": "Boeing" },
                              { "proName": "NYSE:LMT", "title": "Lockheed Martin" },
                              { "proName": "NYSE:GE", "title": "General Electric" },
                              { "proName": "NYSE:F", "title": "Ford" },
                              { "proName": "NYSE:GM", "title": "General Motors" },
                              { "proName": "NASDAQ:AVGO", "title": "Broadcom" },
                              { "proName": "NYSE:BK", "title": "Bank of New York Mellon" },
                              { "proName": "NASDAQ:CRM", "title": "Salesforce" },
                              { "proName": "NASDAQ:ORCL", "title": "Oracle" },
                              { "proName": "NYSE:SPGI", "title": "S&P Global" },
                              { "proName": "NYSE:TGT", "title": "Target" },
                              { "proName": "NASDAQ:GOOG", "title": "Alphabet" },
                              { "proName": "NASDAQ:TSM", "title": "TSMC" },
                              { "proName": "NYSE:ADP", "title": "ADP" },
                              { "proName": "NYSE:MRK", "title": "Merck" },
                              { "proName": "NYSE:MO", "title": "Altria Group" },
                              { "proName": "NYSE:USB", "title": "US Bancorp" },
                              { "proName": "NASDAQ:ASML", "title": "ASML Holding" },
                              { "proName": "NYSE:SO", "title": "Southern Company" },
                              { "proName": "NYSE:DUK", "title": "Duke Energy" },
                              { "proName": "NYSE:PLD", "title": "Prologis" },
                              { "proName": "NASDAQ:BKNG", "title": "Booking Holdings" },
                              { "proName": "NASDAQ:CHTR", "title": "Charter Communications" },
                              { "proName": "NASDAQ:KHC", "title": "Kraft Heinz" },
                              { "proName": "NYSE:CCI", "title": "Crown Castle" },
                              { "proName": "NYSE:O", "title": "Realty Income" },
                              { "proName": "NYSE:WM", "title": "Waste Management" },
                              { "proName": "NYSE:AIG", "title": "AIG" },
                              { "proName": "NYSE:PRU", "title": "Prudential Financial" },
                              { "proName": "NYSE:SLB", "title": "Schlumberger" },
                              { "proName": "NYSE:CL", "title": "Colgate-Palmolive" },
                              { "proName": "NYSE:KMB", "title": "Kimberly-Clark" },
                              { "proName": "NYSE:ROP", "title": "Roper Technologies" },
                              { "proName": "NYSE:PSA", "title": "Public Storage" },
                              { "proName": "NYSE:HSY", "title": "Hershey" },
                              { "proName": "NYSE:ALL", "title": "Allstate" },
                              { "proName": "NYSE:DHR", "title": "Danaher" },
                              { "proName": "NYSE:MS", "title": "Morgan Stanley" },
                              { "proName": "NYSE:BAC", "title": "Bank of America" }
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

<!-- Main Business News Section -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Latest Business News -->
                <div class="mb-5">
                    <h2 class="mb-4">Latest Business News</h2>
                    <div class="row">
                        <?php
                        $latest_business_news = return_multiple_rows("SELECT * FROM pages WHERE catid = 119 AND isactive = 1 AND soft_delete = 0 AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") ORDER BY createdon DESC LIMIT 6");
                        
                        foreach ($latest_business_news as $news) {
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
                

              <!-- Business Analysis -->
<div class="mb-5">
    <h2 class="mb-4">Business Analysis</h2>
    <div id="analysis-container">
        <?php
        $analysis_news = return_multiple_rows("SELECT * FROM pages WHERE catid = 119 AND isactive = 1 AND soft_delete = 0 AND pid 
            NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") AND template_id = 7 ORDER BY createdon DESC LIMIT 5");
        
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
                        <a href="<?php echo $news['page_url']; ?>" class="btn btn-primary">Read Analysis</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    
    <div class="text-center mt-4">
        <button id="load-more-btn" class="btn btn-outline-primary" data-offset="5" data-catid="119">
            Load More Analysis
        </button>
        <div id="loading-spinner" class="spinner-border text-primary d-none" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-btn');
    const analysisContainer = document.getElementById('analysis-container');
    const loadingSpinner = document.getElementById('loading-spinner');
    
    loadMoreBtn.addEventListener('click', function() {
        const offset = parseInt(this.getAttribute('data-offset'));
        const catid = this.getAttribute('data-catid');
        
        // Show loading spinner
        loadMoreBtn.classList.add('d-none');
        loadingSpinner.classList.remove('d-none');
        
        // AJAX request to load more news
        fetch(`post/load_more_analysis.php?offset=${offset}&catid=${catid}`)
            .then(response => response.text())
            .then(data => {
                if (data.trim() !== '') {
                    analysisContainer.insertAdjacentHTML('beforeend', data);
                    this.setAttribute('data-offset', offset + 5);
                    loadMoreBtn.classList.remove('d-none');
                } else {
                    this.textContent = 'No more analysis to load';
                    this.classList.add('disabled');
                }
                loadingSpinner.classList.add('d-none');
            })
            .catch(error => {
                console.error('Error loading more analysis:', error);
                loadingSpinner.classList.add('d-none');
                loadMoreBtn.classList.remove('d-none');
            });
    });
});
</script>


            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Trending Business News -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Trending Business News</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $trending_news = return_multiple_rows("SELECT * FROM pages WHERE catid = 119 AND isactive = 1 AND soft_delete = 0 AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") ORDER BY views DESC LIMIT 5");
                        
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
                        <div class="mb-3 pb-3 border-bottom">
                            <h6>Earnings Report: Amazon</h6>
                            <small class="text-muted">July 27, 2023 | Q2 Results</small>
                        </div>
                        <div class="mb-3">
                            <h6>Economic Summit</h6>
                            <small class="text-muted">August 15, 2023 | Global Markets</small>
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
                            <div class="col-4 text-center mb-3">
                                <img src="https://via.placeholder.com/80" class="rounded-circle mb-2" alt="CEO">
                                <h6 class="mb-0">Jeff Bezos</h6>
                                <small>Amazon</small>
                            </div>
                            <div class="col-4 text-center mb-3">
                                <img src="https://via.placeholder.com/80" class="rounded-circle mb-2" alt="CEO">
                                <h6 class="mb-0">Mark Zuckerberg</h6>
                                <small>Meta</small>
                            </div>
                            <div class="col-4 text-center mb-3">
                                <img src="https://via.placeholder.com/80" class="rounded-circle mb-2" alt="CEO">
                                <h6 class="mb-0">Warren Buffett</h6>
                                <small>Berkshire Hathaway</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Business Resources -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Business Resources</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">Market Research Reports</a>
                            <a href="#" class="list-group-item list-group-item-action">Economic Calendar</a>
                            <a href="#" class="list-group-item list-group-item-action">Stock Screener</a>
                            <a href="#" class="list-group-item list-group-item-action">Business Glossary</a>
                            <a href="#" class="list-group-item list-group-item-action">Startup Guides</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
    </div>
</div>

<?php
echo replace_sysvari(Basefooter(null, $template_id), getcwd() . "/");
echo replace_sysvari(BaseScript(null, $template_id), getcwd() . "/");
?>
</body>
</html>