<?php
// shortcodes.php

/**
 * Process custom shortcodes in content
 * 
 * @param string $content The content to process
 * @return string Processed content with shortcodes replaced
 */
function process_custom_shortcodes($content) {

// Date and Time shortcodes
   $content = preg_replace_callback(
    '/\{DATE(?:\(["\']?(.*?)["\']?\))?\}/',  // Matches both {DATE} and {DATE("format")}
    function($matches) {
        // If format is provided, use it, otherwise use default format
        $format = !empty($matches[1]) ? $matches[1] : 'Y-m-d';
        return date($format);
    },
    $content
);
    
    // Similarly for TIME and DATETIME
    $content = preg_replace_callback(
        '/\{TIME(?:\(["\']?(.*?)["\']?\))?\}/',
        function($matches) {
            $format = !empty($matches[1]) ? $matches[1] : 'H:i:s';
            return date($format);
        },
        $content
    );
    
      $content = preg_replace_callback(
        '/\{DATETIME(?:\(["\']?(.*?)["\']?\))?\}/',
        function($matches) {
            $format = !empty($matches[1]) ? $matches[1] : 'Y-m-d H:i:s';
            return date($format);
        },
        $content
    );

    // User-related shortcodes
    $content = preg_replace_callback(
        '/\{USERNAME\}/',
        function() {
            return isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{USEREMAIL\}/',
        function() {
            return isset($_SESSION['email']) ? $_SESSION['email'] : '';
        },
        $content
    );

    // System information shortcodes
    $content = preg_replace_callback(
        '/\{IP\}/',
        function() {
            return get_client_ip();
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{USERAGENT\}/',
        function() {
            return $_SERVER['HTTP_USER_AGENT'] ?? '';
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{BROWSER\}/',
        function() {
            $browser = getBrowser();
            return $browser['name'] ?? 'Unknown';
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{OS\}/',
        function() {
            $browser = getBrowser();
            return $browser['platform'] ?? 'Unknown';
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{LANG\}/',
        function() {
            return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{REFERER\}/',
        function() {
            return $_SERVER['HTTP_REFERER'] ?? '';
        },
        $content
    );

    // Text transformation shortcodes
    $content = preg_replace_callback(
        '/\{UPPER\("([^"]+)"\)\}/',
        function($matches) {
            return strtoupper($matches[1]);
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{LOWER\("([^"]+)"\)\}/',
        function($matches) {
            return strtolower($matches[1]);
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{TITLECASE\("([^"]+)"\)\}/',
        function($matches) {
            return ucwords(strtolower($matches[1]));
        },
        $content
    );

    // Math and random shortcodes
    $content = preg_replace_callback(
        '/\{RAND\((\d+),\s*(\d+)\)\}/',
        function($matches) {
            return rand($matches[1], $matches[2]);
        },
        $content
    );
    

    // Unique identifiers
    $content = preg_replace_callback(
        '/\{UNIQUEID\}/',
        function() {
            return uniqid();
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{UUID\}/',
        function() {
            return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
            );
        },
        $content
    );

    // Time-based greeting
    $content = preg_replace_callback(
        '/\{GREETING\}/',
        function() {
            $hour = date('H');
            if ($hour < 12) return 'Good Morning';
            if ($hour < 17) return 'Good Afternoon';
            return 'Good Evening';
        },
        $content
    );

    // SEO-related shortcodes
    $content = preg_replace_callback(
        '/\{SEOURL\("([^"]+)"(?:,\s*(\d+))?\)\}/',
        function($matches) {
            $wordLimit = isset($matches[2]) ? (int)$matches[2] : 0;
            return generateSeoURL($matches[1], $wordLimit);
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{CLEANCONTENT\("([^"]+)"\)\}/',
        function($matches) {
            return cleanContent($matches[1]);
        },
        $content
    );

    // Additional utility shortcodes
    $content = preg_replace_callback(
        '/\{DISCOUNT\(([\d.]+),\s*([\d.]+)\)\}/',
        function($matches) {
            return discount_calculate((float)$matches[1], (float)$matches[2]);
        },
        $content
    );
    
    
    $content = preg_replace_callback(
        '/\{TIMESINCE\("([^"]+)"\)\}/',
        function($matches) {
            return timeAgo($matches[1]);
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{PHONEFORMAT\("([^"]+)"\)\}/',
        function($matches) {
            return remove0with92($matches[1]);
        },
        $content
    );
    
    $content = preg_replace_callback(
        '/\{MD5\("([^"]+)"\)\}/',
        function($matches) {
            return md5_($matches[1]);
        },
        $content
    );

    
    $content = preg_replace_callback(
        '/\{STRIPNUMBERS\("([^"]+)"\)\}/',
        function($matches) {
            return clear($matches[1]);
        },
        $content
    );

    return $content;
}
