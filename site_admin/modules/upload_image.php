  <div class="modal" id="MediaGalleryModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-xl MediaGalleryModal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Media</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body MediaGalleryModal-body">
          <input type="hidden" id="textcopied">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs">
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
            <div class="container tab-pane active" id="upload_image">
              <div id="error_id_upload_module"></div>
              <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                <input accept="image/*" class="form-control border-0" id="files" onchange="readURL(this);" type="file"> 
                <label class="font-weight-light text-muted" for="files" id="upload-label">Choose file</label>
                <div class="input-group-append">
                  <label class="btn btn-light m-0 rounded-pill px-4" for="files">
                    <i class="fa fa-cloud-upload mr-2 text-muted"></i>
                    <small class="text-uppercase font-weight-bold text-muted">Choose file</small>
                  </label>
                </div>
              </div>
              <div class="form-inline input-group image_url_group" style="display: none">
              </div>
              <div class="image-area mt-4"><img alt="" class="img-fluid rounded shadow-sm mx-auto d-block" id="imageResult" src="#"></div>
              <div class="input-group  justify-content-end">
                <button class="btn btn-primary m-0 rounded-pill px-4 upload_image_module_btn" type="button">Upload</button>
              </div>
            </div>
            <div class="container tab-pane fade" id="menu1_gallery">

              <div class="mt-2 mb-5">
              <div class="input-group form-group"> 
                <button type="button" class="btn btn-primary module_loadimg_btn" onclick="load_images();">Load Images</button>
              </div>
              <div class="row text-center text-lg-left">
                  <div class="row" id="get_images">
        
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
                <table id="datatable_list_gallery_plugin" class="table table-striped searchable_table">
                </table>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
        </div>
      </div>
    </div>
  </div>
      <script src="js/modules/upload_image.js"></script>
