<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

function getAllSubfolders($dir, $base = '') {
    $subfolders = [];

    if (!is_dir($dir)) return $subfolders;

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

    <script>
    function handleFolderSelect() {
        var selectBox = document.getElementById("folderSelect");
        var selectedFolder = selectBox.value;
        OpenMediaGallery(null, selectedFolder);
    }

    </script>
    '
);

?>

<body id="page-top">
      <?php include 'includes/notification.php';?>
   
  <div id="wrapper">
  <?php include'includes/sidebar.php'; ?>
    
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
        <h1>Gallery</h1>
        <hr>
        <p>Upload Images</p>
        
        <div class="form-group row">
            <div class="col-sm-3">
                <select id="folderSelect" class="form-control" onchange="handleFolderSelect()">
                    <option value="">-- Select a folder --</option>
                    <?php foreach ($subfolders as $folder): ?>
                        <option value="<?php echo htmlspecialchars($folder); ?>"><?php echo htmlspecialchars($folder); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-primary form-control" onclick="OpenMediaGallery(null, document.getElementById('folderSelect').value)" type="button">
                    <i class="fa fa-picture-o"></i>&nbsp; Open Gallery
                </button>
            </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <?php include 'includes/footer_copyright.php';?>
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <?php echo include_module('modules/upload_image.php' , null);?>
  <?php include 'includes/footer.php';?>