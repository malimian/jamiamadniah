<?php

function get_resized_image_path($image, $size = '500x500') {
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = basename($image, '.' . $extension);
    $dirname = dirname($image);

    return $dirname . '/' . $filename . '-' . $size . '.' . $extension;
}


function getFullImageUrl($path) {
    // Fallback image path
    $fallback = 'assets/img/post-loading.gif';

    if (empty($path)) {
        return $fallback;
    }

    $path = htmlspecialchars($path, ENT_QUOTES, 'UTF-8');

    // Return full URL if path is already a valid URL
    if (filter_var($path, FILTER_VALIDATE_URL)) {
        return $path;
    }

    // For relative/local path
    $base = rtrim(BASE_URL . ABSOLUTE_IMAGEPATH, '/');
    $path = ltrim($path, '/');
    $fullPath = $base . '/' . $path;

    return $fullPath;
}

function generateFaviconLinks($logoPath) {
   
    $faviconSizes = ['16x16', '32x32', '96x96', '192x192', '512x512'];
    $appleTouchSizes = ['57x57', '60x60', '72x72', '76x76', '114x114', '120x120', '144x144', '152x152', '180x180'];

    $pathInfo = pathinfo($logoPath);
    $baseName = $pathInfo['filename'];
    $extension = $pathInfo['extension'];
    $dir = $pathInfo['dirname'];

    $html = '';

    foreach ($faviconSizes as $size) {
        $url = "{$dir}/{$baseName}-{$size}.{$extension}";
        $html .= "<link rel=\"icon\" type=\"image/{$extension}\" sizes=\"{$size}\" href=\"{$url}\">" . PHP_EOL;
    }

    foreach ($appleTouchSizes as $size) {
        $url = "{$dir}/{$baseName}-{$size}.{$extension}";
        $html .= "<link rel=\"apple-touch-icon\" sizes=\"{$size}\" href=\"{$url}\">" . PHP_EOL;
    }

    $fallback = "{$dir}/{$baseName}-1500x1500.{$extension}";
    $html .= "<link rel=\"icon\" href=\"{$fallback}\" type=\"image/{$extension}\">" . PHP_EOL;
    $html .= "<link rel=\"apple-touch-icon\" href=\"{$fallback}\">" . PHP_EOL;

    return $html;
}






// Comments Functions

// List of NSFW terms to block (can be expanded)
$nsfw_terms = [
    'profanity', 'obscenity', 'explicit', 'porn', 'xxx', 'adult',
    'fuck', 'shit', 'asshole', 'bitch', 'cunt', 'dick', 'pussy', 'cock',
    'slut', 'whore', 'faggot', 'nigger', 'retard', 'rape', 'molest',
    'kill', 'murder', 'suicide', 'terrorist', 'bomb', 'drugs', 'heroin',
    'cocaine', 'meth', 'weed', 'hitler', 'nazi', 'kkk', 'pedo', 'childporn'
];


// Function to check for NSFW content
function contains_nsfw($text) {
    global $nsfw_terms;
    $text = strtolower($text);
    foreach ($nsfw_terms as $term) {
        if (strpos($text, $term) !== false) {
            return true;
        }
    }
    return false;
}

// Function to get user's profile picture if logged in
function get_user_profile_pic($user_id) {
    if ($user_id) {
        $user = return_single_row("SELECT profile_pic FROM loginuser WHERE id = $user_id");
        if ($user && !empty($user['profile_pic'])) {
            return ABSOLUTE_IMAGEPATH . $user['profile_pic'];
        }
    }
    return ABSOLUTE_IMAGEPATH . 'default-user.png'; // Default profile picture
}

