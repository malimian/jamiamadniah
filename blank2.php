<?php
include 'front_connect.php';

$url = basename($_SERVER['PHP_SELF']);

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
    '<link href="css/checkout.css" rel="stylesheet">',
    // Add any other CSS/JS files needed
];

// Output the header with all meta information
echo front_header(
    htmlspecialchars($content['page_meta_title'] ?? 'Page'),
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

  


<?php 
echo replace_sysvari(front_script(null, $template_id), getcwd() . "/");
?>
<?php
echo replace_sysvari(front_footer(null, $template_id), getcwd() . "/");
?>