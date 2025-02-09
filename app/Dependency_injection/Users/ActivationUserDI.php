<?php

use App\Config\PHPMailerImplementation;
use App\Config\TwigImplementation;
use App\Http\Users\ActivationUserController;
use App\Repository\Mail\ActivationUserRepository;
use App\Repository\Users\FindUserByEmailRepository;
use App\Repository\Users\FindUserByIdRepository;
use App\Services\Users\ActivationUserService;

$templeteEngine =  new TwigImplementation();
$Repository1 = new PHPMailerImplementation();
$Repository2 = new ActivationUserRepository($Repository1,$templeteEngine );
$Repository3 = new FindUserByEmailRepository();
$Service = new ActivationUserService($Repository2,$Repository3);
$ActivationUserController = new ActivationUserController($Service );