// Function to save a new comment
function save_comment($pid, $user_id, $name, $email, $comment) {
    $is_nsfw = contains_nsfw($comment) ? 1 : 0;
    
    // For logged-in users, we don't store name/email separately
    if ($user_id) {
        $sql = "INSERT INTO pages_comments (pid, user_id, comment_text, is_nsfw) 
                VALUES ($pid, $user_id, '".escape($comment)."', $is_nsfw)";
    } else {
        $sql = "INSERT INTO pages_comments (pid, guest_name, guest_email, comment_text, is_nsfw) 
                VALUES ($pid, '".escape($name)."', '".escape($email)."', '".escape($comment)."', $is_nsfw)";
    }
    return Insert($sql);
}

// Function to get approved comments for a page
function get_page_comments($pid, $admin_mode = false) {
    $where = $admin_mode ? "pid = $pid" : "pid = $pid AND is_approved = 1 AND is_nsfw = 0";
    return return_multiple_rows("SELECT * FROM pages_comments WHERE $where ORDER BY created_at DESC");
}

// Function to approve/delete comments (admin only)
function moderate_comment($comment_id, $action, $notes = '') {
    if ($action === 'approve') {
        $sql = "UPDATE pages_comments SET is_approved = 1, admin_notes = '".escape($notes)."' WHERE comment_id = $comment_id";
    } elseif ($action === 'delete') {
        $sql = "DELETE FROM pages_comments WHERE comment_id = $comment_id";
    } elseif ($action === 'flag_nsfw') {
        $sql = "UPDATE pages_comments SET is_nsfw = 1, admin_notes = '".escape($notes)."' WHERE comment_id = $comment_id";
    }
    
    return Update($sql);
}


// Render a single comment
function render_comment($comment, $is_admin = false) {
    $user_info = '';
    $mod_actions = '';
    
    // User info section
    if ($comment['user_id']) {
        $user = return_single_row("SELECT username, fullname, profile_pic FROM loginuser WHERE id = ".$comment['user_id']);
        $name = $user['fullname'] ?? $user['username'];
        $avatar = get_user_profile_pic($comment['user_id']);
        $user_info = '<div class="d-flex align-items-center mb-2">
            <img src="'.$avatar.'" class="rounded-circle me-2" width="40" height="40" alt="'.$name.'">
            <div>
                <h6 class="mb-0">'.$name.'</h6>
                <small class="text-muted">'.date('M j, Y \a\t g:i a', strtotime($comment['created_at'])).'</small>
            </div>
        </div>';
    } else {
        $name = $comment['guest_name'];
        $email = $comment['guest_email'];
        $gravatar = 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($email))).'?d=mp';
        $user_info = '<div class="d-flex align-items-center mb-2">
            <img src="'.$gravatar.'" class="rounded-circle me-2" width="40" height="40" alt="'.$name.'">
            <div>
                <h6 class="mb-0">'.$name.'</h6>
                <small class="text-muted">'.date('M j, Y \a\t g:i a', strtotime($comment['created_at'])).'</small>
            </div>
        </div>';
    }
    
    // Moderation flags
    $flags = '';
    if ($comment['is_nsfw']) {
        $flags .= '<span class="badge bg-danger me-1">NSFW</span>';
    }
    if (!$comment['is_approved']) {
        $flags .= '<span class="badge bg-warning me-1">Pending Approval</span>';
    }
    
    // Admin actions
    if ($is_admin) {
        $mod_actions = '<div class="mt-2 border-top pt-2 small">
            <strong>Admin Actions:</strong>
            <a href="?comment_action=approve&comment_id='.$comment['comment_id'].'" class="btn btn-sm btn-success ms-2">Approve</a>
            <a href="?comment_action=flag_nsfw&comment_id='.$comment['comment_id'].'" class="btn btn-sm btn-danger ms-2">Flag NSFW</a>
            <a href="?comment_action=delete&comment_id='.$comment['comment_id'].'" class="btn btn-sm btn-dark ms-2">Delete</a>
        </div>';
    }
    
    return '<div class="mb-4 p-3 border rounded'.($comment['is_nsfw'] ? ' bg-light' : '').'">
        '.$user_info.'
        '.($flags ? '<div class="mb-2">'.$flags.'</div>' : '').'
            <div class="comment-text">'.nl2br(stripslashes(htmlspecialchars($comment['comment_text']))).'</div>
        '.$mod_actions.'
    </div>';
}


