<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\RequestMakeCommand;

class CustomFormRequestMakeCommand extends RequestMakeCommand
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return resource_path('stubs/request.stub');
    }
}
