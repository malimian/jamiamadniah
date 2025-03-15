<?php include 'includes/header.php';

$template = "";
$category = "";
$page_link = "";

if(isset($_GET['temp'])){
  
  if(!empty($_GET['temp'])){
    
    $temp_id = $_GET['temp'];
    $template = " and pages.template_id = $temp_id ";
    $page_link .="&temp=".$temp_id;
  
  }
}


if(isset($_GET['cat'])){
  
  if(!empty($_GET['cat'])){
    
    $cat_id = $_GET['cat'];
    $category = " and pages.catid = $cat_id ";
    $page_link .="&cat=".$cat_id;
  
  }
}

?>

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
          <li class="breadcrumb-item active">List Of Pages</li>
        </ol>

        <!-- Page Content -->
              <h1 class="page-header">
            List of Pages
                <a href="addpage.php?<?php echo $page_link;?>" style="float:right;color: #fff" class="btn btn-danger btn-md"><i class="fa fa-globe">&nbsp;</i>Add Page</a>
            </h1>

        <hr>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-globe"></i>
            Pages</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No#</th>
                    <th>Category</th>
                    <th>Page Title</th>
                    <th>Page Sequence</th>
                    <th>Status</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $Pages = return_multiple_rows("Select * , pages.isactive as pages_isactive from pages LEFT Join category On pages.catid  =  category.catid Where pages.soft_delete = 0 AND category.soft_delete = 0 $template $category Order by pages.catid , pages_sequence ASC");
                foreach($Pages as $page) {
                  static $count =1;
                 ?> 
                  <tr id="tr_<?=$page['pid']?>">
                    <td><?=$count++;?></td>
                    <td><?=$page["catname"]?></td>
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
                              echo '<a class="dropdown-item" href="editpage.php?id='.$page['pid'].'">Edit</a>';
                              echo '<a class="dropdown-item" href="copypage.php?id='.$page['pid'].'">Copy Page</a>';
                              echo '<a class="dropdown-item" onclick="delete_('.$page['pid'].')" >Delete</a>';
                              echo '<a class="dropdown-item" target="_blank" href="'.BASE_URL.$page['page_url'].'">View</a>';
                              echo ' <a class="dropdown-item" onclick="change_seq( '.$page["pid"].', '.$page["pages_sequence"].')" >Edit Sequence</a>';
                              if($page['template_id'] == 3)
                                echo '<a class="dropdown-item" href="comments.php?page='.$page['page_url'].'">Comments</a>';
                              
                            ?>
                        </div>
                      </td>
   </tr>
   <?php } ?>      

   </tbody>
</table>

</div>

  <script type="text/javascript" src="js/page/pages.js"></script>

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