// Display comments section
function display_comments($pid, $is_admin = false) {
   
    $comments = get_page_comments($pid, $is_admin);
    $output = '';
    
    if (empty($comments)) {
        $output .= '<p class="text-muted">No comments yet. Be the first to comment!</p>';
    } else {
        foreach ($comments as $comment) {
            $output .= render_comment($comment, $is_admin);
        }
    }
    
    return $output;
}
// Header Functions
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
    $url = !empty($article['page_canonical_url'])
    ? htmlspecialchars($article['page_canonical_url'], ENT_QUOTES, 'UTF-8')
    : BASE_URL . $article['page_url'];

    $image = getFullImageUrl($article['featured_image'] ?? '');

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
    $location = trim($settings_array['SHOP_LOCATION']);
    
    // Initialize address components
    $streetAddress = '';
    $addressLocality = '';
    $addressRegion = '';
    $postalCode = '';
    $addressCountry = '';

    // First try to extract country (if present)
    if (preg_match('/\b([A-Z]{2})\s*$/', $location, $country_matches)) {
        $addressCountry = $country_matches[1];
        $location = trim(substr($location, 0, -strlen($addressCountry)));
    }

    // Try to extract postal code (various international formats)
    if (preg_match('/\b(\d{5})(?:-\d{4})?\b/', $location, $zip_matches) ||  // US ZIP
       preg_match('/\b([A-Z]\d[A-Z]\s?\d[A-Z]\d)\b/i', $location, $zip_matches) ||  // Canadian
       preg_match('/\b([A-Z]{1,2}\d{1,2}[A-Z]?\s?\d[A-Z]{2})\b/', $location, $zip_matches) ||  // UK
       preg_match('/\b(\d{4,6})\b/', $location, $zip_matches)) {  // Other numeric codes
        $postalCode = trim($zip_matches[0]);
        $location = trim(str_replace($postalCode, '', $location));
    }

    // Try to extract state/region (2-3 letters or full name)
    if (preg_match('/\b([A-Z]{2,3})\b/', $location, $state_matches)) {
        $addressRegion = $state_matches[1];
        $location = trim(str_replace($addressRegion, '', $location));
    }

    // Split remaining parts
    $parts = preg_split('/\s*,\s*/', $location);
    
    // Handle different address formats
    if (count($parts) >= 3) {
        // Format: Street, City, State, Postal, Country
        $streetAddress = trim(array_shift($parts));
        $addressLocality = trim(array_shift($parts));
        if (empty($addressRegion)) {
            $addressRegion = trim(array_shift($parts));
        }
    } elseif (count($parts) == 2) {
        // Format: Street, City
        $streetAddress = trim(array_shift($parts));
        $addressLocality = trim(array_shift($parts));
    } else {
        // Format with no commas - try to parse last word as city
        $parts = preg_split('/\s+/', $location);
        $addressLocality = array_pop($parts);
        $streetAddress = trim(implode(' ', $parts));
    }

    // Clean up street address
    $streetAddress = preg_replace('/\s+/', ' ', $streetAddress);
    $streetAddress = preg_replace('/\s*,\s*/', ', ', $streetAddress);

    // Set default country if not found
    if (empty($addressCountry)) {
        $addressCountry = "US"; // Default to US if no country code found
    }

    $address = [
        "@type" => "PostalAddress",
        "streetAddress" => $streetAddress,
        "addressLocality" => $addressLocality,
        "addressRegion" => $addressRegion,
        "postalCode" => $postalCode,
        "addressCountry" => $addressCountry
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
            "@id" => $page_meta['page_canonical_url'] ?? $base_url ?? ''
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