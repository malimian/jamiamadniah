<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

AdminHeader(
    "Gallery", 
    "", 
    $extra_libs,
    null,
    '

    '
);

?>
<body id="page-top">
   <?php include 'includes/notification.php';?>
   <div id="wrapper">
   <?php include 'includes/sidebar.php'; ?>
   <div id="content-wrapper">
      <div class="container-fluid">
         <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
               <div class="col-lg-12">
                  <h3 class="page-header">
                     Add New Page
                  </h3>
               </div>
            </div>
            <!-- /.Content From Here -fluid -->
            <!-- Page Content -->
            <div id="error_id"></div>
            <div id="page-content-wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12">
                        <form class="needs-validation" onsubmit="return false" novalidate>                              
                              <!-- Nav tabs -->
                              <!-- Tabs Navigation -->
                              <ul class="nav nav-tabs" role="tablist">
                                 <!-- Description Tab -->
                                 <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home">
                                       <i class="fa fa-file-text"></i> Description
                                    </a>
                                 </li>

                                 <!-- SEO Tab -->
                                 <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu1">
                                       <i class="fa fa-search"></i> SEO
                                    </a>
                                 </li>

                                 <!-- HEADER Tab -->
                                 <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu2">
                                       <i class="fa fa-header"></i> HEADER
                                    </a>
                                 </li>

                                 <!-- TEMPLATE Tab -->
                                 <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu3">
                                       <i class="fa fa-code"></i> TEMPLATE
                                    </a>
                                 </li>

                                 <!-- Photo Gallery Tab -->
                                 <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu4">
                                       <i class="fa fa-image"></i> Photo Gallery
                                    </a>
                                 </li>

                                 <!-- Shop Tab -->
                                 <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu5">
                                       <i class="fa fa-shopping-cart"></i> Shop
                                    </a>
                                 </li>

                                 <!-- Page Categories Tab -->
                                 <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu6">
                                       <i class="fa fa-folder"></i> Page Categories
                                    </a>
                                 </li>
                              </ul>

                              <!-- Tab panes -->
                              <div class="tab-content">
                                 <div id="home" class="container tab-pane active">

                                 <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Category</label>
                              <div class="col-sm-10">
                                 <select type="text" class="form-control" id="ctname" required="required" placeholder="Enter title" name="ctname">
                                   <?php 

                                    $categories = return_multiple_rows("Select catname , catid  from category $where_gc and isactive = 1 ");

                                    foreach ($categories as $category) {
                                    
                                     $isselected_cat = "";
                                     if(isset($_GET['cat'])){
                                               if(!empty($_GET['cat'])){
                                                   if($_GET['cat'] == $category['catid']) $isselected_cat = "selected";
                                               }
                                      }
                                      
                                      echo "<option value='".$category['catid']."' $isselected_cat >".$category['catname']."</option>";

                                    }

                                   ?>

                                 </select>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="page_title" required="required" placeholder="Enter Page title" name="page_title">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Url</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="page_url" required="required" placeholder="Page Url" name="page_url" >
                                 </div>
                           </div>
   
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Featured Image</label>
                              <div class="col-sm-10">
                                 <div class="form-inline">
                                      <input type="text" class="form-control col-sm-10" id="p_image" placeholder="Choose Image" name="p_image">
                                      <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('p_image')" type="button">
                                       <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                     </button> 
                                      <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                                 </div>
                              </div>
                           </div>

                              <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Description</label>
                              <div class="col-sm-10">
                                 <textarea id="editor1" name="editor1"  ></textarea>
                              <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Show in Nav Bar</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='showInNavbar' name="showInNavbar">
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='is_active' name="is_active">
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                 </select>
                              </div>
                           </div>
                                 </div>
                                 <div id="menu1" class="container tab-pane fade">
                                 <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Meta Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="meta_title" name="meta_title">
                                 </div>
                           </div>
                          <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Meta Keywords</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="meta_keywords" placeholder="Comma separated" name="meta_keywords">
                                 </div>
                           </div>
                          <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Meta Description</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" rows="5" id="meta_desc" name="meta_desc"></textarea>                               
                              </div>
                           </div>
                                 </div>                                    

                              <div id="menu2" class="container tab-pane fade">
                                    <div class="form-group row">
                                       <div class="col-sm-12">
                                          <textarea class="form-control" rows="10" id="header" placeholder="Header Code" spellcheck="false"></textarea>                             
                                       </div>
                                    </div>
                                 </div> <!-- End of Menue 2 -->
            
                    <div id="menu3" class="container tab-pane fade">
                          <div class="form-group row">
                             <div class="col-sm-12">
                                <div class="form-group row">
                                   <label for="colFormLabel" class="col-sm-2 col-form-label">Main Template</label>
                                   <div class="col-sm-10">
                                      <select type="text" class="form-control" id="site_template" required="required" placeholder="Enter title" name="site_template">
                                        <?php 
        
                                         $site_templates = return_multiple_rows("Select st_id , st_name from site_template $where_gc and isactive = 1 ");
        
                                         foreach ($site_templates as $site_template) {
                                           
                                           echo "<option value='".$site_template['st_id']."'>".$site_template['st_name']."</option>";
                                         }
                                        ?>
                                      </select>
                                   </div>
                                </div>
        
                             </div>
                          </div>

                           <div class="form-group row">
                             <div class="col-sm-12">
                                <div class="form-group row">
                                   <label for="colFormLabel" class="col-sm-2 col-form-label">Template Page</label>
                                   <div class="col-sm-10">
                                      <select type="text" class="form-control" id="template_page" required="required" name="template_page">
                                        <?php 
        
                                         $og_templates = return_multiple_rows("Select template_title , template_id from og_template $where_gc and isactive = 1 ");
        
                                         foreach ($og_templates as $og_template) {
                                          
                                          $isselected = "";

                                           if(isset($_GET['temp'])){
                                               if(!empty($_GET['temp'])){
                                                   if($_GET['temp'] == $og_template['template_id']) $isselected = "selected";
                                               }
                                           }
                                           
                                           echo "<option value='".$og_template['template_id']."' $isselected>".$og_template['template_title']."</option>";
                                           
                                         }
                                        ?>
                                      </select>
                                   </div>
                                </div>
        
                             </div>
                          </div>
        
                       <!-- End of Menue 3 -->
               
               </div> 
               
                


                           <div id="menu4" class="container tab-pane fade">              
                                    <!--<div class="input-images" style="margin: .5rem;" ></div>-->
                                     <label for="colFormLabel" class="col-sm-5 col-form-label">Upload Photo Gallery</label>
                                     <input class="form-control" type="file" id='files' name="files[]" multiple style="opacity : 100%; margin: 17px">
                                <!-- End of Menue 4 -->
                             </div>
                             
                            
                            <div id="menu5" class="container tab-pane fade">
                               <!-- Start of Menue 5 shop -->
                                 <?php echo include_module('modules/add_product_module.php' , array('action' => "add"));?>  
                                <!--End of Menue 5 shop-->
                            </div>
                            
                              <div id="menu6" class="container tab-pane fade">
                                  <!-- Start of Menue 6 page category -->
                                        <div class="form-group row">
                                            <div class="col-lg" id="category_list">
                                            <?php
                                            
                                                    $menus = array(
                                                        'items' => array(),
                                                        'parents' => array()
                                                    );                                            
                                                    $p_cats = return_multiple_rows("Select catid , catname , cat_url , ParentCategory from category Where isactive = 1 and soft_delete = 0");
                                                    foreach ($p_cats as $p_cat) {
                                                        
                                                            $menus['items'][$p_cat['catid']] = $p_cat;
                                                            $menus['parents'][$p_cat['ParentCategory']][] = $p_cat['catid'];
                                                    }
                                                    
                                                echo createmulltilevelcheckbox(0, $menus);                                            
                                            ?>
                                             </div>
                                    </div>
                                  <!-- End of Menue 6 page category -->
                              </div>


                           <div class="form-group row"> 
                              <div class="col-sm-10"> 
                              </div>                            
                              <div class="col-sm-2">
                                 <input type="submit" name="submit" class="form-control btn btn-info" value="Submit" id="submit_btn" />
                              </div>
                           </div>
                        </form>
                          <script>
                            //   $('.input-images').imageUploader({
                            //       imagesInputName: 'input-images',
                            //   });
                           </script>
                         
                        <script type="text/javascript" src="js/page/addpage.js"></script>
                      </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
         <?php include 'includes/footer_copyright.php';?>    
      </div>
      <!-- /.content-wrapper -->
   </div>
   <!-- /#wrapper -->
    <?php echo include_module('modules/upload_image.php' , null);?>

 <?php include 'includes/footer.php';?>