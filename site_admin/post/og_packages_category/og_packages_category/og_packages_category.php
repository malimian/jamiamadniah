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
          <li class="breadcrumb-item active">Packages Catagory</li>
        </ol>

        <!-- Page Content -->
                <h1 class="page-header">
               List Of Packages Catagory
                <a href="add_og_packages_category.php" style="float:right;color: #fff" class="btn btn-danger btn-md"><i class="fa fa-globe">&nbsp;</i>Add Packages Catagory</a>
            </h1>

        <hr>

        <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Short Code</th>  
                    <th>Status</th>
                    <th>Option</th>
                    
                   
                  </tr>
                </thead>
                <tbody>
                <?php 
                $og_packages_category = return_multiple_rows("Select * from og_packages_category $where_gc Order by og_all_packages_id ASC ");
                foreach($og_packages_category as $og_packages_category) {
                  static $count =1;
                 ?> 
                  <tr id="tr_<?=$og_packages_category['og_all_packages_id']?>" >
                      <td><?=$count++;?></td>
                      
                      <td><?=$og_packages_category["title"]?></td>
                      <td><?=$og_packages_category["short_code"]?></td>
                     <td>
                    <?php

                   

                      if ($og_packages_category['isactive'] == 1) {
                        echo '<span id="status_'.$og_packages_category['og_all_packages_id'].'" class="badge badge-success">Active</span>
                        <input type="checkbox" data-id="'.$og_packages_category['og_all_packages_id'].'" class="js-switch" checked />';
                        } 
                        else echo '<span id="status_'.$og_packages_category['og_all_packages_id'].'"class="badge badge-danger">In Active</span>
                        <input type="checkbox" data-id="'.$og_packages_category['og_all_packages_id'].'" class="js-switch" />';
                      
                    ?>
                    </td> 

                     <td>
                            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-fw fa-cog"></i>
                            </a>
                          <div class="dropdown-menu" aria-labelledby="optionDropdown">
                          <?php 
                            echo '<a class="dropdown-item" href="edit_og_packages_category.php?id='.$og_packages_category['og_all_packages_id'].'">Edit</a>';
                            echo '<a class="dropdown-item" onclick="delete_('.$og_packages_category['og_all_packages_id'].')" >Delete</a>';
                                
                          ?>
                        </div>
                      </td>
   </tr>
   <?php } ?>      

   </tbody>
</table>

</div>

        <script type="text/javascript" src="js/og_packages_category/og_packages_category.js"></script>


      </div>
      <!-- /.container-fluid -->

         <div id="deletemodal"></div>
         
         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>
