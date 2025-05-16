<style type="text/css">
    /* Main Modal Styling */
.media-gallery-modal-custom {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

.MediaGalleryModal-dialog {
    max-width: 90%;
    margin: 2rem auto;
}

.MediaGalleryModal-body {
    padding: 1.5rem;
    background-color: #f8f9fa;
    border-radius: 0 0 5px 5px;
}

/* Header Styling */
.media-modal-header-custom {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    color: white;
    border-radius: 5px 5px 0 0 !important;
    padding: 1rem 1.5rem;
    border-bottom: none;
}

.media-modal-header-custom .modal-title {
    font-weight: 600;
    font-size: 1.4rem;
}

.media-modal-header-custom .close {
    color: white;
    text-shadow: none;
    opacity: 0.8;
    transition: all 0.2s;
}

.media-modal-header-custom .close:hover {
    opacity: 1;
    transform: scale(1.1);
}

/* Two Column Layout */
.media-columns-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.media-gallery-column {
    flex: 0 0 60%;
    max-width: 60%;
}

.media-upload-column {
    flex: 0 0 calc(40% - 1.5rem);
    max-width: calc(40% - 1.5rem);
}

/* Gallery Section */
.media-gallery-grid-custom {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 15px;
    padding: 10px;
    width: 100%;
}

/* Gallery Item Styling */
.media-gallery-item-custom {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.media-gallery-item-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Image Container */
.media-gallery-item-custom .imgContainer {
    padding: 10px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

/* Search Box */
.media-search-box {
    margin-bottom: 1rem;
}

/* Upload Section Styling */
.media-upload-container-custom {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    height: 100%;
}

.media-upload-input-custom {
    border-radius: 50px !important;
    padding: 0.5rem 1rem;
    border: 2px dashed #ced4da;
    transition: all 0.3s;
}

.media-upload-input-custom:hover {
    border-color: #2575fc;
    background-color: #f8faff;
}

.media-upload-label-custom {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
    color: #6c757d;
    pointer-events: none;
    transition: all 0.3s;
}

.media-upload-btn-custom {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    color: white !important;
    border: none;
    transition: all 0.3s;
    box-shadow: 0 4px 6px rgba(37, 117, 252, 0.2);
}

.media-upload-btn-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(37, 117, 252, 0.3);
}

/* Image Preview Area */
.media-image-preview-custom {
    border: 2px dashed #dee2e6;
    padding: 1rem;
    border-radius: 10px;
    background-color: #f8f9fa;
    transition: all 0.3s;
    margin-top: 1rem;
}

.media-image-preview-custom:hover {
    border-color: #2575fc;
}

.media-image-result-custom {
    max-height: 200px;
    object-fit: contain;
    transition: transform 0.3s;
}

.media-image-result-custom:hover {
    transform: scale(1.02);
}

/* Load More Button */
.media-load-more {
    margin-top: 1rem;
    text-align: center;
}

/* Footer Styling */
.media-modal-footer-custom {
    border-top: 1px solid #e9ecef;
    padding: 1rem 1.5rem;
    background-color: #f8f9fa;
    border-radius: 0 0 5px 5px;
}

.media-modal-footer-btn-custom {
    border-radius: 50px;
    padding: 0.5rem 1.5rem;
    transition: all 0.3s;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .media-gallery-column,
    .media-upload-column {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    .media-gallery-grid-custom {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    }
}

@media (max-width: 768px) {
    .MediaGalleryModal-dialog {
        max-width: 95%;
        margin: 1rem auto;
    }
}

/* Image Actions */
.img-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.5rem;
    justify-content: center;
}

.img-actions .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.8rem;
}

.media-gallery-item-custom {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
    position: relative;
    background: white;
    padding: 0.5rem;
}

/* Image Styling */
.media-gallery-item-custom img {
    width: 100%;
    height: 120px;
    object-fit: contain;
    margin-bottom: 10px;
    border-radius: 4px;
    background: #f5f5f5;
}


/* Input and Actions */
.media-gallery-item-custom input {
    width: 100%;
    padding: 5px;
    font-size: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 8px;
}



/* Responsive Adjustments */
@media (max-width: 768px) {
    .media-gallery-grid-custom {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 10px;
    }
}

@media (max-width: 576px) {
    .media-gallery-grid-custom {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    }
    
    .media-gallery-item-custom img {
        height: 100px;
    }
}

/* Search box styling */
.media-search-box {
    margin-bottom: 1rem;
}

.media-search-box .input-group {
    width: 100%;
}

</style>

<div class="modal media-gallery-modal-custom" id="MediaGalleryModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-xl MediaGalleryModal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header media-modal-header-custom">
          <h5 class="modal-title">Media Gallery</h5>
          <button aria-label="Close" class="close" data-dismiss="modal" type="button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body MediaGalleryModal-body">
          <input type="hidden" id="textcopied">
          <input type="hidden" id="mediaGalleryPath">
          
          <div class="media-columns-container">
            <!-- Gallery Column (60%) -->
            <div class="media-gallery-column">
                <div class="media-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" id="gallery_search" placeholder="Search images...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" onclick="filterGallery()">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="media-gallery-container">
                    <div class="media-gallery-grid-custom" id="get_images">
                        <!-- Gallery images will be loaded here -->
                    </div>
                    
                    <div class="media-load-more">
                        <button type="button" class="btn btn-primary module_loadimg_btn media-upload-btn-custom" onclick="load_images();">
                            Load More Images
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Upload Column (40%) -->
            <div class="media-upload-column">
                <div class="media-upload-container-custom">
                    <h5>Upload Image</h5>
                    <div id="error_id_upload_module"></div>
                    
                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm media-upload-input-custom">
                        <input accept="image/*" class="form-control border-0" id="files" onchange="readURL(this);" type="file"> 
                        <label class="font-weight-light text-muted media-upload-label-custom" for="files" id="upload-label">Choose file</label>
                        <div class="input-group-append">
                            <label class="btn btn-light m-0 rounded-pill px-4 media-upload-btn-custom" for="files">
                                <i class="fa fa-cloud-upload mr-2 text-muted"></i>
                                <small class="text-uppercase font-weight-bold text-muted">Choose file</small>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-inline input-group image_url_group" style="display: none">
                        <!-- Will be populated after upload -->
                    </div>
                    
                    <div class="image-area mt-4 media-image-preview-custom">
                        <img alt="" class="img-fluid rounded shadow-sm mx-auto d-block media-image-result-custom" id="imageResult" src="#">
                    </div>
                    
                    <div class="input-group justify-content-end mt-3">
                        <button class="btn btn-primary m-0 rounded-pill px-4 upload_image_module_btn media-upload-btn-custom" type="button">
                            Upload Image
                        </button>
                    </div>
                </div>
            </div>
          </div>
        </div>
        
        <div class="modal-footer media-modal-footer-custom">
          <button class="btn btn-secondary media-modal-footer-btn-custom" data-dismiss="modal" type="button">Close</button>
        </div>
      </div>
    </div>
</div>

<script src="js/modules/upload_image.js"></script>
