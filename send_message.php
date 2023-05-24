<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
//Load Composer's autoloader
require 'vendor/autoload.php';  
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Get the message submited Sanitize and validate it
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
    $mail->Host = $_ENV['MAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = $_ENV['MAIL_USERNAME'];
    $mail->Password = $_ENV['MAIL_PASSWORD'];

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('enquiries@macro-it.net', 'MACRO-IT');     //Add a recipient
    $mail->addAddress('MACRO-IT');               //Name is optional
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
    echo 'OK';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



