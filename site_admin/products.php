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
            <a href="domain.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">List Of Products</li>
        </ol>

        <!-- Page Content -->
              <h1 class="page-header">
            List of Products
                <a href="addproduct.php" style="float:right;color: #fff" class="btn btn-danger btn-md"><i class="fa fa-globe">&nbsp;</i>Add Product</a>
            </h1>

        <hr>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-globe"></i>
            Products</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No#</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Sequence</th>
                    <th>Status</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $Pages = return_multiple_rows("Select * , products.isactive as pages_isactive from products LEFT Join category_product On products.catid  =  category_product.catid Where products.soft_delete = 0 AND  category_product.soft_delete = 0 Order by products.catid , pages_sequence ASC");
                foreach($Pages as $page) {
                  static $count =1;
                 ?> 
                  <tr id="tr_<?=$page['pid']?>">
                    <td><?=$count++;?></td>
                    <td><?=$page["catname"]?></td>
                    <td><img src="<?=BASE_URL.ABSOLUTE_IMAGEPATH.$page["featured_image"]?>" class="img-fluid" /></td>
                    <td><?=$page["page_title"]?></td>
                    <td id="seq_<?php echo  $page["pid"];?>"><?php echo $page["pages_sequence"];?></td>
                    <td>
                    <?php

                      if ($page['pages_isactive'] == 1) {
                        echo '<span id="status_'.$page['pid'].'" class="badge badge-success">Active</span>
                        <input type="checkbox" data-id="'.$page['pid'].'" class="js-switch" checked />';
                        } 
                        else echo '<span id="status_'.$page['pid'].'"class="badge badge-danger">In Active</span>
                        <input type="checkbox" data-id="'.$page['pid'].'" class="js-switch" />';
                      
                    ?>
                    
                    
                    </td>


                     <td>
                            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-fw fa-cog"></i>
                            </a>
                          <div class="dropdown-menu" aria-labelledby="optionDropdown">
                <?php 
                  echo '<a class="dropdown-item" href="editproduct.php?id='.$page['pid'].'">Edit</a>';
                  echo '<a class="dropdown-item" onclick="delete_('.$page['pid'].')" >Delete</a>';
                  echo '<a class="dropdown-item" target="_blank" href="'.BASE_URL.$page['page_url'].'">View</a>';
                    echo ' <a class="dropdown-item" onclick="change_seq( '.$page["pid"].', '.$page["pages_sequence"].')" >Edit Sequence</a>';
                ?>
                        </div>
                      </td>
   </tr>
   <?php } ?>      

   </tbody>
</table>

</div>

        <script type="text/javascript" src="js/product/products.js"></script>

    </div>
      <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
            </div>
          </div>
        </div>
        <!-- DataTables Example -->
      </div>
      <!-- /.container-fluid -->
      
          <div id="deletemodal"></div>
         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>
