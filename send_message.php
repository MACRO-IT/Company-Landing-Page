<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
//Load Composer's autoloader
require 'vendor/autoload.php';  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Get the message submited Sanitize and validated it
$message = htmlspecialchars(trim($_POST['message']));
$name = htmlspecialchars($_POST['name']);
$subject = htmlspecialchars($_POST['subject']);
$email = htmlspecialchars(trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)));

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


try {
    //Server settings
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = 'df9295f8544401';
    $mail->Password = 'eae007bb30ec8c';

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('enquiries@macro-it.net', 'MACRO-IT');     //Add a recipient
    $mail->addAddress('chewe@macro-it.net');               //Name is optional
    $mail->addReplyTo($email, $name);
    $mail->addCC('chanda@macro-it.net');
    $mail->addBCC('chanda@macro-it.net');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = $message;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}