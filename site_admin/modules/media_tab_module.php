<!-- Tab Navigation for Media -->
<ul class="nav nav-tabs" id="mediaTabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="images-tab" data-toggle="tab" href="#page-images" role="tab" aria-controls="page-images" aria-selected="true">
            <i class="fa fa-picture-o"></i> Images
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="videos-tab" data-toggle="tab" href="#page-videos" role="tab" aria-controls="page-videos" aria-selected="false">
            <i class="fa fa-video-camera"></i> Videos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="files-tab" data-toggle="tab" href="#tab-page-files" role="tab" aria-controls="tab-page-files" aria-selected="false">
            <i class="fa fa-file"></i> Files
        </a>
    </li>
</ul>

<!-- Tab Content for Media -->
<div class="tab-content" id="mediaTabsContent">
    <!-- Images Tab -->
    <div class="tab-pane fade show active" id="page-images" role="tabpanel" aria-labelledby="images-tab">
        <!-- File Input with Custom Styling -->
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="images" name="images[]" multiple>
            <label class="custom-file-label" for="images"><i class="fa fa-upload"></i> Choose Images</label>
        </div>

        <?php
        $photogallery = return_multiple_rows("SELECT * FROM images WHERE pid = " . $page[0]['pid'] . " AND isactive = 1 AND soft_delete = 0");
        if (!empty($photogallery)) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"><i class="fa fa-image"></i> Image</th>
                            <th scope="col"><i class="fa fa-file"></i> Name</th>
                            <th scope="col"><i class="fa fa-trash"></i> Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($photogallery as $photogallery_) {
                        ?>
                            <tr id="dr_<?php echo $photogallery_['i_id']; ?>">
                                <td class="w-25">
                                    <img src="<?php echo "../" . ABSOLUTE_IMAGEPATH . $photogallery_['i_name']; ?>" class="img-fluid img-thumbnail" alt="Image">
                                </td>
                                <td><?php echo $photogallery_['i_name']; ?></td>
                                <td>
                                    <button onclick="delete_image(<?php echo $photogallery_['i_id']; ?>)" class="btn btn-danger btn-sm rounded-0" type="button" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>

    <!-- Videos Tab -->
    <div class="tab-pane fade" id="page-videos" role="tabpanel" aria-labelledby="videos-tab">
        <!-- File Input with Custom Styling -->
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="videos" name="videos[]" multiple>
            <label class="custom-file-label" for="videos"><i class="fa fa-upload"></i> Choose Videos</label>
        </div>

        <?php
        $videogallery = return_multiple_rows("SELECT * FROM videos WHERE pid = " . $page[0]['pid'] . " AND isactive = 1 AND soft_delete = 0");
        if (!empty($videogallery)) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"><i class="fa fa-video-camera"></i> Video</th>
                            <th scope="col"><i class="fa fa-file"></i> Name</th>
                            <th scope="col"><i class="fa fa-trash"></i> Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($videogallery as $videogallery_) {
                        ?>
                            <tr id="dr_<?php echo $videogallery_['v_id']; ?>">
                                <td class="w-25">
                                    <video width="150" height="150" controls>
                                        <source src="<?php echo "../" . ABSOLUTE_VIDEOPATH . $videogallery_['v_name']; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </td>
                                <td><?php echo $videogallery_['v_name']; ?></td>
                                <td>
                                    <button onclick="delete_video(<?php echo $videogallery_['v_id']; ?>)" class="btn btn-danger btn-sm rounded-0" type="button" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>

    <!-- Files Tab -->
    <div class="tab-pane fade" id="tab-page-files" role="tabpanel" aria-labelledby="files-tab">
        <!-- File Input with Custom Styling -->
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="page_files" name="page_files[]" multiple>
            <label class="custom-file-label" for="page_files"><i class="fa fa-upload"></i> Choose Files</label>
        </div>

        <?php
        $filegallery = return_multiple_rows("SELECT * FROM page_files WHERE pid = " . $page[0]['pid'] . " AND isactive = 1 AND soft_delete = 0");
        if (!empty($filegallery)) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"><i class="fa fa-file"></i> File</th>
                            <th scope="col"><i class="fa fa-file"></i> Name</th>
                            <th scope="col"><i class="fa fa-trash"></i> Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($filegallery as $filegallery_) {
                        ?>
                            <tr id="dr_<?php echo $filegallery_['f_id']; ?>">
                                <td class="w-25">
                                    <a href="<?php echo "../" . ABSOLUTE_FILEPATH . $filegallery_['f_name']; ?>" target="_blank" class="btn btn-primary btn-sm">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                                <td><?php echo $filegallery_['f_name']; ?></td>
                                <td>
                                    <button onclick="delete_file(<?php echo $filegallery_['f_id']; ?>)" class="btn btn-danger btn-sm rounded-0" type="button" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Custom CSS for File Input and Tables -->
<style>
    /* Custom File Input */
    .custom-file-input {
        opacity: 1;
        position: absolute;
        z-index: 2;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        margin: 0;
        overflow: hidden;
    }

    .custom-file-label {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .custom-file-label::after {
        content: "Browse";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 3;
        display: block;
        height: calc(1.5em + 0.75rem);
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        color: #fff;
        background-color: #007bff;
        border-left: 1px solid #ced4da;
        border-radius: 0 0.25rem 0.25rem 0;
    }

    /* Table Styling */
    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }
</style>