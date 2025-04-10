<style type="text/css">
.media-container {
    position: relative;
    margin-bottom: 15px;
}

.video-thumbnail {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 120px;
    background: white;
    padding: 5px;
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
}

.video-thumbnail img {
    max-width: 100%;
    height: auto;
}
</style>
<?php 
// Initialize variables
$media_id = isset($_GET['media_id']) ? $_GET['media_id'] : null;
$media_action = isset($_GET['media_action']) ? $_GET['media_action'] : null;
$media_type = isset($_GET['media_type']) ? $_GET['media_type'] : null;

// Fetch media data if in edit mode
$edit_data = null;
if ($media_id && $media_action == 'edit' && $media_type) {
    switch($media_type) {
        case 'image':
            $edit_data = return_single_row("SELECT * FROM images WHERE i_id = " . $media_id);
            break;
        case 'video':
            $edit_data = return_single_row("SELECT * FROM videos WHERE v_id = " . $media_id);
            break;
        case 'file':
            $edit_data = return_single_row("SELECT * FROM page_files WHERE f_id = " . $media_id);
            break;
    }
}
?>

<!-- Tab Navigation for Media -->
<ul class="nav nav-tabs" id="mediaTabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link <?php echo (!$media_type || $media_type == 'image') ? 'active' : ''; ?>" id="image-tab" data-toggle="tab" href="#page-images" role="tab" aria-controls="page-images" aria-selected="<?php echo (!$media_type || $media_type == 'image') ? 'true' : 'false'; ?>">
            <i class="fa fa-picture-o"></i> Images
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($media_type == 'video') ? 'active iambutasgoo' : ''; ?>" id="video-tab" data-toggle="tab" href="#page-videos" role="tab" aria-controls="page-videos" aria-selected="<?php echo ($media_type == 'video') ? 'true' : 'false'; ?>">
            <i class="fa fa-video-camera"></i> Videos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($media_type == 'file') ? 'active' : ''; ?>" id="file-tab" data-toggle="tab" href="#tab-page-files" role="tab" aria-controls="tab-page-files" aria-selected="<?php echo ($media_type == 'file') ? 'true' : 'false'; ?>">
            <i class="fa fa-file"></i> Files
        </a>
    </li>
</ul>

<!-- Tab Content for Media -->
<div class="tab-content" id="mediaTabsContent">
    <!-- Images Tab -->
    <div class="tab-pane fade <?php echo (!$media_type || $media_type == 'image') ? 'show active' : ''; ?>" id="page-images" role="tabpanel" aria-labelledby="images-tab">
        <?php if ($media_type == 'image' && $edit_data): ?>
        <div class="card mb-3">
            <div class="card-header">
                <h6>Current Image</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo "../" . ABSOLUTE_IMAGEPATH . $edit_data['i_name']; ?>" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        <table class="table table-sm">
                            <tr>
                                <th width="30%">Filename:</th>
                                <td><?php echo htmlspecialchars($edit_data['i_name']); ?></td>
                            </tr>
                            <tr>
                                <th>Uploaded:</th>
                                <td><?php echo date('M d, Y H:i', strtotime($edit_data['createdon'])); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="custom-file mb-3">
            <input type="file" accept="image/*" class="custom-file-input" id="images" name="images[]" <?php echo ($media_type == 'image' && $edit_data) ? '' : 'multiple'; ?>>
            <label class="custom-file-label" for="images">
                <i class="fa fa-upload"></i> 
                <?php if ($media_type == 'image' && $edit_data): ?>
                Replace Image (Current: <?php echo htmlspecialchars($edit_data['i_name']); ?>)
                <?php else: ?>
                Choose Images
                <?php endif; ?>
            </label>
        </div>
        
        <!-- Add image metadata fields -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="image_title">Image Title</label>
                <input type="text" class="form-control" id="image_title" placeholder="Enter image title" value="<?php echo ($media_type == 'image' && $edit_data) ? htmlspecialchars($edit_data['i_title']) : ''; ?>">
            </div>
            <div class="col-md-6">
                <label for="image_caption">Caption</label>
                <input type="text" class="form-control" id="image_caption" placeholder="Enter caption" value="<?php echo ($media_type == 'image' && $edit_data) ? htmlspecialchars($edit_data['i_caption']) : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="image_alttext">Alt Text</label>
                <input type="text" class="form-control" id="image_alttext" placeholder="Enter alt text" value="<?php echo ($media_type == 'image' && $edit_data) ? htmlspecialchars($edit_data['i_alttext']) : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="image_description">Description</label>
                <textarea class="form-control" id="image_description" rows="3" placeholder="Enter description"><?php echo ($media_type == 'image' && $edit_data) ? htmlspecialchars($edit_data['i_description']) : ''; ?></textarea>
            </div>
        </div>
        
        <!-- Add Save/Update Images Buttons -->
        <div class="row mb-4">
            <div class="col-md-12">
                <?php if ($media_type == 'image' && $edit_data): ?>
                <input type="hidden" id="edit_image_id" value="<?php echo $media_id; ?>">
                <button id="updateImageBtn" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update Image
                </button>
                <a href="?id=<?php echo $page[0]['pid']; ?>&media_type=<?php echo $media_type;?>" class="btn btn-secondary">Cancel</a>
                <?php else: ?>
                <button id="saveImagesBtn" class="btn btn-success">
                    <i class="fa fa-save"></i> Save New Images
                </button>
                <?php endif; ?>
            </div>
        </div>

      <?php
