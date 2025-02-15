<?php
namespace App\Interfaces\email;


interface IMailerImplementation
{
    public function addAddress(String $email): void;
    public function setSubject(String $subject): void;
    public function setBody(String $body, $isHTML = true): void;
    public function send(): bool;
}
