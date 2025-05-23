<?php
require_once '../../admin_connect.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    $tab_id = intval(clean($_POST['tab_id']));
    $template_id = intval(clean($_POST['template_id']));

    // First check if tab has any attributes
    $check_sql = "SELECT COUNT(*) as count FROM page_attributes WHERE tab_id = $tab_id AND template_id = $template_id";
    $check_result = return_single_row($check_sql);

    if ($check_result && $check_result['count'] > 0) {
        throw new Exception("Cannot delete tab that has attributes assigned to it. Delete The attributes first");
    }

    // Perform delete
    $sql = "DELETE FROM tab WHERE id = $tab_id AND template_id = $template_id";
    $affected_rows = Delete($sql);

    if ($affected_rows !== false) {
        $response['success'] = true;
        $response['message'] = "Tab deleted successfully";
    } else {
        throw new Exception("Failed to delete tab");
    }

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
