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

  


<?php
echo replace_sysvari(Basefooter(null, $template_id), getcwd() . "/");
echo replace_sysvari(BaseScript(null, $template_id), getcwd() . "/");
?>