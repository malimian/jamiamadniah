<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

AdminHeader(
    "dashboard Admin", 
    "", 
    $extra_libs,
    null,
    '

    '
);

?>


<body id="page-top">

    <?php include 'includes/notification.php';

    $setting = return_multiple_rows("Select * from og_settings $Where_gc ");
    ?>

    <style>

    </style>
    <div id="wrapper">

        <?php include 'includes/sidebar.php'; ?>

        <div id="content-wrapper">

            <div class="container-fluid">

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo $_SESSION['user']['dashboard'];?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Settings</li>
                </ol>

                <!-- Page Content -->
                <div id="error_id"></div>
                        <form class="needs-validation" onsubmit="return false" novalidate>

               <!-- Make sure you include Font Awesome 4 in the <head> section of your HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container-fluid tab-pane fade active show">
    <div class="form-row">
        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-header"></i> Title
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-pencil"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Enter Title" id="title" value="<?php echo $setting[0]['settings_value']?>">
            </div>
            <small class="form-text text-muted">Use Short Code <?php echo $setting[0]['short_code']?></small>
        </div>

        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-tag"></i> Tagline
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Enter Tagline" id="tagline" name="meta_keywords" value="<?php echo $setting[1]['settings_value']?>">
            </div>
            <small class="form-text text-muted">Use Short Code <?php echo $setting[1]['short_code']?></small>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-picture-o"></i> Logo
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-image"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Enter Logo" id="logo" value="<?php echo $setting[8]['settings_value']?>">
            </div>
            <small class="form-text text-muted">Use Short Code <?php echo $setting[8]['short_code']?></small>
        </div>
        
        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-link"></i> URL
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-link"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Enter URL" id="url" value="<?php echo $setting[2]['settings_value']?>">
            </div>
            <small class="form-text text-muted">Use Short Code <?php echo $setting[2]['short_code']?></small>
        </div>
    </div>
</div>

<div class="container-fluid tab-pane fade active show">
    <div class="form-row">
        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-envelope"></i> E-mail
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Enter E-mail" id="email" name="meta_keywords" value="<?php echo $setting[4]['settings_value']?>">
            </div>
            <small class="form-text text-muted">Use Short Code <?php echo $setting[4]['short_code']?></small>
        </div>

        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-key"></i> Key
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Enter Key" id="key" value="<?php echo $setting[5]['settings_value']?>">
            </div>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-lock"></i> Key-Pass
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Enter Key-Pass" id="keypass" value="<?php echo $setting[6]['settings_value']?>">
            </div>
        </div>
        
        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-cogs"></i> ENV
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-cogs"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Enter ENV" id="env" value="<?php echo $setting[7]['settings_value']?>">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid tab-pane fade active show">
    <div class="form-row">
        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-image"></i> IMG-Path
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-image"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Enter IMG-Path" id="img_path" value="<?php echo $setting[9]['settings_value']?>">
            </div>
            <small class="form-text text-muted">Use Short Code <?php echo $setting[9]['short_code']?></small>
        </div>
        
        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-clock-o"></i> Time Zone
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                </div>
                <select id="time_zone" class="form-control">
                    <?php
                    $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                    foreach ($tzlist as $tzlist_) {
                        echo "<option" . ($tzlist_ == $setting[10]['settings_value'] ? " selected" : "") . ">$tzlist_</option>";
                    }
                    ?>
                </select>
            </div>
            <small class="form-text text-muted">Use Short Code <?php echo $setting[10]['short_code']?></small>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-exclamation-triangle"></i> ERROR 404
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-exclamation-triangle"></i></span>
                </div>
                <select class="form-control" id="error_404" name="error_404" required>
                    <?php
                    $pages = return_multiple_rows("SELECT page_title, page_url FROM pages $where_gc AND isactive = 1");
                    foreach ($pages as $page) {
                        echo "<option value='{$page['page_url']}'" . ($setting[14]['settings_value'] == $page['page_url'] ? " selected" : "") . ">{$page['page_title']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <div class="form-group col-sm-6">
            <label for="colFormLabel" class="col-form-label">
                <i class="fa fa-folder"></i> File-Path
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-folder"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Enter File-Path" id="file_path" value="<?php echo $setting[11]['settings_value']?>">
            </div>
            <small class="form-text text-muted">Use Short Code <?php echo $setting[11]['short_code']?></small>
        </div>
    </div>
</div>


              <!-- Social Media Fields in Two Columns -->
                    <div class="container">
                        <div class="row">
                            <?php 
                            $social_media = [
                                'Facebook' => 'fa fa-facebook',
                                'Twitter' => 'fa fa-twitter',
                                'Instagram' => 'fa fa-instagram',
                                'LinkedIn' => 'fa fa-linkedin',
                                'YouTube' => 'fa fa-youtube',
                                'Pinterest' => 'fa fa-pinterest',
                                'Snapchat' => 'fa fa-snapchat',
                                'TikTok' => 'fa fa-music',
                                'Reddit' => 'fa fa-reddit',
                                'WhatsApp' => 'fa fa-whatsapp',
                                'Telegram' => 'fa fa-telegram'
                            ];
                            
                            $startIndex = 18; 
                            $index = 0;

                            foreach ($social_media as $platform => $icon) {
                                $currentIndex = $startIndex + $index;
                            ?>
                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="<?php echo $icon; ?>"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="<?php echo strtolower($platform); ?>_url"
                                            placeholder="Enter <?php echo $platform; ?> URL" id="<?php echo strtolower($platform); ?>_url" 
                                            value="<?php echo htmlspecialchars($setting[$currentIndex]['settings_value'], ENT_QUOTES, 'UTF-8'); ?>">
                                    </div>
                                    <small class="form-text text-muted">Use Short Code <?php echo $setting[$currentIndex]['short_code']?></small>
                                </div>
                            <?php 
                                $index++;
                            }
                            ?>
                        </div>
                </div>


                <div class="form-group row">
                  <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">FRIENDLY URL</label>
                  <div class="col-sm-8">
                   <input type="checkbox" class="js-switch friendly_url" <?php echo ($setting[12]['settings_value']) ? "checked" : ""  ?> />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">PAGE LOADER</label>
                  <div class="col-sm-8">
                     <input type="checkbox" class="js-switch page_loader" <?php echo ($setting[13]['settings_value']) ? "checked" : ""  ?> />
                  </div>
                </div>

                     <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 text-center">
                        <input type="submit" name="submit" class="btn btn-info" value="Save Changes" id="submit_btn" />
                    </div>
                    <div class="col-sm-2"></div>
                </div>


                </form>

                <?php include 'includes/footer_copyright.php'; ?>
            </div>
        </div>
        <!-- /.content-wrapper -->

                        
        <script type="text/javascript" src="js/og_setting/og_setting.js"></script>

    </div>
    <!-- /#wrapper -->

    <?php include 'includes/footer.php'; ?>