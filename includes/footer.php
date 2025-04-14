<?php
/**
 * Frontend Footer Function
 * 
 * @param array|null $libs Additional libraries/scripts to include before closing body
 */
function front_footer($libs = null) {
    // Start output buffer
    ob_start();
    
    // Output additional libraries if provided
    if (!empty($libs)) {
        echo "\n";
        if (is_array($libs)) {
            foreach ($libs as $lib) {
                echo $lib . "\n";
            }
        } else {
            echo $libs . "\n";
        }
    }
    
    
    // Flush output buffer
    ob_end_flush();
}

/**
 * Base Footer Function with Template Support
 * 
 * @param array|null $libs Additional libraries/scripts to include
 * @param int|null $template_id Template ID from database
 * @return string Complete footer content
 */
function Basefooter($libs = null, $template_id = null) {
    global $and_gc;
    
    // Start output buffer
    ob_start();
    
    // Include loading modal
    require_once 'modals/loading.php';
    
    // Get template footer if template_id is provided
    $footer = '';
    if (!empty($template_id)) {
        $template_id = filter_var($template_id, FILTER_VALIDATE_INT);
        if ($template_id !== false) {
            $st_footer = return_single_ans(
                "SELECT st_footer FROM site_template WHERE st_id = $template_id $and_gc AND isactive = 1" 
            );
            $footer = $st_footer ?? '';
        }
    }
    
    // Output additional libraries if provided
    if (!empty($libs)) {
        echo "\n";
        if (is_array($libs)) {
            foreach ($libs as $lib) {
                echo $lib . "\n";
            }
        } else {
            echo $libs . "\n";
        }
    }
    
    // Output template footer
    echo $footer;
    
    // Get and clean buffer
    $output = ob_get_clean();
    
    return $output;
}