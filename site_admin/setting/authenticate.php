<?php
if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION['user'])){
	$page = (pathinfo($_SERVER['PHP_SELF']));
	$page = $page['basename'];

	$all_modules_that_are_not_allowed = $_SESSION['user']['unautorize'];
	foreach ($all_modules_that_are_not_allowed as $not_allowed_module) {
		if($page == $not_allowed_module['url']){
 		exit("<script>location.href='".ADMIN_URL."get/user/logout.php?logout'</script>");
		}	
	}


		// Check if current action is allowed
		$action = isset($_GET['action']) ? strtolower($_GET['action']) : '';

		// Instead of separate variables, you can use:
		// Get module actions from session
		$module_actions = isset($_SESSION['user']['module_actions']) ? $_SESSION['user']['module_actions'] : [];
	

			$is_action_allowed = false;

			if ($action) {
			    $is_action_allowed = is_action_allowed($action, $module_actions);
			    
			    // If a specific action is requested but not allowed, you might want to handle it
			    if (!$is_action_allowed) {
			        $_SESSION['error'] = "You don't have permission to perform this action";
			 		exit("<script>location.href='".ADMIN_URL."get/user/logout.php?logout'</script>");
			    }
			}

		    // $action_ids = array_column($module_actions, 'og_moduleactions_id');

			// $has_view = in_array(1, $action_ids);
			// $has_add = in_array(2, $action_ids);
			// $has_edit = in_array(3, $action_ids);
			// $has_delete = in_array(4, $action_ids);
			// $has_status = in_array(5, $action_ids);

			$GLOBALS['action_ids'] = array_column($module_actions, 'og_moduleactions_id');
			$GLOBALS['has_view'] = in_array(1, $GLOBALS['action_ids']);
			$GLOBALS['has_add'] = in_array(2, $GLOBALS['action_ids']);
			$GLOBALS['has_edit'] = in_array(3, $GLOBALS['action_ids']);
			$GLOBALS['has_delete'] = in_array(4, $GLOBALS['action_ids']);
			$GLOBALS['has_status'] = in_array(5, $GLOBALS['action_ids']);

} else {
 		exit("<script>location.href='".ADMIN_URL."get/user/logout.php?logout'</script>");
}



function is_action_allowed($action, $module_actions) {
    $action_map = [
        'add' => 2,    // og_moduleactions_id for Add
        'edit' => 3,   // og_moduleactions_id for Edit
        'view' => 1,   // og_moduleactions_id for View
        'delete' => 4, // og_moduleactions_id for Delete
        'status' => 5  // og_moduleactions_id for Status
    ];
    
    if (!isset($action_map[$action])) {
        return false; // Unknown action type
    }
    
    $required_id = $action_map[$action];
    $action_ids = array_column($module_actions, 'og_moduleactions_id');
    
    return in_array($required_id, $action_ids);
}

?>