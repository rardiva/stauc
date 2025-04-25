<?php
if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500); // Sets HTTP response code to 500 (Internal Server Error) if any required fields are empty or email is invalid
  exit(); // Stops script execution
}

$name = strip_tags(htmlspecialchars($_POST['name'])); // Removes HTML and PHP tags, then converts special characters to prevent XSS attacks
$email = strip_tags(htmlspecialchars($_POST['email'])); // Same sanitization applied to the email input
$m_subject = strip_tags(htmlspecialchars($_POST['subject'])); // Same sanitization applied to the subject input
$message = strip_tags(htmlspecialchars($_POST['message'])); // Same sanitization applied to the message input

$to = "100ivalaoa@gmail.com"; // Recipient email address
$subject = "$m_subject:  $name"; // Constructs the email subject by combining the subject with sender's name
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message"; // Composes the email body with user-submitted data
$header = "From: $email"; // Sets the sender's email in the header
$header .= "Reply-To: $email"; // Adds reply-to address in email header  

if(!mail($to, $subject, $body, $header)) // Sends the email, returns false if the sending fails
  http_response_code(500); // Sets HTTP response code to 500 if mail sending fails
?>
