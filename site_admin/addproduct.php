<?php include 'includes/header.php';?>
<body id="page-top">
   <?php include 'setting/company_name.php';?>
   <?php include 'includes/navbar_search.php';?>
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
                     Add New Product
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
                              <ul class="nav nav-tabs" role="tablist">
                                 <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home">Description</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu5">IMAGES</a>
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

                                    $categories = return_multiple_rows("Select catname , catid  from category_product $where_gc and isactive = 1 ");

                                    foreach ($categories as $category) {
                                      echo "<option value='".$category['catid']."'>".$category['catname']."</option>";
                                    }

                                   ?>

                                 </select>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="page_title" required="required" placeholder="Enter Product title" name="page_title">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Url</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="page_url" required="required" placeholder="Product Url" name="page_url" >
                                 </div>
                           </div>
                           
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">SKU</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="sku" required="required" placeholder="Enter Product title" name="sku" value="<?php echo uniqid();?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           
                             <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Price</label>
                              <div class="col-sm-10">
                                 <input type="number" min="0" class="form-control" id="plistprice" required="required" placeholder="Enter Product Price" name="plistprice" >
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
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
                                    
                                    $selected = "";

                                    if($og_template['template_id'] == 4 ) $selected = "selected";
                                   
                                   echo "<option value='".$og_template['template_id']."' $selected >".$og_template['template_title']."</option>";
                                 }
                                ?>
                              </select>
                           </div>
                        </div>

                     </div>
                  </div>

               <!-- End of Menue 3 -->
               </div>


                         <div id="menu5" class="container tab-pane fade">              
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
                                 <label for="colFormLabel" class="col-sm-2 col-form-label">Image1</label>
                                 <div class="col-sm-10">
                                    <div class="form-inline">
                                         <input type="text" class="form-control col-sm-10" id="p_image1" placeholder="Choose Image" name="p_image1">
                                         <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('p_image1')" type="button">
                                          <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                        </button> 
                                         <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                 </div>
                              </div>


                                <div class="form-group row">
                                 <label for="colFormLabel" class="col-sm-2 col-form-label">Image2</label>
                                 <div class="col-sm-10">
                                    <div class="form-inline">
                                         <input type="text" class="form-control col-sm-10" id="p_image2" placeholder="Choose Image" name="p_image2">
                                         <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('p_image2')" type="button">
                                          <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                        </button> 
                                         <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                 </div>
                              </div>


                                <div class="form-group row">
                                 <label for="colFormLabel" class="col-sm-2 col-form-label">Image3</label>
                                 <div class="col-sm-10">
                                    <div class="form-inline">
                                         <input type="text" class="form-control col-sm-10" id="p_image3" placeholder="Choose Image" name="p_image3">
                                         <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('p_image3')" type="button">
                                          <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                        </button> 
                                         <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                 </div>
                              </div>


                                <div class="form-group row">
                                 <label for="colFormLabel" class="col-sm-2 col-form-label">Image4</label>
                                 <div class="col-sm-10">
                                    <div class="form-inline">
                                         <input type="text" class="form-control col-sm-10" id="p_image4" placeholder="Choose Image" name="p_image4">
                                         <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('p_image4')" type="button">
                                          <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                        </button> 
                                         <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                 </div>
                              </div>

                                <div class="form-group row">
                                 <label for="colFormLabel" class="col-sm-2 col-form-label">Image5</label>
                                 <div class="col-sm-10">
                                    <div class="form-inline">
                                         <input type="text" class="form-control col-sm-10" id="p_image5" placeholder="Choose Image" name="p_image5">
                                         <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('p_image5')" type="button">
                                          <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                        </button> 
                                         <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                 </div>
                              </div>

                           </div> 
                        <!-- End of Menue 5 -->


                        <div id="menu4" class="container tab-pane fade">              
                        
                              <div class="form-group row">
                                 <div class="form-check">
                                   <input class="form-check-input" type="checkbox" value="" id="additionalCheck1" checked="checked">
                                   <label class="form-check-label" for="additionalCheck1">
                                     Instock ?
                                   </label>
                                 </div>
                              </div>
                               <div class="form-group row">
                                 <div class="form-check">
                                   <input class="form-check-input" type="checkbox" value="" id="additionalCheck2" checked="checked">
                                   <label class="form-check-label" for="additionalCheck2">
                                     New Arrival ?
                                   </label>
                                 </div>
                              </div>
                               <div class="form-group row">
                                 <div class="form-check">
                                   <input class="form-check-input" type="checkbox" value="" id="additionalCheck3">
                                   <label class="form-check-label" for="additionalCheck3">
                                     Featured Product ?
                                   </label>
                                 </div>
                              </div>
                               <div class="form-group row">
                                 <div class="form-check">
                                   <input class="form-check-input" type="checkbox" value="" id="additionalCheck4">
                                   <label class="form-check-label" for="additionalCheck4">
                                     On Sale
                                   </label>
                                 </div>
                              </div>
                               <div class="form-group row">
                                 <div class="form-check">
                                   <input class="form-check-input" type="checkbox" value="" id="additionalCheck5">
                                   <label class="form-check-label" for="additionalCheck5">
                                    Best Seller
                                   </label>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <div class="form-check">
                                   <input class="form-check-input" type="checkbox" value="" id="additionalCheck6">
                                   <label class="form-check-label" for="additionalCheck6">
                                    Trending Item
                                   </label>
                                 </div>
                              </div>

                               <div class="form-group row">
                                 <div class="form-check">
                                   <input class="form-check-input" type="checkbox" value="" id="additionalCheck7">
                                   <label class="form-check-label" for="additionalCheck7">
                                    Hot Item 
                                   </label>
                                 </div>
                              </div>


                     </div> 
                        <!-- End of Menue 4 -->


                           <div class="form-group row"> 
                              <div class="col-sm-10"> 
                              </div>                            
                              <div class="col-sm-2">
                                 <input type="submit" name="submit" class="form-control btn btn-info" value="Submit" id="submit_btn" />
                              </div>
                           </div>
                        </form>
                        <script type="text/javascript" src="js/product/addproduct.js"></script>
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