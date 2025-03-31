
var datatable_id = 'dataTable1';

searchdatatable(datatable_id);


   $(document).on("change", ".js-switch", function() {
    var id = $(this).data("id");
    var isChecked = $(this).is(':checked');
    var $switch = $(this);
    var $badge = $(this).closest('.custom-control').find('.badge');
    
    // Disable switch during processing
    $switch.prop('disabled', true);
    
    // Show loading state
    $badge.removeClass('badge-success badge-warning').addClass('badge-info').text('Updating...');
    
    senddata(
        'post/page/pages.php',
        "POST", {
            id: id,
            change_status: true,
            new_status: isChecked ? 1 : 0
        },
        function(result) {
            // Success callback
            $switch.prop('disabled', false);
            if (isChecked) {
                $badge.removeClass().addClass('badge badge-success').text('Published');
            } else {
                $badge.removeClass().addClass('badge badge-warning').text('Draft');
            }
        },
        function(result) {
            // Error callback - revert switch state
            $switch.prop('disabled', false);
            $switch.prop('checked', !isChecked);
            $badge.removeClass().addClass(isChecked ? 'badge-warning' : 'badge-success')
                  .text(isChecked ? 'Draft' : 'Published');
            
            console.error("Status update failed:", result);
            alert("Failed to update status. Please try again.");
        }
    );
});


function delete_(id) {

    createmodal('Delete', 'Are you sure You want to delete ?', id, 'deletemodal', function() {
        senddata(
            'post/page/pages.php',
            "POST", {
                id: id,
                delete: true
            },
            function(result) {
                console.log(result);
            },
            function(result) {
                console.log(result);
            }
        );

        $('#tr_' + id).hide();
        $('#custommodal').modal('toggle');
    });

    $('#custommodal').modal('toggle');
}


function change_seq(id , val){
  var html = '';
  html +=' <div class="input-group">';
  html +='<input type="text" id="updated_seq_'+id+'" value="'+val+'" class="form-control">';
  html +='<span class="input-group-btn">';
  html +='  <button class="btn btn-primary btn-md" type="button" onclick="save_seq('+id+')" >Save</button>';
  html +='</span>';
  html +='</div>';
  $('#seq_'+id).html(html);
}

function save_seq(id){
var newval = $('#updated_seq_'+id).val();
 senddata(
            'post/page/pages.php',
            "POST", {
                id: id,
                sequence : newval,
                updatesequence: true
            },
            function(result) {
                console.log(result);
                $('#seq_'+id).empty();
                $('#seq_'+id).html(newval);
                $('#'+datatable_id).DataTable().destroy();
                
                $('#'+datatable_id).DataTable( {
                "order": [[ 2, "asc" ]],
                "pageLength": 50,
                dom: 'Bfrtip',
                buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
                ]

                });
            },
            function(result) {
                console.log(result);
            }
        );

}
