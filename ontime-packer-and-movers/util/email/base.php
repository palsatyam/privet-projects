<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__ . "/../../vendor/autoload.php";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPOptions = [
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true,
        ],
    ];
    $mail->SMTPDebug = SMTP::DEBUG_OFF; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = "smtp-relay.brevo.com"; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = "houseshiftingpartner@gmail.com"; //SMTP username
    $mail->Password = "NLZOSg74CDGJ1nAM"; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
    $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("mail@houseshiftingpartner.com", "House Shifting Partner");
    $mail->addAddress("imailtosatyam@gmail.com", "Satyam Pal"); //Add a recipient
    $mail->addReplyTo(
        "mail@houseshiftingpartner.com",
        "House Shifting Partner"
    );

    // Getting Data From Contact Form
    $fname = $data->fname;
    $lname = $data->lname;
    $email = $data->email;
    $phone = $data->phone;
    $message = htmlspecialchars($data->msg);

    $subject = "This Mail From " . $fname . " " . $lname;

    $body =
        "Client Name: " .
        $fname .
        " " .
        $lname .
        "<br>" .
        "Email: " .
        $email .
        "<br>" .
        "Phone Number: " .
        $phone .
        "<br>" .
        "Message: " .
        $message;

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject; // 'New Request From Contact Form';
    $mail->Body = $body;

    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();

    $pre_resp = json_encode([
        "status" => "success",
        "for" => "contact_form",
        "msg" => "Mail Sent Successfully",
    ]);
    echo $pre_resp;
    exit();
} catch (Exception $e) {
    $pre_resp = json_encode([
        "status" => "error",
        "for" => "contact_form",
        "msg" => $mail->ErrorInfo,
    ]);
    echo $pre_resp;
    exit();
}
?>
