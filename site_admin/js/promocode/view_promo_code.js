
searchdatatable('dataTable1');


$('.js-switch').on("change", function() {
    var id = $(this).data("id");
    senddata(
        'post/promocode/view_promo_code.php',
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


function delete_course(id) {

    createmodal('Delete', 'Are you sure You want to delete Promo Code It would still be vaild by exisiting user?', id, 'deletemodal', function() {
        senddata(
            'post/promocode/view_promo_code.php',
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
