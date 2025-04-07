<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

AdminHeader(
    "dashboard Admin", 
    "", 
    $extra_libs,
    null,
    '

    '
);

?>

<style>
    .clearclick {
    height: 37px;
    padding: 7px 6px;
    margin-left: 5px;
}
.Orderclickss {
    margin-top: 6px;
}
.orderdate {
    margin-right: -15px;
}
.caldate {
    font-size: 25px;
    margin-top: 6px;
    margin-right: -11px;
}
</style>

<body id="page-top">
  
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
          <li class="breadcrumb-item active"> Orders List </li>
        </ol>

        <!-- Page Content -->
                <h1 class="page-header">
              Orders List 
                <a href="addorder.php" style="float:right;color: #fff" class="btn btn-danger btn-md Orderclickss"><i class="fa fa-globe">&nbsp;</i>Add Order</a>
            </h1>
         
        <div class="container-fluid" style="margin-bottom: 6px;">
          <div class="row">
              <div class="col-sm-12">
                <div class="box-header with-border">
                  <div class="pull-right">
                    <form method="POST" class="form-inline" id="payForm">
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar caldate"></i>
                        </div>
                        <div class="orderdate">
                            <a href="order.php" style="float:right;color: #fff;background:#007bff;border-color:#007bff;" class="btn btn-info btn-sm clearclick"><i class="fa fa-eraser">&nbsp;</i>Clear</a>
                            <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo date("m/d/Y");?> - <?php echo date("m/d/Y");?>">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                
              </div>
             </div>
        </div>


        <div class="row">

<?php
    
      $date_param = "";
      
      if(isset($_GET['start_date']) && isset($_GET['end_date'])){
          
          $startDate = $_GET['start_date'];
          $endDate =   $_GET['end_date'];
          
          $date_param = " and DATE(createdon) BETWEEN '$startDate' AND '$endDate' ";
      }

       $total_payment_sum_pkr = return_single_ans("SELECT SUM(`total_price`) FROM order_dh Where `isactive` = 1 and soft_delete = 0 and currency = 'PKR' $date_param ");
       $active_payment_sum_pkr = return_single_ans("SELECT SUM(`total_price`) FROM order_dh Where `isactive` = 1 and soft_delete = 0 and payment_status = 2 and currency = 'PKR' $date_param ");
       $onhold_payment_sum_pkr = return_single_ans("SELECT SUM(`total_price`) FROM order_dh Where `isactive` = 1 and soft_delete = 0  and payment_status = 0 and currency = 'PKR' $date_param ");


       $total_payment_sum_usd = return_single_ans("SELECT SUM(`total_price`) FROM order_dh Where `isactive` = 1 and soft_delete = 0 and currency = 'USD' $date_param ");
       $active_payment_sum_usd = return_single_ans("SELECT SUM(`total_price`) FROM order_dh Where `isactive` = 1 and soft_delete = 0 and payment_status = 2 and currency = 'USD' $date_param ");
       $onhold_payment_sum_usd = return_single_ans("SELECT SUM(`total_price`) FROM order_dh Where `isactive` = 1 and soft_delete = 0  and payment_status = 0 and currency = 'USD' $date_param ");

    
        $total_payment_sum = $total_payment_sum_pkr +   ($total_payment_sum_usd /  USD_RATE);
        $active_payment_sum = $active_payment_sum_pkr + ($active_payment_sum_usd / USD_RATE);
        $onhold_payment_sum = $onhold_payment_sum_pkr + ($onhold_payment_sum_usd / USD_RATE);
        
        // die;
        

