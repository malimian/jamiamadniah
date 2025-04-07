<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

AdminHeader(
    "Gallery", 
    "", 
    $extra_libs,
    null,
    '

    '
);

?>

<body id="page-top">

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
          <li class="breadcrumb-item active">Comments</li>
        </ol>

        <!-- Page Content -->
        <div id="comments_">
            <div class="atpage"></div>
            <div id="HCB_comment_box">Loading Comments...</div>  
        </div>
        
        <script type="text/javascript" src="js/comments/comments.js"></script>

        <script type="text/javascript" id="hcb"> 
              var pages = <?php
                echo json_encode(return_multiple_rows("Select page_url from pages $where_gc and template_id= 3 "));
              ?>;

                var COMMENT_API = "<?php echo COMMENT_API;?>";
              
                show_comments("<?php echo BASE_URL;?><?php echo $_GET['page']; ?>");

       </script>

        <div id="all_comments"></div>
       <style type="text/css">
         #HCB_comment_form_box,.hcb-reply{display: none;}
       </style>


        
      </div>
      <!-- /.container-fluid -->

         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php //include 'modals.php';?>
 <?php include 'includes/footer.php';?>
