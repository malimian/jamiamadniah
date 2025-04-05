
    // Ensure event listeners are applied even after page changes using event delegation
    $(document).on("change", ".js-switch", function() {
        var id = $(this).data("id");

        // Send the data to the server for processing
        senddata(
            'post/category/categories.php',
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

        // Update the badge based on the switch status
        if (!$(this).is(':checked')) {
            $('#status_' + id).removeClass().addClass('badge badge-danger').html('In Active');
        } else {
            $('#status_' + id).removeClass().addClass('badge badge-success').html('Active');
        }
    });



function delete_(id) {

    createmodal('Delete', 'Are you sure You want to delete ?', id, 'deletemodal', function() {
        senddata(
            'post/category/categories.php',
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


// Sequence change handler - fixed version
function changeSequence(id, direction) {
    const row = $('#tr_' + id);
    const currentSeq = parseInt(row.find('td:eq(2) span').text());
    
    $.ajax({
        url: 'post/category/categories.php',
        type: 'POST',
        dataType: 'json', // Explicitly tell jQuery to expect JSON
        data: {
            id: id,
            change_sequence: true,
            direction: direction
        },
        success: function(data) { // data is already parsed JSON
            if (data.success) {
                // Update sequence numbers in UI
                row.find('td:eq(2) span').text(data.new_sequence);
                
                if (direction === 'up') {
                    const prevRow = row.prev();
                    if (prevRow.length && data.other_id) {
                        prevRow.find('td:eq(2) span').text(data.other_new_sequence);
                        row.insertBefore(prevRow);
                    }
                } else if (direction === 'down') {
                    const nextRow = row.next();
                    if (nextRow.length && data.other_id) {
                        nextRow.find('td:eq(2) span').text(data.other_new_sequence);
                        row.insertAfter(nextRow);
                    }
                }
                
                showAlert('Sequence updated' , 'success');
            } else {
                showAlert(data.message || 'No changes made' , 'info');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            showAlert('Failed to update sequence' , 'danger');
            
            // For debugging - check the actual response
            console.log('Server response:', xhr.responseText);
        }
    });
}
