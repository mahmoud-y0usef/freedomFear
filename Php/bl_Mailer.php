<?php

require_once('bl_Common.php');

require_once('phpmailer/PHPMailer.php');
require_once('phpmailer/SMTP.php');
require_once('phpmailer/POP3.php');
require_once('phpmailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

const IS_SMTP = true; // Set to true if you want to use SMTP Authentication
const SMTP_HOST = "titan.rar-it.net";
const SMTP_PORT = 465;
const USE_TTLS = true;
const SMTP_USER = "support@freedom-fear.com";
const SMTP_PASSWORD = "xSUe,R9H9q.*5Mk_";


class MailCreator
{
    public function Send($from, $to, $subject, $message)
    {
        if (IS_SMTP) {
            try {
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->CharSet     = "UTF-8";
                $mail->Debugoutput = 'html';
                $mail->Host        = SMTP_HOST;
                $mail->Port        = SMTP_PORT;
                if (USE_TTLS == true) {
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                } else {
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                }               
                $mail->IsHTML(true);
                $mail->Username = SMTP_USER;
                $mail->Password = SMTP_PASSWORD;
                $mail->From     = $from;
                $mail->FromName = GAME_NAME;
                $mail->AddAddress($to);
                $mail->AddReplyTo($from, GAME_NAME);
                $mail->Subject = $subject;
                $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
                $mail->Body    = $message;
                if (!$mail->Send()) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    return false;
                } else {
                    return true;
                }
            }
            catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return false;
            }
        } else {

            // Basic PHP mail() function
            
            $headers = "From:" . $from . "\r\n";
            $headers .= "Reply-To: " . $from . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            
            if (mail($to, $subject, $message, $headers)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
?>