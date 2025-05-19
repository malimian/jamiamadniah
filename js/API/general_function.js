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


var searchdatatable = function(id){

    oTable = $('#'+id).DataTable(
      {
         "pageLength": 150,
         dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ],
             createdRow: function(row, data, dataIndex){
         // Initialize custom control
              
                // var elem = document.querySelector('.js-switch');
                // var init = new Switchery(elem, {
                //   color: '#28a745',
                //   secondaryColor: '#dc3545',
                //   size: 'small'
                // });
            },
            initComplete: function(settings){
            
            }
        }
      );

    $('#datatable_search').keyup(function(){
          oTable.search($(this).val()).draw() ;
    });
    
    
  }



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


function loader(show = true) {
    if (show) {
        $('#spinner-loader').removeClass('d-none');
    } else {
        $('#spinner-loader').addClass('d-none');
    }
}


function handleLoadMore(loadMoreBtn) {
    const analysisContainer = document.getElementById('analysis-container');
    const loadingSpinner = document.getElementById('loading-spinner');
    
    if (!analysisContainer || !loadingSpinner) {
        console.error('Required elements not found');
        return;
    }
    
    const offset = parseInt(loadMoreBtn.getAttribute('data-offset'));
    const catid = loadMoreBtn.getAttribute('data-catid');
    
    // Show loading spinner
    loadMoreBtn.classList.add('d-none');
    loadingSpinner.classList.remove('d-none');
    
    fetch(`post/load_more_analysis.php?offset=${offset}&catid=${catid}`)
        .then(response => response.text())
        .then(data => {
            if (data.trim() !== '') {
                analysisContainer.insertAdjacentHTML('beforeend', data);
                loadMoreBtn.setAttribute('data-offset', offset + 5);
                loadMoreBtn.classList.remove('d-none');
            } else {
                loadMoreBtn.textContent = 'No more analysis to load';
                loadMoreBtn.classList.add('disabled');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            loadMoreBtn.textContent = 'Error loading content';
        })
        .finally(() => {
            loadingSpinner.classList.add('d-none');
        });
}