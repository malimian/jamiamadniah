<?php
static $AND_gc = " AND soft_delete = 0";
static $And_gc = " AND soft_delete = 0";
static $and_gc = " AND soft_delete = 0";

static $WHERE_gc = " Where soft_delete = 0";
static $Where_gc = " Where soft_delete = 0";
static $where_gc = " Where soft_delete = 0";


function softdelete_check($query , $coulmns)
{
	$coulmns = explode(',', $coulmns);
	$return_query = $query;
	$count = 0;
	$q1 = strtolower($query);
	   if(strpos($q1, 'where') !== false){
		foreach ($coulmns as $single_column) {
		$return_query .= " AND ".$single_column.".soft_delete = 0 ";
		}
		}else{
		foreach ($coulmns as $single_column) {
		if($count == 0) {$return_query .= " WHERE ".$single_column.".soft_delete = 0 "; $count++; }
		else
		$return_query .= " AND ".$single_column.".soft_delete = 0 ";
		}
	}

	return $return_query;
}



function softdelete1_check($query , $coulmns)
{
	$count = 0;
	$q1 = strtolower($query);
	
	if(strpos($q1, 'where') !== false)
	$return_query = $query;
	else $return_query = $query." Where ";

	$coulmns = explode(',', $coulmns);
	
	foreach ($coulmns as $single_column) {
	if($count == 0) {$return_query .= $single_column.".soft_delete = 0 "; $count++; }
	else
		$return_query .= " AND ".$single_column.".soft_delete = 0 ";
 }
	return $return_query;
}


?>