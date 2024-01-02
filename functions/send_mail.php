<?php
header('Content-Type: text/html; charset=UTF-8');
use PHPMailer\PHPMailer\PHPMailer;

function sendMail($template, $to, $subject, $data = []){
    require VENDOR_AUTOLOAD;
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = HOST;
    $mail->Port = PORT;
    $mail->SMTPAuth = true;
    $mail->CharSet = 'UTF-8';
    $mail->Username = USER_ACOUNT;
    $mail->Password = KEY_ACOUNT;


    $mail->addAddress($to);
    $mail->Subject = $subject;
    
    $mail->isHTML(true);

    $body = file_get_contents( EMAILS . $template);

    foreach($data as $key => $value){
        $body = str_replace('{' . strtoupper($key) . '}', $value, $body);
    }

    $mail->msgHTML($body);

    $mail_status = [];
    if (!$mail->send()) {
        return $mail_status['email_status'] = 'Mailer Error: ' . $mail->ErrorInfo;
    }else{
        return True;
    }
}

?>