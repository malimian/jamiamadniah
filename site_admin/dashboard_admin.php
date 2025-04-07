<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = ['<link href="css/dashboard/dashboard_admin.css" rel="stylesheet" type="text/css">'];

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

      <?php include 'includes/notification.php';
      
      $total_p = return_single_ans(" select count(p_id) as total from promocode $Where_gc");
      $total_o = return_single_ans(" select count(order_id) as total from order_dh $Where_gc");
      $total_users = return_single_ans(" select count(id) as total from loginuser $Where_gc");
      
      $total_payments = return_single_ans(" select count(pay_id) as total from payments $Where_gc");


      $total_o_isactive = return_single_ans(" select count(order_id) as total from order_dh $Where_gc");
      $total_users_c_isactive = return_single_ans(" select count(id) as total from loginuser $Where_gc And isactive = 1");
      $total_regular_users_isactive = return_single_ans(" select count(id) as total from loginuser $Where_gc And isactive = 1 and usertypeid = 4 ");
      $total_p_isactive = return_single_ans(" select count(p_id) as total from promocode $Where_gc And isactive = 1");

      $total_payments_isactive = return_single_ans(" select count(pay_id) as total from payments $Where_gc And isactive = 1");



      $total_pages = return_single_ans(" select count(pid) as total from pages $Where_gc");
      $total_category = return_single_ans(" select count(pid) as total from all_packages $Where_gc");

      $total_all_packages = return_single_ans(" select count(pid) as total from all_packages $Where_gc");
      $total_pages_isactive = return_single_ans(" select count(pid) as total from pages $Where_gc");

      $total_p_isactive = return_single_ans(" select count(p_id) as total from promocode $Where_gc And isactive = 1");

      $total_category_isactive = return_single_ans(" select count(catid) as total from category $Where_gc And isactive = 1");

      $total_all_packages_isactive = return_single_ans(" select count(pid) as total from all_packages $Where_gc And isactive = 1");
      
      
            $total_documents =return_single_ans(" select count(docu_id) as total from documents $Where_gc");
            $total_documents_isactive = return_single_ans(" select count(docu_id) as total from documents $Where_gc And isactive = 1");


     ?>

  <div id="wrapper">

  <?php include 'includes/sidebar.php'; ?>
    
     <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

 <!-- Icon Cards-->
  <div class="row">


<div class="col-xl-4 col-sm-6 mb-3">
<div class="card text-white bg-primary o-hidden h-100">
  <div class="card-body">
    <div class="card-body-icon">
      <i class="fas fa-truck"></i>
    </div>
    <div class="mr-5">Order</div>
  </div>
  <a class="card-footer text-white clearfix small z-1" href="order.php">
    <span class="float-left">Total <?php echo $total_o?></span></br>
        <span class="float-left">Active <?php echo $total_o_isactive?></span>
    <span class="float-right">
      <i class="fas fa-angle-right"></i>
    </span>
  </a>
</div>
</div>

<div class="col-xl-4 col-sm-6 mb-3">
<div class="card text-white bg-success o-hidden h-100">
  <div class="card-body">
    <div class="card-body-icon">
      <i class="fas fa-gift"></i>
    </div>
    <div class="mr-5">Promo Code</div>
  </div>
  <a class="card-footer text-white clearfix small z-1" href="view_promo_code.php">
    <span class="float-left">Total <?php echo $total_p?></span></br>
        <span class="float-left">Active <?php echo $total_p_isactive?></span>
    <span class="float-right">
      <i class="fas fa-angle-right"></i>
    </span>
  </a>
</div>
</div>

<div class="col-xl-4 col-sm-6 mb-3">
<div class="card text-white bg-info o-hidden h-100">
  <div class="card-body">
    <div class="card-body-icon">
      <i class="fas fa-fw fa-users"></i>
    </div>
    <div class="mr-5">Total Users</div>
  </div>
  <a class="card-footer text-white clearfix small z-1" href="user.php">
    <span class="float-left">Total <?php echo $total_users?></span></br>
        <span class="float-left">Active <?php echo $total_users_c_isactive?></span>

    <span class="float-right">
      <i class="fas fa-angle-right"></i>
    </span>
  </a>
</div>
</div>

</div>
 <!-- Icon Cards-->


  <!-- Icon Cards-->
  <div class="row">

<div class="col-xl-4 col-sm-6 mb-3">
<div class="card text-white video o-hidden h-100">
  <div class="card-body">
    <div class="card-body-icon">
      <i class="fas fa-cubes"></i>
    </div>
    <div class="mr-5">Packages</div>
  </div>
  <a class="card-footer text-white clearfix small z-1" href="all_packages.php">
    <span class="float-left">Total <?php echo $total_all_packages?></span></br>
        <span class="float-left">Active <?php $total_all_packages_isactive?></span>

    <span class="float-right">
      <i class="fas fa-angle-right"></i>
    </span>
  </a>
</div>
</div>


<div class="col-xl-4 col-sm-6 mb-3">
<div class="card text-white order o-hidden h-100">
  <div class="card-body">
    <div class="card-body-icon">
      <i class="fas fa-file-text"></i>
    </div>
    <div class="mr-5">Pages</div>
  </div>
  <a class="card-footer text-white clearfix small z-1" href="pages.php">
    <span class="float-left">Total <?php echo $total_pages?></span></br>
        <span class="float-left">Active <?php echo $total_o_isactive?></span>
    <span class="float-right">
      <i class="fas fa-angle-right"></i>
    </span>
  </a>
</div>
</div>


<div class="col-xl-4 col-sm-6 mb-3">
<div class="card text-white longcourse o-hidden h-100">
  <div class="card-body">
    <div class="card-body-icon">
      <i class="fas fa-clipboard-check"></i>
    </div>
    <div class="mr-5">Menue</div>
  </div>
  <a class="card-footer text-white clearfix small z-1" href="categories.php">
    <span class="float-left">Total <?php echo $total_category?></span></br>
        <span class="float-left">Active <?php echo $total_category_isactive?></span>
    <span class="float-right">
      <i class="fas fa-angle-right"></i>
    </span>
  </a>
</div>
</div>



<div class="col-xl-4 col-sm-6 mb-3">
<div class="card text-white bg-warning h-100">
  <div class="card-body">
    <div class="card-body-icon">
      <i class="fas fa-money"></i>
    </div>
    <div class="mr-5">Payments</div>
  </div>
  <a class="card-footer text-white clearfix small z-1" href="payments.php">
    <span class="float-left">Total <?php echo $total_payments; ?></span></br>
        <span class="float-left">Active <?php echo $total_payments_isactive; ?></span>
    <span class="float-right">
      <i class="fas fa-angle-right"></i>
    </span>
  </a>
</div>
</div>


  <!-- Icon1 START Card1-->
<div class="col-xl-4 col-sm-6 mb-3">
<div class="card text-white bg-warning o-hidden h-100">
  <div class="card-body">
    <div class="card-body-icon">
      <i class="fas fa-book"></i>
    </div>
    <div class="mr-5">Documents</div>
  </div>
  <a class="card-footer text-white clearfix small z-1" href="documents.php">
    <span class="float-left">Total <?php echo $total_documents; ?></span></br>
        <span class="float-left">Active <?php echo $total_documents_isactive; ?></span>
    <span class="float-right">
      <i class="fas fa-angle-right"></i>
    </span>
  </a>
</div>
</div>
 <!-- Icon1 ENDS Card1-->



</div>  <!-- Icon Cards-->





</div>
  

      </div>
    </div>
      <!-- /.container-fluid -->
  </div>
        <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>



