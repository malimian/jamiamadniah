<?php

function return_single_ans(string $sql): mixed
{
    global $conn;
    $bt = debug_backtrace();
    $result = $conn->query($sql);
    
    if ($result === TRUE || $result === false) {
        return debug_($bt, $sql);
    }
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return reset($row);
    }
    
    return null;
}

function return_single_row(string $sql): ?array
{
    global $conn;
    $bt = debug_backtrace();
    $result = $conn->query($sql);
    
    if ($result === TRUE || $result === false) {
        return debug_($bt, $sql);
    }
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    return null;
}

function return_multiple_rows(string $sql): array
{
    $arr = [];
    global $conn;
    $bt = debug_backtrace();
    $result = $conn->query($sql);
    
    if ($result === TRUE || $result === false) {
        return debug_($bt, $sql);
    }
    
    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
    
    return $arr;
}

function escape(string $string): string
{
    global $conn;
    return $conn->real_escape_string($string);
}

function Insert(string $sql): int|false
{
    global $conn;
    $bt = debug_backtrace();
    
    if ($conn->query($sql) === TRUE) {
        return $conn->insert_id;
    }
    
    return debug_($bt, $sql);
}

function Update(string $sql): int|false
{
    global $conn;
    $bt = debug_backtrace();
    
    if ($conn->query($sql) === TRUE) {
        return $conn->affected_rows;
    }
    
    return debug_($bt, $sql);
}

function Delete(string $sql): int|false
{
    global $conn;
    $bt = debug_backtrace();
    
    if ($conn->query($sql) === TRUE) {
        return $conn->affected_rows;
    }
    
    return debug_($bt, $sql);
}