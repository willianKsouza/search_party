<?php

namespace App\Config;

use App\Interfaces\ItempleteEngine;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
class TwigImplementation implements ItempleteEngine
{
    public $loader;
    public $twig;

    public function __construct(){
        $this->loader = new FilesystemLoader('./templates');
        $this->twig = new Environment($this->loader);
    }

    public function render(string $path, array $data)
    {
        return $this->twig->render($path, $data);
    }
}
