<?php
/**
 * Generate JavaScript global variables from og_settings
 */
function generate_js_globals() {
    global $and_gc;
    
    // Fetch all settings where call_on is 0 (all) or 1 (frontend only) and are active
    $query = "SELECT settings_name, settings_value 
              FROM og_settings 
              WHERE (call_on = 0 OR call_on = 1) 
              AND isactive = 1 
              AND soft_delete = 0";
    
    $settings = return_multiple_rows($query);

    $js_output = "<script>\n";
    $js_output .= "// Auto-generated global JS variables from og_settings\n";
    
    if (!empty($settings)) {
        foreach ($settings as $setting) {
            $var_name = $setting['settings_name'];
            $var_value = $setting['settings_value'];
            
            // Sanitize the variable name for JavaScript
            $js_var_name = preg_replace('/[^a-zA-Z0-9_]/', '_', $var_name);
            
            // Convert numeric/boolean values and JSON strings
            if (is_numeric($var_value)) {
                $js_value = $var_value;
            } elseif ($var_value === 'true' || $var_value === 'false') {
                $js_value = $var_value;
            } elseif (json_decode($var_value) !== null) {
                $js_value = json_decode($var_value);
            } else {
                $js_value = '"' . addslashes($var_value) . '"';
            }
            
            $js_output .= "var {$js_var_name} = {$js_value};\n";
        }
    }
    
    $js_output .= "</script>\n";
    return $js_output;
}


/**
 * Generate Organization Schema.org JSON-LD markup using settings from og_settings
 */
function generate_organization_schema() {
    global $and_gc;
    
    // Fetch all settings where call_on is 0 (all) or 1 (frontend only) and are active
    $query = "SELECT settings_name, settings_value 
              FROM og_settings 
              WHERE (call_on = 0 OR call_on = 1) 
              AND isactive = 1 
              AND soft_delete = 0";
    
    $settings = return_multiple_rows($query);
    
    // Convert settings to associative array for easy access
    $settings_array = [];
    foreach ($settings as $setting) {
        $settings_array[$setting['settings_name']] = $setting['settings_value'];
    }

    // Build sameAs array from social media URLs
    $social_fields = [
        'FACEBOOK', 'TWITTER', 'INSTAGRAM', 'LINKEDIN', 'YOUTUBE',
        'PINTEREST', 'SNAPCHAT', 'TIKTOK', 'REDDIT', 'WHATSAPP', 'TELEGRAM'
    ];
    
    $sameAs = [];
    foreach ($social_fields as $field) {
        if (!empty($settings_array[$field])) {
            $sameAs[] = $settings_array[$field];
        }
    }

    // Build the schema structure
    $schema = [
        "@context" => "http://schema.org",
        "@type" => "Organization",
        "name" => $settings_array['SITE_TITLE'] ?? 'Default Organization',
        "url" => $settings_array['SITE_BASE_URL'] ?? '',
        "sameAs" => $sameAs
    ];

    // Add optional fields if they exist
    $optional_fields = [
        'logo' => 'SITE_LOGO',
        'telephone' => 'SITE_TELNO',
        'email' => 'SITE_EMAIL',
        'description' => 'SITE_TAGLINE'
    ];
    
    foreach ($optional_fields as $schema_field => $db_field) {
        if (!empty($settings_array[$db_field])) {
            $schema[$schema_field] = $settings_array[$db_field];
        }
    }

    // Remove empty values (except sameAs which can be empty array)
    $schema = array_filter($schema, function($value, $key) {
        return !empty($value) || $key === 'sameAs';
    }, ARRAY_FILTER_USE_BOTH);

    return '<script type="application/ld+json">' . 
           json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . 
           '</script>';
}

/**
 * front_header Function with Template Support
 * 
 * @param string|null $title Page title
 * @param string|null $keywords Meta keywords
 * @param string|null $description Meta description
 * @param array|null $libs Additional libraries/scripts
 * @param int|null $template_id Template ID from database
 * @return string Generated header content
 */
function front_header($title = null, $keywords = null, $description = null, $libs = null, $template_id = null) {
    global $and_gc;

    // Sanitize inputs
    $title = htmlspecialchars($title ?? '', ENT_QUOTES, 'UTF-8');
    $keywords = htmlspecialchars($keywords ?? '', ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($description ?? '', ENT_QUOTES, 'UTF-8');
    $author = htmlspecialchars(Company ?? 'Company', ENT_QUOTES, 'UTF-8');
    $template_id = filter_var($template_id, FILTER_VALIDATE_INT);

    // Fetch header from template if ID is valid
    $header = '';
    if (!empty($template_id)) {
        $site_header = return_single_ans(
            "SELECT st_header FROM site_template WHERE st_id = $template_id $and_gc AND isactive = 1"
        );
        $header = $site_header ?? '';
    }

    // Determine language
    $lang = 'en';
    if (isset($_GET['lang'])) {
        $lang = preg_replace('/[^a-z]/', '', strtolower($_GET['lang']));
        setcookie('googtrans', "/en/{$lang}", 0, '/', '', false, true);
    }

    // Live streaming status
    $islive_streaming = json_encode(return_single_ans("SELECT isactive FROM category WHERE catid = 124"));

    // Build additional libs as string
    $libs_output = '';
    if (!empty($libs)) {
        if (is_array($libs)) {
            foreach ($libs as $lib) {
                $libs_output .= $lib . "\n";
            }
        } else {
            $libs_output .= $libs . "\n";
        }
    }

    $js_globals = generate_js_globals();

    // Generate the schema markup
    $organization_schema = generate_organization_schema();


return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{$title}</title>
    <meta name="title" content="{$title}">
    <meta name="description" content="{$description}">
    <meta name="keywords" content="{$keywords}">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="{$author}">

    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">

    <!-- Organization Schema -->
    {$organization_schema}


    <!-- Global JavaScript Variables -->
    {$js_globals}


    <!-- Google Translate -->
    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'ar,ur,en',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }

    var islive_streaming = {$islive_streaming};
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    {$header}
    {$libs_output}
</head>
HTML;
}
?>