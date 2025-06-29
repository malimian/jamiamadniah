
var datatable_id = 'dataTable1';

searchdatatable(datatable_id);


   $(document).on("change", ".js-switch", function() {
    var id = $(this).data("id");
    var isChecked = $(this).is(':checked');
    var $switch = $(this);
    var $statusBadge = $(this).siblings('.badge'); // Changed to find sibling badge
    
    // Disable switch during processing
    $switch.prop('disabled', true);
    
    // Show loading state
    $statusBadge.removeClass('badge-success badge-info').addClass('badge-info').text('Updating...');
    
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
                $statusBadge.removeClass().addClass('badge badge-success').text('Published');
            } else {
                $statusBadge.removeClass().addClass('badge badge-warning').text('Draft');
            }
        },
        function(result) {
            // Error callback - revert switch state
            $switch.prop('disabled', false);
            $switch.prop('checked', !isChecked);
            $statusBadge.removeClass().addClass(isChecked ? 'badge-warning' : 'badge-success')
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

    // Handle sequence changes
function changeSequence(id, direction) {
    const row = $('#tr_' + id);
    const currentSeq = parseInt(row.find('td:eq(2) span').text());
    
    $.ajax({
        url: 'post/page/pages.php',
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
            showAlert('Failed to update sequence', 'danger');
            
            // For debugging - check the actual response
            console.log('Server response:', xhr.responseText);
        }
    });
}


// Notes editing functionality
        $(document).on('click', '.edit-notes', function(e) {
            e.preventDefault();
            const pageId = $(this).data('id');
            const notesContainer = $('#notes_' + pageId);
            const currentNotes = notesContainer.find('.notes-content').text().trim();
            
            // Replace with textarea
            notesContainer.html(`
                <textarea class="form-control mb-2" rows="10" cols="10" id="notes_text_${pageId}">${currentNotes}</textarea>
                <button class="btn btn-sm btn-success save-notes mr-1" data-id="${pageId}">Save</button>
                <button class="btn btn-sm btn-secondary cancel-notes" data-id="${pageId}">Cancel</button>
            `);
        });

        $(document).on('click', '.save-notes', function() {
            const pageId = $(this).data('id');
            const newNotes = $('#notes_text_' + pageId).val();
            
            senddata(
                'post/page/pages.php',
                "POST", {
                    id: pageId,
                    update_notes: true,
                    notes: newNotes
                },
                function(result) {
                    // Success callback
                    const notesContainer = $('#notes_' + pageId);
                    if(newNotes.trim()) {
                        notesContainer.html(`
                            <div class="notes-content">
                                ${newNotes.replace(/\n/g, '<br>')}
                                <small><a href="#" class="edit-notes" data-id="${pageId}">Edit</a></small>
                            </div>
                        `);
                    } else {
                        notesContainer.html(`
                            <small><a href="#" class="edit-notes" data-id="${pageId}">Add notes</a></small>
                        `);
                    }
                },
                function(result) {
                    // Error callback
                    alert("Failed to update notes. Please try again.");
                    console.error("Notes update failed:", result);
                }
            );
        });

        $(document).on('click', '.cancel-notes', function() {
            // Just reload the page to get the original state
            location.reload();
        });


// Hooverable edit , view icons
$(document).ready(function() {
    // Pre-cache all action links to prevent lag
    const actionLinks = $('.action-links');
    
    // Show instantly on row hover
    $('tbody tr').on('mouseenter', function() {
        $(this).find('.action-links').css('opacity', '1');
    }).on('mouseleave', function() {
        $(this).find('.action-links').css('opacity', '0');
    });
});
