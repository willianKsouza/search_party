<?php

use App\Http\Posts\CreatePostController;
use App\Repository\Posts\CreatePostRepository;
use App\Repository\Posts\FindPostByExactTitleRepository;
use App\Services\Posts\CreatePostService;

$Repository1 = new FindPostByExactTitleRepository();
$Repository2 = new CreatePostRepository();
$Service = new CreatePostService($Repository2,$Repository1);
$CreatePostController = new CreatePostController($Service);