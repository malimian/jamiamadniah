
<?php
static $AND_gc = " AND soft_delete = 0";
static $And_gc = " AND soft_delete = 0";
static $and_gc = " AND soft_delete = 0";

static $WHERE_gc = " Where soft_delete = 0";
static $Where_gc = " Where soft_delete = 0";
static $where_gc = " Where soft_delete = 0";


/**
 * Appends a soft delete condition to an SQL query.
 *
 * @param string $query   The SQL query.
 * @param string $columns Comma-separated list of table aliases/column prefixes.
 * @return string Modified SQL query with soft delete conditions.
 */
function softdelete_check($query, $columns)
{
    $columnsArray = explode(',', $columns);
    $returnQuery = $query;
    $queryLower = strtolower($query);
    
    if (strpos($queryLower, 'where') !== false) {
        foreach ($columnsArray as $column) {
            $returnQuery .= " AND {$column}.soft_delete = 0";
        }
    } else {
        $count = 0;
        foreach ($columnsArray as $column) {
            $returnQuery .= ($count == 0) 
                ? " WHERE {$column}.soft_delete = 0" 
                : " AND {$column}.soft_delete = 0";
            $count++;
        }
    }
    
    return $returnQuery;
}

/**
 * Alternative function to append a soft delete condition to an SQL query.
 *
 * @param string $query   The SQL query.
 * @param string $columns Comma-separated list of table aliases/column prefixes.
 * @return string Modified SQL query with soft delete conditions.
 */
function softdelete1_check($query, $columns)
{
    $queryLower = strtolower($query);
    $returnQuery = (strpos($queryLower, 'where') !== false) ? $query : $query . " WHERE ";
    
    $columnsArray = explode(',', $columns);
    $count = 0;
    
    foreach ($columnsArray as $column) {
        $returnQuery .= ($count == 0) 
            ? "{$column}.soft_delete = 0" 
            : " AND {$column}.soft_delete = 0";
        $count++;
    }
    
    return $returnQuery;
}
?>
