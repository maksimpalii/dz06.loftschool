<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once __DIR__ . '/vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.mail.ru';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'maksloft@mail.ua';                 // SMTP username
    $mail->Password = '*******';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('maksloft@mail.ua', 'Mailer');
    // $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress('maksim.palii@gmail.com');               // Name is optional
    $mail->addReplyTo('maksloft@mail.ua', 'Information');
    // $mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}