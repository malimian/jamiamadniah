var validateform = function(callback , failback){

(function() {
      'use strict';
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
              failback();
            }
            else{
              callback();
            }
            form.classList.add('was-validated');
          }, false);
        });

    })();
}

var validateform1 = function(callback , failback){

(function() {
      'use strict';
      window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {

          if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
              failback();
            }
            else{
              callback();
            }
            form.classList.add('was-validated');
            

        });
      }, false);
    })();
}


// Initialize Switchery instances on page load
function initializeSwitches() {
    $(".js-switch").each(function() {
        // Only initialize if not already initialized
        if (!$(this).data('switchery')) {
            new Switchery(this, { color: '#28a745', secondaryColor: '#dc3545', size: 'small' });
        }
    });
}

// Function to initialize DataTable
var searchdatatable = function(id){
    var oTable = $('#'+id).DataTable({
        "pageLength": 50,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        createdRow: function(row, data, dataIndex){
            // Handle row creation logic here if needed
        },
        initComplete: function(settings){
            // Optional initialization after the DataTable is fully initialized
        }
    });

    // Search functionality
    $('#datatable_search').keyup(function(){
        oTable.search($(this).val()).draw();
    });

    // Reinitialize switches after DataTable is redrawn (on page change or sorting)
    oTable.on('draw', function() {
        initializeSwitches();
    });

    // Initial switch initialization when DataTable is first created
    initializeSwitches();
};




var createmodal = function(modal_header , modal_body , value , show_on_div_id , callback){
var html = '';

html +='<div class="modal fade" id="custommodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
html +='    <div class="modal-dialog" role="document">';
html +='      <div class="modal-content">';
html +='        <div class="modal-header">';
html +='          <h5 class="modal-title" id="exampleModalLabel">'+modal_header+'</h5>';
html +='          <button class="close" type="button" data-dismiss="modal" aria-label="Close">';
html +='            <span aria-hidden="true">×</span>';
html +='          </button>';
html +='              </div>';
html +='             <div class="modal-body">'+modal_body+'</div>';
html +='            <input type="hidden" id="modalval" value="'+value+'" />';
html +='          <div class="modal-footer">';
html +='          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>';
html +='          <button type="button" id="confirm" class="btn btn-primary">'+modal_header+'</button>';
html +='        </div>';
html +='      </div>';
html +='    </div>';
html +='  </div>';

   $("#"+show_on_div_id).empty().append(html);

   $('#confirm').on("click" , function(){

   callback();

  });

}



var setdatatable = function( datatable_id, url ){

    $('#'+datatable_id).DataTable({
            "processing" : true,
            "ajax" : {
                "url" : url,
                dataSrc : ''
            },
            "columns" : [ {
                "data" : "id"
            }, {
                "data" : "name"
            }, {
                "data" : "lat"
            }, {
                "data" : "lon"
            }]
        });
}


function myalert(message , id){
  if(id == 1 || id == "i") {$.notify(message, "info"); return;}
  if(id == 2 || id == "s") {$.notify(message, "success"); return;}
  if(id == 3 || id == "w") {$.notify(message, "warn"); return;}
  if(id == 4 || id == "e") {$.notify(message, "error"); return;}
}


function showAlert(message, id) {

    if (!id || typeof id !== 'string' || id.trim() === '') {
        id = 'danger';
    }
    
    $.notify(message, id);
}



function OpenMediaGallery(textbox_id){

$('#textcopied').val('');

if( typeof textbox_id !== undefined){
    
    $('.btn-use').show();   
    $('#textcopied').val(textbox_id);

}else{
    $('.btn-use').hide();
}


   $('#MediaGalleryModal').modal('toggle');

      if($('#textcopied').val() != ""){
        $('.btn-use').show();
    }


}
