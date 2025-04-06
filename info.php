<?php
// Include the database connection file
include 'front_connect.php';

// Validate and sanitize the URL parameter
if (isset($_GET['url']) && !empty($_GET['url'])) {
    $url = strpos($_GET['url'], '.html') !== false ? $_GET['url'] : $_GET['url'] . ".html";
} else {
    // Redirect to 404 page if URL is missing or empty
    exit('<script type="text/javascript">window.location = "' . ERROR_404 . '";</script>');
}

// Initialize variables
$header = [];
$template_ = "";
$main_header = "";
$script = [];
$footer = [];
$page = [];

// Fetch page content from the database
$content = return_single_row("SELECT 
    pages.*,
    category.* , pages.isactive as page_active , pages.visibility as page_visibility
FROM pages
INNER JOIN category ON pages.catid = category.catid
WHERE 
    pages.soft_delete = 0 
    AND pages.page_url = '$url';
");

// Redirect to 404 if no content is found
if (empty($content)) {
    exit('<script type="text/javascript">window.location = "' . ERROR_404 . '";</script>');
}

// Check page visibility and user session
if (($content['page_visibility'] == 0 || $content['page_active'] == 0) && !isset($_SESSION['user'])) {
    exit('<script type="text/javascript">window.location = "' . ERROR_404 . '";</script>');
}



// Handle the content alert for logged-in users
if (($content['page_visibility'] == 0 || $content['page_active'] == 0) && isset($_SESSION['user'])) {
    
    $alert_message = "Content Visibility Notice\n";

    if ($content['page_visibility'] == 0) {
        $alert_message .= "This page is currently set to private and is not visible to public users.\n";
    }

    if ($content['page_active'] == 0) {
        $alert_message .= "This page is currently in draft and unpublished.\n";
    }

    $alert_message .= "Only admins and CMS users can access this page.\n";

    // Output both CSS and HTML for the alert
    echo '<div style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); background-color: #ff0000; color: white; padding: 15px 25px; border-radius: 5px; z-index: 9999; max-width: 80%; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); white-space: pre-line; font-family: Arial, sans-serif; font-size: 14px; animation: fadeIn 0.5s;">'.$alert_message.'</div>';

}


// Add header if specified in the content
if (!empty($content['header'])) {
    $header[] = $content['header'];
}

// Fetch site template details
$page = return_single_row("
    SELECT * 
    FROM site_template 
    WHERE st_id = " . $content['site_template_id'] . " 
    AND isactive = 1
");

// Add site template header, script, and footer if specified
if (!empty($page['st_header'])) {
    $header[] = replace_sysvari($page['st_header'], null);
}
if (!empty($page['st_script'])) {
    $script[] = replace_sysvari($page['st_script'], null);
}
if (!empty($page['st_footer'])) {
    $footer[] = replace_sysvari($page['st_footer'], getcwd() . "/");
}

// Fetch template page
$template_page = return_single_ans("
    SELECT template_page 
    FROM og_template 
    WHERE template_id = " . $content['template_id'] . " 
    AND isactive = 1
");

// Include the template page if it exists
if (!empty($template_page)) {
    $template_ = include_module('templates/' . $template_page, [
        'content' => $content,
        'PAGE_LOADER' => PAGE_LOADER,
        'PAGE_ID' => $content['pid']
    ], false);

    // Add template-specific header, script, and footer if functions exist
    if (function_exists("header_t")) {
        $header[] = header_t();
    }
    if (function_exists("script_t")) {
        $script[] = script_t();
    }
    if (function_exists("footer_t")) {
        $footer[] = footer_t();
    }
}

// Build the main header
$main_header = front_header($content['page_meta_title'], $content['page_meta_keywords'], $content['page_meta_desc'], $header);

// Output the template
echo replace_sysvari($main_header);
echo replace_sysvari($page['st_menue'], getcwd() . "/");
echo replace_sysvari($template_, getcwd() . "/");

// Include loading modal if PAGE_LOADER is enabled
if (PAGE_LOADER == 1) {
    require_once 'modals/loading.php';
}

// Add page-specific JavaScript if PAGE_LOADER is enabled
if (PAGE_LOADER == 1) {
    ?>
    <script type="text/javascript">
        var pageid = "<?php echo $content['pid']; ?>";
    </script>
    <script type="text/javascript" src="js/info.js"></script>
    <?php
}

// Track page views
if (!in_array($url, $_SESSION['pages_views'])) {
    Update("UPDATE pages SET views = views + 1 WHERE pid = " . $content['pid']);
    array_push($_SESSION['pages_views'], $url);
}

// Output scripts and footer
if (!empty($script)) {
    echo replace_sysvari(front_script($script));
}
if (!empty($footer)) {
    echo replace_sysvari(front_footer($footer));
}
?>