<?php
include '../../admin_connect.php';

header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => '',
    'event_id' => null
];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add_event'])) {
            $title = escape($_POST['title']);
            $start_date = escape($_POST['start_date']);
            $end_date = escape($_POST['end_date']);
            $description = escape($_POST['description']);
            $featured_image = escape($_POST['featured_image']);
            $user_id = escape($_POST['user_id']);
            
            $sql = "INSERT INTO events (title, start_date, end_date, description, featured_image, user_id) 
                    VALUES ('$title', '$start_date', '$end_date', '$description', '$featured_image', '$user_id')";
            $insert_id = Insert($sql);
            
            if ($insert_id) {
                $response['success'] = true;
                $response['message'] = 'Event added successfully!';
                $response['event_id'] = $insert_id;
            } else {
                $response['message'] = 'Failed to add event.';
            }
        }
        
        if (isset($_POST['delete_event'])) {
            $event_id = escape($_POST['event_id']);
            $sql = "DELETE FROM events WHERE id = '$event_id'";
            $deleted = Delete($sql);
            
            if ($deleted) {
                $response['success'] = true;
                $response['message'] = 'Event deleted successfully!';
            } else {
                $response['message'] = 'Failed to delete event.';
            }
        }
    }
} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

echo json_encode($response);