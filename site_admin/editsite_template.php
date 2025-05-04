<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [
    '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">',
    '<link rel="stylesheet" href="css/site_template/editsite_template.css">',
    '<script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.7/beautify-html.min.js"></script>'
];

AdminHeader(
    "dashboard Admin", 
    "", 
    $extra_libs,
    null,
    ''
);

// Get site template data
$site_template = return_single_row("SELECT * FROM site_template WHERE st_id = ".escape($_GET['id'])." $and_gc");

?>

<body id="page-top">
   <?php include 'includes/notification.php';?>
   <div id="wrapper">
   <?php include 'includes/sidebar.php'; ?>
   <div id="content-wrapper">
      <div class="container-fluid">
         <div class="container-fluid">
            <div id="error_id"></div>
            <div id="page-content-wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12">
                        <form class="needs-validation" onsubmit="return false" novalidate>
                           <!-- Template Name and Active Status in one row -->
                         <div class="form-row align-items-center mb-4">
                                <div class="col-md-6">
                                    <label class="form-label-row">Template Name</label>
                                    <input type="text" class="form-control" id="st_name" placeholder="Update Name" name="st_name" value="<?php echo htmlspecialchars($site_template['st_name']); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-row">Is Active</label>
                                    <select class="form-control" id='is_active' name="is_active">
                                        <option value="1" <?php if($site_template['isactive'] == 1) echo "selected"; ?> >YES</option>
                                        <option value="0" <?php if($site_template['isactive'] != 1) echo "selected"; ?> >NO</option>
                                    </select>
                                </div>
                            </div>
                           
                           <!-- Header -->
                           <div class="form-label-row">Header</div>
                           <div class="editor-container">
                               <div class="editor-header">
                                   <h4>Header Editor</h4>
                                   <i class="fas fa-chevron-up toggle-collapse"></i>
                               </div>
                               <div class="editor-content">
                                   <div class="editor-toolbar">
                                       <div class="toolbar-buttons">
                                           <button type="button" class="toolbar-btn indent-btn" data-target="st_header" title="Indent"><i class="fas fa-indent"></i></button>
                                           <button type="button" class="toolbar-btn outdent-btn" data-target="st_header" title="Outdent"><i class="fas fa-outdent"></i></button>
                                           <button type="button" class="toolbar-btn beautify-btn" data-target="st_header" title="Beautify HTML"><i class="fas fa-code"></i></button>
                                       </div>
                                   </div>
                                   <textarea class="custom-editor" id="st_header"><?php echo htmlspecialchars($site_template['st_header']); ?></textarea>
                                   <button type="button" class="maximize-btn" data-target="st_header" title="Maximize"><i class="fas fa-expand"></i></button>
                               </div>
                           </div>

                           <!-- Menu -->
                           <div class="form-label-row">Menu</div>
                           <div class="editor-container">
                               <div class="editor-header">
                                   <h4>Menu Editor</h4>
                                   <i class="fas fa-chevron-up toggle-collapse"></i>
                               </div>
                               <div class="editor-content">
                                   <div class="editor-toolbar">
                                       <div class="toolbar-buttons">
                                           <button type="button" class="toolbar-btn indent-btn" data-target="st_menu" title="Indent"><i class="fas fa-indent"></i></button>
                                           <button type="button" class="toolbar-btn outdent-btn" data-target="st_menu" title="Outdent"><i class="fas fa-outdent"></i></button>
                                           <button type="button" class="toolbar-btn beautify-btn" data-target="st_menu" title="Beautify HTML"><i class="fas fa-code"></i></button>
                                       </div>
                                   </div>
                                   <textarea class="custom-editor" id="st_menu"><?php echo htmlspecialchars($site_template['st_menu']); ?></textarea>
                                   <button type="button" class="maximize-btn" data-target="st_menu" title="Maximize"><i class="fas fa-expand"></i></button>
                               </div>
                           </div>

                           <!-- Footer -->
                           <div class="form-label-row">Footer</div>
                           <div class="editor-container">
                               <div class="editor-header">
                                   <h4>Footer Editor</h4>
                                   <i class="fas fa-chevron-up toggle-collapse"></i>
                               </div>
                               <div class="editor-content">
                                   <div class="editor-toolbar">
                                       <div class="toolbar-buttons">
                                           <button type="button" class="toolbar-btn indent-btn" data-target="st_footer" title="Indent"><i class="fas fa-indent"></i></button>
                                           <button type="button" class="toolbar-btn outdent-btn" data-target="st_footer" title="Outdent"><i class="fas fa-outdent"></i></button>
                                           <button type="button" class="toolbar-btn beautify-btn" data-target="st_footer" title="Beautify HTML"><i class="fas fa-code"></i></button>
                                       </div>
                                   </div>
                                   <textarea class="custom-editor" id="st_footer"><?php echo htmlspecialchars($site_template['st_footer']); ?></textarea>
                                   <button type="button" class="maximize-btn" data-target="st_footer" title="Maximize"><i class="fas fa-expand"></i></button>
                               </div>
                           </div>

                           <!-- Scripts -->
                           <div class="form-label-row">Scripts</div>
                           <div class="editor-container">
                               <div class="editor-header">
                                   <h4>Scripts Editor</h4>
                                   <i class="fas fa-chevron-up toggle-collapse"></i>
                               </div>
                               <div class="editor-content">
                                   <div class="editor-toolbar">
                                       <div class="toolbar-buttons">
                                           <button type="button" class="toolbar-btn indent-btn" data-target="st_script" title="Indent"><i class="fas fa-indent"></i></button>
                                           <button type="button" class="toolbar-btn outdent-btn" data-target="st_script" title="Outdent"><i class="fas fa-outdent"></i></button>
                                           <button type="button" class="toolbar-btn beautify-btn" data-target="st_script" title="Beautify HTML"><i class="fas fa-code"></i></button>
                                       </div>
                                   </div>
                                   <textarea class="custom-editor" id="st_script"><?php echo htmlspecialchars($site_template['st_script']); ?></textarea>
                                   <button type="button" class="maximize-btn" data-target="st_script" title="Maximize"><i class="fas fa-expand"></i></button>
                               </div>
                           </div>

                            <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" name="submit" class="btn btn-info w-100" id="submit_btn">Save Changes</button>
                            </div>

                        </form>
                     </div>

                         <?php echo include_module('modules/shortcode/short_code.php'); ?>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script>
           const sitetemp_id = "<?php echo intval($_GET['id']); ?>";
   </script>
   <script src="js/site_template/editsite_template.js"></script>