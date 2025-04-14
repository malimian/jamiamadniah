<?php

/**
 * Echoes a list of front-end scripts.
 *
 * @param array|null $libs Array of script tags or URLs to include.
 */
function front_script($libs = null) {
    if (!empty($libs) && is_array($libs)) {
        foreach ($libs as $lib) {
            echo $lib . "\n"; // Added newline for better HTML output formatting
        }
    }
}

/**
 * Returns scripts for the selected base template and custom libs.
 *
 * @param string|null $libs HTML string containing script tags or links.
 * @param int|null $template_id Template ID from the database.
 * @return string Combined HTML string of scripts.
 */
function BaseScript($libs = null, $template_id = null) {
    global $and_gc;

    $scripts = '';

    if (!empty($template_id)) {
        // Make sure to escape your variables properly to avoid SQL injection
        $template_id = (int)$template_id;

        $query = "SELECT st_script FROM site_template WHERE st_id = $template_id $and_gc AND isactive = 1";
        $st_scripts = return_single_ans($query);

        if (!empty($st_scripts)) {
            $scripts = $st_scripts;
        }
    }

    return <<<HTML
{$scripts}
{$libs}
HTML;
}

?>
