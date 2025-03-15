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
          <li class="breadcrumb-item active">Event Member List</li>
        </ol>

        <!-- Page Content -->
                <h1 class="page-header">
                Member List 
            </h1>

        <hr>

        <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Event</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Address2</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Status</th>
                    <th>Option</th>
                   
                  </tr>
                </thead>
                <tbody>
                <?php 
                $payments = return_multiple_rows("Select * from events $where_gc ");
                foreach($payments as $payments) {
                  static $count =1;
                 ?> 
                  <tr id="tr_<?=$payments['evid']?>" >
                      <td><?=$count++;?></td>
                      <td><?=$payments["event_name"]?></td>
                      <td><?=$payments["f_name"]?></td>
                      <td><?=$payments["l_name"]?></td>
                      <td><?=$payments["email"]?></td>
                      <td><?=$payments["phone"]?></td>
                      <td><?=$payments["address1"]?></td>
                      <td><?=$payments["address2"]?></td>
                      <td><?=$payments["city"]?></td>
                      <td><?=$payments["state"]?></td>
                      <td><?=$payments["zip"]?></td>

                    <td>
                     <?php

                      if ($payments['isactive'] == 1) {
                        echo '<span id="status_'.$payments['evid'].'" class="badge badge-success">Active</span>
                        <input type="checkbox" data-id="'.$payments['evid'].'" class="js-switch" checked />';
                        } 
                        else echo '<span id="status_'.$payments['evid'].'"class="badge badge-danger">In Active</span>
                        <input type="checkbox" data-id="'.$payments['evid'].'" class="js-switch" />';
                      
                    ?>
                    
                    </td>

                     <td>
                            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-fw fa-cog"></i>
                            </a>
                          <div class="dropdown-menu" aria-labelledby="optionDropdown">
                          <?php 
                            echo '<a class="dropdown-item" onclick="delete_('.$payments['evid'].')" >Delete</a>';
                                
                          ?>
                        </div>
                      </td>
   </tr>
   <?php } ?>      

   </tbody>
</table>

</div>

        <!--<script type="text/javascript" src="js/payments/payments.js"></script>-->


      </div>
      <!-- /.container-fluid -->

         <div id="deletemodal"></div>
         
         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>