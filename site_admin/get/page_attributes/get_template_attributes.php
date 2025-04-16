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
                $html .= '<div class="col-md-4">';
                $html .= '<div class="form-check">';
                $html .= '<input class="form-check-input" type="checkbox" name="attributes[]" value="' . $attribute['id'] . '" id="attribute_' . $attribute['id'] . '" checked>';
                $html .= '<label class="form-check-label" for="attribute_' . $attribute['id'] . '">';
                $html .= $attribute['attribute_label'] . ' (' . $attribute['attribute_name'] . ')';
                $html .= '</label>';
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