<?php

/**
 * Retrieves and builds the front-end menu.
 * 
 * @param array|null $menu_components Array of menu components OR null
 * @param int|null $template_id Template ID to fetch menu from database (optional)
 * @return string The complete menu HTML
 * @throws InvalidArgumentException If template_id is invalid
 */
function front_menu($menu_components = null, $template_id = null) {
    global $and_gc;
    
    $menu_html = '';

    // If template_id is provided, fetch menu from database
    if (!empty($template_id)) {
        $template_id = filter_var($template_id, FILTER_VALIDATE_INT);
        if ($template_id === false) {
            throw new InvalidArgumentException('Invalid template ID');
        }

        try {
            $query = "SELECT st_menue FROM site_template 
                      WHERE st_id = $template_id $and_gc AND isactive = 1 
                      LIMIT 1";
            $site_menu = return_single_ans($query);

            if (!empty($site_menu)) {
                $menu_html .= $site_menu . "\n";
            }
        } catch (Exception $e) {
            error_log("Error retrieving menu: " . $e->getMessage());
            // Optionally: $menu_html .= '<div class="menu-error">Menu unavailable</div>';
        }
    }

    // If manual menu components are provided, append them
    if (!empty($menu_components)) {
        if (is_array($menu_components)) {
            foreach ($menu_components as $component) {
                $menu_html .= $component . "\n";
            }
        } else {
            $menu_html .= $menu_components . "\n"; // handle string too
        }
    }

    return <<<HTML
$menu_html
HTML;
}
