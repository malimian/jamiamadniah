 // Bulk Actions Functionality
    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('.page-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
        updateSelectedCount();
    }

    function updateSelectedCount() {
        const selected = document.querySelectorAll('.page-checkbox:checked');
        document.getElementById('selectedCount').textContent = selected.length;
    }

    function getSelectedPages() {
        const selected = [];
        document.querySelectorAll('.page-checkbox:checked').forEach(checkbox => {
            selected.push(checkbox.value);
        });
        return selected;
    }
function bulkAction(action) {
    const selected = getSelectedPages();
    if (selected.length === 0) {
        showAlert('Please select at least one page' , 'warning');
        return;
    }

    if (action === 'delete' && !confirm('Are you sure you want to delete the selected pages?')) {
        return;
    }

    // Use your senddata function instead of fetch
    senddata(
        'post/page/bulk_action.php',
        "POST", 
        {
            bulk_action: action,
            pages: selected
        },
        function(result) {
            // Success callback
            if (result.success) {
                showAlert(result.message);
                location.reload();
            } else {
                showAlert('Error: ' + (result.message || 'Action failed') , 'danger');
            }
        },
        function(error) {
            // Error callback
            console.error('Error:', error);
            showAlert('An error occurred during bulk action' , 'danger');
        }
    );
}

function assignTags() {
    const selected = getSelectedPages();
    if (selected.length === 0) {
        showAlert('Please select at least one page' , 'warning');
        return;
    }

    const tag = document.getElementById('tagSelection').value;
    if (!tag) {
        showAlert('Please select a tag' , 'warning');
        return;
    }

    // Use your senddata function instead of fetch
    senddata(
        'post/page/bulk_action.php',
        "POST", 
        {
            assign_tag: true,
            tag: tag,
            pages: selected
        },
        function(result) {
            // Success callback
            if (result.success) {
                alert(result.message);
                location.reload();
            } else {
                alert('Error: ' + (result.message || 'Tag assignment failed'));
            }
        },
        function(error) {
            // Error callback
            console.error('Error:', error);
            alert('An error occurred during tag assignment');
        }
    );
}

    // Update selected count when checkboxes change
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.page-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    });