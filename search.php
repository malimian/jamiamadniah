<?php
include 'front_connect.php';

// Get search query from URL
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';
$safe_search_query = mysqli_real_escape_string($conn, $search_query);

// Set the page URL for meta information
$safe_url = 'search.php'; // Assuming your search page URL is 'search'

// Get page content for SEO
$content = return_single_row(
    "SELECT page_meta_title, site_template_id, page_meta_keywords, page_meta_desc, 
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
    '<link href="css/search.css" rel="stylesheet">',
];

// Output the header with all meta information
echo front_header(
    htmlspecialchars($content['page_meta_title'] ?? 'Search News'),
    htmlspecialchars($content['page_meta_keywords'] ?? 'news search, find articles, content search'),
    htmlspecialchars($content['page_meta_desc'] ?? 'Search our news articles by keywords'),
    $additional_libs,
    $template_id
);

// Output the navbar
$navbar_content = front_menu(null, $template_id);
if (!empty($navbar_content)) {
    echo replace_sysvari($navbar_content, getcwd() . "/");
}
?>

<style>
/* Search Page Styles */
.search-page {
    padding: 40px 0;
}

.search-form {
    margin-bottom: 40px;
}

.search-form .input-group {
    max-width: 800px;
    margin: 0 auto;
}

.search-form .form-control {
    height: 50px;
    font-size: 18px;
    border-radius: 30px 0 0 30px !important;
}

.search-form .btn {
    border-radius: 0 30px 30px 0 !important;
    padding: 10px 25px;
    font-size: 18px;
}

.search-results {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    padding: 30px;
}

.results-count {
    font-size: 18px;
    color: #666;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.search-result-item {
    padding: 25px 0;
    border-bottom: 1px solid #eee;
}

.search-result-item:last-child {
    border-bottom: none;
}

.search-result-item h3 {
    font-size: 22px;
    margin-bottom: 10px;
}

.search-result-item h3 a {
    color: #333;
    text-decoration: none;
}

.search-result-item h3 a:hover {
    color: #007bff;
}

