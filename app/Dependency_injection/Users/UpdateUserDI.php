<?php

use App\Http\Users\UpdateUserController;
use App\Repository\Users\UpdateUserRepository;
use App\Services\Users\UpdateUserService;

$Repository =  new UpdateUserRepository();
$Service = new UpdateUserService($Repository);
$UpdateUserController = new UpdateUserController($Service);