<?php
/**
 * Frontend Footer Function
 * 
 * @param array|null $libs Additional libraries/scripts to include before closing body
 * @return string HTML output
 */
function front_footer($libs = null) {
    $output = "";

    if (!empty($libs)) {
        $output .= "\n";
        if (is_array($libs)) {
            foreach ($libs as $lib) {
                $output .= $lib . "\n";
            }
        } else {
            $output .= $libs . "\n";
        }
    }

    return <<<HTML
$output
HTML;
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

    $output = "";

    // Include loading modal
    ob_start();
    require_once 'modals/loading.php';
    $loadingModal = ob_get_clean(); // capture the modal separately

    $output .= $loadingModal;

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

    if (!empty($libs)) {
        $output .= "\n";
        if (is_array($libs)) {
            foreach ($libs as $lib) {
                $output .= $lib . "\n";
            }
        } else {
            $output .= $libs . "\n";
        }
    }

    $output .= $footer;

    return <<<HTML
$output
HTML;
}
