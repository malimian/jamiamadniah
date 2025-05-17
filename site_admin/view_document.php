<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

AdminHeader(
    "View Document", 
    "", 
    $extra_libs,
    null,
    '

    '
);

  $document_id = decrypt_($_GET['document_id']);


  $document_detail = return_single_row("Select * from documents where docu_id = ".$document_id." and isactive = 1 and soft_delete = 0 ");  
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
            <a href="<?php echo $_SESSION['user']['dashboard'];?>">Dashboard/Documents/</a>
          </li>
          <li class="breadcrumb-item active"><?php echo $document_detail['document_Title'];?></li>
        </ol>

        <!-- Page Content -->
            <h1><?php echo $document_detail['document_Title'];?></h1>
        <hr>
            <?php 
            echo replace_sysvari($document_detail['document_detail'] , null);
            ?>        
      </div>
      <!-- /.container-fluid -->

         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php //include 'modals.php';?>
 <?php include 'includes/footer.php';?>
