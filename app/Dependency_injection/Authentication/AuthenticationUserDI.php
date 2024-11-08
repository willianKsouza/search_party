<?php

use App\Http\Users\AuthenticationUserController;
use App\Repository\Users\FindUserByEmailRepository;
use App\Services\Users\AuthenticationUserService;

$Repository = new FindUserByEmailRepository();
$Service = new AuthenticationUserService($Repository);
$AuthenticationUserController = new AuthenticationUserController($Service);
