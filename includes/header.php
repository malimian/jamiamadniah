<?php
/**
 * Generate article-specific meta tags for news website
 * 
 * @param array $article Article data array
 * @return string Generated meta tags
 */
function generate_article_meta_tags($article) {
    global $and_gc;
    
    // Required fields with defaults
    $title = !empty($article['page_title']) ? htmlspecialchars($article['page_title'], ENT_QUOTES, 'UTF-8') : '';
    $description = !empty($article['page_meta_desc']) ? htmlspecialchars($article['page_meta_desc'], ENT_QUOTES, 'UTF-8') : '';
    $url = !empty($article['page_canonical_url']) ? htmlspecialchars($article['page_canonical_url'], ENT_QUOTES, 'UTF-8') : '';
    $image = !empty($article['featured_image']) ? htmlspecialchars($article['featured_image'], ENT_QUOTES, 'UTF-8') : '';

    // Article specific fields
    $published_time = !empty($article['createdon']) ? date('c', strtotime($article['createdon'])) : '';
    $modified_time = !empty($article['updatedon']) ? date('c', strtotime($article['updatedon'])) : $published_time;
    $author = !empty($article['article_author']) ? htmlspecialchars($article['article_author'], ENT_QUOTES, 'UTF-8') : '';
    $section = !empty($article['catid']) ? (int)$article['catid'] : 0; // assuming this maps to a category ID, not name
    $tags = !empty($article['page_meta_keywords']) ? htmlspecialchars($article['page_meta_keywords'], ENT_QUOTES, 'UTF-8') : '';

    // Publisher info from settings
    $publisher_name = defined('SITE_TITLE') ? SITE_TITLE : '';
    $publisher_logo = defined('SITE_LOGO') ? SITE_LOGO : '';
    
    // Generate meta tags
    $meta_tags = <<<HTML
<!-- Primary Article Meta Tags -->
<meta name="title" content="{$title}">
<meta name="description" content="{$description}">
<meta name="news_keywords" content="{$tags}">
<meta name="author" content="{$author}">
<meta name="section" content="{$section}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:title" content="{$title}">
<meta property="og:description" content="{$description}">
<meta property="og:url" content="{$url}">
<meta property="og:image" content="{$image}">
<meta property="og:site_name" content="{$publisher_name}">
<meta property="article:published_time" content="{$published_time}">
<meta property="article:modified_time" content="{$modified_time}">
<meta property="article:author" content="{$author}">
<meta property="article:section" content="{$section}">
<meta property="article:tag" content="{$tags}">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{$title}">
<meta name="twitter:description" content="{$description}">
<meta name="twitter:url" content="{$url}">
<meta name="twitter:image" content="{$image}">
<meta name="twitter:label1" content="Written by">
<meta name="twitter:data1" content="{$author}">
<meta name="twitter:label2" content="Filed under">
<meta name="twitter:data2" content="{$section}">

HTML;

    return $meta_tags;
}
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
 * Generate Organization Schema.org JSON-LD markup with integrated SEO settings
 * Includes all recommended and optional fields per Google's guidelines
 */
