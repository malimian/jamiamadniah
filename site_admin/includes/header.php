<?php

function AdminHeader($title = null, $description = null, $libs = null, $template_id = null , $block_code = null) {
    
    global $and_gc;
    $header = "";

    // Handle template if provided
    if(!empty($template_id)) {
        $site_header = return_single_ans("SELECT st_header FROM site_template WHERE st_id = $template_id $and_gc AND isactive = 1");
        $header = $site_header;
    }

    // Default admin CSS files
    $default_css = [
        'vendor/fontawesome-free/css/all.min.css',
        'vendor/datatables/dataTables.bootstrap4.css',
        'css/sb-admin.css',
        'css/custom.css',
        'css/loader.css',
        'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'plugins/dist/switchery.css',
        'https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css',
        'plugins/tagify/css/amsify.suggestags.css',
        'css/modules/upload_image.css',
        'css/image-uploader.css',
        'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css'
    ];

    // Default admin JS files
    $default_js = [
        'vendor/jquery/jquery.min.js',
        'vendor/bootstrap/js/bootstrap.bundle.min.js',
        'vendor/jquery-easing/jquery.easing.min.js',
        'vendor/datatables/jquery.dataTables.js',
        'vendor/datatables/dataTables.bootstrap4.js',
        'plugins/ckeditor_4.12.1_standard/ckeditor/ckeditor.js',
        'js/API/senddata.js',
        'js/API/general_function.js',
        'plugins/dist/switchery.js',
        'https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js',
        'https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js',
        'https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js',
        'https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js',
        'plugins/readmore/readmore.js',
        'js/plugins/alert/notify.js',
        'plugins/tagify/jquery.amsify.suggestags.js',
        'plugins/loading/loading.js',
        'js/plugins/image-uploader.js',
        'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',
        'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js'
    ];

    // Generate CSS links
    $css_links = '';
    foreach ($default_css as $css) {
        $css_links .= '<link href="' . $css . '" rel="stylesheet">' . "\n";
    }

    // Generate JS scripts
    $js_scripts = '';
    foreach ($default_js as $js) {
        $js_scripts .= '<script src="' . $js . '"></script>' . "\n";
    }

  $SITE_TITLE = SITE_TITLE;

    // Output the HTML
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{$description}">
    <meta name="author" content="">

    <title>{$SITE_TITLE} - Admin | {$title}</title>

    <!---------------------------  Default CSS --------------------------->

    {$css_links}

    <!---------------------------  Default JS --------------------------->

    {$js_scripts}

    <!---------------------------  Default Header Libs --------------------------->

    {$header}


HTML;

  echo "<!---------------------------  Custom Libs --------------------------->\n";

    // Output additional libraries if provided
    if(!empty($libs)) {
        if(is_array($libs)) {
            foreach ($libs as $lib) {
                echo $lib."\n";
            }
        } else {
            echo $libs;
        }
    }

    echo "<!---------------------------  Block Code --------------------------->\n";

    echo $block_code;


    echo '</head>';
}
?>

