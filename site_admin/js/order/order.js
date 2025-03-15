
var datatable_id = 'dataTable';

searchdatatable(datatable_id);


$('.js-switch').on("change", function() {
    var id = $(this).data("id");
    senddata(
        'post/order/order.php',
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
            'post/order/order.php',
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


