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

/* Tab Styling */
.media-tabs-custom {
    border-bottom: 2px solid #dee2e6;
    margin-bottom: 1.5rem;
}

.media-tabs-custom .nav-link {
    color: #495057;
    font-weight: 500;
    border: none;
    padding: 0.75rem 1.5rem;
    margin-right: 0.5rem;
    border-radius: 5px 5px 0 0;
    transition: all 0.3s;
}

.media-tabs-custom .nav-link:hover {
    color: #2575fc;
    background-color: rgba(37, 117, 252, 0.1);
}

.media-tabs-custom .nav-link.active {
    color: #2575fc;
    background-color: transparent;
    border-bottom: 3px solid #2575fc;
}

/* Upload Section Styling */
.media-upload-container-custom {
    background: white;
    border-radius: 10px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
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
    padding: 1.5rem;
    border-radius: 10px;
    background-color: #f8f9fa;
    transition: all 0.3s;
}

.media-image-preview-custom:hover {
    border-color: #2575fc;
}

.media-image-result-custom {
    max-height: 300px;
    object-fit: contain;
    transition: transform 0.3s;
}

.media-image-result-custom:hover {
    transform: scale(1.02);
}

/* Gallery Section */
/*.media-gallery-grid-custom {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}*/

.media-gallery-item-custom {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
    position: relative;
}

.media-gallery-item-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

/* Table Section */
.media-gallery-table-custom {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.media-gallery-table-custom th {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    color: white;
    font-weight: 500;
}

.media-gallery-table-custom tr:nth-child(even) {
    background-color: #f8f9fa;
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
@media (max-width: 768px) {
    .MediaGalleryModal-dialog {
        max-width: 95%;
        margin: 1rem auto;
    }
    
    .media-tabs-custom .nav-link {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
    
    .media-gallery-grid-custom {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
}
  </style>
  <div class="modal media-gallery-modal-custom" id="MediaGalleryModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-xl MediaGalleryModal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header media-modal-header-custom">
          <h5 class="modal-title">Media</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body MediaGalleryModal-body">
          <input type="hidden" id="textcopied">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs media-tabs-custom">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#upload_image">Upload Image</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu1_gallery">Galley</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu2_gallery">Images List</a>
            </li>
          </ul><!-- Tab panes -->
          <div class="tab-content">
            <div class="container tab-pane active media-upload-container-custom" id="upload_image">
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
              </div>
              <div class="image-area mt-4 media-image-preview-custom"><img alt="" class="img-fluid rounded shadow-sm mx-auto d-block media-image-result-custom" id="imageResult" src="#"></div>
              <div class="input-group  justify-content-end">
                <button class="btn btn-primary m-0 rounded-pill px-4 upload_image_module_btn media-upload-btn-custom" type="button">Upload</button>
              </div>
            </div>
            <div class="container tab-pane fade" id="menu1_gallery">
              <div class="mt-2 mb-5">
              <div class="input-group form-group"> 
                <button type="button" class="btn btn-primary module_loadimg_btn media-upload-btn-custom" onclick="load_images();">Load Images</button>
              </div>
              <div class="row text-center text-lg-left">
                  <div class="row media-gallery-grid-custom" id="get_images">
                  </div>  
              </div>
            </div>
          </div>

            <div class="container tab-pane fade" id="menu2_gallery">
              <br>
              <div class="container-fluid">
                <div class="input-group form-group"> 
                    <span class="input-group-text">Search Images</span>
                    <input id="filter_list_images" type="text" class="form-control" placeholder="Type here...">
                </div>
                <table id="datatable_list_gallery_plugin" class="table table-striped searchable_table media-gallery-table-custom">
                </table>
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
