<?php 
include '../../admin_connect.php';

$path = __DIR__ . '/../../../'.ABSOLUTE_IMAGEPATH;

if (isset($_POST['upload_image'])) {

    $file_name = "";

    // Ensure file is uploaded correctly
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {

        // Ensure upload_image function exists
        if (function_exists('upload_image')) {
            $file_name = upload_image($path);

            if ($file_name) {
                $file_arr_ = [
                    'file_name' => $file_name,
                    'file_path' => ABSOLUTE_IMAGEPATH . '/' . $file_name
                ];
                echo json_encode($file_arr_);
                exit;  // Exit to prevent additional output
            } else {
                echo json_encode(["error" => "File upload failed."]);
                exit;
            }
        } else {
            echo json_encode(["error" => "upload_image function not found."]);
            exit;
        }
    } else {
        echo json_encode(["error" => "No file uploaded or file error."]);
        exit;
    }
}

// File Deletion Handling
if (isset($_POST['delete_file_submit'])) {
  
    $file_name = $_POST['filename'];
  
    if (!empty($file_name) && file_exists($path . $file_name)) {
    
        echo unlink($path . $file_name) ? "1" : "0";
    
    } else {

        echo "File not found.";
    }
}
?>
