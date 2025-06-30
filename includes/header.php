<?php
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
<html lang="{$language}" dir="rtl">
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