function generate_organization_schema($page_meta = []) {
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

    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') $protocol = "https://";
    else $protocol = "http://";

    // Base URL with proper formatting
    $base_url = $protocol.rtrim($settings_array['SITE_BASE_URL'] ?? '', '/');

    // Build the schema structure with page-specific overrides
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "Organization",
        "name" => $settings_array['SITE_TITLE'] ?? 'Default Organization',
        "url" => $page_meta['page_canonical_url'] ?? $base_url ?? '',
        "logo" => $page_meta['social_image'] ?? $settings_array['SITE_LOGO'] ?? '',
        "image" => $page_meta['social_image'] ?? $settings_array['SITE_LOGO'] ?? '',
        "sameAs" => $sameAs,
        "potentialAction" => [
            "@type" => "SearchAction",
            "target" => $base_url . "/search.php?q={search_term_string}",
            "query-input" => "required name=search_term_string"
        ]
    ];

    // Parse address if SHOP_LOCATION exists
    $address = [];
    if (!empty($settings_array['SHOP_LOCATION'])) {
        // Sample format: "6101 Cherry Avenue Suite 102A - 206 Fontana CA 92336"
        $location = $settings_array['SHOP_LOCATION'];
        
        // Extract ZIP code (last 5-digit group)
        preg_match('/\b(\d{5})\b/', $location, $zip_matches);
        $postalCode = $zip_matches[1] ?? '';
        $location = trim(str_replace($postalCode, '', $location));
        
        // Extract state (2-letter code before ZIP)
        preg_match('/\b([A-Z]{2})\b/', $location, $state_matches);
        $addressRegion = $state_matches[1] ?? '';
        $location = trim(str_replace($addressRegion, '', $location));
        
        // Extract city (last remaining word before state)
        $parts = explode(' ', $location);
        $addressLocality = array_pop($parts);
        $location = trim(implode(' ', $parts));
        
        // The rest is street address
        $streetAddress = str_replace([' ,', ', '], ', ', $location); // Normalize commas
        
        $address = [
            "@type" => "PostalAddress",
            "streetAddress" => $streetAddress,
            "addressLocality" => $addressLocality,
            "addressRegion" => $addressRegion,
            "postalCode" => $postalCode,
            "addressCountry" => "US" // Default to US, can be made configurable
        ];
    }


    // Add contact information
    $optional_fields = [
        'telephone' => ['SITE_TELNO', 'page_telno'],
        'email' => ['SITE_EMAIL', 'page_email'],
        'description' => ['SITE_TAGLINE', 'page_meta_desc'],
        'foundingDate' => ['COMPANY_FOUNDING_DATE'],
        'founder' => ['COMPANY_FOUNDER']
    ];
    
    foreach ($optional_fields as $schema_field => $field_options) {
        if (is_array($field_options)) {
            foreach ($field_options as $field) {
                if (!empty($page_meta[$field])) {
                    $schema[$schema_field] = $page_meta[$field];
                    break;
                } elseif (!empty($settings_array[$field])) {
                    $schema[$schema_field] = $settings_array[$field];
                    break;
                }
            }
        } elseif (!empty($settings_array[$field_options])) {
            $schema[$schema_field] = $settings_array[$field_options];
        }
    }

    // Add indexing information if available
    if (isset($page_meta['page_meta_index'])) {
        $schema['mainEntityOfPage'] = [
            "@type" => "WebPage",
            "@id" => $page_meta['page_canonical_url'] ?? $base_url ?? '',
            "isIndexed" => (bool)$page_meta['page_meta_index']
        ];
    }

      // Add address if successfully parsed
    if (!empty($address)) {
        $schema["address"] = $address;
    }
    
    // Clean up empty values
    $schema = array_filter($schema, function($value) {
        if (is_array($value)) {
            return !empty(array_filter($value));
        }
        return !empty($value);
    });

    // Format the JSON-LD output
    $json_ld = json_encode($schema, 
        JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
    return "<script type=\"application/ld+json\">\n{$json_ld}\n</script>";
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
function front_header($title = null, $keywords = null, $description = null, $libs = null, $template_id = null, $content = null) {
    global $and_gc;

    // Default values from content array if available
    if (is_array($content)) {
        if (isset($content['page_meta_title'])) {
            $title = $content['page_meta_title'];
        } elseif ($title !== null) {
            // keep $title as passed
        } elseif (isset($content['page_title'])) {
            $title = $content['page_title'];
        } else {
            $title = '';
        }

        $keywords = isset($content['page_meta_keywords']) ? $content['page_meta_keywords'] : ($keywords !== null ? $keywords : '');
        $description = isset($content['page_meta_desc']) ? $content['page_meta_desc'] : ($description !== null ? $description : '');

        // Additional SEO elements

        // Determine the canonical URL
        if (isset($content['page_canonical_url']) && !empty($content['page_canonical_url'])) {
            
            $canonical_url = $content['page_canonical_url'];
      
        } elseif (isset($content['page_url'])) {
            
            $canonical_url =  BASE_URL . $content['page_url'];
        } else {
           
            $canonical_url = '';
        }


        $robots_index = isset($content['page_meta_index']) ? ($content['page_meta_index'] ? 'index' : 'noindex') : 'index';
        $robots_follow = isset($content['page_meta_follow']) ? ($content['page_meta_follow'] ? 'follow' : 'nofollow') : 'follow';
        $robots_archive = isset($content['page_meta_archive']) ? ($content['page_meta_archive'] ? 'archive' : 'noarchive') : 'archive';
        $robots_imageindex = isset($content['page_meta_imageindex']) ? ($content['page_meta_imageindex'] ? 'imageindex' : 'noimageindex') : 'imageindex';
        $social_image = isset($content['social_image']) ? $content['social_image'] : '';
        $schema_markup = isset($content['schema_markup']) ? $content['schema_markup'] : '';
    } else {
        // Default values if content array not provided
        $title = $title !== null ? $title : '';
        $keywords = $keywords !== null ? $keywords : '';
        $description = $description !== null ? $description : '';
        $canonical_url = '';
        $robots_index = 'index';
        $robots_follow = 'follow';
        $robots_archive = 'archive';
        $robots_imageindex = 'imageindex';
        $social_image = '';
        $schema_markup = '';
    }

    // Sanitize inputs
    $title = htmlspecialchars(html_entity_decode($title, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
    $keywords = htmlspecialchars($keywords, ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
    $canonical_url = htmlspecialchars($canonical_url, ENT_QUOTES, 'UTF-8');
    $social_image = htmlspecialchars($social_image, ENT_QUOTES, 'UTF-8');
    $template_id = filter_var($template_id, FILTER_VALIDATE_INT);
    $language = defined('SITE_LANGUAGE') ? SITE_LANGUAGE : 'en';
    $logo = defined('SITE_LOGO') ? SITE_LOGO : '/favicon.png';

    // Generate robots meta tag
    $robots_meta = $robots_index . ', ' . $robots_follow . ', ' . $robots_archive . ', ' . $robots_imageindex;

    // Fetch header from template if ID is valid
    $header = '';
    if (!empty($template_id)) {
        $site_header = return_single_ans(
            "SELECT st_header FROM site_template WHERE st_id = " . intval($template_id) . " $and_gc AND isactive = 1"
        );
        $header = $site_header ? $site_header : '';
    }

    // Determine language for Google Translate
    $lang = 'en';
    if (isset($_GET['lang'])) {
        $lang = preg_replace('/[^a-z]/', '', strtolower($_GET['lang']));
        setcookie('googtrans', "/en/{$lang}", 0, '/', '', false, true);
    }

    // Live streaming status
    $islive_streaming_val = return_single_ans("SELECT isactive FROM category WHERE catid = 124");
    $islive_streaming = json_encode($islive_streaming_val);

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
    $organization_schema = generate_organization_schema($content);
    if (!empty($schema_markup)) {
        $organization_schema .= $schema_markup;
    }

    // Precompute values for heredoc insertion (to avoid ternaries in heredoc)
    $og_url = $canonical_url ?: (defined('CURRENT_URL') ? CURRENT_URL : '');
    $twitter_url = $canonical_url ?: (defined('CURRENT_URL') ? CURRENT_URL : '');
    $og_image = $social_image ?: $logo;
    $twitter_image = $social_image ?: $logo;

      $article_meta = '';
    if (isset($content['template_id']) && $content['template_id'] == 7) {
        $article_meta = generate_article_meta_tags($content);
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="{$language}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="{$robots_meta}">

    <!-- Primary Meta Tags -->
    <title>{$title}</title>
    <meta name="title" content="{$title}">
    <meta name="description" content="{$description}">
    <meta name="keywords" content="{$keywords}">
    <meta name="language" content="{$language}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{$canonical_url}">

    <!-- Favicon -->
    <link rel="icon" href="{$logo}" type="image/png">
    <link rel="apple-touch-icon" href="{$logo}">

    <!-- Article-Specific Meta Tags -->
    {$article_meta}

    <!-- Organization Schema -->
    {$organization_schema}

    <!-- Global JavaScript Variables -->
    {$js_globals}

    <!-- Google Translate -->
    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: '{$language}',
            includedLanguages: 'ar,ur,{$language}',
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