<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Validate input
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please fill all fields correctly.";
        exit;
    }

    // Prevent header injection
    if (preg_match("/[\r\n]/", $email)) {
        echo "Invalid email address.";
        exit;
    }

    // Recipient email
    $recipient = "namandangwal@gmail.com"; // <-- Replace with your email

    // Email subject
    $email_subject = "New Contact Form Message from $name";

    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $email_headers = "From: $name <$email>";

    // Send the email
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        echo "Your message has been sent. Thank you!";
    } else {
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
}
?>
