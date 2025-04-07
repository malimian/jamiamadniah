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

$id  = decrypt_($_GET['id']);
?>

<body id="page-top">

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
          <li class="breadcrumb-item active">Update User</li>
        </ol>

        <!-- Page Content -->
      <div class="container">
        <div class="card-body">
    
      <div id="error_id">
      </div>

      <form class="needs-validation" onsubmit="return false" novalidate>
      
       <?php
              $users = return_multiple_rows(
                "Select * , og_usertype.id as og_usertype_id from og_usertype Left JOIN loginuser ON og_usertype.id = loginuser.usertypeid WHERE loginuser.id = ".$id
              );

              $user_moddules = return_multiple_rows(
                "SELECT og_module_id as id FROM user_module WHERE uid = ".$id
              );
              $user_rights = return_multiple_rows(
                "SELECT og_moduleactions_id as id FROM user_rights WHERE uid = ".$id
              );
              ?>

      <div class="row">
              <div class="col-6">
                  <label class="col-form-label">User Role</label>
                  <div class="">
                      <select class="form-control" id="user_type_select" required>
                        <?php
                        $user_types = return_multiple_rows("Select id , title from og_usertype Where isactive = 1");
                        foreach ($user_types as $user_type ) {
                        ?>
                        <option value="<?php echo $user_type['id'];?>" <?php if($users[0]['og_usertype_id'] == $user_type['id']) echo " selected";?> ><?php echo $user_type['title'];?></option>
                        <?php }?>
                      </select>
                  </div>
              </div>
             
              <div class="col-6">
                  <label class="col-form-label">Username</label>
                  <div class="">
                      <input type="text" class="form-control" id="username" value="<?php echo $users[0]['username'];?>" required>
                       <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
          </div>

        <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Email</label>
                  <div class="">
                      <input type="email" class="form-control" id="email" value="<?php echo $users[0]['emailaddress'];?>" required>
                       <div class="valid-feedback">Valid.</div>
                       <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Password</label>
                  <div class="">
                      <input type="password" class="form-control" id="userpass" value="<?php echo $users[0]['password'];?>" required>
                      <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-6">
                  <label class="col-form-label">Phone</label>
                  <div class="">
                      <input type="text" class="form-control" id="userphone" value="<?php echo $users[0]['phonenumber'];?>" >
                  </div>
              </div>
              <div class="col-6">
                  <label class="col-form-label">Repeat Password</label>
                  <div class="">
                      <input type="password" class="form-control" id="userpass1" value="<?php echo $users[0]
                      ['password'];?>" required>
                      <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
              </div>
          </div>

          <label class="col-form-label col-lg-2">User Modules</label>
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
                    <input type="checkbox" class="checkbox_usermodules custom-control-input chk_module" id="chk_module_<?php echo $module['id'];?>" data-id="<?php echo $module['id'];?>">
                    <label class="custom-control-label" for="chk_module_<?php echo $module['id'];?>" ><?php echo $module['title'];?></label>
                  </div>
                <?php 
                  $count++;
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
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input chk_mdaction" data-id="<?php echo $og_moduleaction['id'];?>" id="chk_mdaction_<?php echo $og_moduleaction['id'];?>" >
                    <label class="custom-control-label" for="chk_mdaction_<?php echo $og_moduleaction['id'];?>" ><?php echo $og_moduleaction['title'];?></label>
                  </div>
                <?php }
                ?>
                 </div>
            </div>
        </div>
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

     var arr_user_moddules = <?php echo json_encode($user_moddules); ?> ;
        var user_module_id = 'chk_module';

        $('.'+user_module_id).each(function() {
            var user_module = $(this).attr('data-id');
            $.each(arr_user_moddules, function(index, value) {
                if (value['id'] == user_module) {
                    $("#" + user_module_id + "_" + value['id']).prop('checked', true);
                } else {
                    console.log('Not Found');
                }
            });
        });


       var arr_user_moddules = <?php echo json_encode($user_rights); ?> ;
        var user_module_id = 'chk_mdaction';

        $('.'+user_module_id).each(function() {
            var user_module = $(this).attr('data-id');
            $.each(arr_user_moddules, function(index, value) {
                if (value['id'] == user_module) {
                    $("#" + user_module_id + "_" + value['id']).prop('checked', true);
                } else {
                    console.log('Not Found');
                }
            });
        });

        var user_id = '<?php echo $_GET['id']; ?>';

    </script>

    <script type="text/javascript" src="js/user/edituser.js"></script>
  

        </div>
      </div>
      <!-- /.container-fluid -->

         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>
