<?php

use App\Http\Users\ForgotPasswordController;
use App\Repository\Mail\SendEmailRepository;
use App\Services\Users\ForgotPasswordService;

$Repository = new SendEmailRepository();
$Service =  new ForgotPasswordService($Repository);
$ForgotPasswordController = new ForgotPasswordController($Service);