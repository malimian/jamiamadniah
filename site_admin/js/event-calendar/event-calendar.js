// Global variables
var calendar;
var currentEventId = null;

// Document ready function
document.addEventListener('DOMContentLoaded', function() {
    initializeCalendar();
    setupEventHandlers();
    
    // Set current datetime as default for new events
    var now = new Date();
    var formattedNow = now.toISOString().slice(0, 16);
    document.getElementById('start_date').value = formattedNow;
});

// Initialize FullCalendar
function initializeCalendar() {
    var calendarEl = document.getElementById('calendar');
    
    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventBackgroundColor: '#3498db',
        eventBorderColor: '#2980b9',
        eventTextColor: '#ffffff',
        events: calendarEvents,
        eventClick: function(info) {
            showEventDetails(info.event);
        }
    });
    
    calendar.render();
}

// Setup all event handlers
function setupEventHandlers() {
    // Add event form submission
    $('#addEventForm').submit(function(e) {
        e.preventDefault();
        addNewEvent();
    });
    
    // Delete event button
    $('#deleteEventBtn').click(function() {
        $('#confirmDeleteModal').modal('show');
    });
    
    // Confirm delete button
    $('#confirmDeleteBtn').click(function() {
        deleteEvent(currentEventId);
    });
}

// Show event details in modal
function showEventDetails(event) {
    currentEventId = event.id;
    
    var detailsHtml = `
        <div class="row">
            <div class="col-md-6">
                <h4><i class="fas fa-calendar-alt mr-2"></i>${event.title}</h4>
                <p class="text-muted"><i class="fas fa-clock mr-2"></i><strong>Date:</strong> ${event.start ? event.start.toLocaleString() : ''} 
                ${event.end ? ' to ' + event.end.toLocaleString() : ''}</p>
            </div>
            <div class="col-md-6 text-right">
                ${event.extendedProps.featured_image ? 
                    `<img src="${event.extendedProps.featured_image}" class="img-fluid rounded" alt="Event Image" style="max-height: 150px;">` : 
                    '<div class="bg-light p-4 rounded text-center"><i class="fas fa-image fa-3x text-muted"></i><p class="mt-2">No Image</p></div>'}
            </div>
        </div>
        
        ${event.extendedProps.description ? 
            `<div class="mt-3 p-3 bg-light rounded">
                <h5><i class="fas fa-align-left mr-2"></i>Description</h5>
                <p>${event.extendedProps.description}</p>
            </div>` : ''}
        
        <div class="user-info mt-4">
            <h5><i class="fas fa-user mr-2"></i>Event created By</h5>
            <div class="d-flex align-items-center">
                ${event.extendedProps.user_photo ? 
                    `<img src="${event.extendedProps.user_photo}" class="rounded-circle mr-3" style="width: 80px; height: 80px; object-fit: cover;" alt="User Photo">` : 
                    '<div class="rounded-circle bg-secondary mr-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;"><i class="fas fa-user fa-2x text-white"></i></div>'}
                <div>
                    <p class="mb-1"><strong>Name:</strong> ${event.extendedProps.user_name || 'N/A'}</p>
                    <p class="mb-1"><strong>Email:</strong> ${event.extendedProps.user_email || 'N/A'}</p>
                    <p class="mb-1"><strong>Phone:</strong> ${event.extendedProps.user_phone || 'N/A'}</p>
                </div>
            </div>
        </div>
    `;
    
    $('#eventDetailsContent').html(detailsHtml);
    $('#eventDetailsModal').modal('show');
}

// Add new event using senddata function
function addNewEvent() {
    var formData = $('#addEventForm').serializeArray();
    var data = {};
    
    $.each(formData, function(i, field) {
        data[field.name] = field.value;
    });
    data['add_event'] = true;
    
    senddata(
        'post/event-calendar/event-calendar-post.php',
        'POST',
        data,
        function(response) {
            // Success callback
            if(response.success) {
                // Add new event to calendar
                calendar.addEvent({
                    id: response.event_id,
                    title: data.title,
                    start: data.start_date,
                    end: data.end_date,
                    description: data.description,
                    featured_image: data.featured_image,
                    user_id: data.user_id
                });
                
                // Show success message
                showNotification('success', 'Event added ');
                
                // Close modal and reset form
                $('#addEventModal').modal('hide');
                $('#addEventForm')[0].reset();
            } else {
                showNotification('danger', response.message || 'Failed to add event.');
            }
        },
        function(error) {
            // Failure callback
            showNotification('danger', 'Error: ' + error.statusText);
        }
    );
}

// Delete event using senddata function
function deleteEvent(eventId) {
    senddata(
        'post/event-calendar/event-calendar-post.php',
        'POST',
        { event_id: eventId, delete_event: true },
        function(response) {
            if(response.success) {
                // Remove event from calendar
                var event = calendar.getEventById(eventId);
                if(event) {
                    event.remove();
                }
                
                // Show success message
                showNotification('success', 'Event deleted');
                
                // Close modals
                $('#eventDetailsModal').modal('hide');
                $('#confirmDeleteModal').modal('hide');
            } else {
                showNotification('danger', response.message || 'Failed to delete event.');
            }
        },
        function(error) {
            showNotification('danger', 'Error: ' + error.statusText);
        }
    );
}

// Show notification
function showNotification(type, message) {
    // You can implement your own notification system here
    showAlert(message , "success"); // Simple alert for demonstration
}

// Confirm action function
function confirmAction(message) {
    return confirm(message);
}