$photogallery = return_multiple_rows("SELECT * FROM images WHERE pid = " . $page[0]['pid'] . " AND soft_delete = 0 ORDER by i_sequence ASC");

if (!empty($photogallery)) {
    foreach ($photogallery as $photogallery_) {
?>
        <div class="card mb-3" id="dr_<?php echo $photogallery_['i_id']; ?>">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <!-- Image column (25% width) -->
                    <div class="col-md-3 p-2">
                        <div style="height: 134px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                            <img src="<?php echo "../" . ABSOLUTE_IMAGEPATH . $photogallery_['i_name']; ?>" 
                                 class="img-fluid img-thumbnail" 
                                 style="max-height: 100%; max-width: 100%; object-fit: contain;"
                                 alt="<?php echo htmlspecialchars($photogallery_['i_alttext']); ?>">
                        </div>
                    </div>
                    
                    <!-- Content column (50% width) -->
                    <div class="col-md-6 p-3">
                        <div class="row mb-1">
                            <div class="col-3 font-weight-bold"><i class="fa fa-file"></i> Name:</div>
                            <div class="col-9"><?php echo $photogallery_['i_name']; ?></div>
                        </div>
                        
                        <div class="row mb-1">
                            <div class="col-3 font-weight-bold"><i class="fa fa-tag"></i> Title:</div>
                            <div class="col-9"><?php echo htmlspecialchars($photogallery_['i_title']); ?></div>
                        </div>
                        
                        <div class="row mb-1">
                            <div class="col-3 font-weight-bold"><i class="fa fa-comment"></i> Caption:</div>
                            <div class="col-9"><?php echo htmlspecialchars($photogallery_['i_caption']); ?></div>
                        </div>
                        
                        <div class="row mb-1">
                            <div class="col-3 font-weight-bold"><i class="fa fa-edit"></i> Description:</div>
                            <div class="col-9"><?php echo htmlspecialchars($photogallery_['i_description']); ?></div>
                        </div>
                    </div>
                    
                    <!-- Actions column (25% width) -->
                   <div class="col-md-3 p-3 border-left">
                    <!-- Sequence controls -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-2 font-weight-bold"><i class="fa fa-sort"></i> Sequence:</div>
                        <span class="badge badge-secondary mr-2"><?php echo $photogallery_['i_sequence']; ?></span>
                    </div>
                    <div class="d-flex mb-3">
                        <button class="btn btn-sm btn-outline-primary mr-1 move-btn flex-grow-1" 
                                data-type="image" 
                                data-id="<?php echo $photogallery_['i_id']; ?>" 
                                data-pid="<?php echo $page[0]['pid']; ?>" 
                                data-sequence="<?php echo $photogallery_['i_sequence']; ?>"
                                data-direction="up">
                            <i class="fa fa-arrow-up"></i> Up
                        </button>
                        <button class="btn btn-sm btn-outline-primary move-btn flex-grow-1" 
                                data-type="image" 
                                data-id="<?php echo $photogallery_['i_id']; ?>" 
                                data-pid="<?php echo $page[0]['pid']; ?>" 
                                data-sequence="<?php echo $photogallery_['i_sequence']; ?>"
                                data-direction="down">
                            <i class="fa fa-arrow-down"></i> Down
                        </button>
                    </div>
                    
                    <!-- Status toggle -->
                    <div class="d-flex align-items-center mb-2">
                        <?php
                        if ($photogallery_['isactive'] == 1) {
                            echo '<span id="status_'.$photogallery_['i_id'].'" class="badge badge-success mr-2">Active</span>
                            <input type="checkbox" data-id="'.$photogallery_['i_id'].'" data-type="image" class="js-switch" checked />';
                        } else {
                            echo '<span id="status_'.$photogallery_['i_id'].'" class="badge badge-danger mr-2">Inactive</span>
                            <input type="checkbox" data-id="'.$photogallery_['i_id'].'" data-type="image" class="js-switch" />';
                        }
                        ?>
                    </div>
                    
                    <!-- Action buttons -->
                    <div class="d-flex flex-column">
                        <a href="?id=<?php echo $page[0]['pid']; ?>&media_id=<?php echo $photogallery_['i_id']; ?>&media_action=edit&media_type=image" 
                           class="btn btn-primary btn-sm rounded-0 mb-2" title="Edit">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <button onclick="delete_image(<?php echo $photogallery_['i_id']; ?>)" 
                                class="btn btn-danger btn-sm rounded-0" 
                                type="button" title="Delete">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </div>
                </div>

        </div>
    </div>
    <div class="card-footer py-1" style="background: #f8f9fa;"></div>
</div>
<?php
    }
}
?>
    </div>

    <!-- Videos Tab -->
    <div class="tab-pane fade <?php echo ($media_type == 'video') ? 'show active' : ''; ?>" id="page-videos" role="tabpanel" aria-labelledby="videos-tab">
        <?php if ($media_type == 'video' && $edit_data): ?>
        <div class="mb-3">
            <h6>Current Video:</h6>
            <video width="100%" controls style="max-height: 200px;">
                <source src="<?php echo "../" . ABSOLUTE_VIDEOPATH . $edit_data['v_name']; ?>" type="video/mp4">
                Your browser doesn't support HTML5 video.
            </video>
            <div class="mt-2">
                <span class="badge badge-info">Filename: <?php echo htmlspecialchars($edit_data['v_name']); ?></span>
            </div>
        </div>
        
        <div class="mb-3">
            <h6>Current Thumbnail:</h6>
            <?php if (!empty($edit_data['v_thumbnail'])): ?>
            <img src="<?php echo "../" . ABSOLUTE_IMAGEPATH . $edit_data['v_thumbnail']; ?>" class="img-thumbnail" style="max-height: 100px;">
            <?php else: ?>
            <div class="alert alert-warning">No thumbnail set</div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="custom-file mb-3">
            <input accept="video/*" type="file" class="custom-file-input" id="videos" name="videos[]" <?php echo ($media_type == 'video' && $edit_data) ? '' : 'multiple'; ?>>
            <label class="custom-file-label" for="videos">
                <i class="fa fa-upload"></i> 
                <?php if ($media_type == 'video' && $edit_data): ?>
                Replace Video (Current: <?php echo htmlspecialchars($edit_data['v_name']); ?>)
                <?php else: ?>
                Choose Videos
                <?php endif; ?>
            </label>
        </div>
            
        <!-- Add video metadata fields -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="video_title">Video Title</label>
                <input type="text" class="form-control" id="video_title" placeholder="Enter video title" value="<?php echo ($media_type == 'video' && $edit_data) ? htmlspecialchars($edit_data['v_title']) : ''; ?>">
            </div>
            <div class="col-md-6">
                <label for="video_thumbnail">Thumbnail (optional)</label>
                <input type="file" class="form-control" id="video_thumbnail">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="video_description">Description</label>
                <textarea class="form-control" id="video_description" rows="3" placeholder="Enter description"><?php echo ($media_type == 'video' && $edit_data) ? htmlspecialchars($edit_data['v_description']) : ''; ?></textarea>
            </div>
        </div>
        
        <!-- Add Save/Update Videos Buttons -->
        <div class="row mb-4">
            <div class="col-md-12">
                <?php if ($media_type == 'video' && $edit_data): ?>
                <input type="hidden" id="edit_video_id" value="<?php echo $media_id; ?>">
                <button id="updateVideoBtn" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update Video
                </button>
                <a href="?id=<?php echo $page[0]['pid']; ?>&media_type=<?php echo $media_type;?>" class="btn btn-secondary">Cancel</a>
                <?php else: ?>
                <button id="saveVideosBtn" class="btn btn-success">
                    <i class="fa fa-save"></i> Save New Videos
                </button>
                <?php endif; ?>
            </div>
        </div>

        <?php
