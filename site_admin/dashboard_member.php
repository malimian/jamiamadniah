<?php include 'includes/header.php';?>


<link href="css/dashboard/dashboard_admin.css" rel="stylesheet" type="text/css">

<body id="page-top">

     <?php include 'setting/company_name.php';?>

     <?php include 'includes/navbar_search.php';?>

      <?php include 'includes/notification.php';
      
      $id0 = $_SESSION['user']['id'];
      
      $users0 = return_single_row("Select * from loginuser Where id = $id0 ");
      
    //   print_r($users0);

     ?>
<style>
.icon-box.medium {
    font-size: 20px;
    width: 50px;
    height: 50px;
    line-height: 50px;
}
.icon-box {
    font-size: 30px;
    margin-bottom: 33px;
    display: inline-block;
    color: #ffffff;
    height: 65px;
    width: 65px;
    line-height: 65px;
    background-color: #59b73f;
    text-align: center;
    border-radius: 0.3rem;
}
.social-icon-style2 li a {
    display: inline-block;
    font-size: 14px;
    text-align: center;
    color: #ffffff;
    background: #59b73f;
    height: 41px;
    line-height: 41px;
    width: 41px;
}
.rounded-3 {
    border-radius: 0.3rem !important;
}

.social-icon-style2 {
    margin-bottom: 0;
    display: inline-block;
    padding-left: 10px;
    list-style: none;
}

.social-icon-style2 li {
    vertical-align: middle;
    display: inline-block;
    margin-right: 5px;
}

a, a:active, a:focus {
    color: #616161;
    text-decoration: none;
    transition-timing-function: ease-in-out;
    -ms-transition-timing-function: ease-in-out;
    -moz-transition-timing-function: ease-in-out;
    -webkit-transition-timing-function: ease-in-out;
    -o-transition-timing-function: ease-in-out;
    transition-duration: .2s;
    -ms-transition-duration: .2s;
    -moz-transition-duration: .2s;
    -webkit-transition-duration: .2s;
    -o-transition-duration: .2s;
}

.text-secondary, .text-secondary-hover:hover {
    color: #59b73f !important;
}
.display-25 {
    font-size: 1.4rem;
}

.text-primary, .text-primary-hover:hover {
    color: #ff712a !important;
}

p {
    margin: 0 0 20px;
}

.mb-1-6, .my-1-6 {
    margin-bottom: 1.6rem;
}
</style>
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

<div class="container" style="margin:18px;">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-4 mb-5 mb-lg-0 wow fadeIn">
            <div class="card border-0 shadow">
                <img src="/images/<?php echo $users0['profile_pic'];?>" alt="...">
                <div class="card-body p-1-9 p-xl-5">
                    <div class="mb-4">
                        <h3 class="h4 mb-0"><?php echo $users0['username'];?></h3>
                        <span class="text-primary"><?php echo $users0['city'];?> , <?php echo $users0['country'];?></span>
                    </div>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-3"><a href="#!"><i class="far fa-envelope display-25 me-3 text-secondary"></i><?php echo $users0['emailaddress'];?></a></li>
                        <li class="mb-3"><a href="#!"><i class="fas fa-mobile-alt display-25 me-3 text-secondary"></i><?php echo $users0['phonenumber'];?></a></li>
                        <li><a href="#!"><i class="fas fa-map-marker-alt display-25 me-3 text-secondary"></i><?php echo $users0['address'];?></a></li>
                    </ul>
                    <ul class="social-icon-style2 ps-0">
                        <li><a href="#!" class="rounded-3"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#!" class="rounded-3"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#!" class="rounded-3"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="#!" class="rounded-3"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--<div class="col-lg-8">-->
        <!--    <div class="ps-lg-1-6 ps-xl-5">-->
        <!--        <div class="mb-5 wow fadeIn">-->
        <!--            <div class="text-start mb-1-6 wow fadeIn">-->
        <!--                <h2 class="h1 mb-0 text-primary">#About Me</h2>-->
        <!--            </div>-->
        <!--            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>-->
        <!--            <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>-->
        <!--        </div>-->
        <!--        <div class="mb-5 wow fadeIn">-->
        <!--            <div class="text-start mb-1-6 wow fadeIn">-->
        <!--                <h2 class="mb-0 text-primary">#Education</h2>-->
        <!--            </div>-->
        <!--            <div class="row mt-n4">-->
        <!--                <div class="col-sm-6 col-xl-4 mt-4">-->
        <!--                    <div class="card text-center border-0 rounded-3">-->
        <!--                        <div class="card-body">-->
        <!--                            <i class="ti-bookmark-alt icon-box medium rounded-3 mb-4"></i>-->
        <!--                            <h3 class="h5 mb-3">Education</h3>-->
        <!--                            <p class="mb-0">University of defgtion, fecat complete ME of synage</p>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="col-sm-6 col-xl-4 mt-4">-->
        <!--                    <div class="card text-center border-0 rounded-3">-->
        <!--                        <div class="card-body">-->
        <!--                            <i class="ti-pencil-alt icon-box medium rounded-3 mb-4"></i>-->
        <!--                            <h3 class="h5 mb-3">Career Start</h3>-->
        <!--                            <p class="mb-0">After complete engineer join HU Signage Ltd as a project manager</p>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="col-sm-6 col-xl-4 mt-4">-->
        <!--                    <div class="card text-center border-0 rounded-3">-->
        <!--                        <div class="card-body">-->
        <!--                            <i class="ti-medall-alt icon-box medium rounded-3 mb-4"></i>-->
        <!--                            <h3 class="h5 mb-3">Experience</h3>-->
        <!--                            <p class="mb-0">About 20 years of experience and professional in signage</p>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
                
        <!--    </div>-->
        <!--</div>-->
    </div>
</div>



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



