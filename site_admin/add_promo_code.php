<?php include 'includes/header.php';?>

<body id="page-top">

     <?php include 'setting/company_name.php';?>

     <?php include 'includes/navbar_search.php';?>

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
              Add a New Promocode
            </h1>
          </div>
        </div>
                
                 <!-- /.Content From Here -fluid -->

                  <!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div id="error_id"> </div>
                 <form class="needs-validation" onsubmit="return false" novalidate>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Promo Code Title</label>
   <div class="col-sm-10">
      <input type="text" class="form-control" id="p_title" required="required" placeholder="Enter Promo Code title" name="p_title"> 
     <div class="valid-feedback">Valid.</div>
     <div class="invalid-feedback">Please fill out this field.</div>
   </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Promo Code Percentage</label>
    <div class="col-sm-10">
       <input type="number" class="form-control" id="p_percent" required="required" placeholder="Enter Promo Code Percentage" name="p_percent" min="1" max="100">
     <div class="valid-feedback">Valid.</div>
     <div class="invalid-feedback">Please fill out this field.</div>
   </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Promo Code </label>
    <div class="col-sm-10">
       <input type="text" class="form-control" id="p_code" required="required" placeholder="Enter Promo Code" name="p_code">
     <div class="valid-feedback">Valid.</div>
     <div class="invalid-feedback">Please fill out this field.</div>
   </div>
</div>

<div class="form-group row">
  <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Description</label>
    <div class="col-sm-10">
      <textarea name="editor1" class="form-control form-control-lg" required="required" id="editor1"></textarea>
    </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Promo Code Validity</label>
    <div class="col-sm-10">
       <input type="date" class="form-control" id="p_validity" required="required" placeholder="Enter Promo code Validity" name="p_validity">
     <div class="valid-feedback">Valid.</div>
     <div class="invalid-feedback">Please fill out this field.</div>
   </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Promo Code Used Times</label>
   <div class="col-sm-10">
       <input type="number" class="form-control" id="p_used_times" required="required" placeholder="Enter Used Times" name="p_used_times">
     <div class="valid-feedback">Valid.</div>
     <div class="invalid-feedback">Please fill out this field.</div>
   </div>
</div>


<div class="form-group row">
  <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
    <div class="col-sm-10">
      <select class="form-control form-control-sm" id='isactive' name="isactive">
          <option  value="1">YES</option>
          <option  value="0">NO</option> 
      </select>
    </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-2" style="float:right;">
       <input type="submit" name="submit" class="form-control btn btn-info" value="Submit" id="colFormLabel" />
   </div>
</div>

</form>
<script type="text/javascript" src="js/promocode/add_promo_code.js"></script>

</div>
      <!-- /.container-fluid -->

         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?> 