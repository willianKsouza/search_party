<?php

use App\Http\Users\FindUserByIdController;
use App\Repository\Users\FindUserByIdRepository;
use App\Services\Users\FindUserByIdService;

$Repository =  new FindUserByIdRepository();
$Service = new FindUserByIdService($Repository );
$FindUserByIdController = new FindUserByIdController($Service);
