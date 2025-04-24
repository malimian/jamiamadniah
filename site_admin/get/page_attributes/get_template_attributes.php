<?php
include '../../admin_connect.php';  // Adjust the path if needed

if (isset($_POST['template_id'])) {
    $template_id = intval($_POST['template_id']);

    // Fetch attributes for the selected template
    $attributes_sql = "SELECT * FROM page_attributes WHERE template_id = $template_id AND isactive = 1 AND soft_delete = 0 ORDER BY tab_group ASC, sort_order ASC";
    $attributes_result = return_multiple_rows($attributes_sql);
    $attributes = [];
    if($attributes_result){
        foreach ($attributes_result as $row) {
            $attributes[$row['tab_group']][] = $row;
        }
    }

    if (!empty($attributes)) {
        $html = '<label>Assign Attributes:</label>';
        foreach ($attributes as $tab_group => $group_attributes) {
            $html .= '<h5>' . ucfirst($tab_group) . '</h5>';
            $html .= '<div class="row">';
            foreach ($group_attributes as $attribute) {
                $html .= '<div class="col-md-4 mb-3">';
                $html .= '<div class="d-flex justify-content-between align-items-center p-2 border rounded">';
                $html .= '<span>' . $attribute['attribute_label'] . ' (' . $attribute['attribute_name'] . ')</span>';
                $html .= '<div class="btn-group btn-group-sm">';  // Added btn-group-sm for smaller buttons
                $html .= '<button type="button" class="btn btn-outline-primary edit-attribute" data-id="'.$attribute['id'].'" data-toggle="modal" data-target="#editAttributeModal" title="Edit">';
                $html .= '<i class="fas fa-pencil-alt"></i>';  // Changed to pencil icon
                $html .= '</button>';
                $html .= '<button type="button" class="btn btn-outline-danger delete-attribute" data-id="'.$attribute['id'].'" title="Delete">';
                $html .= '<i class="fas fa-trash-alt"></i>';  // Changed to trash-alt icon
                $html .= '</button>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
            }
            $html .= '</div><hr>';
        }
        echo $html;
    } else {
        echo '<label>Assign Attributes:</label><div class="alert alert-info">No attributes are assigned to this template.</div>';
    }
} else {
    echo '<label>Assign Attributes:</label><div class="alert alert-danger">Invalid request.</div>';
}
?>