<?php
/**
 * Output frontend scripts immediately
 * 
 * @param array|string|null $libs Script tags or array of script tags to output
 */
function front_script($libs = null) {
    if (empty($libs)) {
        return;
    }

    echo "\n";
    
    if (is_array($libs)) {
        echo implode("\n", array_filter($libs)) . "\n";
    } else {
        echo $libs . "\n";
    }
}

/**
 * Get combined scripts from template and additional libraries
 * 
 * @param array|string|null $libs Additional script tags to include
 * @param int|null $template_id Template ID to pull scripts from
 * @return string Combined script tags
 */
function BaseScript($libs = null, $template_id = null) {
    global $and_gc;
    
    $output = [];
    $template_id = filter_var($template_id, FILTER_VALIDATE_INT);

    // Get template scripts if valid template ID provided
    if ($template_id !== false && $template_id > 0) {
        $query = sprintf(
            "SELECT st_script FROM site_template 
            WHERE st_id = %d %s AND isactive = 1 
            LIMIT 1",
            $template_id,
            preg_replace('/[^a-zA-Z0-9_ =]/', '', $and_gc) // Basic sanitization
        );
        
        $st_scripts = return_single_ans($query);
        if (!empty($st_scripts)) {
            $output[] = trim($st_scripts);
        }
    }

    // Add additional libraries
    if (!empty($libs)) {
        if (is_array($libs)) {
            $output = array_merge($output, array_filter($libs));
        } else {
            $output[] = trim($libs);
        }
    }

    return implode("\n\n", $output);
}