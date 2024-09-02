<?php

namespace App\Contracts;

interface PDF
{
    public function render(string $name, string $view, array $data = []);
}
