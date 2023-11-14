<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$payload = file_get_contents("php://input");
$data = json_decode($payload);

 
switch ($data->identifier) {
    case md5("contactUs"):

// first name vailidation

      if (empty($data->fname)) {
        $pre_resp = json_encode([
            "status" => "error",
            "validation" => "fail",
            "for" => "fname",
            "msg" => "Please fill first name",
        ]);
        echo $pre_resp;
        exit();
    } elseif(is_numeric($data->fname)){
      $pre_resp = json_encode([
        "status" => "error",
        "validation" => "fail",
        "for" => "fname",
        "msg" => "Please Enter Alphabatic Charectors",
    ]);
    echo $pre_resp;
    exit();
    }
    elseif(ctype_alpha($data->fname)){
      $pre_resp = json_encode([
        "status" => "error",
        "validation" => "fail",
        "for" => "fname",
        "msg" => "Please Enter Alphabatic Charectors",
    ]);
    echo $pre_resp;
    exit();
    }

// Last name vailidation 
    if (empty($data->lname)) {
      $pre_resp = json_encode([
          "status" => "error",
          "validation" => "fail",
          "for" => "lname",
          "msg" => "Please fill last name",
      ]);
      echo $pre_resp;
      exit();
  } elseif(is_numeric($data->lname)){
    $pre_resp = json_encode([
      "status" => "error",
      "validation" => "fail",
      "for" => "lname",
      "msg" => "Please Enter Alphabatic Charectors",
  ]);
  echo $pre_resp;
  exit();
  }
  elseif(ctype_alpha($data->lname)){
    $pre_resp = json_encode([
      "status" => "error",
      "validation" => "fail",
      "for" => "lname",
      "msg" => "Please Enter Alphabatic Charectors",
  ]);
  echo $pre_resp;
  exit();
  }
  
//email vailidation 

  if(filter_var($data->email)){
    $pre_resp = json_encode([
      "status" => "error",
      "validation" => "fail",
      "for" => "email",
      "msg" => "Please enter an acurate email",
  ]);
  echo $pre_resp;
  exit();
}

// Phone Number Vailidation

if (empty($data->phone)) {
  $pre_resp = json_encode([
  "status" => "error",
  "validation" => "fail",
  "for" => "phone",
  "msg" => "Phone No is empty",
  ]);
  echo $pre_resp;
  exit();
  } elseif (preg_match('/^[6-9][0-9]{9}$/', $data->phone) != 1) {
  $pre_resp = json_encode([
  "status" => "error",
  "validation" => "fail",
  "for" => "phone",
  "msg" => "Invalid Phone No",
  ]);
  echo $pre_resp; 
  exit();
  }
break;
default:
$resp = json_encode([
"for" => "api",
"msg" => "Unknown Request, cannot be processed",

]);
echo $resp;
exit();
}