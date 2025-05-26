<?php
function debug_($bt, $sql) {
    global $conn;

    // Determine the best response format
    $contentType = determineResponseFormat();

    // Generate error data structure
    $errorData = [
        "sql" => $sql,
        "databaseError" => $conn->error,
        "trace" => [
            "file" => $bt[0]['file'],
            "line" => $bt[0]['line'],
            "function" => $bt[0]['function']
        ]
    ];

    // Output based on content type
    switch ($contentType) {
        case 'application/json':
            header('Content-Type: application/json');
            echo json_encode($errorData, JSON_PRETTY_PRINT);
            break;


        case 'text/plain':
            header('Content-Type: text/plain');
            echo "Database Error:\n";
            echo "SQL: " . $sql . "\n";
            echo "Error: " . $conn->error . "\n";
            echo "File: " . $bt[0]['file'] . "\n";
            echo "Line: " . $bt[0]['line'] . "\n";
            echo "Function: " . $bt[0]['function'] . "\n";
            break;

        case 'text/html':
        default:
            echo generateHtmlError($errorData);
            break;
    }

    exit; // Stop execution after displaying error
}

/**
 * Determines the best response format based on Accept header or Content-Type.
 */
function determineResponseFormat() {
    // Check if Content-Type was manually set
    foreach (headers_list() as $header) {
        if (stripos($header, 'Content-Type:') === 0) {
            $contentType = trim(substr($header, 13));
            if (strpos($contentType, ';') !== false) {
                $contentType = strtok($contentType, ';');
            }
            return $contentType;
        }
    }

    // Check Accept header (for API requests)
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        $acceptHeader = $_SERVER['HTTP_ACCEPT'];
        $acceptTypes = explode(',', $acceptHeader);

        foreach ($acceptTypes as $type) {
            $type = trim(explode(';', $type)[0]);
            if ($type === 'application/json') return 'application/json';
            if ($type === 'text/plain') return 'text/plain';
        }
    }

    // Default to HTML for web browsers
    return 'text/html';
}


/**
 * Generates HTML error display.
 */
function generateHtmlError($errorData) {
    return <<<HTML
    <div style="
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
    ">
        <div style="
            padding: 12px 15px;
            background: #dc3545;
            color: white;
            font-weight: bold;
            font-size: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        ">
            <span>Database Error</span>
            <button style="
                background: transparent;
                border: none;
                color: white;
                font-size: 18px;
                cursor: pointer;
                padding: 0 5px;
            " onclick="this.parentNode.parentNode.style.display='none'">×</button>
        </div>
        <div style="
            padding: 15px;
            color: #333;
            line-height: 1.6;
            max-height: 400px;
            overflow-y: auto;
        ">
            <div style="
                margin-bottom: 10px;
                padding: 10px;
                background: #f8f9fa;
                border-radius: 4px;
                font-family: monospace;
                white-space: pre-wrap;
                word-break: break-all;
            ">{$errorData['sql']}</div>
            <div style="color: #dc3545; margin-bottom: 8px;">{$errorData['databaseError']}</div>
            <div style="
                margin-top: 15px;
                font-size: 13px;
                color: #666;
                border-top: 1px solid #eee;
                padding-top: 10px;
            ">
                <div style="margin-bottom: 5px;"><span style="font-weight:bold;">File:</span> {$errorData['trace']['file']}</div>
                <div style="margin-bottom: 5px;"><span style="font-weight:bold;">Line:</span> {$errorData['trace']['line']}</div>
                <div><span style="font-weight:bold;">Function:</span> {$errorData['trace']['function']}</div>
            </div>
        </div>
    </div>
HTML;
}