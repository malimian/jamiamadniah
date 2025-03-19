
var datatable_id = 'dataTable1';

searchdatatable(datatable_id);


    $(document).on("change", ".js-switch", function() {
    var id = $(this).data("id");
    senddata(
        'post/product/products.php',
        "POST", {
            id: id,
            change_status: true
        },
        function(result) {
            console.log(result);
        },
        function(result) {
            console.log(result);
        }
    );

    if (!$(this).is(':checked')) {
        $('#status_' + id).removeClass().addClass('badge badge-danger').html('In Active');
    } else {
        $('#status_' + id).removeClass().addClass('badge badge-success').html('Active');
    }

});


function delete_(id) {

    createmodal('Delete', 'Are you sure You want to delete ?', id, 'deletemodal', function() {
        senddata(
            'post/product/products.php',
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
            'post/product/products.php',
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
