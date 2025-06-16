// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize SortableJS if available
    if (typeof Sortable !== 'undefined') {
        initializeSortable();
    } else {
        console.error('SortableJS not loaded!');
    }
    
    // Initialize status toggles
    initializeStatusToggles();
    
    // Initialize delete handlers
    initializeDeleteHandlers();
    
    // Initialize sequence buttons
    initializeSequenceButtons();
});

function initializeSortable() {
    try {
        // Main container
        new Sortable(document.getElementById('sortable-menu'), {
            handle: '.menu-item-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            onEnd: function(evt) {
                updateMenuOrder(evt.item, evt.newIndex);
            }
        });
        
        // Child containers
        document.querySelectorAll('.menu-item-children').forEach(function(el) {
            new Sortable(el, {
                handle: '.menu-item-handle',
                animation: 150,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                group: 'nested',
                onEnd: function(evt) {
                    var parentId = el.dataset.parent;
                    updateMenuOrder(evt.item, evt.newIndex, parentId);
                }
            });
        });
    } catch (e) {
        console.error('Sortable initialization error:', e);
    }
}

function initializeStatusToggles() {
    // Use event delegation for dynamically added elements
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('status-toggle-input')) {
            var id = e.target.dataset.id;
            var isActive = e.target.checked;
            
            // Show confirmation modal
            $('#statusModal').modal('show');
            
            // Set up confirm button handler
            document.getElementById('confirmStatusChange').onclick = function() {
                changeStatus(id, isActive);
                $('#statusModal').modal('hide');
            };
            
            // Revert if canceled
            $('#statusModal').on('hidden.bs.modal', function() {
                e.target.checked = !isActive;
            });
        }
    });
}

function changeStatus(id, isActive) {
    $.ajax({
    url: 'post/category/categories.php',
    type: 'POST',
    dataType: 'json', // Ensure JSON is expected and auto-parsed
    data: {
        id: id,
        change_status: true,
        is_active: isActive ? 1 : 0
    },
    success: function(data) {
        if (data.success) {
            // Update UI
            var badge = document.getElementById('status-badge-' + id);
            var toggle = document.querySelector('.status-toggle-input[data-id="' + id + '"]');
            
            if (isActive) {
                badge.className = 'status-badge active';
                badge.textContent = 'Active';
                toggle.checked = true;
            } else {
                badge.className = 'status-badge inactive';
                badge.textContent = 'Inactive';
                toggle.checked = false;
            }

            showAlert('Status updated successfully', 'success');
        } else {
            showAlert(data.message || 'Error updating status', 'error');
            // Revert toggle if failed
            var toggle = document.querySelector('.status-toggle-input[data-id="' + id + '"]');
            toggle.checked = !isActive;
        }
    },
    error: function(xhr, status, error) {
        console.error('AJAX Error:', status, error);
        showAlert('Error updating status', 'error');
    }
});


}

function initializeDeleteHandlers() {
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-item')) {
            e.preventDefault();
            var id = e.target.closest('.delete-item').dataset.id;
            deleteItem(id);
        }
    });
}

