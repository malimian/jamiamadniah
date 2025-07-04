<!-- Enhanced Page Modal with Duplicate Support -->
<div class="modal fade" id="addPageModal" tabindex="-1" role="dialog" aria-labelledby="addPageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addPageModalLabel" data-default-title="Add New Page" data-duplicate-title="Duplicate Page - ">
                    Add New Page
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="message" class="mb-3"></div>
                
                <!-- Status Indicator for Duplicate Mode -->
                <div id="duplicateIndicator" class="alert alert-info d-none">
                    <i class="fas fa-copy mr-2"></i> You are creating a copy of: <strong id="originalPageTitle"></strong>
                </div>
                
                <form id="addPageForm" class="needs-validation" novalidate>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-fill mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#modalDescriptionTab">
                                <i class="fa fa-file-text mr-2"></i>Description
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#modalTemplateTab">
                                <i class="fa fa-code mr-2"></i>Template Settings
                            </a>
                        </li>
                        <li class="nav-item d-none" id="duplicateOptionsTab">
                            <a class="nav-link" data-toggle="tab" href="#modalDuplicateOptionsTab">
                                <i class="fas fa-clone mr-2"></i>Duplicate Options
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Description Tab Content -->
                        <div id="modalDescriptionTab" class="container tab-pane active">
                            <!-- Title -->
                            <div class="form-group row mt-3">
                                <label for="modalPageTitle" class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="modalPageTitle" required placeholder="Enter Page title" name="page_title">
                                    <small class="form-text text-muted">For duplicates, "(Copy)" will be automatically added</small>
                                    <div class="invalid-feedback">Please provide a page title.</div>
                                </div>
                            </div>

                           <div class="form-group row">
                                <label for="modalCtname" class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="modalCtname" required name="ctname">
                                        <?php 
                                        // Get all active categories ordered by ParentCategory and sequence
                                        $allCategories = return_multiple_rows("
                                            SELECT catid, catname, ParentCategory, cat_sequence 
                                            FROM category 
                                            WHERE soft_delete = 0 
                                            AND isactive = 1
                                            ORDER BY ParentCategory, cat_sequence, catname
                                        ");
                                        
                                        // Organize categories into parent-child structure
                                        $categoryTree = [];
                                        foreach ($allCategories as $category) {
                                            $parentId = (int)$category['ParentCategory'];
                                            if (!isset($categoryTree[$parentId])) {
                                                $categoryTree[$parentId] = [];
                                            }
                                            $categoryTree[$parentId][] = $category;
                                        }
                                        
                                        
                                        // Start building from root categories (ParentCategory = 0)
                                        buildCategoryOptions(0, $categoryTree);
                                        
                                        // Handle any orphaned categories (just in case)
                                        foreach ($allCategories as $category) {
                                            $parentId = (int)$category['ParentCategory'];
                                            $catId = (int)$category['catid'];
                                            if ($parentId != 0 && !isset($categoryTree[$parentId])) {
                                                $catName = htmlspecialchars($category['catname'], ENT_QUOTES, 'UTF-8');
                                                echo "<option value='{$catId}' style='color:#dc3545'>[Orphaned] {$catName}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- URL -->
                            <div class="form-group row">
                                <label for="modalPageUrl" class="col-sm-2 col-form-label">URL <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="modalPageUrl" required placeholder="Page URL" name="page_url">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.html</span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Automatically generated from title</small>
                                </div>
                                <div class="col-sm-2 d-flex align-items-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="modalCheckUrl">
                                        <label class="custom-control-label" for="modalCheckUrl">Lock URL</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Featured Image -->
                            <div class="form-group row">
                                <label for="modalPImage" class="col-sm-2 col-form-label">Featured Image</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="modalPImage" placeholder="Image path or URL" name="p_image">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" onclick="OpenMediaGallery('modalPImage', 'page')" type="button">
                                                <i class="fa fa-picture-o mr-1"></i>Browse
                                            </button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Recommended size: 1200x630px</small>
                                </div>
                            </div>
                        </div>

                        <!-- TEMPLATE Tab Content -->
                        <div id="modalTemplateTab" class="container tab-pane fade">
                            <!-- Main Template -->
                            <div class="form-group row mt-3">
                                <label for="modalSiteTemplate" class="col-sm-2 col-form-label">Main Template <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="modalSiteTemplate" required name="site_template">
                                        <?php
                                        $site_templates = return_multiple_rows("SELECT st_id, st_name FROM site_template Where soft_delete = 0  AND isactive = 1");
                                        foreach ($site_templates as $site_template) {
                                            echo "<option value='{$site_template['st_id']}'>{$site_template['st_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Template Page -->
                            <div class="form-group row">
                                <label for="modalTemplatePage" class="col-sm-2 col-form-label">Template Page <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="modalTemplatePage" required name="template_page">
                                        <?php
                                        $og_templates = return_multiple_rows("SELECT template_title, template_id FROM og_template Where soft_delete = 0  AND isactive = 1");
                                        foreach ($og_templates as $og_template) {
                                            echo "<option value='{$og_template['template_id']}'>{$og_template['template_title']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- DUPLICATE OPTIONS Tab Content -->
                        <div id="modalDuplicateOptionsTab" class="container tab-pane fade">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle mr-2"></i> Select which elements you want to copy from the original page.
                            </div>
                            
                            <!-- Media Files Options -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="fas fa-images mr-2"></i>Media Files
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="copyAllMedia" name="copy_all_media" checked>
                                            <label class="custom-control-label" for="copyAllMedia">Copy all media files</label>
                                        </div>
                                    </div>
                                    
                                    <div class="pl-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="copyImages" name="copy_images" checked>
                                                <label class="custom-control-label" for="copyImages">Copy images</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="copyVideos" name="copy_videos" checked>
                                                <label class="custom-control-label" for="copyVideos">Copy videos</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="copyDocuments" name="copy_documents" checked>
                                                <label class="custom-control-label" for="copyDocuments">Copy documents/files</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Addons Options -->
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="fas fa-puzzle-piece mr-2"></i>Addons & Modules
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="copyAddons" name="copy_addons" checked>
                                            <label class="custom-control-label" for="copyAddons">Copy all addons/modules</label>
                                        </div>
                                        <small class="form-text text-muted">This includes all associated addon data and settings</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Close
                </button>
                <button type="button" class="btn btn-primary" id="modalSaveAndStay">
                    <i class="fas fa-save mr-1"></i> Save & Stay
                </button>
                <button type="button" class="btn btn-success" id="modalSaveAndEdit">
                    <i class="fas fa-edit mr-1"></i> Save & Edit
                </button>
            </div>
        </div> 
    </div>
</div>

<script type="text/javascript" src="js/modules/page/add_page.js"></script>