.search-result-item .meta {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.search-result-item .meta .category a {
    color: #007bff;
    text-decoration: none;
}

.search-result-item .meta .date {
    margin-left: 15px;
}

.search-result-item .excerpt {
    color: #555;
    line-height: 1.6;
}

.search-result-item .excerpt strong {
    background-color: #fffde7;
    padding: 0 2px;
    font-weight: normal;
}

.no-results, .search-instructions {
    font-size: 18px;
    text-align: center;
    padding: 50px 0;
    color: #666;
}

.pagination {
    display: flex;
    flex-wrap: wrap; /* Allow wrapping */
    justify-content: center;
    margin-top: 40px;
    gap: 5px;
    max-width: 100%;
    overflow-x: auto; /* Prevent overflowing container */
    padding: 10px;
    box-sizing: border-box;
}

.pagination a, .pagination span {
    flex-shrink: 0; /* Prevent shrinking */
    display: inline-block;
    padding: 8px 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-decoration: none;
    color: #333;
    white-space: nowrap;
}

.pagination a:hover {
    background-color: #f5f5f5;
}

.pagination .current {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.pagination .prev, .pagination .next {
    font-weight: bold;
}


/* Featured card style */
.featured-result {
    background: #f8f9fa;
    border-left: 4px solid #007bff;
    padding: 25px;
    margin-bottom: 30px;
    border-radius: 4px;
}

.featured-result h3 {
    font-size: 24px;
}

.featured-result .excerpt {
    font-size: 16px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .search-results {
        padding: 20px;
    }
    
    .search-result-item {
        padding: 20px 0;
    }
    
    .search-result-item h3 {
        font-size: 20px;
    }
}
</style>

<!-- Hero Start -->
<div class="container-fluid hero-header bg-light position-relative">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25"></div>
    <div class="container position-relative z-index-1">
        <div class="row">
            <div class="col-lg-7">
                <div class="hero-header-inner animated zoomIn">
                    <h1 class="display-1 text-dark"><?= htmlspecialchars($content['page_title']) ?></h1>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= replace_sysvari($content['cat_url']) ?>"><?= htmlspecialchars(replace_sysvari($content['catname'])) ?></a></li>
                        <li class="breadcrumb-item text-dark" aria-current="page"><?= htmlspecialchars($content['page_title']) ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<div class="container-fluid bg-light position-relative search-page py-5" dir="rtl" style="text-align: right;">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25"></div>
    <div class="container position-relative z-index-1 text-center">
        <h1 class="mb-4"><?= htmlspecialchars($content['page_title'] ?? 'خبریں تلاش کریں') ?></h1>

        <div class="search-form d-flex justify-content-center">
            <form action="search.php" method="get" class="w-75">
                <div class="input-group" style="direction: ltr;">
                    <input type="text" name="q" class="form-control" placeholder="الفاظ درج کریں..." value="<?= htmlspecialchars($search_query ?? '') ?>">
                    <button class="btn btn-primary" type="submit">تلاش کریں</button>
                </div>
            </form>
        </div>
    </div>
</div>


 
    <div class="search-results">
        <?php
        if (!empty($search_query)) {
            // Pagination setup
            $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
            $per_page = 10;
            $offset = ($current_page - 1) * $per_page;

            // Get total count of matching articles
            $total_query = "SELECT COUNT(*) as total FROM pages 
                           LEFT JOIN category ON pages.catid = category.catid 
                           WHERE pages.soft_delete = 0 
                           AND category.soft_delete = 0 
                           AND pages.isactive = 1
                           AND (pages.page_title LIKE '%$safe_search_query%' 
                               OR pages.page_desc LIKE '%$safe_search_query%'
                               OR pages.page_meta_keywords LIKE '%$safe_search_query%')";
            
            $total_result = return_single_row($total_query);
            $total_items = $total_result['total'];
            $total_pages = ceil($total_items / $per_page);

            // Get paginated results
            $query = "SELECT pages.*, category.catname, category.cat_url 
                     FROM pages 
                     LEFT JOIN category ON pages.catid = category.catid 
                     WHERE pages.soft_delete = 0 
                     AND category.soft_delete = 0 
                     AND pages.isactive = 1
                     AND (pages.page_title LIKE '%$safe_search_query%' 
                         OR pages.page_desc LIKE '%$safe_search_query%'
                         OR pages.page_meta_keywords LIKE '%$safe_search_query%')
                     ORDER BY pages.createdon DESC
                     LIMIT $offset, $per_page";
            
            $results = return_multiple_rows($query);

            if (!empty($results)) {
                echo "<div class='results-count'>Found $total_items results for \"".htmlspecialchars($search_query)."\"</div>";
                
                // First result as featured
                $first_result = array_shift($results);
                echo "<div class='featured-result'>";
                echo "<h3><a href='{$first_result['page_url']}'>{$first_result['page_title']}</a></h3>";
                echo "<div class='meta'>";
                echo "<span class='category'><a href='{$first_result['cat_url']}'>{$first_result['catname']}</a></span>";
                echo "<span class='date'>".date('F j, Y', strtotime($first_result['createdon']))."</span>";
                echo "</div>";
                
                // Create a short excerpt
                $content = strip_tags($first_result['page_desc']);
                $pos = stripos($content, $search_query);
                $excerpt = '';
                
                if ($pos !== false) {
                    $start = max(0, $pos - 50);
                    $excerpt = '...' . substr($content, $start, 300) . '...';
                    // Highlight the search term
                    $excerpt = preg_replace("/(" . preg_quote($search_query) . ")/i", "<strong>$1</strong>", $excerpt);
                } else {
                    $excerpt = substr($content, 0, 300) . '...';
                }
                
                echo "<p class='excerpt'>{$excerpt}</p>";
                echo "<a href='{$first_result['page_url']}' class='btn btn-outline-primary'>Read Full Article</a>";
                echo "</div>";
                
                // Remaining results
                foreach ($results as $article) {
                    echo "<div class='search-result-item'>";
                    echo "<h3><a href='{$article['page_url']}'>{$article['page_title']}</a></h3>";
                    echo "<div class='meta'>";
                    echo "<span class='category'><a href='{$article['cat_url']}'>{$article['catname']}</a></span>";
                    echo "<span class='date'>".date('F j, Y', strtotime($article['createdon']))."</span>";
                    echo "</div>";
                    
                    // Create a short excerpt
                    $content = strip_tags($article['page_desc']);
                    $pos = stripos($content, $search_query);
                    $excerpt = '';
                    
                    if ($pos !== false) {
                        $start = max(0, $pos - 50);
                        $excerpt = '...' . substr($content, $start, 200) . '...';
                        // Highlight the search term
                        $excerpt = preg_replace("/(" . preg_quote($search_query) . ")/i", "<strong>$1</strong>", $excerpt);
                    } else {
                        $excerpt = substr($content, 0, 200) . '...';
                    }
                    
                    echo "<p class='excerpt'>{$excerpt}</p>";
                    echo "</div>";
                }

                // Pagination
                if ($total_pages > 1) {
                    echo "<div class='pagination'>";
                    if ($current_page > 1) {
                        echo "<a href='search.php?q=".urlencode($search_query)."&page=".($current_page-1)."' class='prev'>&laquo; Previous</a>";
                    }
                    
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $current_page) {
                            echo "<span class='current'>{$i}</span>";
                        } else {
                            echo "<a href='search.php?q=".urlencode($search_query)."&page={$i}'>{$i}</a>";
                        }
                    }
                    
                    if ($current_page < $total_pages) {
                        echo "<a href='search.php?q=".urlencode($search_query)."&page=".($current_page+1)."' class='next'>Next &raquo;</a>";
                    }
                    echo "</div>";
                }
            } else {
                echo "<div class='no-results'>No results found for \"".htmlspecialchars($search_query)."\"</div>";
            }
        } else {
            echo "<div class='search-instructions'>Enter keywords in the search box above to find news articles.</div>";
        }
        ?>
    </div>
</div>

<?php 
// Output footer and scripts
echo replace_sysvari(front_script(null, $template_id), getcwd() . "/");
echo replace_sysvari(front_footer(null, $template_id), getcwd() . "/");
?>