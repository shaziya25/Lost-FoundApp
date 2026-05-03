<?php

function sendOTP($to, $otp){

    // ❌ if composer not installed → skip mail but don’t crash
    if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
        return false;
    }

    require_once(__DIR__ . '/../vendor/autoload.php');

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yourgmail@gmail.com';
        $mail->Password = 'your_app_password';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('yourgmail@gmail.com', 'LF App');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = 'LF App OTP Verification';
        $mail->Body = "<h2>Your OTP: $otp</h2>";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}