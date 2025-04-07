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
          <li class="breadcrumb-item active">Gallery</li>
        </ol>

        <!-- Page Content -->
        <h1>Gallery</h1>
        <hr>
        <p>Upload Images</p>
          <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery()" type="button">
              <i class="fa fa-picture-o"></i>&nbsp; Open Gallery
             </button> 

      </div>
      <!-- /.container-fluid -->

         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

    <?php echo include_module('modules/upload_image.php' , null);?>

 <?php //include 'modals.php';?>
 <?php include 'includes/footer.php';?>
