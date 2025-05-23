<?php
require_once '../../admin_connect.php';
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    $template_id = intval(clean($_POST['template_id']));
    $tab_name = clean($_POST['tab_name']);
    $sort_order = intval(clean($_POST['sort_order']));
    $tab_id = isset($_POST['tab_id']) ? intval(clean($_POST['tab_id'])) : 0;

    if (empty($tab_name)) {
        throw new Exception("Tab name cannot be empty");
    }

    if ($tab_id > 0) {
        // Update existing tab using your Update() function
        $sql = "UPDATE tab 
                SET tab_name = '" . escape($tab_name) . "', 
                    sort_order = $sort_order 
                WHERE id = $tab_id AND template_id = $template_id";

        $affected_rows = Update($sql);

        if ($affected_rows !== false) {
            $response['success'] = true;
            $response['message'] = 'Tab updated successfully';
        } else {
            throw new Exception("Failed to update tab");
        }

    } else {
        // Insert new tab using your Insert() function
        $sql = "INSERT INTO tab (tab_name, sort_order, template_id) 
                VALUES ('" . escape($tab_name) . "', $sort_order, $template_id)";

        $insert_id = Insert($sql);

        if ($insert_id !== false) {
            $response['success'] = true;
            $response['message'] = 'Tab created successfully';
        } else {
            throw new Exception("Failed to create tab");
        }
    }

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>