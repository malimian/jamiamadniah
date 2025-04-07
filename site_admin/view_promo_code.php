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

?>

<body id="page-top">

      <?php include 'includes/notification.php';?>

  <div id="wrapper">

  <?php include'includes/sidebar.php'; ?>
    
    <div id="content-wrapper">

      <div class="container-fluid">
   
       <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            List of Promo Code
                                        

                          <a style="float:right;" class="btn btn-danger btn-md" href='add_promo_code.php'><i class="glyphicon glyphicon-plus"></i>Add Promo Code</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?=$_SESSION['user']['dashboard'];?>">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-student"></i> / Show all Promo Code
                            </li>
                        </ol>
                         <!-- /.Content From Here -fluid -->
                          <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">


<table id="dataTable1" class="table table-bordered">
    <thead>
        <tr>
            <th>No#</th>
            <th>Title</th>
            <th>Percentage</th>
            <th>Code</th>
            <th>Validity</th>
            <th>Used-Times</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody class="searchable">
   <?php


    $sql="SELECT * , isactive  as prmocode_active FROM promocode $where_gc";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    static $c = 1;
        ?><tr id="tr_<?=$row["p_id"];?>">
                    <td><?php echo  $c++;?></td>
                    <td><?php echo  $row["p_title"];?></td>
                    <td><?php echo  $row["p_percent"];?></td>
                    <td><?php echo  $row["p_code"];?></td>
                    <td><?php echo  $row["p_validity"];?></td>
                    <td><?php echo  $row["p_used_times"];?></td>
                    <td>
                                    
                          <a class=" dropdown-toggle" href="#" id="optionDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-fw fa-cog"></i>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="optionDropdown">
                            <?php 
                 
                    echo ' <a class="dropdown-item" href="edit_promo_code.php?id='.encrypt_($row["p_id"]).'">Edit</a>';

                    echo ' <a class="dropdown-item" onclick="delete_course('.$row["p_id"].')" >Delete</a>';

                       if ($row['prmocode_active'] == 1) {
                          echo '<span id="status_'.$row['p_id'].'" class="badge badge-success">Active</span>
                          <input type="checkbox" data-id="'.$row['p_id'].'" class="js-switch" checked />';
                          } 
                          else echo '<span id="status_'.$row['p_id'].'"class="badge badge-danger">In Active</span>
                          <input type="checkbox" data-id="'.$row['p_id'].'" class="js-switch" />';

                             ?>
                          </div>
                      </td>


                                    </tr>
                <?php
                   }
                 }?>
     </tbody>
</table>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

   
    

    </div>
    </div>
      </div>
      <!-- /.container-fluid -->

    <script type="text/javascript" src="js/promocode/view_promo_code.js"></script>

         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
  <div id="deletemodal"></div>

 <?php include 'includes/footer.php';?>
