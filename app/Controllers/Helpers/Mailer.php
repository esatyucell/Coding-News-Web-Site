<?php 

namespace App\Controllers\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;  
use App\Core\Config;

class Mailer {
    private $mail;  

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->setup();
    }

    private function setup() {
        $this->mail->isSMTP();
        $this->mail->Host = Config::get('SMTP_HOST');
        $this->mail->SMTPAuth = true;
        $this->mail->Username = Config::get('SMTP_USER');
        $this->mail->Password = Config::get('SMTP_PASS');
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = Config::get('SMTP_PORT');
        $this->mail->setFrom(Config::get('SMTP_FROM_EMAIL'), Config::get('SMTP_FROM_NAME'));
        $this->mail->isHTML(true);

        $this->mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
    }

    public function send($to, $subject, $body) {
        try {
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mailer Error: " . $this->mail->ErrorInfo);
            return false;
        }
    }
}