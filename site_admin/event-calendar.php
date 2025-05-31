<?php 
include 'admin_connect.php';

// With additional libraries - adding FullCalendar and moment.js
$extra_libs = [
    '<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">',
    '<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>',
    '<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.0.0/css/all.min.css" rel="stylesheet">'
];

AdminHeader(
    "Event Calendar", 
    "", 
    $extra_libs,
    null,
    '
    <link href="css/event-calendar/event-calendar.css" rel="stylesheet">

    '
);

// Fetch all events with user information
$events = return_multiple_rows("
    SELECT e.*, u.username, u.emailaddress, u.phonenumber, u.profile_pic 
    FROM events e
    LEFT JOIN loginuser u ON e.user_id = u.id
    ORDER BY e.start_date ASC
");
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Event Calendar</h1>
                    <button class="btn btn-add-event btn-primary" data-toggle="modal" data-target="#addEventModal">
                        <i class="fas fa-plus"></i> Add New Event
                    </button>
                </div>
                
                <hr class="mb-4">
                
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addEventForm">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Event Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="featured_image" class="col-sm-2 col-form-label">Featured Image</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="featured_image" placeholder="Choose Image" name="featured_image">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" onclick="OpenMediaGallery('featured_image' , null)" type="button">
                                            <i class="fa fa-image"></i> Gallery
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                            </div>
                        </div>
                        
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="eventDetailsModalLabel">Event Details</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body event-details">
                    <div id="eventDetailsContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="deleteEventBtn">Delete Event</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this event? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php';?>
    <script>
        // Initialize calendar with events data
        var calendarEvents = [
            <?php foreach($events as $event): ?>
            {
                id: '<?php echo $event['id']; ?>',
                title: '<?php echo addslashes($event['title']); ?>',
                start: '<?php echo $event['start_date']; ?>',
                end: '<?php echo $event['end_date']; ?>',
                description: '<?php echo addslashes($event['description']); ?>',
                featured_image: '<?php echo (!empty($event['featured_image'])) ? BASE_URL.ABSOLUTE_IMAGEPATH.addslashes($event['featured_image']) : ""; ?>',
                user_id: '<?php echo $event['user_id']; ?>',
                user_name: '<?php echo addslashes($event['fullname']); ?>',
                user_email: '<?php echo addslashes($event['emailaddress']); ?>',
                user_phone: '<?php echo addslashes($event['phonenumber']); ?>',
                user_photo: '<?php echo (!empty($event['profile_pic'])) ? BASE_URL.ABSOLUTE_IMAGEPATH.addslashes($event['profile_pic']) : "" ; ?>'
            },
            <?php endforeach; ?>
        ];
    </script>
    <script src="js/event-calendar/event-calendar.js"></script>

   <?php echo include_module('modules/upload_image.php' , null);?>
