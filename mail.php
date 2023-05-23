<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $recipient = 'raflyrusdian340@gmail.com'; 
  $subject = 'User Message';
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  try {
    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'raflyrusdian340@gmail.com'; // Replace with your Gmail email address
    $mail->Password = 'Chikatochikatsu'; // Replace with your Gmail email password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender and recipient
    $mail->setFrom($email, $name);
    $mail->addAddress($recipient);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send the email
    $mail->send();

    // Sending email successful
    http_response_code(200); // Set response code to indicate success
    echo 'Email sent successfully';
  } catch (Exception $e) {
    // Sending email failed
    http_response_code(500); // Set response code to indicate internal server error
    echo 'Error sending email: ' . $mail->ErrorInfo;
  }
} else {
  // Invalid request method
  http_response_code(405); // Set response code to indicate method not allowed
  echo 'Method Not Allowed';
}
?>