$videogallery = return_multiple_rows("SELECT * FROM videos WHERE pid = " . $page[0]['pid'] . " AND soft_delete = 0 ORDER by v_sequence ASC");

if (!empty($videogallery)) {
    foreach ($videogallery as $videogallery_) {
?>
<div class="card mb-3" id="dr_<?php echo $videogallery_['v_id']; ?>">
    <div class="card-body p-0">
        <div class="row no-gutters">
            <!-- Video/Thumbnail column (25% width) -->
            <div class="col-md-3 p-2">
                <div style="height: 200px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                    <?php if (!empty($videogallery_['v_thumbnail'])): ?>
                        <img src="<?php echo "../" . ABSOLUTE_IMAGEPATH . $videogallery_['v_thumbnail']; ?>" 
                             class="img-fluid img-thumbnail" 
                             style="max-height: 100%; max-width: 100%; object-fit: contain;"
                             alt="Video thumbnail">
                    <?php else: ?>
                        <div class="text-center p-3">
                            <i class="fa fa-video-camera fa-3x text-muted"></i>
                            <p class="mt-2">No thumbnail</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="text-center mt-2">
                    <a href="#" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#videoModal<?php echo $videogallery_['v_id']; ?>">
                        <i class="fa fa-play"></i> Play Video
                    </a>
                </div>
            </div>
            
            <!-- Content column (50% width) -->
            <div class="col-md-6 p-3">
                <div class="row mb-1">
                    <div class="col-3 font-weight-bold"><i class="fa fa-file"></i> Name:</div>
                    <div class="col-9"><?php echo $videogallery_['v_name']; ?></div>
                </div>
                
                <div class="row mb-1">
                    <div class="col-3 font-weight-bold"><i class="fa fa-tag"></i> Title:</div>
                    <div class="col-9"><?php echo htmlspecialchars($videogallery_['v_title']); ?></div>
                </div>
                
                <div class="row mb-1">
                    <div class="col-3 font-weight-bold"><i class="fa fa-edit"></i> Description:</div>
                    <div class="col-9"><?php echo htmlspecialchars($videogallery_['v_description']); ?></div>
                </div>
            </div>
            
            <!-- Actions column (25% width) -->
            <div class="col-md-3 p-3 border-left">
                <!-- Sequence controls -->
                <div class="d-flex align-items-center mb-3">
                    <div class="mr-2 font-weight-bold"><i class="fa fa-sort"></i> Sequence:</div>
                    <span class="badge badge-secondary mr-2"><?php echo $videogallery_['v_sequence']; ?></span>
                </div>
                <div class="d-flex mb-3">
                    <button class="btn btn-sm btn-outline-primary mr-1 move-btn flex-grow-1" 
                            data-type="video" 
                            data-id="<?php echo $videogallery_['v_id']; ?>" 
                            data-pid="<?php echo $page[0]['pid']; ?>" 
                            data-sequence="<?php echo $videogallery_['v_sequence']; ?>"
                            data-direction="up">
                        <i class="fa fa-arrow-up"></i> Up
                    </button>
                    <button class="btn btn-sm btn-outline-primary move-btn flex-grow-1" 
                            data-type="video" 
                            data-id="<?php echo $videogallery_['v_id']; ?>" 
                            data-pid="<?php echo $page[0]['pid']; ?>" 
                            data-sequence="<?php echo $videogallery_['v_sequence']; ?>"
                            data-direction="down">
                        <i class="fa fa-arrow-down"></i> Down
                    </button>
                </div>

                    <!-- Status toggle for videos -->
                    <div class="d-flex align-items-center mb-2">
                        <?php
                        if ($videogallery_['isactive'] == 1) {
                            echo '<span id="status_'.$videogallery_['v_id'].'" class="badge badge-success mr-2">Active</span>
                            <input type="checkbox" data-id="'.$videogallery_['v_id'].'" data-type="video" class="js-switch" checked />';
                        } else {
                            echo '<span id="status_'.$videogallery_['v_id'].'" class="badge badge-danger mr-2">Inactive</span>
                            <input type="checkbox" data-id="'.$videogallery_['v_id'].'" data-type="video" class="js-switch" />';
                        }
                        ?>
                    </div>
                
                <!-- Action buttons -->
                <div class="d-flex flex-column">
                    <a href="?id=<?php echo $page[0]['pid']; ?>&media_id=<?php echo $videogallery_['v_id']; ?>&media_action=edit&media_type=video" 
                       class="btn btn-primary btn-sm rounded-0 mb-2" title="Edit">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <button onclick="delete_video(<?php echo $videogallery_['v_id']; ?>)" 
                            class="btn btn-danger btn-sm rounded-0" 
                            type="button" title="Delete">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer py-1" style="background: #f8f9fa;"></div>
</div>

<!-- Video Modal -->
<div class="modal fade" id="videoModal<?php echo $videogallery_['v_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo htmlspecialchars($videogallery_['v_title']); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <video width="100%" controls>
                    <source src="<?php echo "../" . ABSOLUTE_VIDEOPATH . $videogallery_['v_name']; ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>
<?php
    }
}
?>


    </div>

    <!-- Files Tab -->
    <div class="tab-pane fade <?php echo ($media_type == 'file') ? 'show active' : ''; ?>" id="tab-page-files" role="tabpanel" aria-labelledby="files-tab">
        <?php if ($media_type == 'file' && $edit_data): ?>
        <div class="mb-3">
            <h6>Current File:</h6>
            <a href="<?php echo "../" . ABSOLUTE_FILEPATH . $edit_data['f_name']; ?>" target="_blank" class="btn btn-primary">
                <i class="fa fa-download"></i> Download Current File
            </a>
            <div class="mt-2">
                <span class="badge badge-info">Filename: <?php echo htmlspecialchars($edit_data['f_name']); ?></span>
                <span class="badge badge-info ml-2">Type: <?php echo pathinfo($edit_data['f_name'], PATHINFO_EXTENSION); ?></span>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="custom-file mb-3">
            <input type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv,.zip,.rar,.7z" class="custom-file-input" id="page_files" name="page_files[]" <?php echo ($media_type == 'file' && $edit_data) ? '' : 'multiple'; ?>>
            <label class="custom-file-label" for="page_files">
                <i class="fa fa-upload"></i> 
                <?php if ($media_type == 'file' && $edit_data): ?>
                Replace File (Current: <?php echo htmlspecialchars($edit_data['f_name']); ?>)
                <?php else: ?>
                Choose Files
                <?php endif; ?>
            </label>
        </div>
        
        <!-- Add file metadata fields -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="file_title">File Title</label>
                <input type="text" class="form-control" id="file_title" placeholder="Enter file title" value="<?php echo ($media_type == 'file' && $edit_data) ? htmlspecialchars($edit_data['f_title']) : ''; ?>">
            </div>
            <div class="col-md-6">
                <label for="file_download_link">Download Link (optional)</label>
                <input type="text" class="form-control" id="file_download_link" placeholder="Enter custom download link" value="<?php echo ($media_type == 'file' && $edit_data) ? htmlspecialchars($edit_data['f_download_link']) : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="file_description">Description</label>
                <textarea class="form-control" id="file_description" rows="3" placeholder="Enter description"><?php echo ($media_type == 'file' && $edit_data) ? htmlspecialchars($edit_data['f_description']) : ''; ?></textarea>
            </div>
        </div>
        
        <!-- Add Save/Update Files Buttons -->
        <div class="row mb-4">
            <div class="col-md-12">
                <?php if ($media_type == 'file' && $edit_data): ?>
                <input type="hidden" id="edit_file_id" value="<?php echo $media_id; ?>">
                <button id="updateFileBtn" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update File
                </button>
                <a href="?id=<?php echo $page[0]['pid']; ?>&media_type=<?php echo $media_type;?>" class="btn btn-secondary">Cancel</a>
                <?php else: ?>
                <button id="saveFilesBtn" class="btn btn-success">
                    <i class="fa fa-save"></i> Save New Files
                </button>
                <?php endif; ?>
            </div>
        </div>

              <?php
        $filegallery = return_multiple_rows("SELECT * FROM page_files WHERE pid = " . $page[0]['pid'] . " AND soft_delete = 0 ORDER by f_sequence ASC");

        if (!empty($filegallery)) {
            foreach ($filegallery as $filegallery_) {
        ?>
        <div class="card mb-3" id="dr_<?php echo $filegallery_['f_id']; ?>">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <!-- File icon column (25% width) -->
                    <div class="col-md-3 p-3">
                        <div style="height: 134px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                            <div class="text-center">
                                <i class="fa fa-file-o fa-4x text-muted"></i>
                                <div class="mt-2">
                                    <a href="<?php echo "../" . ABSOLUTE_FILEPATH . $filegallery_['f_name']; ?>" 
                                       target="_blank" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content column (50% width) -->
                    <div class="col-md-6 p-3">
                        <div class="row mb-1">
                            <div class="col-3 font-weight-bold"><i class="fa fa-file"></i> Name:</div>
                            <div class="col-9"><?php echo $filegallery_['f_name']; ?></div>
                        </div>
                        
                        <div class="row mb-1">
                            <div class="col-3 font-weight-bold"><i class="fa fa-tag"></i> Title:</div>
                            <div class="col-9"><?php echo htmlspecialchars($filegallery_['f_title']); ?></div>
                        </div>
                        
                        <div class="row mb-1">
                            <div class="col-3 font-weight-bold"><i class="fa fa-link"></i> Download Link:</div>
                            <div class="col-9"><?php echo htmlspecialchars($filegallery_['f_download_link']); ?></div>
                        </div>
                        
                        <div class="row mb-1">
                            <div class="col-3 font-weight-bold"><i class="fa fa-edit"></i> Description:</div>
                            <div class="col-9"><?php echo htmlspecialchars($filegallery_['f_description']); ?></div>
                        </div>
                    </div>
                    
                    <!-- Actions column (25% width) -->
                    <div class="col-md-3 p-3 border-left">
                        <!-- Sequence controls -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-2 font-weight-bold"><i class="fa fa-sort"></i> Sequence:</div>
                            <span class="badge badge-secondary mr-2"><?php echo $filegallery_['f_sequence']; ?></span>
                        </div>
                        <div class="d-flex mb-3">
                            <button class="btn btn-sm btn-outline-primary mr-1 move-btn flex-grow-1" 
                                    data-type="file" 
                                    data-id="<?php echo $filegallery_['f_id']; ?>" 
                                    data-pid="<?php echo $page[0]['pid']; ?>" 
                                    data-sequence="<?php echo $filegallery_['f_sequence']; ?>"
                                    data-direction="up">
                                <i class="fa fa-arrow-up"></i> Up
                            </button>
                            <button class="btn btn-sm btn-outline-primary move-btn flex-grow-1" 
                                    data-type="file" 
                                    data-id="<?php echo $filegallery_['f_id']; ?>" 
                                    data-pid="<?php echo $page[0]['pid']; ?>" 
                                    data-sequence="<?php echo $filegallery_['f_sequence']; ?>"
                                    data-direction="down">
                                <i class="fa fa-arrow-down"></i> Down
                            </button>
                        </div>
                        

                        <!-- Status toggle for files -->
                            <div class="d-flex align-items-center mb-2">
                                <?php
                                if ($filegallery_['isactive'] == 1) {
                                    echo '<span id="status_'.$filegallery_['f_id'].'" class="badge badge-success mr-2">Active</span>
                                    <input type="checkbox" data-id="'.$filegallery_['f_id'].'" data-type="file" class="js-switch" checked />';
                                } else {
                                    echo '<span id="status_'.$filegallery_['f_id'].'" class="badge badge-danger mr-2">Inactive</span>
                                    <input type="checkbox" data-id="'.$filegallery_['f_id'].'" data-type="file" class="js-switch" />';
                                }
                                ?>
                            </div>
                        <!-- Action buttons -->
                        <div class="d-flex flex-column">
                            <a href="?id=<?php echo $page[0]['pid']; ?>&media_id=<?php echo $filegallery_['f_id']; ?>&media_action=edit&media_type=file" 
                               class="btn btn-primary btn-sm rounded-0 mb-2" title="Edit">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <button onclick="delete_file(<?php echo $filegallery_['f_id']; ?>)" 
                                    class="btn btn-danger btn-sm rounded-0" 
                                    type="button" title="Delete">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer py-1" style="background: #f8f9fa;"></div>
        </div>
        <?php
            }
        }
        ?>
        
    </div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const mediaType = urlParams.get('media_type');
    const mediaAction = urlParams.get('media_action');
    
    if (mediaType || mediaAction) {
        // 1. Activate outer Media tab (#menu4)
        const menu4Tab = document.querySelector('a[href="#menu4"]');
        if (menu4Tab) {
            // Remove active from all main tabs
            document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Activate Media tab
            menu4Tab.classList.add('active');
            
            // Hide all main tab panes
            document.querySelectorAll('.tab-content > .tab-pane').forEach(pane => {
                pane.classList.remove('active', 'show');
            });
            
            // Show Media pane
            document.getElementById('menu4').classList.add('active', 'show');
        }
        
        // 2. Activate specific media tab
        if (mediaType) {
            const tabId = mediaType + '-tab'; // Now matches 'image-tab', 'video-tab', 'file-tab'
            const mediaTab = document.getElementById(tabId);
            
            if (mediaTab) {
                // Remove active from all media tabs
                document.querySelectorAll('#mediaTabs .nav-link').forEach(tab => {
                    tab.classList.remove('active');
                    tab.setAttribute('aria-selected', 'false');
                });
                
                // Activate our media tab
                mediaTab.classList.add('active');
                mediaTab.setAttribute('aria-selected', 'true');
                
                // Hide all media panes
                document.querySelectorAll('#mediaTabsContent .tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });
                
                // Show our media pane
                const target = mediaTab.getAttribute('href');
                document.querySelector(target).classList.add('show', 'active');
            }
        }
    }
    
    // Initialize Bootstrap tabs
    $('#mediaTabs a').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
});
</script>

<script type="text/javascript" src="js/modules/page/module_media_tab.js"></script>