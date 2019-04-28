<?php

namespace App\Api\Commands;

use Illuminate\Foundation\Console\RequestMakeCommand;
use Illuminate\Support\Str;

class ApiRequestMakeCommand extends RequestMakeCommand
{
    protected $name = 'api:request';

    protected $description = 'Create a new api form request class';

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
