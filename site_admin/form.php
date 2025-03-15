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
          <li class="breadcrumb-item active">Form List</li>
        </ol>

        <!-- Page Content -->
                <h1 class="page-header">
                Form List 
                <a href="addform.php" style="float:right;color: #fff" class="btn btn-danger btn-md"><i class="fa fa-globe">&nbsp;</i>Add New Form</a>
            </h1>

        <hr>

        <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Form Name</th>
                    <th>Form code</th>
                    <th>Form Data</th>
                    <th>Form Date</th>
                    <th>Option</th>
                    <th>Status</th>
                   
                  </tr>
                </thead>
                <tbody>
                <?php 
                $forms = return_multiple_rows("Select * from form_template ");
                foreach($forms as $forms) {
                  static $count =1;
                 ?> 
                  <tr id="tr_<?=$forms['form_id']?>" >
                      <td><?=$count++;?></td>
                      
                      <td><?=$forms["form_name"]?></td>
                      <td><?=$forms["form_code"]?></td>
                      <td><?=$forms["form_data"]?></td>
                      <td><?=$forms["create_date"]?></td>
                      

                    <td>
                     <?php

                      if ($forms['isactive'] == 1) {
                        echo '<span id="status_'.$forms['form_id'].'" class="badge badge-success">Active</span>
                        <input type="checkbox" data-id="'.$forms['form_id'].'" class="js-switch" checked />';
                        } 
                        else echo '<span id="status_'.$forms['form_id'].'"class="badge badge-danger">In Active</span>
                        <input type="checkbox" data-id="'.$forms['form_id'].'" class="js-switch" />';
                      
                    ?>
                    
                    </td>

                     <td>
                            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-fw fa-cog"></i>
                            </a>
                          <div class="dropdown-menu" aria-labelledby="optionDropdown">
                          <?php 
                            echo '<a class="dropdown-item" href="editform.php?id='.$forms['form_id'].'">Edit</a>';
                            echo '<a class="dropdown-item" onclick="delete_('.$forms['form_id'].')" >Delete</a>';
                                
                          ?>
                        </div>
                      </td>
   </tr>
   <?php } ?>      

   </tbody>
</table>

</div>

        <script type="text/javascript" src="js/form/form.js"></script>


      </div>
      <!-- /.container-fluid -->

         <div id="deletemodal"></div>
         
         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>
