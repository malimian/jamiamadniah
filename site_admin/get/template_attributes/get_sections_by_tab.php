<?php
include '../../admin_connect.php';

$tab_id = isset($_GET['tab_id']) ? intval($_GET['tab_id']) : 0;

// Fetch sections for the selected tab
$sections_sql = "SELECT DISTINCT section_name 
                 FROM page_attributes 
                 WHERE tab_id = $tab_id 
                 AND section_name IS NOT NULL 
                 AND section_name != ''
                 ORDER BY section_name";

$sections = return_multiple_rows($sections_sql);

header('Content-Type: application/json');
echo json_encode($sections);