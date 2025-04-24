
var datatable_id = 'dataTable1';

searchdatatable(datatable_id);


    $(document).on("change", ".js-switch", function() {
    var id = $(this).data("id");
    senddata(
        'post/site_template/site_template.php',
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
