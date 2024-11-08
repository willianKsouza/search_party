<?php

use App\Http\Users\CreateUserController;
use App\Repository\Users\CreateUserRepository;
use App\Services\Users\CreateUserService;

$Repository = new CreateUserRepository();
$Service = new CreateUserService($Repository);
$CreateUserController = new CreateUserController($Service);