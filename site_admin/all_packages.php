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

  <?php include'includes/sidebar.php'; ?>
    
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo $_SESSION['user']['dashboard'];?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Packages</li>
        </ol>

        <!-- Page Content -->
                <h1 class="page-header">
                List of Packages
                <a href="og_packages_category.php" style="float:right;color: #fff;margin: 14px;" class="btn btn-info btn-md"><i class="fa fa-book">&nbsp;</i>Packages Category</a>
                <a href="addall_packages.php" style="float:right;color: #fff;margin: 14px;" class="btn btn-danger btn-md"><i class="fa fa-globe">&nbsp;</i>Add New Package</a>
            </h1>

        <hr>

        <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Package Title</th>
                    <th>Package Price</th>
                    <th>Packages Category</th>
                    <th>Status</th>
                    <th>Options</th>


                  </tr>
                </thead>
                <tbody>
                <?php 
                $all_packages = return_multiple_rows("Select * from all_packages $where_gc Order by packages_category");
                foreach($all_packages as $all_packages) {
                  static $count =1;
                 ?> 
                  <tr id="tr_<?=$all_packages['pid']?>" >
                    <td><?=$count++;?></td>
                    <td><?=$all_packages["ptitle"]?></td>
                    <td><?=$all_packages["p_cost"];?></td>
                    
                     <td>
                     <?php 
                      echo return_single_ans("Select title from og_packages_category $where_gc  and og_all_packages_id = ".$all_packages['packages_category']);
                     ?>
                     </td>
                     
                   
                     <td>
                    <?php

                      if ($all_packages['isactive'] == 1) {
                        echo '<span id="status_'.$all_packages['pid'].'" class="badge badge-success">Active</span>
                        <input type="checkbox" data-id="'.$all_packages['pid'].'" class="js-switch" checked />';
                        } 
                        else echo '<span id="status_'.$all_packages['pid'].'"class="badge badge-danger">In Active</span>
                        <input type="checkbox" data-id="'.$all_packages['pid'].'" class="js-switch" />';
                    ?>
                    </td>
                    
                    <td>

                     <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-fw fa-cog"></i>
                            </a>
                          <div class="dropdown-menu" aria-labelledby="optionDropdown">
                          <?php 
                            echo '<a class="dropdown-item" href="editall_packages.php?id='.$all_packages['pid'].'">Edit</a>';
                            echo '<a class="dropdown-item" href="copyall_packages.php?id='.$all_packages['pid'].'">Copy Package</a>';
                            echo '<a class="dropdown-item" onclick="delete_('.$all_packages['pid'].')" >Delete</a>';
                            ?>
                        </div>
                      </td>
   </tr>
   <?php } ?>      

   </tbody>
</table>

</div>

        <script type="text/javascript" src="js/all_packages/all_packages.js"></script>


      </div>
      <!-- /.container-fluid -->

         <div id="deletemodal"></div>
         
         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>
