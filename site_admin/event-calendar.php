<?php 
include 'admin_connect.php';

// With additional libraries - adding FullCalendar and moment.js
$extra_libs = [
    '<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">',
    '<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>'
];

AdminHeader(
    "Event Calendar", 
    "", 
    $extra_libs,
    null,
    '
    <style>
        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }
        .fc-event {
            cursor: pointer;
        }
        .modal-body .form-group {
            margin-bottom: 15px;
        }
    </style>
    '
);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_event'])) {
        $title = clean($_POST['title']);
        $start_date = clean($_POST['start_date']);
        $end_date = clean($_POST['end_date']);
        $description = clean($_POST['description']);
        
        $sql = "INSERT INTO events (title, start_date, end_date, description) 
                VALUES ('$title', '$start_date', '$end_date', '$description')";
        $insert_id = Insert($sql);
        
        if ($insert_id) {
            $_SESSION['notification'] = [
                'type' => 'success',
                'message' => 'Event added successfully!'
            ];
        } else {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Failed to add event.'
            ];
        }
        header("Location: event-calendar.php");
        exit();
    }
    
    if (isset($_POST['delete_event'])) {
        $event_id = clean($_POST['event_id']);
        $sql = "DELETE FROM events WHERE id = '$event_id'";
        $deleted = Delete($sql);
        
        if ($deleted) {
            $_SESSION['notification'] = [
                'type' => 'success',
                'message' => 'Event deleted successfully!'
            ];
        } else {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Failed to delete event.'
            ];
        }
    }
}

// Fetch all events
$events = return_multiple_rows("SELECT * FROM events ORDER BY start_date ASC");
?>

<body id="page-top">

    <?php include 'includes/notification.php';?>

    <div id="wrapper">
        <?php include 'includes/sidebar.php'; ?>
        
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo $_SESSION['user']['dashboard'];?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Event Calendar</li>
                </ol>

                <!-- Page Content -->
                <h1>Event Calendar</h1>
                <hr>
                
                <div class="mb-4">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addEventModal">
                        <i class="fas fa-plus"></i> Add New Event
                    </button>
                </div>
                
                <div id="calendar"></div>
            </div>
            <!-- /.container-fluid -->

            <?php include 'includes/footer_copyright.php';?>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Event Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="datetime-local" class="form-control" id="end_date" name="end_date">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_event" class="btn btn-primary">Save Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Event Modal -->
    <div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEventModalLabel">Delete Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" id="event_id" name="event_id">
                        <p>Are you sure you want to delete this event?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete_event" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php';?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    <?php foreach($events as $event): ?>
                    {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo addslashes($event['title']); ?>',
                        start: '<?php echo $event['start_date']; ?>',
                        end: '<?php echo $event['end_date']; ?>',
                        description: '<?php echo addslashes($event['description']); ?>'
                    },
                    <?php endforeach; ?>
                ],
                eventClick: function(info) {
                    $('#event_id').val(info.event.id);
                    $('#deleteEventModal').modal('show');
                }
            });
            
            calendar.render();
            
            // Set current datetime as default for new events
            var now = new Date();
            var formattedNow = now.toISOString().slice(0, 16);
            document.getElementById('start_date').value = formattedNow;
        });
    </script>
</body>
</html>