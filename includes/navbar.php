<?php
/**
 * Retrieves navigation bar content from site templates
 * 
 * @param int $template_id The ID of the template to retrieve navigation for
 * @return string The navigation bar HTML content
 * @throws InvalidArgumentException If template_id is not valid
 */
function BaseNavBar($template_id) {
    global $and_gc;
    
    // Validate input
    if (empty($template_id)) {
        throw new InvalidArgumentException('Template ID cannot be empty');
    }
    
    $template_id = filter_var($template_id, FILTER_VALIDATE_INT);
    if ($template_id === false) {
        throw new InvalidArgumentException('Invalid template ID');
    }
    
    // Initialize empty navbar as default
    $navbar = '';
    
    try {
        // Get navigation content from database using prepared statement
        $query = "SELECT st_menue FROM site_template 
                 WHERE st_id = $template_id $and_gc AND isactive = 1 
                 LIMIT 1";
        
        $site_header = return_single_ans($query);
        
        // Only assign if we got a valid result
        if (!empty($site_header)) {
            $navbar = $site_header;
        }
        
    } catch (Exception $e) {
        // Log error but don't break execution
        error_log("Error retrieving navigation: " . $e->getMessage());
        // Optionally return a default navbar or error message
        // $navbar = '<div class="navbar-error">Navigation unavailable</div>';
    }
    
    return $navbar;
}