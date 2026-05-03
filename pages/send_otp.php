<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include("../config/db.php");

$email = $_POST['email'];
$otp = rand(100000,999999);

// Save OTP
$conn->query("UPDATE users SET otp='$otp' WHERE email='$email'");

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@gmail.com';
    $mail->Password = 'your_app_password';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('your_email@gmail.com', 'LF App');
    $mail->addAddress($email);

    $mail->Subject = 'Your OTP Verification';
    $mail->Body = "Your OTP is: $otp";

    $mail->send();

    echo "OTP sent!";
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
?>