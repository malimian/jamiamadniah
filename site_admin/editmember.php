<?php 
include 'includes/header.php';
$id  = decrypt_($_GET['id']);
echo $id;
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
          <li class="breadcrumb-item active">Update Memeber</li>
        </ol>

        <!-- Page Content -->
      <div class="container">
        <div class="card-body">
    
      <div id="error_id">
      </div>

      <form class="needs-validation" onsubmit="return false" novalidate>
      
      <?php
         $users = return_single_row("Select * from loginuser Where id  = ".$id);
   ?>
 <div class="row">
           
              <div class="col-6">
                  <label class="col-form-label">Username</label>
                  <div class="">
                      <input type="text" class="form-control" id="username" value="<?php echo $users['username'];?>" required>
                       <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
          </div>

        <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Email</label>
                  <div class="">
                      <input type="email" class="form-control" id="email" value="<?php echo $users['emailaddress'];?>" required>
                       <div class="valid-feedback">Valid.</div>
                       <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Password</label>
                  <div class="">
                      <input type="password" class="form-control" id="userpass"  value="<?php echo $users['password'];?>" required>
                       <div class="valid-feedback">Valid.</div>
                       <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Phone</label>
                  <div class="">
                      <input type="text" class="form-control" id="userphone" value="<?php echo $users['phonenumber'];?>">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Repeat Password</label>
                  <div class="">
                      <input type="password" class="form-control" id="userpass1" value="<?php echo $users['password'];?>" required>
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
                      <input type="text" class="form-control" id="country"  value="<?php echo $users['country'];?>">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Address</label>
                  <div class="">
                      <input type="text" class="form-control" id="address" value="<?php echo $users['address'];?>">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">City</label>
                  <div class="">
                      <input type="text" class="form-control" id="city" value="<?php echo $users['city'];?>">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">State</label>
                  <div class="">
                      <input type="text" class="form-control" id="state" value="<?php echo $users['state'];?>">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Zip Code</label>
                  <div class="">
                      <input type="text" class="form-control" id="zip" value="<?php echo $users['zip'];?>">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Home Phone</label>
                  <div class="">
                      <input type="text" class="form-control" id="home_phone" value="<?php echo $users['home_phone'];?>">
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
                      <input type="text" class="form-control" id="mobile_phone" value="<?php echo $users['mobile_phone'];?>">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">fax</label>
                  <div class="">
                      <input type="text" class="form-control" id="fax" value="<?php echo $users['fax'];?>">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Email Address</label>
                  <div class="">
                      <input type="text" class="form-control" id="other_email_address" value="<?php echo $users['other_email_address'];?>">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label"> Website</label>
                  <div class="">
                      <input type="text" class="form-control" id="website" value="<?php echo $users['website'];?>">
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
                      <input type="text" class="form-control" id="company" value="<?php echo $users['company'];?>">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Title</label>
                  <div class="">
                      <input type="text" class="form-control" id="company_title" value="<?php echo $users['company_title'];?>">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Phone</label>
                  <div class="">
                      <input type="text" class="form-control" id="company_phone" value="<?php echo $users['company_phone'];?>">
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label"> Toll Free Phone</label>
                  <div class="">
                      <input type="text" class="form-control" id="toll_phone" value="<?php echo $users['toll_phone'];?>">
                  </div>
              </div>
          </div>

      <!--  -->

        
        <button class="btn btn-primary">Save</button>
      </form>
    </div>

      <script>
      $('#chech_all').on('click', function(){
//                console.log($('.checkbox_usermodules').attr('checked'));

        if($('.checkbox_usermodules').attr('checked')){
        $('.checkbox_usermodules').attr('checked', false);
        $('#chech_all_txt').text('Check All');
        } else{
          $('.checkbox_usermodules').attr('checked', true);
          $('#chech_all_txt').text('Uncheck All');
        }

      });


      </script>


  
      <script>

    

        var user_id = '<?php echo $_GET['id']; ?>';

    </script>

    <script type="text/javascript" src="js/member/editmember.js"></script>
  

        </div>
      </div>
      <!-- /.container-fluid -->

         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>
