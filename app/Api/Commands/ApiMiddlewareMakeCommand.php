<?php

namespace App\Api\Commands;

use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Support\Str;

class ApiMiddlewareMakeCommand extends MiddlewareMakeCommand
{
    protected $name = 'api:middleware';

    protected $description = 'Create a new api middleware class';

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
