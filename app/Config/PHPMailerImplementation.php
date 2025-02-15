<?php
namespace App\Config;

use App\Interfaces\email\IMailerImplementation;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use Exception;

class PHPMailerImplementation implements IMailerImplementation {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->setSMTPCredentials();
        $this->mail->setFrom($_ENV['MAIL_APP']);
    }

    private function setSMTPCredentials(): void {
        $this->mail->isSMTP();
        $this->mail->Host = $_ENV['MAIL_HOST'];
        $this->mail->SMTPAuth = true;
        $this->mail->Port = $_ENV['MAIL_PORT'];
        $this->mail->Username =  $_ENV['MAIL_USERNAME'];
        $this->mail->Password = $_ENV['MAIL_PASSWORD'];
        $this->mail->CharSet = 'UTF-8';
    }

    public function setFrom($email, $name = ''): void {
        $this->mail->setFrom($email, $name);
    }

    public function addAddress($email, $name = ''): void {
        $this->mail->addAddress($email, $name);
    }

    public function setSubject($subject): void {
        $this->mail->Subject = $subject;
    }

    public function setBody($body, $isHTML = true): void {
        $this->mail->isHTML($isHTML);
        $this->mail->Body = $body;
    }

    public function send(): bool {
        try {
            return $this->mail->send();
        } catch (PHPMailerException $e) {
            throw new Exception("Erro ao enviar o e-mail: {$this->mail->ErrorInfo}");
        }
    }
}