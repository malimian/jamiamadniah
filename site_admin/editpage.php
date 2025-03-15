<?php include 'includes/header.php';?>
<body id="page-top">
   <?php include 'setting/company_name.php';?>
   <?php include 'includes/navbar_search.php';?>
   <?php include 'includes/notification.php';?>

<?php
         $page = return_single_row("Select * from pages Where pid  = ".$_GET['id']." $and_gc ");
   ?>

   <div id="wrapper">
   <?php include 'includes/sidebar.php'; ?>
   <div id="content-wrapper">
      <div class="container-fluid">
         <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
               <div class="col-lg-12">
                  <h3 class="page-header">
                      Update Page
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

                           <!-- <div class="container"> -->
                              <!-- <h2>Toggleable Tabs</h2> -->
                              
                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs" role="tablist">
                                 <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home">Description</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu1">SEO</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu2">HEADER</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu3">TEMPLATE</a>
                                 </li>
                                  <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu4">ADDITIONAL</a>
                                 </li>
                              </ul>

                              <!-- Tab panes -->
                              <div class="tab-content">
                                 <div id="home" class="container tab-pane active">

                                 <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Category</label>
                              <div class="col-sm-10">
                                 <select type="text" class="form-control" id="ctname" required="required" placeholder="Enter Course title" name="ctname">
                                   <?php 

                                    $categories = return_multiple_rows("Select catname , catid  from category $where_gc and isactive = 1 ");

                                    foreach ($categories as $category) {
                                      
                                      if($page['catid'] == $category['catid'] ) 

                                       echo "<option value='".$category['catid']."' selected  >".$category['catname']."</option>";
                                      else
                                       echo "<option value='".$category['catid']."'>".$category['catname']."</option>";

                                    }

                                   ?>

                                 </select>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="page_title" required="required" placeholder="Enter Page title" name="page_title" value="<?php echo $page['page_title']?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Url</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" id="page_url" required="required" placeholder="Page Url" name="page_url" value="<?php echo $page['page_url']?>" readonly>
                                 </div>
                                 <div class="col-sm-2">
                                   <input type="checkbox" class="form-control minecheck" id="check_url"/>
                                </div>
                           </div>

                        <div class="form-group row">
                           <label for="colFormLabel" class="col-sm-2 col-form-label">Image</label>
                           <div class="col-sm-10">
                              <div class="form-inline">
                                   <input type="text" value="<?php echo $page['featured_image']?>" class="form-control col-sm-10" id="p_image" placeholder="Choose Image" name="p_image">
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
                                 <textarea class="form-control" id="editor1" name="editor1" required="required"><?php echo replaceTextArea($page['page_desc'])?></textarea>
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                          
                            <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Show in Nav Bar</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='showInNavbar' name="showInNavbar">
                                    <option value="1" <?php if($page['showInNavBar'] == 1 ) echo "selected";?> >YES</option>
                                    <option value="0" <?php if($page['showInNavBar'] != 1) echo "selected";?> >NO</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='is_active' name="is_active">
                                    <option value="1" <?php if($page['showInNavBar'] == 1 ) echo "isactive";?> >YES</option>
                                    <option value="0" <?php if($page['showInNavBar'] != 1 ) echo "isactive";?> >NO</option>
                                 </select>
                              </div>
                           </div>

                                 </div>
                                 <div id="menu1" class="container tab-pane fade">
                                 <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Meta Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="meta_title" placeholder="Update Title" name="meta_title" value="<?php echo $page['page_meta_title']; ?>">
                                 </div>
                           </div>
                          <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Meta Keywords</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="meta_keywords" placeholder="Comma separated" name="meta_keywords" value="<?php echo $page['page_meta_keywords']?>">
                                 </div>
                           </div>
                          <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Meta Description</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" id="meta_desc" name="meta_desc"><?php echo $page['page_meta_desc']?></textarea>
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                                 </div>                                    
                                 <div id="menu2" class="container tab-pane fade">
                                 <div class="form-group row">
                              <!-- <label for="colFormLabel" class="col-sm-2 col-form-label">Enter Text</label> -->
                              <div class="col-sm-12">
                              <textarea class="form-control" rows="10" id="header" placeholder="Update Header Files" name="editor1"><?php echo $page['header']?></textarea>
                              <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>                       
                              </div>
                           </div>                               
                                 </div>
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
                                 
                                 if($site_template['st_id'] == $page['site_template_id'])
                                   echo "<option value='".$site_template['st_id']."' selected>".$site_template['st_name']."</option>";
                                 else  
                                   echo "<option value='".$site_template['st_id']."'>".$site_template['st_name']."</option>";
                                 
                                 }
                                ?>
                              </select>
                           </div>
                        </div>

                     </div>
                  </div>

                       <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Template Page</label>
                              <div class="col-sm-10">
                                 <select type="text" class="form-control" id="template_page" required="required" name="template_page">
                                   <?php 

                                    $og_template = return_multiple_rows("Select template_title , template_id from og_template $where_gc and isactive = 1 ");

                                    foreach ($og_template as $og_template) {
                                      
                                     if($page['template_id'] == $og_template['template_id'] ) 

                                       echo "<option value='".$og_template['template_id']."' selected  >".$og_template['template_title']."</option>";
                                      else
                                       echo "<option value='".$og_template['template_id']."'>".$og_template['template_title']."</option>";

                                    }

                                   ?>

                                 </select>
                              </div>
                           </div>

               <!-- End of Menue 3 -->
               </div> 

                  <div id="menu4" class="container tab-pane fade">              
                        <label for="colFormLabel" class="col-sm-5 col-form-label">Upload Photo Gallery</label>
                        <input class="form-control" type="file" id='files' name="files[]" multiple style="opacity : 100%; margin: 17px">
                        
                         <?php
                        $photogallery = return_multiple_rows("Select * from images Where pid = ".$_GET['id']." and isactive = 1 and soft_delete = 0");
                        if(!empty($photogallery)){
                    ?>
                    
                        <div class="container">
                          <div class="row">
                            <div class="col-12">
                        		<table class="table table-image">
                        		  <thead>
                        		    <tr>
                        		      <th scope="col">Image</th>
                        		      <th scope="col">Name</th>
                        		      <th scope="col">Delete</th>
                        		    </tr>
                        		  </thead>
                        		  <tbody>
                        		      <?php 
                                        foreach($photogallery as $photogallery_){
                                    ?>
                        		    <tr id="dr_<?php echo $photogallery_['i_id'];?>">
                        		      <td class="w-25">
                        			      <img src="<?php echo "../".ABSOLUTE_IMAGEPATH.$photogallery_['i_name'];?>" class="img-fluid img-thumbnail" alt="Sheep">
                        		      </td>
                        		      <td><?php echo $photogallery_['i_name'];?></td>
                        		      <td><button onclick="delete_image(<?php echo $photogallery_['i_id'];?>)" class="btn btn-danger btn-sm rounded-0" type="button" title="Delete"><i class="fa fa-trash"></i></button></td>
                        		    </tr>
                        		    <?php } ?>
                        		  </tbody>
                        		</table>   
                            </div>
                          </div>
                        </div>
                        <?php }?>
                        <!-- End of Menue 4 -->
                     </div> 


                           <div class="form-group row"> 
                              <div class="col-sm-10">
                                 
                              </div>                            
                              <div class="col-sm-2">
                                 <input type="submit" name="submit" class="form-control btn btn-info" value="Submit" id="submit_btn" />
                              </div>
                           </div>
                        </form>
                         <script type="text/javascript">
                           var page_id = "<?php echo $page['pid']; ?>";
                        </script>
                        <script type="text/javascript" src="js/page/editpage.js"></script>
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
   <?php //include 'modals.php';?>

   <?php echo include_module('modules/upload_image.php' , null);?>

   <?php include 'includes/footer.php';?>