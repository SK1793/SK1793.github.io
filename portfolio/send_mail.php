<?php
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $to = 'manjusk017@gmail.com';
  $subject = 'Message from ' . $name;
  $headers = 'From: ' . $email . "\r\n" .
             'Subject:' . $subject . "\r\n".
             'Reply-To: ' . $email . "\r\n" .
             'X-Mailer: PHP/' . phpversion();
  if (mail($to, $subject, $message, $headers)) {
    echo "Email sent";
  } else {
    echo "Email sending failed";
  }
?>
