<?php

use App\Config\PHPMailerImplementation;
use App\Config\TwigImplementation;
use App\Http\Users\CreateUserController;
use App\Repository\Mail\ActivationUserRepository;
use App\Repository\Users\CreateUserRepository;
use App\Services\Users\CreateUserService;

$templeteEngine =  new TwigImplementation();
$mailer = new PHPMailerImplementation();
$Repository1 = new CreateUserRepository();
$Repository2 = new ActivationUserRepository($mailer ,$templeteEngine);
$Service = new CreateUserService($Repository1,$Repository2);
$CreateUserController = new CreateUserController($Service);