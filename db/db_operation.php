<?php

/**
 * Fetch a single value from the first row of a query result
 * 
 * @param string $sql The SQL query to execute
 * @return mixed|null The first value from the first row or null if no results
 */
function return_single_ans($sql) {
    global $conn;
    
    if ($result = $conn->query($sql)) {
        if ($row = $result->fetch_row()) {
            $result->free();
            return $row[0];
        }
        $result->free();
        return null;
    }
    
    // Only generate backtrace if needed (for errors)
    return debug_(debug_backtrace(), $sql);
}

/**
 * Fetch a single associative array row from a query result
 * 
 * @param string $sql The SQL query to execute
 * @return array|null Associative array of row data or null if no results
 */
function return_single_row($sql) {
    global $conn;
    
    if ($result = $conn->query($sql)) {
        $row = $result->fetch_assoc();
        $result->free();
        return $row ?: null;
    }
    
    return debug_(debug_backtrace(), $sql);
}

/**
 * Fetch all rows from a query result as an array of associative arrays
 * 
 * @param string $sql The SQL query to execute
 * @return array Array of associative arrays (empty array if no results)
 */
function return_multiple_rows($sql) {
    global $conn;
    
    $result = $conn->query($sql);
    if (!$result) {
        return debug_(debug_backtrace(), $sql);
    }
    
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    
    return $rows;
}

/**
 * Escape a string for safe SQL usage
 * 
 * @param string $string The string to escape
 * @return string The escaped string
 */

function escape($string) {
    global $conn;
    return $conn->real_escape_string($string);
}

/**
 * Execute an INSERT query and return the last insert ID
 * 
 * @param string $sql The INSERT query to execute
 * @return int|false The insert ID or false on failure
 */
function Insert($sql) {
    global $conn;
    
    if ($conn->query($sql) === true) {
        return $conn->insert_id;
    }
    
    return debug_(debug_backtrace(), $sql);
}

/**
 * Execute an UPDATE query and return affected rows count
 * 
 * @param string $sql The UPDATE query to execute
 * @return int|false Number of affected rows or false on failure
 */
function Update($sql) {
    global $conn;
    
    if ($conn->query($sql) === true) {
        return $conn->affected_rows;
    }
    
    return debug_(debug_backtrace(), $sql);
}

/**
 * Execute a DELETE query and return affected rows count
 * 
 * @param string $sql The DELETE query to execute
 * @return int|false Number of affected rows or false on failure
 */
function Delete($sql) {
    global $conn;
    
    if ($conn->query($sql) === true) {
        return $conn->affected_rows;
    }
    
    return debug_(debug_backtrace(), $sql);
}

// Function to clean input data
function clean($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}