<?php

namespace App\Api\Commands;

use Illuminate\Foundation\Console\ResourceMakeCommand;
use Illuminate\Support\Str;

class ApiResourceMakeCommand extends ResourceMakeCommand
{
    protected $name = 'api:resource';

    protected $description = 'Create a new api resource';

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
