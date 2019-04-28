<?php

namespace App\Api\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;
use Illuminate\Support\Str;

class ApiControllerMakeCommand extends ControllerMakeCommand
{
    protected $name = 'api:controller';

    protected $description = 'Create a new api controller class';

    protected function rootNamespace()
    {
        return "App\Api\\";
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path']
            . '/Api/'
            . str_replace('\\', '/', $name)
            . '.php';
    }
}
