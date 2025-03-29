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
          <li class="breadcrumb-item active">Blank Page</li>
        </ol>

        <!-- Page Content -->
                <h1 class="page-header">
                List of Menue
                <a href="addmenue.php?action=add" style="float:right;color: #fff" class="btn btn-danger btn-md"><i class="fa fa-globe">&nbsp;</i>Add Menue</a>
            </h1>

        <hr>

        <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No#</th>
                    <th>Category</th>
                    <th>Sequence</th>
                    <th>Shown In NavBar</th>
                    <th>Parent Category</th>
                    <th>Status</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $categories = return_multiple_rows("Select * from category $where_gc Order by cat_sequence ASC ");
                foreach($categories as $category) {
                  static $count =1;
                 ?> 
                  <tr id="tr_<?=$category['catid']?>" >
                    <td><?=$count++;?></td>
                    <td><?=$category["catname"]?></td>
                     <td id="seq_<?php echo  $category["catid"];?>"><?php echo $category["cat_sequence"];?></td>
                     
                      <td>
                     <?php if($category['showInNavBar'] == 0)
                        {
                           echo "No";
                        }
                        else echo "Yes";?>
                     </td>
                     <td><?php
                     
                        $pc = return_single_ans("Select catname from category where catid = ".$category['ParentCategory']." and soft_delete = 0");
                        
                        if($pc == "0" || empty($pc))
                            echo "Parent";
                        else
                        echo $pc;
                     
                     ?></td>
                    <td>
                    <?php

                      if ($category['isactive'] == 1) {
                        echo '<span id="status_'.$category['catid'].'" class="badge badge-success">Active</span>
                        <input type="checkbox" data-id="'.$category['catid'].'" class="js-switch" checked />';
                        } 
                        else echo '<span id="status_'.$category['catid'].'"class="badge badge-danger">In Active</span>
                        <input type="checkbox" data-id="'.$category['catid'].'" class="js-switch" />';
                      
                    ?>
                    
                    
                    </td>

                     <td>
                            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-fw fa-cog"></i>
                            </a>
                          <div class="dropdown-menu" aria-labelledby="optionDropdown">
                          <?php 
                            echo '<a class="dropdown-item" href="editmenue.php?id='.$category['catid'].'&action=edit">Edit</a>';
                            echo '<a class="dropdown-item" onclick="delete_('.$category['catid'].')" >Delete</a>';
                                echo ' <a class="dropdown-item" onclick="change_seq( '.$category["catid"].', '.$category["cat_sequence"].')" >Edit Sequence</a>';
                          ?>
                        </div>
                      </td>
   </tr>
   <?php } ?>      

   </tbody>
</table>

</div>

        <script type="text/javascript" src="js/category/categories.js"></script>


      </div>
      <!-- /.container-fluid -->

         <div id="deletemodal"></div>
         
         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>
