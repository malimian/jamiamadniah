<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = ['<link href="css/dashboard/dashboard_admin.css" rel="stylesheet" type="text/css">'];

AdminHeader(
    "dashboard Admin", 
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
          <li class="breadcrumb-item active">Export Database</li>
        </ol>

        <?php

           if(isset($_POST['dump'])){
                       $world_dumper = Shuttle_Dumper::create(array(
                      'host' =>       $servername,
                      'username' =>   $username,
                      'password' =>   $password,
                      'db_name' =>    $dbname,
                  ));

                  $world_dumper->dump(realpath(__DIR__ . '/..').'\site_admin\db-dump/'.date("d-M-Y")." - ".$dbname.'.sql'); 
            }
             

            if(isset($_POST['migrate'])){
                  $dbname = $_POST['dbname'];

                  echo "Migrating $dbname Please Wait ....</br>";

                  if(file_exists(realpath(__DIR__ . '/..').'/site_admin/db-dump/'.$dbname)){

                  $data = file_get_contents(realpath(__DIR__ . '/..').'/site_admin/db-dump/'.$dbname);  

                   $statements = parseScript($data);

                   //convert to array
                    $commands = explode(";", $statements);

                    //run commands
                    $total = $success = 0;
                    foreach($commands as $command){
                        
                        if(trim($command)){
                           
                           if ($conn->query(escape($command)) === TRUE) {
                              echo "DATA MIGRATING SUCCESSFULLY</br>";
                            } else {
                              echo "Error: " . $data . "<br>" . $conn->error;
                            }

                        }
                    }

                             

                      }
            }


function startsWith($haystack, $needle){
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function parseScript($script) {

     //delete comments
    $lines = explode(PHP_EOL,$script);
    $commands = '';
    foreach($lines as $line){
        $line = trim($line);
        if( $line && !startsWith($line,'--') && !startsWith($line,'/*!') && !startsWith($line,'//') ){
            $commands .= $line;
        }
    }

  return $commands;

}


        ?> 
        <div class="container">
        <p>The Database would be in exported in  <?php echo realpath(__DIR__ . '/..');?>/site_admin/db-dump/</p>
          <form class="form form-group" action="" method="POST">
            <button class="form-group btn btn-primary btn-md" name="dump">EXPORT DATABASE</button>
          </form>        
       
      <form  class="form form-group" action="" method="POST">
            <select class="form-group form-control" name="dbname">
              <?php

                if ($handle = opendir(realpath(__DIR__ . '/..').'/site_admin/db-dump')) {

                    while (false !== ($entry = readdir($handle))) {

                        if ($entry != "." && $entry != "..") {
                            echo "<option>".$entry."</option>";
                        }
                    }
                    closedir($handle);
                }
               ?>

            </select>

        <button class="form-group btn btn-danger btn-sm" name="migrate">
            MIGRATE DATABASE TO LIVE SERVER</button>
      </form>

       <div class="row">
            <a href="file_manger.php?p=db-dump">Download Database</a>
          </div>
        
      </div>
      <!-- /.container-fluid -->

         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php //include 'modals.php';?>
 <?php include 'includes/footer.php';?>
