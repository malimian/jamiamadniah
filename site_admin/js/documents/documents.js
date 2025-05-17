
var datatable_id = 'dataTable';

searchdatatable(datatable_id);

 function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('.document-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
        updateSelectedCount();
    }
    
    function updateSelectedCount() {
        const selected = document.querySelectorAll('.document-checkbox:checked').length;
        document.getElementById('selectedCount').textContent = selected;
    }
    
    // Add event listeners to all checkboxes
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.document-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });
        
        // Initialize Select2 for any select elements
        $('.select2').select2();
    });
    

// Document status toggle
$(document).ready(function() {
    // Initialize switch controls
   
    $('.js-switch').each(function() {
    
        
        // Handle status change
        $(this).on('change', function() {
            var documentId = $(this).data('id');
            var isChecked = $(this).is(':checked');
            
            senddata(
                'post/documents/documents.php',
                'POST',
                { change_status: true, id: documentId },
                function(response) {
                    var result = JSON.parse(response);
                    if(result) {
                        var statusBadge = $('#status_' + documentId);
                        if(isChecked) {
                            statusBadge.removeClass('badge-danger').addClass('badge-success').text('Active');
                        } else {
                            statusBadge.removeClass('badge-success').addClass('badge-danger').text('Inactive');
                        }
                    } else {
                        // Revert the switch if update failed
                        $(this).prop('checked', !isChecked);
                        showAlert('Failed to update status', 'danger');
                    }
                },
                function(error) {
                    // Revert the switch on error
                    $(this).prop('checked', !isChecked);
                    showAlert('Error updating status', 'danger');
                    console.error("Status Update Error:", error);
                }
            );
        });
    });
    
    // Initialize Select2 for any select elements
    $('.select2').select2();
});

// Delete document function
function deleteDocument(documentId) {
    createmodal(
        'Delete Document', 
        'Are you sure you want to delete this document? This action cannot be undone.', 
        documentId, 
        'deletemodal', 
        function() {
            senddata(
                'post/documents/documents.php',
                'POST',
                { delete: true, id: documentId },
                function(response) {
                    var result = JSON.parse(response);
                    if(result) {
                        // Remove the row from the table
                        $('#tr_' + documentId).fadeOut(300, function() {
                            $(this).remove();
                        });
                        showAlert('Document deleted successfully', 'success');
                    } else {
                        showAlert('Failed to delete document', 'danger');
                    }
                },
                function(error) {
                    showAlert('Error deleting document', 'danger');
                    console.error("Delete Error:", error);
                }
            );
            $('#custommodal').modal('toggle');
        }
    );
    $('#custommodal').modal('toggle');
}

// Bulk actions handler
function bulkAction(action) {
    var selected = [];
    $('.document-checkbox:checked').each(function() {
        selected.push($(this).val());
    });

    if(selected.length === 0) {
        showAlert('Please select at least one document', 'warning');
        return;
    }

    var actionText = '';
    switch(action) {
        case 'delete': actionText = 'delete'; break;
        case 'activate': actionText = 'activate'; break;
        case 'deactivate': actionText = 'deactivate'; break;
    }

    if(confirm(`Are you sure you want to ${actionText} ${selected.length} selected document(s)?`)) {
        senddata(
            'post/documents/documents.php',
            'POST',
            { bulk_action: true, action: action, ids: selected },
            function(response) {
                var result = JSON.parse(response);
                if(result.success) {
                    showAlert(result.message, 'success');
                    // Refresh the page to reflect changes
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    showAlert(result.message, 'danger');
                }
            },
            function(error) {
                showAlert('Error performing bulk action', 'danger');
                console.error("Bulk Action Error:", error);
            }
        );
    }
}

// Duplicate document function
$(document).on('click', '.duplicate-document', function(e) {
    e.preventDefault();
    var documentId = $(this).data('documentid');
    
    if(confirm('Are you sure you want to duplicate this document?')) {
        senddata(
            'post/documents/documents.php',
            'POST',
            { duplicate: true, id: documentId },
            function(response) {
                var result = JSON.parse(response);
                if(result.success) {
                    showAlert(result.message, 'success');
                    // Refresh the page to show the new document
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    showAlert(result.message, 'danger');
                }
            },
            function(error) {
                showAlert('Error duplicating document', 'danger');
                console.error("Duplicate Error:", error);
            }
        );
    }
});

// Toggle select all checkboxes
function toggleSelectAll(source) {
    $('.document-checkbox').prop('checked', source.checked);
    updateSelectedCount();
}

// Update selected items counter
function updateSelectedCount() {
    var selected = $('.document-checkbox:checked').length;
    $('#selectedCount').text(selected);
}

// Initialize checkbox change events
$(document).ready(function() {
    $('.document-checkbox').change(function() {
        updateSelectedCount();
    });
});
