<?php
require_once 'admin_connect.php';

// Get active templates
$templates = [];
try {
    $templates_sql = "SELECT template_id, template_title 
                     FROM og_template 
                     WHERE isactive = 1 AND soft_delete = 0 
                     ORDER BY template_title ASC";
    $templates_result = return_multiple_rows($templates_sql);
    
    if ($templates_result) {
        foreach ($templates_result as $row) {
            $templates[$row['template_id']] = htmlspecialchars($row['template_title'], ENT_QUOTES, 'UTF-8');
        }
    }
} catch (Exception $e) {
    error_log("Template fetch error: " . $e->getMessage());
    $_SESSION['error_message'] = "Error loading templates. Please try again.";
}

// Get ENUM values for attribute_type
$enum_values = [];
try {
    $enum_sql = "SHOW COLUMNS FROM page_attributes WHERE Field = 'attribute_type'";
    $enum_result = return_single_row($enum_sql);
    
    if ($enum_result && isset($enum_result['Type'])) {
        preg_match("/^enum\((.*)\)$/", $enum_result['Type'], $matches);
        if (isset($matches[1])) {
            $enum_values_raw = str_getcsv($matches[1], ',', "'");
            $enum_values = array_map('trim', $enum_values_raw);
        }
    }
} catch (Exception $e) {
    error_log("ENUM values fetch error: " . $e->getMessage());
}

// Additional CSS/JS libraries
$extra_libs = [

];

// Include admin header
AdminHeader("Manage Page Template Attributes", "", $extra_libs);
?>

