
<pre>
<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPAuth = false;
$mail->Username = '';
$mail->Password = '';
$mail->setFrom('gsnoreply@dsngroup.go.id', 'no-reply');
$mail->addAddress('nurasto@gmail.com');
$mail->Subject = 'Testing GS No Reply';
$mail->Body = 'Testing GS No Reply. This is the message biody';

if(!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Mail was sent';
}