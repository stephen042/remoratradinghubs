<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/SMTP.php";

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host       = "smtp.titan.email";
$mail->SMTPAuth   = true;
$mail->Username   = "noreply@excceedder.com";
$mail->Password   = "Southecured@072##@!";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465;
$mail->setFrom($mail->Username, "Excceedder");
$mail->isHTML(true);
