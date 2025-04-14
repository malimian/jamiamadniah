
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

// Sequence change handler - improved version for hierarchical tables
function changeSequence(id, direction) {
    const row = $('#tr_' + id);
    const currentSeq = parseInt(row.find('td:eq(2) span').text());
    const parentId = row.data('parent-id') || 0; // Get parent ID if available
    
    // Get all siblings (including self) at the same level
    const siblings = row.closest('tbody').find(`tr[data-parent-id="${parentId}"]`);
    const currentIndex = siblings.index(row);
    
    // Validate move direction
    if ((direction === 'up' && currentIndex === 0) || 
        (direction === 'down' && currentIndex === siblings.length - 1)) {
        showAlert('Cannot move further in this direction', 'info');
        return;
    }
    
    $.ajax({
        url: 'post/category/categories.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            parent_id: parentId, // Include parent ID in request
            change_sequence: true,
            direction: direction
        },
        success: function(data) {
            if (data.success) {
                // Update sequence numbers in UI
                row.find('td:eq(2) span').text(data.new_sequence);
                
                // Get the target row (either previous or next sibling at same level)
                let targetRow;
                if (direction === 'up') {
                    targetRow = siblings.eq(currentIndex - 1);
                } else {
                    targetRow = siblings.eq(currentIndex + 1);
                }
                
                // Update the target row's sequence
                if (targetRow.length && data.other_id) {
                    targetRow.find('td:eq(2) span').text(data.other_new_sequence);
                    
                    // Move the row in the DOM
                    if (direction === 'up') {
                        row.insertBefore(targetRow);
                    } else {
                        row.insertAfter(targetRow);
                    }
                }
                
                showAlert('Sequence updated', 'success');
            } else {
                showAlert(data.message || 'No changes were made', 'info');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            
            // Try to parse the response for more detailed error info
            let errorMsg = 'Failed to update sequence';
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.message) {
                    errorMsg = response.message;
                }
            } catch (e) {
                console.log('Raw server response:', xhr.responseText);
            }
            
            showAlert(errorMsg, 'danger');
        }
    });
}

// Initialize table with parent-id data attributes
$(document).ready(function() {
    // Add data-parent-id to all rows
    $('table#catetable tbody tr').each(function() {
        const parentCellText = $(this).find('td:eq(4)').text().trim();
        const parentId = parentCellText === 'Parent' ? 0 : 
                         parseInt(parentCellText) || 0;
        $(this).attr('data-parent-id', parentId);
    });
    
    // Handle sequence arrows
    $('.sequence-up, .sequence-down').on('click', function() {
        const row = $(this).closest('tr');
        const id = row.attr('id').replace('tr_', '');
        const direction = $(this).hasClass('sequence-up') ? 'up' : 'down';
        changeSequence(id, direction);
    });
});