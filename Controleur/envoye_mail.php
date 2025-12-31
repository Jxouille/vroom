<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '4038c6cc664fff';     ////// À remplacer par vos identifiants Mailtrap
        $mail->Password = '0bc3ae9a13f440'; /////////// À remplacer par vos mdp Mailtrap
        $mail->Port = 2525;

        $mail->setFrom('no-reply@vroom.test', 'Vroom Service');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        echo "✅ Email sent successfully";
        return true;
    } catch (Exception $e) {
        echo "❌ Mail error: " . $mail->ErrorInfo;
        return false;
    }
}


