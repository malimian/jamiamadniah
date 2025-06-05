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
    <style>
        .nav-tabs .nav-link {
            padding: 12px 20px;
            font-weight: 600;
            color: #6c757d;
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }
        .nav-tabs .nav-link.active {
            color: #495057;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }
        .nav-tabs .nav-link:hover {
            border-color: #e9ecef #e9ecef #dee2e6;
        }
        .tab-content {
            padding: 20px;
            background: #fff;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 0.25rem 0.25rem;
        }
        .social-media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
        }
        @media (min-width: 1200px) {
            .social-media-grid {
                grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            }
        }
        .gallery-select-btn {
            cursor: pointer;
        }
        .seo-message {
            background-color: #f8f9fa;
            border-left: 4px solid #17a2b8;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
    '
);

?>

<body id="page-top">

    <?php include 'includes/notification.php';

    $setting = return_multiple_rows("Select * from og_settings $Where_gc ");
    ?>

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
                
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">
                                <i class="fa fa-cog"></i> General
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="technical-tab" data-toggle="tab" href="#technical" role="tab" aria-controls="technical" aria-selected="false">
                                <i class="fa fa-wrench"></i> Technical
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="paths-tab" data-toggle="tab" href="#paths" role="tab" aria-controls="paths" aria-selected="false">
                                <i class="fa fa-folder-open"></i> Paths
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="false">
                                <i class="fa fa-share-alt"></i> Social Media
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false">
                                <i class="fa fa-search"></i> SEO
                            </a>
                        </li>
                    </ul>
                    
                    <!-- Tabs Content -->
                    <div class="tab-content" id="settingsTabsContent">
                        <!-- General Tab -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
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
                                        <div class="input-group-append">
                                            <button id="logo" class="btn btn-outline-secondary gallery-select-btn" type="button" onclick="OpenMediaGallery('logo' , null)">
                                                <i class="fa fa-folder-open"></i> Gallery
                                            </button>
                                        </div>
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
                                        <i class="fa fa-phone"></i> Phone Number
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Phone Number" id="site_telno" value="<?php echo isset($setting[16]['settings_value']) ? $setting[16]['settings_value'] : '+0123 456 789' ?>">
                                    </div>
                                    <small class="form-text text-muted">Use Short Code {SITE_TELNO}</small>
                                </div>
                            </div>
                            
                            <div class="form-row">
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
                                
                                <div class="form-group col-sm-6">
                                    <label for="default_language" class="col-form-label">
                                        <i class="fa fa-language"></i> Default Language
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-language"></i></span>
                                        </div>
                                        <select id="default_language" class="form-control">
                                            <?php
                                            $languages = [
                                                'en' => 'English',
                                                'es' => 'Spanish',
                                                'fr' => 'French',
                                                'de' => 'German',
                                                'it' => 'Italian',
                                                'pt' => 'Portuguese',
                                                'ru' => 'Russian',
                                                'zh' => 'Chinese',
                                                'ja' => 'Japanese',
                                                'ar' => 'Arabic',
                                                'ur' => 'Urdu',
                                                'tr' => 'Turkish',
                                                'ko' => 'Korean',
                                                'hi' => 'Hindi',
                                                'fa' => 'Persian (Farsi)',
                                                'ms' => 'Malay',
                                                'id' => 'Indonesian',
                                                'nl' => 'Dutch',
                                                'sv' => 'Swedish',
                                                'pl' => 'Polish',
                                                'th' => 'Thai',
                                            ];

                                            $selectedLang = isset($setting[30]['settings_value']) ? $setting[30]['settings_value'] : 'en';

                                            foreach ($languages as $code => $name) {
                                                $selected = ($selectedLang == $code) ? 'selected' : '';
                                                echo "<option value=\"$code\" $selected>$name ($code)</option>";
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <small class="form-text text-muted">Default language for the website (2-letter code)</small>
                                </div>
                            </div> 
                            
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <label for="shop_location" class="col-form-label">
                                        <i class="fa fa-map-marker"></i> Shop Location
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                        </div>
                                        <textarea class="form-control" placeholder="Enter Shop Location" id="shop_location" name="shop_location" rows="2"><?php echo isset($setting[17]['settings_value']) ? htmlspecialchars($setting[17]['settings_value']) : '' ?></textarea>
                                    </div>
                                    <small class="form-text text-muted">Use Short Code {SHOP_LOCATION}</small>
                                    
                                    <!-- Help Box for Address Format -->
                                    <div class="alert alert-info mt-2" id="addressFormatHelp">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h6><i class="fa fa-info-circle"></i> Address Format Guide</h6>
                                        <p>For proper parsing in organization schema, please use this format:</p>
                                        <div class="bg-light p-2 mb-2">
                                            <code>[Street Address] [City] [State/Province] [Postal Code] [Country]</code>
                                        </div>
                                        <p class="mb-1"><strong>Example:</strong></p>
                                        <ul class="list-unstyled">
                                            <li><code>6101 Cherry Avenue Suite 102A - 206 Fontana CA 92336 US</code></li>
                                            <li><code>NO. 342 - London Oxford Street London UK 012 United Kingdom</code></li>
                                        </ul>
                                        <p class="mb-0"><small>Note: Country code can be either full name (United States) or 2-letter code (US)</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Technical Tab -->
                        <div class="tab-pane fade" id="technical" role="tabpanel" aria-labelledby="technical-tab">
                            <div class="form-row">
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
                            </div>
                            
                            <div class="form-row">
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
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="colFormLabelSm" class="col-form-label col-form-label-sm">FRIENDLY URL</label>
                                    <div class="col-sm-8">
                                    <input type="checkbox" class="js-switch friendly_url" <?php echo ($setting[12]['settings_value']) ? "checked" : ""  ?> />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="colFormLabelSm" class="col-form-label col-form-label-sm">PAGE LOADER</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" class="js-switch page_loader" <?php echo ($setting[13]['settings_value']) ? "checked" : ""  ?> />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Paths Tab -->
                        <div class="tab-pane fade" id="paths" role="tabpanel" aria-labelledby="paths-tab">
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
                            
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="colFormLabel" class="col-form-label">
                                        <i class="fa fa-video-camera"></i> Video-Path
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-video-camera"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Video Path" id="video_path" value="<?php echo isset($setting[29]['settings_value']) ? $setting[29]['settings_value'] : '' ?>">
                                    </div>
                                    <small class="form-text text-muted">Path where video files are stored</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Media Tab - Original Code -->
                        <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                            <div class="social-media-grid">
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
                                    <div class="form-group">
                                        <label for="<?php echo strtolower($platform); ?>_url" class="col-form-label">
                                            <i class="<?php echo $icon; ?>"></i> <?php echo $platform; ?>
                                        </label>
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
                        
                        <!-- SEO Tab -->
                        <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                            <div class="seo-message">
                                <i class="fa fa-info-circle"></i> These meta tags will be used as defaults when individual pages don't have their own meta tags defined.
                            </div>
                            
                            <div class="form-group">
                                <label for="meta_title" class="col-form-label">
                                    <i class="fa fa-header"></i> Meta Title
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter Meta Title" id="meta_title" name="meta_title" value="<?php echo isset($setting[30]['settings_value']) ? htmlspecialchars($setting[30]['settings_value']) : '' ?>">
                                </div>
                                <small class="form-text text-muted">Recommended length: 50-60 characters</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="meta_description" class="col-form-label">
                                    <i class="fa fa-align-left"></i> Meta Description
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-align-left"></i></span>
                                    </div>
                                    <textarea class="form-control" placeholder="Enter Meta Description" id="meta_description" name="meta_description" rows="3"><?php echo isset($setting[31]['settings_value']) ? htmlspecialchars($setting[31]['settings_value']) : '' ?></textarea>
                                </div>
                                <small class="form-text text-muted">Recommended length: 150-160 characters</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="meta_keywords" class="col-form-label">
                                    <i class="fa fa-key"></i> Meta Keywords
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <textarea class="form-control" placeholder="Enter Meta Keywords (comma separated)" id="meta_keywords" name="meta_keywords" rows="2"><?php echo isset($setting[32]['settings_value']) ? htmlspecialchars($setting[32]['settings_value']) : '' ?></textarea>
                                </div>
                                <small class="form-text text-muted">Separate keywords with commas (e.g., keyword1, keyword2, keyword3)</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Save Button -->
                    <div class="form-group row mt-3">
                        <div class="col-sm-12 text-center">
                            <input type="submit" name="submit" class="btn btn-info" value="Save Changes" id="submit_btn" />
                        </div>
                    </div>
                </form>

                <?php include 'includes/footer_copyright.php'; ?>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Gallery Modal -->
        <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalLabel">Select Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="galleryImages">
                            <!-- Images will be loaded here via AJAX -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="selectGalleryImage">Select Image</button>
                    </div>
                </div>
            </div>
        </div>
                        
        <script type="text/javascript" src="js/og_setting/og_setting.js"></script>

    </div>
    <!-- /#wrapper -->
    <?php echo include_module('modules/upload_image.php', null); ?>

    <?php include 'includes/footer.php'; ?>