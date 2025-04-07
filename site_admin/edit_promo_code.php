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

     <?php include 'setting/company_name.php';?>

     <?php include 'includes/navbar_search.php';?>

      <?php include 'includes/notification.php';?>
   

  <div id="wrapper">

  <?php include'includes/sidebar.php'; ?>
    
    <div id="content-wrapper">

      <div class="container-fluid">
      <?php
          $id =  decrypt_($_GET['id']);
          $sql="SELECT * from promocode Where p_id=".$id;
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          // output data of each row
         while($row = $result->fetch_assoc()) {
        ?>
        
               <div class="container-fluid">
        
                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="page-header">
                               
                                    Edit Promo code
                                
                                </h3>
                                
								</div>
								</div>
                                 <!-- /.Content From Here -fluid -->
        
                                  <!-- Page Content -->
                <div id="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">

                            <div id="error_id">
                            
                            </div>
          
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="p_title" required="required" placeholder="Enter Promo Code title" name="p_title" value="<?php echo  html_entity_decode($row["p_title"]);?>">
              
              
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label">Percent</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="p_percent" placeholder="Enter Promo Code Percentage" name="p_percent" value="<?php echo  html_entity_decode($row["p_percent"]);?>"  min="1" max="100">
              
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label">Code</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="p_code" required="required" placeholder="Enter Promo Code" name="p_code" value="<?php echo  html_entity_decode($row["p_code"]);?>" >
              
              
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Description</label>
            <div class="col-sm-10">
              <textarea name="editor1" class="form-control form-control-lg" id="editor1"><?php echo  html_entity_decode($row["p_desc"]);?></textarea>
              
            </div>
          </div>
          
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label">Validity</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="p_validity" required="required" placeholder="Enter Promo Code Validity" name="p_validity" value="<?php echo  html_entity_decode($row["p_validity"]);?>" readonly="readonly">
              
              
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label">Used Times</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="p_used_times" required="required" placeholder="Enter Promo Code Used Time" name="p_used_times" value="<?php echo  html_entity_decode($row["p_used_times"]);?>" >
          
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
            <div class="col-sm-10">
                  <select class="form-control form-control-sm" id="isactive" name="isactive">
                    <?php $isactive = $row['isactive']; ?>
                      <option <?php if ($isactive == 1 ) echo 'selected' ; ?> value="1">YES</option>
                      <option <?php if ($isactive == 0 ) echo 'selected' ; ?> value="0">NO</option> 
                  </select>
            </div>
        </div>

         
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-2" style="float:right;">
              <input type="submit" name="submit" class="form-control btn btn-info" value="Submit" id="update_promocode" />
            </div>
          </div>
                  
       <?php
    }
} // end of query bracket
?>

<script>
var id ="<?php echo $_GET['id'];?>";
</script>

<script type="text/javascript" src="js/promocode/edit_promo_code.js"></script>


            </div>
            </div>
            </div>
            </div>

      </div>
      <!-- /.container-fluid -->

         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>
