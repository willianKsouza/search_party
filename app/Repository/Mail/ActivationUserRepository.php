<?php

namespace App\Repository\Mail;

use App\DTO\Users\ActivationUserDTO;
use App\Interfaces\email\IActivationUserRepository;
use App\Interfaces\email\IMailerImplementation;
use App\Interfaces\ItempleteEngine;
use Exception;

class ActivationUserRepository implements IActivationUserRepository
{
    public function __construct(private IMailerImplementation $MailerImplementation, private ItempleteEngine $templeteEngine) {}

    public function sendActivationUser(ActivationUserDTO $dto): bool
    {
        try {
            $this->MailerImplementation->setSubject("Account Activation");
            $body = $this->templeteEngine->render('mailers/ActivationUser.html.twig', [
                'username' => $dto->username,
                'id' => $dto->id,
            ]);
            $this->MailerImplementation->setBody($body);

            $this->MailerImplementation->addAddress($_ENV['MAIL_APP']);
            $this->MailerImplementation->setFrom($dto->email, $dto->username);
            $this->MailerImplementation->send();
            return true;
        } catch (Exception $e) {
            return throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
