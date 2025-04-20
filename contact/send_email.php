<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
     
    $email_subject = "Contact Form: $email for $subject";
    $email_body = "$message";
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require'PHPMailer/src/Exception.php';
require'PHPMailer/src/PHPMailer.php';
require'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = '';                     
    $mail->Password   = '';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                   

    $mail->setFrom('from@example.com', 'Test');
    $mail->addAddress('akharraz2003@gmail.com');     



    $mail->isHTML(true);                                  
    $mail->Subject = $email_subject;
    $mail->Body    =
    $mail->AltBody = $message;

    $mail->send();
    header("Location: Contact.html");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}