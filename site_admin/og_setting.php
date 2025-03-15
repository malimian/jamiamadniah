<?php include 'includes/header.php'; ?>

<body id="page-top">

    <?php include 'setting/company_name.php'; ?>

    <?php include 'includes/navbar_search.php'; ?>

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

                <div  class="container-fluid tab-pane fade active show">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label"> Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"  placeholder="Enter Title" id="title" value="<?php echo $setting[0]['settings_value']?>">
                            <small class="form-text text-muted">Use Short Code <?php echo $setting[0]['short_code']?></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label"> Tagline</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"  placeholder="Enter Tagline" id="tagline" name="meta_keywords" value="<?php echo $setting[1]['settings_value']?>">
                            <small class="form-text text-muted">Use Short Code <?php echo $setting[1]['short_code']?></small>
                        </div>
                    </div>
                </div>

                <div class="container-fluid tab-pane fade active show">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label"> Logo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Enter  Logo" id="logo" value="<?php echo $setting[8]['settings_value']?>">
                            <small class="form-text text-muted">Use Short Code <?php echo $setting[8]['short_code']?></small>
                        </div>
                    </div>
                </div>

                <div  class="container-fluid tab-pane fade active show">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label"> URL</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"  placeholder="Enter URL" id="url" value="<?php echo $setting[2]['settings_value']?>">
                            <small class="form-text text-muted">Use Short Code <?php echo $setting[2]['short_code']?></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label"> E-mail</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"  placeholder="Enter E-mail" id="email" name="meta_keywords" value="<?php echo $setting[4]['settings_value']?>">
                            <small class="form-text text-muted">Use Short Code <?php echo $setting[4]['short_code']?></small>
                        </div>
                    </div>
                </div>

                <div  class="container-fluid tab-pane fade active show">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label"> Key</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"  placeholder="Enter Key" id="key" value="<?php echo $setting[5]['settings_value']?>">
                        </div>
                    </div>
                </div>

                <div  class="container-fluid tab-pane fade active show">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label"> Key-Pass</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"  placeholder="Enter Key-Pass" id="keypass" value="<?php echo $setting[6]['settings_value']?>">
                        </div>
                    </div>
                </div>

                <div  class="container-fluid tab-pane fade active show">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label"> ENV</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"  placeholder="Enter ENV" id="env" value="<?php echo $setting[7]['settings_value']?>">
                        </div>
                    </div>
                </div>


                <div  class="container-fluid tab-pane fade active show">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label"> IMG-Path</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"  placeholder="Enter IMG-Path" id="img_path" value="<?php echo $setting[9]['settings_value']?>">
                            <small class="form-text text-muted">Use Short Code <?php echo $setting[9]['short_code']?></small>
                        </div>
                    </div>
                </div>

                 <div  class="container-fluid tab-pane fade active show">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">TIME ZONE</label>
                        <div class="col-sm-8">
                            <select id="time_zone" class="form-control">
                                <?php
                                $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                                foreach ($tzlist as $tzlist_) {
                                if($tzlist_ == $setting[10]['settings_value'])
                                    echo "<option selected>".$tzlist_."</option>";
                                else
                                    echo "<option>".$tzlist_."</option>";
                                } ?>
                            </select>

                            <small class="form-text text-muted">Use Short Code <?php echo $setting[10]['short_code']?></small>
                        </div>
                    </div>
                </div>

                <div  class="container-fluid tab-pane fade active show">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">ERROR 404</label>
                        <div class="col-sm-8">
                         <select class="form-control" id="error_404" required="required" name="error_404">
                                 
                                   <?php 

                                    $pages = return_multiple_rows("Select page_title , page_url from pages $where_gc and isactive = 1 ");

                                    foreach ($pages as $page) {
                                      
                                      if($setting[14]['settings_value'] == $page['page_url'] ) 

                                       echo "<option value='".$page['page_url']."' selected  >".$page['page_title']."</option>";
                                      else
                                       echo "<option value='".$page['page_url']."'>".$page['page_title']."</option>";

                                    }
                                   ?>

                                 </select>
                        </div>
                    </div>
                </div>

                <div  class="container-fluid tab-pane fade active show">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label"> File-Path</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"  placeholder="Enter File-Path" id="file_path" value="<?php echo $setting[11]['settings_value']?>">
                            <small class="form-text text-muted">Use Short Code <?php echo $setting[11]['short_code']?></small>
                        </div>
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
                    <div class="col-sm-2">
                    <div class="click">
                            <input type="submit" name="submit" class="form-control btn btn-info" value="Submit" id="submit_btn" />
                        </div>
                    </div>
                    <div class="col-sm-8"></div>                    
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