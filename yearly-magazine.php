<?php
include 'front_connect.php';

$url = "yearly-magazine.php";
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
    '<link href="css/checkout.css" rel="stylesheet">'
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
$navbar_content = front_menu(null, $template_id);
if (!empty($navbar_content)) {
    echo replace_sysvari($navbar_content, getcwd() . "/");
}
?>

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

<?php 
echo replace_sysvari(front_script(null, $template_id), getcwd() . "/");
?>

<?php
echo replace_sysvari(front_footer(null, $template_id), getcwd() . "/");
?>