function deleteItem(id) {
    if (confirm('Are you sure you want to delete this menu item?')) {
        $.ajax({
            url: 'post/category/categories.php',
            type: 'POST',
            data: {
                id: id,
                delete: true
            },
            success: function(response) {
                try {
                    var data = JSON.parse(response);
                    if (data.success) {
                        // Remove item from UI
                        var item = document.querySelector('.menu-item[data-id="' + id + '"]');
                        if (item) {
                            item.parentNode.removeChild(item);
                        }
                        showAlert('Item deleted successfully', 'success');
                    } else {
                        showAlert(data.message || 'Error deleting item', 'error');
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    showAlert('Error processing response', 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                showAlert('Error deleting item', 'error');
            }
        });
    }
}

function initializeSequenceButtons() {
    document.addEventListener('click', function(e) {
        if (e.target.closest('.sequence-up') || e.target.closest('.sequence-down')) {
            var btn = e.target.closest('.sequence-up, .sequence-down');
            var item = btn.closest('.menu-item');
            var id = item.dataset.id;
            var direction = btn.classList.contains('sequence-up') ? 'up' : 'down';
            
            changeSequence(id, direction);
        }
    });
}

function changeSequence(id, direction) {
    const item = document.querySelector('.menu-item[data-id="' + id + '"]');
    const parentElement = item.closest('.menu-item-children') || item.parentElement;
    const parentId = parentElement.dataset.parent || 0;

    $.ajax({
        url: 'post/category/categories.php',
        type: 'POST',
        data: {
            id: id,
            parent_id: parentId,
            change_sequence: true,
            direction: direction
        },
        success: function(response) {
            try {
                const data = typeof response === 'object' ? response : JSON.parse(response);

                if (data.success && Array.isArray(data.new_order)) {
                    // Reorder DOM based on new_order
                    const container = parentElement;
                    const allItems = Array.from(container.querySelectorAll('.menu-item'));
                    const itemMap = {};
                    allItems.forEach(el => {
                        const itemId = el.dataset.id;
                        if (itemId) itemMap[itemId] = el;
                    });

                    // Clear and rebuild container based on new_order
                    container.innerHTML = '';
                    data.new_order.forEach(itemId => {
                        if (itemMap[itemId]) {
                            container.appendChild(itemMap[itemId]);
                        }
                    });

                    // Optionally update sequence numbers
                    data.new_order.forEach((itemId, index) => {
                        const el = itemMap[itemId];
                        const seqSpan = el.querySelector('.sequence-number');
                        if (seqSpan) {
                            seqSpan.textContent = index + 1;
                        }
                    });

                    showAlert('Sequence updated', 'success');
                } else {
                    showAlert(data.message || 'No changes were made', 'info');
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                showAlert('Error processing response', 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            showAlert('Failed to update sequence', 'danger');
        }
    });
}

function updateMenuOrder(item, newPosition, parentId = 0) {
    const id = item.dataset.id;
    const originalPosition = item.dataset.originalIndex ? parseInt(item.dataset.originalIndex) + 1 : null;
    
    $.ajax({
        url: 'post/category/categories.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            position: newPosition + 1, // Convert to 1-based
            parent_id: parentId,
            update_order: true
        },
        success: function(data) {
            if (data.success) {
                if (data.changed) {
                    // Only update UI if something actually changed
                    updateUIAfterReorder(id, data.new_sequence, data.parent_id);
                    showAlert('Menu order updated successfully', 'success');
                } else {
                    // No actual change needed
                    console.log('No sequence change needed');
                }
            } else {
                revertUIPosition(item, originalPosition);
                showAlert(data.message || 'Error updating menu order', 'error');
            }
        },
        error: function(xhr, status, error) {
            revertUIPosition(item, originalPosition);
            showAlert('Error updating menu order', 'error');
            console.error('AJAX Error:', status, error);
        }
    });
}

// Store original position when drag starts
document.querySelectorAll('[data-id]').forEach(item => {
    item.addEventListener('dragstart', function() {
        this.dataset.originalIndex = Array.from(this.parentNode.children)
            .indexOf(this);
    });
});

function updateUIAfterReorder(itemId, newSequence, parentId) {
    // Update the sequence number display
    const sequenceElement = document.querySelector(`.menu-item[data-id="${itemId}"] .sequence-number`);
    if (sequenceElement) {
        sequenceElement.textContent = newSequence;
    }
    
    // You might want to add additional UI updates here
    // For example: visual feedback, parent relationship changes, etc.
}

function revertUIPosition(item) {
    // This would revert the item to its original position in the DOM
    // You might need to store the original position before moving
    console.warn('Reverting UI position for item', item.dataset.id);
    // Implement your specific revert logic here
}

// Initialize Sortable with proper event handlers
function initializeSortable() {
    try {
        // Main container
        new Sortable(document.getElementById('sortable-menu'), {
            handle: '.menu-item-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            onStart: function(evt) {
                // Store original position if needed for revert
                evt.item.dataset.originalIndex = evt.oldIndex;
            },
            onEnd: function(evt) {
                const parentContainer = evt.to;
                const parentId = parentContainer.closest('.menu-item-children')?.dataset.parent || 0;
                updateMenuOrder(evt.item, evt.newIndex, parentId);
            }
        });
        
        // Child containers
        document.querySelectorAll('.menu-item-children').forEach(function(el) {
            new Sortable(el, {
                handle: '.menu-item-handle',
                animation: 150,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                group: 'nested',
                onStart: function(evt) {
                    evt.item.dataset.originalIndex = evt.oldIndex;
                },
                onEnd: function(evt) {
                    const parentId = el.dataset.parent;
                    updateMenuOrder(evt.item, evt.newIndex, parentId);
                }
            });
        });
    } catch (e) {
        console.error('Sortable initialization error:', e);
    }
}

// Call this when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initializeSortable();
});