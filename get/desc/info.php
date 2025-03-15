<?php
include '../../connect.php';

if(isset($_POST['pageid'])){

$content;

$pid = $_POST['pageid'];

$content = return_single_row("Select page_desc from pages LEFT Join category On pages.catid  =  category.catid Where pages.soft_delete = 0 AND  category.soft_delete = 0 And pid = $pid AND pages.isactive = 1 ");

$content['page_desc'] = replace_sysvari($content['page_desc'] , '../../' );

$content['page_desc'] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$content['page_desc']);

echo json_encode($content , TRUE);

}

