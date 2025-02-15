<?php

use App\Config\PHPMailerImplementation;
use App\Config\TwigImplementation;
use App\Http\Users\ForgotPasswordController;
use App\Repository\Mail\SendForgottenPasswordEmailRepository;
use App\Repository\Users\FindUserByEmailRepository;
use App\Services\Users\ForgotPasswordService;

$templateEngine = new TwigImplementation();
$Repository1 = new FindUserByEmailRepository();
$Repository2 = new PHPMailerImplementation();


$Repository3 = new SendForgottenPasswordEmailRepository($Repository2, $templateEngine);
$Service =  new ForgotPasswordService($Repository3, $Repository1);
$ForgotPasswordController = new ForgotPasswordController($Service);
