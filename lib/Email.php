<?php

    $filepath = realpath(dirname(__FILE__));
    require $filepath.'/../PHPMailer/PHPMailer.php';
    require $filepath.'/../PHPMailer/SMTP.php';
    require $filepath.'/../PHPMailer/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Email {
        private $mail;

        public function __construct(){
            $this->mail = new PHPMailer(true);
            $this->mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $this->mail->isSMTP();  
            $this->mail->isHTML(true);                                           //Send using SMTP
            $this->mail->Host       = 'enter-email-server';                     //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->mail->Username   = 'enter-email-address';                     //SMTP username
            $this->mail->Password   = 'secret';                               //SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $this->mail->Port       = 465;  
        }

        public function sendEmail($to, $subject, $body, $fromEmail, $fromName){
            try{
                $this->mail->setFrom($fromEmail, $fromName);
                $this->mail->addAddress($to);     
                $this->mail->Subject = $subject;
                $this->mail->Body    = $body;
                $this->mail->send();
                return true;
            } catch(Exception $e){
                return false;
            }
        }
    }
?>