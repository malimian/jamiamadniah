<?php include 'includes/header.php';
static $count= 0;
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
          <li class="breadcrumb-item active">Member Managment</li>
        </ol>

        <!-- Page Content -->
        <div class="row">
          <div class="col-lg-12">
            <div class="col-lg-6">
             <h3 class="float-left">Memeber</h3> 
            </div>
             <div class="col-lg-12">
                <a href="addmember.php" class="btn btn-primary float-right">Add Memeber</a>
             </div>
          </div>
        </div>
        
        <hr>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Available Memeber List</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sno</th>
                    <th>Member name</th>
                    <th>Email</th>
                   
            
                    <th>Created On</th>
                   
                    <th>Status</th>
                    <th class="text-center"><i class="fas fa-fw fa-cog"></i></th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                  $users = return_multiple_rows("SELECT * , loginuser.isactive as user_isactive , loginuser.id as loginuser_id , loginuser.createdon as loginuser_createdon 
                   FROM loginuser   Where usertypeid = 2  ");
                //print_r($users);
                foreach ($users as $user) {
                ?>
                  <tr id="tr_<?=$count?>">
                    <td><?=$count+1;?></td>
                    <td><?=$user['username']?></td>
                    <td><?=$user['emailaddress']?></td>
                   
                    <td><?=$user['loginuser_createdon']?></td>
                 
                  

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

                              echo ' <a class="dropdown-item" href="addmember.php">Add Member</a>';
                             

                              echo ' <a class="dropdown-item" href="editmember.php?id='.encrypt_($user['loginuser_id']).'">Edit Memeber</a>';
                             

                              echo ' <a class="dropdown-item" onclick="delete_memeber('.$user['loginuser_id'].' , '.$count.')" >Delete Memeber</a>';
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

      function delete_memeber(id , tr_id){
          createmodal('Delete' , 'Are you sure You want to delete' , id , 'deletemodal' , function(){
          
          senddata(
                'post/member/member.php' ,
                 "POST" ,
                {
                  id:id ,
                 delete_member:true
                } ,
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
  <script src="js/member/member.js"></script>

 <?php include 'includes/footer.php';?>