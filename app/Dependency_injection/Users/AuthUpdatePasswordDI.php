<?php

use App\Repository\Users\AuthUpdatePasswordRepository;
use App\Repository\Users\FindUserByIdRepository;
use App\Services\Users\AuthUpdatePasswordService;
use App\Http\Users\AuthUpdatePasswordController;

$repository1 = new AuthUpdatePasswordRepository();
$repository2 = new FindUserByIdRepository();
$service = new AuthUpdatePasswordService($repository1, $repository2);
$AuthUpdatePasswordController = new AuthUpdatePasswordController($service);


