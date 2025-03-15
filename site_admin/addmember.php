<?php 
include 'includes/header.php';
?>

<body id="page-top">

     <?php include 'setting/company_name.php';?>

     <?php include 'includes/navbar_search.php';?>

      <?php include 'includes/notification.php';?>
   

  <div id="wrapper">

  <?php include'includes/sidebar.php'; ?>
    
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?=$_SESSION['user']['dashboard'];?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Add Member</li>
        </ol>
        

        <!-- Page Content -->
      <div class="container">
        <div class="card-body">
    
      <div id="error_id">
      </div>

      <form class="needs-validation" onsubmit="return false" novalidate>
      
      <div class="row">
              <div class="col-6">
                  <label class="col-form-label">User Role</label>
                  <div class="">
                      <select class="form-control" id="user_type_select" required>
                        <?php
                        $user_types = return_multiple_rows("Select id , title from og_usertype Where isactive = 1");
                        foreach ($user_types as $user ) {
                        ?>
                        <option value="<?php echo $user['id'];?>"><?php echo $user['title'];?></option>
                        <?php }?>
                      </select>
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Username</label>
                  <div class="">
                      <input type="text" class="form-control" id="username" required>
                       <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
          </div>

        <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Email</label>
                  <div class="">
                      <input type="email" class="form-control" id="email" required>
                       <div class="valid-feedback">Valid.</div>
                       <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Password</label>
                  <div class="">
                      <input type="password" class="form-control" id="userpass" required>
                       <div class="valid-feedback">Valid.</div>
                       <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Phone</label>
                  <div class="">
                      <input type="text" class="form-control" id="userphone">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Repeat Password</label>
                  <div class="">
                      <input type="password" class="form-control" id="userpass1" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
          </div>

          <!--  -->

          <label class="col-form-label address" style="font-size: 26px;color: darkgrey;">Primary Address</label>
          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Country</label>
                  <div class="">
                      <input type="text" class="form-control" id="country">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Address</label>
                  <div class="">
                      <input type="text" class="form-control" id="address">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">City</label>
                  <div class="">
                      <input type="text" class="form-control" id="city">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">State</label>
                  <div class="">
                      <input type="text" class="form-control" id="state">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Zip Code</label>
                  <div class="">
                      <input type="text" class="form-control" id="zip">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Home Phone</label>
                  <div class="">
                      <input type="text" class="form-control" id="home_phone">
                  </div>
              </div>
          </div>

          <!--  -->


           <!--  -->
           <label class="col-form-label address" style="font-size: 26px;color: darkgrey;">Other Info</label>
          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Mobile Phone</label>
                  <div class="">
                      <input type="text" class="form-control" id="mobile_phone">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">fax</label>
                  <div class="">
                      <input type="text" class="form-control" id="fax">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Email Address</label>
                  <div class="">
                      <input type="text" class="form-control" id="other_email_address">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label"> Website</label>
                  <div class="">
                      <input type="text" class="form-control" id="website">
                  </div>
              </div>
          </div>

      <!--  -->

       <!--  -->
       <label class="col-form-label address" style="font-size: 26px;color: darkgrey;">Work Information</label>
          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Company</label>
                  <div class="">
                      <input type="text" class="form-control" id="company">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Title</label>
                  <div class="">
                      <input type="text" class="form-control" id="company_title">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Phone</label>
                  <div class="">
                      <input type="text" class="form-control" id="company_phone">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label"> Toll Free Phone</label>
                  <div class="">
                      <input type="text" class="form-control" id="toll_phone">
                  </div>
              </div>
          </div>

      <!--  -->












          <!-- <div class="row">
              <div class="col-12">
                  <label class="col-form-label">Profile Image</label>
                    <input type="text" class="form-control col-sm-10" id="p_image" required="required" placeholder="Insert Image" name="p_image">
                      <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('p_image')" type="button">
                       <i class="fa fa-picture-o"></i>&nbsp;Gallery
                     </button> 
                      <div class="valid-feedback">Valid.</div>
                 <div class="invalid-feedback">Please fill out this field.</div>
                 </div>
              </div>
            
          </div> -->

          <!-- <label class="col-form-label col-lg-2">User Modules</label>
          <div class="form-group row mt-3">
            <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="chech_all">
                    <label class="custom-control-label" for="chech_all" id="chech_all_txt">Check All</label>
            </div>
          </div>

        <div class="form-group row mt-3" id="usermodule_list">
            <div class="col-lg-5">
                <div class="col-lg-12">
                    <?php
                        $modules = return_multiple_rows("Select id , title from og_module Where isactive = 1 Order by hierarchy");
                        foreach ($modules as $module) {
                          $modules_count = round(count($modules)/2);
                          static $count = 0;
                          if($count == $modules_count) echo "</div></div><div class='col-lg-6'><div class='col-lg-12'>";
                        ?>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="checkbox_usermodules custom-control-input" id="chks_<?php echo $module['id'];?>" data-id="<?php echo $module['id'];?>">
                    <label class="custom-control-label" for="chks_<?php echo $module['id'];?>"><?php echo $module['title'];?></label>
                  </div>
                <?php  $count++;
                }
                ?>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-lg-2">User Rights & Privileges</label>
            <div class="col-lg-10">
                <div class="col-lg-10" id="userrights_list">
                <?php
                        $og_moduleactions = return_multiple_rows("Select id , title from og_moduleactions Where isactive = 1");
                        foreach ($og_moduleactions as $og_moduleaction) {
                        ?>
                  <div class="custom-control custom-checkbox col-md-4">
                    <input type="checkbox" class="custom-control-input" id="chk_mdaction_<?php echo $og_moduleaction['id'];?>" data-id="<?php echo $og_moduleaction['id'];?>">
                    <label class="custom-control-label" for="chk_mdaction_<?php echo $og_moduleaction['id'];?>"><?php echo $og_moduleaction['title'];?></label>
                  </div>
                <?php }
                ?>
                 </div>
            </div>
        </div> -->
<!--         <div class="form-group">
          <label for="uname">Username:</label>
          <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Please fill out this field.</div>
        </div> -->
        
        <button class="btn btn-primary">Save</button>
      </form>
    </div>
      
      <script>
      $('#chech_all').on('click', function(){
        if($('.checkbox_usermodules').attr('checked')){
        $('.checkbox_usermodules').attr('checked', false);
        $('#chech_all_txt').text('Check All');
        } else{
          $('.checkbox_usermodules').attr('checked', true);
          $('#chech_all_txt').text('Uncheck All');
        }

      });


      </script>

       <!--Add member  -->
      <script type="text/javascript" src="js/member/addmember.js"></script>

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
