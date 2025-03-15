<?php include 'includes/header.php';?>


<link href="css/dashboard/dashboard_admin.css" rel="stylesheet" type="text/css">

<body id="page-top">

     <?php include 'setting/company_name.php';?>

     <?php include 'includes/navbar_search.php';?>

      <?php include 'includes/notification.php';
      
      $total_p = return_single_ans(" select count(p_id) as total from promocode $Where_gc");
      $total_users = return_single_ans(" select count(id) as total from loginuser $Where_gc");
      $total_smspackages = return_single_ans(" select count(smsp_id) as total from smspackages $Where_gc");
      
      $total_users_c_isactive = return_single_ans(" select count(id) as total from loginuser $Where_gc And isactive = 1");
      $total_regular_users_isactive = return_single_ans(" select count(id) as total from loginuser $Where_gc And isactive = 1 and usertypeid = 4 ");

      $total_p_isactive = return_single_ans(" select count(p_id) as total from promocode $Where_gc And isactive = 1");




      $total_pages = return_single_ans(" select count(pid) as total from pages $Where_gc");
      $total_domains = return_single_ans(" select count(did) as total from domains $Where_gc");
      $total_packages = return_single_ans(" select count(pid) as total from packages $Where_gc");
      $total_category = return_single_ans(" select count(catid) as total from category $Where_gc");
      
       $total_pages_isactive = return_single_ans(" select count(pid) as total from pages $Where_gc");

      $total_domains_isactive = return_single_ans(" select count(did) as total from domains $Where_gc And isactive = 1");

      $total_packages_isactive = return_single_ans(" select count(pid) as total from packages $Where_gc And isactive = 1");

     $total_p_isactive = return_single_ans(" select count(p_id) as total from promocode $Where_gc And isactive = 1");

     $total_category_isactive = return_single_ans(" select count(catid) as total from category $Where_gc And isactive = 1");

      $total_smspackages_isactive = return_single_ans(" select count(smsp_id) as total from smspackages $Where_gc And isactive = 1");

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


<div class="col-xl-6 col-sm-6 mb-3">
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

<div class="col-xl-6 col-sm-6 mb-3">
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
<div class="card text-white membership o-hidden h-100">
  <div class="card-body">
    <div class="card-body-icon">
      <i class="fas fa-globe"></i>
    </div>
    <div class="mr-5">Domains</div>
  </div>
  <a class="card-footer text-white clearfix small z-1" href="domains.php">
    <span class="float-left">Total <?php echo $total_domains?></span></br>
        <span class="float-left">Active <?php echo $total_domains_isactive?></span>
    <span class="float-right">
      <i class="fas fa-angle-right"></i>
    </span>
  </a>
</div>
</div>

<div class="col-xl-4 col-sm-6 mb-3">
<div class="card text-white video o-hidden h-100">
  <div class="card-body">
    <div class="card-body-icon">
      <i class="fas fa-fw fa-users"></i>
    </div>
    <div class="mr-5">Packages</div>
  </div>
  <a class="card-footer text-white clearfix small z-1" href="packages.php">
    <span class="float-left">Total <?php echo $total_packages?></span></br>
        <span class="float-left">Active <?php echo $total_packages_isactive?></span>

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
<div class="card text-white longcourse o-hidden h-100">
  <div class="card-body">
    <div class="card-body-icon">
      <i class="fas fa-clipboard-check"></i>
    </div>
    <div class="mr-5">SMS Packages</div>
  </div>
  <a class="card-footer text-white clearfix small z-1" href="smspackages.php">
    <span class="float-left">Total <?php echo $total_smspackages; ?></span></br>
        <span class="float-left">Active <?php echo $total_smspackages_isactive; ?></span>
    <span class="float-right">
      <i class="fas fa-angle-right"></i>
    </span>
  </a>
</div>
</div>




</div>
 <!-- Icon Cards-->





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



