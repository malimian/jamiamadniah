<?php
require_once 'admin_connect.php';

if (isset($_GET['template_id'])) {
    $template_id = intval(clean($_GET['template_id']));

    // Fetch attributes for the selected template
    $attributes_sql = "SELECT
        pa.*,
        t.tab_name AS tab_display_name,
        t.tab_group,
        (SELECT COUNT(*) FROM page_attribute_values pav
         WHERE pav.attribute_id = pa.id AND pav.page_id IN
         (SELECT pid FROM pages WHERE template_id = $template_id)) AS usage_count
    FROM
        page_attributes pa
    LEFT JOIN
        tab t ON pa.tab_id = t.id
    WHERE
        (pa.template_id = $template_id OR pa.template_id IS NULL)
        AND pa.isactive = 1
        AND pa.soft_delete = 0
    ORDER BY
        t.tab_name ASC,
        pa.section_name ASC,
        pa.sort_order ASC";

    $attributes_result = return_multiple_rows($attributes_sql);    
    $attributes = [];

    if($attributes_result) {
        foreach ($attributes_result as $row) {
            $tab_name = $row['tab_display_name'] ?: 'General';
            $section_name = $row['section_name'] ?: 'Main';
            $attributes[$tab_name][$section_name][] = $row;
        }
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
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">',
        '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>'
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

                <!-- Main Content -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div id="attributes-container" class="form-group">
                            <div id="attribute-list">
                                <!-- Attributes -->
                                <div class="template-attributes-container">
                                    <?php
                                     if (!empty($attributes)) : ?>
                                        <?php foreach ($attributes as $tab_name => $sections) : ?>
                                            <div class="card mb-4">
                                                <div class="card-header bg-light">
                                                    <h5 class="mb-0"><?php echo htmlspecialchars($tab_name); ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <?php foreach ($sections as $section_name => $section_attributes) :
                                                     ?>
                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                            <?php if (count($sections) > 1) : ?>
                                                                <h6 class="text-muted mb-0"><?php echo htmlspecialchars($section_name); ?></h6>
                                                            <?php else : ?>
                                                                <?php if($section_name != 'Main') : ?>
                                                                    <h6 class="text-muted mb-0"><?php echo htmlspecialchars($section_name); ?></h6>
                                                                <?php else : ?>
                                                                    <div></div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                            <button type="button" class="btn btn-success btn-sm add-attribute-to-section"
                                                                    data-template-id="<?php echo $template_id; ?>"
                                                                    data-tab-name="<?php echo htmlspecialchars($tab_name); ?>"
                                                                    data-tab-id="<?php echo $section_attributes[0]['tab_id'] ?? 0; ?>"
                                                                    data-section-name="<?php echo htmlspecialchars($section_name); ?>"
                                                                    data-toggle="modal"
                                                                    data-target="#attributeModal"
                                                                    data-action="add"
                                                                    title="Add New Attribute to <?php echo htmlspecialchars($section_name); ?>">
                                                                <i class="fas fa-plus mr-1"></i> Add New Attribute to <?php echo htmlspecialchars($section_name); ?>
                                                            </button>
                                                        </div>

                                                        <div class="row">
                                                            <?php foreach ($section_attributes as $attribute) : ?>
                                                                <div class="col-md-6 col-lg-4 mb-3">
                                                                    <div class="attribute-card p-3 border rounded">
                                                                        <div class="d-flex justify-content-between align-items-start">
                                                                            <div>
                                                                                <h6 class="mb-1"><?php echo htmlspecialchars($attribute['attribute_label']); ?></h6>
                                                                                <small class="text-muted d-block"><?php echo htmlspecialchars($attribute['attribute_name']); ?></small>

                                                                                <div class="mt-2">
                                                                                    <span class="badge badge-info mr-1"><?php echo htmlspecialchars($attribute['attribute_type']); ?></span>
                                                                                    <?php if ($attribute['is_dynamic']) : ?>
                                                                                        <span class="badge badge-warning">Dynamic</span>
                                                                                    <?php endif; ?>
                                                                                    <?php if ($attribute['usage_count'] > 0) : ?>
                                                                                        <span class="badge badge-secondary ml-1">Used: <?php echo $attribute['usage_count']; ?></span>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>

                                                                            <div class="btn-group btn-group-sm">
                                                                                <button type="button" class="btn btn-outline-primary edit-attribute"
                                                                                        data-id="<?php echo $attribute['id']; ?>"
                                                                                        data-toggle="modal"
                                                                                        data-target="#attributeModal"
                                                                                        data-action="edit"
                                                                                        title="Edit Attribute">
                                                                                    <i class="fas fa-edit"></i>
                                                                                </button>

                                                                                <button type="button" class="btn btn-outline-info attribute-settings"
                                                                                        data-id="<?php echo $attribute['id']; ?>"
                                                                                        title="Advanced Settings">
                                                                                    <i class="fas fa-cog"></i>
                                                                                </button>

                                                                             <?php if ($attribute['usage_count'] == 0) : ?>
                                                                                <button type="button" class="btn btn-outline-danger delete-attribute"
                                                                                        data-id="<?php echo $attribute['id']; ?>"
                                                                                        title="Delete Attribute">
                                                                                    <i class="fas fa-trash-alt"></i>
                                                                                </button>
                                                                            <?php else : ?>
                                                                                <button type="button" class="btn btn-outline-danger delete-attribute-in-use"
                                                                                        data-id="<?php echo $attribute['id']; ?>"
                                                                                        title="Delete Attribute"
                                                                                        data-usage-count="<?php echo $attribute['usage_count']; ?>">
                                                                                    <i class="fas fa-trash-alt"></i>
                                                                                </button>
                                                                            <?php endif; ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="attribute-meta mt-2 small text-muted">
                                                                            <div>Tab: <?php echo htmlspecialchars($tab_name); ?></div>
                                                                            <?php if (count($sections) > 1 || $section_name != 'Main') : ?>
                                                                                <div>Section: <?php echo htmlspecialchars($section_name); ?></div>
                                                                            <?php endif; ?>
                                                                            <div>Order: <?php echo $attribute['sort_order']; ?></div>
                                                                            <div>Code : <?php
                                                                            $code = '$attribute['.($section_attributes[0]['tab_id'] ?? 0).'][\'sections\'][\''.$section_name.'\'][\'attributes\'][\''.$attribute['id'].'\']';
                                                                            echo $code ;
                                                                            ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <!-- Default view when no attributes exist -->
                                        <div class="card mb-4">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">General</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h6 class="text-muted mb-0">Main</h6>
                                                    <button type="button" class="btn btn-success btn-sm add-attribute-to-section"
                                                            data-template-id="<?php echo $template_id; ?>"
                                                            data-tab-name="General"
                                                            data-section-name="Main"
                                                            data-toggle="modal"
                                                            data-target="#attributeModal"
                                                            data-action="add"
                                                            title="Add New Attribute to Main">
                                                        <i class="fas fa-plus mr-1"></i> Add New Attribute
                                                    </button>
                                                </div>
                                                <div class="alert alert-info">No attributes found for this section. Click the button above to add one.</div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Unified Attribute Modal (for both add and edit) -->
            <div class="modal fade" id="attributeModal" tabindex="-1" role="dialog" aria-labelledby="attributeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="attributeModalLabel">Add New Attribute</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="post/template_attributes/save_attribute.php" id="attribute-form" class="needs-validation" novalidate>
                            <input type="hidden" name="action" id="form-action" value="add">
                            <input type="hidden" name="attribute_id" id="attribute_id" value="">
                            <input type="hidden" name="template_id" value="<?php echo $template_id; ?>">
                            
                            <div class="modal-body">
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
                                                        <option value="<?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>">
                                                            <?php echo ucfirst(htmlspecialchars($type, ENT_QUOTES, 'UTF-8')); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="is_dynamic" class="col-md-3 col-form-label">Dynamic Attribute:</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="is_dynamic" id="is_dynamic">
                                                    <option value="0">No (Single Value)</option>
                                                    <option value="1">Yes (Multiple Values)</option>
                                                </select>
                                                <small class="form-text text-muted">
                                                    Dynamic attributes can have multiple values/sets
                                                </small>
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
                                                <!-- Options will be added here dynamically -->
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
                                                    <select class="form-control" name="tab_id" id="tab_name">
                                                        <option value="">-- Select Existing Tab --</option>
                                                        <?php 
                                                        // Get existing tabs from database
                                                        $tabs_sql = "SELECT DISTINCT tab_name , id FROM tab WHERE tab_name IS NOT NULL AND tab_name != '' and template_id = ".$template_id." ORDER BY tab_name " ;
                                                        $tabs_result = return_multiple_rows($tabs_sql);
                                                        if ($tabs_result) {
                                                            foreach ($tabs_result as $tab) {
                                                                echo '<option value="'.htmlspecialchars($tab['id'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($tab['tab_name'], ENT_QUOTES, 'UTF-8').'</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <small class="form-text text-muted">
                                                    Group attributes under tabs in the editor. Leave blank for default section.
                                                </small>
                                            </div>
                                        </div>

                                    <!-- Section Grouping -->
                                      <div class="form-group row">
                                                <label for="section_name" class="col-md-3 col-form-label">Section Name:</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <select class="form-control" name="section_name" id="section_name">
                                                            <option value="">-- Select Existing Section --</option>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">OR</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="new_section_name" placeholder="Create New Section">
                                                    </div>
                                                    <small class="form-text text-muted">
                                                        Group attributes within sections in the editor. Leave blank for default section.
                                                    </small>
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
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Attribute</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
           
            <?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <script type="text/javascript" src="js/template_attributes/template_attributes.js"></script>

</body>
</html>