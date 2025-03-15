<?php include 'includes/header.php';?>

<body id="page-top">

     <?php include 'setting/company_name.php';?>

     <?php include 'includes/navbar_search.php';?>

      <?php include 'includes/notification.php';?>
   

  <div id="wrapper">

  <?php include'includes/sidebar.php'; ?>
    
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Payment List</li>
        </ol>

        <!-- Page Content -->
                <h1 class="page-header">
                Payment List 
                <a href="addpayments.php" style="float:right;color: #fff" class="btn btn-danger btn-md"><i class="fa fa-globe">&nbsp;</i>Add New Payment</a>
            </h1>

        <hr>

        <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Payment Title</th>
                    <th>Payment Details</th>
                    <th>Option</th>
                    <th>Status</th>
                   
                  </tr>
                </thead>
                <tbody>
                <?php 
                $payments = return_multiple_rows("Select * from payments $where_gc Order by payment_Title ASC ");
                foreach($payments as $payments) {
                  static $count =1;
                 ?> 
                  <tr id="tr_<?=$payments['pay_id']?>" >
                      <td><?=$count++;?></td>
                      
                      <td><?=$payments["payment_Title"]?></td>
                      
                      <td><?=$payments["payment_detail"]?></td>
                      

                    <td>
                     <?php

                      if ($payments['isactive'] == 1) {
                        echo '<span id="status_'.$payments['pay_id'].'" class="badge badge-success">Active</span>
                        <input type="checkbox" data-id="'.$payments['pay_id'].'" class="js-switch" checked />';
                        } 
                        else echo '<span id="status_'.$payments['pay_id'].'"class="badge badge-danger">In Active</span>
                        <input type="checkbox" data-id="'.$payments['pay_id'].'" class="js-switch" />';
                      
                    ?>
                    
                    </td>

                     <td>
                            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-fw fa-cog"></i>
                            </a>
                          <div class="dropdown-menu" aria-labelledby="optionDropdown">
                          <?php 
                            echo '<a class="dropdown-item" href="editpayments.php?id='.$payments['pay_id'].'">Edit</a>';
                            echo '<a class="dropdown-item" onclick="delete_('.$payments['pay_id'].')" >Delete</a>';
                                
                          ?>
                        </div>
                      </td>
   </tr>
   <?php } ?>      

   </tbody>
</table>

</div>

        <script type="text/javascript" src="js/payments/payments.js"></script>


      </div>
      <!-- /.container-fluid -->

         <div id="deletemodal"></div>
         
         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>
