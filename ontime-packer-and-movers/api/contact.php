<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$payload = file_get_contents("php://input");
$data = json_decode($payload);
switch (@$data->identifier) {
case md5("contactUs"):


if (empty($data->identifier)) {
$pre_resp = json_encode([
"status" => "error",
"validation" => "fail",
"for" => "pickup_mode",
"msg" => "Please choose pick up type",
]);
echo $pre_resp;
exit();
} else {
switch ($data->pick_up_mode) {
case "emergency-pick-up":
$pick_up_type = "Emergency Pick-up";
break;
case "normal-pick-up":
$pick_up_type = "Normal Pick-up";
break;
case "self-visit":
$pick_up_type = "Self Visit";
break;
default:
$pick_up_type = "Unknown";
}
}
// For Phone No
if (empty($data->phone_no)) {
$pre_resp = json_encode([
"status" => "error",
"validation" => "fail",
"for" => "phone_no",
"msg" => "Phone No is empty",
]);
echo $pre_resp;
exit();
} elseif (preg_match('/^[6-9][0-9]{9}$/', $data->phone_no) != 1) {
$pre_resp = json_encode([
"status" => "error",
"validation" => "fail",
"for" => "phone_no",
"msg" => "Invalid Phone No",
]);
echo $pre_resp;
exit();
}
// Function 'send()' Start
function send($subject, $body)
{
//Load Composer's autoloader
require __DIR__ . "/../../vendor/autoload.php";
// Instantiation and passing `true` enables exceptions
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
$mail->SMTPDebug = SMTP::DEBUG_OFF; // DEBUG_SERVER
$mail->isSMTP();
$mail->Host = "smtp.host.com";
$mail->SMTPAuth = true;
$mail->Username = "user-name";
$mail->Password = "pwd";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
//E-Mail Priority
$mail->Priority = 1;
//Recipients
$mail->setFrom("sender@domain.com", "Kalpee Auto Works");
// $mail->addCustomHeader('Return-Path', 'Username <name@domain.com>');
$mail->addAddress("receiver@domain.com", "Customer"); // Add a recipient (Name is optional)
// $mail->addAddress('ellen@example.com');
// Add a recipient (Name is optional)
// $mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com', 'BCC');
// Content
$mail->isHTML(true); // Set email format to HTML
$mail->Subject = $subject; // 'New Request From Contact Form';
$mail->Body = $body;
// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->send();
$is_send = json_encode([
"status" => "success",
"validation" => "pass",
"for" => "find_mechanic",
"msg" => "We have received your request",
]);
echo $is_send;
} catch (Exception $e) {
$is_send = json_encode([
"status" => "error",
"validation" => "pass",
"for" => "find_mechanic",
"msg" => "Endpoint failure",
]);
echo $is_send;
}
}
// Function 'send()' End
function get_client_ip()
{
$ipAddress = "";
if (isset($_SERVER["HTTP_CLIENT_IP"])) {
$ipAddress = $_SERVER["HTTP_CLIENT_IP"];
$ipType = "IPs Passing Through Router or Shared Internet/ISP IP";
} elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
$ipAddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
$ipType = "IPs Passing Through Proxies";
} elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
$ipAddress = $_SERVER["HTTP_X_FORWARDED"];
$ipType = "IPs Passing Through Forwarded Proxy";
} elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
$ipAddress = $_SERVER["HTTP_FORWARDED_FOR"];
$ipType = "IPs Forwarded";
} elseif (isset($_SERVER["HTTP_FORWARDED"])) {
$ipAddress = $_SERVER["HTTP_FORWARDED"];
$ipType = "IPs Forwarded";
} elseif (isset($_SERVER["REMOTE_ADDR"])) {
$ipAddress = $_SERVER["REMOTE_ADDR"];
$ipType = "IPs Unreliable";
}
return ["ipAddress" => $ipAddress, "ipType" => $ipType];
}
$bike_pick_up_type = $pick_up_type;
$phone_no = "+91 " . $data->phone_no;
$clientIP = get_client_ip();
$ip = $clientIP["ipAddress"];
$timestamp = date("Y-m-d H:i:s");
$req_id = date("m") . substr(str_shuffle("0123456789"), 0, 8);
$subject = "New Request from Customer " . "#" . $req_id;
$prepare_email =
nl2br(
"<b>Pick-Up Type:</b> ".$bike_pick_up_type."\r\n" .
"<b>Phone No:</b> ".$phone_no."\r\n" .
"<b>IPV4:</b> ".$ip."\r\n" .
"<b>Request DateTime:</b> ".$timestamp."\r\n"."\n\n" .
"<br>" .
"<b>Request System Powered by IT Operating</b>");
send($subject, $prepare_email);
break;
default:
$resp = json_encode([
"for" => "api",
"msg" => "Unknown Request, cannot be processed",
]);
echo $resp;
exit();
}