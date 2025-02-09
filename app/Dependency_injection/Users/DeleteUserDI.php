<?php

use App\Http\Users\DeleteUserController;
use App\Repository\Users\DeleteUserRepository;
use App\Repository\Users\FindUserByIdRepository;
use App\Services\Users\DeleteUserService;

$Repository1 = new DeleteUserRepository();
$Repository2 = new FindUserByIdRepository();
$Service = new DeleteUserService($Repository1,$Repository2);
$DeleteUserController = new DeleteUserController($Service);

