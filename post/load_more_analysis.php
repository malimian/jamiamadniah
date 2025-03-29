<?php
include '../front_connect.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$catid = isset($_GET['catid']) ? intval($_GET['catid']) : 0;

// Initialize session arrays if they don't exist
if (!isset($_SESSION['displayed_pids'])) {
    $_SESSION['displayed_pids'] = [];
}

// Create a category-specific key for storing displayed post IDs
$category_key = 'displayed_pids_' . $catid;

// Initialize the category-specific array if it doesn't exist
if (!isset($_SESSION[$category_key])) {
    $_SESSION[$category_key] = [];
}

$not_show_more_then_once = $_SESSION[$category_key];

// Get the category name for the heading
$category = return_single_row("SELECT catname FROM category WHERE catid = $catid");
$catname = $category ? $category['catname'] : 'Analysis';

// Query for more analysis posts
$query = "SELECT * FROM pages 
    WHERE catid = $catid 
    AND isactive = 1 
    AND soft_delete = 0 
    AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ") 
    AND template_id = 7 
    ORDER BY createdon DESC 
    LIMIT $offset, 5";

$analysis_news = return_multiple_rows($query);

// Output the results
foreach ($analysis_news as $news) {
    // Add to displayed PIDs array for this category
    if (!in_array($news['pid'], $_SESSION[$category_key])) {
        $_SESSION[$category_key][] = $news['pid'];
    }
    ?>
    <div class="card mb-3 analysis-item">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?php echo htmlspecialchars($news['featured_image']); ?>" 
                     class="img-fluid rounded-start img-zoomin" 
                     alt="<?php echo htmlspecialchars($news['page_title']); ?>"
                     onerror="this.src='path/to/default-image.jpg'">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($news['page_title']); ?></h5>
                    <p class="card-text"><?php echo mb_strimwidth(cleanContent($news['page_desc']), 0, 200, "..."); ?></p>
                    <p class="card-text">
                        <small class="text-muted">
                            Analysis by <?php echo htmlspecialchars($news['article_author']); ?>
                            | <?php echo date('M j, Y', strtotime($news['createdon'])); ?>
                        </small>
                    </p>
                    <a href="<?php echo htmlspecialchars($news['page_url']); ?>" class="link-hover btn border border-primary rounded-pill text-dark">Read Analysis</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}

// If no results were found, output a message
if (empty($analysis_news)) {
    echo '<div class="alert alert-info">No more ' . htmlspecialchars($catname) . ' analysis to display.</div>';
}

// Optional: Clean up old session data periodically
$max_categories_to_remember = 10; // Keep track of the last X categories
if (count($_SESSION['displayed_pids']) > $max_categories_to_remember) {
    // Remove oldest category data (simple FIFO approach)
    $oldest_key = array_key_first($_SESSION['displayed_pids']);
    unset($_SESSION['displayed_pids'][$oldest_key]);
}
?>