<?php
session_start();
require_once 'admin_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=SITE_TITLE?> - Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">


  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

   <!-- Custom style -->
  <link href="css/custom.css" rel="stylesheet">

  <link href="css/loader.css" rel="stylesheet">

  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Switchery -->
  <link rel="stylesheet" href="plugins/dist/switchery.css" />
  <script src="plugins/dist/switchery.js"></script>


  <!-- send data -->
  <script src="js/API/senddata.js"></script>

    <!-- general function -->
  <script src="js/API/general_function.js"></script>

 <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>


  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script> -->
  
  <script src="plugins/ckeditor_4.12.1_standard/ckeditor/ckeditor.js"></script>

    <!-- Data Table JS -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    
     <!-- Data Table CSS -->
    <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">
    
    <!-- Read More -->
    <script src="plugins/readmore/readmore.js"></script>
      <!-- Alert Plugin -->
      <script src="js/plugins/alert/notify.js"></script>

      <!-- Code Plugin -->
      <!--<script src="plugins/editarea/edit_area_full.js"></script>-->

      <!-- Tag Plugin -->
      <link href="plugins/tagify/css/amsify.suggestags.css" rel="stylesheet">
      <script src="plugins/tagify/jquery.amsify.suggestags.js"></script>

    
      <script src="plugins/loading/loading.js"></script>

      <link href="css/modules/upload_image.css" rel="stylesheet">
      
      <link type="text/css" rel="stylesheet" href="css/image-uploader.css">
      <script src="js/plugins/image-uploader.js"></script>
      
      
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    
</head>
