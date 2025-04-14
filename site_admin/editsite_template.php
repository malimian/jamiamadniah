<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [
    '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">',
    '<style>
        /* Custom Editor Styles */
        .custom-editor {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: monospace;
            min-height: 400px;
            padding: 10px;
            background: #f8f9fa;
            white-space: pre;
            overflow-x: auto;
            tab-size: 4;
        }
        
        .editor-container {
            position: relative;
            margin-bottom: 20px;
        }
        
        .maximize-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 1000;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 2px 5px;
            cursor: pointer;
            color: #333;
        }
        
        .maximize-btn:hover {
            background: #f8f9fa;
        }
        
        .maximized-textarea {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1050;
            background: white;
            padding: 20px;
        }
        
        .maximized-textarea .custom-editor {
            height: calc(100vh - 100px);
        }
        
        /* Form layout */
        .form-label-row {
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        /* Shortcode panel styles */
        .shortcode-panel {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 250px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 15px;
            z-index: 1040;
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
        }
        
        .shortcode-panel.hidden {
            right: -250px;
        }
        
        .show-panel-btn {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1039;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-right: none;
            padding: 10px 5px;
            cursor: pointer;
            border-radius: 5px 0 0 5px;
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
        }
        
        /* Toolbar styles */
        .editor-toolbar {
            background: #f1f1f1;
            padding: 5px;
            border-bottom: 1px solid #ddd;
            display: flex;
            gap: 5px;
        }
        
        .toolbar-btn {
            background: white;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 2px 8px;
            cursor: pointer;
        }
    </style>'
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

// Get og_settings and og_packages_category data using your database functions
$og_settings = return_multiple_rows("SELECT * FROM og_settings WHERE isactive = 1 AND soft_delete = 0");
$og_packages = return_multiple_rows("SELECT * FROM og_packages_category WHERE isactive = 1 AND soft_delete = 0");
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
                           <!-- Template Name -->
                           <div class="form-label-row">Template Name</div>
                           <div class="form-group">
                              <input type="text" class="form-control" id="st_name" placeholder="Update Name" name="st_name" value="<?php echo htmlspecialchars($site_template['st_name']); ?>">
                           </div>
                           
                           <!-- Header -->
                           <div class="form-label-row">Header</div>
                           <div class="form-group">
                              <div class="editor-container">
                                 <div class="editor-toolbar">
                                    <button class="toolbar-btn indent-btn" data-target="st_header" title="Indent"><i class="fas fa-indent"></i></button>
                                    <button class="toolbar-btn outdent-btn" data-target="st_header" title="Outdent"><i class="fas fa-outdent"></i></button>
                                 </div>
                                 <div class="custom-editor" id="st_header" contenteditable="true"><?php echo htmlspecialchars($site_template['st_header']); ?></div>
                                 <button class="maximize-btn" data-target="st_header" title="Maximize"><i class="fas fa-expand"></i></button>
                              </div>
                           </div>

                           <!-- Menu -->
                           <div class="form-label-row">Menu</div>
                           <div class="form-group">
                              <div class="editor-container">
                                 <div class="editor-toolbar">
                                    <button class="toolbar-btn indent-btn" data-target="st_menue" title="Indent"><i class="fas fa-indent"></i></button>
                                    <button class="toolbar-btn outdent-btn" data-target="st_menue" title="Outdent"><i class="fas fa-outdent"></i></button>
                                 </div>
                                 <div class="custom-editor" id="st_menue" contenteditable="true"><?php echo htmlspecialchars($site_template['st_menue']); ?></div>
                                 <button class="maximize-btn" data-target="st_menue" title="Maximize"><i class="fas fa-expand"></i></button>
                              </div>
                           </div>

                           <!-- Footer -->
                           <div class="form-label-row">Footer</div>
                           <div class="form-group">
                              <div class="editor-container">
                                 <div class="editor-toolbar">
                                    <button class="toolbar-btn indent-btn" data-target="st_footer" title="Indent"><i class="fas fa-indent"></i></button>
                                    <button class="toolbar-btn outdent-btn" data-target="st_footer" title="Outdent"><i class="fas fa-outdent"></i></button>
                                 </div>
                                 <div class="custom-editor" id="st_footer" contenteditable="true"><?php echo htmlspecialchars($site_template['st_footer']); ?></div>
                                 <button class="maximize-btn" data-target="st_footer" title="Maximize"><i class="fas fa-expand"></i></button>
                              </div>
                           </div>

                           <!-- Scripts -->
                           <div class="form-label-row">Scripts</div>
                           <div class="form-group">
                              <div class="editor-container">
                                 <div class="editor-toolbar">
                                    <button class="toolbar-btn indent-btn" data-target="st_script" title="Indent"><i class="fas fa-indent"></i></button>
                                    <button class="toolbar-btn outdent-btn" data-target="st_script" title="Outdent"><i class="fas fa-outdent"></i></button>
                                 </div>
                                 <div class="custom-editor" id="st_script" contenteditable="true"><?php echo htmlspecialchars($site_template['st_script']); ?></div>
                                 <button class="maximize-btn" data-target="st_script" title="Maximize"><i class="fas fa-expand"></i></button>
                              </div>
                           </div>
                           
                           <!-- Is Active -->
                           <div class="form-label-row">Is Active</div>
                           <div class="form-group">
                              <select class="form-control" id='is_active' name="is_active">
                                 <option value="1" <?php if($site_template['isactive'] == 1) echo "selected"; ?> >YES</option>
                                 <option value="0" <?php if($site_template['isactive'] != 1) echo "selected"; ?> >NO</option>
                              </select>
                           </div>
                           
                           <div class="form-group text-right">
                              <input type="submit" name="submit" class="btn btn-info" value="Submit" id="submit_btn" />
                           </div>
                        </form>
                        
                        <!-- Shortcode Panel -->
                        <div class="shortcode-panel" id="shortcodePanel">
                           <button class="close-panel" id="closeShortcodePanel">&times;</button>
                           <h4>Insert Shortcodes</h4>
                           
                           <div class="form-group">
                              <label>Target Textarea:</label>
                              <select class="form-control" id="targetTextarea">
                                 <option value="st_header">Header</option>
                                 <option value="st_menue">Menu</option>
                                 <option value="st_footer">Footer</option>
                                 <option value="st_script">Scripts</option>
                              </select>
                           </div>
                           
                           <div class="form-group">
                              <label>OG Settings:</label>
                              <select class="form-control" id="ogSettingsSelect" multiple>
                                 <?php foreach($og_settings as $setting): ?>
                                    <option value="<?php echo htmlspecialchars($setting['short_code']); ?>"><?php echo htmlspecialchars($setting['settings_name']); ?></option>
                                 <?php endforeach; ?>
                              </select>
                              <button class="btn btn-sm btn-primary mt-2" id="insertOgSettings">Insert Selected</button>
                           </div>
                           
                           <div class="form-group">
                              <label>OG Packages:</label>
                              <select class="form-control" id="ogPackagesSelect" multiple>
                                 <?php foreach($og_packages as $package): ?>
                                    <option value="<?php echo htmlspecialchars($package['short_code']); ?>"><?php echo htmlspecialchars($package['title']); ?></option>
                                 <?php endforeach; ?>
                              </select>
                              <button class="btn btn-sm btn-primary mt-2" id="insertOgPackages">Insert Selected</button>
                           </div>
                           
                           <button class="btn btn-sm btn-secondary mt-3" id="toggleShortcodePanel">Hide Panel</button>
                        </div>
                        
                        <!-- Show Panel Button (hidden by default) -->
                        <button class="show-panel-btn" id="showPanelBtn" style="display: none;">
                           <i class="fas fa-chevron-left"></i> Show Panel
                        </button>
                        
                        <script type="text/javascript">
                           var sitetemp_id = "<?php echo intval($_GET['id']); ?>";
                           
                           $(document).ready(function() {
                              // Custom editor functionality
                              $('.custom-editor').each(function() {
                                 var editor = $(this);
                                 
                                 // Auto-select target when focused
                                 editor.on('focus', function() {
                                    $('#targetTextarea').val(this.id);
                                 });
                                 
                                 // Tab key support with indentation
                                 editor.on('keydown', function(e) {
                                    if (e.key === 'Tab') {
                                       e.preventDefault();
                                       document.execCommand('insertText', false, '    '); // 4 spaces
                                    }
                                 });
                              });
                              
                              // Indent/Outdent functionality
                              $('.indent-btn').click(function() {
                                 var target = $(this).data('target');
                                 var editor = $('#' + target);
                                 var selection = window.getSelection();
                                 
                                 if (selection.rangeCount > 0) {
                                    var range = selection.getRangeAt(0);
                                    var selectedText = range.toString();
                                    var lines = selectedText.split('\n');
                                    
                                    // Indent each line
                                    var indentedText = lines.map(function(line) {
                                       return '    ' + line; // 4 spaces
                                    }).join('\n');
                                    
                                    range.deleteContents();
                                    range.insertNode(document.createTextNode(indentedText));
                                 } else {
                                    // If no selection, just insert spaces at cursor
                                    document.execCommand('insertText', false, '    ');
                                 }
                              });
                              
                              $('.outdent-btn').click(function() {
                                 var target = $(this).data('target');
                                 var editor = $('#' + target);
                                 var selection = window.getSelection();
                                 
                                 if (selection.rangeCount > 0) {
                                    var range = selection.getRangeAt(0);
                                    var selectedText = range.toString();
                                    var lines = selectedText.split('\n');
                                    
                                    // Outdent each line
                                    var outdentedText = lines.map(function(line) {
                                       return line.replace(/^ {1,4}/, ''); // Remove up to 4 leading spaces
                                    }).join('\n');
                                    
                                    range.deleteContents();
                                    range.insertNode(document.createTextNode(outdentedText));
                                 }
                              });
                              
                              // Maximize button functionality
                              $('.maximize-btn').click(function() {
                                 var target = $(this).data('target');
                                 var editorContainer = $(this).closest('.editor-container');
                                 var editor = $('#' + target);
                                 
                                 if (editorContainer.hasClass('maximized-textarea')) {
                                    editorContainer.removeClass('maximized-textarea');
                                    $(this).html('<i class="fas fa-expand"></i>');
                                    $(this).attr('title', 'Maximize');
                                 } else {
                                    editorContainer.addClass('maximized-textarea');
                                    $(this).html('<i class="fas fa-compress"></i>');
                                    $(this).attr('title', 'Minimize');
                                 }
                              });
                              
                              // Shortcode panel functionality
                              $('#toggleShortcodePanel').click(function() {
                                 $('#shortcodePanel').addClass('hidden');
                                 $('#showPanelBtn').show();
                              });
                              
                              $('#closeShortcodePanel').click(function() {
                                 $('#shortcodePanel').addClass('hidden');
                                 $('#showPanelBtn').show();
                              });
                              
                              $('#showPanelBtn').click(function() {
                                 $('#shortcodePanel').removeClass('hidden');
                                 $(this).hide();
                              });
                              
                              // Insert OG Settings
                              $('#insertOgSettings').click(function() {
                                 var targetId = $('#targetTextarea').val();
                                 var selected = $('#ogSettingsSelect').val();
                                 var editor = $('#' + targetId);
                                 
                                 if (selected && selected.length > 0) {
                                    selected.forEach(function(shortcode) {
                                       var selection = window.getSelection();
                                       var range = selection.getRangeAt(0);
                                       range.deleteContents();
                                       range.insertNode(document.createTextNode(shortcode + "\n"));
                                    });
                                 }
                              });
                              
                              // Insert OG Packages
                              $('#insertOgPackages').click(function() {
                                 var targetId = $('#targetTextarea').val();
                                 var selected = $('#ogPackagesSelect').val();
                                 var editor = $('#' + targetId);
                                 
                                 if (selected && selected.length > 0) {
                                    selected.forEach(function(shortcode) {
                                       var selection = window.getSelection();
                                       var range = selection.getRangeAt(0);
                                       range.deleteContents();
                                       range.insertNode(document.createTextNode(shortcode + "\n"));
                                    });
                                 }
                              });
                              
                              // Form submission
                              $('form').on('submit', function() {
                                 // Collect data from contenteditable divs
                                 var formData = {
                                    st_name: $('#st_name').val(),
                                    st_header: $('#st_header').text(),
                                    st_menue: $('#st_menue').text(),
                                    st_footer: $('#st_footer').text(),
                                    st_script: $('#st_script').text(),
                                    is_active: $('#is_active').val(),
                                    st_id: sitetemp_id
                                 };
                                 
                                 // Submit via AJAX
                                 $.post('save_template.php', formData, function(response) {
                                    if (response.success) {
                                       alert('Template saved successfully!');
                                    } else {
                                       alert('Error saving template: ' + response.error);
                                    }
                                 }, 'json');
                              });
                           });
                        </script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Remove CKEditor scripts
        document.querySelectorAll('script').forEach(script => {
            if (script.src.includes('ckeditor.js')) {
                script.remove();
            }
        });
        
        // 2. Destroy existing instances
        if (typeof CKEDITOR !== 'undefined') {
            Object.keys(CKEDITOR.instances).forEach(instance => {
                CKEDITOR.instances[instance].destroy();
            });
        }
        
        // 3. Prevent future loading
        window.CKEDITOR = undefined;
    });
</script>

</body>