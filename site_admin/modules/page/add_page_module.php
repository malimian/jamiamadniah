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
                                    <select class="form-control select2" id="modalCtname" required name="ctname">
                                        <?php 
                                        $categories = return_multiple_rows("SELECT catname, catid FROM category $where_gc AND isactive = 1");
                                        foreach ($categories as $category) {
                                            $catname = htmlspecialchars($category['catname'], ENT_QUOTES, 'UTF-8');
                                            $catid = (int)$category['catid'];
                                            echo "<option value='{$catid}'>{$catname}</option>";
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
                                        $site_templates = return_multiple_rows("SELECT st_id, st_name FROM site_template $where_gc AND isactive = 1");
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
                                        $og_templates = return_multiple_rows("SELECT template_title, template_id FROM og_template $where_gc AND isactive = 1");
                                        foreach ($og_templates as $og_template) {
                                            echo "<option value='{$og_template['template_id']}'>{$og_template['template_title']}</option>";
                                        }
                                        ?>
                                    </select>
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
<!-- New Page Modal -->