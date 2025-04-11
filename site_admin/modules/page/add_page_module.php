<!-- New Page Modal -->
<div class="modal fade" id="addPageModal" tabindex="-1" role="dialog" aria-labelledby="addPageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPageModalLabel" data-default-title="Add New Page">Add New Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="message"></div>
                <form id="addPageForm" class="needs-validation" novalidate>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#modalDescriptionTab">
                                <i class="fa fa-file-text"></i> Description
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#modalTemplateTab">
                                <i class="fa fa-code"></i> TEMPLATE
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Description Tab Content -->
                        <div id="modalDescriptionTab" class="container tab-pane active">
                            <!-- Title -->
                            <div class="form-group row mt-3">
                                <label for="modalPageTitle" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="modalPageTitle" required placeholder="Enter Page title" name="page_title">
                                    <div class="invalid-feedback">Please provide a page title.</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="modalCtname" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="modalCtname" required name="ctname">
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
                                <label for="modalPageUrl" class="col-sm-2 col-form-label">URL</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="modalPageUrl" required placeholder="Page URL" name="page_url">
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" class="form-control minecheck" id="modalCheckUrl" />
                                </div>
                            </div>

                            <!-- Featured Image -->
                            <div class="form-group row">
                                <label for="modalPImage" class="col-sm-2 col-form-label">Featured Image</label>
                                <div class="col-sm-10">
                                    <div class="form-inline">
                                        <input type="text" class="form-control col-sm-10" id="modalPImage" placeholder="Choose Image" name="p_image">
                                        <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('modalPImage', 'page')" type="button">
                                            <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-primary btn-block" id="modalSaveAndStay">Save & Stay</button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-success btn-block" id="modalSaveAndEdit">Save & Edit</button>
                                </div>
                            </div>
                        </div>

                        <!-- TEMPLATE Tab Content -->
                        <div id="modalTemplateTab" class="container tab-pane fade">
                            <!-- Main Template -->
                            <div class="form-group row mt-3">
                                <label for="modalSiteTemplate" class="col-sm-2 col-form-label">Main Template</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="modalSiteTemplate" required name="site_template">
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
                                <label for="modalTemplatePage" class="col-sm-2 col-form-label">Template Page</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="modalTemplatePage" required name="template_page">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/modules/page/add_page.js"></script>
<!-- New Page Modal -->