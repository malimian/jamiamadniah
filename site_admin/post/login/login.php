<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once ('../../../connect.php');


if (isset($_POST['login'])) {

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
$password =  $_POST['password'];

  
if (!empty($username) && !empty($password)) {

  $password = md5_($password);

    //Regular User Dont Enter
    $user = return_multiple_rows(softdelete_check("Select * from loginuser where  ( emailaddress = '" . $username . "' OR username= '" . $username . "' )  AND password = '" . $password . "' AND isactive = 1 " , 'loginuser' )." Limit 0,1");

  
    if(isset($user[0])){
    
    $_SESSION['user']= $user[0];
    $uid = $_SESSION['user']['id'];
    unset($_SESSION['user']['password']);
    
        // Return Dashboard
    $dashboard = return_single_ans(softdelete_check("SELECT url from usertype_dashboard INNER JOIN loginuser ON usertype_dashboard.og_usertype_id = loginuser.usertypeid INNER JOIN og_dashboard ON usertype_dashboard.og_dashboard_id = og_dashboard.id WHERE loginuser.id = $uid " , 'usertype_dashboard,loginuser,og_dashboard')." LIMIT 0,1");

    $_SESSION['user']['dashboard'] = $dashboard;
    

    // GET Assigned Modules and SET in user Session
        $og_moduleactionss = return_multiple_rows(softdelete_check("SELECT title , og_moduleactions_id from og_moduleactions INNER JOIN user_rights ON og_moduleactions.id = user_rights.og_moduleactions_id Where user_rights.uid = ".$uid , 'og_moduleactions,user_rights'));

        $_SESSION['user']['module_actions'] = $og_moduleactionss;


      // All Moules that are not allowed
          $sql ="SELECT DISTINCT url FROM og_module 
          LEFT JOIN 
          user_module On user_module.og_module_id = og_module.id 
          WHERE og_module.id NOT IN (SELECT user_module.og_module_id FROM user_module Where uid = ".$uid.")";
          $all_modules_that_are_not_allowed = return_multiple_rows($sql);

          //Not allowed Dashboards

          $sql ='SELECT url from og_dashboard WHERE url != "'.$dashboard.'"';
           $all_dashboard_that_are_not_allowed = return_multiple_rows($sql);

          $all_modules_dashboard_are_not_allowed = array_merge(
            $all_modules_that_are_not_allowed ,$all_dashboard_that_are_not_allowed 
          );
         
          $_SESSION['user']['unautorize'] = $all_modules_dashboard_are_not_allowed;

          //Side Bar Modules
          $sql = "SELECT url , title , iconclass , og_module.* FROM loginuser INNER JOIN user_module ON loginuser.id = user_module.uid INNER JOIN og_module ON user_module.og_module_id = og_module.id Where 
          og_module.showInNavBar = 1 AND
          loginuser.id = ".$uid." and og_module.soft_delete = 0  and og_module.isactive = 1 and loginuser.soft_delete = 0  and loginuser.isactive = 1 Order by hierarchy ";

          $og_sidebar_modules = return_multiple_rows($sql);

      $_SESSION['user']['sidebar_modules'] = $og_sidebar_modules;

        $ip = escape( $_SERVER['REMOTE_ADDR']);
        
        // Update last access
        Update("UPDATE loginuser SET lastaccessip = '$ip', lastaccess = NOW() WHERE id = $uid ");

        // 2. Record login activity
        $activity_query = "INSERT INTO activity_log 
                          (user_id, action, entity_type, ip_address, details) 
                          VALUES 
                          ($uid, 'login', 'user', '$ip', 'User logged in')";

        Insert( $activity_query);


       echo $dashboard;

    }

    else exit("0");
  }
}



?>