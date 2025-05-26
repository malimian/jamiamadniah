<?php
include '../connect.php';
header('Content-Type: application/json');

// Initialize response array
$response = [
    'success' => false,
    'message' => '',
    'data' => [],
    'errors' => []
];

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and collect all POST data (except submit button)
    foreach ($_POST as $key => $value) {
        if ($key == 'submit') continue;
        $response['data'][$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    // Only proceed if no errors
    if (empty($response['errors'])) {
        // Set the recipient email address
        $to = EMAIL; // Replace with your email
        
        // Set email subject
        $subject = 'New Form Submission -'.SITE_TITLE;
        
        // Build email message
        $message = "Form Submission Details:\n\n";
        foreach ($response['data'] as $key => $value) {
            $message .= ucfirst($key) . ": $value\n";
        }
        
        // Set email headers
        $headers = "From: ".EMAIL."\r\n";
        $headers .= "Reply-To: ".EMAIL."\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // Send the email
            $mailSent = 1;
            if(!($_SERVER['REMOTE_ADDR'] == "::1" || $_SERVER['REMOTE_ADDR'] == "127.0.0.1")){
                
                $mailSent = mail($to, $subject, $message, $headers);
            }

        if ($mailSent) {
            $response['success'] = true;
            $response['message'] = 'Thank you! Your message has been sent successfully.';
        } else {
            $response['message'] = 'Failed to send email. Please try again later.';
            $response['errors']['mail'] = 'Mail function failed';
        }
    } else {
        $response['message'] = 'Please correct the errors in the form.';
    }
} else {
    $response['message'] = 'Invalid request method. Please submit the form.';
}

// Return JSON response

echo json_encode($response);
exit;
?>