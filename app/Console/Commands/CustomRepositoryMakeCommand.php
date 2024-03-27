<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;
use JasonGuru\LaravelMakeRepository\MakeRepository;

class CustomRepositoryMakeCommand extends MakeRepository
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return resource_path('stubs/repository.stub');
    }
}
