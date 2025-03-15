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
          <li class="breadcrumb-item active">document List</li>
        </ol>

        <!-- Page Content -->
                <h1 class="page-header">
                Document List 
                <a href="adddocuments.php" style="float:right;color: #fff" class="btn btn-danger btn-md"><i class="fa fa-globe">&nbsp;</i>Add New document</a>
            </h1>

        <hr>

        <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>document Title</th>
                    <th>Template</th>
                    <th>Option</th>
                    <th>Status</th>
                   
                  </tr>
                </thead>
                <tbody>
                <?php 
                $documents = return_multiple_rows("Select * from documents $where_gc Order by document_Title ASC ");
                foreach($documents as $documents) {
                  static $count =1;
                 ?> 
                  <tr id="tr_<?=$documents['docu_id']?>" >
                      <td><?=$count++;?></td>
                      
                      <td><?=$documents["document_Title"]?></td>
                      <td><?=$documents["document_page"]?></td>
                      
                    <td>
                     <?php

                      if ($documents['isactive'] == 1) {
                        echo '<span id="status_'.$documents['docu_id'].'" class="badge badge-success">Active</span>
                        <input type="checkbox" data-id="'.$documents['docu_id'].'" class="js-switch" checked />';
                        } 
                        else echo '<span id="status_'.$documents['docu_id'].'"class="badge badge-danger">In Active</span>
                        <input type="checkbox" data-id="'.$documents['docu_id'].'" class="js-switch" />';
                      
                    ?>
                    
                    </td>

                     <td>
                            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-fw fa-cog"></i>
                            </a>
                              <div class="dropdown-menu" aria-labelledby="optionDropdown">
                              <?php 
                                echo '<a class="dropdown-item" href="'.BASE_URL.'documets.php?document_id='.encrypt_($documents['docu_id']).'" target="_blank">View</a>';
                                echo '<a class="dropdown-item" href="editdocuments.php?id='.$documents['docu_id'].'">Edit</a>';
                                echo '<a class="dropdown-item" onclick="delete_('.$documents['docu_id'].')" >Delete</a>';
                                    
                              ?>
                            </div>
                      </td>
   </tr>
   <?php } ?>      

   </tbody>
</table>

</div>

        <script type="text/javascript" src="js/documents/documents.js"></script>


      </div>
      <!-- /.container-fluid -->

         <div id="deletemodal"></div>
         
         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php include 'includes/footer.php';?>
