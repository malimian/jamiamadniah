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

      
      <?php echo include_module('modules/file_manager.php' , array('path_' => realpath(__DIR__ . '/..') ));?>
      
      </div>
      <!-- /.container-fluid -->

         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php //include 'modals.php';?>
 <?php include 'includes/footer.php';?>
