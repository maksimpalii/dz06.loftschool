<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail extends MainController
{
    public function sendMail($adressMail, $subject, $contentMsg)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->SMTPSecure = MAIL_SMTP;
            $mail->Port = MAIL_Port;
            $mail->setFrom(MAIL_USERNAME, 'Mailer');
            $mail->addAddress($adressMail);
            $mail->addReplyTo(MAIL_USERNAME);

            $mail->isHTML(true);                                  // Set email format to HTMLs
            $mail->Subject = $subject;
            $mail->Body    = $contentMsg;
            $mail->AltBody = $contentMsg;

            $mail->send();
            echo 'message';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

    }
}