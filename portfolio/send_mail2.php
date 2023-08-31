<?php 
require_once "vendor/autoload.php"; //PHPMailer Object 
$mail = new PHPMailer; //From email address and name 
$mail->From = "manju@sk017@gmail.com"; 
$mail->FromName = "Manjunath SK"; //To address and name 
$mail->addAddress("manjusk1793@gmail.com", "Recepient1");//Recipient name is optional
$mail->addAddress("manjusk1793@gmail.com"); //Address to which recipient will reply 
$mail->addReplyTo("manjusk017@gmail.com", "Some Reply"); //CC and BCC 
$mail->addCC("cc@sk.com"); 
$mail->addBCC("bcc@example.com"); //Send HTML or Plain Text email 
$mail->isHTML(true); 
$mail->Subject = "Subject Text"; 
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content"; 
if(!$mail->send()) 
{
echo "Mailer Error: " . $mail->ErrorInfo; 
} 
else { echo "Message has been sent successfully"; 
}
if(!$mail->send()) 
{ 
echo "Mailer Error: " . $mail->ErrorInfo; 
} 
else 
{ 
echo "Message has been sent successfully"; 
}
