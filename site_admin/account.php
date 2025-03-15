<?php include 'includes/header.php';?>

<body id="page-top">

     <?php include 'setting/company_name.php';?>

     <?php include 'includes/navbar_search.php';?>

      <?php include 'includes/notification.php';?>
   

  <div id="wrapper">

  <?php include'includes/sidebar.php'; ?>
    
    <div id="content-wrapper">

     <div class="container-fluid">

        <!-- Page Content -->
        <h5>Account Settings</h5>
        <hr>
      <div class="container">
        <div class="card-body">
      
      <div id="error_id"></div>

      <form class="needs-validation" onsubmit="return false" novalidate>
      <?php
      // print_r($_SESSION);
      $user_ = return_multiple_rows(softdelete_check("Select *
       from loginuser where id =".$_SESSION['user']['id'] , "loginuser"));
      ?>
        
  
      <div class="row">
              <div class="col-9">
                  <label class="col-form-label">Username</label>
                  <div class="">
                      <input type="text" class="form-control" id="username" value="<?php echo $user_[0]['username'];?>" required>
                       <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
          </div>

        <div class="row">
              <div class="col-9">
                  <label class="col-form-label">Email</label>
                  <div class="">
                      <input type="email" class="form-control" id="email" value="<?php echo $user_[0]['emailaddress'];?>" required>
                       <div class="valid-feedback">Valid.</div>
                       <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
          </div>



        <div class="row"> 
              <div class="col-9">
                  <label class="col-form-label">Password</label>
                  <div class="">
                      <input type="password" class="form-control" id="userpass" value="<?php echo $user_[0]['password'];?>" required>
                       <div class="valid-feedback">Valid.</div>
                       <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                </div>
        </div>

        <div class="row">
           <div class="col-9">
                  <label class="col-form-label">Repeat Password</label>
                  <div class="">
                      <input type="password" class="form-control" id="userpass1" value="<?php echo $user_[0]['password'];?>" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
        </div>

      <div class="row">
           <div class="col-8">
                  <label class="col-form-label">User Image</label>
                  <div class="">
                      <input type="text" class="form-control" id="p_image" value="<?php echo $user_[0]['profile_pic'];?>">
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
               <div class="col-4">
                  <label class="col-form-label"></label>
                  <div class="repeatbutton">
                       <button class="btn btn-primary form-control col-sm-4" onclick="OpenMediaGallery('p_image')" type="button">
                       <i class="fa fa-picture-o"></i>&nbsp;Gallery
                     </button> 
                  </div>
              </div>
        </div>


        <div class="row">
           <div class="col-9">
          <div class="form-group row mt-3">
              <button class="btn btn-primary">Update</button>
          </div>
          </div>
        </div>
      </form>
    </div>
      
      <!--Profile  -->
      <script type="text/javascript" src="js/account/account.js"></script>
      
       </div>
   
   </div>
      <!-- /.container-fluid -->


         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>

   <?php echo include_module('modules/upload_image.php' , null);?>

  <!-- /#wrapper -->
 <?php include 'includes/footer.php';?>
