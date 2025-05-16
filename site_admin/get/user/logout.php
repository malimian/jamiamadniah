<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../../../connect.php';

if (isset($_GET['logout'])) {
    // Validate user is logged in before trying to update
    if (isset($_SESSION['user']['id'])) {
        $user_id = intval($_SESSION['user']['id']);
        $ip = escape( $_SERVER['REMOTE_ADDR']);
        
        // Update last access before destroying session
        Update("UPDATE loginuser SET lastaccessip = '$ip', lastaccess = NOW() WHERE id = $user_id");

        // 2. Record logout activity
        $activity_query = "INSERT INTO activity_log 
                          (user_id, action, entity_type, ip_address, details) 
                          VALUES 
                          ($user_id, 'logout', 'user', '$ip', 'User logged out')";

       	Insert( $activity_query);

    }
    
    // Clear all session variables
    $_SESSION = array();
    
    // Destroy the session
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
    

      setcookie('remember_me', '', time() - 3600, '/', '', true, true);

      
    // Redirect to login page
    exit("<script>location.href='".ADMIN_URL."login.php'</script>");
}