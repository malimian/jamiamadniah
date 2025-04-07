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

static $count= 0;
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
          <li class="breadcrumb-item active">User Managment</li>
        </ol>

        <!-- Page Content -->
        <div class="row">
          <div class="col-lg-12">
            <div class="col-lg-6">
             <h3 class="float-left">Users</h3> 
            </div>
             <div class="col-lg-12">
                <a href="adduser.php" class="btn btn-primary float-right">Add User</a>
             </div>
          </div>
        </div>
        
        <hr>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Available User List</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sno</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Created On</th>
                    <th>Modules</th>
                    <th>Status</th>
                    <th class="text-center"><i class="fas fa-fw fa-cog"></i></th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                  $users = return_multiple_rows(softdelete_check("SELECT * , loginuser.isactive as user_isactive , 
                  loginuser.id as loginuser_id , loginuser.createdon as loginuser_createdon FROM loginuser  
                  INNER JOIN og_usertype On og_usertype.id = loginuser.usertypeid 
                  AND loginuser.usertypeid < 4 Where usertypeid = 1 ",'loginuser , og_usertype' ));
                //print_r($users);
                foreach ($users as $user) {
                ?>
                  <tr id="tr_<?=$count?>">
                    <td><?=$count+1;?></td>
                    <td><?=$user['username']?></td>
                    <td><?=$user['emailaddress']?></td>
                    <td><?=$user['title']?></td>
                    <td><?=$user['loginuser_createdon']?></td>
                    <td>
                        <div class="td_modules" style="overflow-y:scroll;overflow-x:hidden;max-height: 170px;">
                      <?php
                      $modules = return_multiple_rows(softdelete_check("SELECT title from og_module INNER JOIN user_module ON og_module.id = user_module.og_module_id Where user_module.uid = ".$user['loginuser_id'] , 'og_module,user_module'));
                        foreach ($modules as $module) {
                         echo '<span class="badge badge-success">'.$module['title'].'</span>';
                        }
                       ?>
                       </div>
                    </td>
                  

                    <td>
                      <?php
                      if ($user['user_isactive'] == 1) {
                      echo '<span id="status_'.$user['loginuser_id'].'" class="badge badge-success">Active</span>
                      <input type="checkbox" data-id="'.$user['loginuser_id'].'" class="js-switch" checked />';
                      } else echo '<span id="status_'.$user['loginuser_id'].'" class="badge badge-danger">In Active</span>
                      <input type="checkbox" data-id="'.$user['loginuser_id'].'" class="js-switch" />';
                      ?>
                      </td>
                      <td>
                          <a class=" dropdown-toggle" href="#" id="optionDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-fw fa-cog"></i>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="optionDropdown">
                            <?php 

                              echo ' <a class="dropdown-item" href="adduser.php">Add User</a>';
                             

                              echo ' <a class="dropdown-item" href="edituser.php?id='.encrypt_($user['loginuser_id']).'">Edit User</a>';
                             

                              echo ' <a class="dropdown-item" onclick="delete_user('.$user['loginuser_id'].' , '.$count.')" >Delete User</a>';
                             ?>
                          </div>
                      </td>
                   </tr>
                  <?php $count++; }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
      <script type="text/javascript">

      function delete_user(id , tr_id){
          createmodal('Delete' , 'Are you sure You want to delete' , id , 'deletemodal' , function(){
          
          senddata(
                'post/user/users.php' ,
                 "POST" ,
                {id:id , delete_user:true} ,
               function(result){ console.log(result);} ,
              function(result){  console.log(result);}   
            );

            $('#tr_'+tr_id).hide();
            $('#custommodal').modal('toggle');
          });
          $('#custommodal').modal('toggle');
      }
      

    </script>
   
         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
<div id="deletemodal"></div>
  <!-- delete Modal-->

    <!-- users  -->
  <script src="js/user/users.js"></script>

 <?php include 'includes/footer.php';?>