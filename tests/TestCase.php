<?php

namespace MortenScheel\LaravelMacros\Tests;

use MortenScheel\LaravelMacros\LaravelMacrosServiceProvider;
use Orchestra\Testbench\TestCase as TestBench;

abstract class TestCase extends TestBench
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelMacrosServiceProvider::class,
        ];
    }
}
