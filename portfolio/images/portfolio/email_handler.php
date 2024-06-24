<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    // Validate input
    if ($email && $message) {
        // Email details
        $to = '23BIT158@sot.pdpu.ac.in';
        $subject = 'New Message from Portfolio Contact Form';
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

        // Compose the email content
        $email_content = "You have received a new message from your portfolio contact form.\n\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Message:\n$message\n";

        // Send the email
        if (mail($to, $subject, $email_content, $headers)) {
            echo json_encode(array('status' => 'success', 'message' => 'Message sent successfully.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to send message.'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid email or message.'));
    }
} else {
    // Method not allowed
    http_response_code(405);
    echo json_encode(array('status' => 'error', 'message' => 'Method Not Allowed'));
}
?>
