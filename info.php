<?php
// Include the database connection file
include 'front_connect.php';

// Validate and sanitize the URL parameter
if (isset($_GET['url']) && !empty($_GET['url'])) {
    $url = strpos($_GET['url'], '.html') !== false ? 
           htmlspecialchars($_GET['url']) : 
           htmlspecialchars($_GET['url']) . ".html";
} else {
    exit('<script type="text/javascript">window.location = "' . ERROR_404 . '";</script>');
}

// Initialize variables
$header = [];
$menu = [];
$scripts = [];
$footer = [];
$template_ = "";
$main_header = "";
$main_menu = "";
$main_scripts = "";
$main_footer = "";
$page = [];

// Fetch page content
$content = return_single_row("SELECT 
    pages.*, pages.createdby as pages_createdby ,
    category.*, pages.isactive as page_active, pages.visibility as page_visibility
FROM pages
INNER JOIN category ON pages.catid = category.catid
WHERE 
    pages.soft_delete = 0 
    AND pages.page_url = '$url'");

if (empty($content)) {
    exit('<script type="text/javascript">window.location = "' . ERROR_404 . '";</script>');
}

// Check page visibility
if (($content['page_visibility'] == 0 || $content['page_active'] == 0) && !isset($_SESSION['user'])) {
    exit('<script type="text/javascript">window.location = "' . ERROR_404 . '";</script>');
}




$organizedAttributes = organizeAttributes($content['template_id'], $content['pid']);


if(!empty($organizedAttributes))
    $content['attributes'] = $organizedAttributes;


$header[] = generateFaviconLinks(defined('SITE_LOGO') ? SITE_LOGO : '/favicon.png');

// Add content components if specified
if (!empty($content['header'])) {
    $header[] = $content['header'];
}
if (!empty($content['menu'])) {
    $menu[] = $content['menu'];
}
if (!empty($content['scripts'])) {
    $scripts[] = $content['scripts'];
}
if (!empty($content['footer'])) {
    $footer[] = $content['footer'];
}

// Fetch site template details
$page = return_single_row("
    SELECT * 
    FROM site_template 
    WHERE st_id = " . (int)$content['site_template_id'] . " 
    AND isactive = 1
");

// Add site template components if specified
if (!empty($page['st_header'])) {
    $header[] = replace_sysvari($page['st_header'], null);
}
if (!empty($page['st_menu'])) {
    $menu[] = replace_sysvari($page['st_menu'], null);
}
if (!empty($page['st_script'])) {
    $scripts[] = replace_sysvari($page['st_script'], null);
}
if (!empty($page['st_footer'])) {
    $footer[] = replace_sysvari($page['st_footer'], getcwd() . "/");
}

// Fetch template page
$template_page = return_single_ans("
    SELECT template_page 
    FROM og_template 
    WHERE template_id = " . (int)$content['template_id'] . " 
    AND isactive = 1
");

// Include the template page if it exists
if (!empty($template_page)) {
   
    $template_ = include_module('templates/' . $template_page, [
        'content' => $content,
        'PAGE_LOADER' => PAGE_LOADER,
        'PAGE_ID' => $content['pid']
    ], false);

    // Add template-specific components if functions exist
    if (function_exists("header_t")) {
        $header[] = header_t();
    }
    if (function_exists("menu_t")) {
        $menu[] = menu_t();
    }
    if (function_exists("script_t")) {
        $scripts[] = script_t();
    }
    if (function_exists("footer_t")) {
        $footer[] = footer_t();
    }
}


// Build the main components
$main_header = front_header(
    $content['page_meta_title'], 
    $content['page_meta_keywords'], 
    $content['page_meta_desc'], 
    $header,
    null,
    $content
);

$main_menu = front_menu($menu);
$main_scripts = front_script($scripts);
$main_footer = front_footer($footer);

/* ==================== OUTPUT SECTION ==================== */

// Output header
echo "<!-- HEADER SECTION START -->\n";
echo replace_sysvari($main_header , getcwd() . "/");
echo "\n<!-- HEADER SECTION END -->\n\n";

// Output menu
echo "<!-- MENU SECTION START -->\n";
echo replace_sysvari($main_menu , getcwd() . "/" );
echo "\n<!-- MENU SECTION END -->\n\n";

// Output template content
if (PAGE_LOADER == 1) {
  
    echo "<div id='template-content-container' style='display:none;'></div>\n\n";

    // Prepare data for JSON output
    $template_data = [
        'content' => replace_sysvari($template_, getcwd() . "/"),
        'page_id' => (int)$content['pid'],
        'page_url' => $url
    ];
    
    echo "<!-- MAIN CONTENT DATA (JSON PAGE LOADER) -->\n";
    echo '<script type="text/javascript">';
    echo 'var templateData = ' . json_encode($template_data) . ';';
    echo '</script>';
    echo "\n<!-- MAIN CONTENT DATA (JSON PAGE LOADER) END -->\n\n";

    echo '</div>';

    require_once 'modals/loading.php';

    // Add page-specific JavaScript if enabled
    echo "<!-- PAGE LOADER SCRIPT START -->\n";
    ?>
    <script type="text/javascript">
        var pageid = "<?php echo (int)$content['pid']; ?>";
    </script>
    <script type="text/javascript" src="js/info.js"></script>
    <?php
    echo "\n<!-- PAGE LOADER SCRIPT END -->\n\n";



}else{

    echo "<!-- MAIN CONTENT SECTION START -->\n";
    echo replace_sysvari($template_, getcwd() . "/");
    echo "\n<!-- MAIN CONTENT SECTION END -->\n\n";

}



// Track page views
if (!in_array($url, $_SESSION['pages_views'])) {
    Update("UPDATE pages SET views = views + 1 WHERE pid = " . (int)$content['pid']);
    array_push($_SESSION['pages_views'], $url);
}

// Output scripts
echo "<!-- PAGE SCRIPTS START -->\n";
echo replace_sysvari($main_scripts);
echo "\n<!-- PAGE SCRIPTS END -->\n\n";

// Output footer
echo "<!-- PAGE FOOTER START -->\n";
echo replace_sysvari($main_footer);
echo "\n<!-- PAGE FOOTER END -->\n\n";

// Content visibility alert for admins
if (($content['page_visibility'] == 0 || $content['page_active'] == 0) && isset($_SESSION['user'])) {
    echo "<!-- ADMIN ALERT START -->\n";
    $alert_message = "Content Visibility Notice\n";
    
    if ($content['page_visibility'] == 0) {
        $alert_message .= "This page is currently set to private and is not visible to public users.\n";
    }
    
    if ($content['page_active'] == 0) {
        $alert_message .= "This page is currently in draft and unpublished.\n";
    }
    
    $alert_message .= "Only admins and CMS users can access this page.\n";
    
    echo '<div style="position: fixed; bottom: 20px; left: 70%; transform: translateX(-50%); background-color: #ff0000; color: white; padding: 15px 25px; border-radius: 5px; z-index: 9999; max-width: 80%; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); white-space: pre-line; font-family: Arial, sans-serif; font-size: 14px; animation: fadeIn 0.5s;">'.htmlspecialchars($alert_message).'</div>';
    echo "\n<!-- ADMIN ALERT END -->\n\n";
}

// Edit button for authorized users
if(isset($_SESSION['user'])) { 
    $module_actions = isset($_SESSION['user']['module_actions']) ? $_SESSION['user']['module_actions'] : []; 
    $action_ids = array_column($module_actions, 'og_moduleactions_id'); 
    $has_edit = in_array(3, $action_ids); 
    
    if($has_edit) { 
        echo "<!-- EDIT BUTTON START -->\n";
        echo '<button style="position:fixed;bottom:20px;left:50%;transform:translateX(-50%);background-color:#4CAF50;color:white;padding:12px 25px;border-radius:30px;z-index:9999;text-align:center;box-shadow:0 4px 8px rgba(0,0,0,0.3);font-family:Arial,sans-serif;font-size:14px;border:none;cursor:pointer;transition:all 0.3s;display:flex;align-items:center;justify-content:center;" target="_blank" onclick="location.href=\''.SITE_ADMIN.'/editpage.php?id='.(int)$content['pid'].'\'"><i class="fa fa-edit" style="margin-right:8px;"></i>Edit</button>';
        echo "\n<!-- EDIT BUTTON END -->\n";
    } 
}