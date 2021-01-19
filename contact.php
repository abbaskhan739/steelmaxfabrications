<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$namee = strip_tags($_POST['name']);
$emaill = strip_tags($_POST['email']);
$subject = strip_tags($_POST['subject']);
$message = strip_tags($_POST['message']);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'dqureshiumar@gmail.com';                     // SMTP username
    $mail->Password   = 'Siddika@2901';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('noreply@steelmaxfabrications.com', 'SteelMax Fabrications');
    $mail->addAddress('dqureshiumar@gmail.com', 'SteelMax Fabrications');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@steelmaxfabrications.com', 'SteelMax Fabrications');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = 'Name:'.$namee.'<br>Email:'.$emaill.'<br>Message:'.$message;
    #$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    if($mail->send()){
        echo "Thank you for contacting us. We'll get back to you shortly";
    }
    else{
        echo "Error sending mail";
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    die();
}
?>