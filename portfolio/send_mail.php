<?php
  /*$name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $to = 'manjusk017@gmail.com';
  $subject = 'Message from ' . $name;
  $headers = 'From: ' . $email . "\r\n" .
             'Subject:' . $subject . "\r\n".
             'Reply-To: ' . $email . "\r\n" .
              "CC:manjusk017@gmail.com";
*/
    
if ($_SERVER["REQUEST_METHOD"] === "POST" ){

try{
  
$mailid=new PHPMailer(true);
$mailid->isSMTP();
$mailid->Host='smtp.gmail.com';
$mailid->SMTPAuth=true;
$mailid->Username='manjusk017@gmail.com';
$mailid->Password='jsxfxhrowoonpotl';
$mailid->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
$mailid->Port=465;

$mailid->setFrom('manjusk017@gmail.com','Manjunath SK');

$mailid->addAddress($_POST["user_mail"],$_POST['user_name']);
  
$mailid->isHTML(true);

$mailid->Subject="Thank you for visiting my website";
$mailid->Body=$_POST['user_name'].  ", Thank you for visiting my website, I received your message,
<br> Here is your message: ". $_POST['user_message'];

$mailid->send();

echo "<script> alert('Successfull!');
document.location.href='home.php';  
      </script>";
    }

    catch(Exception $e){
        echo "<script>alert('Error: '.$mailid->ErrorInfo );</script> " ;
    }

}else{
    echo "<script>alert('Given Email is not correct!');</script>";
}
}
else{
    echo "<script>alert('Failed to load your request for some reason try again');</script>";
}
  
?>
