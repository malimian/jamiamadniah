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
            <a href="<?php echo $_SESSION['user']['dashboard'];?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Site Template</li>
        </ol>

        <!-- Page Content -->
                <h1 class="page-header">
                List of Site Templates
                <a href="addsite_template.php" style="float:right;color: #fff" class="btn btn-danger btn-md"><i class="fa fa-globe">&nbsp;</i>Add New Template</a>
            </h1>

        <hr>

        <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $site_template = return_multiple_rows("Select * from site_template $where_gc Order by st_id ASC ");
                foreach($site_template as $site_template) {
                  static $count =1;
                 ?> 
                  <tr id="tr_<?=$site_template['st_id']?>" >
                    <td><?=$count++;?></td>
                    <td><?=$site_template["st_name"]?></td>

                    <td>
                 <?php

                      if ($site_template['isactive'] == 1) {
                        echo '<span id="status_'.$site_template['st_id'].'" class="badge badge-success">Active</span>
                        <input type="checkbox" data-id="'.$site_template['st_id'].'" class="js-switch" checked />';
                        } 
                        else echo '<span id="status_'.$site_template['st_id'].'"class="badge badge-danger">In Active</span>
                        <input type="checkbox" data-id="'.$site_template['st_id'].'" class="js-switch" />';
                      
                    ?>
                    
                    
                    </td>

                     <td>
                            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-fw fa-cog"></i>
                            </a>
                          <div class="dropdown-menu" aria-labelledby="optionDropdown">
                          <?php 
                            echo '<a class="dropdown-item" href="editsite_template.php?id='.$site_template['st_id'].'">Edit</a>';
                            echo '<a class="dropdown-item" onclick="delete_('.$site_template['st_id'].')" >Delete</a>';
                                
                          ?>
                        </div>
                      </td>
   </tr>
   <?php } ?>      

   </tbody>
</table>

</div>

        <script type="text/javascript" src="js/site_template/site_template.js"></script>


      </div>
      <!-- /.container-fluid -->

         <div id="deletemodal"></div>
         
         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>
