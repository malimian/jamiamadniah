<?php require_once('includes/simple_header.php');?>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <div id="error_id"></div>
        <form class="needs-validation" onsubmit="return false" novalidate>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputEmail" class="form-control" placeholder="Email/ Username" required>
              <label for="inputEmail">Email address</label>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
          </div>
          <button id="RestPasswordbtn" class="btn btn-primary btn-block">Reset Password</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login</a>
        </div>

      </div>
    </div>
  </div>

<script type="text/javascript" src="js/login/forgot-password.js"></script>


 <?php include 'includes/footer.php';?>