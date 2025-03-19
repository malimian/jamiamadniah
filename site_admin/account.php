<?php include 'includes/header.php';?>

<body id="page-top">

     <?php include 'setting/company_name.php';?>

     <?php include 'includes/navbar_search.php';?>

      <?php include 'includes/notification.php';?>
   
      <style>
        .form-group label {
            font-weight: bold;
        }
        .input-group-text {
            background-color: #007bff;
            color: white;
            border: none;
        }
    </style>

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
    $user_ = return_multiple_rows(softdelete_check("Select * from loginuser where id =" . $_SESSION['user']['id'], "loginuser"));
    ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4"><i class="fa fa-user-circle"></i> User Profile</h5>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="username"><i class="fa fa-user"></i> Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_[0]['username']; ?>" required>
                    <div class="invalid-feedback">Please enter a username.</div>
                </div>

                <div class="form-group col-md-6">
                    <label for="emailaddress"><i class="fa fa-envelope"></i> Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_[0]['emailaddress']; ?>" required>
                    <div class="invalid-feedback">Please enter a valid email.</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password"><i class="fa fa-lock"></i> Password</label>
                    <input type="password" class="form-control" id="userpass" name="userpass" value="<?php echo $user_[0]['password']; ?>" required>
                    <div class="invalid-feedback">Please enter a password.</div>
                </div>

                <div class="form-group col-md-6">
                    <label for="password"><i class="fa fa-lock"></i> Repeat Password</label>
                    <input type="password" class="form-control" id="userpass1" name="userpass1" value="<?php echo $user_[0]['password']; ?>" required>
                    <div class="invalid-feedback">Please enter a password.</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="other_email_address"><i class="fa fa-envelope-o"></i> Other Email Address</label>
                    <input type="email" class="form-control" id="other_email_address" name="other_email_address" value="<?php echo $user_[0]['other_email_address']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="mobile_phone"><i class="fa fa-phone"></i> Mobile Phone</label>
                    <input type="text" class="form-control" id="mobile_phone" name="mobile_phone" value="<?php echo $user_[0]['mobile_phone']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fax"><i class="fa fa-fax"></i> Fax</label>
                    <input type="text" class="form-control" id="fax" name="fax" value="<?php echo $user_[0]['fax']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="website"><i class="fa fa-globe"></i> Website</label>
                    <input type="text" class="form-control" id="website" name="website" value="<?php echo $user_[0]['website']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="company"><i class="fa fa-building"></i> Company</label>
                    <input type="text" class="form-control" id="company" name="company" value="<?php echo $user_[0]['company']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="company_title"><i class="fa fa-id-badge"></i> Company Title</label>
                    <input type="text" class="form-control" id="company_title" name="company_title" value="<?php echo $user_[0]['company_title']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="company_phone"><i class="fa fa-phone-square"></i> Company Phone</label>
                    <input type="text" class="form-control" id="company_phone" name="company_phone" value="<?php echo $user_[0]['company_phone']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="toll_phone"><i class="fa fa-phone"></i> Toll-Free Phone</label>
                    <input type="text" class="form-control" id="toll_phone" name="toll_phone" value="<?php echo $user_[0]['toll_phone']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="p_image"><i class="fa fa-image"></i> User Image</label>
                    <input type="text" class="form-control" id="p_image" value="<?php echo $user_[0]['profile_pic']; ?>">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-group col-md-4">
                    <label>&nbsp;</label>
                    <button class="btn btn-primary btn-block" onclick="OpenMediaGallery('p_image')" type="button">
                        <i class="fa fa-picture-o"></i>&nbsp;Gallery
                    </button>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fullname"><i class="fa fa-id-card"></i> Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user_[0]['fullname']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="country"><i class="fa fa-globe"></i> Country</label>
                    <input type="text" class="form-control" id="country" name="country" value="<?php echo $user_[0]['country']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="city"><i class="fa fa-building"></i> City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $user_[0]['city']; ?>">
                </div>

                <div class="form-group col-md-4">
                    <label for="state"><i class="fa fa-map"></i> State</label>
                    <input type="text" class="form-control" id="state" name="state" value="<?php echo $user_[0]['state']; ?>">
                </div>

                <div class="form-group col-md-4">
                    <label for="zip"><i class="fa fa-map-pin"></i> ZIP Code</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $user_[0]['zip']; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="address"><i class="fa fa-home"></i> Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $user_[0]['address']; ?>">
            </div>

            <div class="form-group row">
                <label for="description"><i class="fa fa-pencil"></i> Bio</label>
              <div class="col-sm-12">
                <textarea name="editor1" class="form-control" required="required" id="editor1"><?php echo $user_[0]['details']; ?></textarea>
              </div>
          </div>

            <div class="form-group row mt-4">
                <div class="col-12">
                    <button class="btn btn-primary btn-lg btn-block">Update Profile</button>
                </div>
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