?>

        <div class="col-xl-4 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-history"></i>
            </div>
            <div class="mr-5">All Orders</div>
          </div>
          <a class="card-footer text-white clearfix z-1" href="#">
                <span class="float-left"><?php echo number_format(round($total_payment_sum , 1 ));?> PKR</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
        </div>
        
        <div class="col-xl-4 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-check-circle"></i>
            </div>
            <div class="mr-5">Payment Received</div>
          </div>
          <a class="card-footer text-white clearfix z-1" href="#">
                <span class="float-left"><?php echo number_format(round($active_payment_sum , 1 ));?> PKR</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
        </div>
        
        <div class="col-xl-4 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-calendar-week"></i>
            </div>

            <div class="mr-5">Pending Orders</div>
          </div>
          <a class="card-footer text-white clearfix  z-1" href="#">
                <span class="float-left"><?php echo number_format(round($onhold_payment_sum , 1 ));?> PKR</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
        </div>
        
        </div>

        <hr>

        <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Client Contact</th>
                    <th>Order</th>
                    <th>Date</th>
                    <th>Total Price</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                
                $order;
                if($_SESSION['user']['id'] == 1){
                $order = return_multiple_rows("Select * ,  DATE(createdon) as createdon_date from order_dh $where_gc $date_param Order by createdon DESC ");
                }else{
                  $order = return_multiple_rows("Select * ,  DATE(createdon) as createdon_date from order_dh $where_gc $date_param and isShown = 1 Order by createdon DESC ");
                }
                
                
                
                foreach($order as $order_dh) {
                  static $count =1;
                 ?> 
                    <tr id="tr_<?=$order_dh['order_id']?>" >
                      <td><?=$count++;?></td>
                      <td><?=$order_dh["username_dh"]?></td>
                      <td><?php echo str_replace(',',' ',$order_dh['useremail_dh']);?></td>
                      <td><?=$order_dh["userphoneno_dh"]?></td>
                      <td><?=$order_dh["order_title"]?></td>
                      <td><?=$order_dh["createdon_date"]?></td>
                      <td><?=$order_dh["total_price"]?> <?=$order_dh["currency"]?></td>
                      <td>
                           <?php 
                            if($order_dh['payment_status'] == 0)
                                
                                echo '<div class="alert alert-warning" role="alert">
                                        Pending
                                    </div>';

                            if($order_dh['payment_status'] == 1)
                                
                                echo '<div class="alert alert-warning" role="alert">
                                        Pending
                                    </div>';

                                if($order_dh['payment_status'] == 2)
                                
                                echo '<div class="alert alert-success" role="alert">
                                         Cleared
                                    </div>';

                                if($order_dh['payment_status'] == 3)
                                
                                echo '<div class="alert alert-danger" role="alert">
                                         Declined
                                    </div>';
                            
            ?>
                      </td>
                    <td>
                      <?php

                      if ($order_dh['isactive'] == 1) {
                        echo '<span id="status_'.$order_dh['order_id'].'" class="badge badge-success">Active</span>
                        <input type="checkbox" data-id="'.$order_dh['order_id'].'" class="js-switch" checked />';
                        } 
                        else echo '<span id="status_'.$order_dh['order_id'].'"class="badge badge-danger">In Active</span>
                        <input type="checkbox" data-id="'.$order_dh['order_id'].'" class="js-switch" />';
                      
                    ?>

                    </td>
                        
                     <td>
                            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-fw fa-cog"></i>
                            </a>
                            
                          <div class="dropdown-menu" aria-labelledby="optionDropdown">
                                <a class="dropdown-item" onclick="send_email('<?=$order_dh["useremail_dh"]?>' , 'Order No#<?=$order_dh["order_id"]?> Confirmation' , 'Dear <?=$order_dh["username_dh"]?> , <br /> You have placed Order No# <?=$order_dh["order_id"]?> <br /> Kindly Check Invoice Receipt <a href=\'https://hatinco.com/invoice.php?order_id=<?=encrypt_($order_dh["order_id"])?>\'>https://hatinco.com/invoice.php?order_id=<?=encrypt_($order_dh["order_id"])?></a>' , 2)" >Email ORDER CREATED</a>
                                <a class="dropdown-item" onclick="send_email('<?=$order_dh["useremail_dh"]?>' , 'Order No#<?=$order_dh["order_id"]?> Payment Confirmation' , 'Dear <?=$order_dh["username_dh"]?> , <br /> Your Payment for the Order No# <?=$order_dh["order_id"]?> have been confirmed <br /> Kindly Check Invoice Receipt <a href=\'https://hatinco.com/invoice.php?order_id=<?=encrypt_($order_dh["order_id"])?>\'>https://hatinco.com/invoice.php?order_id=<?=encrypt_($order_dh["order_id"])?></a>' , 2 )" >Email PAYMENT Confirmation</a>
                                <a class="dropdown-item" onclick="send_email('<?=$order_dh["useremail_dh"]?>' , 'Order No#<?=$order_dh["order_id"]?> Payment Reminder' , 'Dear <?=$order_dh["username_dh"]?> , <br /> Your Payment is due for the Order No# <?=$order_dh["order_id"]?>  <br /> If you need any further assistance in order to pay this invoice, please let us know .<br /> Kindly Check Invoice Receipt <a href=\'https://hatinco.com/invoice.php?order_id=<?=encrypt_($order_dh["order_id"])?>\'>https://hatinco.com/invoice.php?order_id=<?=encrypt_($order_dh["order_id"])?></a>' , 2 )" >Email PAYMENT REMINDER</a>
                          <?php 
                           echo '<a class="dropdown-item" href="editorder.php?id='.$order_dh['order_id'].'">Edit</a>';
                           echo '<a class="dropdown-item" href="copyorder.php?id='.$order_dh['order_id'].'">Copy</a>';
                           echo '<a class="dropdown-item" onclick="delete_('.$order_dh['order_id'].')" >Delete</a>';
                           echo '<a class="dropdown-item" href="'.BASE_URL.'invoice.php?order_id='.encrypt_($order_dh['order_id']).'" target="_blank" >Invoice</a>';
                           echo '<a class="dropdown-item" href="'.BASE_URL.'invoice.php?order_id='.encrypt_($order_dh['order_id']).'&download" target="_blank" >Download Invoice</a>';
                           echo '<a class="dropdown-item" href="'.BASE_URL.'checkout.php?order_id='.encrypt_($order_dh['order_id']).'" target="_blank" >Checkout</a>';
                           echo '<a class="dropdown-item" href="'.BASE_URL.'stripe_payment.php?order_id='.encrypt_($order_dh['order_id']).'" target="_blank" >Stripe</a>';

                          ?>
                        </div>
                      </td>
   </tr>
                  
   <?php } ?>      

   </tbody>
</table>

</div>

<script type="text/javascript" src="js/order/order.js"></script>

<script>

    // $('input[name="date_range"]').daterangepicker();
    
    $(function() {
      $('input[name="date_range"]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
    
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
         
             location.href= 'order.php?start_date='+ start.format('YYYY-MM-DD')+'&end_date='+ end.format('YYYY-MM-DD');
         
      });
    });
    
</script>


      </div>
      <!-- /.container-fluid -->

         <div id="deletemodal"></div>
         
         
         <?php include 'modals/send_email_modal.php';?>
         
         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
 <?php include 'includes/footer.php';?>