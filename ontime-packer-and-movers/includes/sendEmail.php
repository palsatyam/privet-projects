<?php
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['name']) && isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['lname'];
    $email = $_POST['email'];
    $email = $_POST['phone'];
    $email = $_POST['body'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.PHP";
    require_once "PHPMailer/Exception.php";


    $mail = new PHPMailer();

    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "sp5933700@gmail.com";
    $mail->Password = 'satyam1913';
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //email Settings

    $mail->isHTML(true);
    $mail->setForm($email, $name);
    $mail->addAddress("sp5933700@gmail.com");
    $mail->Subject = ("$email ($subject");
    $mail->Body = $body;


if($mail->send()){
    $status = "Succsess";
    $response = "Email is sent!";

}
else{
    $status = "Failed";
    $response = "Something is Wrong : <br>".$mail->ErrorInfo;
}

exit(json_encode(array("status" => $status, "response" => $response)));
    
}

?>