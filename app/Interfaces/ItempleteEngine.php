<?php

namespace App\Interfaces;

interface ItempleteEngine
{
    public function render(string $path, array $data);
}
