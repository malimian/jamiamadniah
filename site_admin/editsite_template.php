<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

AdminHeader(
    "dashboard Admin", 
    "", 
    $extra_libs,
    null,
    '

    '
);

?>

<!-- CodeMirror CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css" />

<!-- CodeMirror JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>

<!-- Addons for CodeMirror (optional) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/edit/matchbrackets.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/edit/closebrackets.min.js"></script>

<!-- CodeMirror Modes (for syntax highlighting) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/htmlmixed/htmlmixed.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/css/css.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/xml/xml.min.js"></script>

<style>
   /* Full-screen mode for CodeMirror editors */
   .CodeMirror.fullscreen {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999; /* Ensure the editor is above everything else */
      border-radius: 0;
   }

   /* Ensure the form takes full height */
   html, body, #wrapper, #content-wrapper, .container-fluid, .row, .col-lg-12 {
      height: 100%;
   }

   /* Make the form scrollable if content overflows */
   .container-fluid {
      overflow-y: auto;
   }

   /* Style for CodeMirror editors */
   .code-editor {
      height: 400px; /* Default height */
      width: 100%;
   }

   /* Ensure CodeMirror editors take full height */
   .CodeMirror {
      height: 100%;
      border: 1px solid #ddd;
      border-radius: 4px;
   }

   /* Editor container */
   .editor-container {
      position: relative;
   }

    /* Full-screen mode for CodeMirror editors */
   .CodeMirror.fullscreen {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999; /* Ensure the editor is above everything else */
      border-radius: 0;
   }

   /* Maximize button */
   .maximize-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 10000; /* Ensure the button is above the full-screen editor */
      border: 1px solid #ddd; /* Add border for better visibility */
      padding: 5px 10px; /* Add padding for better visibility */
      cursor: pointer; /* Change cursor to pointer */
   }
/*   .hidden{
      display: none;
   }*/
</style>

<body id="page-top">
   <?php include 'includes/notification.php';?>
   <?php
         $site_template = return_single_row("Select * from site_template Where st_id = ".$_GET['id']." $and_gc ");
   ?>
   <div id="wrapper">
   <?php include 'includes/sidebar.php'; ?>
   <div id="content-wrapper">
      <div class="container-fluid">
         <div class="container-fluid">
            <!-- /.Content From Here -fluid -->
            <!-- Page Content -->
            <div id="error_id"></div>
            <div id="page-content-wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12">
                        <form class="needs-validation" onsubmit="return false" novalidate>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Template Name</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="st_name" placeholder="Update Name" name="st_name" value="<?php echo $site_template['st_name'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                              <div class="form-group row">
                                 <label for="colFormLabel" class="col-sm-2 col-form-label">Header</label>
                                 <div class="col-sm-10">
                                    <div class="editor-container">
                                       <textarea class="form-control code-editor" id="st_header" name="st_header" placeholder="Update Site Template Header" spellcheck="false"><?php echo $site_template['st_header']?></textarea>
                                       <button class="btn btn-sm btn-secondary maximize-btn" data-target="st_header">Maximize</button>
                                    </div>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="colFormLabel" class="col-sm-2 col-form-label">Menu</label>
                                 <div class="col-sm-10">
                                    <div class="editor-container">
                                       <textarea class="form-control code-editor" id="st_menue" name="st_menue" placeholder="Update Site Template Menu" spellcheck="false"><?php echo $site_template['st_menue']?></textarea>
                                       <button class="btn btn-sm btn-secondary maximize-btn" data-target="st_menue">Maximize</button>
                                    </div>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="colFormLabel" class="col-sm-2 col-form-label">Footer</label>
                                 <div class="col-sm-10">
                                    <div class="editor-container">
                                       <textarea class="form-control code-editor" id="st_footer" name="st_footer" placeholder="Update Site Template Footer" spellcheck="false"><?php echo $site_template['st_footer']?></textarea>
                                       <button class="btn btn-sm btn-secondary maximize-btn" data-target="st_footer">Maximize</button>
                                    </div>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="colFormLabel" class="col-sm-2 col-form-label">Scripts</label>
                                 <div class="col-sm-10">
                                    <div class="editor-container">
                                       <textarea class="form-control code-editor" id="st_script" name="st_script" placeholder="Update Site Template Script" spellcheck="false"><?php echo $site_template['st_script']?></textarea>
                                       <button class="btn btn-sm btn-secondary maximize-btn" data-target="st_script">Maximize</button>
                                    </div>
                                 </div>
                              </div>
                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='is_active' name="is_active">
                                    <option value="1" <?php if($site_template['isactive'] != 1) echo "selected";?> >YES</option>
                                    <option value="0" <?php if($site_template['isactive'] != 1) echo "selected";?> >NO</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-2" style="float:right;">
                                 <input type="submit" name="submit" class="form-control btn btn-info" value="Submit" id="submit_btn" />
                              </div>
                           </div>
                        </form>
                        <script type="text/javascript">
                           var sitetemp_id = "<?php echo $_GET['id']; ?>";
                        </script>
                        
                        <script type="text/javascript" src="js/site_template/editsite_template.js"></script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->
   </div>
   <!-- /#wrapper -->
   <?php //include 'modals.php';?>
