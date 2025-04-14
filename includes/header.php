<?php
/**
 * Frontend Header Function
 * 
 * @param string|null $title Page title
 * @param string|null $keywords Meta keywords
 * @param string|null $description Meta description
 * @param array|null $libs Additional libraries/scripts
 */
function front_header($title = null, $keywords = null, $description = null, $libs = null) {
    // Sanitize inputs
    $title = htmlspecialchars($title ?? '', ENT_QUOTES, 'UTF-8');
    $keywords = htmlspecialchars($keywords ?? '', ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($description ?? '', ENT_QUOTES, 'UTF-8');
    
    // Determine language
    $lang = 'en';
    if (isset($_GET['lang'])) {
        $lang = preg_replace('/[^a-z]/', '', strtolower($_GET['lang']));
        setcookie('googtrans', "/en/{$lang}", 0, '/', '', false, true);
    }
    
    // Start output
    ob_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title><?= $title ?></title>
    <meta name="title" content="<?= $title ?>">
    <meta name="description" content="<?= $description ?>">
    <meta name="keywords" content="<?= $keywords ?>">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="<?= htmlspecialchars(COMPANY_NAME ?? 'Company', ENT_QUOTES, 'UTF-8') ?>">
    
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    
    <!-- Google Translate -->
    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'ar,ur,en',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
    <?php
    // Output additional libraries
    if (!empty($libs) && is_array($libs)) {
        foreach ($libs as $lib) {
            echo $lib . "\n";
        }
    }
    ?>
</head>
<?php
    echo ob_get_clean();
}

/**
 * Base Header Function with Template Support
 * 
 * @param string|null $title Page title
 * @param string|null $keywords Meta keywords
 * @param string|null $description Meta description
 * @param array|null $libs Additional libraries/scripts
 * @param int|null $template_id Template ID from database
 */
function Baseheader($title = null, $keywords = null, $description = null, $libs = null, $template_id = null) {
    global $and_gc;
    
    // Sanitize inputs
    $title = htmlspecialchars($title ?? '', ENT_QUOTES, 'UTF-8');
    $keywords = htmlspecialchars($keywords ?? '', ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($description ?? '', ENT_QUOTES, 'UTF-8');
    $template_id = filter_var($template_id, FILTER_VALIDATE_INT);
    
    // Get template header if template_id is provided
    $header = '';
    if (!empty($template_id)) {
        $site_header = return_single_ans("SELECT st_header FROM site_template WHERE st_id = $template_id $and_gc AND isactive = 1");
        $header = $site_header ?? '';
    }
    
    // Determine language
    $lang = 'en';
    if (isset($_GET['lang'])) {
        $lang = preg_replace('/[^a-z]/', '', strtolower($_GET['lang']));
        setcookie('googtrans', "/en/{$lang}", 0, '/', '', false, true);
    }
    
    // Start output
    ob_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title><?= $title ?></title>
    <meta name="title" content="<?= $title ?>">
    <meta name="description" content="<?= $description ?>">
    <meta name="keywords" content="<?= $keywords ?>">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="<?= htmlspecialchars(COMPANY_NAME ?? 'Company', ENT_QUOTES, 'UTF-8') ?>">
    
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    
    <!-- Google Translate -->
    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'ar,ur,en',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
    
    // Live streaming status
    var islive_streaming = <?= json_encode(return_single_ans("SELECT isactive FROM category WHERE catid = 124")) ?>;
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
    <?= $header ?>
    <?php
    // Output additional libraries
    if (!empty($libs)) {
        if (is_array($libs)) {
            foreach ($libs as $lib) {
                echo $lib . "\n";
            }
        } else {
            echo $libs . "\n";
        }
    }
    ?>
</head>
<?php
    echo ob_get_clean();
}
?>