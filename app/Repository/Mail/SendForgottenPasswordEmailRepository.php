<?php

namespace App\Repository\Mail;

use App\Interfaces\email\IMailerImplementation;
use App\Interfaces\ItempleteEngine;
use App\DTO\Users\ForgotPasswordDTO;
use App\Interfaces\email\ISendForgottenPasswordEmailRepository;
use Exception;

class SendForgottenPasswordEmailRepository implements ISendForgottenPasswordEmailRepository
{
    public function __construct(private IMailerImplementation $MailerImplementation, private ItempleteEngine $templeteEngine) {}

    public function send(ForgotPasswordDTO $dto): bool
    {
        try {
            $this->MailerImplementation->setSubject("Forgotten Password");
            $body = $this->templeteEngine->render('mailers/ForgottenPasswordEmail.html.twig',[
                'username' => $dto->username,
                'id' => $dto->id,
            ]);
            $this->MailerImplementation->setBody($body);
            $this->MailerImplementation->addAddress($dto->email);
            return$this->MailerImplementation->send();
        } catch (Exception $e) {
            throw new Exception("Error sending forgotten password email: " . $e->getMessage());
        }
    }
}


