<?php

function debug_($bt, $sql) {
    global $conn;
    
    $error = '<div style="
        position: fixed;
        top: 20px;
        right: 20px;
        width: 80%;
        max-width: 600px;
        background: #fff;
        border-left: 5px solid #dc3545;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        font-family: Arial, sans-serif;
    ">';
    
    $error .= '<div style="
        padding: 12px 15px;
        background: #dc3545;
        color: white;
        font-weight: bold;
        font-size: 16px;
    ">Database Error</div>';
    
    $error .= '<div style="
        padding: 15px;
        color: #333;
        line-height: 1.6;
        max-height: 400px;
        overflow-y: auto;
    ">';
    
    $error .= '<div style="
        margin-bottom: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 4px;
        font-family: monospace;
    ">' . htmlspecialchars($sql) . '</div>';
    
    $error .= '<div style="color: #dc3545; margin-bottom: 8px;">' . $conn->error . '</div>';
    
    $error .= '<div style="
        margin-top: 15px;
        font-size: 13px;
        color: #666;
    ">';
    
    $error .= '<div style="margin-bottom: 5px;"><span style="font-weight:bold;">File:</span> ' . $bt[0]['file'] . '</div>';
    $error .= '<div style="margin-bottom: 5px;"><span style="font-weight:bold;">Line:</span> ' . $bt[0]['line'] . '</div>';
    $error .= '<div><span style="font-weight:bold;">Function:</span> ' . $bt[0]['function'] . '</div>';
    
    $error .= '</div></div></div>';
    
    return $error;
}