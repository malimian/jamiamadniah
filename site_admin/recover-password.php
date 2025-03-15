<?php require_once('includes/simple_header.php');

if(!isset($_GET['code']) || !isset($_GET['email'])) 
        exit("<script>location.href='".ADMIN_URL."'</script>");

?>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div id="error_id"></div>
        <form class="needs-validation" onsubmit="return false" novalidate>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">New Password</label>
              <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Please fill out this field.</div>
            </div>
          </div>
            <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword1" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword1">Confirm New Password</label>
              <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Please fill out this field.</div>
            </div>
          </div>
          <input type="hidden" id="inputEmail" value="<?php echo $_GET['email'];?>">
          <input type="hidden" id="confirmation_code" value="<?php echo $_GET['code'];?>">          
          <button id="RestPasswordbtn" class="btn btn-primary btn-block">Reset Password</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login</a>
        </div>

      </div>
    </div>
  </div>

<script type="text/javascript" src="js/login/recover-password.js"></script>

 <?php include 'includes/footer.php';?>