<?php
namespace App\Interfaces\email;

use Exception;

interface IMailerImplementation
{

    public function setFrom(String $email,String $name): void;
    public function addAddress(String $email): void;
    public function setSubject(String $subject): void;
    public function setBody(String $body, $isHTML = true): void;
    public function send(): bool;
}
