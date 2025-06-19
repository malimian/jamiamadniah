<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

function getAllSubfolders($dir, $base = '') {
    $subfolders = [];

    if (!is_dir($dir)) {
        return $subfolders;
    }

    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;

        $path = $dir . DIRECTORY_SEPARATOR . $item;
        $relativePath = $base . $item;

        if (is_dir($path)) {
            $subfolders[] = $relativePath;
            $subfolders = array_merge($subfolders, getAllSubfolders($path, $relativePath . '/'));
        }
    }

    return $subfolders;
}

$image_path = "../" . ABSOLUTE_IMAGEPATH;
$subfolders = getAllSubfolders($image_path);

AdminHeader(
    "Gallery", 
    "", 
    $extra_libs,
    null,
    '
    <style>
        .folder-select-container {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .folder-select-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .folder-select-header i {
            font-size: 24px;
            margin-right: 10px;
            color: #6c757d;
        }
        #folderSelect {
            border: 2px solid #dee2e6;
            height: 46px;
            font-size: 16px;
        }
        #folderSelect:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .no-folder-alert {
            display: none;
            margin-top: 15px;
        }
    </style>
    
    <script>
    function handleFolderSelect() {
        var selectBox = document.getElementById("folderSelect");
        var selectedFolder = selectBox.value;
        var alertBox = document.getElementById("noFolderAlert");
        
        if (!selectedFolder) {
            alertBox.style.display = "block";
            return false;
        }
        
        alertBox.style.display = "none";
        OpenMediaGallery(null, selectedFolder);
        return true;
    }
    
    function validateBeforeOpen() {
        var selectBox = document.getElementById("folderSelect");
        if (!selectBox.value) {
            document.getElementById("noFolderAlert").style.display = "block";
            return false;
        }
        return true;
    }
    
    // Open gallery when page loads if folder is selected
    document.addEventListener("DOMContentLoaded", function() {
        var selectBox = document.getElementById("folderSelect");
        if (selectBox.value) {
            handleFolderSelect();
        }
    });
    </script>
    '
);

?>

<body id="page-top">
    <?php include 'includes/notification.php';?>
   
    <div id="wrapper">
        <?php include 'includes/sidebar.php'; ?>
        
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo $_SESSION['user']['dashboard'];?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Gallery</li>
                </ol>

                <!-- Page Content -->
                <h1>Gallery Management</h1>
                <hr>
                
                <div class="folder-select-container">
                    <div class="folder-select-header">
                        <i class="fas fa-folder-open"></i>
                        <h4>Select Image Folder</h4>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-8">
                            <select id="folderSelect" class="form-control" onchange="handleFolderSelect()">
                                <option value="">-- Select a folder to view images --</option>
                                <?php foreach ($subfolders as $folder): ?>
                                    <option value="<?php echo htmlspecialchars($folder); ?>">
                                        <?php echo htmlspecialchars($folder); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" onclick="if(validateBeforeOpen()) handleFolderSelect();">
                                <i class="fas fa-eye"></i> View Gallery
                            </button>
                        </div>
                    </div>
                    
                    <div id="noFolderAlert" class="alert alert-warning no-folder-alert" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> Please select a folder first!
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-images"></i> Gallery Instructions
                    </div>
                    <div class="card-body">
                        <ol>
                            <li>Select a folder from the dropdown above</li>
                            <li>View and manage images in the gallery</li>
                            <li>Upload new images using the upload panel</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

            <?php include 'includes/footer_copyright.php';?>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php echo include_module('modules/upload_image.php', null); ?>
    <?php include 'includes/footer.php'; ?>