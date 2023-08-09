<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/PHPMailer/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/PHPMailer/src/SMTP.php';

 


if ($_SERVER["REQUEST_METHOD"] === "POST" ){


    //Email validation and sending mail

    if(filter_var($_POST['user_mail'],FILTER_VALIDATE_EMAIL)){

    
    try{

        $mailid=new PHPMailer(true);
        $mailid->isSMTP();
        $mailid->Host='smtp.gmail.com';
        $mailid->SMTPAuth=true;
        $mailid->Username='manjusk017@gmail.com';
        $mailid->Password='leesgvgvagpsuqbu';
        $mailid->SMTPSecure='tls';
        $mailid->Port=465;

$mailid->setFrom('manjusk017@gmail.com','Manjunath SK');

$mailid->addAddress($_POST["user_mail"],$_POST['user_name']);
$mailid->isHTML(true);

$mailid->Subject=ucwords($_POST['user_name']) .' Thank you for Visiting My website';
$mailid->Body=ucfirst($_POST['user_name']).  ",Thank you for visiting My website,i got your message,<br>If there's a need i will respond back... 
<br> here's your message: " ."'". $_POST['user_message']."'"."<br><br>Have a Nice Day!<br><br> &nbsp;&nbsp; -Manjunath SK.";

$mailid->send();

echo "<script> alert('Message sent! we will send you a confirmation mail.');
        document.location.href='index.html';
      </script>";
    }

    catch(Exception $e){
        echo "error: " .$mailid->ErrorInfo;
    }

}else{
    echo("Given Email is not correct!");
}
}
else{
    echo "<script>alert('failed to load POST')</script>";
}



?>