<body id="page-top">
    <?php include 'includes/notification.php'; ?>
    
    <div id="wrapper">
        <?php include 'includes/sidebar.php'; ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div class="container-fluid">
                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo htmlspecialchars($_SESSION['user']['dashboard'], ENT_QUOTES, 'UTF-8'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Template Attributes</li>
                    </ol>
                </nav>

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Template Attribute Management</h1>
                </div>
                
                <hr>

                <!-- Notification Messages -->
                <?php if (isset($_SESSION['success_message'])) : ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?php echo htmlspecialchars($_SESSION['success_message'], ENT_QUOTES, 'UTF-8'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?php echo htmlspecialchars($_SESSION['error_message'], ENT_QUOTES, 'UTF-8'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="attributeTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="assign-tab" data-toggle="tab" href="#assign" role="tab" aria-controls="assign" aria-selected="true">
                            <i class="fas fa-tasks mr-1"></i> Assign to Template
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="create-tab" data-toggle="tab" href="#create" role="tab" aria-controls="create" aria-selected="false">
                            <i class="fas fa-plus-circle mr-1"></i> Create New Attribute
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content border-left border-right border-bottom bg-white p-4" id="attributeTabsContent">
                    <!-- Assign Tab -->
                    <div class="tab-pane fade show active" id="assign" role="tabpanel" aria-labelledby="assign-tab">
                        <form method="post" action="process_assign_attributes.php" id="assign-attributes-form">
                            <div class="form-group row">
                                <label for="template_id" class="col-md-3 col-form-label">Select Template:</label>
                                <div class="col-md-9">
                                    <select class="form-control selectpicker" id="template_id" name="template_id" data-live-search="true" required>
                                        <option value="">-- Select a Template --</option>
                                        <?php foreach ($templates as $id => $title): ?>
                                            <option value="<?= (int)$id ?>"><?= $title ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div id="attributes-container" class="form-group">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Template Attributes</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="attribute-list-placeholder" class="text-muted">
                                            Please select a template to view and manage its attributes.
                                        </div>
                                        <div id="attribute-list" class="d-none">
                                            <!-- Dynamic content will be loaded here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" name="assign_attributes">
                                    <i class="fas fa-save mr-1"></i> Save Assignments
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Create Attributes Tab -->
                    <div class="tab-pane fade pt-3" id="create" role="tabpanel">
                      <form method="post" action="save_new_attribute.php" id="create-attribute-form" class="needs-validation" novalidate>
                        <!-- Basic Attribute Info -->
                        <div class="card mb-4">
                          <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Basic Information</h5>
                          </div>
                          <div class="card-body">
                            <div class="form-group row">
                              <label for="attribute_name" class="col-md-3 col-form-label">Attribute Name:</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control" name="attribute_name" id="attribute_name" 
                                       pattern="[a-zA-Z0-9_\-]+" required>
                                <small class="form-text text-muted">
                                  Only letters, numbers, underscores and hyphens allowed (no spaces)
                                </small>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="attribute_label" class="col-md-3 col-form-label">Attribute Label:</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control" name="attribute_label" id="attribute_label" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="attribute_type" class="col-md-3 col-form-label">Attribute Type:</label>
                              <div class="col-md-9">
                                <select class="form-control" name="attribute_type" id="attribute_type" required>
                                  <option value="">-- Select Type --</option>
                                  <?php foreach ($enum_values as $type): ?>
                                    <option value="<?= htmlspecialchars($type, ENT_QUOTES, 'UTF-8') ?>">
                                      <?= ucfirst(htmlspecialchars($type, ENT_QUOTES, 'UTF-8')) ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="icon_class" class="col-md-3 col-form-label">Icon Class:</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control" name="icon_class" id="icon_class" 
                                       placeholder="e.g., fas fa-home">
                                <small class="form-text text-muted">
                                  Optional Font Awesome or other icon class
                                </small>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Attribute Options Section (for select type) -->
                        <div class="card mb-4" id="select-options-section" style="display:none;">
                          <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Select Options</h5>
                          </div>
                          <div class="card-body">
                            <div class="form-group">
                              <label>Add Options for Select/Dropdown</label>
                              <div id="option-container">
                                <div class="option-row form-row mb-2">
                                  <div class="col">
                                    <input type="text" class="form-control" name="option_label[]" placeholder="Display Label" required>
                                  </div>
                                  <div class="col">
                                    <input type="text" class="form-control" name="option_value[]" placeholder="Stored Value" required>
                                  </div>
                                  <div class="col-auto">
                                    <button type="button" class="btn btn-danger remove-option" disabled>
                                      <i class="fas fa-times"></i>
                                    </button>
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn btn-secondary mt-2" id="add-option">
                                <i class="fas fa-plus mr-1"></i> Add Option
                              </button>
                            </div>
                          </div>
                        </div>

                                <!-- Tab Grouping Section -->
                                <div class="card mb-4">
                                  <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0">Tab Grouping (Optional)</h5>
                                  </div>
                                  <div class="card-body">
                                    <div class="form-group row">
                                      <label for="tab_name" class="col-md-3 col-form-label">Tab Name:</label>
                                      <div class="col-md-9">
                                        <div class="input-group">
                                          <select class="form-control" name="tab_name" id="tab_name">
                                            <option value="">-- Select Existing Tab --</option>
                                            <?php 
                                            // Get existing tabs from database
                                            $tabs_sql = "SELECT DISTINCT tab_name FROM page_attributes WHERE tab_name IS NOT NULL AND tab_name != ''";
                                            $tabs_result = return_multiple_rows($tabs_sql);
                                            if ($tabs_result) {
                                              foreach ($tabs_result as $tab) {
                                                echo '<option value="'.htmlspecialchars($tab['tab_name'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($tab['tab_name'], ENT_QUOTES, 'UTF-8').'</option>';
                                              }
                                            }
                                            ?>
                                          </select>
                                          <div class="input-group-append">
                                            <span class="input-group-text">OR</span>
                                          </div>
                                          <input type="text" class="form-control" id="new_tab_name" placeholder="Create New Tab">
                                        </div>
                                        <small class="form-text text-muted">
                                          Group attributes under tabs in the editor. Leave blank for default section.
                                        </small>
                                        <input type="hidden" name="tab_group" id="tab_group">
                                      </div>
                                    </div>
                                  </div>
                                </div>

            <!-- Additional Settings -->
            <div class="card mb-4">
              <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Additional Settings</h5>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="default_value" class="col-md-3 col-form-label">Default Value:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="default_value" id="default_value">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="is_required" class="col-md-3 col-form-label">Is Required?</label>
                  <div class="col-md-9">
                    <select class="form-control" name="is_required" id="is_required">
                      <option value="0">No</option>
                      <option value="1">Yes</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="sort_order" class="col-md-3 col-form-label">Sort Order:</label>
                  <div class="col-md-9">
                    <input type="number" class="form-control" name="sort_order" id="sort_order" value="0" min="0">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group text-right">
              <button type="reset" class="btn btn-secondary mr-2">
                <i class="fas fa-undo mr-1"></i> Reset Form
              </button>
              <button type="submit" class="btn btn-success">
                <i class="fas fa-check mr-1"></i> Create Attribute
              </button>
            </div>
          </form>
        </div>

                </div>
            </div>
            
            <?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- JavaScript -->
    <script>
    $(document).ready(function() {
   
             // Tab name handling
          $('#tab_name, #new_tab_name').change(function() {
            let tabName = $('#new_tab_name').val() || $('#tab_name').val();
            if (tabName) {
              // Generate tab_group - lowercase, no spaces, underscores for spaces
              let tabGroup = tabName.toLowerCase()
                                  .replace(/\s+/g, '_')
                                  .replace(/[^a-z0-9_]/g, '');
              $('#tab_group').val(tabGroup);
            } else {
              $('#tab_group').val('');
            }
          });

          // When typing in new tab name, clear the select
          $('#new_tab_name').on('input', function() {
            if ($(this).val()) {
              $('#tab_name').val('');
            }
          });

          // When selecting from dropdown, clear the new tab input
          $('#tab_name').change(function() {
            if ($(this).val()) {
              $('#new_tab_name').val('');
            }
          });



        // Template change - fetch attributes
        $('#template_id').change(function() {
            const templateId = $(this).val();
            if (templateId) {
                $('#attribute-list-placeholder').addClass('d-none');
                $('#attribute-list').removeClass('d-none').html(`
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2">Loading attributes...</p>
                    </div>
                `);
                
                $.ajax({
                    url: 'get/page_attributes/get_template_attributes.php',
                    type: 'POST',
                    dataType: 'html',
                    data: { 
                        template_id: templateId,
                        csrf_token: '<?= $_SESSION['csrf_token'] ?? '' ?>'
                    },
                    success: function(result) {
                        $('#attribute-list').html(result);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('#attribute-list').html(`
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Error loading attributes. Please try again.
                            </div>
                        `);
                    }
                });
            } else {
                $('#attribute-list-placeholder').removeClass('d-none');
                $('#attribute-list').addClass('d-none').html('');
            }
        });

        // Toggle select options section
        $('#attribute_type').change(function() {
            if ($(this).val() === 'select') {
                $('#select-options-section').removeClass('d-none');
                // Ensure at least one option row exists
                if ($('.option-row').length === 0) {
                    addOptionRow();
                }
            } else {
                $('#select-options-section').addClass('d-none');
            }
        });

        // Add new option row
        $('#add-option').click(addOptionRow);

        // Remove option row
        $(document).on('click', '.remove-option:not(:disabled)', function() {
            $(this).closest('.option-row').remove();
            // Ensure at least one row remains
            if ($('.option-row').length === 0) {
                addOptionRow();
            }
        });

        function addOptionRow() {
            const row = `
                <div class="form-row mb-2 option-row">
                    <div class="col">
                        <input type="text" class="form-control" name="option_label[]" placeholder="Option Label" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="option_value[]" placeholder="Option Value" required>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger remove-option">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>`;
            $('#option-container').append(row);
            
            // Disable remove button if only one row exists
            if ($('.option-row').length === 1) {
                $('.remove-option').prop('disabled', true);
            } else {
                $('.remove-option').prop('disabled', false);
            }
        }

        // Form submission handling
        $('#create-attribute-form').submit(function(e) {
            if ($('#attribute_type').val() === 'select') {
                // Validate select options
                let valid = true;
                $('.option-row').each(function() {
                    const label = $(this).find('input[name="option_label[]"]').val();
                    const value = $(this).find('input[name="option_value[]"]').val();
                    
                    if (!label || !value) {
                        valid = false;
                        $(this).addClass('border border-danger');
                    } else {
                        $(this).removeClass('border border-danger');
                    }
                });
                
                if (!valid) {
                    e.preventDefault();
                    alert('Please fill in all option fields for select type attribute.');
                    return false;
                }
            }
            return true;
        });
    });
    </script>


    <script>
$(document).ready(function() {
  // Toggle select options section when attribute type changes
  $('#attribute_type').change(function() {
    if ($(this).val() === 'select') {
      $('#select-options-section').show();
      // Ensure at least one option exists
      if ($('.option-row').length === 0) {
        addOptionRow();
      }
    } else {
      $('#select-options-section').hide();
    }
  });

  // Add new option row
  $('#add-option').click(addOptionRow);

  function addOptionRow() {
    const row = `
      <div class="option-row form-row mb-2">
        <div class="col">
          <input type="text" class="form-control" name="option_label[]" placeholder="Display Label" required>
        </div>
        <div class="col">
          <input type="text" class="form-control" name="option_value[]" placeholder="Stored Value" required>
        </div>
        <div class="col-auto">
          <button type="button" class="btn btn-danger remove-option">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>`;
    $('#option-container').append(row);
    
    // Enable all remove buttons except if it's the only one
    $('.remove-option').prop('disabled', $('.option-row').length === 1);
  }

  // Remove option row
  $(document).on('click', '.remove-option', function() {
    $(this).closest('.option-row').remove();
    // Disable remove button if only one row left
    $('.remove-option').prop('disabled', $('.option-row').length === 1);
  });

  // Tab name handling
  $('#tab_name, #new_tab_name').change(function() {
    let tabName = $('#new_tab_name').val() || $('#tab_name').val();
    if (tabName) {
      // Generate tab_group - lowercase, no spaces, underscores for spaces
      let tabGroup = tabName.toLowerCase()
                          .replace(/\s+/g, '_')
                          .replace(/[^a-z0-9_]/g, '');
      $('#tab_group').val(tabGroup);
    } else {
      $('#tab_group').val('');
    }
  });

  // When typing in new tab name, clear the select
  $('#new_tab_name').on('input', function() {
    if ($(this).val()) {
      $('#tab_name').val('');
    }
  });

  // When selecting from dropdown, clear the new tab input
  $('#tab_name').change(function() {
    if ($(this).val()) {
      $('#new_tab_name').val('');
    }
  });
});
</script>